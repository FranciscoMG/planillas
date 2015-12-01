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

<?php


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

/////////////////// Header ///////////////////////
$pdf->Image('../../img/ucr-logo.png',20,8,40);
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
$pdf->Cell(10,10,iconv("UTF-8","ISO-8859-1","Reporte de los proyectos"));
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(13);
$pdf->SetFont('Arial','B',10);

//////////////////// Contenido ///////////////////////
	$pdf->Cell(30,10,"Nombre",0,0,"C");
	$pdf->Cell(30,10,"Tipo",0,0,"C");
	$pdf->Cell(20,10,"Tiempos",0,0,"C");
	$pdf->Cell(55,10,"Principal/Responsable",0,0,"C");
	$pdf->Cell(55,10,"Asociado/Colaborador",0,0,"C");
	$pdf->Ln();

	$pdf->SetFont('Arial','',9);

while ($fila = mysqli_fetch_assoc($resultado)) {
	if ($fila['nombre_proyecto'] != 1) {
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_proyecto']),1);

	if ($fila['tipo_proyecto'] == 0) {
		$pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1", "Acción Social"),1);
	} else {
		$pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1", "Investigación"),1);
	}
	$pdf->Cell(20,10,convertirDobleFraciones ($fila['jornada_proyecto']),1,0,"C");

	$resultado2 = $dbDocentes->obtenerDocentes($fila['fk_encargado']);
	while ($fila2 = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_encargado'] == $fila2['cedula']) {
			$pdf->Cell(55,10,iconv("UTF-8", "ISO-8859-1",$fila2['nombre']),1);
		}
	}
	$resultado2 = $dbDocentes->obtenerDocentes($fila['fk_ayudante']);
	while ($fila2 = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_ayudante'] == $fila2['cedula']) {
			$pdf->Cell(55,10, iconv("UTF-8","ISO-8859-1",$fila2['nombre']),1);
		}
	}
	$pdf->Ln();
	}
}

$pdf->Output();

?>
<meta charset="utf-8">