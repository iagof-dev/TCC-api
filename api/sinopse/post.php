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
		$headers = [
			'Authorization: Bearer pk-lYaBGeQVLbPxOJkuPbKvrLtXTDFwsgkxvQqRGnZKXBTjWvFT',
			'Content-Type: application/json',
		];
		$data = [
			"model" => "pai-001",
			"max_tokens" => 1000,
			"messages" => [
				[
					"role" => "system",
					"content" => "Você é um escritor de sinopses para livros, da nacionalidade brasileiro, você deverá criar uma sinopse detalhada sobre um livro que será especificado pelo usuário. sem sequências de escape ou formatação, sem palavras incompletas, respeitando a quantidade de caracteres dado pelo o usuário, você deve dar detalhes sobre o livro dizendo os personagens, etc. você deve entregar sinopse com continuidade, sem frases sem continuidade"
				],
				[
					"role" => "user",
					"content" => "Crie uma sinopse de ". $postvalue['livro'] ." de ". $postvalue['autor'] ." com ". $postvalue['caracteres'] ." caracteres."
				]
			]
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$response = curl_exec($ch);
		curl_close($ch);
		

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            echo(json_encode(["status" => "error", "message" => "Houve erro na comunicação com API.", "details" => $error]));
            die();
        }
        $responseData = json_decode($response, true);
		if(isset($responseData['status']) && $responseData['status']== false){
			echo (json_encode(['status' => 'error', 'message' => 'Houve um erro na resposta da API (openai-3.5-gpt-turbo)', 'total-used-tokens' => 0]));
			die();
		}

        echo(json_encode(['status' => 'success', 'message' => $responseData['choices']['0']['message']['content'], 'total-used-tokens' => $responseData['usage']['total_tokens']]));


        curl_close($ch);

    
        break;
}
