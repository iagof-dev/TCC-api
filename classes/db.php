<?php
require_once(__DIR__ . "/secret.php");
class DB
{
    private $db;

    function __construct()
    {
        if(!$this->isConnected()){
            $config_info = (new config())->get();
            $this->db = new PDO("mysql:host=". $config_info['db_ip'] .":". $config_info['db_port'] .";dbname=".$config_info['db_name'].";charset=UTF8", $config_info['db_user'], $config_info['db_pass']);
        }        
    }


    function isConnected(){
        if (isset($this->db) && $this->db instanceof PDO) {
            return true;
        }
        return false;
    }


    function getConnection()
    {
        return $this->db;
    }


    function query($sql)
    {
        try {
            $rs = $this->getConnection()->prepare($sql);
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
            if (empty($obj)) {
                return json_encode(["status" => "error", "DATA" => "Dado não encontrado."]);
            } else {
                return json_encode(["status" => "success", "DATA" => $obj]);
            }
        } catch (PDOException $e) {
            return (json_encode(["status" => "error", "message" => $e->getMessage()]));
        }
    }

    function insert($sql)
    {
        try {
            $rs = $this->getConnection()->prepare($sql);
            $rs->execute();
            $numRowsAffected = $rs->rowCount();
            return json_encode(['status' => 'success', 'message' => 'Registro inserido/modificado com sucesso', 'rows' => $numRowsAffected]);

        } catch (PDOException $ex) {
            return json_encode(['status'=> 'error', 'message' => $ex->getMessage()]);
        }
    }
}
