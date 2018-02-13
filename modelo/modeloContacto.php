<?php

class Contacto {

    private $contacto;
    private $nombre;
    private $apellido;
    private $telefono;
    private $emails;
    private $grupos;
    private $poblacion;

    public function __construct() {
        $this->contacto = array();
        $this->link = new mysqli('localhost', 'root', '', 'agenda');
    }

    private function set_names() {
        return $this->link->query("SET NAMES 'utf8'");
    }

    public function listar_contactos($nombre, $apellido, $grupo) {
        self::set_names();
        $sql = "call spSacarListado('$nombre', '$apellido', '$grupo')";
        $result = $this->link->query($sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $this->contacto[] = $row;
        }
        $result->free_result();
        $this->link->close();
        return $this->contacto;
    }

    public function lista_modificar($pnombre, $papellidos, $ptelefono, $pcorreo1, $correo2, $pgrupo1, $pgrupo2, $pidContBorrar, $poblacion) {

        self::set_names();

        $sql = "CALL updateContacto('$pnombre','$papellidos',$ptelefono,'$pcorreo1','$correo2','$pgrupo1',"
                . "'$pgrupo2', '$pidContBorrar', '$poblacion')";
        $this->link->query($sql);
    }

    public function insertar_contacto($nombre, $apellido, $telefono, $grupo1, $grupo2, $email1, $email2, $poblacion) {
        $sql = "call spInsertarContacto('$nombre', '$apellido', $telefono, $grupo1, $grupo2, '$email1', '$email2', '$poblacion')";
        mysqli_query($this->link, $sql);
        mysqli_close($this->link);
    }

    public function eliminar_contacto($idContacto) {
        $sql = "call spEliminarContacto($idContacto)";
        mysqli_query($this->link, $sql);
        mysqli_close($this->link);
    }

    public function consulta_modificar() {
        self::set_names();
        $sql = "CALL listarContactos()";
        foreach ($this->link->query($sql) as $res) {
            $this->contacto[] = $res;
        }
        return $this->contacto;
        $this->link = null;
    }

}
