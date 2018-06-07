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

$app = new \Slim\App(["settings" => $config]);
/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/pedido', function () {
  $this->get('/', \pedidoApi::class . ':traerTodos');
  $this->get('/{id}#{id}', \pedidoApi::class . ':traerUno');
  $this->post('/', \pedidoApi::class . ':CargarUno');
  $this->delete('/', \pedidoApi::class . ':BorrarUno');
  $this->put('/', \pedidoApi::class . ':ModificarUno');
});
$app->group('/empleado', function () {
  $this->get('/', \empleadoApi::class . ':traerTodos');
  $this->get('/{id}', \empleadoApi::class . ':traerUno');
  $this->post('/', \empleadoApi::class . ':CargarUno');
  $this->delete('/', \empleadoApi::class . ':BorrarUno');
  $this->put('/', \empleadoApi::class . ':ModificarUno');
});
$app->group('/mozo', function () {
  $this->get('/', \mozoApi::class . ':traerTodos');
  $this->get('/{id}', \mozoApi::class . ':traerUno');
  $this->post('/', \mozoApi::class . ':CargarUno');
  $this->delete('/', \mozoApi::class . ':BorrarUno');
  $this->put('/', \mozoApi::class . ':ModificarUno');
});
$app->group('/socio', function () {
  $this->get('/', \socioApi::class . ':traerTodos');
  $this->get('/{id}', \socioApi::class . ':traerUno');
  $this->post('/', \socioApi::class . ':CargarUno');
  $this->delete('/', \socioApi::class . ':BorrarUno');
  $this->put('/', \socioApi::class . ':ModificarUno');
});
$app->group('/mesa', function () {
  $this->get('/', \mesaApi::class . ':traerTodos');
  $this->get('/{id}', \mesaApi::class . ':traerUno');
  $this->post('/', \mesaApi::class . ':CargarUno');
  $this->delete('/', \mesaApi::class . ':BorrarUno');
  $this->put('/', \mesaApi::class . ':ModificarUno');
});
$app->group('/encuesta', function () {
  $this->get('/', \encuestaApi::class . ':traerTodos');
  $this->get('/{id}', \encuestaApi::class . ':traerUno');
  $this->post('/', \encuestaApi::class . ':CargarUno');
  $this->delete('/', \encuestaApi::class . ':BorrarUno');
  $this->put('/', \encuestaApi::class . ':ModificarUno');
});
$app->group('/log', function () {
  $this->get('/', \logApi::class . ':traerTodos');
  $this->get('/{id}', \logApi::class . ':traerUno');
  $this->post('/', \logApi::class . ':CargarUno');
  $this->delete('/', \logApi::class . ':BorrarUno');
  $this->put('/', \logApi::class . ':ModificarUno');
});
$app->run();