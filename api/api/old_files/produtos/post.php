<?php
$com = "";
$message = "";

switch ($action) {
    case "criar":
        $com = "insert into products (";

        foreach (array_keys($_POST) as $key) {
            $com .= $key . ",";
        }
        $com = substr_replace($com, "", -1);
        $com .= ") values (";
        foreach (array_values($_POST) as $value) {
            $com .= "'" . $value . "',";
        }
        $com = substr_replace($com, "", -1);
        $com .= ");";
        break;

    case "modificar":
        $com = "update products set ";
        $id = 0;
        foreach (array_combine(array_keys($_POST), array_values($_POST)) as $key => $value) {
            if (strtolower($key) == 'id') {
                $id = $value;
            } else {
                $com .= $key . "='" . $value . "', ";
            }
        }
        $com = substr($com, 0, -2);
        $com .= " where id='" . $id . "';";
        break;

    case "deletar":
        $id = 0;
        foreach (array_combine(array_keys($_POST), array_values($_POST)) as $key => $value) {
            if (strtolower($key) == 'id') {
                $com = "delete from products where id='{$value}';";
            }
        }
        break;
}


try {
    $rs = $db->prepare($com);
    $rs->execute();
    $numRowsAffected = $rs->rowCount();
    if ($numRowsAffected > 0) {
        if ($message != "") {
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
