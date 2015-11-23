<?php session_start(); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php $db= new docentesBD(); ?>
<?php

$cedula = $_POST['cboxIDDocente'];
$nombre = $_POST['txtNombre'];
$apellidos = $_POST['txtApellidos'];
$grado_academico = $_POST['cboGrado'];
$tipo_contrato = $_POST['cboContrato'];

//////////////////////// MODIFICAR //////////////////////////////
if (isset($_POST['btnModificar'])) {
  $cedula= isset($_POST['txtCedula'])?$_POST['txtCedula']:"";
  $nombre= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
  $apellidos= isset($_POST['txtApellidos'])?$_POST['txtApellidos']:"";
  $grado_academico= isset($_POST['cboGrado'])?$_POST['cboGrado']:"";
  $tipo_contrato= isset($_POST['cboContrato'])?$_POST['cboContrato']:"";
  $db->modificarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);
  header('Location: ../masterPage.php');
  exit();
}

////////////////////// ELIMINAR //////////////////////////////////
if (isset($_POST['btnEliminar'])) {
  $db->borrarDocente($_POST['txtCedula']);
  $_SESSION['alerta'] = 1;
  $_SESSION['alerta-contenido'] = "Usuario borrado con éxito";
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

  if(empty($cedula)) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Se debe la ingresar la cédula del docente";
    header("Location: ../masterPage.php?modalDocentes=1");
    exit();
  } else {
    $resultado = $db->obtenerDocentes();
    while ($fila= mysqli_fetch_assoc($resultado)) {
      if ($fila['cedula']==$cedula) {
        $_SESSION['alerta'] = 1;
  			$_SESSION['alerta-contenido'] = "El docente ya existe";
        header("Location: ../masterPage.php?modalDocentes=1");
        exit();
      }
    }

    if (empty($nombre)) {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Debe ingresar el nombre";
      header("Location: ../masterPage.php");
      exit();
    }

    if (empty($apellidos)) {
      $_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "Debe ingresar los apellidos";
      header("Location: ../masterPage.php");
      exit();
    }

    $seRealizo = $db->agregarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);

    if (!$seRealizo) {
      $_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "Docente agregrado";
      header("Location: ../masterPage.php");
      exit();
    } else {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Ocurrio un error al agregar el docente";
      header("Location: ../masterPage.php");
      exit();
    }
  }
}

//////////////////// Llenar modal proyectos //////////////
if (isset($_GET['id'])) {
	$resultado = $db->obtenerDocentes();
  while ($fila = mysqli_fetch_assoc($resultado)) {
  	if ($fila['cedula'] == $_GET['id']) {
      header("Location: ../masterPage.php?modalDocentes=1&cedula=".$fila['cedula']."&nombre=".$fila['nombre']."&apellidos=".$fila['apellidos']."&grado=".$fila['grado_academico']."&contrato=".$fila['tipo_contrato']);
  		exit();
  	}
  }
}

  ?>
