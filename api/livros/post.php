<?php
$com = "";
$message = "";

switch ($action) {
    case 'criar':

        $verify = ["codigo" => false,"titulo" => false,"id_autor" => false, "id_editora"=> false, "capa" => false, "volumes" => false, "sinopse" => false];
        
        $com = "insert into livros (";
        foreach (array_keys($_POST) as $key) {

            if(array_key_exists($key, $verify)){
                $verify[$key] = true;
                $com .= $key . ",";
            }
            else{ echo(json_encode(["status" => "error", "message" => "um parâmetro inexistente foi enviado na requisição."])); die(); }
        }
        if (array_search(false, array_values($verify)) !== false) { echo(json_encode(["status" => "error", "message" => "um parâmetro obrigatório está faltando."])); die(); }


        $com = substr_replace($com, "", -1) . ") values (";
        foreach (array_values($_POST) as $value) {
            $com .= "'" . $value . "',";
        }
        $com = substr_replace($com, "", -1) . ");";


        break;

    case 'modificar':
        $com = "update livros set ";
        $id = 0;
        foreach (array_combine(array_keys($_POST), array_values($_POST)) as $key => $value) {
            if (strtolower($key) == 'id') {
                $id = $value;
            } else {
                $com .= $key . "='" . $value . "', ";
            }
        }
        if($id == 0){
            echo(json_encode(["status" => "error", "message" => "Identificador do livro não informado."]));
            die();
        }
        $com = substr($com, 0, -2);
        $com .= " where id=" . $id . ";";
        $message = "Informações do livro foi alterada.";
        break;


    case 'deletar':
        $ready = false;
        $com = "delete from livros where ";
        switch($param){
            case 'codigo':
                foreach (array_combine(array_keys($_POST), array_values($_POST)) as $key => $value) {
                    if (strtolower($key) == 'codigo') {
                        $com .= "codigo='" . $id . "';";
                        $ready = true;
                    }
                }
                break;
            case 'id':
                foreach (array_combine(array_keys($_POST), array_values($_POST)) as $key => $value) {
                    if (strtolower($key) == 'id') {
                        $com .= "id=" . $value . ";";
                        $ready = true;
                    }
                }
                break;
        }
        if(!$ready){
            echo(json_encode(["status" => "error", "message" => "Identificador do livro não informado."]));
            die();
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