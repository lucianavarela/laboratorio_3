<?php
require_once ("Entidades/local.php");
require_once ("Entidades/AccesoDatos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['direccion']) && isset($_POST['localidad']) && isset($_POST['estado'])) {
        if ($_POST['estado'] == 'abierto' || $_POST['estado'] == 'cerrado') {
            $local_nuevo = Local::Nuevo($_POST['direccion'], $_POST['estado'], $_POST['localidad']);
            if ($local_nuevo != NULL) {
                echo "Listo! Se cargo el local N°".$local_nuevo->Guardar();
            } else {
                echo "ERROR en carga";
            }
        } else {
            echo"ERROR en estado";
        }
    } else {
        echo"ERROR, valores faltantes";
    }
}
?>