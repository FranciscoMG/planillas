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
	function agregarPresupuestoDocente($fk_id_presupuesto , $fk_docente , $jornada)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_PresupuestoDocente` (`fk_id_presupuesto`, `fk_docente`, `jornada`) VALUES (?, ?, ?);");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('isd', $fk_id_presupuesto , $fk_docente , $jornada);
		$stmt->execute();
		//$newId = $stmt->insert_id;
		$stmt->close();

		return true; //Asignación Ternaria
	}

	////////////////////////////////////////////////////////////////
	function borrarPresupuestoDocente($fk_id_presupuesto , $fk_docente)
	{
		$stmt = $this->con->prepare("DELETE FROM `tb_PresupuestoDocente` where fk_id_presupuesto = ? AND fk_docente = ?");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('is', $fk_id_presupuesto , $fk_docente);
		return $stmt->execute();
	}
	
	/////////////////////////////////////////////////////////////////
	function modificarPresupuestoDocente($fk_id_presupuesto , $fk_docente , $jornada)
	{
		$stmt = $this->con->prepare("UPDATE `SIDOP`.`tb_PresupuestoDocente` SET `jornada` = ? WHERE `fk_id_presupuesto` = ? AND fk_docente = ?;");

		if ( $stmt === FALSE ) {
		  die(' MODIFICAR prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('dis', $jornada , $fk_id_presupuesto , $fk_docente);
		return $stmt->execute();
	}
}


?>