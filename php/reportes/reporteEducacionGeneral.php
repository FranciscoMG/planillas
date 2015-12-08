<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php $db = new docentesBD(); ?>
<?php $resultado = $db->obtenerDocentes(); ?>

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
$pdf->Cell(10,10,iconv("UTF-8","ISO-8859-1","Reporte de Educación General"));
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);

//Tabla de estudios generales//
$pdf->Cell(276,8,iconv("UTF-8","ISO-8859-1","Educación general"),1,0,"C");
$pdf->Ln();
$pdf->Cell(20,10,"Sigla",1,0,"C");
$pdf->Cell(60,10,"Nombre",1,0,"C");
$pdf->Cell(15,10,"Jornada",1,0,"C");
$pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","Créditos"),1,0,"C");
$pdf->Cell(15,10,"Grupo",1,0,"C");
$pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","Día"),1,0,"C");
$pdf->Cell(17,10,"Hora Inicio",1,0,"C");
$pdf->Cell(15,10,"Hora Fin",1,0,"C");
$pdf->Cell(25,10,"Nombre/Docente",1,0,"C");
$pdf->Cell(15,10,"Apellidos",1,0,"C");
$pdf->Cell(15,10,"PO 1050",1,0,"C");
$pdf->Cell(15,10,"PO 1052",1,0,"C");
$pdf->Cell(22,10,"Apoyo Vic Doc.",1,0,"C");
$pdf->Cell(12,10,"Otro",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);

	$pdf->Cell(20,10,"NO ",1,0,"C");
	$pdf->Cell(60,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(17,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(25,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(15,10,"NO ",1,0,"C");
  $pdf->Cell(22,10,"NO ",1,0,"C");
	$pdf->Cell(12,10,"NO ",1,0,"C");


$pdf->Output();
?>
