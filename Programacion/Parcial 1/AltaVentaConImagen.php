<?php
require_once ("entidades/helado.php");
require_once ("entidades/venta.php");
require_once ("entidades/archivo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['email']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['cantidad'])&& isset($_FILES['imagen'])) {
        $respuesta = Helado::ValidarHelado($_POST['sabor'], $_POST['tipo']);
        if ($respuesta['resultado']) {
            if (is_numeric($_POST['cantidad'])) {
                $helado = Helado::GetHelado($_POST['sabor'], $_POST['tipo']);
                $carga_de_imagen = Archivo::Subir();
                if($carga_de_imagen["Exito"]) {
                    $venta = $helado->Vender($_POST['cantidad'], $_POST['email'], $carga_de_imagen['PathTemporal']);
                    if ($venta) {
                        echo "Nueva venta generada con su imagen!";
                    } else {
                        echo "ERROR, no se pudo gestionar la venta";
                    }
                } else {
                    echo "ERROR, no se pudo almacenar la imagen de su nuevo helado.";
                }
            } else {
                echo "ERROR, la cantidad debe ser numerica.";
            }
        } else {
            echo "ERROR, helado inexistentes";
        }
    } else {
        echo "ERROR, debe ingresar el email para validar su cuenta, y el titulo, helado e imagen de su mensaje.";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>