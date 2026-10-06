<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Curso.php");

class CursoDAO {

    public function listar() {

        $sql = "SELECT * FROM cursos";
        $conn = Connection::getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $cursos = $this->map($result);
        return $cursos;
    }

    private function map(array $dados): array {
        $cursos = array();

        foreach($dados as $d) {
            $curso = new Curso();
            $curso->setId($d["id"]);
            $curso->setNome($d["nome"]);
            $curso->setTurno($d["turno"]);

            array_push($cursos, $curso);
        }

        return $cursos;
    }


}