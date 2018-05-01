<?php

$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : $_POST['nombre'];

$data = new stdClass();

if($nombre == "Juan"){
    $data->nombre = "Juan";
    $data->apellido = "Perez";
    $data->edad = "18";
    $json = json_encode($data);
    echo $json;    
}

if($nombre == "Lucia"){
    $data->nombre = "Lucia";
    $data->apellido = "Garcia";
    $data->edad = "30";
    $json = json_encode($data);
    echo $json;    
}
if($nombre == "Alberto"){
    $data->nombre = "Alberto";
    $data->apellido = "Alvarez";
    $data->edad = "25";
    $json = json_encode($data);
    echo $json;    
}

?>