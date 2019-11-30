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

    $data = strval($con->getMessage());
    $response->getBody()->write($data);
    // return $response->withHeader('Content-Type', 'application/json');
    return $response;
});

$app->post('/user', function (Request $request, Response $response, $args) {
    $arg = $request->getParsedBody();
    $data = json_encode(array(
        'user' => $arg['user'],
        'email' => $arg['email'],
        'pass' => $arg['pass'],

    ));

    $response->getBody()->write($data);
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