<?php session_start(); ?>
<?php
  include_once("../conexionBD/gruposBD.php");
  include_once("../conexionBD/docentesBD.php");
?>
<?php
  $db = new gruposBD();
  $db2 = new docentesBD();
?>
<?php

$carrera= isset($_POST['cboIDCarrera'])?$_POST['cboIDCarrera']:"";
$curso= isset($_POST['cboIDCurso'])?$_POST['cboIDCurso']:"";
$num_grupo= isset($_POST['cboGrupo'])?$_POST['cboGrupo']:"";
$jornada= isset($_POST['cboTiempo'])?$_POST['cboTiempo']:"";
$docentes= array(
  array(),
);
for ($i=0; $i < 6; $i++) {
	if (isset($_POST['txtProfesor'.$i])) {
		$tmp= explode("-", $_POST['txtProfesor'.$i])[0];
		$nombre= explode(" ", $tmp)[0];
		$apellidos= explode(" ", $tmp)[1].explode(" ", $tmp)[2];
    $resultado = $db2->obtenerDocentes();
    while ($fila = mysqli_fetch_assoc($resultado)) {
      if ($nombre == $fila['nombre'] && $apellidos == $fila['apellidos']) {
        $docentes[$i][0]= $fila['cedula'];
        $docentes[$i][1]= explode("-", $_POST['txtProfesor'.$i])[1];
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
    $horarioCurso[$i][0]= $tmp[0];
    $horarioCurso[$i][1]= $tmp[1];
    $horarioCurso[$i][2]= $tmp[3];
	}
}

//////////////////// Llenar modal grupos ////////////////////

if (isset($_POST['btnModificar'])) {
  $seRealizo = $db->agregarGrupo($curso, $num_grupo, $docentes, $horarioCurso, $jornada);
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
