<?php

  session_start();

  //
  include_once("../conexionBD/docentesBD.php");
  $db = new docentesBD();
  //

//////////////////////// MODIFICAR //////////////////////////////
if (isset($_POST['btnModificar'])) {
  $cedula= isset($_POST['txtCedula'])?$_POST['txtCedula']:"";
  $nombre= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
  $apellidos= isset($_POST['txtApellidos'])?$_POST['txtApellidos']:"";
  $grado_academico= isset($_POST['cboGrado'])?$_POST['cboGrado']:"";
  $tipo_contrato= isset($_POST['cboContrato'])?$_POST['cboContrato']:"";
  $db->modificarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);
  header("Location: ../masterPage.php");
  exit();
}

////////////////////// ELIMINAR //////////////////////////////////
if (isset($_POST['btnEliminar'])) {
  $db->borrarDocente($_POST['txtCedula']);
  $_SESSION['mensaje-modal']= "Usuario borrado con éxito";
  header('Location: ../masterPage.php');
  exit();
}

//////////////////// AGREGAR ////////////////////////////////
if (isset($_POST['btnRegistrar'])) {

  $_SESSION['mensaje-modal']="";

  $cedula= isset($_POST['txtCedula'])?$_POST['txtCedula']:"";
  $nombre= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
  $apellidos= isset($_POST['txtApellidos'])?$_POST['txtApellidos']:"";
  $grado_academico= isset($_POST['cboGrado'])?$_POST['cboGrado']:"";
  $tipo_contrato= isset($_POST['cboContrato'])?$_POST['cboContrato']:"";

  $_SESSION['mensaje-modal']="";
  $_SESSION['docente']= array(
    'cedula' => $cedula,
    'nombre' => $nombre,
    'apellidos' => $apellidos,
    'grado_academico'=> $grado_academico,
    'tipo_contrato'=> $tipo_contrato,
  );

  $_SESSION['registrando'] = 1;

  if(empty($cedula)) {
    $_SESSION['mensaje-modal']= "Se debe la ingresar la cédula del docente";
    header("Location: ../masterPage.php");
    exit();
  } else {
    $resultado = $db->obtenerDocentes();
    if (!is_null($resultado)) {
      while ($fila= mysqli_fetch_assoc($resultado)) {
        if ($fila['cedula']==$cedula) {
          $_SESSION['mensaje-modal']= "El docente ya existe";
          header("Location: ../masterPage.php");
          exit();
        }
      }
    }

    if (empty($nombre)) {
      $_SESSION['mensaje-modal']= "Debe ingresar el nombre";
      header("Location: ../masterPage.php");
      exit();
    }

    if (empty($apellidos)) {
      $_SESSION['mensaje-modal']= "Debe ingresar los apellidos";
      header("Location: ../masterPage.php");
      exit();
    }

    $seRealizo = $db->agregarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);

    if ($seRealizo) {
      unset($_SESSION['docente']);
      $_SESSION['registrando'] = 0;
      header("Location: ../masterPage.php");
      $_SESSION['mensaje-modal']= "";
      exit();
    } else {
      $_SESSION['mensaje-modal']= "Ocurrió un error cuando se agregó un docente";
      header("Location: ../masterPage.php");
      exit();
    }
  }
}

  ?>
