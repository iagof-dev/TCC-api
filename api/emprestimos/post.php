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
                echo (json_encode(["status" => "error", "message" => "Um parâmetro inexistente foi enviado na requisição."]));
                die();
            }
        }

        if (in_array(false, $verify)) {
            echo (json_encode(["status" => "error", "message" => "Um parâmetro obrigatório está faltando."]));
            die();
        }

        $com .= implode(', ', $setClauses);
        $com .= ' WHERE id=' . intval($_POST['id']) . ';';

        break;

    case 'registrar':
        $verify = ["rm" => false, "id_livro" => false, "data_aluguel" => false, "id_status_emprestimo" => false, "prazo" => false];
        $temp_value = ["rm" => null, "id_livro" => null, "data_aluguel" => null, "id_status_emprestimo" => null, "prazo" => null];

        $com = "INSERT INTO emprestimos (";
        $valuesPart = "VALUES (";

        foreach ($_POST as $key => $value) {
            if (array_key_exists($key, $verify)) {
                $verify[$key] = true;
                $com .= $key . ",";
                $valuesPart .= "'" . $value . "',";
                $temp_value[$key] = $value;
            } else {
                echo json_encode(["status" => "error", "message" => "um parâmetro inexistente foi enviado na requisição."]);
                die();
            }
        }

        if (in_array(false, $verify)) {
            echo json_encode(["status" => "error", "message" => "um parâmetro obrigatório está faltando."]);
            die();
        }

        $com = rtrim($com, ",") . ") " . rtrim($valuesPart, ",") . ")";

        $com .= "; INSERT INTO avaliacoes values (default, LAST_INSERT_ID(),'". $temp_value['id_livro'] ."', '". $temp_value['rm'] ."', -1);";

        break;
}

echo ((new DB())->insert($com));
