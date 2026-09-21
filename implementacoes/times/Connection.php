<?php

//Criar a classe de conexão
class Connection
{
    private static $conn = null;

    public static function getConnection()
    {

        if (self::$conn == null) {
            try {
                $opcoes = array(
                    //Define o charset da conexão
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    //Define o tipo do erro como exceção
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    //Define o retorno das consultas como
                    //array associativo (campo => valor)
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                );

                self::$conn =
                    new PDO(
                        "mysql:host=mysql-server;dbname=db_times",
                        "root",
                        "root",
                        $opcoes
                    );
            } catch (PDOException $e) {
                echo "Erro ao conectar com o banco!";
                echo $e->getMessage();
            }
        }
        return self::$conn;
    }
}
