<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use App\Controller\ClubeController;
use Slim\Exception\HttpNotFoundException;

require_once(__DIR__ . '/vendor/autoload.php');

$app = AppFactory::create();
$app->setBasePath("/futebol_api"); //Adicionar o nome da pasta do projeto

// Parse json, form data and xml
$app->addBodyParsingMiddleware();
//$app->addRoutingMiddleware(); //Serve para adicionar tratamentos padrões para erros retornados pelos ENDPoints
$app->addErrorMiddleware(true, true, true); //Retorna um erro do Framework caso não tratado

//ROTAS
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Funcionou!");
    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello world!<br>");
    $response->getBody()->write("Thanks from visiting us Mr(s). $name");
    return $response;
});

//Chamar /hello2?name=Daniel
$app->get('/hello2', function (Request $request, Response $response, $args) {
    //$name = $args['name'];
    $params = $request->getQueryParams();
    $name = $params['name'];

    $response->getBody()->write("Hello world!<br>");
    $response->getBody()->write("Thanks from visiting us Mr(s). $name");
    return $response;
});

//Clubes
$app->get('/clubes', ClubeController::class . ':listar');
//$app->get('/clubes', 'App\Controller\ClubeController:listar');
$app->get('/clubes/{id}', ClubeController::class . ':buscarPorId');
$app->post('/clubes', ClubeController::class . ':inserir');
$app->put('/clubes/{id}', ClubeController::class . ':atualizar');
$app->delete('/clubes/{id}', ClubeController::class . ':deletar');


//Tratamento para rota não encontrada
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});


$app->run();
