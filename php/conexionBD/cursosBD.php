<?php include_once("conexionBD.php"); ?>

<?php
/**
*
*/
class cursosBD extends conexionBD
{
	//---------------------------------------------------
	function __construct()
	{
		parent::__construct();
	}

	/////////////////////////////////////////////////////
	function agregarCurso ($sigla , $nombre_curso , $creditos , $jornada , $fk_carrera) {
		$stmt = $this->con->prepare("INSERT INTO `tb_Cursos`(`sigla`, `nombre_curso`, `creditos`, `jornada` , `fk_carrera`) VALUES (?, ?, ?, ? , ?)");
		if ($stmt === FALSE) {
			die("prepare fail");
		}

		$stmt->bind_param("ssids" , $sigla , $nombre_curso , $creditos , $jornada , $fk_carrera);
		return $stmt->execute();


		//Asignación Ternaria;
	}

	////////////////////////////////////////////////////
	function eliminarCurso ($sigla) {
		$stmt = $this->con->prepare("DELETE FROM tb_Cursos WHERE sigla = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

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
		$query = "SELECT fk_carrera, sigla, nombre_curso FROM tb_PlanEstudios, tb_Cursos WHERE fk_curso=sigla ORDER BY fk_carrera;";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0) {
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////////
	function modificarCurso ($sigla , $nombre_curso , $creditos , $jornada , $fk_carrera) {
		$stmt = $this->con->prepare("UPDATE tb_Cursos SET nombre_curso = ? , creditos = ? , jornada = ? , fk_carrera = ? WHERE sigla = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('sidss' , $nombre_curso , $creditos , $jornada , $fk_carrera , $sigla);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	////////////////////////////////////////////////////
	function obtenerCarreras() {
		$query = "SELECT * FROM tb_Carrera ORDER BY nombre_Carrera";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}
}
 ?>
