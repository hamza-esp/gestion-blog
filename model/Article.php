<?php
class Article {
    private $id;
    private $title;
    private $content;
    private $authorId;
    private $createdAt;

    public function __construct($id, $title, $content, $authorId, $createdAt) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->createdAt = $createdAt;
    }

    // Add getter and setter methods for each property
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getAuthorId() {
        return $this->authorId;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }


        // Setters
        public function setId($id) {
            $this->id = $id;
        }
    
        public function setTitle($title) {
            $this->title = $title;
        }
    
        public function setContent($content) {
            $this->content = $content;
        }
    
        public function setAuthorId($authorId) {
            $this->authorId = $authorId;
        }
    
        public function setCreatedAt($createdAt) {
            $this->createdAt = $createdAt;
        }
    


        
}
?>
