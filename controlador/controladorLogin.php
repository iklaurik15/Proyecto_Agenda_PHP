<?php
    session_start();
    
    require_once("../modelo/Usuario.php");
    
    $comprobar = new Usuario();
    
    if($comprobar->comprobarUsuario()){
        header("Location: ../controlador/controladorContacto.php");
        
    }else if(isset($_POST['chkRecordar'])&&($_POST['chkRecordar']) == true ){
        setcookie("cook_user", $_POST['usuario'], time()+60);
        setcookie("cook_pass", $_POST['password'], time()+60);
        
        header("Location:../vista/vistaListado.php");
    }else{
        $mensaje = "Algo ha ido mal";
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
        echo '<script type="text/javascript">location.href = "../vista/vistaLogin.php";</script>';
    }
    
    
    


