<?php

$com = "";
$message = "";

switch ($action) {
    case 'registrar':
        $verify = ["id_aluno" => false,"id_emprestimo" => false,"data_envio" => false, "iteracao"=> false];
        $com = "INSERT INTO notificacoes (";
        foreach (array_keys($_POST) as $key) {
            if(array_key_exists($key, $verify)){
                $com .= $key . ",";
                $verify[$key] = true;
            }
            else{ echo(json_encode(["status" => "error", "message" => "um parâmetro inexistente foi enviado na requisição."])); die(); }
        }
        if (array_search(false, array_values($verify)) !== false) { echo(json_encode(["status" => "error", "message" => "um parâmetro obrigatório está faltando."])); die(); }
        $com = substr_replace($com, "", -1) . ") values (";

        foreach (array_values($_POST) as $value) { $com .= "'" . $value . "',"; }
        $com = substr_replace($com, "", -1) . ");";
        $message = "notificação registrada.";
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
