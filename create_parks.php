<?php 

$parks = [
    ['name' => 'Acadia', 'location' => 'Maine', 'date_established' => '1919-02-26', 'area_in_acres' => 47389.67],
    ['name' => 'American Samoa', 'location' => 'American Samoa', 'date_established' => '1988-10-31', 'area_in_acres' => 9000],
    ['name' => 'Arches', 'location' => 'Utah', 'date_established' => '1971-11-12', 'area_in_acres' => 76518.98],
    ['name' => 'Badlands', 'location' => 'South Dakota', 'date_established' => '1978-11-10', 'area_in_acres' => 242755.94],
    ['name' => 'Big Bend', 'location' => 'Texas', 'date_established' => '1944-06-12', 'area_in_acres' => 801163.21],
    ['name' => 'Biscayne', 'location' => 'Florida', 'date_established' => '1980-06-28', 'area_in_acres' => 172924.07],
    ['name' => 'Black Canyon of the Gunnison', 'location' => 'Colorado', 'date_established' => '1999-10-21', 'area_in_acres' => 32950.03],
    ['name' => 'Bryce Canyon', 'location' => 'Utah', 'date_established' => '1928-02-25', 'area_in_acres' => 35835.08],
    ['name' => 'Canyonlands', 'location' => 'Utah', 'date_established' => '1964-09-12', 'area_in_acres' => 337597.83],
    ['name' => 'Capitol Reef', 'location' => 'Utah', 'date_established' => '1971-12-18', 'area_in_acres' => 241904.26],
    ['name' => 'Carlsbad Caverns', 'location' => 'New Mexico', 'date_established' => '1930-05-14', 'area_in_acres' => 46766.45],
    ['name' => 'Channel Islands', 'location' => 'California', 'date_established' => '1980-03-05', 'area_in_acres' => 249561.00],
    ['name' => 'Congaree', 'location' => 'South Carolina', 'date_established' => '2003-11-10', 'area_in_acres' => 26545.86],
    ['name' => 'Crater Lake', 'location' => 'Oregon', 'date_established' => '1902-05-22', 'area_in_acres' => 183224.05],
    ['name' => 'Cuyahoga Valley', 'location' => 'Ohio', 'date_established' => '2000-10-11', 'area_in_acres' => 32860.73],
    ['name' => 'Death Valley', 'location' => 'California/Nevada', 'date_established' => '1994-10-31', 'area_in_acres' => 3372401.96],
    ['name' => 'Denali', 'location' => 'Alaska', 'date_established' => '1917-09-12', 'area_in_acres' => 337597.83],
];

foreach ($parks as $park) {
    $query = "INSERT INTO national_parks (name, location, date_established, area_in_acres) 
              VALUES ('{$park['name']}', 
                      '{$park['location']}', 
                      '{$park['date_established']}', 
                      '{$park['area_in_acres']}')";
    
    $dbc->exec($query);
    
    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
}

?>