<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require_once '../composer/vendor/autoload.php';

$app = new \Slim\App([]);

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET");
    return $response;
});

$app->post('/helado', function (Request $request, Response $response) {    
    $response->getBody()->write("Agrega helado");
    return $response;
});

$app->put('/helado', function (Request $request, Response $response) {    
    $response->getBody()->write("Modifica helado");
    return $response;
});

$app->delete('/helado', function (Request $request, Response $response) {    
    $response->getBody()->write("Borra helado");
    return $response;
});

$app->run();