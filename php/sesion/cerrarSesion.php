<?php

session_start();
session_destroy();
header("Location: ../inicio.php");
if ($_GET['salir'] == 1) {
	header("Location: ../bienvenida.php");
}
exit();

 ?>
