<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>
<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>
<?php $db = new proyectosBD(); ?>
<?php $resultado = $db->obtenerProyecto(); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php $dbDocentes = new docentesBD(); ?>
<?php include_once("../conexionBD/presupuestoBD.php");?>
<?php $dbPresupuesto = new presupuestoBD(); ?>
<?php include_once("../conexionBD/presupuestoDocenteBD.php");?>
<?php $dbDocentesPresupuesto = new presupuestoDocenteBD(); ?>

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

$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,iconv("UTF-8","ISO-8859-1","Reporte de los proyectos"));
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(13);
$pdf->SetFont('Arial','B',10);

//////////////////// Contenido ///////////////////////
	$pdf->Cell(30,10,"Nombre",1,0,"C");
	$pdf->Cell(30,10,"Tipo",1,0,"C");
	$pdf->Cell(20,10,"Jornada",1,0,"C");
	$pdf->Cell(60,10,"Principal/Responsable",1,0,"C");
	$pdf->Cell(60,10,"Asociado/Colaborador",1,0,"C");
	$pdf->Cell(40,10,"Presupuesto",1,0,"C");
	$pdf->Cell(38,10,"Jornada asignada",1,0,"C");

	$sumaAsignados = 0;

	$pdf->Ln();

	$pdf->SetFont('Arial','',9);

while ($fila = mysqli_fetch_assoc($resultado)) {

	if ($fila['nombre_proyecto'] != 1) {
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_proyecto']),1,0,"C");
	if ($fila['tipo_proyecto'] == 0) {
		$pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1", "Acción Social"),1,0,"C");
	} else {
		$pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1", "Investigación"),1,0,"C");
	}

	$pdf->Cell(20,10,convertirDobleFraciones ($fila['jornada_proyecto']),1,0,"C");

	$resultado2 = $dbDocentes->obtenerDocentes($fila['fk_encargado']);

	while ($fila2 = mysqli_fetch_assoc($resultado2)) {

		if ($fila['fk_encargado'] == $fila2['cedula']) {
			$pdf->Cell(60,10,iconv("UTF-8", "ISO-8859-1",$fila2['nombre']." ".$fila2['apellidos']),1,0,"C");
		}

	}

	$resultado2 = $dbDocentes->obtenerDocentes($fila['fk_ayudante']);

	while ($fila2 = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_ayudante'] == $fila2['cedula']) {
			$pdf->Cell(60,10, iconv("UTF-8","ISO-8859-1",$fila2['nombre']." ".$fila2['apellidos']),1,0,"C");
		}

	}

	$nombrePresupuesto = "--";
	$resultado4 = $dbDocentesPresupuesto->obtenerlistadoDePresupuestoDocente();
	while ($fila4 = mysqli_fetch_assoc($resultado4)) {
		if ($fila4["fk_proyecto"] == $fila["id_proyecto"]) {

			$resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
			while ($fila3 = mysqli_fetch_assoc($resultado3)) {
				if ($fila4["fk_id_presupuesto"] == $fila3["id_presupuesto"]) {
					$nombrePresupuesto = $fila3['nombre_presupuesto'];
				}
			}
		}
	}
	$pdf->Cell(40,10,iconv("UTF-8","ISO-8859-1",$nombrePresupuesto),1,0,"C");

	$jornadaAsignada = 0;
	if ($nombrePresupuesto != "--") {
		$jornadaAsignada = $fila['jornada_proyecto'];
	}
	$sumaAsignados = ($sumaAsignados + $jornadaAsignada);
	$pdf->Cell(38,10,iconv("UTF-8","ISO-8859-1",$jornadaAsignada),1,0,"C");


	$pdf->Ln();
	}
}

//////////////////////////Totales Presupuesto////////////////////////
$pdf->Cell(200,10,"",0,0,"C");
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0, 193 , 0);
$pdf->Cell(40,10,iconv("UTF-8","ISO-8859-1","Totales: "),1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38,10,$sumaAsignados,1,0,"C");



/*
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0, 193 , 0);
$pdf->Cell(30,7,iconv("UTF-8","ISO-8859-1","totales"),1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(70);
$convertidoSuma = convertirDobleFraciones($sumaTiempos);
$pdf->Cell(20,7,$sumaTiempos,1,0,"C");
$pdf->SetX(210);
$pdf->Ln();
*/
$pdf->Output();

?>
<meta charset="utf-8">
