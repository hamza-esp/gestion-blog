<?php
include_once "../../../config.php";
require '../../../controller/articleC.php';
if (isset($_GET['id'])) {
    $articleC= new arctileC();
    $articleC->supprimerarticle($_GET['id']);
    header('Location:Articles.php');
}
else {
    echo 'oooooooooooooooooo';
}

?>