<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php 
$sigalGrupo = $_POST['fk_curso']; /// Los datos para este reporte siempre entran por POST desde el modal selecionar reporte, debe usar la sigla de la tabla gruposDocentes para ectraer la informacion
 ?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../include/conversor.php");?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php include_once("../conexionBD/docentesBD.php"); ?>
<?php $db = new docentesBD(); ?>
<?php $resultadoDocente = $db->obtenerDocentes(); ?>
<?php $db = new gruposBD(); ?>
<?php $resultado2 = $db->obtenerGrupoDocentes(); ?>
<?php $resultado = $db->llenarTabla(); ?>


<?php
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

/////////////////// Header ///////////////////////
$pdf->Image('../../img/ucr-logo.png',10,8,40);
$pdf->Cell(70);
$pdf->Cell(50,10,"Universidad de Costa Rica");
$pdf->Ln();
$pdf->Cell(70);
$pdf->Cell(90,0,iconv("UTF-8","ISO-8859-1","       Sede del Pacífico"));
$pdf->Ln();
$pdf->Cell(70);

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
$pdf->Cell(10,10,"Reporte de Grupos");
$pdf->Ln();
$pdf->Cell(10,4,iconv("UTF-8","ISO-8859-1","Sistema de planillas SIDOP"));
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);

////////////////// Contenido //////////////////////
$pdf->Cell(181,10,iconv("UTF-8","ISO-8859-1","Bachillerato en informatica empresarial"),1,0,"C");
$pdf->Ln();
$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
$pdf->Cell(20,10,"Nombre",1,0,"C");
$pdf->Cell(30,10,"Apellidos",1,0,"C");
$pdf->Cell(27,10,"Grado Academico",1,0,"C");
$pdf->Cell(25,10,"Nombramiento",1,0,"C");
$pdf->Cell(27,10,"Jornada Faltante",1,0,"C");
$pdf->Cell(27,10,"Jornada Asignada",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);


while ($fila = mysqli_fetch_assoc($resultadoDocente)) {
	$pdf->Cell(25,10,$fila['cedula'],1,0,"C");
	$pdf->Cell(20,10,iconv("UTF-8","ISO-8859-1",$fila['nombre']),1,0,"C");
	$pdf->Cell(30,10,iconv("UTF-8","ISO-8859-1",$fila['apellidos']),1,0,"C");

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
	if ($fila['tipo_contrato'] == 1) {
		$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1","No "),1,0,"C");
	}else{
		$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1","--"),1,0,"C");
	}
	$pdf->Ln();
}

$pdf->SetY(75);
while ($fila2 = mysqli_fetch_assoc($resultado2)) {
	$pdf->SetX(164);
	$sumaDocente = $sumaDocente + $fila2['tiempo_individual'];
	$convertidoDocentes = convertirDobleFraciones($fila2['tiempo_individual']);
	$pdf->Cell(27,10,$convertidoDocentes,1,0,"C");
	$pdf->Ln();
}


//////////////////////////Totales Docente////////////////////////

$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0, 193 , 0);
$pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1","totales"),1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(137);
$convertidoSumaDocente = convertirDobleFraciones($sumaDocente);
$pdf->Cell(27,7,iconv("UTF-8","ISO-8859-1","número"),1,0,"C");
$pdf->SetX(164);
$pdf->Cell(27,7,$sumaDocente,1,0,"C");
$pdf->Ln();

//////////////Contenido Grupos/////////////
$pdf->Ln();

$pdf->SetFont('Arial','B',8);

$pdf->Cell(18,10,"Sigla/Curso",1,0,"C");
$pdf->Cell(60,10,"Nombre/Curso",1,0,"C");
$pdf->Cell(12,10,iconv("UTF-8","ISO-8859-1","Día"),1,0,"C");
$pdf->Cell(18,10,"Hora Inicio",1,0,"C");
$pdf->Cell(18,10,"Hora Fin",1,0,"C");
$pdf->Cell(27,10,iconv("UTF-8","ISO-8859-1","Creditos"),1,0,"C");
$pdf->Cell(13,10,"Grupo",1,0,"C");
$pdf->Cell(22,10,"Jornada/Grupo",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);

while ($fila2 = mysqli_fetch_assoc($resultado)) {
	$pdf->Cell(18,10,$fila2['fk_curso'],1,0,"C");
	$pdf->Cell(60,10,iconv("UTF-8","ISO-8859-1",$fila2['nombre_curso']),1,0,"C");

	//Día de la Semana
	$dia_sem;

	if ($fila2['dia_semana'] == 0) {
		$dia_sem = "L";
	} else {
		if ($fila2['dia_semana'] == 1) {
			$dia_sem = "K";
		} else {
			if ($fila2['dia_semana'] == 2) {
				$dia_sem = "M";
			} else {
				if ($fila2['dia_semana'] == 3) {
					$dia_sem = "J";
				} else {
					if ($fila2['dia_semana'] == 4) {
						$dia_sem = "V";
					} else {
						if ($fila2['dia_semana'] == 5) {
							$dia_sem = "S";
						} else {
							$dia_sem = "D";
						}
					}
				}
			}
		}
	}

	$pdf->Cell(12,10,$dia_sem,1,0,"C");
	$pdf->Cell(18,10,$fila2['hora_inicio'],1,0,"C");
	$pdf->Cell(18,10,$fila2['hora_fin'],1,0,"C");
	$sumaCredito = $sumaCredito + $fila2['creditos'];
	$pdf->Cell(27,10,$fila2['creditos'],1,0,"C");
	$pdf->Cell(13,10,$fila2['num_grupo'],1,0,"C");
	$suma = $suma + $fila2['jornada'];
	$convertidoGrupo = convertirDobleFraciones($fila2['jornada']);
	$pdf->Cell(22,10,$convertidoGrupo,1,0,"C");
	$pdf->Ln();

}

//////////////////////////Totales Grupo////////////////////////

$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(0, 193 , 0);
$pdf->Cell(18,7,iconv("UTF-8","ISO-8859-1","totales"),1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(136);
$pdf->Cell(27,7,iconv("UTF-8","ISO-8859-1","$sumaCredito"),1,0,"C");
$pdf->SetX(176);
$convertidoSuma = convertirDobleFraciones($suma);
$pdf->Cell(22,7,iconv("UTF-8","ISO-8859-1",$suma),1,0,"C");//SUMA POR MIENTRAS SE CONSIGUE CONVERTIR
$pdf->Ln();

$pdf->Output();
?>
