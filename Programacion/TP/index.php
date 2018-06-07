<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../composer/vendor/autoload.php';
require '/clases/AccesoDatos.php';
require '/clases/IApiUsable.php';
require '/clases/pedido.php';
require '/clases/pedidoApi.php';
require '/clases/empleado.php';
require '/clases/empleadoApi.php';
require '/clases/mozo.php';
require '/clases/mozoApi.php';
require '/clases/socio.php';
require '/clases/socioApi.php';
require '/clases/mesa.php';
require '/clases/mesaApi.php';
require '/clases/encuesta.php';
require '/clases/encuestaApi.php';
require '/clases/log.php';
require '/clases/logApi.php';

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
$app->group('/cd', function () {
 
  $this->get('/', \cdApi::class . ':traerTodos');
 
  $this->get('/{id}', \cdApi::class . ':traerUno');
  $this->post('/', \cdApi::class . ':CargarUno');
  $this->delete('/', \cdApi::class . ':BorrarUno');
  $this->put('/', \cdApi::class . ':ModificarUno');
     
});
$app->run();