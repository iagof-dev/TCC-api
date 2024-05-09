<?php


if ($api == 'geral' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'geral' && $method == 'POST') {
	echo (json_encode(["status" => "error", "message" => "Este parametro apenas aceita metodo GET"]));
	die();
}
