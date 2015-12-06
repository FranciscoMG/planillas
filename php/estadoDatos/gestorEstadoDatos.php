<?php session_start(); ?>
<?php 
if ($_SESSION['masterActivo'] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
	exit();
} 
?>
<?php include_once("../conexionBD/estadoDatos.php"); ?>
<?php $dbEstadoDatos = new estadoDatosBD(); ?>
<?php 
	
$estado = $_GET['estadoDatos'];
$revisiones = $_GET['revisiones'];
$tipoPerfil = $_GET['tipoPerfil'];
$paraOficina = $_GET['paraOficina'];


/////////////////// Direcion rechasa y envia a docencia//////////
if ($_GET['rechasar'] == 1 && $revisiones == 0 && $estado == 0 && $paraOficina == 1){
		
		$estado = 1;
		$revisiones = 0;
		$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

///////////////// direccion rechasa y envia a recursos humanos////
if ($_GET['rechasar'] == 1 && $revisiones == 1 && $estado == 0 && $paraOficina == 2){
		
		$estado = 2;
		$revisiones = 1;
		$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

///////////////// direccion rechasa y envia a Docencia (ecepcion)////
if ($_GET['rechasar'] == 1 && $revisiones == 1 && $estado == 0 && $paraOficina == 1){
		
		$estado = 1;
		$revisiones = 0;
		$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

///////////// direccion aprueba y envia a recursos humanos //////
if ($_GET['enviar'] == 1 && $revisiones == 0 && $estado == 0 && $tipoPerfil == 0){
		
		$estado = 2;
		$revisiones = 1;
		$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

////////// SE FINALIZA EL CICLO ////////////////////////////
if ($_GET['enviar'] == 1 && $revisiones == 1 && $estado == 0 && $tipoPerfil == 0){
		
		//$estado = 2;
		//$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

/////////// Docencia envia la informacion a direccion ////////
if ($_GET['enviar'] == 1 && $revisiones == 0 && $estado == 1 && $tipoPerfil == 1){
		
		$estado = 0;
		$revisiones = 0;
		$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

/////////// Recursos Humanos envia la informacion a direccion ////
if ($_GET['enviar'] == 1 && $revisiones == 1 && $estado == 2 && $tipoPerfil == 2){
		
		$estado = 0;
		$revisiones = 1;
		$dbEstadoDatos->modificarEstadoDatos($estado ,$revisiones);
		header("Location: ../masterPage.php");
		exit();
	
}

 ?>

