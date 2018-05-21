<?php
require_once ("entidades/cliente.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['correo']) && isset($_POST['nombre']) && isset($_POST['clave']) ) {
        $existe = Cliente::ValidarCliente($_POST['correo']);
        if($existe !== NULL) {
            echo "ERROR, este correo ya está cargado en el sistema.";
        } else {
            $cliente_nuevo = new Cliente($_POST["correo"], $_POST["nombre"], $_POST["clave"]);
            if(Cliente::GuardarEnArchivo($cliente_nuevo)){
                echo "El nuevo cliente ha sido creado!";
            } else {
                echo "ERROR, no se pudo almacenar el nuevo cliente.";
            }
        }
    } else {
        echo "ERROR, debe ingresar todos los atributos obligatorios para crear un nuevo cliente (correo, nombre y clave).";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>