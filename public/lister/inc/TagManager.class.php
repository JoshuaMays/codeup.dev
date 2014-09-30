<?php

require_once('ad_manager.class.php');
require_once('Tag.class.php');

class TagManager extends AdManager {

    protected $tag_id = '';

    public function __construct($dbc) {
        $this->dbc = $dbc;
        // CHECK IF USER IS TRYING TO VIEW ADS ASSOCIATE WITH A SPECIFIC TAG
        if (isset($_GET['tag'])) {
            $this->tag_id = $_GET['tag'];
        }
    }

    // METHOD FOR LOADING ALL ADS MATCHING THE TAG
    public function loadTaggedAds() {
        $adsSQL = 'SELECT a.id, a.title, a.name, a.created_at, a.image_path FROM ads a
                       LEFT JOIN ad_tag `at` ON a.id = at.ad_id
                       LEFT JOIN tags t ON at.tag_id = t.id
                       WHERE t.id = ?';

        $adsStmt = $this->dbc->prepare($adsSQL);
        $adsStmt->execute([$this->tag_id]);
        // INITIALIZE EMPTY ARRAY TO RETURN AD OBJECTS
        $ads = [];

        while ($row = $adsStmt->fetch(PDO::FETCH_ASSOC)) {
            // CREATE AD OBJECTS FOR EACH ROW OF ADS
            $ad = new Ad($this->dbc, $row['id']);
            // PUSH ADS ONTO THE ADS ARRAY
            $ads[] = $ad;
        }

        return $ads;
    }

    // METHOD FOR LOADING ALL AVAILABLE TAGS WHEN CREATING A NEW AD
    public function loadTagCollection() {
        $tagsSQL = 'SELECT id, tag FROM tags ORDER BY tag ASC';
        $tagsStmt = $this->dbc->prepare($tagsSQL);
        $tagsStmt->execute();
        
        $tagsList = [];
        while($row = $tagsStmt->fetch(PDO::FETCH_ASSOC)) {

            // CREATE A NEW TAG OBJECT FOR EACH ROW OF DATA IN tags TABLE
            $tag = new Tag($this->dbc, $row['id']);

            // PUSH TAGS ONTO AN ARRAY
            $tagsList[] = $tag;
        }
        return $tagsList;
    }
}