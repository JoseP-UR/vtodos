<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

include './connection.php';

include './middleware.php';

$app->post('/user/login', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    if (!array_key_exists('name', $data) || !array_key_exists('pass', $data)){
        $message = json_encode(['error' => 'something is missing']);

        $response->getBody()->write($message);
        return $response;
    }

    $con = new Connection('mysql', 'todos', 'todos', 'todos');

    $userData = $con->getUserByName($data['name']);

    if (!$userData) {
        $message = json_encode(['error' => 'user not found']);

        $response->getBody()->write($message);
        return $response;
    }

    if (array_key_exists('session', $data)) {
        if ($data['pass'] != $userData['pass']) {
            $message = json_encode(['error' => 'invalid password']);
        
            $response->getBody()->write($message);
            return $response;
        }

        $message = json_encode([
            'uid' => $userData['id'],
            'name' => $userData['name'],
            'pass' => $userData['pass']
        ]);

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
            'name' => $userData['name'],
            'pass' => $userData['pass']
        ]);

    $response->getBody()->write($message);
    
    return $response;
});

$app->post('/user/register', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('mysql', 'todos', 'todos', 'todos');

    $con->newUser($data);

    $message = json_encode($con->getMessage());

    $response->getBody()->write($message);
    
    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/task/create', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('mysql', 'todos', 'todos', 'todos');

    $con->createTask($data);

    $message = json_encode($con->getMessage());

    $response->getBody()->write($message);

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/task/list/{uid}', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('mysql', 'todos', 'todos', 'todos');

    $list = $con->retrieveList($args['uid']);

    $message = json_encode($list);

    $response->getBody()->write($message);
    
    return $response->withHeader('Content-Type', 'application/json');
});


$app->delete('/task/{id}/delete', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('mysql', 'todos', 'todos', 'todos');

    $con->deleteTask($args['id'], $data);

    $message = json_encode($con->getMessage());

    $response->getBody()->write($message);
    
    return $response->withHeader('Content-Type', 'application/json');
});


$app->put('/task/{id}/edit', function (Request $request, Response $response, $args) {
    $arg = $request->getBody()->getContents();

    $data = json_decode($arg, true);

    $con = new Connection('mysql', 'todos', 'todos', 'todos');

    $con->editTask($args['id'], $data);

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