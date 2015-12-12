<?php include_once("conexionBD.php"); ?>

<?php
class cursosBD extends conexionBD
{
	//---------------------------------------------------
	function __construct()
	{
		parent::__construct();
	}

	/////////////////////////////////////////////////////
	function agregarCurso ($sigla , $nombre_curso , $creditos , $jornada , $fk_carrera) {
		$stmt = $this->con->prepare("INSERT INTO `tb_Cursos`(`sigla`, `nombre_curso`, `creditos`, `jornada`) VALUES (?, ?, ?, ? )");
		if ($stmt === FALSE) {
			die("prepare fail");
		}

		$this->agregarCarreraPlanEstudio($fk_carrera , $sigla);

		$stmt->bind_param("ssid" , $sigla , $nombre_curso , $creditos , $jornada);
		return $stmt->execute();


		//Asignación Ternaria;
	}

	////////////////////////////////////////////////////
	function eliminarCurso ($sigla) {
		$stmt = $this->con->prepare("DELETE FROM tb_Cursos WHERE sigla = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$this->eliminarCarreraPlanEstudio($sigla);

		$stmt->bind_param('s' , $sigla);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	////////////////////////////////////////////////////
	function existeCurso ($id) {
		$query = "SELECT * FROM tb_Cursos WHERE sigla = '".$id."'";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////////
	function obtenerCursos() {
		$query = "SELECT * FROM tb_Cursos ORDER BY sigla";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////////
	function obtenerCursosCarrera() {
		$query = "SELECT fk_carrera, fk_curso, nombre_curso, id_carrera, jornada FROM tb_PlanEstudios, tb_Cursos, tb_Carrera WHERE fk_carrera=id_carrera AND fk_curso=sigla ORDER BY fk_carrera;";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0) {
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////////
	function modificarCurso ($sigla , $nombre_curso , $creditos , $jornada , $fk_carrera) {
		$stmt = $this->con->prepare("UPDATE tb_Cursos SET nombre_curso = ? , creditos = ? , jornada = ?  WHERE sigla = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$this-> modificarCarreraPlanEstudio($sigla , $fk_carrera);

		$stmt->bind_param('sids' , $nombre_curso , $creditos , $jornada , $sigla);
		$stmt->execute();
		$stmt->close();
		return true;
	}
	////////////////////////////////////////////////////
	////////////////////////////////////////////////////
	function obtenerCarreras() {
		$query = "SELECT * FROM tb_Carrera ORDER BY nombre_carrera";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	//////////////////////////////////////////
	function obtenerCarrerasPlanEstudio() {
		$query = "SELECT * FROM tb_PlanEstudios";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////
	function agregarCarreraPlanEstudio($fk_carrera , $sigla) {
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_PlanEstudios` (`fk_carrera`, `fk_curso`) VALUES (?, ?);");
		if ($stmt === FALSE) {
			die("prepare fail agregarCarreraPlanEstudio()");
		}

		$stmt->bind_param("ss", $fk_carrera , $sigla );
		return $stmt->execute();
	}

	////////////////////////////////////////////////
	function eliminarCarreraPlanEstudio($sigla) {
		$stmt = $this->con->prepare("DELETE FROM tb_PlanEstudios WHERE fk_curso = ? ;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('s', $sigla);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	/////////////////////////////////////////////////
	function modificarCarreraPlanEstudio($sigla , $fk_carrera) {
		$stmt = $this->con->prepare("UPDATE tb_PlanEstudios SET fk_carrera = ?  WHERE fk_curso = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('is' ,$fk_carrera , $sigla);
		$stmt->execute();
		$stmt->close();
		return true;
	}
}
 ?>
