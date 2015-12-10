<?php session_start(); ?>
<?php include_once("../include/funciones.php"); ?>

<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php $dbPresupuesto = new presupuestoBD(); ?>

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
  $cedula= trim($_POST['txtCedula2']);
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
  $_SESSION['alerta'] = 1;
  header('Location: ../masterPage.php');
  if ($cedula != "") {
    //////////// Verificar tiempos del presupuesto /////
    $resultado = $dbPresupuesto->obtenerlistadoDePresupuesto();
    while ($fila = mysqli_fetch_assoc($resultado)) {
      if ($fila['id_presupuesto'] == $fk_presupuesto) {
        if ($fila['tiempo_sobrante'] < $jornada_docenteConPermiso) {
          $_SESSION['alerta-contenido'] = "Este presupuesto solo tiene ".$fila['tiempo_sobrante']." tiempos, no puede agregar los ".$jornada_docenteConPermiso." tiempos del docente";
    
          exit();
        }
      }
    }
    /////////////////////////
    //// Obtener jornada del docente //// 
    $resultado4 = $db->obtenerDocentesConPermiso();
    while ($fila4 = mysqli_fetch_assoc($resultado4)) {
      if ($fila4['cedula'] == $cedula) {
          $jornada_docenteConPermiso2 = $fila4['jornada_docenteConPermiso'];
          $fk_presupuesto2 = $fila4['fk_presupuesto'];
      }
    }
    ////////////////////

    $seRealizo= $db->modificarDocenteConPermiso($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso);

  } else {
    $_SESSION['alerta-contenido'] = "No se ha seleccionado ningún docente";
    exit();
  }
  if ($seRealizo) {
   

    /////////// Sumar al presupuesto //++++++++++++
    $resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
      while ($fila3 = mysqli_fetch_assoc($resultado3)) {
        if ($fila3['id_presupuesto'] == $fk_presupuesto2) {
          $tiempo_sobrante2 = $fila3['tiempo_sobrante'];
          $nombre_presupuesto1 = $fila3['nombre_presupuesto'];
        }
      }
    $tiempo_sobrante2 = ($tiempo_sobrante2 + $jornada_docenteConPermiso2);
    $dbPresupuesto->sumarPresupuesto($fk_presupuesto2 , $tiempo_sobrante2);
    /////////////////////////

    //////// Restar al presupuesto //------------
      $resultado2 = $dbPresupuesto->obtenerlistadoDePresupuesto();
      while ($fila2 = mysqli_fetch_assoc($resultado2)) {
        if ($fila2['id_presupuesto'] == $fk_presupuesto) {
          $tiempo_sobrante = $fila2['tiempo_sobrante'];
          $nombre_presupuesto2 = $fila2['nombre_presupuesto'];
        }
      }
      $tiempo_sobrante = ($tiempo_sobrante - $jornada_docenteConPermiso);
      $resultado3 = $dbPresupuesto->restarPresupuesto($fk_presupuesto , $tiempo_sobrante);
      /////////////////////////////////-----------------

      $_SESSION['alerta'] = 2;
      $_SESSION['alerta-contenido'] = "Docente modificado con éxito. <br/> Se agregó ".$jornada_docenteConPermiso2." tiempos al presupuesto ".$nombre_presupuesto1.".<br/>Se restó ".$jornada_docenteConPermiso." tiempos del presupuesto ".$nombre_presupuesto2.".";

    ////////////////// Registro de actividad /////////////
    $descripcionRegistroActividad="Se modificó el docente cédula ".$cedula.", ".$nombre." ".$apellidos.". <br/>Se agregó ".$jornada_docenteConPermiso2." tiempos al presupuesto ".$nombre_presupuesto1.".<br/>Se restó ".$jornada_docenteConPermiso." tiempos del presupuesto ".$nombre_presupuesto2.".";
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    //////////////////////////////////////////
  } else {
    $_SESSION['alerta'] = 3;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al modificar el docente";
  }
  exit();
}

////////////////////// ELIMINAR //////////////////////////////////
if (isset($_POST['btnEliminar2'])) {
  $_SESSION['alerta'] = 1;
  header('Location: ../masterPage.php');
  if ($cedula != "") {
    //// Obtener jornada del docente //// 
    $resultado4 = $db->obtenerDocentesConPermiso();
    while ($fila4 = mysqli_fetch_assoc($resultado4)) {
      if ($fila4['cedula'] == $cedula) {
          $jornada_docenteConPermiso = $fila4['jornada_docenteConPermiso'];
          $fk_presupuesto = $fila4['fk_presupuesto'];
          $nombre2 = $fila4['nombre'];
          $apellidos2 = $fila4['apellidos'];
      }
    }
    ////////////////////

    $seRealizo= $db->borrarDocenteConPermiso($cedula);
  } else {
    $_SESSION['alerta-contenido'] = "No se ha seleccionado ningún docente";
    exit();
  }
  if ($seRealizo) {

    /////////// Sumar al presupuesto //++++++++++++
    $resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
      while ($fila3 = mysqli_fetch_assoc($resultado3)) {
        if ($fila3['id_presupuesto'] == $fk_presupuesto) {
          $tiempo_sobrante2 = $fila3['tiempo_sobrante'];
          $nombre_presupuesto2 = $fila3['nombre_presupuesto'];
        }
      }
    $tiempo_sobrante2 = ($tiempo_sobrante2 + $jornada_docenteConPermiso);
    $dbPresupuesto->sumarPresupuesto($fk_presupuesto , $tiempo_sobrante2);
    /////////////////////////

    $_SESSION['alerta'] = 2;
    $_SESSION['alerta-contenido'] = "Docente borrado con éxito. <br/>Se agregó ".$jornada_docenteConPermiso." tiempos al presupuesto ".$nombre_presupuesto2.".";

    ////////////////// Registro de actividad /////////////
    $descripcionRegistroActividad="Se eliminó el docente con la cédula ".$cedula.", nombre ".$nombre2." ".$apellidos2.", y se eliminó ".$jornada_docenteConPermiso." tiempos del presupuesto ".$nombre_presupuesto2.".";
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    //////////////////////////////////////////////
  } else {
    $_SESSION['alerta'] = 3;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al eliminar el docente.";
  }
  exit();
}

