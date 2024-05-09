<?php

if ($api == 'usuario' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'usuario' && $method == 'POST') {
    include_once("post.php");
}
