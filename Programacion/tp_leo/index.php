<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'clases/accesoDatos.php';
require 'clases/empleadosApi.php';
require 'clases/mesasApi.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/empleados', function () {
 
  $this->get('/', \empleadosApi::class . ':traerTodos');
 
  $this->get('/{id}', \empleadosApi::class . ':traerUno');

  $this->post('/', \empleadosApi::class . ':CargarUno');

  $this->delete('/', \empleadosApi::class . ':BorrarUno');

  $this->put('/', \empleadosApi::class . ':ModificarUno');
     
});

$app->group('/login', function () {
 
  $this->get('/', \empleadosApi::class . ':traerUnLog');
 
  $this->get('/{id}', \empleadosApi::class . ':traerUnLog');

  $this->post('/', \empleadosApi::class . ':verificar');

  //$this->delete('/', \empleadosApi::class . ':BorrarUno');

 // $this->put('/', \empleadosApi::class . ':ModificarUno');
     
});

$app->group('/mesas', function () {
 
  $this->get('/', \mesasApi::class . ':traerTodos');
 
  $this->get('/{id}', \mesasApi::class . ':traerUno');

  $this->post('/', \mesasApi::class . ':CargarUno');

  $this->delete('/', \mesasApi::class . ':BorrarUno');

  $this->put('/', \mesasApi::class . ':ModificarUno');
     
});


$app->run();

?>