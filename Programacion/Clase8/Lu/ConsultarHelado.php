<?php
require_once ("Entidades/helado.php");
require_once ("Entidades/AccesoDatos.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sabor']) && isset($_POST['tipo'])) {
        if ($_POST['tipo'] == 'agua' || $_POST['tipo'] == 'crema') {
            echo Helado::Validar($_POST['sabor'], $_POST['tipo']);
        } else {
            echo"ERROR";
        }
    } else {
        echo"ERROR";
    }
}
?>