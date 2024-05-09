<?php
$com = "SELECT l.id, l.codigo, l.titulo, l.capa, a.autor, e.editora, g.genero FROM livros as l inner join autores as a inner join editoras as e inner join livros_generos as lg inner join generos as g where l.id_autor = a.id and l.id_editora = e.id and lg.id_genero = g.id and lg.id_livro = l.id";
$rs = "";

switch ($action) {
    case 'listar':
        switch ($param){
            case "genero": 
                $com .= " AND lg.id_genero='$param2';";
                break;
            case 'codigo':
                $com .= " AND l.codigo = '$param2';";
                break;
            default:
                $com .= ';';
                break;
        }
        break;
    case 'editar':
        break;
    default:
        $com .= ';';
        break;
}

$rs = $db->prepare($com);

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "dado não encontrado"]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
