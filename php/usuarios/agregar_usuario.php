<?php

  session_start();

if (isset($_POST['btnRegistrar'])) {

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

  $_SESSION['mensaje-modal']="";
  $_SESSION['usuario']=$usuario;
  $_SESSION['nombre_usuario'] =$nombre_usuario;
  $_SESSION['apellidos']=$apellidos;
  $_SESSION['tipoPerfil']=$tipoPerfil;
  $_SESSION['correo']=$correo;

  $_SESSION['registrando'] = 1;

  if(empty($usuario)) {
    $_SESSION['mensaje-modal']= "Se debe indicar el usuario";
    header("Location: ../inicio.php");

  } else {
    $sql="SELECT * FROM tb_Usuario";

    $resultado = mysql_query($sql) or die ("Sql error".mysql_error());

    while ($fila= mysql_fetch_array($resultado)) {
      if ($fila['usuario']==$usuario) {
        $_SESSION['mensaje-modal']= "El usuario ya existe";
        header("Location: ../inicio.php");
        exit();
      }
    }

    if (empty($nombre_usuario)) {
      $_SESSION['usuario'] = $usuario;
      $_SESSION['mensaje-modal']= "Debe ingresar el nombre";
      header("Location: ../inicio.php");
      exit();
    }
    if (empty($apellidos)) {
      $_SESSION['nombre_usuario'] = $nombre_usuario;
      $_SESSION['mensaje-modal']= "Debe ingresar los apellidos";
      header("Location: ../inicio.php");
      exit();
    }
    if (empty($contrasena)) {
      $_SESSION['mensaje-modal']= "Debe ingresar la contraseña";
      header("Location: ../inicio.php");
      exit();
    }
    if (empty($confirmarContrasena)) {
      $_SESSION['mensaje-modal']= "Debe confirmar la contraseña";
      header("Location: ../inicio.php");
      exit();
    }
    if (empty($correo)) {
      $_SESSION['mensaje-modal']= "Debe ingresar el correo electrónico";
      header("Location: ../inicio.php");
      exit();
    }

    if ($confirmarContrasena != $contrasena) {
      $_SESSION['mensaje-modal']= "Las contraseñas no coinciden";
      header("Location: ../inicio.php");
      exit();
    }

    $_SESSION['mensaje-modal']="";
    $_SESSION['usuario']="";
    $_SESSION['nombre_usuario'] ="";
    $_SESSION['apellidos']="";
    $_SESSION['tipoPerfil']="";
    $_SESSION['correo']="";

    $_SESSION['mensaje']="Usuario solicidato";
    $_SESSION['registrando'] = 0;

    $sql1= "INSERT INTO tb_Usuario VALUES('".$usuario."' , '".$contrasena."' ,'".$nombre_usuario."' ,'".$apellidos."' , ".$tipoPerfil." , '".$correo."', 0)";
    mysql_query($sql1) or die ('Error sql '.mysql_error());
    header("Location: ../inicio.php");
}
} else {
  header("Location: ../masterPage.php");
  exit();
}

  ?>
  
