<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php
if ($_GET['reporteDetallado=1'] != 1) { //////// En caso de que reporte detallado sea igual a uno NO entra en if y se debe mostrar todos los presupuestos de manera detallada.
	if (!empty($_POST['id_presupuesto'])) { ///////////// Aqui se compara de donde vienen los datos, si es de la tabla es por GET y si vienen de modal selecionar reporte es por POST, esto aplica para mostrar solo un presupuesto de manera detallada
		$id_presupuesto = $_POST['id_presupuesto'];
	} else {
		$id_presupuesto = $_GET['id_presupuesto'];
	}
}

 ?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>
<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php include_once("../conexionBD/docenteAdministrativoBD.php"); ?>
<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>


<?php include_once("../include/conversor.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>
<?php $dbProyectos = new proyectosBD(); ?>
<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>
<?php $dbDocentes = new docentesBD(); ?>
<?php $dbDocenteAdministrativoBD = new docenteAdministrativoBD(); ?>
<?php $dbDocentesConPermisoBD = new docentesConPermisoBD(); ?>


<?php $db = new presupuestoBD(); ?>
<?php $resultado = $db->obtenerPresupuesto($id_presupuesto);//Nesecita los ID ESPECIFICOS CAMBIAR AQUÍ ?>

<?php
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

/////////////////// Header ///////////////////////
$pdf->Image('../../img/ucr-logo.png',10,8,40);
$pdf->Cell(80);
$pdf->Cell(50,10,"Universidad de Costa Rica");
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(90,0,iconv("UTF-8","ISO-8859-1","       Sede del Pacífico"));
$pdf->Ln();
$pdf->Cell(80);

$tipoPerfil;
if ($_SESSION['tipoPerfil'] == 0) {
	$tipoPerfil = "Dirección";
} else {
	if ($_SESSION['tipoPerfil'] == 1) {
		$tipoPerfil = "Docencia";
	} else {
		$tipoPerfil = "Recursos Humanos";
	}
}
$pdf->Cell(53,10,iconv("UTF-8","ISO-8859-1","".$tipoPerfil),0,0,"C");

$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,"Reporte de Presupuestos");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(13);
$pdf->SetFont('Arial','B',10);

