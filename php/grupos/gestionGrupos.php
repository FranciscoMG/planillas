<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php include_once("../include/funciones.php"); ?>
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
$esDoble= isset($_POST['chbGrupoDoble'])?TRUE:FALSE;
$jornada= isset($_POST['txtJornada'])?$_POST['txtJornada']:"";
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
        if((verificarTiemposDocente($fila['cedula']) + convertirFraccionesDoble(trim(explode("-", $_POST['txtProfesor'.$i])[1]))) > 1) {
          $_SESSION['alerta'] = 1;
          $_SESSION['alerta-contenido'] = "El docente ".$fila['nombre']." ".$fila['apellidos']." se excede de su tiempo";
          header("Location: ../masterPage.php");
          exit();
        }
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
    $horarioCurso[$i][0]= convertirDiaSemanaInt(trim($tmp[0]));
    $horarioCurso[$i][1]= trim($tmp[1]);
    $horarioCurso[$i][2]= trim($tmp[3]);
	}
}
$num_grupo_doble= isset($_POST['cboGrupoDoble'])?$_POST['cboGrupoDoble']:"";
$docentesDoble= array(
  array(),
);
for ($i=0; $i < 6; $i++) {
	if (isset($_POST['txtProfesorDoble'.$i])) {
		$tmp= explode("-", $_POST['txtProfesorDoble'.$i])[0];
		$nombre= trim(explode(" ", $tmp)[0]);
		$apellidos= trim(explode(" ", $tmp)[1]);
    if (!empty(trim(explode(" ", $tmp)[2]))) {
      $apellidos.=" ".trim(explode(" ", $tmp)[2]);
    }
    $resultado = $db2->obtenerDocentes();
    while ($fila = mysqli_fetch_assoc($resultado)) {
      if ($nombre == $fila['nombre'] && $apellidos == $fila['apellidos']) {
        if((verificarTiemposDocente($fila['cedula']) + convertirFraccionesDoble(trim(explode("-", $_POST['txtProfesorDoble'.$i])[1]))) > 1) {
          $_SESSION['alerta'] = 1;
          $_SESSION['alerta-contenido'] = "El docente ".$fila['nombre']." ".$fila['apellidos']." se excede de su tiempo";
          header("Location: ../masterPage.php");
          exit();
        }
        $docentesDoble[$i][0]= $fila['cedula'];
        $docentesDoble[$i][1]= convertirFraccionesDoble(trim(explode("-", $_POST['txtProfesorDoble'.$i])[1]));
      }
    }
	}
}
$horarioCursoDoble= array(
  array(),
);
for ($i=0; $i < 6; $i++) {
	if (isset($_POST['txtHorarioDoble'.$i])) {
		$tmp= explode(" ", $_POST['txtHorarioDoble'.$i]);
    $horarioCursoDoble[$i][0]= convertirDiaSemanaInt(trim($tmp[0]));
    $horarioCursoDoble[$i][1]= trim($tmp[1]);
    $horarioCursoDoble[$i][2]= trim($tmp[3]);
	}
}

if (isset($_POST['btnRegistrar'])) {
  if ($carrera != "0" && $curso != "0" && $num_grupo != "0" && count($docentes[0]) > 1 && count($horarioCurso[0]) > 1) {
    if ($esDoble && !($num_grupo_doble !="0" && count($docentesDoble[0]) > 1 && count($horarioCursoDoble[0]) > 1)) {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Debe llenar todos los campos para agregar un grupo doble";
      header("Location: ../masterPage.php");
      exit();
    }
    $resultado = $db->obtenerGrupos(true);
    while ($fila = mysqli_fetch_assoc($resultado)) {
      if ($fila['fk_carrera'] == $carrera && $fila['fk_curso'] == $curso && $fila['num_grupo'] == $num_grupo) {
        $_SESSION['alerta'] = 1;
        $_SESSION['alerta-contenido'] = "El grupo que intenta agregar ya existe";
        header('Location: ../masterPage.php');
        exit();
      }
    }
    $seRealizo = $db->agregarGrupo($carrera, $curso, $num_grupo, $num_grupo_doble, $docentes, $docentesDoble, $horarioCurso, $horarioCursoDoble, $jornada);
    if (!$seRealizo) {
      $_SESSION['alerta'] = 2;
      $_SESSION['alerta-contenido'] = "Grupo agregrado con éxito";
      unset($docentes, $horarioCurso, $docentesDoble, $horarioCursoDoble);

      ///// registro de actividad //////
      $descripcionRegistroActividad="Se agregó el grupo: ".$curso." - G".$num_grupo;
      if ($num_grupo_doble != 0) {
        $descripcionRegistroActividad.=" y G".$num_grupo_doble;
      }
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
      //////////////////////////////////

      header("Location: ../masterPage.php");
      exit();
    } else {
      $_SESSION['alerta'] = 3;
      $_SESSION['alerta-contenido'] = "Ocurrió un error al agregar el grupo";
      header("Location: ../masterPage.php");
      exit();
    }
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Debe llenar todos los campos para agregar un grupo";
    header("Location: ../masterPage.php");
    exit();
  }
}

