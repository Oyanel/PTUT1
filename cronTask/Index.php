<?php

require_once 'config/config.php';
include 'Velov.php';

class main
{
    public function run(){
        echo 'Lancement de la récupération de la chaine'."\r\n";

        $this->createLogs('Lancement de la récupération des données');
        $velovStation = new Velov();
        //$velovStation->populateOracleDB();
        $velovStation->populateMysqlDB();
        $this->createLogs('Fin de la récupération des données');

        echo 'Fin de la récupération de la chaine'."\r\n";
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

$velovProject = new main();
$velovProject->run();