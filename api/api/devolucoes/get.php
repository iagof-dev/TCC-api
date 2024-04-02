<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        $rs = $db->prepare("select * from devolucoes;");
        break;
}

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "Usuário inexistente!"]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
