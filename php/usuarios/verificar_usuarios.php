<?php
  include_once("../conexion_bd.php");

  session_start();

  $usuario= isset($_POST['txtUsuario'])?$_POST['txtUsuario']:"";
  $contrasena= isset($_POST['txtContrasena'])?$_POST['txtContrasena']:"";



  if(empty($usuario) || empty($contrasena)) {
    $_SESSION['mensaje']= "Se debe indicar el usuario y/o contraseña";
    header("Location: ../inicio.php");
  } else {
    $sql="SELECT * FROM tb_Usuario";


    $resultado = mysql_query($sql) or die ("Sql error".mysql_error());
$_SESSION['mensaje']="";
    while ($fila = mysql_fetch_array($resultado)) {

      if ($usuario == $fila['usuario']) {

        if ($contrasena == $fila['contrasena']) {

          if($fila['habilitado']== 1) {
            $_SESSION['usuario']=$usuario;
            $_SESSION['contrasena']=$contrasena;
            $_SESSION['tipoPerfil']=$fila['perfil'];
            $_SESSION['nombre_usuario']=$fila['nombre_usuario']." ".$fila['apellido_usuario'];
            header("Location: ../masterPage.php");
            exit();
        } else {
          $_SESSION['mensaje']= "El perfil no está habilitado";
          header("Location: ../inicio.php");
          exit();
        }
        } else {
          $_SESSION['mensaje']="La contraseña no existe";
          header("Location: ../inicio.php");
          exit();
        }
      } else {
        $_SESSION['mensaje']= "El usuario no existe";
      }
    }
  }
  header("Location: ../inicio.php");

  echo "<script> alert('No hay información en la base de datos'); </script>";
?>
