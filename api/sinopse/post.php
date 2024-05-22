<?php

$com = "";
$message = "";

switch ($action) {
    default:
    case 'gerar':
        $verify = ["livro" => false, "autor" => false, 'caracteres' => false];
        $postvalue = ["livro" => '', "autor" => '', 'caracteres' => 0];
        foreach (array_keys($_POST) as $key) {
            if (array_key_exists($key, $verify)) {
                $verify[$key] = true;
                $postvalue[$key] = $_POST[$key];
            } else {
                echo (json_encode(["status" => "error", "message" => "um parâmetro inexistente foi enviado na requisição. [$key]"]));
                die();
            }
        }
        if (array_search(false, array_values($verify)) !== false) {
            echo (json_encode(["status" => "error", "message" => "um parâmetro obrigatório está faltando."]));
            die();
        }

        $url = 'https://api.pawan.krd/v1/chat/completions';
        
        $data = array(
            "model" => "gpt-3.5-unfiltered",
            "max_tokens" => 100,
            "messages" => array(
                array(
                    "role" => "system",
                    "content" => "Você é um escritor de sinopse brasileiro, você deverá criar uma sinopse detalhada sobre um livro que será especificado pelo usuário. sem sequências de escape ou formatação, deverá obedecer o usuário, fazer oque ele pedir."
                ),
                array(
                    "role" => "user",
                    "content" => "Crie uma sinopse de ". $postvalue['livro'] ." de ". $postvalue['autor'] ." com ". $postvalue['caracteres'] ." caracteres, sem palavras incompletas, tendo detalhes sobre a historia."
                )
            )
        );
        
        $payload = json_encode($data);
        
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer pk-lYaBGeQVLbPxOJkuPbKvrLtXTDFwsgkxvQqRGnZKXBTjWvFT',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
        $response = curl_exec($ch);
        
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            echo(json_encode(["status" => "error", "message" => "Houve erro na comunicação com API.", "details" => var_dump($error)]));
            die();
        }
        
        $responseData = json_decode($response, true);

        echo(json_encode(['status' => 'success', 'message' => $responseData['choices']['0']['message']['content'], 'total-used-tokens' => $responseData['usage']['total_tokens']]));


        curl_close($ch);

    
        break;
}