<?php
/* * iTech Empires:  Export Data from MySQL to CSV Script * Version: 1.0.0 * Page: Export */

// Database Connection
require("functions.php");

// get paiement

$query = "SELECT * FROM article";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$article = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $article[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=articles.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('title', 'content', 'authorId', 'createdAt'));

if (count($article) > 0) {
    foreach ($article as $row) {
        fputcsv($output, $row);
    }
}

?>