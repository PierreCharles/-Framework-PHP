<?php

//require __DIR__ . '/../autoload.php';
require __DIR__ . '/../vendor/autoload.php';

use Exception\HttpException;
use Http\Request;
use Model\Finder\StatusFinder;
use Http\JsonResponse;
use Model\DataBase\DatabaseConnection;
use Model\DataMapper\StatusMapper;
use Model\Entity\Status;


// Config
$debug = true;
$connection = new DatabaseConnection();
$finder = new StatusFinder($connection);
//$finder = new JsonFinder();
$mapper = new StatusMapper($connection);

/**
 * Index
 */
$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

 // Matches if the HTTP method is GET /
$app->get('/', function () use ($app) {
    $app->redirect('/statuses');
});

// Matches if the HTTP method is GET -> /statuses
$app->get('/statuses', function (Request $request) use ($app, $finder) {
    $data = array('status' => $finder->findAll());
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('index.php', $data);
});

// Matches if the HTTP method is GET /
$app->get('/statuses/', function () use ($app) {
    $app->redirect('/statuses');
});


// Matches if the HTTP method is GET -> /statuses/(\d+)
$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $finder) {
    if (null === $status = $finder->findOneById($id)) {
        throw new HttpException(404);
    }
    $data = array('status' => $status);
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('status.php', $data);
});

// Matches if the HTTP method is POST -> /statutes
$app->post('/statuses', function (Request $request) use ($app, $finder, $mapper) {
    $status = new Status(null, htmlspecialchars($request->getParameter('user')),
        htmlspecialchars($request->getParameter('message')), date("Y-m-d H:i:s"));
    $mapper->persist($status);
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse("statuses/" . count($finder->findAll()), 201);
    }
    $app->redirect('/statuses');
});

 // Matches if the HTTP method is PUT
$app->put('/', function () use ($app) {
    return $app->render('index.php');
});

 // Matches if the HTTP method is DELETE
$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $finder, $mapper) {

    if (null == $finder->findOneById($id)) {
        throw new HttpException(404, 'Not Found');
    }
    $mapper->remove($id);
    $app->redirect('/statuses');
});

return $app;
