<?php
require_once ("entidades/cliente.php");
require_once ("entidades/helado.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['sabor']) && isset($_GET['cantidad'])) {
        if (is_numeric($_GET['cantidad'])) {
            $helado = Helado::GetHelado($_GET['sabor']);
            if ($helado !== NULL) {
                $venta = $helado->Vender($_GET['cantidad']);
                if ($venta !== NULL) {
                    echo "Venta realizada! Ganancia: $".$venta;
                } else {
                    echo "No se ha podido generar la venta.";
                }
            } else {
                echo "El sabor de helado ingresado no existe en el sistema.";
            }
        } else {
            echo "Debe ingresar la cantidad en formato numerico";
        }
    } else {
        echo "ERROR, debe ingresar el sabor de helado vendido y la cantidad vendida.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>