<?php


if ($api == 'livros_generos' && $method == 'GET') {
    if (empty($_POST)) {
        echo (json_encode(["status" => "error", "message" => "Nenhum argumento foi passado"]));
        die();
    }
    include_once("get.php");
}
if ($api == 'livros_generos' && $method == 'POST') {
    if(!(new cliente())->checkPermission())
    {
        echo(json_encode(["status" => "error", "message" => "Sem permissão!"]));
        die();
    }
    if (empty($_POST)) {
        echo (json_encode(["status" => "error", "message" => "Nenhum argumento foi passado"]));
        die();
    }
    include_once("post.php");
}
