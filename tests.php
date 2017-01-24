<?php
include_once 'cronTask/Database.php';
$conn = Database::getInstance();
$conn->set_charset("utf8");
if(!empty($conn)) {
    $stationID = 10063;
    $stations = array();
    for ($i=0;$i <12;$i++) {
        $multiple = 7 * $i;
        $query =
            "SELECT * 
            FROM Station
            WHERE last_update >= SUBDATE( SUBDATE( NOW( ) , " . $multiple . " ) , INTERVAL 1 HOUR ) 
            AND last_update <= ADDDATE( SUBDATE( NOW( ) , " . $multiple . " ) , INTERVAL 1 HOUR ) 
            AND id=".$stationID."
            LIMIT 20;";
        $results = $conn->query($query);
        foreach ($results as $result) {
            array_push($stations,intval($result['available_bike_stands']));
        }
    }
    $sommeStations = 0;
    foreach ($stations as $station){
        $sommeStations +=$station;
    }
    $moyenne = $sommeStations/count($stations);
    echo $moyenne;
};