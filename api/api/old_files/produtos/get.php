<?php

$rs;
switch ($action) {
    case 'id':
        $rs = $db->prepare("SELECT * FROM products where ID={$param};");
        break;
    case 'owner':
        $rs = $db->prepare("SELECT * FROM products WHERE OWNER='{$param}';");
        break;
    case 'search':
        $format = str_replace("+", " ", $param);
        $rs = $db->prepare("SELECT * FROM products WHERE title LIKE '%{$format}%';");
        break;
    default:
        $rs = $db->prepare("SELECT * FROM products;");
        break;
}
$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["DATA" => $obj]);