////////////////// Contenido //////////////////////

	$pdf->Cell(50,10,"Nombre del presupuesto",1,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","Código"),1,0,"C");
	$pdf->Cell(30,10,"Tiempo Total",1,0,"C");
	$pdf->Cell(45,10,"Tiempos Disponibles ",1,0,"C");
	$pdf->Cell(45,10,"Real Asignado",1,0,"C");
	$pdf->Ln();


/////////////////////Datos/////////////////////////////
		$pdf->SetFont('Arial','',9);
		while ($fila = mysqli_fetch_assoc($resultado)) {
			$id_presupuesto = $fila['id_presupuesto'];

			$pdf->Cell(50,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_presupuesto']),1,0,"C");

			$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1",$fila['codigo']),1,0,"C");

			$convertidoTiempoPresupuesto = $fila['tiempo_presupuesto'];

			$pdf->Cell(30,10,$convertidoTiempoPresupuesto,1,0,"C");

			$convertidoTiempoSobrante = $fila['tiempo_sobrante'];

			$pdf->Cell(45,10,$convertidoTiempoSobrante,1,0,"C");

			$realAsignado = $fila['tiempo_presupuesto'] - $fila['tiempo_sobrante'];
			$pdf->Cell(45,10,$realAsignado,1,0,"C");

			$pdf->Ln();

	}

//////////// Grupos ///////////
	$pdf->Ln();
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","Asignación / Grupos"),1,0,"C");
	$pdf->Ln();
	$pdf->Cell(30,7,"Sigla",1,0,"C");
	$pdf->Cell(100,7,"Nombre",1,0,"C");
	$pdf->Cell(20,7,iconv("UTF-8","ISO-8859-1","Créditos"),1,0,"C");
	$pdf->Cell(20,7,"Grupo",1,0,"C");
	$pdf->Cell(20,7,"Jornada",1,0,"C");
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();

$resultado2 = $dbGrupos->llenarTabla();
$existe = 0;
while ($fila2 = mysqli_fetch_assoc($resultado2)) {
	if ($fila2['fk_presupuesto'] == $id_presupuesto && $fila2['fk_presupuesto'] != 1) {
		$existe = 1;
		$fila2['fk_curso'];
		$pdf->Cell(30,7,$fila2['fk_curso'],1,0,"C");
		$pdf->Cell(100,7,iconv("UTF-8","ISO-8859-1",$fila2['nombre_curso']),1,0,"C");
		$pdf->Cell(20,7,$fila2['creditos'],1,0,"C");
		$pdf->Cell(20,7,$fila2['num_grupo'],1,0,"C");
		$pdf->Cell(20,7,$fila2['jornada'],1,0,"C");
		$pdf->SetFont('Arial','',9);
		$pdf->Ln();
	}
}
if ($existe == 0) {
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","No se a asignado a grupos"),1,0,"C");
	$pdf->Ln();
}

///////////// Proyectos /////////
	$pdf->Ln();
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","Asignación / Proyectos"),1,0,"C");
	$pdf->Ln();
	$pdf->Cell(40,7,"Nombre",1,0,"C");
	$pdf->Cell(35,7,"Tipo de proyecto",1,0,"C");
	$pdf->Cell(50,7,"Encargado",1,0,"C");
	$pdf->Cell(50,7,"Ayudante",1,0,"C");
	$pdf->Cell(15,7,"Jornada",1,0,"C");
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();

$resultado3 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
$existe = 0;
while ($fila2 = mysqli_fetch_assoc($resultado3)) {
	if ($fila2['fk_id_presupuesto'] == $id_presupuesto && $fila2['fk_id_presupuesto'] != 1) {
		$existe = 1;
		///// proyecto /////
		$resultado4 = $dbProyectos->obtenerProyecto();
		while ($fila3 = mysqli_fetch_assoc($resultado4)) {
			if ($fila2['fk_proyecto'] == $fila3['id_proyecto']) {
				$pdf->Cell(40,7,iconv("UTF-8","ISO-8859-1",$fila3['nombre_proyecto']),1,0,"C");
				$tipo_proyecto = $fila3['tipo_proyecto'];
				if ($tipo_proyecto == 0 ){
					$pdf->Cell(35,7,iconv("UTF-8","ISO-8859-1","Acción Social"),1,0,"C");
				} else {
					$pdf->Cell(35,7,iconv("UTF-8","ISO-8859-1","Investigación"),1,0,"C");
				}

				$resultado5 = $dbDocentes->obtenerDocentes();
				while ($fila4 = mysqli_fetch_assoc($resultado5)) {
					if ($fila3['fk_encargado'] == $fila4['cedula']) {
						$encargado = $fila4['apellidos']." ".$fila4['nombre'];
					}
					if ($fila3['fk_ayudante'] == $fila4['cedula']) {
						$ayudante = $fila4['apellidos']." ".$fila4['nombre'];
					}
				}
				$pdf->Cell(50,7,iconv("UTF-8","ISO-8859-1",$encargado),1,0,"C");
				$pdf->Cell(50,7,iconv("UTF-8","ISO-8859-1",$ayudante),1,0,"C");

				$pdf->Cell(15,7,$fila3['jornada_proyecto'],1,0,"C");
				$pdf->SetFont('Arial','',9);
				$pdf->Ln();
			}
		}
	}
}
if ($existe == 0) {
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","No se a asignado a proyectos"),1,0,"C");
	$pdf->Ln();
}
///////////// Docente administrativo /////////
	$pdf->Ln();
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","Asignación / Docentes Administrativos"),1,0,"C");
	$pdf->Ln();
	$pdf->Cell(30,7,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
	$pdf->Cell(90,7,"Nombre",1,0,"C");
	$pdf->Cell(50,7,"Nombramiento",1,0,"C");
	$pdf->Cell(20,7,"Jornada",1,0,"C");
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();

$resultado3 = $dbDocenteAdministrativoBD->obtenerDocenteAdministrativo();
$existe = 0;
while ($fila2 = mysqli_fetch_assoc($resultado3)) {
	if ($fila2['fk_presupuesto'] == $id_presupuesto && $fila2['fk_presupuesto'] != 1) {
		$existe = 1;
		$pdf->Cell(30,7,$fila2['cedula'],1,0,"C");
		$pdf->Cell(90,7,iconv("UTF-8","ISO-8859-1",$fila2['apellidos']." ".$fila2['nombre']),1,0,"C");

		if ($fila2['grado_academico'] == 0) {
		$grado_ac = "Bachillerato";
		} else {
			if ($fila2['grado_academico'] == 1) {
				$grado_ac = "Licenciatura";
			} else {
				if ($fila2['grado_academico'] == 2) {
					$grado_ac = "Maestría";
				} else {
					$grado_ac = "Doctorado";
				}
			}
		}
		$pdf->Cell(50,7,iconv("UTF-8","ISO-8859-1",$grado_ac),1,0,"C");
		$pdf->Cell(20,7,$fila2['jornada_docenteAdministrativo'],1,0,"C");
		$pdf->Ln();
	}
}
if ($existe == 0) {
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","No se a asignado a docentes administrativos"),1,0,"C");
	$pdf->Ln();
}
///////////// Docente Con permiso /////////
	$pdf->Ln();
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","Asignación / Docentes con permisos temporales"),1,0,"C");
	$pdf->Ln();
	$pdf->Cell(30,7,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
	$pdf->Cell(90,7,"Nombre",1,0,"C");
	$pdf->Cell(50,7,"Nombramiento",1,0,"C");
	$pdf->Cell(20,7,"Jornada",1,0,"C");
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();

$resultado3 = $dbDocentesConPermisoBD->obtenerDocentesConPermiso();
$existe = 0;
while ($fila2 = mysqli_fetch_assoc($resultado3)) {
	if ($fila2['fk_presupuesto'] == $id_presupuesto && $fila2['fk_presupuesto'] != 1) {
		$existe = 1;
		$pdf->Cell(30,7,$fila2['cedula'],1,0,"C");
		$pdf->Cell(90,7,iconv("UTF-8","ISO-8859-1",$fila2['apellidos']." ".$fila2['nombre']),1,0,"C");

		if ($fila2['grado_academico'] == 0) {
		$grado_ac = "Bachillerato";
		} else {
			if ($fila2['grado_academico'] == 1) {
				$grado_ac = "Licenciatura";
			} else {
				if ($fila2['grado_academico'] == 2) {
					$grado_ac = "Maestría";
				} else {
					$grado_ac = "Doctorado";
				}
			}
		}
		$pdf->Cell(50,7,iconv("UTF-8","ISO-8859-1",$grado_ac),1,0,"C");
		$pdf->Cell(20,7,$fila2['jornada_docenteConPermiso'],1,0,"C");
		$pdf->Ln();
	}
}
if ($existe == 0) {
	$pdf->Cell(190,7,iconv("UTF-8","ISO-8859-1","No se a asignado a docentes con permisos temporales"),1,0,"C");
	$pdf->Ln();
}

$pdf->Output();


?>
