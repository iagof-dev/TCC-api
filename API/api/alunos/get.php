<?

$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        $rs = $db->prepare("select * from category;");
        break;
}
