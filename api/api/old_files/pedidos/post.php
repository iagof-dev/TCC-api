<?php

$send = true;
$com = "";
$message = "";

switch ($action) {

    case "criar":
        if (empty($_POST)) {
            echo(json_encode(["status"=> "error", "message" => "Sem parâmetros"]));
            return;
        } 
        
        //PARAMETERS:
        //customer_id
        //seller_id
        //seller_product_id
        //customer_email
        //status
        //date
        $com = "insert into gateways (";
        foreach (array_keys($_POST) as $key) {
            $com .= $key . ",";
        }
        $com .= "id) values (";
        foreach (array_values($_POST) as $value) {
            $com .= "'" . $value . "',";
        }
        $id = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $com .= "'".$id . "');";
         

        $message = json_encode(["status" => "success", "message" => "pedido foi criado com sucesso", "id" => $id]);
        break;
    
    case "listar":

        $search = "";
        $search_value = "";

        foreach ($_POST as $key => $value) {
            if($key == 'cid'){
                $search = "customer_id";
                $search_value = $value;
            }
            if($key == 'sid'){
                $search = "seller_id";
                $search_value = $value;
            }
        }

        $com = "SELECT *, gt.status as pag_status, gt.id as pag_id FROM bytestore.gateways as gt
        inner join bytestore.products as pt
        on gt.seller_product_id = pt.id
        where " . $search ."=" . $search_value .";";
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Função não especificada."]);
        break;


}

if(!$send){
    echo $message;
    return;
    exit();
}


try {
    $rs = $db->prepare($com);
    $rs->execute();
    $numRowsAffected = $rs->rowCount();
    if ($numRowsAffected > 0) {
        if ($message != "") {
            echo $message;
            exit();
        }
        echo json_encode(["status" => "success", "message" => $rs->fetchAll(PDO::FETCH_ASSOC)]);
    } else {
        echo json_encode(["status" => "error", "message" => "Nenhuma alteração foi feita"]);
    }
} catch (Exception $ex) {
    echo json_encode(["status" => "error", "message" => $ex]);
}


