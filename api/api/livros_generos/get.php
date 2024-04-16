<?php
$com = "";
$rs = "";


// select li.id, li.codigo, li.titulo, li.capa,li.volumes, li.sinopse, g.genero from livro_generos as lg
// 		INNER JOIN livros as li
//         INNER JOIN generos as g
//         INNER JOIN autores as a
//         INNER JOIN editoras as e
//         WHERE lg.id_livro = li.id
//         AND lg.id_genero = g.id
//         AND li.id_autor = a.id
//         AND li.id_editora = e.id;

switch ($action) {
    default:
        $rs = $db->prepare("SELECT * FROM ;");
        break;
}

try{
    $rs->execute();
    $obj = $rs->fetchAll(PDO::FETCH_ASSOC);


    if(empty($obj)){
        echo json_encode(["status" => "error","DATA" => "dado não encontrado"]);
    }
    else{
        echo json_encode(["status" => "success","DATA" => $obj]);
    }
}
catch(Exception $e){
    echo($e->getMessage());
    die();
}
