<?php
session_start();
require_once("../modelo/modeloContacto.php");
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['grupo'])) {
    $n = $_POST['nombre'];
    $a = $_POST['apellido'];
    $g = $_POST['grupo'];
}else{
    $n = "";
    $a = "";
    $g = "";
}

$c = new Contacto();
$contacto = $c->listar_contactos($n, $a, $g);
require_once("../vista/vistaListado.php");
?>