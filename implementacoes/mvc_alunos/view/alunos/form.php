<?php

include_once(__DIR__ . "/../../controller/CursoController.php");


//Carregar a lista de cursos
$cursoCont = new CursoController();
$cursos = $cursoCont->listar();
//print_r($cursos);


//Incluir o cabeçalho da aplicação
include_once(__DIR__ . "/../include/header.php");
?>

<h3><?= $aluno && $aluno->getId() > 0 ? "Alterar" : "Inserir" ?> aluno</h3>

<div class="row">
    <div class="col-6">

        <form action="" method="POST">

            <div>
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" 
                    name="nome" placeholder="Informe o nome"
                    value="<?= $aluno ? $aluno->getNome() : '' ?>"
                    class="form-control">
            </div>

            <div>
                <label for="idade" class="form-label">Idade:</label>
                <input type="number" id="idade" 
                    name="idade" placeholder="Informe a idade"
                    value="<?= $aluno ? $aluno->getIdade() : '' ?>"
                    class="form-control">
            </div>

            <div>
                <label for="estrang" class="form-label">Estrangeiro:</label>
                <select name="estrang" id="estrang" class="form-control">
                    <option value="">---Selecione---</option>
                    <option value="S"
                        <?= $aluno && $aluno->getEstrangeiro() == 'S' ? "selected" : "" ?> >
                        Sim</option>
                    <option value="N"
                        <?= $aluno && $aluno->getEstrangeiro() == 'N' ? "selected" : "" ?> >
                        Não</option>
                </select>
            </div>

            <div>
                <label for="curso" class="form-label">Curso:</label>
                <select name="curso" id="curso" class="form-control">
                    <option value="">---Selecione---</option>

                    <!-- Opções geradas de forma dinâmica -->
                    <?php foreach($cursos as $c): ?>
                        <option value="<?= $c->getId() ?>" 
                        
                            <?php if($aluno && $aluno->getCurso()->getId() == $c->getId() )
                                    echo "selected";    
                            ?>
                        
                        ><?= $c ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <input type="hidden" name="id"
                    value="<?= $aluno ? $aluno->getId() : 0 ?>">
            </div>

            <div class="mt-3">
                <button class="btn btn-success">Gravar</button>
            </div>

        </form>
    </div>

    <div class="col-6">

        <?php if($msgErro): ?>
            <div class="alert alert-danger">
                <?= $msgErro ?>
            </div>
        <?php endif; ?>
    </div>

</div> <!-- Fecha row -->

<a class="btn btn-outline-secondary mt-3" href="listar.php">Voltar</a>

<?php
//Incluir o rodapé da aplicação
include_once(__DIR__ . "/../include/footer.php");
?>