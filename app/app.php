<?php

//require __DIR__ . '/../autoload.php';
require __DIR__ . '/../vendor/autoload.php';


use Exception\HttpException;
use Http\Request;
use Model\JsonFinder;
use Http\JsonResponse;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

/**
 * Index
 */
 // Matches if the HTTP method is GET
$app->get('/', function (Request $request) use ($app) {
    $finder = new JsonFinder();
    $data = ['status', $finder->findAll()];
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('index.php', $data);
});

$app->get('/statuses', function (Request $request) use ($app) {
    $finder = new JsonFinder();
    $data = ['status', $finder->findAll()];
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('index.php', $data);
});

$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app) {
    $finder = new JsonFinder();
    if (null === $status = $finder->findOneById($id)) {
        throw new HttpException(404);
    }
    $data = ['status', $status];
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data);
    }
    return $app->render('status.php', $data);
});

// Matches if the HTTP method is POST
$app->post('/', function () use ($app) {
    return $app->render('index.php');
});

$app->post('/statuses', function (Request $request) use ($app) {
    $finder = new JsonFinder();
    $finder->add(htmlspecialchars($request->getParameter('user')),
        htmlspecialchars($request->getParameter('message')));
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
$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app) {
    $finder = new JsonFinder();
    if (null == $finder->findOneById($id)) {
        throw new HttpException(404, 'Not Found');
    }
    $finder->delete($id);
    $app->redirect('/statuses');
});

return $app;
