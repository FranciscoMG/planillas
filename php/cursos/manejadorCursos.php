<?php session_start(); ?>
<?php include_once("../conexionBD/cursosBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>

<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php 
$dbRegistroActividad = new registroActividadBD(); 
$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcionRegistroActividad = "";
?>
<?php 
	$db = new cursosBD();
////////////////////////////// AGREGAR /////////////
if (isset($_POST['btnRegistrar'])) {
	$sigla = $_POST['txtSigla'];
	$nombre_curso = $_POST['txtNombreCurso'];
	$creditos = $_POST['cboCreditosCursos'];
	$jornada = $_POST['cboTiempoCursos'];
	$fk_carrera = $_POST['cboxtxtCarrera'];

	if ($sigla != "" && $nombre_curso != "") {
		$jornada1 = convertirFraccionesDoble($jornada);

		$resultado = $db->agregarCurso($sigla , $nombre_curso , $creditos , $jornada1 , $fk_carrera);

		if ($resultado === FALSE) {
			//// El curso ya existe
			$_SESSION['alerta'] = 1;
			$_SESSION['alerta-contenido'] = "El curso ya existe";
			header("Location: ../masterPage.php");
			exit();
		}

		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Curso agregado";

		$descripcionRegistroActividad="Se agregó el curso ".$sigla." ".$nombre_curso;
		$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe ingresar la sigla y el nombre del curso";
	}
	header("Location: ../masterPage.php");
	exit();
} // fin de registrar

/////////////////////////// ELIMINAR //////////////
if (isset($_POST['btnEliminar'])) {
	$sigla = $_POST['cboxSigla'];

	$db->eliminarCurso($sigla);
	
	$descripcionRegistroActividad="Se eliminó el curso ".$sigla;
		$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);

	$_SESSION['alerta'] = 1;
	$_SESSION['alerta-contenido'] = "Curso eliminado";
	header("Location: ../masterPage.php");
	exit();
} // fin de eliminar

//////////////////////////// MODIFICAR /////////////
if (isset($_POST['btnModificar'])) {
	$sigla = $_POST['cboxSigla'];
	$nombre_curso = $_POST['txtNombreCurso'];
	$creditos = $_POST['cboCreditosCursos'];
	$jornada = $_POST['cboTiempoCursos'];
	$fk_carrera = $_POST['cboxtxtCarrera'];

	$jornada1 = convertirFraccionesDoble($jornada);

	$db->modificarCurso($sigla , $nombre_curso , $creditos , $jornada1 , $fk_carrera);
	$_SESSION['alerta'] = 1;
	$_SESSION['alerta-contenido'] = "Curso modificado";

	$descripcionRegistroActividad="Se modificó el curso ".$sigla." ".$nombre_curso;
		$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);

	header("Location: ../masterPage.php");
	exit();
} // fin de modificar

//////////////////// Llenar modal cursos //////////////
if (isset($_GET['id'])) {
	$resultado = $db->obtenerCursos();
        while ($fila = mysqli_fetch_assoc($resultado)) {
        	if ($fila['sigla'] == $_GET['id']) {
        		
        		$resultado2 = $db->obtenerCarrerasPlanEstudio();
        		while ($fila2 = mysqli_fetch_assoc($resultado2)) {
        			if ($fila2['fk_curso'] == $_GET['id']) {
        				$id_Carrera = $fila2['fk_carrera'];

        				$resultado3 = $db->obtenerCarreras();
        				while ($fila3 = mysqli_fetch_assoc($resultado3)) {
        					if ($fila3['id_Carrera'] == $fila2['fk_carrera']) {
        						
        						$nombre_Carrera = $fila3['nombre_Carrera'];
        					}
        				}

        			}
        		}

        		$jornada = convertirDobleFraciones($fila['jornada']);
        		header("Location: ../masterPage.php?modalCursos=1&sigla=".$fila['sigla']."&nombre_curso=".$fila['nombre_curso']."&creditos=".$fila['creditos']."&jornada=".$jornada."&id_Carrera=".$id_Carrera."&nombre_Carrera=".$nombre_Carrera."");
				exit();
        	}
        }
}

header("Location: ../masterPage.php");
exit();
 ?>
