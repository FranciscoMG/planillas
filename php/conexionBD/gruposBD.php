<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class gruposBD extends conexionBD {
	function __construct() {
    	parent::__construct();
	}

	function agregarGrupo($carrera, $curso, $num_grupo, $num_grupo_doble, $docentes, $docentesDoble, $horarios, $horariosDoble, $jornada) {
		for ($i=0; $i < count($docentes); $i++) {
			$this->agregarGrupoDocentes($carrera, $curso, $num_grupo, $docentes[$i][0], $docentes[$i][1]);
		}
		for ($i=0; $i < count($horarios); $i++) {
			$this->agregarGrupoHorarios($carrera, $curso, $num_grupo, $horarios[$i][0], $horarios[$i][1], $horarios[$i][2]);
		}
		if ($num_grupo_doble != 0) {
			for ($i=0; $i < count($docentesDoble); $i++) {
				$this->agregarGrupoDocentes($carrera, $curso, $num_grupo_doble, $docentesDoble[$i][0], $docentesDoble[$i][1]);
			}
			for ($i=0; $i < count($horariosDoble); $i++) {
				$this->agregarGrupoHorarios($carrera, $curso, $num_grupo_doble, $horariosDoble[$i][0], $horariosDoble[$i][1], $horariosDoble[$i][2]);
			}
		}

		$stmt = $this->con->prepare("INSERT INTO tb_Grupos VALUES (?, ?, ?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('ssiid', $carrera, $curso, $num_grupo, $num_grupo_doble, $jornada);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarGrupoDocentes($carrera, $curso, $num_grupo, $docente, $tiempo_individual) {
		$tmp= 1;
		$stmt = $this->con->prepare("INSERT INTO tb_GruposDocentes VALUES (?, ?, ?, ?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('ssisdi', $carrera, $curso, $num_grupo, $docente, $tiempo_individual, $tmp);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarGrupoHorarios($carrera, $curso, $num_grupo, $diaSemana, $horaInicio, $horaFin) {
		$stmt = $this->con->prepare("INSERT INTO tb_GruposHorarios VALUES (?, ?, ?, ?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('ssiiss', $carrera, $curso, $num_grupo, $diaSemana, $horaInicio, $horaFin);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarPresupGrupo($carrera, $curso, $num_grupo, $presupuesto) {
		$stmt = $this->con->prepare("UPDATE tb_GruposDocentes SET fk_presupuesto = ? WHERE fk_carrera = ? AND fk_curso = ? AND num_grupo = ?;");
		if ( $stmt === FALSE ) {
			die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('issi', $presupuesto, $carrera, $curso, $num_grupo);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function obtenerGrupos($mostrarDistinto) {
		$query= "SELECT gr.fk_carrera, gr.fk_curso, cu.nombre_curso, gr.num_grupo, gr.num_grupo_doble, CASE WHEN (gr.num_grupo = gd.num_grupo AND gr.num_grupo = gh.num_grupo) = true THEN false ELSE true END profesorDoble, gd.fk_docente, do.nombre, do.apellidos, gd.tiempo_individual, gh.dia_semana, gh.hora_inicio, gh.hora_fin, gr.jornada, gd.fk_presupuesto FROM tb_Grupos gr, tb_Cursos cu, tb_GruposDocentes gd, tb_Docente do, tb_GruposHorarios gh WHERE gr.fk_curso != '1' AND (gr.fk_carrera = gd.fk_carrera AND gr.fk_carrera = gh.fk_carrera) AND (gr.fk_curso = gd.fk_curso AND gr.fk_curso = gh.fk_curso) AND ((gr.num_grupo = gd.num_grupo AND gr.num_grupo = gh.num_grupo) OR (gr.num_grupo_doble = gd.num_grupo AND gr.num_grupo_doble = gh.num_grupo)) AND gr.fk_curso = cu.sigla AND gd.fk_docente = do.cedula GROUP BY gr.fk_carrera, fk_curso, gr.num_grupo, gr.num_grupo_doble";
		if ($mostrarDistinto) {
			$query.= ";";
		} else {
			$query.= ", profesorDoble, gd.fk_docente, gh.dia_semana;";
		}

		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function modificarGrupo($carrera, $curso, $num_grupo, $num_grupo_doble, $docentes, $docentesDoble, $horarios, $horariosDoble, $jornada) {
		$this->borrarGrupoDocentes($carrera, $curso, $num_grupo);
		$this->borrarGrupoHorario($carrera, $curso, $num_grupo);
		for ($i=0; $i < count($docentes); $i++) {
			$this->agregarGrupoDocentes($carrera, $curso, $num_grupo, $docentes[$i][0], $docentes[$i][1]);
		}
		for ($i=0; $i < count($horarios); $i++) {
			$this->agregarGrupoHorarios($carrera, $curso, $num_grupo, $horarios[$i][0], $horarios[$i][1], $horarios[$i][2]);
		}
		if ($num_grupo_doble != 0) {
			$this->borrarGrupoDocentes($carrera, $curso, $num_grupo_doble);
			$this->borrarGrupoHorario($carrera, $curso, $num_grupo_doble);
			for ($i=0; $i < count($docentesDoble); $i++) {
				$this->agregarGrupoDocentes($carrera, $curso, $num_grupo_doble, $docentesDoble[$i][0], $docentesDoble[$i][1]);
			}
			for ($i=0; $i < count($horariosDoble); $i++) {
				$this->agregarGrupoHorarios($carrera, $curso, $num_grupo_doble, $horariosDoble[$i][0], $horariosDoble[$i][1], $horariosDoble[$i][2]);
			}
		}

		$stmt = $this->con->prepare("UPDATE tb_Grupos SET jornada = ? WHERE fk_carrera = ? AND fk_curso = ? AND num_grupo = ? AND num_grupo_doble = ?;");

		if ( $stmt === FALSE ) {
		  return false;
		}
		$stmt->bind_param('dssii', $jornada, $carrera, $curso, $num_grupo, $num_grupo_doble);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	function borrarGrupo($carrera, $curso, $num_grupo, $num_grupo_doble) {
		$this->borrarGrupoDocentes($carrera, $curso, $num_grupo);
		$this->borrarGrupoHorario($carrera, $curso, $num_grupo);
		if ($num_grupo_doble != 0) {
			$this->borrarGrupoDocentes($carrera, $curso, $num_grupo_doble);
			$this->borrarGrupoHorario($carrera, $curso, $num_grupo_doble);
		}

		$stmt = $this->con->prepare("DELETE FROM tb_Grupos WHERE fk_carrera = ? AND fk_curso = ? AND num_grupo = ?;");
		if ( $stmt === FALSE ) {
			die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('ssi', $carrera, $curso, $num_grupo);
		return $stmt->execute();
	}

	function borrarGrupoDocentes($carrera, $curso, $num_grupo) {
		$stmt = $this->con->prepare("DELETE FROM tb_GruposDocentes WHERE fk_carrera = ? AND fk_curso = ? AND num_grupo = ?;");
		if ( $stmt === FALSE ) {
			die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('ssi', $carrera, $curso, $num_grupo);
		return $stmt->execute();
	}

	function obtenerGrupoDocentes() {
		$query= "SELECT * FROM tb_GruposDocentes";

		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function borrarGrupoHorario($carrera, $curso, $num_grupo) {
		$stmt = $this->con->prepare("DELETE FROM tb_GruposHorarios WHERE fk_carrera = ? AND fk_curso = ? AND num_grupo = ?;");
		if ( $stmt === FALSE ) {
			die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('ssi', $carrera, $curso, $num_grupo);
		return $stmt->execute();
	}

	function borrarPresupGrupo($carrera, $curso, $num_grupo, $presupuesto) {
		$stmt = $this->con->prepare("UPDATE tb_GruposDocentes SET fk_presupuesto = ? WHERE fk_carrera = ? AND fk_curso = ? AND num_grupo = ?;");
		if ( $stmt === FALSE ) {
			die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('issi', $presupuesto, $carrera, $curso, $num_grupo);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function llenarTabla($id_carrera){
		if ($id_carrera == "" || $id_carrera == "all") {

		$query= "SELECT gr.fk_carrera, ca.nombre_carrera, gr.fk_curso, cu.nombre_curso, cu.creditos, gr.num_grupo, gr.num_grupo_doble, CASE WHEN (gr.num_grupo = gd.num_grupo AND gr.num_grupo = gh.num_grupo) = true THEN false ELSE true END profesorDoble, gd.fk_docente, do.nombre, do.apellidos, gd.tiempo_individual, gd.fk_presupuesto, pr.nombre_presupuesto, gh.dia_semana, gh.hora_inicio, gh.hora_fin, gr.jornada FROM tb_Grupos gr, tb_Carrera ca, tb_Cursos cu, tb_Docente do, tb_GruposHorarios gh,tb_GruposDocentes gd LEFT JOIN tb_Presupuesto pr ON gd.fk_presupuesto = pr.id_presupuesto WHERE gr.fk_curso != '1' AND (gr.fk_carrera = gd.fk_carrera AND gr.fk_carrera = gh.fk_carrera) AND (gr.fk_curso = gd.fk_curso AND gr.fk_curso = gh.fk_curso) AND ((gr.num_grupo = gd.num_grupo AND gr.num_grupo = gh.num_grupo) OR (gr.num_grupo_doble = gd.num_grupo AND gr.num_grupo_doble = gh.num_grupo)) AND gr.fk_curso = cu.sigla AND gd.fk_docente = do.cedula GROUP BY gr.fk_carrera, fk_curso, gr.num_grupo, gr.num_grupo_doble, profesorDoble, gd.fk_docente, gh.dia_semana;";
		} else {
			$query= "SELECT gr.fk_carrera, ca.nombre_carrera, gr.fk_curso, cu.nombre_curso, cu.creditos, gr.num_grupo, gr.num_grupo_doble, CASE WHEN (gr.num_grupo = gd.num_grupo AND gr.num_grupo = gh.num_grupo) = true THEN false ELSE true END profesorDoble, gd.fk_docente, do.nombre, do.apellidos, gd.tiempo_individual, gd.fk_presupuesto, pr.nombre_presupuesto, gh.dia_semana, gh.hora_inicio, gh.hora_fin, gr.jornada FROM tb_Grupos gr, tb_Carrera ca, tb_Cursos cu, tb_Docente do, tb_GruposHorarios gh,tb_GruposDocentes gd LEFT JOIN tb_Presupuesto pr ON gd.fk_presupuesto = pr.id_presupuesto WHERE gr.fk_curso != '1' AND (".$id_carrera." = gd.fk_carrera AND ".$id_carrera." = gh.fk_carrera) AND (gr.fk_curso = gd.fk_curso AND gr.fk_curso = gh.fk_curso) AND ((gr.num_grupo = gd.num_grupo AND gr.num_grupo = gh.num_grupo) OR (gr.num_grupo_doble = gd.num_grupo AND gr.num_grupo_doble = gh.num_grupo)) AND gr.fk_curso = cu.sigla AND gd.fk_docente = do.cedula GROUP BY gr.fk_carrera, fk_curso, gr.num_grupo, gr.num_grupo_doble, profesorDoble, gd.fk_docente, gh.dia_semana;";
		}

		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}
}
?>
