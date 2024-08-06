<?php
$com = "";
$rs = "";

switch ($action) {
    default:
    case 'listar':
        $com = "select * from coordenadores;";
        break;
}

echo((new DB())->query($com));
