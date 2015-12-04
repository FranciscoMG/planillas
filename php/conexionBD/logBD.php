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
	function agregarLog($utc , $anio , $mes , $hora , $minuto , $segundo , $ip , $navegador , $usuario , $contrasena , $nombre_usuario , $apellido_usuario)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Log`
									(`utc`,
									`anio`,
									`mes`,
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
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$stmt->bind_param('iiiiiissssss', $utc , $anio , $mes , $hora , $minuto , $segundo , $ip , $navegador , $usuario , $contrasena  , $nombre_usuario , $apellido_usuario);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	////////////////////////////////////////////////////////////////
}


?>
