<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class gruposBD extends conexionBD {
	function __construct() {
    	parent::__construct();
	}

?>
