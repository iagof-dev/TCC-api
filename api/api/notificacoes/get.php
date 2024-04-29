<?php
$com = "";
$rs = "";

switch ($action) {
    default:
    case 'listar':
        $com = "select * from notificacoes ";
        if($param == 'numero'){
            $com .= 'where numero="' . $param2 . '";';
        }
        else if($param == 'rm'){
            $com .= 'where id_aluno="' . $param2 . '";';
        }
        else{
            $com .= ';';
        }
        $rs = $db->prepare($com);
        break;
}

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "informacão não encontrada/inexistente."]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
