<?php 

//Testar a conexão
/*
include_once(__DIR__ . "/../../util/Connection.php");
$conn = Connection::getConnection();
print_r($conn);
*/

include_once(__DIR__ . "/../../controller/AlunoController.php");

//Carregar a lista de alunos
$alunoCont = new AlunoController();
$alunos = $alunoCont->listar();
print_r($alunos);


//Incluir o cabeçalho da aplicação
include_once(__DIR__ . "/../include/header.php");
?>


<h3>Listagem de alunos</h3>

<table>
    <!-- Cabeçalho -->
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Estrangeiro</th>
        <th>Curso</th>
    </tr>


    <!-- Dados -->
</table>

<?php
//Incluir o rodapé da aplicação
include_once(__DIR__ . "/../include/footer.php");
?>
    
