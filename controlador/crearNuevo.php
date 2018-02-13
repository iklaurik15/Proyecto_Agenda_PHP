<?php
    
    require_once("../modelo/Usuario.php");
    
    $user = $_POST['usuario'];
    $password = $_POST['password'];
    $opciones = ['cost'=>12];
    $contrasenaEncriptada = password_hash($password, PASSWORD_BCRYPT, $opciones);
    
    $crear = new Usuario();
    $crear->crearUsuario($user,$contrasenaEncriptada);
    
    header("Location: ../vista/vistaLogin.php");
    
    
    


