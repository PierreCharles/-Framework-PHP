<?php

//require __DIR__ . '/../autoload.php';
require __DIR__ . '/../vendor/autoload.php';


use Exception\HttpException;
use Model\Finder\StatusFinder;
use Model\Finder\UserFinder;
use Http\JsonResponse;
use Http\Response;
use Http\Request;
use Model\DataBase\DatabaseConnection;
use Model\DataMapper\StatusMapper;
use Model\DataMapper\UserMapper;
use Model\Entity\Status;
use Model\Entity\User;


// Config
$debug = true;
$connection = new DatabaseConnection();
$statusFinder = new StatusFinder($connection);
$userFinder = new UserFinder($connection);
$statusMapper = new StatusMapper($connection);
$userMapper = new UserMapper($connection);
//$finder = new JsonFinder();


/**
 * Index
 */

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);


 // Matches if the HTTP method is GET -> /
$app->get('/', function () use ($app) {
    $app->redirect('/statuses');
});


// Matches if the HTTP method is GET -> /statuses/
$app->get('/statuses/', function () use ($app) {
    $app->redirect('/statuses');
});


// Matches if the HTTP method is GET -> /login
$app->get('/login', function () use ($app) {
    return $app->render('login.php');
});


// Matches if the HTTP method is GET -> /register
$app->get('/register', function () use ($app) {
    return $app->render('register.php');
});


// Matches if the HTTP method is GET -> /logout
$app->get('/logout', function() use ($app) {
    session_destroy();
    $app->redirect('/statuses');
});


// Matches if the HTTP method is GET -> /statuses
$app->get('/statuses', function (Request $request) use ($app, $statusFinder) {

    $data = array('status' => $statusFinder->findAll(), 'userName'=> null);
    if(count($data['status'])==0) {
        $response = new Response("",204);
        $response->send();
    }
    if($request->guessBestFormat()==="json") {
        $response = new Response(json_encode($data),200);
        $response->send();
    }
    if(isset($_SESSION['userName'])) {
        $data['userName'] = $_SESSION['userName'];
    } else {
        $data['userName'] = "Unknown";
    }

    return $app->render('index.php', $data);
});


// Matches if the HTTP method is GET -> /statuses/id
$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder) {
    if (null === $status = $statusFinder->findOneById($id)) {
        throw new HttpException(404);
    }
    $data = array('status' => $status);
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($data, 200);
    }
    return $app->render('status.php', $data);
});


// Matches if the HTTP method is POST -> /statutes
$app->post('/statuses', function (Request $request) use ($app, $statusFinder, $statusMapper, $userMapper) {
    $status = new Status(null, htmlspecialchars($request->getParameter('userName')),
        htmlspecialchars($request->getParameter('message')), date("Y-m-d H:i:s"));
    $statusMapper->persist($status);
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse("statuses/" . count($statusFinder->findAll()), 201);
    }
    $app->redirect('/statuses');
});


// Matches if the HTTP method is POST -> /login
$app->post('/login', function (Request $request) use ($app,$userFinder) {

    $userName = $request->getParameter('userName');
    $userPassword = $request->getParameter('userPassword');

    if(!isset($userName) || !isset($userPassword)) {
        $response = new Response("Empty Username or password",400);
        $response->send();
        return $app->render('login.php',array('error' => "Empty Username or password", 'userName' => $userName));
    }
    $user = $userFinder->findOneByUserName($userName);

    if(!password_verify($userPassword, $user->getUserPassword())) {
        $response = new Response("Bad password",400);
        $response->send();
        return $app->render('login.php',array('error' => "Bad password", 'login' => $userName));
    }

    $_SESSION['id'] = $user->getUserId();
    $_SESSION['userName'] = $user->getUserName();
    $_SESSION['is_connected'] = true;

    $app->redirect('/statuses');
});


// Matches if the HTTP method is POST -> /register
$app->post('/register', function (Request $request) use ($app,$userMapper) {

    $userName = $request->getParameter('userName');
    $userPassword = $request->getParameter('userPassword');

    if(!isset($userName) || !isset($userPassword)) {
        $response = new Response("Invalid parameters",400);
        $response->send();
        return $app->render('register.php',array('error' => "Invalid parameters", 'login' => $userName));
    }
    $userMapper->persist(new User(null,$userName, password_hash($userPassword,PASSWORD_DEFAULT)));
    $app->redirect('/login');
});


// Matches if the HTTP method is PUT -> /
$app->put('/', function () use ($app) {
    return $app->render('index.php');
});


// Matches if the HTTP method is DELETE -> /statuses/id
$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $statusFinder, $statusMapper) {
    if (null == $statusFinder->findOneById($id)) {
        throw new HttpException(404, 'Not Found');
    }
    $statusMapper->remove($id);
    $app->redirect('/statuses');
});


return $app;

