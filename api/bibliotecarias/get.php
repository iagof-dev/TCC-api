<?php
$com = "";
$rs = "";

switch ($action) {
    default:
        $rs = $db->prepare("SELECT * FROM bibliotecarias;");
        break;
}

echo((new DB())->query($com));
