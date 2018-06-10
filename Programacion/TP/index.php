<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require_once '/composer/vendor/autoload.php';
require_once '/clases/AccesoDatos.php';
require_once '/clases/IApiUsable.php';
require_once '/clases/mesa.php';
require_once '/clases/mesaApi.php';
require_once '/clases/pedido.php';
require_once '/clases/pedidoApi.php';
require_once '/clases/comanda.php';
require_once '/clases/comandaApi.php';
require_once '/clases/empleado.php';
require_once '/clases/empleadoApi.php';
require_once '/clases/socio.php';
require_once '/clases/socioApi.php';
require_once '/clases/encuesta.php';
require_once '/clases/encuestaApi.php';
require_once '/clases/log.php';
require_once '/clases/logApi.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/comanda', function () {
  $this->get('/', \comandaApi::class . ':traerTodos');
  $this->get('/{codigoMesa}/{codigoComanda}', \comandaApi::class . ':traerUno');
  $this->post('/', \comandaApi::class . ':CargarUno');
  $this->post('/cancelar/{id}', \comandaApi::class . ':Cancelar');
  $this->delete('/', \comandaApi::class . ':BorrarUno');
  $this->put('/', \comandaApi::class . ':ModificarUno');
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