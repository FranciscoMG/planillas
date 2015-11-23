<?php 
session_start(); 
if ($_SESSION[masterActivo] != 1 || $_SESSION['tipoPerfil'] !=0) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>
<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/usuariosBD.php"); ?>
<?php $db = new usuariosBD(); ?>
<?php $resultado = $db->obtenerlistadoDeUsuarios(); ?>

<?php
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while ($fila = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(40,10,$fila['usuario']);
	$pdf->Cell(40,10,$fila['nombre_usuario']);
	$pdf->Cell(40,10,$fila['apellido_usuario']);
	$pdf->Cell(40,10,$fila['perfil']);
	$pdf->Cell(40,10,$fila['correo_usuario']);
	$pdf->Cell(40,10,$fila['habilitado']);
	$pdf->Ln();
}

$pdf->Output();

?>