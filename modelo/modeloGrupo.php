<?php

class Grupo {

    private $grupo;
    private $nombreGrupo;

    public function __construct() {
        $this->grupo = array();
        $this->link = new mysqli('localhost', 'root', '', 'agenda');
    }

    private function set_names() {
        return $this->link->query("SET NAMES 'utf8'");
    }

    public function listar_grupos() {
        self::set_names();
        $sql = "call spListarGrupos()";
        $result = $this->link->query($sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $this->grupo[] = $row;
        }
        $result->free_result();
        $this->link->close();
        return $this->grupo;
    }

}