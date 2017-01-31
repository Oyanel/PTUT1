<?php
include_once 'cronTask/Database.php';
$conn = Database::getInstance();
if(!empty($conn)) {
  if(isset($_POST['commune'])){
    $commune = $_POST['commune'];
        $query =
            "SELECT count(*) AS nb
            FROM Station
            WHERE uid < 307
            AND commune='VILLEURBANNE';";

        $results = $conn->query($query);
      echo $results['available_bike_stands'];
  }
  else {
    echo "Aucun POST";
  }
};
