<?php

include_once(__DIR__ . "/../../model/Aluno.php");

//Capturar os dados do formulário
if(isset($_POST['nome'])) {
    $nome    = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
    $idade   = is_numeric($_POST['idade']) ? $_POST['idade'] : NULL;
    $estrang = trim($_POST['estrang']) ? trim($_POST['estrang']) : NULL;
    $idCurso = is_numeric($_POST['curso']) ? $_POST['curso'] : NULL;

    $aluno = new Aluno();
    $aluno->setNome($nome);
    $aluno->setIdade($idade);
    $aluno->setEstrangeiro($estrang);
    
    $curso = new Curso();
    $curso->setId($idCurso);
    $aluno->setCurso($curso);

    print_r($aluno);
}


//Incluiro o formulário
include_once(__DIR__ . "/form.php");


?>