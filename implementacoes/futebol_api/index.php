<?php
//Habila os erros no php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
$app->addErrorMiddleware(true, true, true); //Retorna um erro do Framework caso não tratado

//ROTAS
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Funcionou!");
    return $response;
});

// /futebol_api/ola/Daniel
$app->get("/ola/{nome}", function(Request $request, Response $response, $args) {
    $nome = $args["nome"];

    $response->getBody()->write("Olá mundo!");
    $response->getBody()->write("<br>Seja bem vindo " . $nome);
    return $response;
} );

// futebol_api/ola2?nome=Daniel
$app->get("/ola2", function(Request $request, Response $response, $args) {
    $parametros = $request->getQueryParams();

    $nome = "";
    if(isset($parametros['nome']))
        $nome = $parametros['nome'];

    if($nome)
        $response->getBody()->write("Obrigado pelo acesso " . $nome);
    else
        $response->getBody()->write("Obrigado pelo acesso");
    
    return $response;
});

//CLUBES
$app->get("/clubes", ClubeController::class . ":listar");

//Tratamento para rota não encontrada
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

//Inicia a execução da aplicação (requisição)
$app->run();