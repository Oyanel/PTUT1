<?php
    require_once 'Dbconn.php';
    class Velov
    {
        private $db_conn;

        public function __construct(){
            $this->getStationState();
        }

        public function getStationState(){
            $jsonFileStation=file_get_contents("https://download.data.grandlyon.com/ws/rdata/jcd_jcdecaux.jcdvelov/all.json");
            return $jsonFileStation;
        }

        public function populateDB(){
            $this->db_conn = DbConn::getDbConn();
            $stations = json_decode($this->getStationState());
            $this->db_conn->close();
        }

        public function printStations(){
            echo $this->getStationState();
        }
    }