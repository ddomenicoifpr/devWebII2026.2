<?php

include_once(__DIR__ . "/../../controller/AlunoController.php");

//1- Capturar o ID do aluno a ser excluído
$id = 0;
if(isset($_GET["id"]))
    $id = $_GET["id"];

//2- Validar se o ID foi recebido
if(! $id) {
    echo "ID inválido!<br>";
    echo "<a href='listar.php'>Voltar</a>";
    exit;
}

//3- Excluir o aluno
$alunoCont = new AlunoController();
$alunoCont->excluir($id);

//4- Redirecionar para a listagem 
header("location: listar.php");

