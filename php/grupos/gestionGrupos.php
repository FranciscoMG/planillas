<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php 
$dbRegistroActividad = new registroActividadBD(); 
$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcionRegistroActividad = "";
?>

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
$jornada= isset($_POST['cboJornada'])?convertirFraccionesDoble(trim($_POST['cboJornada'])):"";
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

if (isset($_POST['btnRegistrar'])) {
  $seRealizo = $db->agregarGrupo($carrera, $curso, $num_grupo, $docentes, $horarioCurso, $jornada);
  if (!$seRealizo) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Grupo agregrado con éxito";

    ///// registro de actividad //////
    $descripcionRegistroActividad="Se agregó el grupo: ".$curso." - ".$num_grupo;
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    //////////////////////////////////

    header("Location: ../masterPage.php");
    exit();
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al agregar el grupo";
    header("Location: ../masterPage.php");
    exit();
  }
}

if (isset($_POST['btnModificar'])) {
  $seRealizo = $db->modificarGrupo($carrera, explode(" ", $curso)[0], explode(" ", $curso)[1], $docentes, $horarioCurso, $jornada);
  if ($seRealizo) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Grupo modificado con éxito";

    ///// registro de actividad //////
    $descripcionRegistroActividad="Se modificó el grupo: ";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    ////////////////////////////////

    header("Location: ../masterPage.php");
    exit();
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al modificar el grupo";
    header("Location: ../masterPage.php");
    exit();
  }
}

if (isset($_POST['btnEliminar'])) {
  if ($curso != "") {
    $seRealizo= $db->borrarGrupo($carrera, explode(" ", $curso)[0], explode(" ", $curso)[1]);
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "No se ha seleccionado ningún docente";
    header('Location: ../masterPage.php');
    exit();
  }
  if ($seRealizo) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Grupo borrado con éxito";

    ///// registro de actividad //////
    $descripcionRegistroActividad="Se eliminó el grupo: ";
        $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    /////////////////////////////////

  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al eliminar el grupo";
  }
  header('Location: ../masterPage.php');
  exit();
}

//////////////////// Llenar modal grupos //////////////
if (isset($_GET['id_carrera']) && isset($_GET['curso']) && isset($_GET['num_grupo'])) {
  $d= 0;
  $h= 0;
  $diaSemana = array("L","K","M","J","V","S");
  $resultado = $db->obtenerGrupos(FALSE);
  while ($fila = mysqli_fetch_assoc($resultado)) {
    if ($fila['fk_carrera'] == $_GET['id_carrera'] && $fila['fk_curso'] == $_GET['curso'] && $fila['num_grupo'] == $_GET['num_grupo']) {
      $carrera= $fila['fk_carrera'];
      $curso= $fila['fk_curso'];
      $num_grupo= $fila['num_grupo'];
      $docentes[$d][0]= $fila['nombre']." ".$fila['apellidos'];
      $docentes[$d][1]= convertirDobleFraciones($fila['tiempo_individual']);
      $d++;
      $horarioCurso[$h][0]= $diaSemana[$fila['dia_semana']];
      $horarioCurso[$h][1]= $fila['hora_inicio']." - ".$fila['hora_fin'];
      $h++;
    }
    $jornada= convertirDobleFraciones($fila['jornada']);
  }
  $docentes= array_values(array_unique($docentes, SORT_REGULAR));
  $horarioCurso= array_values(array_unique($horarioCurso, SORT_REGULAR));
  $docentes= serialize($docentes);
  $horarioCurso= serialize($horarioCurso);
  header("Location: ../masterPage.php?modalGrupos=2&id_carrera=".$carrera."&curso=".$curso."&num_grupo=".$num_grupo."&docentes=".$docentes."&horarios=".$horarioCurso."&jornada=".$jornada);
  exit();
}
?>
