<?php

// CREATE NEW INSTANCE OF PDO OBJECT
require '../dbconnection.php';

// INITIALIZE OFFSET FOR SELECT STATEMENTS
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// FUNCTION TO RETURN ROWS OF PARK DATA FROM THE DATABASE
function getParks($dbc, $offset) {
    $query = "SELECT name, location, area_in_acres, date_established, description FROM national_parks LIMIT :limiter OFFSET :offsetter";
    $prepStatement = $dbc->prepare($query);
    $prepStatement->bindValue(':limiter', 4, PDO::PARAM_INT);
    $prepStatement->bindValue(':offsetter', $offset, PDO::PARAM_INT);
    $prepStatement->execute();
    return $prepStatement->fetchAll(PDO::FETCH_ASSOC);
}

function addPark($dbc) {
    $query = "INSERT INTO national_parks (name, location, area_in_acres, date_established, description)" .
             "VALUES (:name, :location, :area_in_acres, :date_established, :description)";
    // INITIALIZE PREPARED INSERT STATEMENT FOR FORM ENTRIES
    $insertPark = $dbc->prepare($query);
    
    // SET UP FILTERS FOR INPUT DATA
    $filters = array(
    "parkName" => FILTER_SANITIZE_SPECIAL_CHARS,
    "parkLocation" => FILTER_SANITIZE_SPECIAL_CHARS,
    "parkArea" => array("filter" => FILTER_CALLBACK, "options" => "formatFloat"),
    "parkDate" => array("filter"=>FILTER_CALLBACK, "options" => "formatDate"),
    "parkDescription" => FILTER_SANITIZE_SPECIAL_CHARS
    );
    
    // CREATE NEW PARK DATA ARRAY USING FILTERS
    $filtered = filter_input_array(INPUT_POST, $filters);
    
    // BIND FORM DATA TO PREPARED STATEMENT VARIABLES
    $insertPark->bindValue(':name',$filtered['parkName'],PDO::PARAM_STR);
    $insertPark->bindValue(':location',$filtered['parkLocation'],PDO::PARAM_STR);
    $insertPark->bindValue(':area_in_acres',$filtered['parkArea'],PDO::PARAM_STR);
    $insertPark->bindValue(':date_established',$filtered['parkDate'],PDO::PARAM_STR);
    $insertPark->bindValue(':description',$filtered['parkDescription'],PDO::PARAM_STR);
    
    // RUN PREPARED INSERT STATEMENT
    $insertPark->execute();
}

// FUNCTION TO FORMAT DATE INPUTS
function formatDate($date) {
     $unixDate = strtotime($date);
     return Date('Y-m-d', $unixDate);
}

// FUNCTION TO FORMAT FLOAT INPUTS
function formatFloat($float) {
    return (float) str_replace(",", "", $float);
    
}

// CREATING ARRAY FROM SELECTED RECORD SET
$theParks = getParks($dbc, $offset);

// ASSIGNING COUNT OF RECORDS IN TABLE TO A VARIABLE FOR PAGINATION LINKS
$count = (int) $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();

if (isset($_POST['parkName']) && isset($_POST['parkLocation']) && isset($_POST['parkArea']) && isset($_POST['parkDate']) && isset($_POST['parkDescription'])) {
    addPark($dbc);
    $theParks = getParks($dbc, $offset);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>National Parks</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
    <div id="displayParks" class="container">
        <div class="row">
            <h1>US National Parks</h1>
            <table class="table table-striped">
                <th>Name</th>
                <th>Location</th>
                <th>Area (acres)</th>
                <th>Date Established</th>
                <th>Description</th>
                <!-- LOOP THROUGH THE SELECTED RECORDS TO DISPLAY PARK INFO-->
                <? foreach ($theParks as $parkInfo): ?>
                    <tr>
                        <td><?= $parkInfo['name']; ?></td>
                        <td><?= $parkInfo['location']; ?></td>
                        <td><?= number_format($parkInfo['area_in_acres'],2); ?></td>
                        <td class="estabDate"><?= $parkInfo['date_established']; ?></td>
                        <td><?= $parkInfo['description']; ?></td>
                    </tr>
                <? endforeach; ?>
            </table>
        </div>
        <!-- HIDE PREV BUTTON WHEN AT BEGINNING OF RECORDS -->
        <? if ($offset != 0): ?>
            <a href="?offset=<?=$offset-4;?>"><button class="btn btn-primary">Prev</button></a>
        <? endif; ?>
        
        <!-- HIDE NEXT BUTTON WHEN AT END OF RECORDS -->
        <? if (($offset+4) < $count): ?>
            <a href="?offset=<?=$offset+4;?>"><button class="btn btn-primary pull-right">Next</button></a>
        <? endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <h2>Add a Park</h2>
            <!-- FORM TO ALLOW USERS TO ADD PARKS TO THE DATABASE -->
            <form role="form" method="POST" action="/national_parks.php?offset=<?= $offset; ?>">
                <div class="form-group">
                    <label for="parkName">Park Name</label>
                    <input type="text" class="form-control" id="parkName" name="parkName" placeholder="Park Name" required>
                </div>
                <div class="form-group">
                    <label for="parkLocation">Location</label>
                    <input type="text" class="form-control" id="parkLocation" name="parkLocation" placeholder="State" required>
                </div>
                <div class="form-group">
                    <label for="parkArea">Park Size (acres)</label>
                    <input type="text" class="form-control" id="parkArea" name="parkArea" placeholder="1500.32" required>
                </div>
                <div class="form-group">
                    <label for="parkDate">Date Established</label>
                    <input type="text" class="form-control" id="parkDate" name="parkDate" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="parkDescription">Description</label>
                    <textarea  class="form-control" id="parkDescription" name="parkDescription" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- Moment JS -->
<script src="js/moment.js"></script>
<script>
// FORMAT DATES HUMAN-READABLE LONG-FORM
var dates = document.getElementsByClassName('estabDate');
for (var i = 0; i < dates.length; i++) {
    dates[i].innerText = moment(dates[i].innerText, 'YYYY MMM DD').format('MMMM D, YYYY');
}
</script>
</body>
</html>