//////////////////// AGREGAR ////////////////////////////////
if (isset($_POST['btnRegistrar2'])) {
  $_SESSION['alerta'] = 1;
  header("Location: ../masterPage.php");
  $tiemposDocente = verificarTiemposDocente($cedula);
  if ( ($tiemposDocente + $jornada_docenteConPermiso) > 1 ) {
      $_SESSION['alerta-contenido'] = "No puede agregar mas tiempos al docente encargado <br>porque pasa el límite de un tiempo";
      exit();
  }

    if ($cedula == "") {
      $_SESSION['alerta-contenido'] = "Debe ingresar la cedula";
      exit();
    }
    if (empty($nombre)) {
      $_SESSION['alerta-contenido'] = "Debe ingresar el nombre";
      exit();
    }

    ///// Verifica que la cedula del docente no exista
    $resultado = $db->obtenerDocentesConPermiso();
    while ($fila= mysqli_fetch_assoc($resultado)) {
      if ($fila['cedula']==$cedula) {
        $_SESSION['alerta-contenido'] = "El docente ya existe";
        header("Location: ../masterPage.php");
        exit();
      }
    $resultado2 = $dbDocentes->obtenerDocentes();
    while ($fila= mysqli_fetch_assoc($resultado2)) {
      if ($fila['cedula']==$cedula) {
        $_SESSION['alerta-contenido'] = "El docente ya existe";
        exit();
      }
    }
    ////////////////////////

    //// Contorles ////////////
    if (empty($apellidos)) {
			$_SESSION['alerta-contenido'] = "Debe ingresar los apellidos";
      exit();
    }
    if (empty($fk_presupuesto) || $fk_presupuesto == "") {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Debe agregar un presupuesto";
      exit();
    }
    /////////////////////////////

    //////////// Verificar tiempos del presupuesto /////
    $resultado = $dbPresupuesto->obtenerlistadoDePresupuesto();
    while ($fila = mysqli_fetch_assoc($resultado)) {
      if ($fila['id_presupuesto'] == $fk_presupuesto) {
        if ($fila['tiempo_sobrante'] < $jornada_docenteConPermiso) {
          $_SESSION['alerta'] = 1;
          $_SESSION['alerta-contenido'] = "Este presupuesto solo tiene ".$fila['tiempo_sobrante']." tiempos, no puede agregar los ".$jornada_docenteConPermiso." tiempos del docente";
          exit();
        }
      }
    }
    /////////////////////////

    $seRealizo = $db->agregarDocenteConPermiso($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso);

    if (!$seRealizo) {

      //////// Restar al presupuesto //------------
      $resultado2 = $dbPresupuesto->obtenerlistadoDePresupuesto();
      while ($fila2 = mysqli_fetch_assoc($resultado2)) {
        if ($fila2['id_presupuesto'] == $fk_presupuesto) {
          $tiempo_sobrante = $fila2['tiempo_sobrante'];
          $nombre_presupuesto = $fila2['nombre_presupuesto'];
        }
      }
      $tiempo_sobrante = ($tiempo_sobrante - $jornada_docenteConPermiso);
      $resultado3 = $dbPresupuesto->restarPresupuesto($fk_presupuesto , $tiempo_sobrante);
      /////////////////////////////////-----------------

      $_SESSION['alerta'] = 2;
			$_SESSION['alerta-contenido'] = "Docente agregrado con éxito <br/>y asignado al presupuesto ".$nombre_presupuesto." con ".$jornada_docenteConPermiso." tiempos.";

      ////////////////// Registro de actividad /////////////
      $descripcionRegistroActividad="Se agregó el docente cédula ".$cedula.", nombre ".$nombre." ".$apellidos.", asignado al presupuesto ".$nombre_presupuesto." con ".$jornada_docenteConPermiso." tiempos.";
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
      /////////////////////////////////////////////

      exit();
    } else {
      $_SESSION['alerta'] = 3;
      $_SESSION['alerta-contenido'] = "Ocurrió un error al agregar el docente";
      exit();
    }
  }
}

//////////////////// Llenar modal proyectos //////////////
if (isset($_GET['id'])) {
	$resultado = $db->obtenerDocentesConPermiso();
  while ($fila = mysqli_fetch_assoc($resultado)) {
  	if ($fila['cedula'] == $_GET['id']) {
      header("Location: ../masterPage.php?modalDocentesConPermisos=1&cedula=".$fila['cedula']."&nombre=".$fila['nombre']."&apellidos=".$fila['apellidos']."&grado=".$fila['grado_academico']."&contrato=".$fila['tipo_contrato']."&jornada=".$fila['jornada_docenteConPermiso']."&jornada_fraccion=".convertirDobleFraciones($fila['jornada_docenteConPermiso'])."&fk_presupuesto=".$fila['fk_presupuesto']);
  		exit();
  	}
  }
}

?>
