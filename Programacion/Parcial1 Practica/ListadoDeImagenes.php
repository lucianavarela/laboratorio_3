<?php
require_once ("entidades/usuario.php");
require_once ("entidades/comentario.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['tipo']) && ($_GET['tipo'] == "Cargadas" || $_GET['tipo'] == "Borradas")) {
        Comentario::ListarImagenes($_GET['tipo']);
    } else {
        echo "ERROR, debe ingresar qué tipo de imagenes desea ver (Cargadas o Borradas).";
    }
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>