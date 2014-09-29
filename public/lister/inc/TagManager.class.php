<?php

require_once('ad_manager.class.php');

class TagManager extends AdManager {

    protected $tag_id;

    public function __construct($dbc) {
        $this->dbc = $dbc;
        $this->tag_id = $_GET['tag'];
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
}