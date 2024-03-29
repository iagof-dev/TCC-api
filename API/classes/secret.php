<?php

class config{
  private $informations = [
    "db_ip" => "n3rdydev.cloud", //colocar "mysql" de volta dps
    "db_port" => "3306",
    "db_user" => "nrdydev1_admin",
    "db_pass" => "N3rdygamerbr@123"
  ];

  function get(){
    return $this->informations;
  }
}
