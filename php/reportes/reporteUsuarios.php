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
$pdf->Cell(10,10,iconv("UTF-8","ISO-8859-1","Reporte de los usuarios"));
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(13);
$pdf->SetFont('Arial','B',10);
////////////////// Contenido //////////////////////
	$pdf->Cell(30,10,"Usuario",1,0,"C");
	$pdf->Cell(30,10,"Nombre",1,0,"C");
	$pdf->Cell(40,10,"Apellidos",1,0,"C");
	$pdf->Cell(30,10,"Tipo de Perfil",1,0,"C");
	$pdf->Cell(40,10,"Correo",1,0,"C");
	$pdf->Cell(20,10,"Habilitado",1,0,"C");
	$pdf->Ln();

	$pdf->SetFont('Arial','',9);
while ($fila = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['usuario']),1 , 0 ,"C");
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_usuario']),1, 0 ,"C");
	$pdf->Cell(40,10,iconv("UTF-8","ISO-8859-1",$fila['apellido_usuario']),1, 0 ,"C");

	///// Tipo de perfil /////
	$tipoPerfil;
	if ($fila['perfil'] == 0) {
		$tipoPerfil = "Dirección";
	} else {
		if ($fila['perfil'] == 1) {
			$tipoPerfil = "Docencia";
		} else {
			$tipoPerfil = "Recursos Humanos";
		}
	}
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$tipoPerfil),1, 0 ,"C");
	///////////////////////////
	$pdf->Cell(40,10,iconv("UTF-8","ISO-8859-1",$fila['correo_usuario']),1, 0 ,"C");

	//// Habilitado /////
	if ($fila['habilitado'] == 1) {
		$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","Si"),1,0,"C");
	} else {
		$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","No"),1,0,"C");
	}
	////////////////////////
	$pdf->Ln();
}

$pdf->Output();

?>
