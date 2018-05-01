<?php
require_once ("entidades/usuario.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['clave']) ) {
        if ($_POST["perfil"] == "admin" || $_POST["perfil"] == "user") {
            $usuario = Usuario::GetUsuario($_POST['email']);
            if($usuario !== NULL) {
                if($usuario->Modificar($_POST)) {
                    echo "Usuario editado!";
                } else {
                    echo "ERROR, no se pudo editar el usuario;";
                }
            } else {
                echo "ERROR, usuario inexistente!";
            }
        } else {
            echo "ERROR, el perfil debe ser admin o user.";
        }
    } else {
        echo "ERROR, debe ingresar todos los atributos obligatorios para modificar un usuario (email, nombre, edad, perfil y clave).";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>