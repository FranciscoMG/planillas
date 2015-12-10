<?php session_start() ?>
<?php include_once("../include/conversor.php"); ?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>

<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>
<?php $dbDocentesConPermiso = new docentesConPermisoBD(); ?>

<?php include_once("../conexionBD/docenteAdministrativoBD.php"); ?>
<?php $dbDocenteAdministrativoBD = new docenteAdministrativoBD(); ?>

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
$presupuestoGrupo= $_POST['cboPresupuestoGrupo'];

//////////////// AGREGAR /////////////////////////////////////////////////
if (isset($_POST['presupuestoBtnAgregar'])) {
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
	if (!empty($_POST['cboTiemposPresupuesto'])) {
	if(empty($nombre_presupuesto)) {
		$_SESSION['alerta-contenido'] = "Debe agregar el nombre del presupuesto";
		exit();
	}
	$resultado = $db->agregarPresupuesto($nombre_presupuesto , $codigo , $tiempo_presupuesto , $tiempo_sobrante);
	if ($resultado === FALSE) {
		$_SESSION['alerta-contenido'] = "Error al agregar el presupuesto";
		exit();
	} else {
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Presupuesto agregado";
		///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se agregó el presupuesto: ".$nombre_presupuesto." con ".$_POST['cboTiemposPresupuesto']." tiempos.";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////
	}
	}
	exit();
}

