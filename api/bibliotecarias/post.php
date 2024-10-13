<?php
$com = "";
$message = "";

switch ($action) {
    case 'criar':

        if(!isset($_POST['nome'])){
            echo(json_encode(['status' => 'success', 'message' => 'Campo nome não está definido.']));
            die();
        }


        $com = "INSERT INTO bibliotecarias (";
        $values = "";
        foreach ($_POST as $key => $value) {
            $com .= $key . ",";
            $values .= "'" . $value . "',";
        }
        $com = rtrim($com, ',') . ") VALUES (";
        $values = rtrim($values, ',') . ");";
        $com .= $values;
        break;

    default:
        echo(json_encode(["status" => "error", "message" => "função não definida."]));
        break;
}

echo((new DB())->insert($com));
