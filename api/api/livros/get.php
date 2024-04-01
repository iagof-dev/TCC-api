<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        switch ($param){

            case "genero":
                // select with inner join
                $rs = $db->prepare("select * from livros;");
                break;

            default:
            $rs = $db->prepare("select * from livros;");
            break;
        }
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