//////////////// ELIMINAR /////////////////////////////////////////////////
if (isset($_POST['btnEliminarPresupuesto'])) {
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
if (empty($id_presupuesto)) {
	$_SESSION['alerta-contenido'] = "Se debe seleccionar un presupuesto";
	exit();
}
	//////// Verifica que el presupuesto no este siendo usado ///
	/// De proyectos
	$resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
	while ($fila = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_id_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un proyecto";
			exit();
		}
	}
	//// De docentes con permisos
	$resultado3 = $dbDocentesConPermiso->obtenerDocentesConPermiso();
	while ($fila2 = mysqli_fetch_assoc($resultado3)) {
		if ($fila2['fk_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un docente con permiso temporal";
			exit();
		}
	}
	//// De docentes administrativo
	$resultado5 = $dbDocenteAdministrativoBD->obtenerDocenteAdministrativo();
	while ($fila5 = mysqli_fetch_assoc($resultado5)) {
		if ($fila5['fk_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un docente administrativo";
			exit();
		}
	}
	////// De gruposDocentes
	$resultado4 = $dbGrupos->obtenerGrupoDocentes();
	while ($fila3 = mysqli_fetch_assoc($resultado4)) {
		if ($fila3['fk_presupuesto'] == $id_presupuesto) {
			$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya esta asignado a un grupo";
			exit();
		}
	}
	//////////////////////

	///////// Para registro de actividad ///
	$resultado5 = $db->obtenerlistadoDePresupuesto();
		$nombre_presupuesto2 = "";
		while ($fila4 = mysqli_fetch_assoc($resultado5)) {
			if($fila4['id_presupuesto'] == $id_presupuesto) {
				if ($fila4['tiempo_presupuesto'] != $fila4['tiempo_sobrante']) {
					$_SESSION['alerta-contenido'] = "No se puede eliminar el presupuesto porque ya tiene tiempos asignados";
					exit();
				}
				$nombre_presupuesto2 = $fila4['nombre_presupuesto'];
			}
		}
	///////////
	$resultado = $db->borrarPresupuesto($id_presupuesto);
	if ($resultado == false) {
		$_SESSION['alerta'] = 3;
		$_SESSION['alerta-contenido'] = "Error al eliminar el presupuesto";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Presupuesto eliminado.";
	///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se eliminó el presupuesto ".$nombre_presupuesto2.".";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    /////////////////////////////////////////////
	}
	exit();
}

//////////////////// MODIFICAR ///////////////////////
if (isset($_POST['btnModificarPresupuesto'])) {
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
if (empty($id_presupuesto)) {
	$_SESSION['alerta-contenido'] = "Se debe seleccionar un presupuesto";
	exit();
}
	$resultado = $db->modificarPresupuesto($id_presupuesto, $nombre_presupuesto , $codigo );
	if ($resultado == false) {
		$_SESSION['alerta'] = 3;
		$_SESSION['alerta-contenido'] = "Error al modificar el presupuesto";
		exit();
	} else {
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Presupuesto modificado";
		///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se modificó el presupuesto: ".$nombre_presupuesto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////
	}
	exit();
}

if (isset($_POST['btnAsignarGrupoPresup'])) {
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
	if (empty($presupuestoGrupo)) {
		$_SESSION['alerta-contenido'] = "Se debe seleccionar un presupuesto";
		exit();
	}
	if (isset($_GET['total_tiempos'])) {
		$resultado = $db->obtenerlistadoDePresupuesto();
		while ($fila = mysqli_fetch_assoc($resultado)) {
			if ($fila['id_presupuesto'] == $presupuestoGrupo) {
				if ($fila['tiempo_sobrante'] < $_GET['total_tiempos']) {
					$_SESSION['alerta-contenido'] = "Este presupuesto solo tiene ".$fila['tiempo_sobrante']." tiempos, no puede agregar los ".$_GET['total_tiempos']." tiempos del grupo";
					exit();
				} else {
					$tiempo_sobrante = $fila['tiempo_sobrante'];
					$nombre_presupuesto = $fila['nombre_presupuesto'];
				}
			}
		}
	}
	if (isset($_GET['carrera']) && isset($_GET['curso']) && isset($_GET['num_grupo']) && isset($_GET['num_grupo_doble']) && isset($_GET['total_tiempos'])) {
		$resultado = $dbGrupos->agregarPresupGrupo($_GET['carrera'], $_GET['curso'], $_GET['num_grupo'], $presupuestoGrupo);
		if (!$resultado && $_GET['num_grupo_doble'] != "0") {
			$resultado2 = $dbGrupos->agregarPresupGrupo($_GET['carrera'], $_GET['curso'], $_GET['num_grupo_doble'], $presupuestoGrupo);
		}
		if (!($resultado && $resultado2) || !$resultado) {
			$tiempo_sobrante= ($tiempo_sobrante - $_GET['total_tiempos']);
			$resultado3 = $db->restarPresupuesto($presupuestoGrupo, $tiempo_sobrante);
		}
	}

	if (!$resultado3) {
		$_SESSION['alerta'] = 3;
		$_SESSION['alerta-contenido'] = "Error al modificar el presupuesto";
		exit();
	} else {
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Grupo agregado al presupuesto ".$nombre_presupuesto;

		///////////// registro de actividad //////////
	  $descripcionRegistroActividad="Se agrego el presupuesto ".$nombre_presupuesto." al grupo: ".$_GET['curso']." - G".$_GET['num_grupo'];
		if ($_GET['num_grupo_doble'] != "0") {
			$descripcionRegistroActividad.=" y G".$_GET['num_grupo_doble'];
		}
		$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
	  /////////////////////////////////////////////
	}
	exit();
}

if (isset($_POST['btnEliminarGrupoPresup'])) {
	if (isset($_GET['total_tiempos']) && isset($_GET['id_presupuesto'])) {
		$resultado = $db->obtenerlistadoDePresupuesto();
		while ($fila = mysqli_fetch_assoc($resultado)) {
			if ($fila['id_presupuesto'] == $_GET['id_presupuesto']) {
				$tiempo_sobrante = $fila['tiempo_sobrante'];
				$nombre_presupuesto = $fila['nombre_presupuesto'];
			}
		}
	}
	if (isset($_GET['carrera']) && isset($_GET['curso']) && isset($_GET['num_grupo']) && isset($_GET['num_grupo_doble']) && isset($_GET['total_tiempos']) && isset($_GET['id_presupuesto'])) {
		$resultado = $dbGrupos->borrarPresupGrupo($_GET['carrera'], $_GET['curso'], $_GET['num_grupo'], 1);
		if (!$resultado && $_GET['num_grupo_doble'] != "0") {
			$resultado2 = $dbGrupos->borrarPresupGrupo($_GET['carrera'], $_GET['curso'], $_GET['num_grupo_doble'], 1);
		}
		if (!($resultado && $resultado2) || !$resultado) {
			$tiempo_sobrante= ($tiempo_sobrante + $_GET['total_tiempos']);
			$resultado3 = $db->sumarPresupuesto($_GET['id_presupuesto'], $tiempo_sobrante);
		}
	}

	if (!$resultado3) {
		$_SESSION['alerta'] = 3;
		$_SESSION['alerta-contenido'] = "Error al modificar el presupuesto";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Grupo eliminado del presupuesto ".$nombre_presupuesto;

		///////////// registro de actividad //////////
		$descripcionRegistroActividad="Se quitó del presupuesto ".$nombre_presupuesto." el grupo: ".$_GET['curso']." - G".$_GET['num_grupo'];
		if ($_GET['num_grupo_doble'] != "0") {
			$descripcionRegistroActividad.=" y G".$_GET['num_grupo_doble'];
		}
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
