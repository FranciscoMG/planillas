<?php
	session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>master</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="index">
	<header >
		<div class="container">
			<div id="logo-ucr" class="row">
				<div  class="col-sx-12 col-sm-8 col-md-6 col-lg-4">
					<img id="logo-ucr" src="../img/logo-ucr.png" class="img-responsive" alt="">
				</div>
			</div>
		</div>
		<div id="perfil-row" class="container-fluid">
			<div  class="row">
			</div>
		</div>
		<div  id="perfil-nav" class="row ">
			<div class="container">
				<img src="../img/logo-planillas.png" class="img img-responsive center-block"alt="">
			</div>
		</div>
	</header>
<br>
					<br>
					<br>

	<main>
		<div class="container fondo-log">
			<div class="row center-block">
				<div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6  col-lg-offset-3 contenedor-log  text-center">
					<br>
					<br>
					<br>

					<h3>Bienvenido al Sistema de Planillas SIDOP <br> </h3>

					<br>
					<a href="inicio.php" >Ir al login...</a>

					<br>
					<br>
					<br>
				</div>
			</div>
		</div>
			<div class="clearfix"></div>
	</main>
	<footer class="footer">
		<div class="container-fluid">
			<div class="row row1">
				<div class="container-fluid">
					<div class="col-sx-12 text-right pull-right">
						<h6><a href="http://www.srp.ucr.ac.cr/content/direccion_directorio-telef%C3%B3nico" target="_blank"><span class="glyphicon glyphicon-list-alt"></span> Directorio Telefónico  &nbsp; &nbsp;&nbsp;</a>| &nbsp; &nbsp;&nbsp; Recursos Humanos: 2511-7407 &nbsp;&nbsp; &nbsp; | &nbsp;&nbsp; &nbsp; Coordinación de Docencia: 2511-7410 &nbsp;&nbsp; &nbsp; |  &nbsp;&nbsp; &nbsp; Dirección: 2511-7401  </h6>
					</div>
				</div>
			</div>
			<div class="row row2">
				<img src="../img/logo-ucr-footer.png" class="img-responsive pull-right"alt="75 aniversario UCR">
			</div>
		</div>
	</footer>
<!--*********************** Modales *******************-->
	 <?php require("include/modalUsuarios.php"); ?>

</body>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<?php
	if ($_SESSION['registrando'] == 1) {
		echo "<script>
		$('#modalRegistro').modal('show');
		</script>";
	}
?>
</html>
