<?php
require_once ("Entidades/helado.php");
require_once ("Entidades/AccesoDatos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['cantidad']) && isset($_POST['precio'])) {
        if ($_POST['tipo'] == 'agua' || $_POST['tipo'] == 'crema') {
            $helado_nuevo = Helado::Nuevo($_POST['sabor'], $_POST['tipo'], $_POST['cantidad'], $_POST['precio']);
            if ($helado_nuevo != NULL) {
                echo "Listo! Se cargo el helado N°".$helado_nuevo->Guardar();
            }
        } else {
            echo"ERROR";
        }
    } else {
        echo"ERROR";
    }
}
?>