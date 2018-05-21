<?php
require_once ("entidades/cliente.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['correo']) && isset($_POST['clave']) ) {
        $clave = Cliente::ValidarCliente($_POST['correo']);
        if($clave !== NULL) {
            if ($clave === $_POST['clave']) {
                echo "Cliente Logueado";
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Cliente inexistente";
        }
    } else {
        echo "ERROR, debe ingresar todos los atributos obligatorios para validar su usuario (correo y clave).";
    }
} else {
    echo "ERROR, no ha hecho un request tipo POST.";
}
?>