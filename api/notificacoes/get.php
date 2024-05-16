<?php
$com = "";
$rs = "";

switch ($action) {
    default:
    case 'listar':
        $com = "select nt.id, nt.rm_aluno, nt.data_envio, nt.iteracao, lo.data_aluguel, lo.data_devolucao, lo.prazo, li.codigo, li.titulo, al.nome as aluno_nome, al.telefone, lost.estado, cs.curso from notificacoes as nt INNER JOIN emprestimos as lo INNER JOIN livros as li INNER JOIN alunos as al INNER JOIN estado_emprestimos as lost INNER JOIN cursos as cs WHERE nt.rm_aluno = al.rm AND nt.id_emprestimo = lo.id AND lo.id_livro = li.id AND al.id_curso = cs.id AND lo.id_status_livro = lost.id";
        if($param == 'numero'){
            $com .= ' AND al.telefone = ' . $param2 . ';';
        }
        if($param == 'rm'){
            $com .= ' AND al.rm = ' . $param2 . ';';
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