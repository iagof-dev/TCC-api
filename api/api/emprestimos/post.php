<?php
$com = "";
$message = "";

switch ($action) {
    case 'alterar':
        $id_livro = 0;
        $id_status = 0;
        //$rs = $db->prepare("");
        $com = "UPDATE emprestimos set id_status_livro=";
        foreach ($_POST as $key => $value) {
            if($key == 'id_livro'){
                $id_livro = $value;
            }
            if($key == 'status'){
                $id_status = $value;
            }
        }
        $com .= $id_status;
        $com .= " WHERE id_livro=" . $id_livro . ";";
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
