<?php
require_once ("entidades/usuario.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['email']) && isset($_GET['nombre']) && isset($_GET['perfil']) && isset($_GET['edad']) && isset($_GET['clave']) ) {
        if ($_GET["perfil"] == "admin" || $_GET["perfil"] == "user") {
            $existe = Usuario::ValidarUsuario($_GET['email']);
            if($existe !== NULL) {
                echo "ERROR, este email ya está cargado en el sistema.";
            } else {
                $usuario_nuevo = new Usuario($_GET["email"], $_GET["nombre"], $_GET["perfil"], $_GET["edad"], $_GET["clave"]);
                if(Usuario::Guardar($usuario_nuevo)){
                    echo "El nuevo usuario ha sido creado!";
                } else {
                    echo "ERROR, no se pudo almacenar el nuevo usuario.";
                }
            }
        } else {
            echo "ERROR, el perfil debe ser admin o user.";
        }
    } else {
        echo "ERROR, debe ingresar todos los atributos obligatorios para crear un nuevo usuario (email, nombre, edad, perfil y clave).";
    }
} else {
    echo "ERROR, no ha hecho un request tipo GET.";
}
?>