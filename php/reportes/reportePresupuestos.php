<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php $db = new presupuestoBD(); ?>
<?php $resultado = $db->obtenerlistadoDePresupuesto(); ?>

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
$pdf->Cell(10,10,"Reporte de Presupuestos");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(13);
$pdf->SetFont('Arial','B',10);

////////////////// Contenido //////////////////////
	$pdf->Cell(50,10,"Nombre del presupuesto",0,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","Código"),0,0,"C");
	$pdf->Cell(30,10,"Tiempos Total",0,0,"C");
	$pdf->Cell(45,10,"Real Asignado",0,0,"C");
	$pdf->Cell(45,10,"Tiempos Disponibles ",0,0,"C");
	$pdf->Cell(45,10,"Diferencia ",0,0,"C");
	$pdf->Ln();

	$pdf->SetFont('Arial','',9);
while ($fila = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(50,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_presupuesto']),1,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1",$fila['codigo']),1,0,"C");
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['tiempo_presupuesto']),1,0,"C");
	$pdf->Cell(45,10,iconv("UTF-8","ISO-8859-1","No Completado"),1,0,"C");
	$pdf->Cell(45,10,iconv("UTF-8","ISO-8859-1","No Completado"),1,0,"C");
	$pdf->Cell(45,10,iconv("UTF-8","ISO-8859-1","No Completado"),1,0,"C");

	$pdf->Ln();
}

$pdf->Output();

?>
