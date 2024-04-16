<?php
$com = "";
$rs = "";

switch ($action) {
    default:
        $rs = $db->prepare("SELECT * FROM bibliotecarias;");
        break;
}

try{
    $rs->execute();
    $obj = $rs->fetchAll(PDO::FETCH_ASSOC);


    if(empty($obj)){
        echo json_encode(["status" => "error","DATA" => "dado não encontrado"]);
    }
    else{
        echo json_encode(["status" => "success","DATA" => $obj]);
    }
}
catch(Exception $e){
    echo($e->getMessage());
    die();
}
