<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Aluno.php");

class AlunoDAO {

    public function listar() {

        $sql = "SELECT a.*, 
                    c.nome nome_curso, c.turno turno_curso  
                FROM alunos a
                JOIN cursos c ON (c.id = a.id_curso)";
        $conn = Connection::getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        //Converter os dados para objetos -> classe Aluno
        $alunos = $this->map($result);

        return $alunos;
    }

    public function buscarPorId(int $id) {
        
        $sql = "SELECT a.*, 
                    c.nome nome_curso, c.turno turno_curso  
                FROM alunos a
                JOIN cursos c ON (c.id = a.id_curso)
                WHERE a.id = ?";
        $conn = Connection::getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();

        //Criar o objeto Aluno
        $alunos = $this->map($result);

        if(count($alunos) == 1)
            return $alunos[0];
        elseif(count($alunos) == 0)
            return null;

        die("AlunoDAO.buscarPorId - Erro: mais de um aluno".
                " encontrado para o ID " . $id);
    }

    public function inserir(Aluno $aluno) {
        $sql = "INSERT INTO alunos (nome, idade, estrangeiro, id_curso)
                VALUES (?, ?, ?, ?)";
        
        try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($aluno->getNome(),
                                $aluno->getIdade(),
                                $aluno->getEstrangeiro(),
                                $aluno->getCurso()->getId()));
        } catch(PDOException $e) {
            return "Erro ao inserir o aluno! " . $e->getMessage();
        }

        return "";
    }

    public function alterar(Aluno $aluno) {
        $conn = Connection::getConnection();

        $sql = "UPDATE alunos 
                SET nome = ?, idade = ?, estrangeiro = ?, id_curso = ?
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        try {
            $stmt->execute([$aluno->getNome(), $aluno->getIdade(), 
                            $aluno->getEstrangeiro(), $aluno->getCurso()->getId(),
                            $aluno->getId()]);
        } catch (PDOException $e) {
            return "Erro ao alterar o aluno! " . $e->getMessage();
        }

        return "";
    }

    public function excluir(int $idAluno) {
        $sql = "DELETE FROM alunos WHERE id = ?";
        
        try {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($idAluno));
        } catch(PDOException $e) {
            return "Erro ao excluir o aluno! " . $e->getMessage();
        }

        return "";
    }

    public function map(array $dados) {
        $alunos = array();

        foreach($dados as $d) {
            $aluno = new Aluno();
            $aluno->setId($d["id"]);
            $aluno->setNome($d["nome"]);
            $aluno->setEstrangeiro($d["estrangeiro"]);
            $aluno->setIdade($d["idade"]);
            
            $curso = new Curso();
            $curso->setId($d["id_curso"]);
            $curso->setNome($d["nome_curso"]);
            $curso->setTurno($d["turno_curso"]);
            $aluno->setCurso($curso);

            array_push($alunos, $aluno);
        }

        return $alunos;
    }

}

