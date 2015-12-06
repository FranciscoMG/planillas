<?php session_start(); ?>
<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>
<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>

<?php $dbDocentes = new docentesBD(); ?>

<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>


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

$idProyecto = $_POST['cboxIDProyecto2'];
$tipo_proyecto = $_POST['cboTipo_proyecto2'];
$jornada_proyecto = $_POST['cboTiemposProyecto2'];
$fk_encargado = $_POST['cboxPrimario2'];
$fk_ayudante = $_POST['cboSecundario2'];
$fk_presupuesto = $_POST['cboxPresupuesto2'];

/////////////////////////// Eliminar ///////////////////////
if (isset($_POST['btnEliminarProyectoPresupuesto'])) {
	if ($idProyecto != "") {

	$valorDouble = convertirFraccionesDoble($jornada_proyecto);

	$existe = 0;

	$resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();

	if ($resultado2 != false) {

		while ($fila = mysqli_fetch_assoc($resultado2)) {
			if($fila['fk_proyecto'] == $idProyecto && $fila['jornada'] < 99) {
				$valorDouble = ($fila['jornada'] - $valorDouble);

				$existe = 1;
/*
				if ($valorDouble < 0) {
					$_SESSION['alerta'] = 1;
					$_SESSION['alerta-contenido'] = "No puede eliminar esa cantidad de tiempos del docente devido a que el docente solo posee: ".$fila['jornada']." esta cantidad esta asignada en un grupo o otro proyecto".$valorDouble;
					header("Location: ../masterPage.php");
					exit();
				}
				if ($valorDouble > 01) {
					$_SESSION['alerta'] = 1;
					$_SESSION['alerta-contenido'] = "No puede agregar más de un tiempo al docente";
					header("Location: ../masterPage.php");
					exit();
				}
				*/
			}
		}
	}

	if($existe == 1){
		$resultado = $dbPresupuestoDocente->borrarPresupuestoDocente($idProyecto);


		if ($resultado === FALSE) {

		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "No se ha asignado un presupuesto a este proyecto";	

		} else {
		
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto eliminado del proyecto";
			
		///////////// registro de actividad //////////
		$descripcionRegistroActividad="Se eliminó el proyecto id: ";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        ///////////////////////////////////////////
		}


		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "No se ha asignado un presupuesto a este proyecto";
		header("Location: ../masterPage.php");
		exit();
	}
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Debe seleccionar un proyecto";
		header("Location: ../masterPage.php");
		exit();
	}
}


/////////////////////// Agregar /////////////////////
if (isset($_POST['proyectosBtnAgregarPresupuesto'])) {
	if ($idProyecto != "") {
	
	$valorDouble = convertirFraccionesDoble($jornada_proyecto);


	$resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();

	$existe = 0;

	if ($resultado2 != false) {
		while ($fila = mysqli_fetch_assoc($resultado2)) {
			if($fila['idProyecto'] == $idProyecto && $fila['jornada'] < 99) {
				$valorDouble = ($valorDouble + $fila['jornada']);

				$existe = 1;
				if ($valorDouble > 1) {
					$_SESSION['alerta'] = 1;
					$_SESSION['alerta-contenido'] = "No puede agregar más de un tiempo al docente";
					header("Location: ../masterPage.php");
					exit();
				}
			}
		}
	}	
	echo "string".$fk_presupuesto.' - '.$fk_encargado.' - '.$valorDouble;

		$resultado = $dbPresupuestoDocente->agregarPresupuestoDocente($fk_presupuesto, $fk_encargado , $valorDouble , $idProyecto);
	

	if ($resultado == 1) {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Presupuesto asignado al proyecto";

		///////////// registro de actividad //////////
		$descripcionRegistroActividad="Se ha asignado un presupuesto a un proyecto: ".$nombre_proyecto;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
        ////////////////////////////////////////////

		header("Location: ../masterPage.php");
		exit();
	} else {
		$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Error, este proyecto ya tiene un presupuesto asignado";
		header("Location: ../masterPage.php");
		exit();
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
$existe = 0;	
$resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
while ($fila2 = mysqli_fetch_assoc($resultado2)) {
 	if ($fila2['fk_proyecto'] == $_GET['id'] && $fila2['jornada'] < 99) {
    	$existe = 1;
        }
    }

    if ($existe == 0 && $_GET['eliminadoPresupuestoProyecto'] == 1) {
    	$_SESSION['alerta'] = 1;
		$_SESSION['alerta-contenido'] = "Este proyecto no tiene presupuestos asignados";
		header("Location: ../masterPage.php");
		exit();
    }

	$resultado = $db->obtenerProyecto();
        while ($fila = mysqli_fetch_assoc($resultado)) {
        	if ($fila['id_proyecto'] == $_GET['id']) {

        		$resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
        		while ($fila2 = mysqli_fetch_assoc($resultado2)) {
        			if ($fila2['fk_proyecto'] == $_GET['id'] && $fila2['jornada'] < 99) {
        				$fk_presupuesto = $fila2['fk_id_presupuesto'];
        			}
        		}


        		$fraccion = convertirDobleFraciones($fila['jornada_proyecto']);
        		header("Location: ../masterPage.php?modalProyectosPresupuesto=1&id_proyecto=".$fila['id_proyecto']."&nombre_proyecto=".$fila['nombre_proyecto']."&tipo_proyecto=".$fila['tipo_proyecto']."&jornada_proyecto=".$fraccion."&fk_encargado=".$fila['fk_encargado']."&fk_ayudante=".$fila['fk_ayudante']."&agregandoPresupuestoProyecto=".$_GET['agregandoPresupuestoProyecto']."&eliminadoPresupuestoProyecto=".$_GET['eliminadoPresupuestoProyecto']."&fk_presupuesto=".$fk_presupuesto."&idProyecto=".$_GET['id']);
				exit();
        	}
        }
}
 ?>

<?php 
echo "string ".$idProyecto." - ".$_POST['proyectosBtnAgregarPresupuesto'];

//header("Location: ../masterPage.php");
//exit();
 ?>