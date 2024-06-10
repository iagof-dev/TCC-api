<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        $rs = $db->prepare("select * from cursos;");
        break;
}

echo((new DB())->query($com));
