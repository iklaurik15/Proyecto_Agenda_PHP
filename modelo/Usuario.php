<?php

class Usuario {

    private $user;
    private $pass;
    private $link;

    public function __construct() {
        $this->Usuario = array();
        $this->link = new mysqli('localhost', 'root', '', 'agenda');
    }

    public function comprobarUsuario() {
            $user = $_POST['usuario'];
            $password = $_POST['password'];            
            $sql = "select user, pass from usuarios where user = '$user'";
            $result = mysqli_query($this->link, $sql);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $passEncriptada=$row['pass'];
                echo $passEncriptada;
                echo $password;
            }
            if (password_verify($password, $passEncriptada)) {
                    $_SESSION['Logueado'] = $user;
                    return true;
                } else {
                    echo "false";
                    return false;
                }
    }
    
    public function crearUsuario($user,$contrasenaEncriptada) {            
            $sql = "insert into usuarios (user, pass, esAdmin) values ('$user', '$contrasenaEncriptada', 0)";
            mysqli_query($this->link, $sql);
    }

}
