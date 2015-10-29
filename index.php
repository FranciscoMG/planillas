<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<!--<meta http-equiv='REFRESH' content='0;url=php/masterPage.php'>
	-->
	<title>master</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="index">
	<header >
		<div class="container">
			<div id="logo-ucr" class="row">
				<div  class="col-sx-12 col-sm-8 col-md-6 col-lg-4">
					<img id="logo-ucr" src="img/logo-ucr.png" class="img-responsive" alt="">
				</div>
			</div>
		</div>
		<div id="perfil-row" class="container-fluid">
			<div  class="row">
			</div>
		</div>
		<div  id="perfil-nav" class="row ">
			<div class="container">
				<img src="img/logo-planillas.png" class="img img-responsive center-block"alt="">
			</div>
		</div>
	</header>
	<main>
		<div class="container fondo-log">
			<div class="row center-block">
				<div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6  col-lg-offset-3 contenedor-log ">
					<form>
						<h3>Ingreso</h3>
						<div class="separador"></div>
					 	<div class="form-group">
					    	<label for="exampleInputEmail1">Usuario</label>
					    	<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Usuario">
					  	</div>
					  	<div class="form-group">
					    	<label for="exampleInputPassword1">Contraseña</label>
					    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
					  	</div>
					  	<a href="#" data-toggle="modal" data-target="#modalRegistro">Registrar</a>
					  	<div class="separador separador-absolute"></div>
					  	<button type="submit" class="btn btn-default pull-right">Ingresar</button>
					</form>
				</div>
			</div>
		</div>
			<div class="clearfix"></div>
	</main>
	<footer class="footer " >
		<div class="container-fluid">
			<div class="row row1">
				<div class="container">
					<div class="col-sx-12 col-sm-6">
						<h6>Tel: 6666 66 66</h6>
					</div>
					<div class="col-sx-12 col-sm-6">
						<h6>Email: <a href="#">corre@my.com</a></h6>
					</div>
				</div>
			</div>
			<div class="row row2">
				<img src="img/logo-ucr-footer.png" class="img-responsive pull-right"alt="">
			</div>
		</div>
	</footer>
	<!-- Modales -->
	<div id="modalRegistro" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<div class="modal-header modal-delete-border">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Registro Usuarios</h4>
				</div>
				<form>
					<div class="modal-body">
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    					<label for="txtUsuario">Usuario:</label>
    					<input type="text" class="form-control input-border" name="txtUsuario" placeholder="Usuario">
  					</div>
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    					<label for="txtNombre">Nombre:</label>
    					<input type="text" class="form-control input-border" name="txtNombre" placeholder="Nombre">
  					</div>
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    					<label for="cboTipoPerfil">Tipo de perfil:</label>
							<select class="form-control">
  							<option>Docencia</option>
  							<option>Recursos humanos</option>
  							<option>Administrativo</option>
							</select>
  					</div>
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    					<label for="txtContrasena">Contraseña:</label>
    					<input type="password" class="form-control input-border" name="txtContrasena" placeholder="Contraseña">
  					</div>
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    					<label for="txtConfirmar">Confirmar contraseña:</label>
    					<input type="password" class="form-control input-border" name="txtConfirmar" placeholder="Confirmar contraseña">
  					</div>
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
						<p class="form-control-static texto-efectos1">¡Usted no podrá usar el perfil hasta que administración lo revise y apruebe!</p>
					</div>
					<div class="modal-footer modal-delete-border">
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-block" name="btnAgregar">Agregar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>"
