<?php
$com = "SELECT al.rm, al.nome, al.telefone, c.ano, c.curso, c.periodo FROM alunos as al INNER JOIN cursos as c WHERE al.id_curso = c.id";

switch ($action) {
    default:
        $com .= ";";
        break;
    case 'rm':
        $com .= " AND al.rm='$param';";
        break;
    case 'telefone':
        $com .= " AND al.telefone ='$param';";
        break;
}

echo((new DB())->query($com));