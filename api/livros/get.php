<?php
$com = "SELECT l.id, l.codigo, l.titulo, l.capa, l.sinopse, l.volumes, l.volumes_reservado as reservados, a.nome as autor_nome, e.editora, g.genero, COALESCE(AVG(rt.avaliacao), 0) AS avaliacao FROM livros AS l INNER JOIN autores AS a ON l.id_autor = a.id INNER JOIN editoras AS e ON l.id_editora = e.id INNER JOIN generos_livros AS lg ON lg.id_livro = l.id INNER JOIN generos AS g ON lg.id_genero = g.id LEFT JOIN avaliacoes AS rt ON rt.id_livro = l.id";
$rs = "";


switch ($action) {
    case 'listar':
        switch ($param){
            case 'genero': 
                $com .= " WHERE lg.id_genero='$param2'";
                break;
            case 'codigo':
                $com .= " WHERE l.codigo='$param2';";
                break;
			case 'titulo':
				$com .= "  WHERE l.titulo LIKE '%$param2%'";
				break;
			case 'autor':
				$com .= " WHERE a.nome like '%$param2%'";
				break;
            default:
                break;
        }
		$com .= " GROUP BY l.id, l.codigo, l.titulo, l.capa, l.sinopse, l.volumes, a.nome, e.editora, g.genero;";
        break;
	case 'codigos':
		$com = "SELECT codigo FROM livros;";
		break;
    default:
		echo(json_enconde(['status' => 'error', 'message' => 'Defina um parâmetro de busca.']));
		die();
        break;
}
echo((new DB())->query($com));
