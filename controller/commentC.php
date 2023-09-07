<?php



    Class commentC {

        function list() 
        {
            $sql = "SELECT * FROM comment";
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




        function getcommentbyID($id)
        {
            $requete = "select * from comment where id=:id";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(
                    [
                        'id'=>$id
                    ]
                );
                $result = $querry->fetch();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

        

        function ajoutercomment($comment)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO comment
                (idU,idA,comment)
                VALUES
                (:idU,:idA,:comment)
                ');
                $querry->execute([
                    'idU'=>$comment->getIdU(),
                    'idA'=>$comment->getIdA(),
                    'comment'=>$comment->getComment()

                ]);
                $comment->setId($config->lastInsertId());
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

        


      function modifiercomment($comment)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                UPDATE comment SET
                idU=:idU,idA=:idA,comment=:comment

                where id=:id
                ');
                $querry->execute([
                    'id'=>$comment->getId(),
                    'idU'=>$comment->getIdU(),
                    'idA'=>$comment->getIdA(),
                    'comment'=>$comment->getComment()

                  
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }



        function supprimercomment($id)
        {
            $sql="DELETE FROM comment WHERE id= :id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
        }



        function listResearcher($researcher)
        {
            $sql = "SELECT * FROM comment where comment like :researcher";
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



        function countComment(){

            $sql="SELECT count(id) FROM comment" ;
            $db = config::getConnexion();
            try{
                $query = $db->query($sql);
                $query->execute();
                   $prog_number =$query->fetchColumn();
                return $prog_number;
            }
            catch(Exception $e){
                die('Erreur: '.$e->getMessage());
            }   
        }

      


    }
