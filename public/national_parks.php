<?php

// CREATE NEW INSTANCE OF PDO OBJECT
require '../dbconnection.php';

// INITIALIZE OFFSET FOR SELECT STATEMENTS
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// FUNCTION TO RETURN ROWS OF PARK DATA FROM THE DATABASE
function getParks($dbc, $offset) {
    $query = "SELECT name, location, area_in_acres, date_established FROM national_parks LIMIT :limiter OFFSET :offsetter";
    $prepStatement = $dbc->prepare($query);
    $prepStatement->bindValue(':limiter', 4, PDO::PARAM_INT);
    $prepStatement->bindValue(':offsetter', $offset, PDO::PARAM_INT);
    $prepStatement->execute();
    return $prepStatement->fetchAll(PDO::FETCH_ASSOC);
}

// CREATING ARRAY FROM SELECTED RECORD SET
$theParks = getParks($dbc, $offset);

// ASSIGNING COUNT OF RECORDS IN TABLE TO A VARIABLE FOR PAGINATION LINKS
$count = (int) $dbc->query('SELECT count(*) FROM national_parks')->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>
    <title>National Parks</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>US National Parks</h1>
            <table class="table table-striped">
                <th>Name</th>
                <th>Location</th>
                <th>Area (acres)</th>
                <th>Date Established</th>
                <!-- LOOP THROUGH THE SELECTED RECORDS TO DISPLAY PARK INFO-->
                <? foreach ($theParks as $parkInfo): ?>
                    <tr>
                        <td><?= $parkInfo['name']; ?></td>
                        <td><?= $parkInfo['location']; ?></td>
                        <td><?= number_format($parkInfo['area_in_acres'],2); ?></td>
                        <td class="estabDate"><?= $parkInfo['date_established']; ?></td>
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