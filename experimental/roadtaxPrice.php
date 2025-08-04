<?php
require('./require/simple_html_dom.php');

$html = file_get_html('https://www.getdrivemark.com/my/senarai-harga-road-tax-kereta-malaysia-2021/');
foreach ($html->find('tbody > tr[class*=row-]') as $e) {
    foreach ($e->find('td.column-1') as $td) {
        $carModel[] = $td->innertext;
    }
    foreach ($e->find('td.column-2') as $td) {
        $capacity[] = $td->innertext;
    }
    foreach ($e->find('td.column-3') as $td) {
        $westMsia[] = $td->innertext;
    }
    foreach ($e->find('td.column-4') as $td) {
        $eastMsia[] = $td->innertext;
    }
}

//merge all details
for ($i = 0; $i < count($carModel); $i++) {
    $carArray[$i] = ['carModel' => $carModel[$i], 'capacity' => $capacity[$i], 'westMsia' => $westMsia[$i], 'eastMsia' => $eastMsia[$i]];
}


//insert into DB
$mysqli = new mysqli('localhost', 'root', '', 'irt_db');

$mysqli->query("TRUNCATE `irt_db`.`cars`");

foreach ($carArray as $car) {
    $car_model = $mysqli->real_escape_string($car['carModel']);
    $engine_capacity = $mysqli->real_escape_string($car['capacity']);
    $west_msia = $mysqli->real_escape_string(preg_replace('/RM/',"",$car['westMsia']));
    $east_msia = $mysqli->real_escape_string(preg_replace('/RM/',"",$car['eastMsia']));

    $insert = $mysqli->query("INSERT into cars(carModel, capacity, westMsia,eastMsia) VALUES ('$car_model','$engine_capacity','$west_msia','$east_msia')");
    if ($insert) {
        echo 'roadtax info updated.<br/>';
    } else echo $mysqli->error;
}

// closing connection
mysqli_close($mysqli);


// echo "<pre>";
// print_r($carArray);
// echo "</pre>";
