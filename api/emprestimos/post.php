<?php
$com = "";
$message = "";

switch ($action) {
    case 'modificar':
        $verify = ["id" => false, "id_status_emprestimo" => false];
        
        $com = "UPDATE emprestimos SET ";
        $setClauses = [];
        
        foreach ($_POST as $key => $value) {
            if (array_key_exists($key, $verify)) {
                $verify[$key] = true;
                if ($key !== 'id') {
                    $setClauses[] = "$key = '" . addslashes($value) . "'";
                }
            } else {
                echo(json_encode(["status" => "error", "message" => "Um parâmetro inexistente foi enviado na requisição."]));
                die();
            }
        }
        
        if (in_array(false, $verify)) {
            echo(json_encode(["status" => "error", "message" => "Um parâmetro obrigatório está faltando."]));
            die();
        }
        
        $com .= implode(', ', $setClauses);
        $com .= ' WHERE id=' . intval($_POST['id']) . ';';
        
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
