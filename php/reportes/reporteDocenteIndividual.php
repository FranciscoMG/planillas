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
<?php include_once("../conexionBD/presupuestoBD.php"); ?>
<?php include_once("../conexionBD/proyectosBD.php"); ?>
<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>

<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>
<?php $dbProyectos = new proyectosBD(); ?>
<?php $db = new docentesBD(); ?>
<?php $resultadoDocente = $db->obtenerUnDocente($cedula); //SE INGRESA EL ID (CÉDULA)?>
<?php $db = new gruposBD(); ?>
<?php $dbPresupuestos = new presupuestoBD(); ?>
<?php $resultado = $db->llenarTabla(""); ?>


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
$existe = 0;
while ($fila = mysqli_fetch_assoc($resultadoDocente)) {
$pdf->Cell(77,10,iconv("UTF-8","ISO-8859-1",$fila['apellidos']." ".$fila['nombre']),1,0,"C");///CAMBIAR MÉTODO DEL NOMBRE
$pdf->Ln();
$pdf->Cell(25,10,iconv("UTF-8","ISO-8859-1","Cédula"),1,0,"C");
$pdf->Cell(27,10,"Grado Academico",1,0,"C");
$pdf->Cell(25,10,"Nombramiento",1,0,"C");

$pdf->Ln();

$pdf->SetFont('Arial','',8);



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

	$pdf->Ln();
}
$pdf->Ln();

//////////////Contenido Grupos/////////////
$pdf->Ln();
$paraAsignar = 0;
$realAsignado = 0;

$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,10,"Asignaciones / Grupos",1,0,"C");
$pdf->Ln();
$pdf->Cell(20,10,"Sigla/Curso",1,0,"C");
$pdf->Cell(75,10,"Nombre/Curso",1,0,"C");
$pdf->Cell(15,10,iconv("UTF-8","ISO-8859-1","Créditos"),1,0,"C");
$pdf->Cell(15,10,"Grupo",1,0,"C");
$pdf->Cell(35,10,"Presupuesto",1,0,"C");
$pdf->Cell(15,10,"Jornada",1,0,"C");
$pdf->Cell(15,10,"Asignado",1,0,"C");


$pdf->Ln();

$pdf->SetFont('Arial','',8);

while ($fila = mysqli_fetch_assoc($resultado)) {
	if ($cedula == $fila['fk_docente']) {
		$existe = 1;
		$pdf->Cell(20,10,$fila['fk_curso'],1,0,"C");
		$pdf->Cell(75,10,iconv("UTF-8","ISO-8859-1",$fila['nombre_curso']),1,0,"C");
		$sumaCredito = $sumaCredito + $fila['creditos'];
		$pdf->Cell(15,10,$fila['creditos'],1,0,"C");
		$pdf->Cell(15,10,$fila['num_grupo'],1,0,"C");

		// Presupuestos
		$nombre_presupuesto = "";
		$resultado3 = $dbPresupuestos->obtenerlistadoDePresupuesto();
		while ($fila3 = mysqli_fetch_assoc($resultado3)) {
			if ($fila['fk_presupuesto'] == $fila3['id_presupuesto']) {
				$nombre_presupuesto = $fila3['nombre_presupuesto'];
			}
		}
		if ($nombre_presupuesto == "") {
	  		$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1","NO ASIGNADO"),1,0,"C");
		} else {
	  		$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1",$nombre_presupuesto),1,0,"C");
	  	}
		/////
		$paraAsignar = ($paraAsignar + $fila['jornada']);
		$convertidoGrupo = convertirDobleFraciones($fila['jornada']);
		$pdf->Cell(15,10,$convertidoGrupo,1,0,"C");
		if ($nombre_presupuesto == "") {
			$pdf->SetTextColor(255,0,0);
			$pdf->SetFillColor(255, 255 , 255);
	  		$pdf->Cell(15,10,"Pendiente",1,0,"C",true);
	  		$pdf->SetTextColor(0,0,0);
		} else {
			$pdf->Cell(15,10,$convertidoGrupo,1,0,"C");
			$suma = ($suma + $fila['jornada']);
			$realAsignado = ($realAsignado + $suma);
	  	}
		$pdf->Ln();
	}
}
if ($existe == 0) {
	$pdf->Cell(190,10,iconv("UTF-8","ISO-8859-1","Este docente no ha sido asignado a ningún grupo."),1,0,"C");
	$pdf->Ln();
}
$existe = 0;
//////////// Proyectos ///////////////
$pdf->Ln();
$suma = 0;

