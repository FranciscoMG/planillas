<?php

/**
 * Vamos a usar herencias, esta sería nuestra clase madre
 */
abstract class conexionBD
{
	protected $con; //Si va private no se hereda
	
	function __construct($host, $userdb, $passworddb, $dbname)
	{
		$this->con = new mysqli($host, $userdb, $passworddb, $dbname);
		if (mysqli_connect_errno()) {
		    echo "Algo malo pasó: " . mysqli_connect_error();
		    die();
		}
	}
	
	function cerrar()
	{
		$this->con->close();
	}
	
	function __destruct()
	{
		$this->cerrar();
	}
	
}


?>