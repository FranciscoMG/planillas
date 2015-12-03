<?php session_start() ?>
<?php include_once("../conexionBD/registroActividadBD.php"); ?>
<?php $db = new registroActividadBD(); ?>


<?php if ($_SESSION['masterActivo']) {

$utc = date('U');
$fecha = date("Y-m-d H:i:s");
$usuario = $_SESSION['usuario'];
$descripcion = "Prueba de descripcion";

$db->agregarRegistroActividad($utc, $fecha , $usuario , $descripcion);


} else {
	header("Location: ../sesion/cerrarSesion.php");
	exit();
}

 ?>