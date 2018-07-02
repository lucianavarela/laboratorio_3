<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require_once './composer/vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/MWparaAutentificar.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/login.php';
require_once './clases/IApiUsable.php';
require_once './clases/bicis.php';
require_once './clases/bicisApi.php';
require_once './clases/ventas.php';
require_once './clases/ventasApi.php';
require_once './clases/usuarios.php';
require_once './clases/usuariosApi.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->post('/login/', \login::class . ':UserLogin');
$app->group('/api', function () use ($app) {
  $app->group('/bicis', function () use ($app) {
    $this->get('/', \bicisApi::class . ':TraerTodos');
    $this->get('/{id}', \bicisApi::class . ':TraerUno');
    $this->post('/', \bicisApi::class . ':CargarUno')->add(\MWparaAutentificar::class . ':VerificarAdmin')->add(\MWparaAutentificar::class . ':VerificarToken');;
    $this->delete('/{id}', \bicisApi::class . ':BorrarUno');
    $this->put('/{id}', \bicisApi::class . ':ModificarUno');
  });
  $app->group('/ventas', function () use ($app) {
    $this->get('/', \ventasApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':FiltrarVentas');
    $this->get('/{id}', \ventasApi::class . ':TraerUno')->add(\MWparaAutentificar::class . ':FiltrarVentas');
    $this->post('/', \ventasApi::class . ':CargarUno');
    $this->delete('/{id}', \ventasApi::class . ':BorrarUno');
    $this->put('/{id}', \ventasApi::class . ':ModificarUno');
  });
  $app->group('/usuarios', function () use ($app) {
    $this->get('/', \usuariosApi::class . ':TraerTodos');
    $this->get('/{id}', \usuariosApi::class . ':TraerUno');
    $this->post('/', \usuariosApi::class . ':CargarUno');
    $this->delete('/{id}', \usuariosApi::class . ':BorrarUno');
    $this->put('/{id}', \usuariosApi::class . ':ModificarUno');
  });
})->add(\MWparaAutentificar::class . ':CargarLog')->add(\MWparaAutentificar::class . ':VerificarUsuario');

$app->run();