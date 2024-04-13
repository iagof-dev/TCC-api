<?php
$com = "";
$rs = "";

switch ($action) {
    default:
        $rs = $db->prepare("SELECT al.rm, al.nome, al.telefone, c.ano, c.curso, c.periodo FROM alunos as al INNER JOIN cursos as c WHERE al.id_curso = c.id;");
        break;
    case 'rm':
        $rs = $db->prepare("SELECT al.rm, al.nome, al.telefone, c.ano, c.curso, c.periodo FROM alunos as al INNER JOIN cursos as c WHERE al.id_curso = c.id AND al.rm='$param';");
        break;
    case 'telefone':
        $rs = $db->prepare("SELECT al.rm, al.nome, al.telefone, c.ano, c.curso, c.periodo FROM alunos as al INNER JOIN cursos as c WHERE al.id_curso = c.id and al.telefone ='$param';");
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
