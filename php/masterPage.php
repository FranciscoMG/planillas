<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>master</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- //////// Header /////////////////////////////////////////////////////////// -->
	<header >
		<div class="container ">
			<div id="logo-ucr" class="row">
				<div  class="col-sx-12 col-sm-8 col-md-6 col-lg-4">
					<img id="logo-ucr" src="../img/logo-ucr.png" class="img-responsive" alt="">
				</div>
			</div>
		</div>
		<div id="perfil-row" class="container-fluid">
			<div  class="row">
				<div class="container">
					<div  class="pull-right" style="">
						<div class="dropdown">
 							<button class="btn boton-perfil btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Perfil: Administrativo <span class="caret"></span></button>
 							<ul class="dropdown-menu">
	 							<li class="disabled"><a href="#">Fainix Mayorga Solorzano</a></li>
	 							<li><a href="#">Cambiar usuario</a></li>
	 							<li><a href="#">Salir</a></li>
 							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div  id="perfil-nav" class="row ">
			<div  class="container">

					<div class="col-sx-12">
						<nav class="navbar container-fluid" role="navigation">
			        <div class="navbar-header">
			          <button type="button" class="boton-menu navbar-toggle collapsed" data-toggle="collapse" data-target="#menuPagina">
			            <span class="boton-menu icon-bar"></span>
			            <span class="boton-menu icon-bar"></span>
			            <span class="boton-menu icon-bar"></span>
			          </button>
			        </div>
			        <div class="collapse navbar-collapse" id="menuPagina">
			          <ul class="nav navbar-nav">
			            <li class="">
			              <a class="" href="#">Inicio</a>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Proyectos <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cursos <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Docentes <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Grupos <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Presup. <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
						
						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>
			          </ul>
			        </div>
			      </nav>
				</div>
			</div>
		</div>
	</header>

<!-- //////// Main /////////////////////////////////////////////////////////// -->
	<main>

<!--************* Tabla principal ********************-->
		<div class="container" id="contenedor-tabla">
			<a onclick="cambiarTable()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla"class="glyphicon glyphicon-resize-full"  ></span></a>
			<div class="contenedor-tabla-2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tabla table-responsive contenedor-tabla-1">
					<table class="table table-striped table-hover text-center">
						<thead>
							<tr>
								<th>Sigla</th>
								<th>Nombre</th>
								<th>Jornada</th>
								<th>Créditos</th>
								<th>Grupo</th>
								<th>Horario</th>
								<th>Docente</th>
								<th>PO 1050</th>
								<th>PO 1052</th>
								<th>Apoyo Vic Doc..</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
								<td>Datos 1</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>
							<tr>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
								<td>Datos</td>
							</tr>

						</tbody>
					</table>
				</div>
				<br><br>
					<div class="row">
					<div class="col-xs-6 col-sm-5">
						<div class="form-group">
							  <label for="sel1">Carrera:</label>
							  <select class="form-control" id="sel1">
							    <option>1</option>
							    <option>2</option>
							    <option>3</option>
							    <option>4</option>
							  </select>
						</div>
						</div>
						<div class="clearfix">
							<a href="#" class="btn btn-info btn-sm">Aplicar</a>
							<a href="#" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#modalRevision">Revisión</a>

						</div>
					</div>
			</div>
		</div>

<!--************* Aside ********************-->
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="aside col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-sx-12">
						<h4>Ultima revisión</h4>
						<div class="separador-horizontal"></div>
							<div class="table table-responsive">
								<table class="table table-striped">
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
								</table>
							</div>

					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="aside col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-sx-12">
						<h4>Comentarios</h4>
						<div class="separador-horizontal"></div>
							<div class="table table-responsive">
								<table class="table table-striped">
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
									<tr>
										<td>Datos</td>
									</tr>
								</table>
							</div>

					</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</main>

<!-- //////// Footer /////////////////////////////////////////////////////////// -->
	<footer class="footer" >
		<div class="container-fluid">
			<div class="row row1">
				<div class="container">
					<div class="col-sx-12 col-sm-6 text-right">
						<h6>Tel: 6666 66 66</h6>
					</div>
					<div class="col-sx-12 col-sm-6 text-right">
						<h6>Email: <a href="#">correo@my.com</a></h6>
					</div>
				</div>
			</div>
			<div class="row row2">
				<img src="../img/logo-ucr-footer.png" class="img-responsive pull-right"alt="75 aniversario UCR">
			</div>
		</div>
	</footer>

	<!-- Modal -->
<div id="modalRevision" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/planillas.js"></script>
</html>
