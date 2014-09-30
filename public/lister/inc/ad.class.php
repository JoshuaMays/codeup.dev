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
    protected $tags = [];

    // CONSTRUCTOR METHOD FOR AD OBJECTS
    public function __construct($dbc, $id = null) {
        $this->dbc = $dbc;

        // CHECKS IF THE AD ID ALREADY EXISTS (EDITING AN AD)
        if (isset($id)) {
            // ASSIGN ID FROM EXISTING AD TO OBJECT
            $this->id = $id;

            // STATEMENT TO READ IN AD PROPERTIES FROM THE DATABASE
            $selectStmt = $this->dbc->prepare('SELECT * FROM ads WHERE id = ?');

            $selectStmt->execute([$this->id]);

            // COPY ASSOCIATIVE ARRAY OF PROPERTIES FROM DATABASE RECORD
            $row = $selectStmt->fetch(PDO::FETCH_ASSOC);
            
            // STATEMENT TO FIND TAGS ASSOCIATED WITH THE AD
            $tagAssociation = 'SELECT id, tag FROM tags 
                               WHERE id IN (SELECT tag_id FROM ad_tag WHERE ad_id = ?)';
            
            $tagAssociationStmt = $this->dbc->prepare($tagAssociation);
            $tagAssociationStmt->execute([$this->id]);
            
            // COPY ASSOCIATIVE ARRAY OF TAGS FOR THE AD
            $tagRow = $tagAssociationStmt->fetchAll(PDO::FETCH_KEY_PAIR);
            
            // ASSIGN OBJECT PROPERTIES FROM FETCH ASSOC ARRAY
            $this->title        = $row['title'];
            $this->body         = $row['body'];
            $this->contactName  = $row['name'];
            $this->contactEmail = $row['email'];
            $this->createdAt    = new DateTime($row['created_at']);
            $this->imagePath    = $row['image_path'];
            $this->tags         = $tagRow;
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
        $insertSQL = 'INSERT INTO ads (title, body, name, email, created_at, image_path)
                      VALUES (:title, :body, :name, :email, :created_at, :image_path)';
                      
        $tagInsertSQL = 'INSERT INTO ad_tag (ad_id, tag_id)
                         VALUES (:ad_id, :tag_id)';

        $insertStmt = $this->dbc->prepare($insertSQL);
        $tagInsertStmt = $this->dbc->prepare($tagInsertSQL);
        
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
        
        foreach($this->tags as $tag) {
            $tagInsertStmt->bindValue(':ad_id',  $this->id, PDO::PARAM_INT);
            $tagInsertStmt->bindValue(':tag_id', $tag,      PDO::PARAM_INT);
            $tagInsertStmt->execute();
        }
    }

    // METHOD FOR UPDATING AN AD'S PROPERTIES AND UPDATING THE RECORD IN THE DATABASE
    protected function update() {
        // PREPARED UPDATE SQL STATEMENT FOR EDITING ADS
        $updateSQL = 'UPDATE ads
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

    // METHOD TO SANITIZE FORM INPUT AND PREPARE IT FOR INSERT OR UPDATE METHODS
    public function sanitize($array) {
        // SET UP USER INPUT FILTERS FOR INSERT AND UPDATE METHODS
        $filters = array(
            "title" => FILTER_SANITIZE_STRING,
            "body" => FILTER_SANITIZE_STRING,
            "contact_name" => FILTER_SANITIZE_STRING,
            "contact_email" => FILTER_SANITIZE_EMAIL,
            "image_path" => FILTER_SANITIZE_URL
        );

        // TRIM USER INPUT AND UPDATE POST ARRAY
        foreach($array as $key => $input) {
            if(is_string($input)) {
                $array[$key] = trim($input);
            }
        }

        // CREATE A FILTERED ARRAY FROM POSTED AD
        $filtered = filter_input_array(INPUT_POST, $filters);
        
        // CREATE AND POPULATE AD OBJECT WITH FILTERED FORM DATA
        $this->title        = $filtered['title'];
        $this->body         = $filtered['body'];
        $this->contactName  = $filtered['contact_name'];
        $this->contactEmail = $filtered['contact_email'];
        $this->imagePath    = $array['image_path'];
        $this->tags         = array_merge($this->tags, $array['tagChecks']);
        $this->save();
    }

    // METHOD TO ADD AN IMAGE PATH TO THE AD RECORD
    public function addImage($files) {
        // UPLOAD DIRECTORY PATH
        $uploadDir = '/vagrant/sites/codeup.dev/public/lister/img/';
        $uploadFilename = basename($files['fileUpload']['name']);
            
        // UPLOADED PATH AND FILENAME
        $savedFile = $uploadDir . $uploadFilename;
        
        // MOVE TMP FILE TO IMAGE DIRECTORY
        move_uploaded_file($files['fileUpload']['tmp_name'], $savedFile);
        $this->imagePath = $uploadFilename;
        return $this->imagePath;
    }

    // METHOD METHOD TO PROVIDE ACCESS TO TAGS ASSOCIATED WITH AN AD
    public function showTags() {
        return $this->tags;
    }
}