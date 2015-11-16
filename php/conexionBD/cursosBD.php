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
	function agregarCurso ($sigla , $nombre_curso , $creditos , $jornada) {
		$stmt = $this->con->prepare("INSERT INTO `tb_Cursos`(`sigla`, `nombre_curso`, `creditos`, `jornada`) VALUES (?, ?, ?, ?)");
		if ($stmt === FALSE) {
			die("prepare fail");
		}
		
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
	function modificarCurso ($sigla , $nombre_curso , $creditos , $jornada) {
		$stmt = $this->con->prepare("UPDATE tb_Cursos SET nombre_curso = ? , creditos = ? , jornada = ? WHERE sigla = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('sids' , $nombre_curso , $creditos , $jornada , $sigla);
		$stmt->execute();
		$stmt->close();
		return true;
	}
}
 ?>