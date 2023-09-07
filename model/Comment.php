<?php
class Comment {

        private $id;
        private $idU;
        private $idA;
        private $comment;
    
        public function __construct($id, $idU, $idA, $comment) {
            $this->id = $id;
            $this->idU = $idU;
            $this->idA = $idA;
            $this->comment = $comment;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function setId($id) {
            $this->id = $id;
        }
    
        public function getIdU() {
            return $this->idU;
        }
    
        public function setIdU($idU) {
            $this->idU = $idU;
        }
    
        public function getIdA() {
            return $this->idA;
        }
    
        public function setIdA($idA) {
            $this->idA = $idA;
        }
    
        public function getComment() {
            return $this->comment;
        }
    
        public function setComment($comment) {
            $this->comment = $comment;
        }
  
    

}
?>
