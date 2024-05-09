<?php


if ($api == 'pagamentos' && $method == 'GET') {
    echo json_encode(["status" => "error", "message" => "Apenas metodo POST."]);
}
if ($api == 'pagamentos' && $method == 'POST') {
    include_once("post.php");
}
