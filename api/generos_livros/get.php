<?php
$com = "";
$rs = "";
//SELECT GLI.id_livro, GLI.id_genero, li.titulo, g.genero FROM `generos_livros` as GLI INNER JOIN generos as g INNER JOIN livros as li WHERE GLI.id_livro = li.id AND GLI.id_genero = g.id;
//switch ($action) {
//    default:
//        $com .= ";";
//        break;
//}

$com = 'SELECT GLI.id_livro, GLI.id_genero, li.titulo, g.genero FROM `generos_livros` as GLI INNER JOIN generos as g INNER JOIN livros as li WHERE GLI.id_livro = li.id AND GLI.id_genero = g.id AND li.id='. $param . ';';


$rs = $db->prepare($com);

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
