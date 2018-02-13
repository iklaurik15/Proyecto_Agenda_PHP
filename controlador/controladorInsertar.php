<?php
    require_once("../modelo/modeloContacto.php");
    $c = new Contacto();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $grupo1 = $_POST['grupo1'];
    $grupo2 = $_POST['grupo2'];
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $poblacion = $_POST['poblacion'];
    $c->insertar_contacto($nombre, $apellido, $telefono, $grupo1, $grupo2, $email1, $email2, $poblacion);
    echo '<script type="text/javascript">location.href = "../controlador/controladorContacto.php";</script>';
?>