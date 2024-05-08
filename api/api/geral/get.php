<?php
$com = "";

$rs = $db->prepare("SELECT * FROM ". $action .";");

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);

if(empty($obj)){
	echo json_encode(["status" => "error","DATA" => "você precisa especificar uma tabela."]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
