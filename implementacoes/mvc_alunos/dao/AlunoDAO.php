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