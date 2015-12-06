<?php session_start() ?>
<?php include_once("../include/conversor.php"); ?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>

<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>
<?php $dbDocentesConPermiso = new docentesConPermisoBD(); ?>

<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>
<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>

<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php $db = new presupuestoBD(); ?>

<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php 
$dbRegistroActividad = new registroActividadBD(); 
$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcionRegistroActividad = "";
?>

<?php 
$id_presupuesto = $_POST['cboxIDPresupuesto'];
$nombre_presupuesto = $_POST['txtNombrePresupuesto'];
$codigo = $_POST['txtCodigoPresupuesto'];
$tiempo_presupuesto = fraccionADecimalPresupuesto($_POST['cboTiemposPresupuesto']);
$tiempo_sobrante = $tiempo_presupuesto;

//////////////// AGREGAR /////////////////////////////////////////////////
if (isset($_POST['presupuestoBtnAgregar'])) {
	if(empty($nombre_presupuesto)) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe agregar el nombre del presupuesto.";
		header("Location: ../masterPage.php");
		exit();
	}
	$resultado = $db->agregarPresupuesto($nombre_presupuesto , $codigo , $tiempo_presupuesto , $tiempo_sobrante);
	if ($resultado === FALSE) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al agregar el presupuesto.";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto agregado.";

		///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se agregó el presupuesto: ".$nombre_presupuesto." con ".$_POST['cboTiemposPresupuesto']." tiempos.";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////

		header("Location: ../masterPage.php");
		exit();
	}
}

//////////////// ELIMINAR /////////////////////////////////////////////////
if (isset($_POST['btnEliminarPresupuesto'])) {
if (empty($id_presupuesto)) {
	$_SESSION['alerta'] = 1;
	$_SESSION['alerta-contenido'] = "Se debe seleccionar un presupuesto.";
	header("Location: ../masterPage.php");
	exit();
}
	//////// Verifica que el presupuesto no este siendo usado ///
	/// De proyectos
	$resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
	while ($fila = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_id_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un proyecto.";
			header("Location: ../masterPage.php");
			exit();
		}
	}
	//// De docentes con permisos
	$resultado3 = $dbDocentesConPermiso->obtenerDocentesConPermiso();
	while ($fila2 = mysqli_fetch_assoc($resultado3)) {
		if ($fila2['fk_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un docente con permiso temporal.";
			header("Location: ../masterPage.php");
			exit();
		}
	}
	////// De gruposDocentes 
	$resultado4 = $dbGrupos->obtenerGrupoDocentes();
	while ($fila3 = mysqli_fetch_assoc($resultado4)) {
		if ($fila3['fk_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un grupo.";
			header("Location: ../masterPage.php");
			exit();
		}
	}
	//////////////////////

	///////// Para registro de actividad ///
	$resultado5 = $db->obtenerlistadoDePresupuesto();
		$nombre_presupuesto2 = "";
		while ($fila4 = mysqli_fetch_assoc($resultado5)) {
			if($fila4['id_presupuesto'] == $id_presupuesto) {
				$nombre_presupuesto2 = $fila4['nombre_presupuesto'];
			}
		}
	///////////

	$resultado = $db->borrarPresupuesto($id_presupuesto);

	if ($resultado == false) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al eliminar el presupuesto.";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto eliminado.";

	///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se eliminó el presupuesto ".$nombre_presupuesto2.".";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    /////////////////////////////////////////////

		header("Location: ../masterPage.php");
		exit();
	}
}

//////////////////// MODIFICAR ///////////////////////
if (isset($_POST['btnModificarPresupuesto'])) {
if (empty($id_presupuesto)) {
	$_SESSION['alerta'] = 1;
	$_SESSION['alerta-contenido'] = "Se debe seleccionar un presupuesto.";
	header("Location: ../masterPage.php");
	exit();
}
	$resultado = $db->modificarPresupuesto($id_presupuesto, $nombre_presupuesto , $codigo );
	if ($resultado == false) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al modificar el presupuesto.";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto modificado.";

		///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se modificó el presupuesto: ".$nombre_presupuesto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////

		header("Location: ../masterPage.php");
		exit();
	}
}

//////////////////// Cargar datos modal ////////////
if (isset($_GET['id'])) {
	$resultado = $db->obtenerPresupuesto($_GET['id']);

	while ($fila = mysqli_fetch_assoc($resultado)) {
		if ($fila['id_presupuesto'] == $_GET['id']) {
			header("Location: ../masterPage.php?modalPresupuesto=1&id_presupuesto=".$fila['id_presupuesto']."&nombre_presupuesto=".$fila['nombre_presupuesto']."&codigo=".$fila['codigo']."&tiempo_presupuesto=".$fila['tiempo_presupuesto']."");
			exit();
		}
	}
}
header("Location: ../masterPage.php");
exit();
 ?>
