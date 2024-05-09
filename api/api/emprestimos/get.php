<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        switch($param){
            case 'id':
            case 'rm':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.id_status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.rm_aluno = al.rm AND al.rm=$param2;");
                break;
            case 'livro':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.id_status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.rm_aluno = al.rm AND lo.id_livro=$param2; ");
                break;
            case 'pendentes':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.id_status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.rm_aluno = al.rm AND lo.id_status_livro=1;");
                break;    
            case 'atrasados':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.id_status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.rm_aluno = al.rm AND lo.id_status_livro=2;");
                break;
            case 'restituidos':
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.id_status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.rm_aluno = al.rm AND lo.id_status_livro=3;");
                break;
            case 'perdidos':
                break;
            default:
                $rs = $db->prepare("SELECT lo.id, al.rm, lv.titulo, lo.data_aluguel, lo.data_devolucao, lo.id_status_livro FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al WHERE lo.id_livro = lv.id AND lo.rm_aluno = al.rm;");
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
