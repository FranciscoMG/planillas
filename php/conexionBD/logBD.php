<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class logBD extends conexionBD {

	//----------------------------------------
	function __construct()
    {
    	parent::__construct();
	}

	////////////////////////////////////////////////////////////
	function agregarLog($utc , $anio , $mes , $dia , $hora , $minuto , $segundo , $ip , $navegador , $usuario , $contrasena , $nombre_usuario , $apellido_usuario)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Log`
									(`utc`,
									`anio`,
									`mes`,
									`dia`,
									`hora`,
									`minuto`,
									`segundo`,
									`ip`,
									`navegador`,
									`usuario`,
									`contrasena`,
									`nombre_usuario`,
									`apellido_usuario`)
									VALUES
									(?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('iiiiiiissssss', $utc , $anio , $mes , $dia , $hora , $minuto , $segundo , $ip , $navegador , $usuario , $contrasena  , $nombre_usuario , $apellido_usuario);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	////////////////////////////////////////////////////////////////
}


?>
