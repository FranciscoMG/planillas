<?php

	define("__HOST__",     "127.0.0.1");
	define("__USUARIODB__",     "admin_db");
	define("__PASSDB__",     "SIDOP_key");
	define("__DATABASE__",     "SIDOP");
/**
 * Vamos a usar herencias, esta sería nuestra clase madre
 */
abstract class conexionBD {
	protected $con;

	function __construct() {
		$this->con = new mysqli(__HOST__, __USUARIODB__, __PASSDB__, __DATABASE__);
		if (mysqli_connect_errno()) {
			echo "Error al conectar a la base : " . mysqli_connect_error();
			die();
		}
	}

	function cerrar() {
		$this->con->close();
	}

	function __destruct() {
		$this->cerrar();
	}
}
?>
