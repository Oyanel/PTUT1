<?php
include_once 'cronTask/Database.php';
$conn = Database::getInstance();
$conn->set_charset("utf8");
if(!empty($conn)) {
    $stationID = intval($_POST['id']);
    $stations = array();
    $tabf=array();
    for($h=0;$h<24;$h++) {

        for ($i = 0; $i < 12; $i++) {
            $multiple = 7 * $i;
            $query =
                "SELECT *
FROM Station
WHERE last_update >= SUBDATE( SUBDATE( ADDDATE(CURDATE(),".$h.") , " . $multiple . " ) , INTERVAL 20 MINUTE )
AND last_update <= ADDDATE( SUBDATE( ADDDATE( CURDATE(),".$h.") , " . $multiple . " ) , INTERVAL 20 MINUTE )
AND id=" . $stationID . "
LIMIT 20;";
            $results = $conn->query($query);
            foreach ($results as $result) {
                array_push($stations, intval($result['available_bike_stands']));
            }
        }
        $sommeStations = 0;
        foreach ($stations as $station) {
            $sommeStations += $station;
        }
        $moyenne = $sommeStations / count($stations);
        array_push($tabf, $moyenne);
    }
    echo json_encode($tabf);
};
