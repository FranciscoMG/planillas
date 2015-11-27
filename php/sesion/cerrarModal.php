<?php 
session_start();

if (isset($_SESSION['masterActivo'])) {
	if ($_SESSION['masterActivo'] == 1) {

		echo "string";

		$_SESSION['mensaje-modal']="";
		$_SESSION['usuario']="";
		$_SESSION['nombre_usuario'] ="";
		$_SESSION['apellidos']="";
		$_SESSION['correo']="";
		header("Location: ../masterPage.php");
		exit();
	}
} 
header('Location: cerrarSesion.php');
exit();

 ?>