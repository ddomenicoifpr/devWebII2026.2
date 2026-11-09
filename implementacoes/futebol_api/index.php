<?php
//Habila os erros no php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

//use App\Controller\ClubeController;
use Slim\Exception\HttpNotFoundException;

require_once(__DIR__ . '/vendor/autoload.php');

$app = AppFactory::create();
$app->setBasePath("/futebol_api"); //Adicionar o nome da pasta do projeto

// Parse json, form data and xml
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true); //Retorna um erro do Framework caso não tratado

//ROTAS
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Funcionou!");
    return $response;
});

//Tratamento para rota não encontrada
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

//Inicia a execução da aplicação (requisição)
$app->run();