<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php 
$cedula = $_POST['cedula']; /// // <--- este es la cedula del docente que se manda cuando se selecciona en el modal.
 ?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../include/conversor.php");?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php $db = new docentesBD(); ?>
<?php $resultadoDocente = $db->obtenerUnDocente($cedula); //SE INGRESA EL ID (CÉDULA)?>
<?php $db = new gruposBD(); ?>
<?php $resultado = $db->llenarTabla(); ?>


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

$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,"Reporte de Docente Individual");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);

////////////////// Contenido //////////////////////
$pdf->Cell(131,10,iconv("UTF-8","ISO-8859-1","Aarón Galagarza Carillo (Cambiar Nombre)"),1,0,"C");///CAMBIAR MÉTODO DEL NOMBRE
$pdf->Ln();
$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
$pdf->Cell(27,10,"Grado Academico",1,0,"C");
$pdf->Cell(25,10,"Nombramiento",1,0,"C");
$pdf->Cell(27,10,"Jornada Asignada",1,0,"C");
$pdf->Cell(27,10,"Jornada Faltante",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);


while ($fila = mysqli_fetch_assoc($resultadoDocente)) {
  $pdf->Cell(25,10,$fila['cedula'],1,0,"C");

	//Grado Academico
	$grado_ac;

	if ($fila['grado_academico'] == 0) {
		$grado_ac = "Bachillerato";
	} else {
		if ($fila['grado_academico'] == 1) {
			$grado_ac = "Licenciatura";
		} else {
			if ($fila['grado_academico'] == 2) {
				$grado_ac = "Maestría";
			} else {
				$grado_ac = "Doctorado";
			}
		}
	}
	$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1",$grado_ac),1,0,"C");

	//Nombramiento
	$contrato_tipo;

	if ($fila['tipo_contrato'] == 0) {
		$contrato_tipo = "Interino";
	} else {
		if ($fila['tipo_contrato'] == 1) {
			$contrato_tipo = "Propiedad";
		} else {
			$contrato_tipo = "Sustituto";
		}
	}
	$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1",$contrato_tipo),1,0,"C");
	$suma = $suma + $fila['tiempo_individual'];
	$pdf->Cell(27,10,$suma,1,0,"C");
	if ($fila['tipo_contrato'] == 1) {
		$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	}else{
		$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1","--"),1,0,"C");
	}
	$pdf->Ln();
}

//////////////Contenido Grupos/////////////
$pdf->Ln();

$pdf->SetFont('Arial','B',8);
$pdf->Cell(163,10,"Asignaciones",1,0,"C");
$pdf->Ln();
$pdf->Cell(18,10,"Sigla/Curso",1,0,"C");
$pdf->Cell(60,10,"Nombre/Curso",1,0,"C");
$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1","Creditos"),1,0,"C");
$pdf->Cell(13,10,"Grupo",1,0,"C");
$pdf->Cell(18,10,"Proyecto",1,0,"C");
$pdf->Cell(27,10,"Jornada Asignada",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);

while ($fila = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(18,10,$fila['fk_curso'],1,0,"C");
	$pdf->Cell(60,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_curso']),1,0,"C");
	$sumaCredito = $sumaCredito + $fila['creditos'];
	$pdf->Cell(27,10,$fila['creditos'],1,0,"C");
	$pdf->Cell(13,10,$fila['num_grupo'],1,0,"C");
  $pdf->Cell(18,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	$suma = $suma + $fila['jornada'];
	$convertidoGrupo = convertirDobleFraciones($fila['jornada']);
	$pdf->Cell(27,10,$convertidoGrupo,1,0,"C");
	$pdf->Ln();

}

//////////////////////////Totales Grupo////////////////////////

$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0, 193 , 0);
$pdf->Cell(18,7,iconv("UTF-8","ISO-8859-1","totales"),1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(88);
$pdf->Cell(27,7,iconv("UTF-8","ISO-8859-1",$sumaCredito),1,0,"C");
$pdf->SetX(146);
$convertidoSuma = convertirDobleFraciones($suma);
$pdf->Cell(27,7,iconv("UTF-8","ISO-8859-1",$suma),1,0,"C");//POR MIENTRAS SE CONSIGUE CAMBIAR FRACCIONES
$pdf->Ln();

$pdf->Output();
?>
