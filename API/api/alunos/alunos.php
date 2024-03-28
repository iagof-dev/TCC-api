<?php


if ($api == 'alunos' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'alunos' && $method == 'POST') {
    if(!(new cliente())->checkPermission())
    {
        ob_clean();
        echo(json_encode(["status" => "error", "message" => "Sem permissão!"]));
    }
    include_once("post.php");
}
