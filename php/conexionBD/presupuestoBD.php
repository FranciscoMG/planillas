<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class presupuestoBD extends conexionBD {

	//----------------------------------------
	function __construct()
    {
    	parent::__construct();
	}

	/////////////////////////////////////////////////////////
	function obtenerPresupuesto($id)
	{
		$query = "SELECT * FROM tb_Presupuesto WHERE id_presupuesto = '".$id."'";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}
	/////////////////////////////////////////////////////////
	function obtenerlistadoDePresupuesto()
	{
		$query = "SELECT * FROM tb_Presupuesto WHERE id_presupuesto != 1";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	////////////////////////////////////////////////////////////
	function agregarPresupuesto($nombre_presupuesto , $codigo , $tiempo_presupuesto)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Presupuesto`
									(`nombre_presupuesto`,
									`codigo`,
									`tiempo_presupuesto`)
									VALUES
									(?,
									 ?,
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('ssd', $nombre_presupuesto , $codigo , $tiempo_presupuesto);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	////////////////////////////////////////////////////////////////
	function borrarPresupuesto($id)
	{
		$stmt = $this->con->prepare("DELETE FROM tb_Presupuesto where id_presupuesto = ?");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('i', $id);
		return $stmt->execute();
	}
	
	/////////////////////////////////////////////////////////////////
	function modificarPresupuesto($id_presupuesto, $nombre_presupuesto , $codigo , $tiempo_presupuesto)
	{
		$stmt = $this->con->prepare("UPDATE tb_Presupuesto SET nombre_presupuesto = ?, codigo = ?, tiempo_presupuesto = ? WHERE id_presupuesto = ?;");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('ssdi', $nombre_presupuesto , $codigo , $tiempo_presupuesto , $id_presupuesto);
		return $stmt->execute();
	}
}


?>
