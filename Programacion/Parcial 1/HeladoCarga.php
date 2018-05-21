<?php
require_once ("Entidades/helado.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['sabor']) && isset($_GET['precio']) && isset($_GET['tipo']) && isset($_GET['cantidad'])) {
        if ($_GET['tipo'] === "crema" || $_GET['tipo'] === "agua") {
            $respuesta = Helado::ValidarHelado($_GET['sabor'], $_GET['tipo']);
            if ($respuesta['resultado'] == false) {
                $helado_nuevo = new Helado($_GET["sabor"], $_GET["precio"], $_GET["tipo"], $_GET["cantidad"]);
                if(Helado::Guardar($helado_nuevo)){
                    echo "Nuevo helado guardado!";
                } else {
                    echo "ERROR, no se pudo almacenar el nuevo helado.";
                }
            } else {
                echo "Este sabor ya fue cargado.";
            }
        } else {
            echo "ERROR, tipo de helado invalido (debe ser de crema o agua).";
        }
    } else {
        echo "ERROR, debe ingresar el sabor, precio, tipo y cantidad de su helado.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>