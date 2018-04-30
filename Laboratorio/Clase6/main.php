<?php
    $nombre = $_REQUEST['nombre'];
    $apellido = $_REQUEST['apellido'];
    echo 'Nombre: '.$nombre.'<br>';
    echo 'Apellido: '.$apellido;

    $nombre_fichero = "json"
    $gestor = fopen($nombre_fichero, "r");
    $contenido = fread($gestor, filesize)
    $
?>