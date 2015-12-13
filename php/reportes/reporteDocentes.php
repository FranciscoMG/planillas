<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../include/conversor.php");?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>


<?php $db = new docentesBD(); ?>
<?php $resultadoDocente = $db->obtenerDocentes(); ?>
<?php $dbGrupos = new gruposBD(); ?>
<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>


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

$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,"Reporte de Docentes");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);

////////////////// Contenido //////////////////////
$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
$pdf->Cell(40,10,"Apellidos",1,0,"C");
$pdf->Cell(25,10,"Nombre",1,0,"C");
$pdf->Cell(27,10,"Grado Academico",1,0,"C");
$pdf->Cell(25,10,"Nombramiento",1,0,"C");
$pdf->Cell(27,10,"Jornada Asignada",1,0,"C");
$pdf->Cell(26,10,"Jornada Faltante",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);

while ($fila = mysqli_fetch_assoc($resultadoDocente)) {
	$cedula_docente = $fila['cedula'];
	$pdf->Cell(20,10,$cedula_docente,1,0,"C");
	$pdf->Cell(40,10,iconv("UTF-8","ISO-8859-1",$fila['apellidos']),1,0,"C");
	$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1",$fila['nombre']),1,0,"C");

	//Grado Academico
	$grado_ac;

	if ($fila['grado_academico'] == 0) {
		$grado_ac = "Bachillerato";
	} else {
		if ($fila['grado_academico'] == 1) {
			$grado_ac = "Licenciatura";
		} else {
			if ($fila['grado_academico'] == 2) {
				$grado_ac = "Maestría";
			} else {
				$grado_ac = "Doctorado";
			}
		}
	}
	$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1",$grado_ac),1,0,"C");

	//Nombramiento
	$contrato_tipo;

	if ($fila['tipo_contrato'] == 0) {
		$contrato_tipo = "Interino";
	} else {
		if ($fila['tipo_contrato'] == 1) {
			$contrato_tipo = "Propiedad";
		} else {
			$contrato_tipo = "Sustituto";
		}
	}

	$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1",$contrato_tipo),1,0,"C");

	///////////////////////// Calculo de tiempos
	$tiempoIndividual = 0;
	$resultadoPresupuesto2 = $dbGrupos->obtenerGrupoDocentes();
	while ($fila2 = mysqli_fetch_assoc($resultadoPresupuesto2)) {
	 	if ($fila['cedula'] == $fila2['fk_docente']) {
	 		$tiempoIndividual = ($tiempoIndividual + $fila2['tiempo_individual']);
		}
	 }
	$resultado1 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
	while ($fila3 = mysqli_fetch_assoc($resultado1)) {
		if ($fila3['fk_docente'] == $fila['cedula']) {
			$tiempoIndividual = ($tiempoIndividual + $fila3['jornada']);
		}
	}
	////////////////////
	$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1",$tiempoIndividual),1,0,"C");

	$faltante = 1 - $tiempoIndividual;

	if ($fila['tipo_contrato'] == 1) {
		if ($faltante == 1) {
			$pdf->SetTextColor(0,0,0);
		} else {
			$pdf->SetTextColor(255,0,0);
		}
		$pdf->SetFillColor(255, 255 , 255);
		$pdf->Cell(26,10,iconv("UTF-8","ISO-8859-1",$faltante),1,0,"C",true);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255, 255 , 255);
	} else {
		$pdf->Cell(26,10,iconv("UTF-8","ISO-8859-1",$faltante),1,0,"C");
	}


	$pdf->Ln();
}

//////////////////////////Totales Docente////////////////////////

//$pdf->Cell(27,7,iconv("UTF-8","ISO-8859-1","número"),1,0,"C");
$pdf->Ln();
/*
$pdf->SetY(65);
while ($fila2 = mysqli_fetch_assoc($resultadoPresupuesto)) {
	$pdf->SetX(174);
	$suma = $suma + $fila2['tiempo_individual'];
	$convertidoDocentes = convertirDobleFraciones($fila2['tiempo_individual']);
	$pdf->Cell(27,10,$convertidoDocentes,1,0,"C");
	$pdf->Ln();
}

$pdf->SetX(174);
$convertidoSuma = convertirDobleFraciones($suma);
$pdf->Cell(27,7,$convertidoSuma,1,0,"C");
*/
$pdf->Output();
?>
