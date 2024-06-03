<?php

$com = "";
$message = "";

switch ($action) {
    case 'inserir':
        $com = "INSERT INTO generos_livros (";
        $values = "";
        foreach ($_POST as $key => $value) {
            $com .= $key . ",";
            $values .= "'" . $value . "',";
        }
        $com = rtrim($com, ',') . ") VALUES (";
        $values = rtrim($values, ',') . ");";
        $com .= $values;
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