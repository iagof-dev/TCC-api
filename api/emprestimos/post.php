<?php
$com = "";
$message = "";

switch ($action) {
    case 'modificar':
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
	case 'registrar':
        $verify = ["rm" => false,"id_bibliotecaria" => false,"id_livro" => false, "data_aluguel"=> false, "id_status_emprestimo" => false, "prazo" => false];
        
        $com = "insert into emprestimos (";
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

		echo($com);
		die();

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
