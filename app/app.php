<?php

//require __DIR__ . '/../autoload.php';
require __DIR__ . '/../vendor/autoload.php';

use Exception\HttpException;
use Http\Request;
use Model\Finder\JsonFinder;
use Model\Finder\StatusFinder;
use Http\JsonResponse;
use Model\DataBase\DatabaseConnection;
use Model\DataMapper\StatusMapper;

// Config
$debug = true;
$connection = new DatabaseConnection();
$statusMapper = new StatusMapper($connection);
$statusFinder = new StatusFinder($connection);
$finder = new JsonFinder();



$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

 // Matches if the HTTP method is GET
$app->get('/', function () use ($app, $finder) {
    $app->redirect('/statuses');
});

// Matches if the HTTP method is GET
$app->get('/statuses', function (Request $request) use ($app, $statusFinder) {
    $data = array('status' => $statusFinder->findAll());
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('index.php', $data);
});

// Matches if the HTTP method is GET
$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder) {
    if (null === $status = $statusFinder->findOneById($id)) {
        throw new HttpException(404);
    }
    $data = array('status' => $status);
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('status.php', $data);
});

// Matches if the HTTP method is POST
$app->post('/', function () use ($app) {
    return $app->render('index.php');
});

// Matches if the HTTP method is POST
$app->post('/statuses', function (Request $request) use ($app, $statusFinder) {
    $statusFinder->addStatus(htmlspecialchars($request->getParameter('user')),
        htmlspecialchars($request->getParameter('message')));
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse("statuses/" . count($statusFinder->findAll()), 201);
    }
    $app->redirect('/statuses');
});

 // Matches if the HTTP method is PUT
$app->put('/', function () use ($app) {
    return $app->render('index.php');
});

 // Matches if the HTTP method is DELETE
$app->delete('/statuses/(\d+)', function ($id) use ($app, $statusFinder) {
    if (null == $statusFinder->findOneById($id)) {
        throw new HttpException(404, 'Not Found');
    }
    $statusFinder->deleteStatus($id);
    $app->redirect('/statuses');
});

return $app;
