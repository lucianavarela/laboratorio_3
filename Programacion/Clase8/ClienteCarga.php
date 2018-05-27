<?php
require_once ("Entidades/cliente.php");
require_once ("Entidades/AccesoDatos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['nacionalidad']) && isset($_POST['sexo']) && isset($_POST['edad'])) {
        if ($_POST['sexo'] == 'f' || $_POST['sexo'] == 'm') {
            $cliente_nuevo = Cliente::Nuevo($_POST['nombre'], $_POST['nacionalidad'], $_POST['sexo'], $_POST['edad']);
            if ($cliente_nuevo != NULL) {
                echo "Listo! Se cargo el cliente N°".$cliente_nuevo->Guardar();
            } else {
                echo "ERROR en carga";
            }
        } else {
            echo"ERROR en sexo";
        }
    } else {
        echo"ERROR, valores faltantes";
    }
}
?>