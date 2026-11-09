<?php

include_once(__DIR__ . "/../../controller/LoginController.php");
include_once(__DIR__ . "/../../util/config.php");

$loginCont = new LoginController();
$logado = $loginCont->usuarioEstaLogado();
if(! $logado) {
    header("location: " . BASE_URL . "/view/login/login.php");
    exit;
}