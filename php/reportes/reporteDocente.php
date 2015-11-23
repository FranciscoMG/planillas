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
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while ($fila = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(40,10,$fila['nombre']);
	$pdf->Ln();
}

$pdf->Output();

?>

