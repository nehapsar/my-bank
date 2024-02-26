<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new App($configuration);

$app->post('/create' ,function (Request $request,Response $response){
    $parsedBody = $request->getParsedBody();
    $accountController = new \App\controllers\AccountControllers();
    $result = $accountController->createAccount($parsedBody);
    return $response->withStatus(200)->withJson($result);
});

$app->run();

