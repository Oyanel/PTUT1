<?php
include_once 'cronTask/Database.php';
$conn = Database::getInstance();
$conn->set_charset("utf8");
if(!empty($conn)) {
  if(isset($_POST['id'])) {
    $stationID = intval($_POST['id']);
  }
  else {
    $stationID = 10063;
  }
    $bikeAvailablePerHour = array();
    for($h=0;$h<24;$h++) {
        $sommeMoyenne = array();
        for ($i = 0; $i < 12; $i++) {
            $multiple = 7 * $i;
            $query =
                "SELECT avg(`available_bike_stands`) as moyenne
                FROM Station
                WHERE last_update >= SUBDATE( SUBDATE( ADDDATE(CURDATE(),INTERVAL ".$h." HOUR) , " . $multiple . " ) , INTERVAL 20 MINUTE )
                AND last_update <= ADDDATE( SUBDATE( ADDDATE( CURDATE(), INTERVAL ".$h." HOUR) , " . $multiple . " ) , INTERVAL 20 MINUTE )
                AND id=" . $stationID . "
                LIMIT 20;";
            $results = $conn->query($query);
            foreach ($results as $result) {
                if(!empty($result['moyenne'])) {
                    array_push($sommeMoyenne, intval($result['moyenne']));
                }
            }
        }
        $moyenne = array_sum($sommeMoyenne)/count($sommeMoyenne);
        array_push($bikeAvailablePerHour ,$moyenne);
    }
    echo json_encode($bikeAvailablePerHour);
};
