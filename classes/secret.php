<?php

class config{
  private $informations = [
    "db_ip" => "0.0.0.0", //colocar "mysql" de volta dps
    "db_port" => "3306",
    "db_user" => "n3rdydev",
    "db_pass" => "N3rdygamerbr@123",
    "db_name" => "tccapi",
    "imagesApiKey" => ""
  ];

  function get(){
    return $this->informations;
  }
}
