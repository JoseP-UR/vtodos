<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . './vendor/autoload.php';

$app = AppFactory::create();

include './connection.php';

include './middleware.php';

$app->post('/user/login', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('localhost', 'root', '', 'todos');

    $userData = $con->getUserByName($data['name']);

    if (!$userData) {
        $message = json_encode(['error' => 'user not found']);

        $response->getBody()->write($message);
        return $response;
    }

    if (!password_verify($data['pass'], $userData['pass'])) {
        $message = json_encode(['error' => 'invalid password']);

        $response->getBody()->write($message);
        return $response;
    }

    $message = json_encode([
            'uid' => $userData['id'],
            'name' => $userData['name']
        ]);

    $response->getBody()->write($message);
    
    return $response;
});

$app->post('/user/register', function (Request $request, Response $response, $args) {
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