<?php
$com = "";
$rs = "";

if(empty($param)){
	echo(json_encode(['status' => 'error', 'message'=>'Informe o campo ID']));
	die();
}

$com = 'SELECT GLI.id_livro, GLI.id_genero, li.titulo, g.genero FROM `generos_livros` as GLI LEFT JOIN generos as g LEFT JOIN livros as li WHERE GLI.id_livro = li.id AND GLI.id_genero = g.id AND li.id='. $param . ';';


echo((new DB())->query($com));
