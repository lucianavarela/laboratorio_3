<?php
require_once ("entidades/usuario.php");
require_once ("entidades/comentario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['email']) && isset($_POST['titulo']) && isset($_POST['comentario'])) {
        $usuario = Usuario::GetUsuario($_POST['email']);
        if($usuario !== NULL) {
            if (!Comentario::TituloExistente($_POST['titulo'])) {
                $comentario_nuevo = new Comentario($_POST["email"], $_POST["titulo"], $_POST["comentario"]);
                if(Comentario::Guardar($comentario_nuevo)){
                    echo "Nuevo comentario guardado creado!";
                } else {
                    echo "ERROR, no se pudo almacenar el nuevo comentario.";
                }
            } else {
                echo "Este titulo ya fue utilizado!";
            }
        } else {
            echo "Usuario inexistente!";
        }
    } else {
        echo "ERROR, debe ingresar el email para validar su cuenta, y el titulo y comentario de su mensaje.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>