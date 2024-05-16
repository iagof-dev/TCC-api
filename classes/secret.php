<?php

class config{
  private $informations = [
    "db_ip" => "marciossupiais.shop", //colocar "mysql" de volta dps
    "db_port" => "3306",
    "db_user" => "n3rdydev",
    "db_pass" => "N3rdygamerbr@123"
  ];

  function get(){
    return $this->informations;
  }
}
