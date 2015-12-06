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
	function agregarPresupuesto($nombre_presupuesto , $codigo , $tiempo_presupuesto , $tiempo_sobrante)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Presupuesto`
									(`nombre_presupuesto`,
									`codigo`,
									`tiempo_presupuesto`,
									`tiempo_sobrante`)
									VALUES
									(?,
									 ?,
									 ?,
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('ssdd', $nombre_presupuesto , $codigo , $tiempo_presupuesto , $tiempo_sobrante);
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
		$stmt = $this->con->prepare("UPDATE tb_Presupuesto SET nombre_presupuesto = ?, codigo = ? WHERE id_presupuesto = ?;");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('ssi', $nombre_presupuesto , $codigo , $id_presupuesto);
		return $stmt->execute();
	}

	//////////////////////////////////////////////////////////////
	function restarPresupuesto($id_presupuesto, $tiempo_sobrante)
	{
		$stmt = $this->con->prepare("UPDATE tb_Presupuesto SET tiempo_sobrante = ? WHERE id_presupuesto = ?;");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('di', $tiempo_sobrante , $id_presupuesto );
		return $stmt->execute();
	}

	/////////////////////////////////////////////////////////////
	function sumarPresupuesto($id_presupuesto, $tiempo_sobrante)
	{
		$stmt = $this->con->prepare("UPDATE tb_Presupuesto SET tiempo_sobrante = ? WHERE id_presupuesto = ?;");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('di', $tiempo_sobrante , $id_presupuesto );
		return $stmt->execute();
	}
}


?>
