<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class presupuestoDocenteBD extends conexionBD {

	//----------------------------------------
	function __construct()
    {
    	parent::__construct();
	}

	/////////////////////////////////////////////////////////
	function obtenerPresupuestoDocente($fk_id_presupuesto , $fk_docente)
	{
		$query = "SELECT * FROM `SIDOP`.`tb_PresupuestoDocente` ;";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}
	/////////////////////////////////////////////////////////
	function obtenerlistadoDePresupuestoDocente()
	{
		$query = "SELECT * FROM `tb_PresupuestoDocente` ;";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		//$this->cerrar();
		return false;
	}

	////////////////////////////////////////////////////////////
	function agregarPresupuestoDocente($fk_id_presupuesto , $fk_docente , $jornada , $idProyecto)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_PresupuestoDocente` (`fk_id_presupuesto`, `fk_docente`, `jornada` , `fk_proyecto`) VALUES (?, ?, ? , ?);");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('isdi', $fk_id_presupuesto , $fk_docente , $jornada , $idProyecto);
		

		return $stmt->execute(); //Asignación Ternaria
	}

	////////////////////////////////////////////////////////////////
	function borrarPresupuestoDocente($idProyecto)
	{
		$stmt = $this->con->prepare("DELETE FROM `tb_PresupuestoDocente` where fk_proyecto = '".$idProyecto."'");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('i', $idProyecto);
		return $stmt->execute();
	}
	
	/////////////////////////////////////////////////////////////////
	function modificarPresupuestoDocente($fk_id_presupuesto , $fk_docente , $jornada ,$idProyecto)
	{
		$stmt = $this->con->prepare("UPDATE `SIDOP`.`tb_PresupuestoDocente` SET `jornada` = ? WHERE `fk_id_presupuesto` = ? AND fk_docente = ? AND 	fk_proyecto = ?;");

		if ( $stmt === FALSE ) {
		  die(' MODIFICAR prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('disi', $jornada , $fk_id_presupuesto , $fk_docente , $idProyecto);
		return $stmt->execute();
	}
}


?>
