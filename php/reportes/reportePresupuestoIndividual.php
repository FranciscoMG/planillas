<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php 
if ($_GET['reporteDetallado=1'] != 1) { //////// En caso de que reporte detallado sea igual a uno NO entra en if y se debe mostrar todos los presupuestos de manera detallada.
	if (!empty($_POST['id_presupuesto'])) { ///////////// Aqui se compara de donde vienen los datos, si es de la tabla es por GET y si vienen de modal selecionar reporte es por POST, esto aplica para mostrar solo un presupuesto de manera detallada
		$id_presupuesto = $_POST['id_presupuesto'];
	} else {
		$id_presupuesto = $_GET['id_presupuesto'];
	}
}

 ?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php include_once("../include/conversor.php"); ?>
<?php $db = new presupuestoBD(); ?>
<?php $resultado = $db->obtenerPresupuesto($id_presupuesto);//Nesecita los ID ESPECIFICOS CAMBIAR AQUÍ ?>

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
$pdf->Cell(10,10,"Reporte de Presupuestos");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(13);
$pdf->SetFont('Arial','B',10);

////////////////// Contenido //////////////////////

	$pdf->Cell(50,10,"Nombre del presupuesto",1,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1","Código"),1,0,"C");
	$pdf->Cell(30,10,"Tiempo Total",1,0,"C");
	$pdf->Cell(45,10,"Tiempos Disponibles ",1,0,"C");
	$pdf->Cell(45,10,"Real Asignado",1,0,"C");
	$pdf->Ln();


/////////////////////Datos/////////////////////////////
		$pdf->SetFont('Arial','',9);
		while ($fila = mysqli_fetch_assoc($resultado)) {

			$pdf->Cell(50,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_presupuesto']),1,0,"C");

			$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1",$fila['codigo']),1,0,"C");

			$convertidoTiempoPresupuesto = $fila['tiempo_presupuesto'];

			$pdf->Cell(30,10,$convertidoTiempoPresupuesto,1,0,"C");

			$convertidoTiempoSobrante = $fila['tiempo_sobrante'];

			$pdf->Cell(45,10,$convertidoTiempoSobrante,1,0,"C");

			$realAsignado = $fila['tiempo_presupuesto'] - $fila['tiempo_sobrante'];
			$pdf->Cell(45,10,$realAsignado,1,0,"C");

			$pdf->Ln();
		}

$pdf->Output();

?>
