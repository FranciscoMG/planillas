<?php session_start(); ?>
<?php include_once("../conexionBD/cursosBD.php"); ?>
<?php 

	$db = new cursosBD();
////////////////////////////// AGREGAR /////////////
if (isset($_POST['btnRegistrar'])) {
	$sigla = $_POST['txtSigla'];
	$nombre_curso = $_POST['txtNombreCurso'];
	$creditos = $_POST['cboCreditosCursos'];
	$jornada = $_POST['cboTiempoCursos'];

	$jornada1 = convertirFraccionesDoble($jornada);

	$resultado = $db->agregarCurso($sigla , $nombre_curso , $creditos , $jornada1);

	if ($resultado == FALSE) {
		//// El curso ya existe
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "El curso ya existe";
		header("Location: ../masterPage.php");
		exit();
	}

	header("Location: ../masterPage.php");
	exit();
} // fin de registrar

/////////////////////////// ELIMINAR //////////////
if (isset($_POST['btnEliminar'])) {
	$sigla = $_POST['txtSigla'];

	$db->eliminarCurso($sigla);
	
	header("Location: ../masterPage.php");
	exit();
} // fin de eliminar

//////////////////////////// MODIFICAR /////////////
if (isset($_POST['btnModificar'])) {
	$sigla = $_POST['txtSigla'];
	$nombre_curso = $_POST['txtNombreCurso'];
	$creditos = $_POST['cboCreditosCursos'];
	$jornada = $_POST['cboTiempoCursos'];

	$jornada1 = convertirFraccionesDoble($jornada);

	if ($db->existeCurso($sigla) != false) {
		$db->modificarCurso($sigla , $nombre_curso , $creditos , $jornada1);
	}
	header("Location: ../masterPage.php");
	exit();
} // fin de modificar

/////////////////////////////////////////////////////////
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
			$valor = 0.24;
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

header("Location: ../masterPage.php");
exit();
 ?>
