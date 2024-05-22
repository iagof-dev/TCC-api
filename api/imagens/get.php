<?php
require(__DIR__ . '/../../classes/ImageBySearchEngine.php');


try {											// PESQUISA, QUANTIDADE, MOTOR DE BUSCA (google/bing)
	$images = (new ImageBySearchEngine())->search($param, '4', $action);
	$data = array(); 

    if (count($images) === 0) {
		echo(json_encode(["status" => "error", "message" => "Nenhuma imagem foi encontrada"]));
		die();
    }
    $data["images"] = $images;
} catch (Exception $e) {
	echo(json_encode(["status" => "error", "message" => "Nenhuma imagem foi encontrada", "c" => $e]));
	die();

}

echo json_encode($data);
