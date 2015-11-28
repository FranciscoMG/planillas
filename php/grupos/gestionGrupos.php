<?php session_start(); ?>
<?php
  include_once("../conexionBD/gruposBD.php");
  include_once("../conexionBD/docentesBD.php");
  include_once("../include/conversor.php");
?>
<?php
  $db = new gruposBD();
  $db2 = new docentesBD();
?>
<?php

$carrera= isset($_POST['cboIDCarrera'])?$_POST['cboIDCarrera']:"";
$curso= isset($_POST['cboIDCurso'])?$_POST['cboIDCurso']:"";
$num_grupo= isset($_POST['cboGrupo'])?$_POST['cboGrupo']:"";
$jornada= isset($_POST['cboJornada'])?$_POST['cboJornada']:"";
$docentes= array(
  array(),
);
for ($i=0; $i < 6; $i++) {
	if (isset($_POST['txtProfesor'.$i])) {
		$tmp= explode("-", $_POST['txtProfesor'.$i])[0];
		$nombre= trim(explode(" ", $tmp)[0]);
		$apellidos= trim(explode(" ", $tmp)[1]);
    if (!empty(trim(explode(" ", $tmp)[2]))) {
      $apellidos.=" ".trim(explode(" ", $tmp)[2]);
    }
    $resultado = $db2->obtenerDocentes();
    while ($fila = mysqli_fetch_assoc($resultado)) {
      if ($nombre == $fila['nombre'] && $apellidos == $fila['apellidos']) {
        $docentes[$i][0]= $fila['cedula'];
        $docentes[$i][1]= convertirFraccionesDoble(trim(explode("-", $_POST['txtProfesor'.$i])[1]));
      }
    }
	}
}
$horarioCurso= array(
  array(),
);
for ($i=0; $i < 6; $i++) {
	if (isset($_POST['txtHorario'.$i])) {
		$tmp= explode(" ", $_POST['txtHorario'.$i]);
    $diaSemana = array("L","K","M","J","V","S");
    for($dS=0;$dS< count($diaSemana);$dS++) {
      if(trim($tmp[0]) == $diaSemana[$dS]) {
        $horarioCurso[$i][0]= $dS;
      }
    }
    $horarioCurso[$i][1]= trim($tmp[1]);
    $horarioCurso[$i][2]= trim($tmp[3]);
	}
}

//////////////////// Llenar modal grupos ////////////////////

if (isset($_POST['btnModificar'])) {
  $seRealizo = $db->agregarGrupo($curso, $num_grupo, $docentes, $horarioCurso, convertirFraccionesDoble(trim($jornada)));
  if (!$seRealizo) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Grupo agregrado con éxito";
    header("Location: ../masterPage.php");
    exit();
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al agregar el grupo";
    header("Location: ../masterPage.php");
    exit();
  }
}

?>
