<?php

  session_start();

  //
  include_once("../conexionBD/usuariosBD.php");
  $db = new usuariosBD();
  //

//////////////////////// MODIFICAR //////////////////////////////
if (isset($_POST['btnModificar'])) {
  $contrasena= isset($_POST['txtContrasena'])?$_POST['txtContrasena']:"";
  $nombre_usuario= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
  $apellidos= isset($_POST['txtApellidos'])?$_POST['txtApellidos']:"";
  $confirmarContrasena= isset($_POST['txtConfirmar'])?$_POST['txtConfirmar']:"";
  $tipoPerfil= isset($_POST['cboTipoPerfil'])?$_POST['cboTipoPerfil']:"";
  $correo= isset($_POST['txtCorreo'])?$_POST['txtCorreo']:"";

   if ($confirmarContrasena != $contrasena) {
      $_SESSION['mensaje-modal']= "Las contraseñas no coinciden";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        $db->modificarUsuario($_POST['cboUsuario'], $contrasena, $nombre_usuario, $apellidos, $tipoPerfil, $correo, 0);
        header("Location: ../inicio.php");
        exit();
      }
    }
}

/////////////////////// MODIFICAR ACTIVO /////////////////////////
if (isset($_POST['btnModificarHabilitado'])) {

  $id = $_POST['cboUsuariosHabilitar'];

  if (isset($_POST['isHabilitado'])) {
    if ($_POST['isHabilitado'] == "si") {
      $db->habilitarUsuario($id , 1);
    } else {
      $db->habilitarUsuario($id , 0);
    }
  }
  header("Location: ../masterPage.php");
  exit();
}

////////////////////// ELIMINAR //////////////////////////////////
if (isset($_POST['btnEliminar'])) {
  $db->borrarUsuario($_POST['cboUsuario']);
  header('Location: ../masterPage.php');
  exit();
}

//////////////////// AGREGAR ////////////////////////////////
if (isset($_POST['btnRegistrar'])) {

  $_SESSION['mensaje_modal']="";

  include_once("../conexion_bd.php");

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
  $_SESSION['correo']=$correo;

  $_SESSION['registrando'] = 1;

  if(empty($usuario)) {
    if ($_SESSION['masterActivo'] == 1) {
      header("Location: ../masterPage.php");
      exit();
    }
    $_SESSION['mensaje-modal']= "Se debe indicar el usuario";
    header("Location: ../inicio.php");
    exit();
  } else {
    //$sql="SELECT * FROM tb_Usuario";

    //$resultado = mysql_query($sql) or die ("Sql error".mysql_error());

    //
    $resultado = $db->obtenerlistadoDeUsuarios();
    //

    while ($fila= mysqli_fetch_assoc($resultado)) {
      if ($fila['usuario']==$usuario) {
        $_SESSION['mensaje-modal']= "El usuario ya existe";
        if ($_SESSION['masterActivo'] == 1 ) {
          header("Location: ../masterPage.php");
        exit();
        } else {
          header("Location: ../inicio.php");
          exit();
        }
      }
    }

    if (empty($nombre_usuario)) {
      $_SESSION['usuario'] = $usuario;
      $_SESSION['mensaje-modal']= "Debe ingresar el nombre";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        header("Location: ../inicio.php");
        exit();
      }
    }
    if (empty($apellidos)) {
      $_SESSION['nombre_usuario'] = $nombre_usuario;
      $_SESSION['mensaje-modal']= "Debe ingresar los apellidos";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        header("Location: ../inicio.php");
        exit();
      }
    }
    if (empty($correo)) {
      $_SESSION['mensaje-modal']= "Debe ingresar el correo electrónico";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        header("Location: ../inicio.php");
        exit();
      }
    }
    if (empty($contrasena)) {
      $_SESSION['mensaje-modal']= "Debe ingresar la contraseña";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        header("Location: ../inicio.php");
        exit();
      }
    }
    if (empty($confirmarContrasena)) {
      $_SESSION['mensaje-modal']= "Debe confirmar la contraseña";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        header("Location: ../inicio.php");
        exit();
      }
    }

    if ($confirmarContrasena != $contrasena) {
      $_SESSION['mensaje-modal']= "Las contraseñas no coinciden";
      if ($_SESSION['masterActivo'] == 1 ) {
        header("Location: ../masterPage.php");
      exit();
      } else {
        header("Location: ../inicio.php");
        exit();
      }
    }

    $_SESSION['mensaje-modal']="";
    $_SESSION['usuario']="";
    $_SESSION['nombre_usuario'] ="";
    $_SESSION['apellidos']="";
    $_SESSION['correo']="";
    $_SESSION['registrando'] = 0;

    if (isset($_SESSION['masterActivo'])) {
      if ($_SESSION['masterActivo'] == 1 ) {
          $_SESSION['mensaje-modal']="Usuario creado con éxito";
      }
    } else {
          $_SESSION['mensaje']="Usuario solicitato";
    }

    //
    if ($_SESSION['masterActivo'] == 1) {
      $habilitado = 1;
    } else {
      $habilitado = 0;
    }
      $id = $db->agregarUsuario($usuario, $contrasena, $nombre_usuario, $apellidos, $tipoPerfil, $correo, $habilitado);

    //

    /*
    $sql1= "INSERT INTO tb_Usuario VALUES('".$usuario."' , '".md5($contrasena)."' ,'".$nombre_usuario."' ,'".$apellidos."' , ".$tipoPerfil." , '".$correo."', 0)";
    mysql_query($sql1) or die ('Error sql '.mysql_error());
    */

    if ($_SESSION[masterActivo] == 1 ) {
      header("Location: ../masterPage.php");
      exit();
    } else {
      header("Location: ../inicio.php");
      exit();
    }
}

} else {
  header("Location: ../masterPage.php");
  exit();
}

  ?>
