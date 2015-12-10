<?php
session_start();
if ($_SESSION[masterActivo] != 1) {
	header("Location: ../sesion/cerrarSesion.php");
}
?>
<?php include_once("../conexionBD/docenteAdministrativoBD.php"); ?>

<?php 
$db = new docenteAdministrativoBD();

$resultado  = $db->obtenerDocenteAdministrativo();
while ($fila = mysqli_fetch_assoc($resultado)) {

	///////////// Se imprimen los datos <------

}
 ?>

<?php echo "string"; ?>