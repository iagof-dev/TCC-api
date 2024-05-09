<?php
switch ($action) {
    case 'id':
        $rs = $db->prepare("SELECT id, username, role, verified, pfp, description FROM users where id={$param};");
        break;
    case 'email':
        $rs = $db->prepare("SELECT id, username, role, verified, pfp, description FROM users where email='{$param}';");
        break;
    case 'name':
        $rs = $db->prepare("SELECT id, username, role, verified, pfp, description FROM users where username='{$param}';");
        break;
    default:
        $rs = $db->prepare("SELECT id, username, role, verified, pfp, description FROM  users;");
        break;
}
$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "Usuário inexistente!"]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}




?>