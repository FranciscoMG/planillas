<?php session_start(); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>

<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php 
$dbRegistroActividad = new registroActividadBD(); 
$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcionRegistroActividad = "";
?>

<?php $dbDocentesConPermisos = new docentesConPermisoBD(); ?>
<?php $db= new docentesBD(); ?>
<?php

if (isset($_POST['txtCedula']) && !empty($_POST['txtCedula'])) {
  $cedula= trim($_POST['txtCedula']);
} else {
  if (isset($_POST['cboxIDDocente']) && $_POST['cboxIDDocente'] != "0") {
    $cedula= $_POST['cboxIDDocente'];
  } else {
    $cedula= "";
  }
}

$nombre= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
$apellidos= isset($_POST['txtApellidos'])?$_POST['txtApellidos']:"";
$grado_academico= isset($_POST['cboGrado'])?$_POST['cboGrado']:"";
$tipo_contrato= isset($_POST['cboContrato'])?$_POST['cboContrato']:"";

//////////////////////// MODIFICAR //////////////////////////////
if (isset($_POST['btnModificar'])) {
  if ($cedula != "") {
    $seRealizo= $db->modificarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "No se ha seleccionado ningún docente";
    header('Location: ../masterPage.php');
    exit();
  }
  if ($seRealizo) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Docente modificado con éxito";

    ////////////////// Registro de actividad /////////////
    $descripcionRegistroActividad="Se modificó el docente: ".$cedula." ".$nombre." ".$apellidos;
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    ////////////////////////////////////////
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al modificar el docente";
  }
  header('Location: ../masterPage.php');
  exit();
}

////////////////////// ELIMINAR //////////////////////////////////
if (isset($_POST['btnEliminar'])) {
  if ($cedula != "") {
    $seRealizo= $db->borrarDocente($cedula);
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "No se ha seleccionado ningún docente";
    header('Location: ../masterPage.php');
    exit();
  }
  if ($seRealizo) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Docente borrado con éxito";

    ////////////////// Registro de actividad /////////////
    $descripcionRegistroActividad="Se eliminó el docente con la cédula: ".$cedula;
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    /////////////////////////////////////////////////////
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al eliminar el docente";
  }
  header('Location: ../masterPage.php');
  exit();
}

//////////////////// AGREGAR ////////////////////////////////
if (isset($_POST['btnRegistrar'])) {
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
        header("Location: ../masterPage.php");
        exit();
      }
    }

    $resultado2 = $dbDocentesConPermisos->obtenerDocentesConPermiso();

    while ($fila= mysqli_fetch_assoc($resultado2)) {
      if ($fila['cedula']==$cedula) {
        $_SESSION['alerta'] = 1;
        $_SESSION['alerta-contenido'] = "El docente ya existe";
        header("Location: ../masterPage.php");
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
			$_SESSION['alerta-contenido'] = "Docente agregrado con éxito";

      ////////////////// Registro de actividad /////////////
      $descripcionRegistroActividad="Se agregó el docente ".$cedula." ".$nombre." ".$apellidos;
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
      //////////////////////////////////////////////////

      header("Location: ../masterPage.php");
      exit();
    } else {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Ocurrió un error al agregar el docente";
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
