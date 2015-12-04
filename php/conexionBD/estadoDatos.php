<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class estadoDatosBD extends conexionBD {

	//----------------------------------------
	function __construct()
    {
    	parent::__construct();
	}

	////////////////////////////////////////////////////
	function modificarEstadoDatos ($estado , $revisiones) {
		$stmt = $this->con->prepare("UPDATE `SIDOP`.`tb_estadoDatos` SET `estado` = ? , `revisiones` = ? WHERE `tb_estadoDatos`.`id_estadoDatos` = 0");
		if ($stmt === FALSE) {
			die("Prepare fail");
		}

		$stmt->bind_param('ii' , $estado , $revisiones);
		$stmt->execute();
		$stmt->close();
		return true;
	}


	/////////////////////////////////////////////////////////
	function obtenerEstadoDatos()
	{
		$query = "SELECT * FROM `tb_estadoDatos`";
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
