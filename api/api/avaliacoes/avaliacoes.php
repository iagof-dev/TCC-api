<?php


if ($api == 'avalicoes' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'avalicoes' && $method == 'POST') {
    if(!(new cliente())->checkPermission())
    {
        ob_clean();
        echo(json_encode(["status" => "error", "message" => "Sem permissão!"]));
        die();
    }
    include_once("post.php");
}
