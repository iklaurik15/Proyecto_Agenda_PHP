
<?php

session_start();
unset($_SESSION['Logueado']);
session_destroy();
header("Location: ../vista/vistaLogin.php");
?>
