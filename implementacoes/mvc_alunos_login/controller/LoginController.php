<?php

include_once(__DIR__ . "/../dao/UsuarioDAO.php");
include_once(__DIR__ . "/../service/LoginService.php");

class LoginController {

    private UsuarioDAO $usuarioDao;
    private LoginService $loginService;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
        $this->loginService = new LoginService();
    }

    public function logar(?string $login, ?string $senha) {
        //Validar os dados do formulário
        $erros = $this->loginService->validar($login, $senha); 

        //Validar as credencias (login e senha) na tabela "usuarios"
        if(empty($erros)) {
            //Validar as credencias (login e a senha)
            $usuario = $this->usuarioDao->findByLoginSenha($login, $senha);
            if($usuario) {
                //Realizar o login na aplicação utilizando o recurso de sessões
                $this->loginService->salvarUsuarioSessao($usuario);

            } else {
                array_push($erros, "Login ou senha inválidos!");
            }
        }
        
        
        return $erros;
    }

    public function usuarioEstaLogado() {
        return $this->loginService->usuarioEstaLogado();
    }

    public function deslogar() {
        $this->loginService->removerUsuarioSessao();
    }

    public function getNomeUsuarioLogado() {
        return $this->loginService->getNomeUsuarioLogado();
    }

}