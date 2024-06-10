<?php
$com = "SELECT l.id, l.codigo, l.titulo, l.capa, l.sinopse, a.autor, e.editora, g.genero, COALESCE(AVG(rt.avaliacao), 0) as avaliacao FROM livros as l INNER JOIN autores as a ON l.id_autor = a.id INNER JOIN editoras as e ON l.id_editora = e.id INNER JOIN generos_livros as lg ON lg.id_livro = l.id INNER JOIN generos as g ON lg.id_genero = g.id LEFT JOIN avaliacoes as rt ON rt.id_livro = l.id GROUP BY l.id, l.codigo, l.titulo, l.capa, a.autor, e.editora, g.genero";
$rs = "";


switch ($action) {
    case 'listar':
        switch ($param){
            case 'genero': 
                $com .= " AND lg.id_genero='$param2';";
                break;
            case 'codigo':
                $com .= " AND l.codigo='$param2';";
                break;
			case 'titulo':
				$com .= " AND l.titulo LIKE '%$param2%';";
				break;
			case 'autor':
				$com .= " AND l.autor LIKE '%$param2%';";
				break;
            default:
                $com .= ';';
                break;
        }
        break;
    default:
        $com .= ';';
        break;
}

echo((new DB())->query($com));
