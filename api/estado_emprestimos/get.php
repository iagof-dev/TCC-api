<?php
$com = "SELECT * FROM estado_emprestimos";
$rs = "";

switch ($action) {
	case 'listar':
    default:
        $com .= ";";
        break;
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
