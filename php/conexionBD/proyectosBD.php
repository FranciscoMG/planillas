<?php include_once("conexionBD.php"); ?>

<?php
/**
*
*/
class proyectosBD extends conexionBD
{
	//---------------------------------------------------
	function __construct()
	{
		parent::__construct();
	}

	/////////////////////////////////////////////////////
	function agregarProyecto ($nombre_proyecto , $tipo_proyecto , $jornada_proyecto, $fk_encargado, $fk_ayudante)
	{
		$stmt = $this->con->prepare("INSERT INTO `tb_Proyectos` (`nombre_proyecto`, `tipo_proyecto`, `jornada_proyecto`, `fk_encargado`, `fk_ayudante`) VALUES (?, ?, ?, ?, ?);");
		if ($stmt === FALSE) {
			die("prepare fail");
		}

		$stmt->bind_param("sidss" , $nombre_proyecto , $tipo_proyecto , $jornada_proyecto, $fk_encargado, $fk_ayudante);
		return $stmt->execute();


		//Asignación Ternaria;
	}

	////////////////////////////////////////////////////
	function eliminarProyecto ($id_proyecto) {
		$stmt = $this->con->prepare("DELETE FROM tb_Proyectos WHERE id_proyecto = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('s' , $id_proyecto);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	////////////////////////////////////////////////////
	function existeProyecto ($id) {
		$query = "SELECT * FROM tb_Proyectos WHERE id_proyecto = '".$id."'";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////////
	function obtenerProyecto() {
		$query = "SELECT * FROM tb_Proyectos ORDER BY id_proyecto";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$stmt->close();
		return false;
	}

	////////////////////////////////////////////////////
	function modificarProyecto ($id_proyecto , $nombre_proyecto , $tipo_proyecto  , $fk_ayudante)
	{
		$stmt = $this->con->prepare("UPDATE `tb_Proyectos` SET `nombre_proyecto` = ?, `tipo_proyecto` = ? , `fk_ayudante` = ? WHERE `tb_Proyectos`.`id_proyecto` = ?;");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('sisi' ,  $nombre_proyecto , $tipo_proyecto , $fk_ayudante , $id_proyecto);
		return $stmt->execute();
	}
}
 ?>
