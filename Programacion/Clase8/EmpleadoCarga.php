<?php
require_once ("Entidades/empleado.php");
require_once ("Entidades/AccesoDatos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['turno']) && isset($_POST['tipo'])) {
        if ($_POST['tipo'] == 'jefe' || $_POST['tipo'] == 'encargado' || $_POST['tipo'] == 'novato') {
            $empleado_nuevo = Empleado::Nuevo($_POST['nombre'], $_POST['tipo'], $_POST['turno']);
            if ($empleado_nuevo != NULL) {
                echo "Listo! Se cargo el empleado N°".$empleado_nuevo->Guardar();
            } else {
                echo "ERROR en carga";
            }
        } else {
            echo"ERROR en tipo";
        }
    } else {
        echo"ERROR, valores faltantes";
    }
}
?>