<?php session_start(); ?>
<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>
<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>

<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>

<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php 
$dbRegistroActividad = new registroActividadBD(); 
$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcionRegistroActividad = "";
?>

<?php $db= new proyectosBD(); ?>
<?php 
$_SESSION['alerta'] = 0;
$_SESSION['alerta-contenido'] = 0;

$idProyecto = $_POST['cboxIDProyecto'];
$nombre_proyecto = $_POST['txtNombre_proyecto'];
$tipo_proyecto = $_POST['cboTipo_proyecto'];
$jornada_proyecto = $_POST['cboTiemposProyecto'];
$fk_encargado = $_POST['cboPrimario'];
$fk_ayudante = $_POST['cboSecundario'];

/////////////////////// Agregar /////////////////////
if (isset($_POST['proyectosBtnAgregar'])) {
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
	if ($nombre_proyecto != "") {
		$valorDouble = convertirFraccionesDoble($jornada_proyecto);
		$resultado = $db->agregarProyecto( $nombre_proyecto , $tipo_proyecto , $valorDouble , $fk_encargado , $fk_ayudante);
	if ($resultado != false) {
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Proyecto agregado";
		///////////// registro de actividad //////////
		$descripcionRegistroActividad="Se agregó el proyecto: ".$nombre_proyecto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        ////////////////////////////////////////////
		exit();
	} else {
		$_SESSION['alerta-contenido'] = "Error al agregar el proyecto";
		exit();
	}
	} else {
		$_SESSION['alerta-contenido'] = "Debe ingresar el nombre del proyecto";
	}
	exit();
}

/////////////////////////// Eliminar ///////////////////////
if (isset($_POST['btnEliminarProyecto'])) {
	header("Location: ../masterPage.php");
	if ($idProyecto != "") {
		/// Verificar si existe //////
	$resultado3 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
	while ($fila2 = mysqli_fetch_assoc($resultado3)) {
		if ($fila2['fk_proyecto'] == $idProyecto) {
			$_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "No se puede eliminarl el proyecto porque tiene un presupuesto asignado.";
			exit();
		}
	}
	////////////////
		$db->eliminarProyecto($idProyecto);
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Proyecto eliminado";

		///////////// registro de actividad //////////
		$descripcionRegistroActividad="Se eliminó el proyecto id: ".$idProyecto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        ///////////////////////////////////////////
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe seleccionar un proyecto";
	}
	exit();
}

////////////////////////// Modificar ///////////////////
if (isset($_POST['btnModificarProyectos'])) {
	header("Location: ../masterPage.php");
	if ($idProyecto != "") {
		$valorDouble = convertirFraccionesDoble($jornada_proyecto);
		$resultado = $db->modificarProyecto($idProyecto, $nombre_proyecto , $tipo_proyecto , $fk_ayudante);
		if ($resultado != false) {
			$_SESSION['alerta'] = 2;
			$_SESSION['alerta-contenido'] = "Proyecto modificado";
		///////////// registro de actividad //////////
		$descripcionRegistroActividad="Se modificó el proyecto: ".$nombre_proyecto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////
        exit();
		}
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe seleccionar un proyecto";
		header("Location: ../masterPage.php");
	}
	exit();
}

//////////////////// Llenar modal proyectos //////////////
if (isset($_GET['id'])) {
	$resultado = $db->obtenerProyecto();
        while ($fila = mysqli_fetch_assoc($resultado)) {
        	if ($fila['id_proyecto'] == $_GET['id']) {
        		
        		$fraccion = convertirDobleFraciones($fila['jornada_proyecto']);
        		header("Location: ../masterPage.php?modalProyectos=1&id_proyecto=".$fila['id_proyecto']."&nombre_proyecto=".$fila['nombre_proyecto']."&tipo_proyecto=".$fila['tipo_proyecto']."&jornada_proyecto=".$fraccion."&fk_encargado=".$fila['fk_encargado']."&fk_ayudante=".$fila['fk_ayudante']);
				exit();
        	}
        }
}
 ?>

<?php header("Location: ../masterPage.php");
		exit(); ?>