<?php
require_once ("entidades/cliente.php");
require_once ("entidades/helado.php");
require_once ("entidades/archivo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['sabor']) && isset($_POST['precio']) && isset($_FILES['imagen'])) {
        if (!Helado::SaborExistente($_POST['sabor'])) {
            $carga_de_imagen = Archivo::Subir();
            if($carga_de_imagen["Exito"]) {
                $helado_nuevo = new Helado($_POST["sabor"], $_POST["precio"], $carga_de_imagen["PathTemporal"]);
                if(Helado::Guardar($helado_nuevo)){
                    echo "Nuevo helado guardado!";
                } else {
                    echo "ERROR, no se pudo almacenar el nuevo helado.";
                }
            } else {
                echo "ERROR, no se pudo almacenar la imagen de su nuevo helado.";
            }
        } else {
            echo "Este sabor ya fue utilizado!";
        }
    } else {
        echo "ERROR, debe ingresar el sabor, precio e imagen de su helado.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>