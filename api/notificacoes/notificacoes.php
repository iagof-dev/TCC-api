<?php


if ($api == 'notificacoes' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'notificacoes' && $method == 'POST') {
    
    if(!(new cliente())->checkPermission())
    {
        ob_clean();
        http_response_code(400);
        echo(json_encode(["status" => "error", "message" => "Sem permissão!"]));
        die();
    }
    if (empty($_POST)) {
        http_response_code(400);
        echo (json_encode(["status" => "error", "message" => "Nenhum argumento foi passado"]));
        die();
    }
    include_once("post.php");
}
