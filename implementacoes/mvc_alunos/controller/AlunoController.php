<?php

include_once(__DIR__ . "/../dao/AlunoDAO.php");
include_once(__DIR__ . "/../model/Aluno.php");
include_once(__DIR__ . "/../service/AlunoService.php");


class AlunoController {

    private AlunoDAO $alunoDAO;
    private AlunoService $alunoService;

    public function __construct() {
        $this->alunoDAO = new AlunoDAO();
        $this->alunoService = new AlunoService();
    }

    public function listar() {
        return $this->alunoDAO->listar();
    }

    public function buscarPorId(int $id): ?Aluno {
        return $this->alunoDAO->buscarPorId($id);
    }

    public function inserir(Aluno $aluno) {
        //1- Validar os dados
        $erros = $this->alunoService->validar($aluno);

        if(empty($erros)) {
            //2- Persistir o objeto (salvar no banco de dados)
            $msgErro = $this->alunoDAO->inserir($aluno);
            if($msgErro)
                array_push($erros, $msgErro);
        }

        return $erros;
    }

    public function alterar(Aluno $aluno) {
        //1- Validar os dados
        $erros = $this->alunoService->validar($aluno);

        if(empty($erros)) {
            //2- Persistir o objeto (salvar no banco de dados)
            $msgErro = $this->alunoDAO->alterar($aluno);
            if($msgErro)
                array_push($erros, $msgErro);
        }

        return $erros;
    }

    public function excluir(int $idAluno) {
        return $this->alunoDAO->excluir($idAluno);
    }


}