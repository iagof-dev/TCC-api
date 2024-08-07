<?php
$com = "";
$rs = "";

switch ($action) {
    default:
    case 'listar':
        $com = "SELECT coo.id AS coordenador_id, coo.nome AS nome, coo.telefone, cu.id as id_curso, cu.ano, cu.curso, cu.periodo FROM coordenadores AS coo INNER JOIN coordenador_cursos AS cou INNER JOIN cursos AS cu WHERE cou.id_coordenador = coo.id AND cu.id = cou.id_curso;";
        break;
}

echo((new DB())->query($com));
