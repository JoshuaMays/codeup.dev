<?php

// CREATE NEW INSTANCE OF PDO OBJECT
require '../dbconnection.php';

// INITIALIZE LIMIT AND OFFSET FOR SELECT STATEMENTS
$limit = 4;
$offset = 0;

if (!empty($_GET)) {
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];
}

// FUNCTION TO RETURN ROWS OF PARK DATA FROM THE DATABASE
function getParks($dbc, $limit, $offset) {
    $query = "SELECT * FROM national_parks LIMIT " . $limit . " OFFSET " . $offset;
    return $dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

$stmt = getParks($dbc, $limit, $offset);

?>

<!DOCTYPE html>
<html>
<head>
    <title>National Parks</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>

<table class="table table-striped">
    <th>Name</th>
    <th>Location</th>
    <th>Area (acres)</th>
    <th>Date Established</th>
    <? foreach ($stmt as $parkInfo): ?>
        <tr>
            <td><?= $parkInfo['name']; ?></td>
            <td><?= $parkInfo['location']; ?></td>
            <td><?= $parkInfo['area_in_acres']; ?></td>
            <td class="estabDate"><?= $parkInfo['date_established']; ?></td>
        </td>
    <? endforeach; ?>
</table>
</div>
<p>Page: <a href="national_parks.php?limit=4&offset=0">1</a>, 
     <a href="national_parks.php?limit=4&offset=4">2</a>, 
     <a href="national_parks.php?limit=4&offset=8">3</a>
</p>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- Moment JS -->
<script src="js/moment.js"></script>
<script>
var dates = document.getElementsByClassName('estabDate');
for (var i = 0; i < dates.length; i++) {
    dates[i].innerText = moment(dates[i].innerText, 'YYYY MMM DD').format('MMMM D, YYYY');
}
</script>
</body>
</html>