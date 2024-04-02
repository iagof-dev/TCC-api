<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
date_default_timezone_set("America/Sao_Paulo");
if (isset($_GET['path'])) {
    $path = explode("/", $_GET['path']);
} else {
    echo json_encode(["status" => "Sem parâmetros!"]);
    die();
}
if (isset($path[0])) {
    $api = $path[0];
}
if (isset($path[1])) {  
    $action = $path[1];
}
if (isset($path[2])) {
    $param = $path[2];
}
if(isset($path[4])){
    $param2 = $path[4];
}
if ($api == '') {
    echo json_encode(["data" => "Especifique a função"]);
}

//                $api  $action $param $param2
//    localhost/usuario/localizar/add/1

$method = $_SERVER['REQUEST_METHOD'];


#Classes
include_once("classes/db.php");
include_once("classes/secret.php");
include_once("classes/usuario.php");



//

$db = (new DB())->connect("SGDB");

#API
include_once("./api/alunos/alunos.php");

?>