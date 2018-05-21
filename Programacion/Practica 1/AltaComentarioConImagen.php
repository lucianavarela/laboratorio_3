<?php
require_once ("entidades/usuario.php");
require_once ("entidades/comentario.php");
require_once ("entidades/archivo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['email']) && isset($_POST['titulo']) && isset($_POST['comentario']) && isset($_FILES['imagen'])) {
        $usuario = Usuario::GetUsuario($_POST['email']);
        if($usuario !== NULL) {
            if (!Comentario::TituloExistente($_POST['titulo'])) {
                $comentario_nuevo = new Comentario($_POST["email"], $_POST["titulo"], $_POST["comentario"]);
                if(Comentario::Guardar($comentario_nuevo)){
                    $carga_de_imagen = Archivo::Subir();
                    if($carga_de_imagen["Exito"]) {
                        echo "Nuevo comentario guardado creado con su imagen!";
                    } else {
                        echo "ERROR, no se pudo almacenar la imagen de su nuevo comentario.";
                    }
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
        echo "ERROR, debe ingresar el email para validar su cuenta, y el titulo, comentario e imagen de su mensaje.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>