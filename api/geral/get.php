<?php
$com = "";

$rs = $db->prepare("SELECT * FROM ". $action .";");

echo((new DB())->query($com));
