<?php
require_once ("entidades/helado.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['sabor'])) {
        $helado = Helado::GetHelado($_GET['sabor']);
        if ($helado !== NULL) {
            Helado::Listar($_GET['sabor']);
        } else {
            echo "El sabor de helado ingresado no existe en el sistema.";
        }
    } else {
        echo "Debe ingresar un sabor de helado.";
    }
} else {
    if(isset($_POST['sabor']) && isset($_POST['caso'])) {
        if ($_POST['caso'] === "borrarHelado") {
            $helado = Helado::GetHelado($_POST['sabor']);
            if ($helado !== NULL) {
                if ($helado->Eliminar()) {
                    echo "Helado eliminado!";
                } else {
                    echo "ERROR, no se ha podido borrar el helado";
                }
            } else {
                echo "El sabor de helado ingresado no existe en el sistema.";
            }
        } else {
            echo "Caso inexistente.";
        }
    } else {
        echo "ERROR, debe ingresar el sabor de helado y el caso.";
    }
}
?>