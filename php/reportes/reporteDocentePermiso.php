<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../include/conversor.php");?>
<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>
<?php include_once("../conexionBD/presupuestoBD.php");?>

<?php $db = new docentesConPermisoBD(); ?>
<?php $resultadoDocente = $db->obtenerDocentesConPermiso(); ?>
<?php $resultadoDocente2 = $db->obtenerDocentesConPermiso(); ?>
<?php $dbPresupuesto = new presupuestoBD(); ?>



<?php
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

/////////////////// Header ///////////////////////
$pdf->Image('../../img/ucr-logo.png',10,8,40);
$pdf->Cell(110);
$pdf->Cell(50,10,"Universidad de Costa Rica");
$pdf->Ln();
$pdf->Cell(110);
$pdf->Cell(90,0,iconv("UTF-8","ISO-8859-1","       Sede del Pacífico"));
$pdf->Ln();
$pdf->Cell(110);

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
$pdf->Cell(10,10,"Reporte de Docentes con Permiso");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);

////////////////// Contenido //////////////////////
$pdf->Cell(23,10,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
$pdf->Cell(20,10,"Nombre",1,0,"C");
$pdf->Cell(30,10,"Apellidos",1,0,"C");
$pdf->Cell(27,10,"Grado Academico",1,0,"C");
$pdf->Cell(25,10,"Nombramiento",1,0,"C");
$pdf->Cell(70,10,"Presupuesto",1,0,"C");
$pdf->Cell(25,10,"Jornada Faltante",1,0,"C");
$pdf->Cell(28,10,"Jornada Asignada",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);

while ($fila = mysqli_fetch_assoc($resultadoDocente)) {
	$cedula_docente = $fila['cedula'];
	if($cedula_docente != 1){
	$pdf->Cell(23,10,$cedula_docente,1,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1",$fila['nombre']),1,0,"C");
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['apellidos']),1,0,"C");

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

	$resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
	while ($fila3 = mysqli_fetch_assoc($resultado3)) {
		if ($fila["fk_presupuesto"] == $fila3["id_presupuesto"]) {
			$pdf->Cell(70,10,$fila3['nombre_presupuesto'],1,0,"C");
		}
	}

	if ($fila['tipo_contrato'] == 1) {
		if($fila['jornada_docenteConPermiso'] == 1){
			$pdf->Cell(25,10,"0",1,0,"C");
	}else{
		$jornadaFaltante = 1 - $fila['jornada_docenteConPermiso'];
		$convertidoJornadaFaltante = convertirDobleFraciones($jornadaFaltante);
		$sumaPermisoFaltante = $sumaPermisoFaltante + $jornadaFaltante;
		$pdf->Cell(25,10,$convertidoJornadaFaltante,1,0,"C");
	}
	}else{
		$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1","--"),1,0,"C");
	}
	$pdf->Ln();
}
}

//////////////////////////Totales Docente////////////////////////
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0, 193 , 0);
$pdf->Cell(23,7,iconv("UTF-8","ISO-8859-1","totales"),1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(205);
$sumaPermiso = $sumaPermiso + $fila2[''];//Aún no se puede convertir
$convertidoDocentes = convertirDobleFraciones($fila2['']);//Aún no se puede convertir
$pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1",$sumaPermisoFaltante),1,0,"C");
$pdf->Ln();

$pdf->SetY(65);
while ($fila2 = mysqli_fetch_assoc($resultadoDocente2)) {
	if($fila2['cedula'] != 1){
	$pdf->SetX(230);
	$sumaPermiso = $sumaPermiso + $fila2['jornada_docenteConPermiso'];//Aún no se puede convertir
	$convertidoDocentes = convertirDobleFraciones($fila2['jornada_docenteConPermiso']);//Aún no se puede convertir
	$pdf->Cell(28,10,$convertidoDocentes,1,0,"C");
	$pdf->Ln();
}
}

$pdf->SetX(230);
$convertidoSuma = convertirDobleFraciones($sumaPermiso);
$pdf->Cell(28,7,$sumaPermiso,1,0,"C");///Aun no se puede convertir

$pdf->Output();
?>
