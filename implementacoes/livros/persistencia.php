<?php

define("DIR_ARQUIVOS", "arquivos");

function salvarDados(array $dados, string $nomeArquivo) {
    $json = json_encode($dados, 
                        JSON_PRETTY_PRINT);
                        
    file_put_contents(DIR_ARQUIVOS . "/" . $nomeArquivo, 
                      $json);
}

function buscarDados(string $nomeArquivo) : array {
    $dados = array();

    if(file_exists(DIR_ARQUIVOS . "/" . $nomeArquivo)) {
        $json = file_get_contents(DIR_ARQUIVOS . "/" . $nomeArquivo);
        $dados = json_decode($json, true);
    }

    return $dados;
}