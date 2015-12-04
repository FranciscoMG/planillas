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
$pdf->Cell(10,10,"Reporte de los Docentes");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);

////////////////// Contenido //////////////////////
$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1","Cédula"),0,0,"C");
$pdf->Cell(40,10,"Nombre",0,0,"C");
$pdf->Cell(10,10,"Apellidos",0,0,"C");
$pdf->Cell(55,10,"Grado Academico",0,0,"C");
$pdf->Cell(20,10,"Tipo de Cotrato",0,0,"C");
$pdf->Cell(30,10,"Grupo",0,0,"C");
$pdf->Cell(1,10,iconv("UTF-8","ISO-8859-1","Día"),0,0,"C");
$pdf->Cell(35,10,"Hora Inicio",0,0,"C");
$pdf->Cell(15,10,"Hora Fin",0,0,"C");
$pdf->Cell(32,10,"Jornada",0,0,"C");
$pdf->Ln();

$pdf->SetFont('Arial','',9);


while ($fila = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(40,10,$fila['cedula'],1);
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1",$fila['nombre']),1);
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['apellidos']),1);

	//Grado Academico
	$grado_academico;

	if ($fila['grado'] == 0) {
		$grado_academico = "Bachillerato";
	} else {
		if ($fila['grado'] == 1) {
			$grado_academico = "Licenciatura";
		} else {
			if ($fila['grado'] == 2) {
				$grado_academico = "Maestría";
			} else {
				$grado_academico = "Doctorado";
			}
		}
	}
	$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1",$grado_academico),1);

	//Tipo de Contrato
	$tipo_contrato;

	if ($fila['contrato'] == 0) {
		$tipo_contrato = "Interino";
	} else {
		if ($fila['contrato'] == 1) {
			$tipo_contrato = "Propiedad";
		} else {
			$tipo_contrato = "Sustituto";
		}
	}
	$pdf->Cell(38,10,iconv("UTF-8","ISO-8859-1",$tipo_contrato),1);
	$pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	$pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");


	$pdf->Ln();
}



$pdf->Output();

?>
