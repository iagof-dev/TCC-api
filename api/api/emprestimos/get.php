<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        switch($param){
            case 'rm':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.id_aluno = al.rm AND al.rm=$param2;");
                break;
            case 'livro':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.id_aluno = al.rm AND lo.id_livro=$param2; ");
                break;
            case 'pendentes':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.id_aluno = al.rm AND lo.status_livro='pendente';");
                break;
            default:
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.id_aluno = al.rm;");
                break;
        }
        break;
        
}

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "Nenhum dado registrado!"]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
