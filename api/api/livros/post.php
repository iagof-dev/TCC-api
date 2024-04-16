<?php
if (empty($_POST)) {
    echo (json_encode(["status" => "error", "message" => "Nenhum argumento foi passado"]));
    exit(0);
}
$com = "";
$message = "";

switch ($action) {
    case 'criar':

        //codigo
        //titulo
        //id_autor
        //id_editora
        //capa
        //volumes
        //sinopse

        $rs = "";
        break;

    case 'editar':

        break;


    case 'deletar':
        switch($param){
            case 'codigo':
                break;
            case 'id':
                break;
        }
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
