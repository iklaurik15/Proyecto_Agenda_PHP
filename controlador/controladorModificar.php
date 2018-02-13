<?php

require_once("../modelo/modeloContacto.php");
$modificar = new Contacto();

$update = $modificar->lista_modificar($_POST["nombre"], $_POST["apellido"], $_POST["telefono"], $_POST["email1"], $_POST["email2"], $_POST["grupo1"], $_POST["grupo2"],  $_POST["contacts"], $_POST["poblacion"]);

require_once("../controlador/controladorListadoModificar.php");
echo '<script type="text/javascript">location.href = "../controlador/controladorContacto.php";</script>';
?>

