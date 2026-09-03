<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("persistencia.php");

//1- Rebeceber o ID do livro
if(! isset($_GET["id"])) {
    echo "Parâmetro ID não informado!";
    exit;
}

$id = $_GET["id"];

//2- Buscar os livros existentes no arquivo JSON
$livros = buscarDados("livros.json");

//3- Encontrar o índice do livro a ser excluir
$indice = 0;
foreach($livros as $l) {
    if($l["id"] == $id) {
        break;
    }
    $indice++;
}

//4- Executar a função para excluir do array
array_splice($livros, $indice, 1);

//5- Salvar os dados no arquivo JSON
salvarDados($livros, "livros.json");

//6- Redirecionar para o livros.php
header("location: livros.php");