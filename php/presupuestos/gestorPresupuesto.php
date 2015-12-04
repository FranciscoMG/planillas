<?php session_start() ?>
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
$tiempo_presupuesto = (double)$_POST['cboTiemposPresupuesto'];

//////////////// AGREGAR //////////////////////////////
if (isset($_POST['presupuestoBtnAgregar'])) {
	$resultado = $db->agregarPresupuesto($nombre_presupuesto , $codigo , $tiempo_presupuesto);
	if ($resultado === FALSE) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al agregar el presupuesto";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto agregado";

		///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se agregó el presupuesto: ".$nombre_presupuesto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////

		header("Location: ../masterPage.php");
		exit();
	}
}

//////////////// ELIMINAR ///////////////////////////
if (isset($_POST['btnEliminarPresupuesto'])) {
	$resultado = $db->borrarPresupuesto($id_presupuesto);
	if ($resultado == false) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al eliminar el presupuesto";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto eliminado";

		///////////// registro de actividad //////////
        $descripcionRegistroActividad="Se eliminó el presupuesto id: ".$id_presupuesto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        /////////////////////////////////////////////

		header("Location: ../masterPage.php");
		exit();
	}
}

//////////////////// MODIFICAR ///////////////////////
if (isset($_POST['btnModificarPresupuesto'])) {
	$resultado = $db->modificarPresupuesto($id_presupuesto, $nombre_presupuesto , $codigo , $tiempo_presupuesto);
	if ($resultado == false) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al modificar el presupuesto";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto modificado";

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
