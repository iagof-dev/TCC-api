<?php

class config{
  private $informations = [
    "db_ip" => "127.0.0.1", //colocar "mysql" de volta dps
    "db_port" => "3306",
    "db_user" => "root",
    "db_pass" => ""
  ];

  function get(){
    return $this->informations;
  }
}
