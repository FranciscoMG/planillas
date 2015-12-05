<?php session_start(); ?>
<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>

<?php $dbDocentes = new docentesBD();  ?>
<?php $db= new docentesConPermisoBD(); ?>

<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php 
$dbRegistroActividad = new registroActividadBD(); 
$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcionRegistroActividad = "";
?>

<?php

if (isset($_POST['txtCedula2']) && !empty($_POST['txtCedula2'])) {
  $cedula= $_POST['txtCedula2'];
} else {
  if (isset($_POST['cboxIDDocente2']) && $_POST['cboxIDDocente2'] != "0") {
    $cedula= $_POST['cboxIDDocente2'];
  } else {
    $cedula= "";
  }
}

$nombre= isset($_POST['txtNombre2'])?$_POST['txtNombre2']:"";
$apellidos= isset($_POST['txtApellidos2'])?$_POST['txtApellidos2']:"";
$grado_academico= isset($_POST['cboGrado2'])?$_POST['cboGrado2']:"";
$tipo_contrato= isset($_POST['cboContrato2'])?$_POST['cboContrato2']:"";
$fk_presupuesto= isset($_POST['cboPresupuesto2'])?$_POST['cboPresupuesto2']:"";
$jornada_docenteConPermiso= isset($_POST['cboJornadaDocenteConPermiso2'])?$_POST['cboJornadaDocenteConPermiso2']:"";
$jornada_docenteConPermiso = convertirFraccionesDoble($jornada_docenteConPermiso);

//////////////////////// MODIFICAR //////////////////////////////
if (isset($_POST['btnModificar2'])) {
  if ($cedula != "") {
    $seRealizo= $db->modificarDocenteConPermiso($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso);
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
    //////////////////////////////////////////
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al modificar el docente";
  }
  header('Location: ../masterPage.php');
  exit();
}

////////////////////// ELIMINAR //////////////////////////////////
if (isset($_POST['btnEliminar2'])) {
  if ($cedula != "") {
    $seRealizo= $db->borrarDocenteConPermiso($cedula);
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
    //////////////////////////////////////////////
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al eliminar el docente";
  }
  header('Location: ../masterPage.php');
  exit();
}

//////////////////// AGREGAR ////////////////////////////////
if (isset($_POST['btnRegistrar2'])) {

    $resultado = $db->obtenerDocentesConPermiso();
    while ($fila= mysqli_fetch_assoc($resultado)) {
      if ($fila['cedula']==$cedula) {
        $_SESSION['alerta'] = 1;
  			$_SESSION['alerta-contenido'] = "El docente ya existe";
        header("Location: ../masterPage.php");
        exit();
      }
   

    if (empty($nombre)) {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Debe ingresar el nombre";
      header("Location: ../masterPage.php");
      exit();
    }

    $resultado2 = $dbDocentes->obtenerDocentes();

    while ($fila= mysqli_fetch_assoc($resultado2)) {
      if ($fila['cedula']==$cedula) {
        $_SESSION['alerta'] = 1;
        $_SESSION['alerta-contenido'] = "El docente ya existe";
        header("Location: ../masterPage.php");
        exit();
      }
    }

    if (empty($apellidos)) {
      $_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "Debe ingresar los apellidos";
      header("Location: ../masterPage.php");
      exit();
    }

    if (empty($fk_presupuesto) || $fk_presupuesto == "") {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Debe agregar un presupuesto";
      header("Location: ../masterPage.php");
      exit();
    }

    $seRealizo = $db->agregarDocenteConPermiso($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso);

    if (!$seRealizo) {
      $_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "Docente agregrado con éxito";

      ////////////////// Registro de actividad /////////////
      $descripcionRegistroActividad="Se agregó el docente ".$cedula." ".$nombre." ".$apellidos;
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
      /////////////////////////////////////////////

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
	$resultado = $db->obtenerDocentesConPermiso();
  while ($fila = mysqli_fetch_assoc($resultado)) {
  	if ($fila['cedula'] == $_GET['id']) {
      header("Location: ../masterPage.php?modalDocentesConPermisos=1&cedula=".$fila['cedula']."&nombre=".$fila['nombre']."&apellidos=".$fila['apellidos']."&grado=".$fila['grado_academico']."&contrato=".$fila['tipo_contrato']);
  		exit();
  	}
  }
}

?>
