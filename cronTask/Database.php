<?php

require_once 'config/db_config.inc.php';

class Database
{
    private static $_instance;

    /**
     * Database constructor.
     */
    public function __construct(){}

    public function __destruct()
    {
        $this->closeConnectionMysql();
    }

    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new mysqli(PARAM_host.':'.PARAM_port, PARAM_user, PARAM_db_pass, PARAM_db_name)
                or die("Impossible de se connecter : " . mysqli_connect_error());
        }
        return self::$_instance;
    }

    public function closeConnectionMysql(){
        if(self::$_instance != null){
            mysqli_close(self::$_instance);
        }
    }
}