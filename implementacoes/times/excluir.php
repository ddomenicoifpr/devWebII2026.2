<?php

include_once("Connection.php");

//1- Receber o ID do time
$id = 0;
if(isset($_GET["id"]))
    $id = $_GET['id'];

//1.1- Validar se o ID existe
if($id == 0 || !is_numeric($id)) {
    echo "ID inválido!<br>";
    echo '<a href="listar.php">Voltar</a>';
    exit;
}

//2- Excluir o time do banco de dados
$sql = "DELETE FROM times WHERE id = " . $id;
$conn = Connection::getConnection();
$stmt = $conn->prepare($sql);
$stmt->execute();

//3- Redirecionar para a listagem
header("location: listar.php");