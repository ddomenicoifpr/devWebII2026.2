<?php

include_once("Connection.php");

//1- Receber o nome a cidade do time (GET)
$nome = "";
if(isset($_GET['nome']))
    $nome = $_GET['nome'];

$cidade = "";
if(isset($_GET['cidade']))
    $cidade = $_GET['cidade'];

//1.1 - Validar os dados
if($nome == '' || $cidade == '') {
    echo "Informe [nome] e a [cidade] do time!<br>";
    echo '<a href="listar.php">Voltar</a>';
    exit;
}


//2- Inserir o time no banco de dados
$sql = "INSERT INTO times (nome, cidade) 
        VALUES ('" . $nome . "', '" . $cidade . "')";
$conn = Connection::getConnection();
$stmt = $conn->prepare($sql);
$stmt->execute();

//3- Redirecionar para a listagem
header("location: listar.php");
