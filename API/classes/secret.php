<?php

class config{
  private $informations = [
    "db_ip" => "mysql", //colocar "mysql" de volta dps
    "db_port" => "3306",
    "db_user" => "root",
    "db_pass" => "132490Kj@br="
  ];

  function get(){
    return $this->informations;
  }
}
