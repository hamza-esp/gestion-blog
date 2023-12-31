<?php

class UserC
{
    private $db; // Define the $db property

   
    function list() 
    {
        $sql = "SELECT * FROM adm";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $service = $query->fetch();
            $res = [];
            for ($x = 0; $service; $x++) {
                $res[$x] = $service;
                $service = $query->fetch();
            }
            return $res;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    
    function listResearcher($researcher)
    {
        $sql = "SELECT * FROM adm where name like :researcher OR  phone like :researcher OR  email like :researcher";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':researcher', '%'.$researcher.'%');
            $query->execute();
            $service = $query->fetch();
            $res = [];
            for ($x = 0; $service; $x++) {
                $res[$x] = $service;
                $service = $query->fetch();
            }
            return $res;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }



    function researcherParName($name) 
    {
        $sql = "SELECT * FROM adm where name = :name";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':name', $name);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function checkloginExist($email,$password){
        $sql = "SELECT * FROM adm where email = :email AND password = :password";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function delete($name)
    {
        $sql = "DELETE FROM adm WHERE name = :name";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':name', $name);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function adduser($user)
    {
        $sql = "INSERT INTO adm (id  , name, phone,email,password,role)
        VALUES (null  , :name, :phone,:email,:password,:role)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $user->getname(),
                'phone' => $user->getphone(),
                'email' => $user->getemail(),
                'password' => $user->getpassword(),
                'role' => $user->getrole(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function update($user, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE adm SET    
                  name = :name,              
                  phone = :phone,
                  email = :email,
                  password = :password,
                  role = :role
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'name' => $user->getname(),
                'phone' => $user->getphone(),
                'email' => $user->getemail(),
                'password' => $user->getpassword(),
                'role' => $user->getrole(),
            ]);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    public function getUserById($userId)
    {
        try {
            // Prepare a SQL statement to fetch user data by ID
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :userId");
            $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the user data as an associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                // Create a User object and return it
                return new User(
                    $user['id'],
                    $user['name'],
                    $user['phone'],
                    $user['email'],
                    $user['password'],
                    $user['role']
                );
            } else {
                // User not found
                throw new Exception("User not found");
            }
        } catch (PDOException $e) {
            // Handle database errors here
            // You can log the error or throw a custom exception for DB errors
            throw new Exception("Database error: " . $e->getMessage());
        }
    }



}
?>