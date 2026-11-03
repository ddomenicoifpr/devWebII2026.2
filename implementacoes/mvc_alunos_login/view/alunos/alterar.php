<?php

include_once(__DIR__ . "/../../model/Aluno.php");
include_once(__DIR__ . "/../../controller/AlunoController.php");

$msgErro = "";
$aluno = NULL;

$alunoCont = new AlunoController();

if(isset($_POST['nome'])) {
    //Já clicou no gravar
    $id      = $_POST['id'];
    $nome    = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
    $idade   = is_numeric($_POST['idade']) ? $_POST['idade'] : NULL;
    $estrang = trim($_POST['estrang']) ? trim($_POST['estrang']) : NULL;
    $idCurso = is_numeric($_POST['curso']) ? $_POST['curso'] : NULL;

    $aluno = new Aluno();
    $aluno->setId($id);
    $aluno->setNome($nome);
    $aluno->setIdade($idade);
    $aluno->setEstrangeiro($estrang);
    
    $curso = new Curso();
    $curso->setId($idCurso);
    $aluno->setCurso($curso);

    $erros = $alunoCont->alterar($aluno);

    if(empty($erros)) {
        header("location: listar.php");
        exit;
    } else
        $msgErro = implode("<br>", $erros);

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

    //3- Carregar os dados do aluno
    $aluno = $alunoCont->buscarPorId($id);

    if(! $aluno) {
        echo "Nenhum aluno encontraro para o ID!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }

}

//Incluir o formulário
include_once(__DIR__ . "/form.php");