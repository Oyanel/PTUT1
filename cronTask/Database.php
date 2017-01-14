<?php

require_once 'config/db_config.inc.php';

class Database
{
    private $connectionOracle;
    private $connectionMysql;

    /**
     * Database constructor.
     */
    public function __construct(){}

    public function __destruct()
    {
        //$this->closeConnectionOracle();
        $this->closeConnectionMysql();
    }

    /**
     * @return mixed
     */
    public function getConnectionOracle()
    {
        if($this->connectionOracle == null) {
            $oraDB = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP) (HOST=localhost)(PORT=1521))(CONNECT_DATA=(SID=orapeda1)))";
            $conn = oci_connect(DB_USER, DB_PASSWORD, $oraDB, 'AL32UTF8');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                return null;
            }
            echo 'Connected to the DataBase';
            $this->setConnectionOracle($conn);
        }
        return $this->connectionOracle;
    }

    public function getConnectionMysql(){
        if($this->connectionMysql == null){
            $conn = new mysqli(PARAM_host.':'.PARAM_port, PARAM_user, PARAM_db_pass, PARAM_db_name)
            or die("Impossible de se connecter : " . mysqli_connect_error());
            $this->setConnectionMysql($conn);
        }
        return $this->connectionMysql;
    }

    public function closeConnectionMysql(){
        if($this->connectionMysql != null){
            mysqli_close($this->getConnectionMysql());
        }
    }

    public function closeConnectionOracle(){
        if($this->connectionMysql != null){
            oci_close($this->getConnectionOracle());
        }
    }

    /**
     * @param mixed $connection
     */
    public function setConnectionOracle($connection)
    {
        $this->connectionOracle = $connection;
    }

    /**
     * @param mixed $connectionMysql
     */
    public function setConnectionMysql($connectionMysql)
    {
        $this->connectionMysql = $connectionMysql;
    }

}