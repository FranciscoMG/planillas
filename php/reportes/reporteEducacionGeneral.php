<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>

<?php require('../../fpdf17/fpdf.php'); ?>
<?php include_once("../conexionBD/cursosBD.php"); ?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>
<?php $dbCursos = new cursosBD(); ?>

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

$resultado = $dbCursos->obtenerCarreras();
while ($fila = mysqli_fetch_assoc($resultado)) {
  $existe = 0;
  if ($fila['id_carrera'] != 1) {
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFillColor(220, 220 , 220);
    $pdf->Cell(275,8,iconv("UTF-8","ISO-8859-1",$fila['nombre_carrera']),1,0,"C",true);
    $pdf->Ln();
    $pdf->Cell(20,10,"Sigla",1,0,"C");
    $pdf->Cell(70,10,"Nombre",1,0,"C");
    $pdf->Cell(15,10,"Jornada",1,0,"C");
    $pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","Créditos"),1,0,"C");
    $pdf->Cell(15,10,"Grupo",1,0,"C");
    $pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","Día"),1,0,"C");
    $pdf->Cell(25,10,"Hora Inicio",1,0,"C");
    $pdf->Cell(25,10,"Hora Fin",1,0,"C");
    $pdf->Cell(50,10,"Nombre/Docente",1,0,"C");
    $pdf->Cell(25,10,"Presupuesto",1,0,"C");
    $pdf->Ln();

    $resultado1 = $dbGrupos->llenarTabla($fila['id_carrera']);
    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
    if ($fila1['fk_carrera'] == $fila['id_carrera']) {
      $existe = 1;
      $pdf->SetFont('Arial','',8);
        $pdf->Cell(20,7,$fila1['fk_curso'],1,0,"C");
        $pdf->Cell(70,7,iconv("UTF-8","ISO-8859-1",$fila1['nombre_curso']),1,0,"C");
        $pdf->Cell(15,7,$fila1['jornada'],1,0,"C");
        $pdf->Cell(15,7,$fila1['creditos'],1,0,"C");
        //// si es doble
        if ($fila1['profesorDoble'] == 1) {
          $pdf->Cell(15,7,$fila1['num_grupo_doble'],1,0,"C");
        } else {
          $pdf->Cell(15,7,$fila1['num_grupo'],1,0,"C");
        }
        ////
        $diaS = "";
        $dia = $fila1['dia_semana'];
        if ($dia == 0) {
          $diaS = "L";
        } elseif ($dia == 1) {
          $diaS = "K";
        } elseif ($dia == 2) {
          $diaS = "M";
        }elseif ($dia == 3) {
          $diaS = "J";
        } elseif ($dia == 4) {
          $diaS = "v";
        }elseif ($dia == 5) {
          $diaS = "S";
        }
        $pdf->Cell(15,7,$diaS,1,0,"C");
        $pdf->Cell(25,7,$fila1['hora_inicio'],1,0,"C");
        $pdf->Cell(25,7,$fila1['hora_fin'],1,0,"C");
        $pdf->Cell(50,7,iconv("UTF-8","ISO-8859-1",$fila1['apellidos']." ".$fila1['nombre']),1,0,"C");
        if ($fila1['nombre_presupuesto'] == "1") {
          $pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1","No asignado"),1,0,"C");
        } else {
          $pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1",$fila1['nombre_presupuesto']),1,0,"C");
      }
        $pdf->Ln();

      }
    }
    if ($existe == 0) {
        $pdf->Cell(275,7,iconv("UTF-8","ISO-8859-1","No se han ingresado grupos a esta carrera"),1,0,"C");
    }
    $pdf->Ln();
    $pdf->Ln();
    $resultado1 = null;
    $dbGrupos = new gruposBD();
  }
} /// fin de while general

$pdf->Output();
?>
