<?php
if (empty($_POST)) {
    echo (json_encode(["status" => "error", "message" => "Nenhum argumento foi passado"]));
    exit(0);
}
$com = "";
$message = "";

switch ($action) {
    case 'criar':
        $usuario = false;
        $email = false;
        $senha = false;
        $cargo = false;
        foreach (array_keys($_POST) as $key) {
            if ($key == 'username') {
                $usuario = true;
            }
            if ($key == 'email') {
                $email = true;
            }
            if ($key == 'pass') {
                $senha = true;
            }
            if ($key == 'role') {
                $cargo = true;
            }
        }

        if ($usuario == false || $email == false || $senha == false) {
            echo (json_encode(["status" => "error", "message" => "falta argumentos"]));
            exit;
        }
        $com = "INSERT INTO users (";
        foreach (array_keys($_POST) as $key) {
            
            $com .= $key . ",";
        }
        $com = substr_replace($com, "", -1) . ") values (";

        foreach (array_values($_POST) as $value) {
            $com .= "'" . $value . "',";
        }
        $com = substr_replace($com, "", -1) . ");";
        $message = "Usuário criado com sucesso!";
        break;

    case "modificar":
        $com = "update users set ";
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
        $message = "Usuário modificado com sucesso!";
        break;

    case "deletar":
        $com = "delete from users where id='";
        foreach (array_keys($_POST) as $key) {
            if (strtolower($key) != 'id') {
                echo (json_encode(["status" => "error", "message" => "Para deletar um usuário necessita do ID"]));
                exit;
            }
        }
        foreach (array_values($_POST) as $value) {
            $com .= $value . "';";
        }
        $message = "Usuário deletado com sucesso!";
        break;

    case "logar":
        $com = "select * from users where ";
        foreach (array_combine(array_keys($_POST), array_values($_POST)) as $key => $value) {
            $com .= $key . "='" . $value . "' and ";
        }
        $com = substr($com, 0, -5);
        $com .= ";";
        $message = '';
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
