<?php 
session_start(); 
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>
<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php $db = new proyectosBD(); ?>
<?php $resultado = $db->obtenerProyecto(); ?>

<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php $dbDocentes = new docentesBD(); ?>

<?php


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

while ($fila = mysqli_fetch_assoc($resultado)) {
	if ($fila['nombre_proyecto'] != 1) {
	$pdf->Cell(40,10,$fila['nombre_proyecto']);

	if ($fila['tipo_proyecto'] == 0) {
		$pdf->Cell(40,10,iconv("UTF-8", "ISO-8859-1", "Acción Social"));
	} else {
		$pdf->Cell(40,10,iconv("UTF-8", "ISO-8859-1", "Investigación"));
	}
	$pdf->Cell(40,10,$fila['jornada_proyecto']);

	$resultado2 = $dbDocentes->obtenerDocentes($fila['fk_encargado']);
	while ($fila2 = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_encargado'] == $fila2['cedula']) {
			$pdf->Cell(40,10,$fila2['nombre']);
		}
	}
	$resultado2 = $dbDocentes->obtenerDocentes($fila['fk_ayudante']);
	while ($fila2 = mysqli_fetch_assoc($resultado2)) {
		if ($fila['fk_ayudante'] == $fila2['cedula']) {
			$pdf->Cell(40,10,$fila2['nombre']);
		}
	}
	$pdf->Ln();
	}
}

$pdf->Output();

?>
<meta charset="utf-8">