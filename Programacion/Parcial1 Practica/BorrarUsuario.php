<?php
require_once ("entidades/archivo.php");
require_once ("entidades/usuario.php");
require_once ("entidades/comentario.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['emailLogueado']) && isset($_POST['claveLogueado']) && isset($_POST['titulo'])) {
        $usuario_logueado = Usuario::GetUsuario($_POST['emailLogueado']);
        if ($usuario_logueado !==NULL) {
            if ($usuario_logueado->GetClave() == $_POST['claveLogueado']) {
                if ($usuario_logueado->GetPerfil() == "admin") {
                    $comentario_a_eliminar = Comentario::GetComment($_POST['titulo']);
                    if($comentario_a_eliminar !== NULL) {
                        if($comentario_a_eliminar->Eliminar()) {
                            echo "Comentario eliminado!";
                        } else {
                            echo "ERROR, no se pudo eliminar el comentario;";
                        }
                    } else {
                        echo "ERROR, comentario a modificar no existe.";
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
        echo "ERROR, debe ingresar sus credenciales y el titulo del comentario que desea eliminar.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>