$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,10,"Asignaciones / Proyectos",1,0,"C");
$pdf->Ln();

$resultado4 = $dbProyectos->obtenerProyecto();
		$pdf->Cell(90,10,"Nombre del Proyecto",1,0,"C");
		$pdf->Cell(35,10,"Tipo Proyecto",1,0,"C");
		$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1","Presupuesto"),1,0,"C");
		$pdf->Cell(15,10,"Jornada",1,0,"C");
		$pdf->Cell(15,10,"Asignado",1,0,"C");
		$pdf->Ln();
$pdf->SetFont('Arial','',8);
while ($fila4 = mysqli_fetch_assoc($resultado4)) {
	if ($fila4['fk_encargado'] == $cedula) {
		$existe = 1;
		$pdf->Cell(90,10,iconv("UTF-8","ISO-8859-1",$fila4['nombre_proyecto']),1,0,"C");
		/// tipo de proyecto //
		$tipoProyecto = $fila4['tipo_proyecto'];
		if ($tipoProyecto == 0) {
			$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1","Acción Social"),1,0,"C");
		} else {
			$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1","Investigación"),1,0,"C");
		}
		///// presupuesto /////
		$resultado5 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
		$nombre_presupuesto = "";
		while ($fila5 = mysqli_fetch_assoc($resultado5)) {
			if ($fila5['fk_docente'] == $cedula && $fila5['fk_proyecto'] == $fila4['id_proyecto']) {
				$resultado6 = $dbPresupuestos->obtenerlistadoDePresupuesto();
				while ($fila6 = mysqli_fetch_assoc($resultado6)) {
					if ($fila5['fk_id_presupuesto'] == $fila6['id_presupuesto']) {
						$nombre_presupuesto = $fila6['nombre_presupuesto'];
					}
				}
			}
		}
		if ($nombre_presupuesto == "") {
	  		$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1","NO ASIGNADO"),1,0,"C");
		} else {
	  		$pdf->Cell(35,10,iconv("UTF-8","ISO-8859-1",$nombre_presupuesto),1,0,"C");
	  	}
	  	$paraAsignar = ($paraAsignar + $fila4['jornada_proyecto']);

		$pdf->Cell(15,10,convertirDobleFraciones($fila4['jornada_proyecto']),1,0,"C");
		if ($nombre_presupuesto == "") {
	  		$pdf->Cell(15,10,"--",1,0,"C");
		} else {
			$suma = ($suma + $fila4['jornada_proyecto']);
			$realAsignado = ($realAsignado + $suma);
			$pdf->Cell(15,10,convertirDobleFraciones($fila4['jornada_proyecto']),1,0,"C");
	  	}
		$pdf->Ln();
	}
}
if ($existe == 0) {
	$pdf->Cell(190,10,iconv("UTF-8","ISO-8859-1","Este docente no ha sido asignado a ningún proyecto."),1,0,"C");
	$pdf->Ln();
}

///////////// total ////////////
$pdf->Ln();
$pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1",""),0,0,"C");
$pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1","Para asignar"),1,0,"C");
$pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1","Real asignado"),1,0,"C");
$pdf->Ln();


$pdf->Cell(25,7,iconv("UTF-8","ISO-8859-1","Totales"),1,0,"C");
$pdf->Cell(25,7,$paraAsignar,1,0,"C");
if ($contrato_tipo == "Propiedad") {
	$pdf->SetTextColor(255,0,0);
	$pdf->SetFillColor(255, 255 , 255);
	$pdf->Cell(25,7,$realAsignado,1,0,"C",true);
	$pdf->SetTextColor(0,0,0);
} else {
	$pdf->Cell(25,7,$realAsignado,1,0,"C");
}


$pdf->Output();
?>
