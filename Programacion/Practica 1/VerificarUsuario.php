<?php
require_once ("entidades/usuario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['email']) && isset($_POST['clave'])) {
        $clave = Usuario::ValidarUsuario($_POST['email']);
        if($clave !== NULL) {
            if ($clave === $_POST['clave']) {
                echo "Bienvenido!";
            } else {
                echo "Contraseña incorrecta!";
            }
        } else {
            echo "Usuario inexistente!";
        }
    } else {
        echo "ERROR, debe ingresar el email y clave para validar su cuenta.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>