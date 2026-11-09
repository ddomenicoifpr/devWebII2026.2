<?php

include_once(__DIR__ . "/../util/config.php");
include_once(__DIR__ . "/../model/Usuario.php");

class LoginService {

    public function validar(?string $login, ?string $senha): array {
        $erros = array();

        if(! $login)
            array_push($erros, "Informe o login!");

        if(! $senha)
            array_push($erros, "Informe a senha!");
        
        return $erros;
    }

    public function salvarUsuarioSessao(Usuario $usuario) {
        session_start();
        $_SESSION[USU_LOGADO_ID]   = $usuario->getId();
        $_SESSION[USU_LOGADO_NOME] = $usuario->getNome();
    }

    public function usuarioEstaLogado() {
        session_start();
        if(isset($_SESSION[USU_LOGADO_ID]))
            return true;

        return false;
    }

    public function removerUsuarioSessao() {
        session_start();

        session_unset();
        session_destroy();
    }

}