<?php


if ($api == 'alunos' && $method == 'GET') {
    include_once("get.php");
}
if ($api == 'alunos' && $method == 'POST') {
    include_once("post.php");
}
