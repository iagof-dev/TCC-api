<?php
$com = "";
$rs = "";


switch ($action) {
    case 'media':
        if($param == null){
            echo(json_encode(["status" => "error", "message" => "Informe o id do livro para consultar a média."]));
            return;
        }
        $com = ("SELECT COUNT(avaliacao) as avaliadores, AVG(avaliacao) as nota FROM avaliacoes WHERE id_livro = $param;");
        break;
    case 'listar':
    default:
        $com = ("SELECT * FROM avaliacoes as av INNER JOIN alunos as al where al.rm =av.rm_aluno;");
        break;
}

echo((new DB())->query($com));
