<?php
require_once ("entidades/usuario.php");
require_once ("entidades/comentario.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $lista_comentarios = Comentario::GetComentariosFiltrados($_GET);
    if(count($lista_comentarios) > 0) {
        Comentario::Listar($lista_comentarios);
    } else {
        echo "No hay comentarios en el sistema.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>