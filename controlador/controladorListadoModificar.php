<?php

require_once("../modelo/modeloContacto.php");
$consultar = new Contacto();
$pd = $consultar->consulta_modificar();
require_once("../vista/vistaModificar.php");
?>