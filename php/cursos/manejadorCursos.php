<?php session_start(); ?>
<?php include_once("../conexionBD/cursosBD.php"); ?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>

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
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
	$sigla = $_POST['txtSigla'];
	$nombre_curso = $_POST['txtNombreCurso'];
	$creditos = $_POST['cboCreditosCursos'];
	$jornada = $_POST['cboTiempoCursos'];
	$fk_carrera = $_POST['cboxtxtCarrera'];

	if ($sigla != "") {
	if ($nombre_curso != "") {
		$jornada1 = convertirFraccionesDoble($jornada);

		$resultado = $db->agregarCurso($sigla , $nombre_curso , $creditos , $jornada1 , $fk_carrera);
		$resultado2 = $db->agregarCarreraPlanEstudio($fk_carrera , $sigla);

		if ($resultado === FALSE && $resultado2 === FALSE) {
			//// El curso ya existe
			$_SESSION['alerta-contenido'] = "El curso ya existe";
			exit();
		}

		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Curso agregado con éxito";


		$descripcionRegistroActividad="Se agregó el curso: ".$sigla." ".$nombre_curso;
		$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
	} else {
		$_SESSION['alerta-contenido'] = "Debe ingresar el nombre del curso";
	} 
	} else {
		$_SESSION['alerta-contenido'] = "Debe ingresar la sigla del curso";
	}
	exit();
} // fin de registrar

/////////////////////////// ELIMINAR //////////////
if (isset($_POST['btnEliminar'])) {
	$_SESSION['alerta'] = 1;
	header("Location: ../masterPage.php");
	$sigla = $_POST['cboxSigla'];
	if (empty($sigla)) {
		$_SESSION['alerta-contenido'] = "Debe seleccionar un curso";
		exit();
	}

	$resultado3 = $dbGrupos->obtenerGrupoDocentes();
	while ($fila3 = mysqli_fetch_assoc($resultado3)) {
		if ($sigla == $fila3['fk_curso']) {
			$_SESSION['alerta-contenido'] = "No se puede eliminar el curso porque ya esta asignado a un grupo";
			exit();
		}
	}

	$resultado = $db->eliminarCurso($sigla);
	$resultado2 = $db->eliminarCarreraPlanEstudio($sigla);
	
	if ($resultado === FALSE && $resultado2 === FALSE) {
		$_SESSION['alerta-contenido'] = "No se pudo eliminar el curso";
	} else {
		$descripcionRegistroActividad="Se eliminó el curso: ".$sigla;
		$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);

		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Curso eliminado";
	}
	exit();
} // fin de eliminar

//////////////////////////// MODIFICAR /////////////
if (isset($_POST['btnModificar'])) {
	$_SESSION['alerta'] = 1;
	if ($_POST['cboxSigla'] != "") {
	if ($_POST['txtNombreCurso'] != "") {
		$sigla = $_POST['cboxSigla'];
		$nombre_curso = $_POST['txtNombreCurso'];
		$creditos = $_POST['cboCreditosCursos'];
		$jornada = $_POST['cboTiempoCursos'];
		$fk_carrera = $_POST['cboxtxtCarrera'];

		$jornada1 = convertirFraccionesDoble($jornada);

		$db->modificarCurso($sigla , $nombre_curso , $creditos , $jornada1 , $fk_carrera);
		$_SESSION['alerta'] = 2;
		$_SESSION['alerta-contenido'] = "Curso modificado";

		$descripcionRegistroActividad="Se modificó el curso: ".$sigla." ".$nombre_curso;
			$dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
	} else {
		$_SESSION['alerta-contenido'] = "Debe ingresar el nombre del curso";
	}
	}else {
		$_SESSION['alerta-contenido'] = "Debe selecionar un curso";
	}
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
        					if ($fila3['id_carrera'] == $fila2['fk_carrera']) {
        						
        						$nombre_Carrera = $fila3['nombre_carrera'];
        					}
        				}

        			}
        		}

        		$jornada = convertirDobleFraciones($fila['jornada']);
        		header("Location: ../masterPage.php?modalCursos=1&sigla=".$fila['sigla']."&nombre_curso=".$fila['nombre_curso']."&creditos=".$fila['creditos']."&jornada=".$jornada."&id_carrera=".$id_Carrera."&nombre_carrera=".$nombre_Carrera."");
				exit();
        	}
        }
}

header("Location: ../masterPage.php");
exit();
 ?>
