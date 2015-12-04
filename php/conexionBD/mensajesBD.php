<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class mensajesBD extends conexionBD {

	//----------------------------------------
	function __construct()
    {
    	parent::__construct();
	}



	////////////////////////////////////////////////////////////
	function agregarMensaje($emisor , $receptor , $contenido_mensaje , $fecha)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Mensaje`
									(`emisor`,
									`receptor`,
									`contenido_mensaje`,
									`fecha`)
									VALUES
									(?,
									 ?,
									 ?,
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('ssss', $emisor , $receptor , $contenido_mensaje , $fecha);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	/////////////////////////////////////////////////////////
	function obtenerMensajes($receptor)
	{
		$query = "SELECT * FROM `tb_Mensaje` WHERE receptor = '".$receptor."' ORDER BY fecha asc LIMIT 25";
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
