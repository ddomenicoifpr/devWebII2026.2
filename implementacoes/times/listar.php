<?php

include_once("Connection.php");

$conn = Connection::getConnection();
//Teste da conexão com o banco
//print_r($conn);

$sql = "SELECT * FROM times";
$stmt = $conn->prepare($sql);
$stmt->execute();

$dados = $stmt->fetchAll();
//echo "<pre>" . print_r($dados, true) . "</pre>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de times</title>
</head>
<body>

    <h2>Listagem de times</h2>

    <table>

        <!-- Cabeçalho -->
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cidade</th>
            <th></th>
        </tr>

        <!-- Dados -->
        <?php foreach($dados as $time): ?>
            <tr>
                <td><?= $time["id"] ?></td>
                <td><?= $time["nome"] ?></td>
                <td><?= $time["cidade"] ?></td>
                <td>
                    <a href="excluir.php?id=<?= $time["id"] ?>"
                       onclick="return confirm('Confirma a exclusão?');">
                        Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <a href="inserir.php?nome=Flamengo&cidade=Rio">Inserir</a>

 
</body>
</html>