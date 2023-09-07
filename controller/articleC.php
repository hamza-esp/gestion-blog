<?php



    Class arctileC {

        function list() 
        {
            $sql = "SELECT * FROM article";
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




        function getarticlebyID($id)
        {
            $requete = "select * from article where id=:id";
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

        

        function ajouterarticle($article)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO article
                (title,content,authorId,createdAt)
                VALUES
                (:title,:content,:authorId,:createdAt)
                ');
                $querry->execute([
                    'title'=>$article->getTitle(),
                    'content'=>$article->getContent(),
                    'authorId'=>$article->getAuthorId(),
                    'createdAt'=>$article->getCreatedAt()

                ]);
                $article->setId($config->lastInsertId());
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

        


      function modifierarticle($article)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                UPDATE article SET
                title=:title,content=:content,authorId=:authorId,createdAt=:createdAt

                where id=:id
                ');
                $querry->execute([
                    'id'=>$article->getId(),
                    'title'=>$article->getTitle(),
                    'content'=>$article->getContent(),
                    'authorId'=>$article->getAuthorId(),
                    'createdAt'=>$article->getCreatedAt()

                  
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }



        function supprimerarticle($id)
        {
            $sql="DELETE FROM article WHERE id= :id";
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
            $sql = "SELECT * FROM article where title like :researcher OR  content like :researcher OR  authorId like :researcher";
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



        function countArticle(){

            $sql="SELECT count(id) FROM article" ;
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
