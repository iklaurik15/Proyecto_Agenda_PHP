<?php
    require_once("../modelo/modeloContacto.php");
    $c = new Contacto();
    $idContacto = $_POST['eliminar'];
    $c->eliminar_contacto($idContacto);
    require_once("../vista/vistaListado.php");
?>