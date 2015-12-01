<?php session_start(); ?>

<?php

if ($_SESSION['masterActivo'] == 1 && $_SESSION['tipoPerfil'] == 0) {
	$_SESSION['alerta'] = 1;

	if (ereg(".sql$", $_POST['fileName'])) {

	//ENTER THE RELEVANT INFO BELOW
	$mysqlDatabaseName ='SIDOP';
	$mysqlUserName ='root';
	$mysqlPassword ='interactivas';
	$mysqlHostName ='localhost';
	$mysqlImportFilename = '../../backups/'.$_POST['fileName'];

	//DO NOT EDIT BELOW THIS LINE
	//Export the database and output the status to the page
	$command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
	system($command);


	$_SESSION['alerta-contenido'] = "Base de Datos importada";

	}else {
	$_SESSION['alerta-contenido'] = "Debe agregar un archivo .sql";
	}

	header("Location: ../masterPage.php");
	exit();
}
header("Location: ../sesion/cerrarSesion.php");
exit();

?>
