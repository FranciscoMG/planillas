<?php session_start(); ?>
<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php $db= new proyectosBD(); ?>
<?php 
$_SESSION['alerta'] = 0;
$_SESSION['alerta-contenido'] = 0;

$idProyecto = $_POST['cboxIDProyecto'];
$nombre_proyecto = $_POST['txtNombre_proyecto'];
$tipo_proyecto = $_POST['cboTipo_proyecto'];
$jornada_proyecto = $_POST['cboTiempo_proyecto'];
$fk_encargado = $_POST['cboPrimario'];
$fk_ayudante = $_POST['cboSecundario'];

/////////////////////// Agregar /////////////////////
if (isset($_POST['proyectosBtnAgregar'])) {
	if ($nombre_proyecto != "") {
	
	$valorDouble = convertirFraccionesDoble($jornada_proyecto);

	$resultado = $db->agregarProyecto( $nombre_proyecto , $tipo_proyecto , $valorDouble , $fk_encargado , $fk_ayudante);

	if ($resultado != false) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Proyecto agregado";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error al agregar el proyecto";
		header("Location: ../masterPage.php");
		exit();
	}
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe ingresar el nombre del proyecto";
		header("Location: ../masterPage.php");
		exit();
	}
}
/////////////////////////////////////////////////////
function convertirFraccionesDoble ($fraccion) {
	$valor = 0.0;
	switch ($fraccion) {
		case '1':
			$valor = 1;
			break;
		case '1/2':
			$valor = 0.5;
			break;
		case '1/4':
			$valor = 0.25;
			break;
		case '2/4':
			$valor = 0.5;
			break;
		case '3/4':
			$valor = 0.75;
			break;		
	}
	return $valor;
} // fin de funcion

/////////////////////////// Eliminar ///////////////////////
if (isset($_POST['btnEliminarProyecto'])) {
	if ($idProyecto != "") {
		$db->eliminarProyecto($idProyecto);
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Proyecto eliminado";
		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe seleccionar un proyecto";
		header("Location: ../masterPage.php");
		exit();
	}
}

////////////////////////// Modificar ///////////////////
if (isset($_POST['btnModificarProyectos'])) {
	if ($idProyecto != "") {

		$valorDouble = convertirFraccionesDoble($jornada_proyecto);
		$resultado = $db->modificarProyecto($idProyecto, $nombre_proyecto , $tipo_proyecto , $valorDouble , $fk_encargado , $fk_ayudante);
		if ($resultado != false) {
			$_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "Proyecto modificado";
			header("Location: ../masterPage.php");
		}
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe seleccionar un proyecto";
		header("Location: ../masterPage.php");
		exit();
	}
}

//////////////////// Llenar modal proyectos //////////////
if (isset($_GET['id'])) {
	$resultado = $db->obtenerProyecto();
        while ($fila = mysqli_fetch_assoc($resultado)) {
        	if ($fila['id_proyecto'] == $_GET['id']) {
        		
        		header("Location: ../masterPage.php?modalProyectos=1&id_proyecto=".$fila['id_proyecto']."&nombre_proyecto=".$fila['nombre_proyecto']."&tipo_proyecto=".$fila['tipo_proyecto']."&jornada_proyecto=".$fila['jornada_proyecto']."&fk_encargado=".$fila['fk_encargado']."&fk_ayudante=".$fila['fk_ayudante']);
				exit();
        	}
        }
}
 ?>

<?php header("Location: ../masterPage.php");
		exit(); ?>