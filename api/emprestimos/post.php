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
    case 'estender':
        if(empty($_POST['novo_prazo']) || empty($_POST['id_emprestimo'])){
            echo(json_encode(['status' => 'error', 'message' => 'Está faltando paramêtros necessários para concluir.']));
            die();
        }

        if($_POST['novo_prazo'] != 7 && $_POST['novo_prazo'] != 14){
            echo(json_encode(['status' => 'error', 'message' => 'Você não pode estender para ' . $_POST['novo_prazo'] . ' apenas poderá aumentar para 7 ou 14 dias.']));
            die();
        }

        $verification = 'SELECT * FROM emprestimos WHERE id=' . $_POST['id_emprestimo'] . ';';
        $isRenovavel = json_decode((new DB())->query($verification), true);
        if($isRenovavel['status'] != 'success'){
            echo(json_encode(['status' => 'error', 'message' => 'emprestimo não existe/encontrado.']));
            die();
        }
        
        if($isRenovavel['DATA']['0']['renovacao'] != 1){
            echo(json_encode(['status' => 'error', 'message' => 'Este emprestimo não é renovavel, necessita devolver.']));
            die();
        }

        $com = "UPDATE emprestimos SET prazo=". ($isRenovavel['DATA']['0']['prazo'] + $_POST['novo_prazo']) . ', renovacao=0 WHERE id=' . $_POST['id_emprestimo'] . ';';
        break;
}

echo ((new DB())->insert($com));
