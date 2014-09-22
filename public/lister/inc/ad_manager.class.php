<?php

require_once('Ad.class.php');

class AdManager {

    public $dbc;

    // CONSTRUCTOR METHOD FOR AD MANAGER OBJECTS
    public function __construct($dbc) {
        $this->dbc = $dbc;
    }

    // METHOD FOR LOADING ALL THE ADS FOR DISPLAY
    public function loadAds() {
        // SELECT STATEMENT FOR RETURNING ALL OF THE IDS OF AD RECORDS
        $adsStmt = $this->dbc->query('SELECT id FROM items');

        // INITIALIZE EMPTY ARRAY TO RETURN AD OBJECTS
        $ads = [];

        // FETCH ROWS OF AD RECORDS FOR EACH ID PRESENT IN TABLE
        while($row = $adsStmt->fetch(PDO::FETCH_ASSOC)) {
            // CREATE AD OBJECT FOR EACH ROW OF AD PROPERTIES
            $ad = new Ad($this->dbc, $row['id']);
            // PUSH AD ONTO THE ADS ARRAY
            $ads[] = $ad;
        }

        return $ads;
    }
    
    // METHOD FOR SAVING ADS
    public function saveAds() {
        
    }
}