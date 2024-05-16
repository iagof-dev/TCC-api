<?php
$com = "";
$rs = "";

switch ($action) {
    case 'media':
        if($param == null){
            echo(json_encode(["status" => "error", "message" => "Informe o id do livro para consultar a média."]));
            return;
        }
        $rs = $db->prepare("SELECT COUNT(avaliacao) as avaliadores, AVG(avaliacao) as nota FROM avaliacoes WHERE id_livro = $param;");
        break;
    case 'listar':
    default:
        $rs = $db->prepare("SELECT av.id, al.nome,av.avaliacao FROM avaliacoes as av INNER JOIN alunos as al WHERE av.rm_aluno=al.rm;");
        break;
}

try{
    $rs->execute();
    $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
    if(empty($obj)){
        echo json_encode(["status" => "error","DATA" => "Nenhum dado não encontrado!"]);
    }
    else{
        echo json_encode(["status" => "success","DATA" => $obj]);
    }
}
catch(Exception $e){
    echo($e->getMessage());
    die();
}
