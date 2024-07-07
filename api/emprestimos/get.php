<?php
$com = "SELECT lo.id, al.rm as aluno_rm, al.nome as aluno_nome, lv.titulo, at.id as autor_id, at.nome as autor_nome,lo.data_aluguel, lo.prazo, SL.estado FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al INNER JOIN estado_emprestimos as SL INNER JOIN autores as at WHERE lo.id_livro = lv.id AND lo.rm = al.rm AND SL.id = lo.id_status_emprestimo AND lv.id_autor = at.id";
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
                $com .= " ORDER BY lo.data_aluguel DESC;";
                break;
        }
        break;
        
}

echo((new DB())->query($com));
