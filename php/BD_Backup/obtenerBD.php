<?php session_start(); ?>

<?php

if ($_SESSION['masterActivo'] == 1 && $_SESSION['tipoPerfil'] == 0) {

	//servidor MySql
	$C_SERVER='localhost';
	//base de datos
	$C_BASE_DATOS='SIDOP';
	//usuario y contraseña de la base de datos mysql
	$C_USUARIO='root';
	$C_CONTRASENA='interactivas';  
	//ruta archivo de salida
	//(el nombre lo componemos con Y_m_d_H_i_s para que sea diferente en cada backup)
	$C_RUTA_ARCHIVO = '../../backups/backup_SIDOP_'.date("Y_m_d_H_i_s").'.sql';
	//si vamos a comprimirlo
	$C_COMPRIMIR_MYSQL='false';


	//comando
	$command = "mysqldump --opt -h ".$C_SERVER." ".$C_BASE_DATOS." -u ".$C_USUARIO." -p".$C_CONTRASENA.
	     " -r \"".$C_RUTA_ARCHIVO."\" 2>&1";

	//ejecutamos
	system($command);

	//comprimimos
	if ($C_COMPRIMIR_MYSQL == 'true') {
	 system('bzip2 "'.$C_RUTA_ARCHIVO.'"');
	}

	$_SESSION['alerta'] = 1;
	$_SESSION['alerta-contenido'] = "Base de Datos exportada. <br>Se guardó en la ruta: /var/www/html/SIDOP/backups/";
	header("Location: ../masterPage.php");
	exit();

}
header("Location: ../sesion/cerrarSesion.php");
exit();
 ?>
