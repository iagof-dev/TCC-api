<?php
$com = "";
$rs = "";

switch ($action) {
    case 'listar':
        switch ($param){
            case "genero":
                $rs = $db->prepare("SELECT l.id, l.codigo, l.titulo, a.autor, e.editora, g.genero FROM livros as l inner join autores as a inner join editoras as e inner join livro_generos as lg inner join generos as g where l.id_autor = a.id and l.id_editora = e.id and lg.id_genero = g.id and lg.id_livro = l.id and lg.id_genero='$param2';");
                break;
            case "codigo":
                $rs = $db->prepare("SELECT l.id, l.codigo, l.titulo, a.autor, e.editora, g.genero FROM livros as l inner join autores as a inner join editoras as e inner join livro_generos as lg inner join generos as g where l.id_autor = a.id and l.id_editora = e.id and lg.id_genero = g.id and lg.id_livro = l.id and l.codigo = '$param2';");
                break;
            default:
                $rs = $db->prepare("SELECT l.id, l.codigo, l.titulo, a.autor, e.editora, g.genero FROM livros as l inner join autores as a inner join editoras as e inner join livro_generos as lg inner join generos as g WHERE l.id_autor = a.id and l.id_editora = e.id and lg.id_genero = g.id and lg.id_livro = l.id;");
                break;
        }
        break;
    case 'editar':
        break;
    default:
        $rs = $db->prepare("SELECT l.id, l.codigo, l.titulo, a.autor, e.editora, g.genero FROM livros as l inner join autores as a inner join editoras as e inner join livro_generos as lg inner join generos as g WHERE l.id_autor = a.id and l.id_editora = e.id and lg.id_genero = g.id and lg.id_livro = l.id;");
        break;
}

$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);


if(empty($obj)){
    echo json_encode(["status" => "error","DATA" => "dado não encontrado"]);
}
else{
    echo json_encode(["status" => "success","DATA" => $obj]);
}
