<?php

include 'Database.php';
    class Velov
    {
        private $db_conn_oracle;
        private $db_conn_mysql;

        /**
         * Velov constructor.
         */
        public function __construct(){
            //$this->getConnectionOracle();
            //$this->getConnectionMysql();
        }

        /**
         * @return mixed
         */
        public function getDbConnOracle()
        {
            return $this->db_conn_oracle;
        }

        /**
         * @param mixed $db_conn_oracle
         */
        public function setDbConnOracle($db_conn_oracle)
        {
            $this->db_conn_oracle = $db_conn_oracle;
        }

        /**
         * @return mixed
         */
        public function getDbConnMysql()
        {
            return $this->db_conn_mysql;
        }

        /**
         * @param mixed $db_conn_mysql
         */
        public function setDbConnMysql($db_conn_mysql)
        {
            $this->db_conn_mysql = $db_conn_mysql;
        }

        /**
         * @return string
         */
        public function getStationState(){
            $URL = 'https://download.data.grandlyon.com/ws/rdata/jcd_jcdecaux.jcdvelov/all.json';
            $jsonFileStation = file_get_contents($URL);
            if(empty($jsonFileStation)){
                $this->createLogs('impossible de se connecter aux données de Grand Lyon.(Oracle)');
                echo 'Connection avec les données de grand lyon impossible';
            }
            return $jsonFileStation;
        }

        /**
         * @return mixed
         */
        private function getConnectionOracle(){
            if($this->db_conn_oracle == null){
                $DB = new Database();
                $this->setDbConnOracle($DB->getConnectionOracle());
            }
            return $this->db_conn_oracle;
        }

        private function getConnectionMysql(){
            if($this->db_conn_mysql == null){
                $DB = new Database();
                $this->setDbConnMysql($DB->getConnectionMysql());
            }
            return $this->db_conn_mysql;
        }

        /**
         * Populate the Oracle Database
         */
        public function populateOracleDB()
        {
            if(!empty($this->getStationState())) {
                $stations = json_decode($this->getStationState(), true);
                $stationsV = $stations['values'];
                $conn = $this->getDbConnOracle();
                foreach ($stationsV as $station) {
                    $station['lat'] = floatval($station['lat']);
                    $station['lng'] = floatval($station['lng']);
                    $station['banking'] = ($station['banking'] ? '1' : '0');
                    $station['bonus'] = ($station['bonus'] === 'Non' ? '0' : '1');
                    $station['nmarrond'] = ($station['nmarrond'] === 'None' ? '-1' : $station['nmarrond']);

                    //Ce qui suit pique les yeux mais c'est du oracle et je n'y connais rien alors voila !

                    $query = 'Insert into station(
                                status,
                                commune,
                                nom,
                                bike_stand,
                                bonus,
                                address2,
                                id,
                                availability,
                                available_bike_stands,
                                banking,
                                pole,
                                gid,
                                available_bikes,
                                address,
                                lat,
                                lng,
                                last_update,
                                nmarrond,
                                availabilitycode,
                                last_update_fme
                                ) values
                                (
                                \'' . str_replace('\'', '\'\'', $station['status']) . '\',\''
                        . str_replace('\'', '\'\'', $station['commune']) . '\',\''
                        . str_replace('\'', '\'\'', $station['name']) . '\','
                        . $station['bike_stands'] . ','
                        . $station['bonus'] . ',\''
                        . str_replace('\'', '\'\'', $station['address2']) . '\','
                        . $station['number'] . ',\''
                        . $station['availability'] . '\','
                        . $station['available_bike_stands'] . ','
                        . $station['banking'] . ',\''
                        . str_replace('\'', '\'\'', $station['pole']) . '\','
                        . $station['gid'] . ','
                        . $station['available_bikes'] . ',\''
                        . str_replace('\'', '\'\'', $station['address']) . '\','
                        . $station['lat'] . ','
                        . $station['lng'] . ',\''
                        . $station['last_update'].'\','
                        . $station['nmarrond'] . ','
                        . $station['availabilitycode'] . ',\''
                        . $station['last_update_fme'].'\')'.'';
                    $stid = oci_parse($conn, $query);
                    oci_execute($stid);
                }
            }else{
                $this->createLogs('Insertion des données dans la base impossible (Oracle)');
                echo 'Insertion des données dans la base impossible (Oracle)';
            }
        }

        public function populateMysqlDB()
        {
            $DB = new Database();
            $conn = $DB->getConnectionMysql();
            $conn->set_charset("utf8");
            if(!empty($conn)) {
                $stations = json_decode($this->getStationState(), true);
                $stationsV = $stations['values'];
                $DB = new Database();
                $conn = $DB->getConnectionMysql();
                $query = 'INSERT INTO Station(
                                status,
                                commune,
                                nom,
                                bike_stand,
                                bonus,
                                address2,
                                id,
                                availability,
                                available_bike_stands,
                                banking,
                                pole,
                                gid,
                                available_bikes,
                                address,
                                lat,
                                lng,
                                last_update,
                                nmarrond,
                                availabilitycode,
                                last_update_fme
                                ) values(
                                :status,
                                :commune,
                                :nom,
                                :bike_stands,
                                :bonus,
                                :address2,
                                :id,
                                :availability,
                                :available_bike_stands,
                                :banking,
                                :pole,
                                :gid,
                                :available_bikes,
                                :address,
                                :lat,
                                :lng,
                                :last_update,
                                :nmarrond,
                                :availabilitycode,
                                :last_update_fme
                                )
                    ';
                foreach ($stationsV as $station) {
                    $station['lat'] = floatval($station['lat']);
                    $station['lng'] = floatval($station['lng']);
                    $station['banking'] = ($station['banking'] ? '1' : '0');
                    $station['bonus'] = ($station['bonus'] === 'Non' ? '0' : '1');
                    $station['nmarrond'] = ($station['nmarrond'] === 'None' ? '-1' : $station['nmarrond']);

                    $binding=array(
                        ':status' => '\''.utf8_decode($station['status']).'\'',
                        ':commune' => '\''.utf8_decode($station['commune']).'\'',
                        ':nom' => '\''.utf8_decode($station['name']).'\'',
                        ':bike_stands' => $station['bike_stands'],
                        ':bonus' => $station['bonus'],
                        ':address2' => '\''.utf8_decode($station['address2']).'\'',
                        ':id' => $station['number'],
                        ':availability' => '\''.utf8_decode($station['availability']).'\'',
                        ':available_bike_stands' => $station['available_bike_stands'],
                        ':banking' => $station['banking'],
                        ':pole' => '\''.utf8_decode($station['pole']).'\'',
                        ':gid' => $station['gid'],
                        ':available_bikes' => $station['available_bikes'],
                        ':address' => '\''.utf8_decode($station['address']).'\'',
                        ':lat' => $station['lat'],
                        ':lng' => $station['lng'],
                        ':last_update' => '\''.utf8_decode($station['last_update']).'\'',
                        ':nmarrond' => $station['nmarrond'],
                        ':availabilitycode' => $station['availabilitycode'],
                        ':last_update_fme' => '\''.utf8_decode($station['last_update_fme']).'\''
                    );
                    $trueQuery = strtr($query,$binding);
                    $conn->query($trueQuery);
                }
            }else{
                $this->createLogs('Insertion des données dans la base impossible (Mysql)');
                echo 'Insertion des données dans la base impossible (Mysql)';
            }
        }

        /**
         * Print station (used for testing)
         */
        public function printStations(){
            echo $this->getStationState();
        }

        /**
         * @param String $message
         */
        public function createLogs($message){
            $date = date('d/m/Y h:i:s a', time());
            if(!@file_exists('./logs')){
                mkdir('./logs');
            }
            file_put_contents(Log_file,'['.$date.'] : '.$message."\r\n",FILE_APPEND);
        }
    }