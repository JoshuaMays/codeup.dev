<?php

class Tag {
    
    public $dbc;
    public $id;
    public $tag = ''; 
    
    public function __construct($dbc, $id = null) {
        $this->dbc = $dbc;

        // CHECK IF TAG ID EXISTS AND LOAD TAG INFO FROM ROW
        if (isset($id)) {
            $this->id = $id;
            
            $tagStmt = $this->dbc->prepare('SELECT tag FROM tags WHERE id = ?');
            
            $tagStmt->execute([$this->id]);
            
            $tagRow = $tagStmt->fetchColumn();
            
            $this->tag = $tagRow;
        }
    }
}