<?php


if ($api == 'categoria' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'categoria' && $method == 'POST') {
    include_once("post.php");
}
