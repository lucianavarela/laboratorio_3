<?php
require_once ("entidades/helado.php");
require_once ("entidades/venta.php");
require_once ("entidades/archivo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['saborActual']) && isset($_POST['tipoActual']) && isset($_POST['tipo']) && isset($_POST['cantidad']) && isset($_POST['sabor']) && isset($_POST['precio']) && isset($_FILES['imagen'])) {
        $respuesta = Helado::ValidarHelado($_POST['saborActual'], $_POST['tipoActual']);
        if ($respuesta['resultado']) {
            if (is_numeric($_POST['cantidad'])) {
                $helado = Helado::GetHelado($_POST['saborActual'], $_POST['tipoActual']);
                $carga_de_imagen = Archivo::Subir();
                if($carga_de_imagen["Exito"]) {
                    $venta = $helado->Modificar($_POST, $carga_de_imagen['PathTemporal']);
                    if ($venta) {
                        echo "Modificacion completa!";
                    } else {
                        echo "ERROR, no se pudo gestionar la modificacion";
                    }
                } else {
                    echo "ERROR, no se pudo almacenar la imagen de su helado.";
                }
            } else {
                echo "ERROR, la cantidad debe ser numerica.";
            }
        } else {
            echo "ERROR, helado inexistentes";
        }
    } else {
        echo "ERROR, faltan valores.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>