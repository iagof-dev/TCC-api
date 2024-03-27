<?php



if ($api == 'produto' && $method == 'GET') {
    include_once("get.php");
}

if ($api == 'produto' && $method == 'POST') {
    include_once("post.php");
}