if (isset($_POST['btnModificar'])) {
  if ($carrera != "0" && $curso != "0" && count($docentes[0]) > 1 && count($horarioCurso[0]) > 1) {
    if ($esDoble && !(count($docentesDoble[0]) > 1 && count($horarioCursoDoble[0]) > 1)) {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "Debe llenar todos los campos para modificar un grupo doble";
      header("Location: ../masterPage.php");
      exit();
    }
    $seRealizo = $db->modificarGrupo($carrera, explode(" ", $curso)[0], explode(" ", $curso)[1], explode(" ", $curso)[2], $docentes, $docentesDoble, $horarioCurso, $horarioCursoDoble, $jornada);
    if ($seRealizo) {
      $_SESSION['alerta'] = 2;
      $_SESSION['alerta-contenido'] = "Grupo modificado con éxito";

      ///// registro de actividad //////
      $descripcionRegistroActividad="Se modificó el grupo: ".explode(" ", $curso)[0]." - G".explode(" ", $curso)[1];
      if (explode(" ", $curso)[2] != "0") {
        $descripcionRegistroActividad.=" y G".explode(" ", $curso)[2];
      }
      $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
      ////////////////////////////////

      header("Location: ../masterPage.php");
      exit();
    } else {
      $_SESSION['alerta'] = 3;
      $_SESSION['alerta-contenido'] = "Ocurrió un error al modificar el grupo";
      header("Location: ../masterPage.php");
      exit();
    }
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Debe llenar todos los campos para modificar un grupo";
    header("Location: ../masterPage.php");
    exit();
  }
}

if (isset($_POST['btnEliminar'])) {
  if ($carrera != "0" && $curso != "0") {
    if (explode(" ", $curso)[3] == 1) {
      $seRealizo= $db->borrarGrupo($carrera, explode(" ", $curso)[0], explode(" ", $curso)[1], explode(" ", $curso)[2]);
    } else {
      $_SESSION['alerta'] = 1;
      $_SESSION['alerta-contenido'] = "No se puede eliminar un grupo que ya tiene un presupuesto";
      header('Location: ../masterPage.php');
      exit();
    }
  } else {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "No se ha seleccionado ninguna carrera o grupo";
    header('Location: ../masterPage.php');
    exit();
  }
  if ($seRealizo) {
    $_SESSION['alerta'] = 2;
    $_SESSION['alerta-contenido'] = "Grupo borrado con éxito";

    ///// registro de actividad //////
    $descripcionRegistroActividad="Se eliminó el grupo: ".explode(" ", $curso)[0]." - G".explode(" ", $curso)[1];
    if (explode(" ", $curso)[2] != "0") {
      $descripcionRegistroActividad.=" y G".explode(" ", $curso)[2];
    }
    $dbRegistroActividad->agregarRegistroActividad($utc, $fecha , $usuario , $descripcionRegistroActividad);
    /////////////////////////////////

  } else {
    $_SESSION['alerta'] = 3;
    $_SESSION['alerta-contenido'] = "Ocurrió un error al eliminar el grupo";
  }
  header('Location: ../masterPage.php');
  exit();
}

//////////////////// Llenar modal grupos //////////////
if (isset($_GET['id_carrera']) && isset($_GET['curso']) && isset($_GET['num_grupo']) && isset($_GET['num_grupo_doble'])) {
  $d= 0;
  $h= 0;
  $dD= 0;
  $hD= 0;
  unset($docentes, $horarioCurso, $docentesDoble, $horarioCursoDoble);
  $resultado = $db->obtenerGrupos(FALSE);
  while ($fila = mysqli_fetch_assoc($resultado)) {
    if ($fila['fk_carrera'] == $_GET['id_carrera'] && $fila['fk_curso'] == $_GET['curso'] && $fila['num_grupo'] == $_GET['num_grupo'] && $fila['num_grupo_doble'] == $_GET['num_grupo_doble']) {
      $carrera= $fila['fk_carrera'];
      $curso= $fila['fk_curso'];
      $num_grupo= $fila['num_grupo'];
      $num_grupo_doble= $fila['num_grupo_doble'];
      $id_presupuesto= $fila['fk_presupuesto'];
      if ($fila['profesorDoble']) {
        $docentesDoble[$dD][0]= $fila['nombre']." ".$fila['apellidos'];
        $docentesDoble[$dD][1]= convertirDobleFraciones($fila['tiempo_individual']);
        $dD++;
        $horarioCursoDoble[$hD][0]= convertirIntDiaSemana($fila['dia_semana']);
        $horarioCursoDoble[$hD][1]= $fila['hora_inicio']." - ".$fila['hora_fin'];
        $hD++;
      } else {
        $docentes[$d][0]= $fila['nombre']." ".$fila['apellidos'];
        $docentes[$d][1]= convertirDobleFraciones($fila['tiempo_individual']);
        $d++;
        $horarioCurso[$h][0]= convertirIntDiaSemana($fila['dia_semana']);
        $horarioCurso[$h][1]= $fila['hora_inicio']." - ".$fila['hora_fin'];
        $h++;
      }
      $jornada= $fila['jornada'];
    }
  }
  $docentes= array_values(array_unique($docentes, SORT_REGULAR));
  $horarioCurso= array_values(array_unique($horarioCurso, SORT_REGULAR));
  $docentes= serialize($docentes);
  $horarioCurso= serialize($horarioCurso);
  $docentesDoble= array_values(array_unique($docentesDoble, SORT_REGULAR));
  $horarioCursoDoble= array_values(array_unique($horarioCursoDoble, SORT_REGULAR));
  $docentesDoble= serialize($docentesDoble);
  $horarioCursoDoble= serialize($horarioCursoDoble);
  if ($id_presupuesto != 1) {
    $_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "No se puede modificar un grupo que ya tiene un presupuesto";
    header('Location: ../masterPage.php');
    exit();
  }
  header("Location: ../masterPage.php?modalGrupos=2&id_carrera=".$carrera."&curso=".$curso."&num_grupo=".$num_grupo."&num_grupo_doble=".$num_grupo_doble."&docentes=".$docentes."&docentesDoble=".$docentesDoble."&horarios=".$horarioCurso."&horariosDoble=".$horarioCursoDoble."&jornada=".$jornada);
  exit();
}
?>
