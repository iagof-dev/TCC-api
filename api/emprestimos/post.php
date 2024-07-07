<?php
$com = "";
$message = "";

switch ($action) {
    case 'modificar':
        // $id_livro = 0;
        // $id_status = 0;
        // //$rs = $db->prepare("");
        // $com = "UPDATE emprestimos set id_status_livro=";
        // foreach ($_POST as $key => $value) {
        //     if($key == 'id_livro'){
        //         $id_livro = $value;
        //     }
        //     if($key == 'status'){
        //         $id_status = $value;
        //     }
        // }
        // $com .= $id_status;
        // $com .= " WHERE id_livro=" . $id_livro . ";";
        echo(json_encode(["status" => "error", "message" => "Código ruim, não implementado."]));
        die();
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
		break;
}

echo((new DB())->insert($com));
