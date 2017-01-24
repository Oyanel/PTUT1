<?php

include 'Database.php';
    class Velov
    {

        /**
         * @return string
         */
        public function getStationState(){
            $URL = 'https://download.data.grandlyon.com/ws/rdata/jcd_jcdecaux.jcdvelov/all.json';
            $jsonFileStation = file_get_contents($URL);
            if(empty($jsonFileStation)){
                $this->createLogs('impossible de se connecter aux données de Grand Lyon.(MySLQ)');
                echo 'Connection avec les données de grand lyon impossible';
            }
            return $jsonFileStation;
        }

        public function populateMysqlDB()
        {
            $conn = Database::getInstance();
            $conn->set_charset("utf8");
            if(!empty($conn)) {
                $stations = json_decode($this->getStationState(), true);
                $stationsV = $stations['values'];
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