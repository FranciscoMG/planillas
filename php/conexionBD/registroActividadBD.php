<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class registroActividadBD extends conexionBD {

	//----------------------------------------
	function __construct()
    {
    	parent::__construct();
	}



	////////////////////////////////////////////////////////////
	function agregarRegistroActividad($utc , $fecha , $usuario , $descripcion)
	{
		$stmt = $this->con->prepare("INSERT INTO `tb_RegistroActividad`
									(`utc`,
									`fecha`,
									`usuario`,
									`descripcion`)
									VALUES
									(?,
									 ?,
									 ?,
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('isss', $utc , $fecha , $usuario , $descripcion);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	/////////////////////////////////////////////////////////
	function obtenerRegistroActividad()
	{
		$query = "SELECT * FROM tb_RegistroActividad ORDER BY fecha desc LIMIT 25 ";
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
