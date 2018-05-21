<?php
require_once ("Entidades/helado.php");
require_once ("Entidades/venta.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $lista_helados = Venta::GetVentasFiltrados($_GET);
    if(count($lista_helados) > 0) {
        Venta::Listar($lista_helados);
    } else {
        echo "No hay comentarios en el sistema.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>