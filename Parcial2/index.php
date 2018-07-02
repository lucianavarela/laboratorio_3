<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require_once './composer/vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/MWparaAutentificar.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/login.php';
require_once './clases/IApiUsable.php';
require_once './clases/compra.php';
require_once './clases/compraApi.php';
require_once './clases/usuarios.php';
require_once './clases/usuariosApi.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->post('/login/', \login::class . ':UserLogin');
$app->group('/api', function () use ($app) {
  $app->group('/compra', function () use ($app) {
    $this->get('/', \compraApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':FiltrarCompras');
    $this->get('/{id}', \compraApi::class . ':TraerUno')->add(\MWparaAutentificar::class . ':FiltrarCompras');
    $this->post('/', \compraApi::class . ':CargarUno')->add(\MWparaAutentificar::class . ':VerificarToken');
  });
  $app->group('/usuario', function () use ($app) {
    $this->get('/', \usuariosApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':VerificarAdmin');
    $this->get('/{id}', \usuariosApi::class . ':TraerUno');
    $this->post('/', \usuariosApi::class . ':CargarUno');
  });
})->add(\MWparaAutentificar::class . ':CargarLog')->add(\MWparaAutentificar::class . ':VerificarUsuario');

$app->run();