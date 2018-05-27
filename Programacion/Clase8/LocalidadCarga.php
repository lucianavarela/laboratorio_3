<?php
require_once ("Entidades/localidad.php");
require_once ("Entidades/AccesoDatos.php");
// nombre, provincia, estado (“abierto”, “cerrado”
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['provincia']) && isset($_POST['estado'])) {
        if ($_POST['estado'] == 'abierto' || $_POST['estado'] == 'cerrado') {
            $localidad_nueva = Localidad::Nueva($_POST['nombre'], $_POST['provincia'], $_POST['estado']);
            if ($localidad_nueva != NULL) {
                echo "Listo! Se cargo la localidad N°".$localidad_nueva->Guardar();
            } else {
                echo "ERROR en carga";
            }
        } else {
            echo"ERROR en estado";
        }
    } else {
        echo"ERROR en valores";
    }
}
?>