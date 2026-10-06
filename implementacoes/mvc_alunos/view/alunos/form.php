<?php

include_once(__DIR__ . "/../../controller/CursoController.php");


//Carregar a lista de cursos
$cursoCont = new CursoController();
$cursos = $cursoCont->listar();
//print_r($cursos);


//Incluir o cabeçalho da aplicação
include_once(__DIR__ . "/../include/header.php");
?>

<h3>Inserir aluno</h3>

<form action="" method="POST">

    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" 
            name="nome" placeholder="Informe o nome">
    </div>

    <div>
        <label for="idade">Idade:</label>
        <input type="number" id="idade" 
            name="idade" placeholder="Informe a idade">
    </div>

    <div>
        <label for="estrang">Estrangeiro:</label>
        <select name="estrang" id="estrang">
            <option value="">---Selecione---</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>

    <div>
        <label for="curso">Curso:</label>
        <select name="curso" id="curso">
            <option value="">---Selecione---</option>

            <!-- Opções geradas de forma dinâmica -->
            <?php foreach($cursos as $c): ?>
                <option value="<?= $c->getId() ?>"><?= $c ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button>Gravar</button>
    </div>

</form>

<a href="listar.php">Voltar</a>

<?php
//Incluir o rodapé da aplicação
include_once(__DIR__ . "/../include/footer.php");
?>