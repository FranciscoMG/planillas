<?php

  session_start();
  $_SESSION['mensaje_modal'];

  include_once("../conexion_bd.php");

  session_start();
  $usuario= isset($_POST['txtUsuario'])?$_POST['txtUsuario']:"";
  $contrasena= isset($_POST['txtContrasena'])?$_POST['txtContrasena']:"";
  $nombre_usuario= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
  $apellidos= isset($_POST['txtApellidos'])?$_POST['txtApellidos']:"";
  $confirmarContrasena= isset($_POST['txtConfirmar'])?$_POST['txtConfirmar']:"";
  $tipoPerfil= isset($_POST['cboTipoPerfil'])?$_POST['cboTipoPerfil']:"";
  $correo= isset($_POST['txtCorreo'])?$_POST['txtCorreo']:"";


  if(empty($usuario) || empty($contrasena)) {
    $_SESSION['mensaje']= "Se debe indicar el Usuario y/o contraseña";
    /*echo "<script type='text/javascript'>
      document.getElementById('modalRegistro').style.display='none';
      document.getElementById('modalRegistro').class='modal fade in';
      document.getElementByTagName('body').style.padding-right='13px';
      document.getElementByTagName('body').class='index modal-open';
    </script>";*/
  } else {
    $sql="SELECT * FROM tb_Usuario";

    $resultado = mysql_query($sql) or die ("Sql error".mysql_error());

    while ($fila= mysql_fetch_array($resultado)) {
      if ($fila['usuario']==$usuario) {
        $_SESSION['mensaje']= "El usuario ya existe";
        header("Location: ../inicio.php");
      }
    }
    $sql1= "INSERT INTO tb_Usuario VALUES('".$usuario."' , '".$contrasena."' ,'".$nombre_usuario."' ,'".$apellidos."' , ".$tipoPerfil." , '".$correo."', 0)";
    mysql_query($sql1) or die ('Error sql '.mysql_error());
    header("Location: ../inicio.php");
}

  ?>
  
