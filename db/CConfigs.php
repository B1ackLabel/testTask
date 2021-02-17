<?php

class CConfigs
{
    private $PDO;


    function __construct($cfg)
    {
        $this->PDO = new PDO("mysql:host=". $cfg['host'] .";dbname=". $cfg['db_name'], $cfg['db_login'], $cfg['db_password']);
    }

    function getConfig($name){
        $query = $this->PDO->prepare("SELECT val FROM configs WHERE name = '$name'");
        $query->execute();
        $result = $query->fetch();
        return $result['val'];

    }

    function setConfig($name, $val) //edit to hide( 1 - true(hide) , 0 - false(show) )
    {
        $query = $this->PDO->prepare("UPDATE configs SET val=$val WHERE name = '$name'");
        return $query->execute();
    }
}
?>