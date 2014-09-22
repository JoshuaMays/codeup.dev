<?php

class Ad {
    public $dbc;
    public $id;
    public $category_id;

    public $title        = '';
    public $body         = '';
    public $contactName  = '';
    public $contactEmail = '';
    public $createdAt    = '';
    public $image_path   = '';

    // CONSTRUCTOR METHOD FOR AD OBJECTS
    public function __construct($dbc, $id = null) {
        $this->dbc = $dbc;

        // CHECKS IF THE AD ID ALREADY EXISTS (EDITING AN AD)
        if (isset($id)) {
            // ASSIGN ID FROM EXISTING AD TO OBJECT
            $this->id = $id;

            // STATEMENT TO READ IN AD PROPERTIES FROM THE DATABASE
            $selectStmt = $this->dbc->prepare('SELECT * FROM items WHERE id = ?');
            $selectStmt->execute([$this->id]);

            // COPY ASSOCIATIVE ARRAY OF PROPERTIES FROM DATABASE RECORD
            $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

            // ASSIGN OBJECT PROPERTIES FROM FETCH ASSOC ARRAY
            $this->title        = $row['title'];
            $this->body         = $row['body'];
            $this->contactName  = $row['name'];
            $this->contactEmail = $row['email'];
            $this->createdAt    = new DateTime($row['created_at']);
            $this->imagePath   = $row['image_path'];
            
        }
    }

    // METHOD TO CHOOSE BETWEEN INSERTING AND UPDATING AN AD
    // IF THE AD ID ALREADY EXISTS IN THE TABLE, UPDATE. IF NOT, INSERT.
    public function save() {
        if (isset($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    // METHOD TO INSERT NEW AD OBJECT INTO THE DATABASE
    protected function insert() {
        // CREATE A TIMESTAMP FOR AD ON INSERT
        $this->createdAt = new DateTime();

        // PREPARED INSERT SQL STATEMENT FOR NEW ADS
        $insertSQL = 'INSERT INTO items (title, body, name, email, created_at, image_path)
                      VALUES (:title, :body, :name, :email, :created_at, :image_path)';

        $insertStmt = $this->dbc->prepare($insertSQL);

        // BIND AD OBJECT PROPERTIES TO PREPARED STATEMENT VARIABLES
        $insertStmt->bindValue(':title',      $this->title,                  PDO::PARAM_STR);
        $insertStmt->bindValue(':body',       $this->body,                   PDO::PARAM_STR);
        $insertStmt->bindValue(':name',       $this->contactName,            PDO::PARAM_STR);
        $insertStmt->bindValue(':email',      $this->contactEmail,           PDO::PARAM_STR);
        $insertStmt->bindValue(':created_at', $this->createdAt->format('c'), PDO::PARAM_STR);
        $insertStmt->bindValue(':image_path', $this->imagePath,              PDO::PARAM_STR);
        $insertStmt->execute();

        // ASSIGN AD OBJECT FROM ID OF INSERTED RECORD FOR AD VIEW PAGE
        $this->id = $this->dbc->lastInsertId();
    }
    
    protected function update() {
        // PREPARED UPDATE SQL STATEMENT FOR EDITING ADS
        $updateSQL = 'UPDATE items
                      SET title = :title, body = :body, name = :name, email = :email, image_path = :image_path
                      WHERE id = :id';

        $updateStmt = $this->dbc->prepare($updateSQL);
        // BIND EDITED OBJECT PROPERTIES TO PREPARED STATEMENT VARIABLES
        $updateStmt->bindValue(':title',      $this->title,        PDO::PARAM_STR);
        $updateStmt->bindValue(':body',       $this->body,         PDO::PARAM_STR);
        $updateStmt->bindValue(':name',       $this->contactName,  PDO::PARAM_STR);
        $updateStmt->bindValue(':email',      $this->contactEmail, PDO::PARAM_STR);
        $updateStmt->bindValue(':image_path', $this->imagePath,    PDO::PARAM_STR);
        $updateStmt->bindValue(':id',         $this->id,           PDO::PARAM_INT);
        $updateStmt->execute();
    }
    
    protected function associateItemCat() {
        $associateSQL = 'INSERT INTO item_category (item_id, category_id)
                         VALUES (:item_id, :category_id)';
        $associateStmt = $this->dbc->prepare($associateSQL);
        
        $associateStmt->bindValue(':item_id',     $this->id, PDO::PARAM_INT);
        $associateStmt->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        
        $associateStmt->execute();
    }

    public function sanitize($array) {
        // SET UP USER INPUT FILTERS FOR INSERT AND UPDATE METHODS
        $filters = array(
            "title" => FILTER_SANITIZE_STRING,
            "body" => FILTER_SANITIZE_STRING,
            "contact_name" => FILTER_SANITIZE_STRING,
            "contact_email" => FILTER_SANITIZE_EMAIL,
            "image_path" => FILTER_SANITIZE_STRING
        );

        // TRIM USER INPUT AND UPDATE POST ARRAY
        foreach($array as $key => $input) {
            $array[$key] = trim($input);
        }

        // CREATE A FILTERED ARRAY FROM POSTED AD
        $filtered = filter_input_array(INPUT_POST, $filters);
        
        // CREATE AND POPULATE AD OBJECT WITH FILTERED FORM DATA
        $this->title        = $filtered['title'];
        $this->body         = $filtered['body'];
        $this->contactName  = $filtered['contact_name'];
        $this->contactEmail = $filtered['contact_email'];
        $this->imagePath    = $array['image_path'];

        $this->save();
    }
    
    public function addImage($files) {
        // UPLOAD DIRECTORY PATH
        $uploadDir = '/vagrant/sites/codeup.dev/public/lister/img/';
        $uploadFilename = basename($files['fileUpload']['name']);
            
        // UPLOADED PATH AND FILENAME
        $savedFile = $uploadDir . $uploadFilename;
        
        // MOVE TMP FILE TO IMAGE DIRECTORY
        move_uploaded_file($files['fileUpload']['tmp_name'], $savedFile);
        $this->imagePath = $uploadFilename;
    }
}