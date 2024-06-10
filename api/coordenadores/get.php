<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        $rs = $db->prepare("select * from coordenadores;");
        break;
}

echo((new DB())->query($com));
