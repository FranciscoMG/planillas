<?php session_start() ?>
<?php include_once("../conexionBD/mensajesBD.php"); ?>
<?php $db = new mensajesBD(); ?>


<?php if ($_SESSION['masterActivo']) {

if (isset($_POST['enviarMensaje']) && $_POST['contenido_mensaje'] != "") {
$emisor = $_SESSION['nombre_usuario_perfil'];
$receptor = $_POST['cboxReceptorMensaje'];
$contenido_mensaje = $_POST['contenido_mensaje'];
$fecha = date("Y-m-d H:i:s");

$db->agregarMensaje($emisor, $receptor , $contenido_mensaje , $fecha);

	$_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Mensaje enviado";
    header("Location: ../masterPage.php?get=".$fecha);
	exit();
} else {
	$_SESSION['alerta'] = 1;
    $_SESSION['alerta-contenido'] = "Debe agregar contenido al mensaje";
    header("Location: ../masterPage.php?get=2");
	exit();
}

} else {
	header("Location: ../sesion/cerrarSesion.php");
	exit();
}

 ?>
