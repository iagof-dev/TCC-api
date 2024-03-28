<?php
class DB
{

    private $host;
    private $port;
    private $user;
    private $pass;
    private $db;


    function __construct()
    {
        require_once(__DIR__ . "/secret.php");
        $config = new config();
        $config_info = $config->get();
        $this->host = $config_info['db_ip'];
        $this->port = $config_info['db_port'];
        $this->user = $config_info['db_user'];
        $this->pass = $config_info['db_pass'];
    }


    function connect($database)
    {
        return new PDO("mysql:host={$this->host}:{$this->port};dbname={$database};charset=UTF8", $this->user, $this->pass);
    }

}
