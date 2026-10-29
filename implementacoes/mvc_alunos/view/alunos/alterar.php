<?php

include_once(__DIR__ . "/../../model/Aluno.php");
include_once(__DIR__ . "/../../controller/AlunoController.php");

$msgErro = "";
$aluno = NULL;

if(isset($_POST['nome'])) {
    //Já clicou no gravar
    
    //TODO - Alterar

} else {
    //Apenas entrou na interface para realizar a alteração

    //1- Capturar o ID do aluno a ser alterado
    $id = 0;
    if(isset($_GET["id"]))
        $id = $_GET["id"];

    //2- Validar se o ID foi recebido
    if(! $id) {
        echo "ID inválido!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }

    //TODO - 3- Carregar os dados do aluno
}

//Incluiro o formulário
include_once(__DIR__ . "/form.php");