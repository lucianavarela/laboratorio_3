<?php
require_once ("Entidades/helado.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['sabor']) && isset($_POST['tipo'])) {
        if ($_POST['tipo'] === "crema" || $_POST['tipo'] === "agua") {
            $respuesta = Helado::ValidarHelado($_POST['sabor'], $_POST['tipo']);
            if ($respuesta['resultado']) {
                echo "Si hay";
            } else {
                echo $respuesta['mensaje'];
            }
        } else {
            echo "ERROR, tipo de helado invalido (debe ser de crema o agua).";
        }
    } else {
        echo "ERROR, debe ingresar el sabor y el tipo.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>