<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();

include './connection.php';

include './middleware.php';

$app->get('/', function (Request $request, Response $response, $args) {
    $con = new Connection('localhost','root','','todos');

    $data = strval($con->message);
    $response->getBody()->write($data);
    // return $response->withHeader('Content-Type', 'application/json');
    return $response;
});

$app->post('/user', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('localhost', 'root', '', 'todos');

    $con->newUser($data);

    $message = json_encode($con->getMessage());

    $response->getBody()->write($message);
    
    return $response->withHeader('Content-Type', 'application/json');
});






use Slim\Exception\HttpNotFoundException;
/*
 * Catch-all route to serve a 404 Not Found page if none of the routes match
 * NOTE: make sure this route is defined last
 */
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

$app->run();