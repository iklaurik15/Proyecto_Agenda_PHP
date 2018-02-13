<?php
require_once("../modelo/modeloGrupo.php");

$g = new Grupo();
$grupo = $g->listar_grupos();
require_once("../vista/vistaListarGrupos.php");
?>