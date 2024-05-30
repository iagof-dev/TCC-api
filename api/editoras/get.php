<?php
$com = "SELECT * FROM editoras;";
$rs = "";


if($action != 'listar'){

    echo(json_encode(['status' => 'error', 'message' => 'Parametro não encontrado.']));
    die();
}

$rs = $db->prepare($com);

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
