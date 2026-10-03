<?php

include_once(__DIR__ . "/../dao/AlunoDAO.php");

class AlunoController {

    private AlunoDAO $alunoDAO;

    public function __construct() {
        $this->alunoDAO = new AlunoDAO();
    }

    public function listar() {
        return $this->alunoDAO->listar();
    }


}