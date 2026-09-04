function validar() {
    var divErro = document.querySelector("#divErro");

    var titulo = document.getElementById("titulo").value;
    var autor  = document.querySelector("#autor").value;
    var genero = document.querySelector("#genero").value;
    var pag    = document.querySelector("#qtd_paginas").value;

    //console.log(titulo + " - " + autor  + " - " + genero  + " - " + pag);

    if(titulo.trim() == '') {
        divErro.innerHTML = "Informe o título!";
        return false;
    }

    if(autor.trim() == '') {
        divErro.innerHTML = "Informe o autor!";
        return false;
    }

    //Validar gênero
    if(genero.trim() == '') {
        divErro.innerHTML = "Informe o gênero!";
        return false;
    }

    //Validar páginas
    if(pag.trim() == '') {
        divErro.innerHTML = "Informe a quantidade de páginas!";
        return false;
    }

    return true;
}