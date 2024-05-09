<?php
$com = "SELECT al.rm, al.nome, al.telefone, c.ano, c.curso, c.periodo FROM alunos as al INNER JOIN cursos as c WHERE al.id_curso = c.id";
$rs = "";

switch ($action) {
    default:
        $com .= ";";
        break;
    case 'rm':
        $com .= " AND al.rm='$param';";
        break;
    case 'telefone':
        $com .= " AND al.telefone ='$param';";
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
