<?php
$com = "SELECT lo.id, al.rm as aluno_rm, al.nome as aluno_nome, al.telefone as aluno_telefone,lv.id as livro_id, lv.titulo as livro_titulo, at.id as autor_id, at.nome as autor_nome,lo.data_aluguel, av.id as avaliacao_id, lo.prazo, SL.estado, lo.renovacao as renovavel, av.avaliacao FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al INNER JOIN estado_emprestimos as SL INNER JOIN autores as at INNER JOIN avaliacoes as av WHERE lo.id_livro = lv.id AND lo.rm = al.rm AND SL.id = lo.id_status_emprestimo AND lv.id_autor = at.id AND av.id_emprestimo = lo.id";
$rs = "";


switch ($action) {
    case 'listar':
        switch($param){
            case 'id':
            case 'rm':
                $com .= " AND al.rm=$param2;";
                break;
            case 'livro':
                $com .= " AND lo.id_livro=$param2;";
                break;
            case 'status':
                $com .= " AND lo.id_status_emprestimo=$param2;";
                break;    
            default:
                $com .= " ORDER BY CASE WHEN lo.id_status_emprestimo IN (1, 2) THEN 0 ELSE 1 END, lo.data_aluguel DESC, lo.id DESC;";
                break;
        }
        break;
        
}

echo((new DB())->query($com));
