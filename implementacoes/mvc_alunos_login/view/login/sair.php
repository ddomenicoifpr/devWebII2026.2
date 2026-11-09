<?php

include_once(__DIR__ . "/../../controller/LoginController.php");
include_once(__DIR__ . "/../../util/config.php");

$loginCont = new LoginController();
$loginCont->deslogar();
header("location: login.php");