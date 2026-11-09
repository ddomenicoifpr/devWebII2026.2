<?php

//Mostrar erros do PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Configurar essas variáveis de acordo com o seu ambiente
define("DB_HOST", "mysql-server");
define("DB_NAME", "db_crud");
define("DB_USER", "root");
define("DB_PASSWORD", "root");

//Constante para a URL do sistema
define("BASE_URL", "/devWeb2/mvc_alunos_login");

//Constantes para os dados da sessão
define("USU_LOGADO_ID",   "usuarioLogadoId");
define("USU_LOGADO_NOME", "usuarioLogadoNome");
