<?php session_start() ?>
<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php $db = new presupuestoBD(); ?>

<?php 
$id_presupuesto = $_POST['cboxIDPresupuesto'];
$nombre_presupuesto = $_POST['txtNombrePresupuesto'];
$codigo = $_POST['txtCodigoPresupuesto'];
$tiempo_presupuesto = $_POST['cboTiemposPresupuesto'];

//////////////// AGREGAR //////////////////////////////
if (isset($_POST['presupuestoBtnAgregar'])) {
	$resultado = $db->agregarPresupuesto($nombre_presupuesto , $codigo , 0.9);
	if ($resultado === FALSE) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al agregar el presupuesto";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto agregado";
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
