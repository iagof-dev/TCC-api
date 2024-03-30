<?php
if (empty($_POST)) {
    echo (json_encode(["status" => "error", "message" => "Nenhum argumento foi passado"]));
    exit(0);
}
$com = "";
$message = "";


switch ($action) {
    case "inserir":
        $com = "insert into category (";
        foreach (array_keys($_POST) as $key) {
            
            $com .= $key . ",";
        }
        $com = substr_replace($com, "", -1) . ") values (";
        foreach (array_values($_POST) as $value) {
            $com .= "'" . $value . "',";
        }
        $com = substr_replace($com, "", -1) . ");";
        $message = "Categoria criada com sucesso!";
        break;
    case "remover":
        break;
    case "modificar":
        break;
}


try {
    $rs = $db->prepare($com);
    $rs->execute();
    $numRowsAffected = $rs->rowCount();
    if ($numRowsAffected > 0) {
        if($message != ""){
            echo json_encode(["status" => "success", "message" => $message]);
            exit();
        }
        echo json_encode(["status" => "success", "message" => $rs->fetchAll(PDO::FETCH_ASSOC)]);
    } else {
        echo json_encode(["status" => "error", "message" => "Nenhuma alteração foi feita"]);
    }
} catch (Exception $ex) {
    echo json_encode(["status" => "error", "message" => $ex]);
}
