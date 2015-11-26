<?php session_start(); ?>
<?php
  //include_once("conexionBD/cursosBD.php");
  //include_once("conexionBD/gruposBD.php");
?>
<?php
  //$db = new cursosBD();
  //$db2 = new gruposBD();
?>
<?php

$carrera= isset($_POST['cboIDCarrera'])?$_POST['cboIDCarrera']:"";
$curso= isset($_POST['cboIDCurso'])?$_POST['cboIDCurso']:"";
$num_grupo= isset($_POST['cboGrupo'])?$_POST['cboGrupo']:"";
$docente= isset($_POST['cboIDDocente'])?$_POST['cboIDDocente']:"";
$tiempo_individual= isset($_POST['cboTiempoProfesor'])?$_POST['cboTiempoProfesor']:"";
$dia= isset($_POST['cboDiaSemana'])?$_POST['cboDiaSemana']:"";
$hora_inicio= isset($_POST['cboHoraInicio'])?$_POST['cboHoraInicio']:"";
$hora_fin= isset($_POST['cboHoraFin'])?$_POST['cboHoraFin']:"";
$jornada= isset($_POST['cboTiempo'])?$_POST['cboTiempo']:"";

//////////////////// Llenar modal grupos ////////////////////

if (isset($_POST['btnAgregarProfesor'])) {
	
}

?>
