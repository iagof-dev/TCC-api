<?php
$com = "SELECT lo.id, al.rm, al.nome, lv.titulo, at.autor,lo.data_aluguel, lo.prazo, SL.estado FROM emprestimos as lo INNER JOIN livros as lv INNER JOIN alunos as al INNER JOIN estado_emprestimos as SL INNER JOIN autores as at WHERE lo.id_livro = lv.id AND lo.rm = al.rm AND SL.id = lo.id_status_emprestimo AND lv.id_autor = at.id";
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
            case 'pendentes':
                $com .= " AND lo.id_status_livro=1;";
                break;    
            case 'atrasados':
                $com .= " AND lo.id_status_livro=2;";
                break;
            case 'restituidos':
                $com .= " AND lo.id_status_livro=3;";
                break;
            case 'perdidos':
                break;
            default:
                $com .= ";";
                break;
        }
        break;
        
}

$rs = $db->prepare($com);
$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "Nenhum dado registrado!"]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
