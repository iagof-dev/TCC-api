<?php


if ($api == 'bibliotecarias' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'bibliotecarias' && $method == 'POST') {
    if(!(new cliente())->checkPermission())
    {
        echo(json_encode(["status" => "error", "message" => "Sem permissão!"]));
        die();
    }
    include_once("post.php");
}
