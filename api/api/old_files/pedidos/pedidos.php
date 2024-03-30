<?php



if ($api == 'pedidos' && $method == 'GET') {
    include_once("get.php");
}

if ($api == 'pedidos' && $method == 'POST') {
    include_once("post.php");
}


