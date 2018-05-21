<?php
require_once ("entidades/usuario.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['emailLogueado']) && isset($_POST['claveLogueado']) && isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['clave']) ) {
        $usuario_logueado = Usuario::GetUsuario($_POST['emailLogueado']);
        if ($usuario_logueado !==NULL) {
            if ($usuario_logueado->GetClave() == $_POST['claveLogueado']) {
                if ($usuario_logueado->GetPerfil() == "admin" || ($usuario_logueado->GetPerfil() == "user" && $usuario_logueado->GetEmail() == $_POST['email'])) {
                    if ($_POST["perfil"] == "admin" || $_POST["perfil"] == "user") {
                        $usuario = Usuario::GetUsuario($_POST['email']);
                        if($usuario !== NULL) {
                            if($usuario->Modificar($_POST)) {
                                echo "Usuario editado!";
                            } else {
                                echo "ERROR, no se pudo editar el usuario;";
                            }
                        } else {
                            echo "ERROR, usuario a modificar no existe!";
                        }
                    } else {
                        echo "ERROR, el perfil debe ser admin o user.";
                    }
                } else {
                    echo "ERROR, usted no dispone de permisos para realizar esta modificacion.";
                }
            } else {
                echo "ERROR, su clave es incorrecta.";
            }
        } else {
            echo "ERROR, su email no esta registrado.";
        }
    } else {
        echo "ERROR, debe ingresar todos los atributos obligatorios para modificar un usuario (email, nombre, edad, perfil y clave).";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>