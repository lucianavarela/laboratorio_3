<?php
require_once ("Entidades/helado.php");
require_once ("entidades/venta.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['email']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['cantidad'])) {
        if ($_POST['tipo'] === "crema" || $_POST['tipo'] === "agua") {
            $respuesta = Helado::ValidarHelado($_POST['sabor'], $_POST['tipo']);
            if ($respuesta['resultado']) {
                if (is_numeric($_POST['cantidad'])) {
                    $helado = Helado::GetHelado($_POST['sabor'], $_POST['tipo']);
                    $venta = $helado->Vender($_POST['cantidad'], $_POST['email'], NULL);
                    if ($venta) {
                        echo "Venta realizada";
                    } else {
                        echo "ERROR, no se pudo gestionar la venta";
                    }
                } else {
                    echo "ERROR, la cantidad debe ser numerica.";
                }
            } else {
                echo "ERROR, helado inexistente";
            }
        } else {
            echo "ERROR, tipo de helado invalido (debe ser de crema o agua).";
        }
    } else {
        echo "ERROR, debe ingresar email, sabor, tipo y cantidad.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>