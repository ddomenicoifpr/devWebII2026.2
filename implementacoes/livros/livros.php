<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("persistencia.php");

//Buscar os livros já cadastros do arquivo JSON
$livros = buscarDados("livros.json");
//echo "<pre>" . print_r($livros, true) . "</pre>";

$msgErro = "";

//Verificar se o usuário já enviou o formulário
if(isset($_POST["titulo"])) {
    //Capturar os dados do formulário
    $titulo = $_POST["titulo"];
    $autor  = $_POST["autor"];
    $genero = $_POST["genero"];
    $nroPag = $_POST["qtd_paginas"];

    //Validação dos dados
    $erros = array();
    if(trim($titulo) == "") {
        array_push($erros, "Informe o título!");
    }
    if(trim($autor) == "") {
        array_push($erros, "Informe o autor!");
    }
    if(trim($genero) == "") {
        array_push($erros, "Informe o gênero!");
    }
    if(trim($nroPag) == "") {
        array_push($erros, "Informe o número de páginas!");
    }

    if(count($erros) == 0) {
        //Salvar os dados do livro no arquivo JSON
        $livro = array(
            "id" => uniqid(),
            "titulo" => $titulo,
            "autor"  => $autor,
            "genero" => $genero,
            "qtd_paginas" => $nroPag
        );
        array_push($livros, $livro);

        salvarDados($livros, "livros.json");

        header("location: livros.php");
    } else {
        //print_r($erros);
        $msgErro = implode("<br>" , $erros);
    }
}



?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
</head>
<body>

<h1>Cadastro de livros</h1>

<h3>Cadastre seu livro aqui</h3>

<!--form method="POST" action="" onsubmit="return validar();" -->
<form method="POST" action="" >
    <input type="text" name="titulo" id="titulo" 
        placeholder="Informe o título" />
    
    <br><br>

    <input type="text" name="autor" id="autor" 
        placeholder="Informe o autor"  />
    
    <br><br>

    <select name="genero" id="genero">
        <option value="">--Selecione o gênero--</option>
        <option value="D">Drama</option>
        <option value="F">Ficção</option>
        <option value="R">Romance</option>
        <option value="O">Outro</option>
    </select>
    <br><br>

    <input type="number" name="qtd_paginas" id="qtd_paginas" 
        placeholder="Informe o número de páginas">
    <br><br>

    <input type="submit" value="Enviar" />
</form>

<div id="divErro" style="color: red;">
   <?= $msgErro ?> 
</div>

<h3>Livros cadastrados</h3>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Gênero</th>
        <th>Quant. Páginas</th>
        <th>Excluir</th>
    </tr>

    <?php foreach($livros as $l): ?>

        <tr>
            <td><?php echo $l["id"] ?></td>
            <td><?php echo $l["titulo"] ?></td>
            <td><?= $l["autor"] ?></td>
            <td><?php 
                if($l["genero"] == "D")
                    echo "Drama";
                else if($l["genero"] == "F")
                    echo "Ficção";
                else if($l["genero"] == "R")
                    echo "Romance";
                else if($l["genero"] == "O")
                    echo "Outro";
            ?></td>

            <td><?php echo $l["qtd_paginas"] ?></td>
            <td>
                <a href="livros_excluir.php?id=<?php echo $l["id"] ?>"
                    onclick="return confirm('Confirma a exclusão?');">Excluir</a>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

<script src="validacao.js"></script>

</body>
</html>
