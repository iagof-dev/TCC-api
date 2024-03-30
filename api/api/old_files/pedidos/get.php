<?php

switch ($action) {
    case 'id':
        $rs = $db->prepare("SELECT * FROM gateways WHERE id= :param");
        $rs->bindParam(':param', $param, PDO::PARAM_STR);
        break;
    case 'seller':
        $rs = $db->prepare("SELECT * FROM gateways WHERE seller_id = :param");
        $rs->bindParam(':param', $param, PDO::PARAM_STR);
        break;
    case 'customer':
        $rs = $db->prepare("SELECT * FROM gateways WHERE customer_id = :param");
        $rs->bindParam(':param', $param, PDO::PARAM_STR);
        break;
    default:
        $rs = $db->prepare("SELECT * FROM gateways");
        break;
}

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["status" => "success", "DATA" => $obj]);
?>
