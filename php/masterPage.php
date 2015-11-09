<?php
	session_start();
	if (!isset($_SESSION['usuario'])) {
		$_SESSION['mensaje']="Debe iniciar sesión para ingresar";
		header("Location: inicio.php");
	}
	$_SESSION['masterActivo']=1;
?>

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
 							<button class="btn boton-perfil btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Perfil: <?php
						switch ($_SESSION['tipoPerfil']) {
								case 0:
									echo "<strong>Administrativo</strong>";
									break;
									case 1:
										echo "<strong>Docencia</strong>";
										break;
										case 2:
											echo "<strong>Recursos humanos</strong>";
											break;

							}
							?> <span class="caret"></span></button>
 							<ul class="dropdown-menu">
	 							<li class="dropdown-header"><a href="#"> <?php echo $_SESSION['nombre_usuario']; ?> </a></li>
	 							<li class="divider"></li>
	 							<li><a href="sesion/cerrarSesion.php">Cambiar usuario</a></li>
	 							<li><a href="sesion/cerrarSesion.php">Salir</a></li>
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
			                <li><a href="#" data-toggle="modal" data-target="#modalRegistro">Agregar</a></li>
			                <li><a href="#" data-toggle="modal" data-target="#modalRegistro">Modificar</a></li>
			                <li><a href="#" data-toggle="modal" data-target="#modalRegistro">Eliminar</a></li>
			              </ul>
			            </li>

						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Proyectos <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#" data-toggle="modal" data-target="#modalProyectos">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>

						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cursos <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#" data-toggle="modal" data-target="#modalCursos">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>

						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Docentes <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#" data-toggle="modal" data-target="#modalDocentes">Agregar</a></li>
			                <li><a href="#">Modificar</a></li>
			                <li><a href="#">Eliminar</a></li>
			              </ul>
			            </li>

						<li class="dropdown">
			              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Grupos <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#" data-toggle="modal" data-target="#modalGrupos">Agregar</a></li>
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
			                <li><a href="#">Por carrera</a></li>
			                <li><a href="#">Por profesor</a></li>
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
	<main class="master">

<!--************* Tabla principal ********************-->
		<div class="container" id="contenedor-tabla">

			<a onclick="cambiarTableHorizontal()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-horizontal"class="glyphicon glyphicon-resize-full"  ></span></a>

			<a onclick="cambiarTableVertical()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-vertical"class="glyphicon glyphicon-menu-down"  ></span></a>

			<div class="contenedor-tabla-2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tabla table-responsive contenedor-tabla-0" id="tabla-planillas">
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
							<a href="#" class="btn btn-danger btn-sm pull-right btn-revision" data-toggle="modal" data-target="#modalRevision">Revisión</a>

						</div>
					</div>
			</div>
		</div>

<!--************* Aside ********************-->
		<div class="container container-aside">
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
								</table>
							</div>

					</div>
			</div>
		</div>

	</main>

<!-- //////// Footer /////////////////////////////////////////////////////////// -->
	<footer class="footer" >
		<div class="container-fluid">
			<div class="row row1">
				<div class="container">
					<div class="col-sx-12 col-sm-6 text-right  pull-right">
						<h6>Email: <a href="#">Tel: 6666 66 66 | correo@my.com</a></h6>
					</div>
				</div>
			</div>
			<div class="row row2">
				<img src="../img/logo-ucr-footer.png" class="img-responsive pull-right"alt="75 aniversario UCR">
			</div>
		</div>
	</footer>

<!--////////////////////////////  Modal //////////////////////////-->
<div id="modalRevision" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Titulo</h4>
      </div>
      <div class="modal-body">
        <p>Texto</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--Modal de Cursos-->

<form>
<div class="form-group col-xs-12 col-sm-12 col-lg-12">
	<div id="modalCursos" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      	<div class="modal-header modal-delete-border">
        	<h4 class="modal-title">Registro de Cursos</h4>
      	</div>
      	<div class="modal-body">
        	<label>Sigla del curso</label>
					<form class="form-inline" role="form">
						<div class="form-group row">
							<div class="col-xs-8 col-sm-9 col-lg-9">
								<input type="text" class="form-control input-border inputColor">
							</div>
							<div class="col-xs-4 col-sm-3 col-lg-3">
								<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
							</div>
					</div>
					<label>Nombre del Curso</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<input type="text" class="form-control input-border inputColor">
							</div>
					</div>
					<label>Cantidad de Creditos</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<select class="form-control">
									<?php
									for($i=0;$i<=12;$i++){
										echo "<option>".$i."</option>";
									}
									?>
								</select>
							</div>
					</div>
				</div>
      	<div class="modal-footer modal-delete-border">
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnModificar" disabled>Modificar</button>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnEliminar" disabled>Eliminar</button>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-block" name="btnAgregar">Agregar</button>
						</div>
      	</div>
    	</div>
  	</div>
	</div>
</div>
</form>
</form>

<!--/////////////////////////////////  Modal de Usuarios/////////////////////////////////////-->

	<?php require("include/modalUsuarios.php"); ?>

<!--////////////////////////////////////// Modal de Proyectos ////////////////////////-->

<form>
	<div id="modalProyectos" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      	<div class="modal-header modal-delete-border">
        	<h4 class="modal-title">Registro de Proyectos</h4>
      	</div>
      	<div class="modal-body">
        	<label>Nombre del proyecto</label>
					<form class="form-inline" role="form">
						<div class="form-group row">
							<div class="col-xs-8 col-sm-9 col-lg-9">
								<input type="text" class="form-control input-border inputColor">
							</div>
							<div class="col-xs-4 col-sm-3 col-lg-3">
								<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
							</div>
					</div>
					<label>Tipo de Proyecto</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<select class="form-control">
	  							<option>Accion Social</option>
	  							<option>Investigacion</option>
								</select>
							</div>
					</div>
				<label>Cantidad de tiempos</label>
					<div class="form-group row">
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<select class="form-control">
								<option>3/4</option>
								<option>2/4</option>
								<option>1/4</option>
								<option>1/2</option>
								<option>1</option>
							</select>
						</div>
				</div>
			<label>Principal/Responsable</label>
				<div class="form-group row">
					<div class="col-xs-12 col-sm-12 col-lg-12">
						<select class="form-control">
							<option>Profesor1</option>
							<option>Profesor2</option>
							<option>Profesor3</option>
						</select>
					</div>
			</div>
		<label>Asociado/Colaborador</label>
			<div class="form-group row">
				<div class="col-xs-12 col-sm-12 col-lg-12">
					<select class="form-control">
						<option>Profesor1</option>
						<option>Profesor2</option>
						<option>Profesor3</option>
					</select>
				</div>
		</div>
		<div class="modal-footer modal-delete-border">
			<div class="col-xs-6 col-sm-6 col-lg-6">
				<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnModificar" disabled>Modificar</button>
			</div>
				<div class="col-xs-6 col-sm-6 col-lg-6">
					<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnEliminar" disabled>Eliminar</button>
					</div>
				<div class="col-xs-12 col-sm-12 col-lg-12">
					<button type="submit" class="btn btn-primary btn-block" name="btnAgregar">Agregar</button>
				</div>
				</div>
    	</div>
  	</div>
	</div>
</div>
</form>
</form>

<!--Modal Docentes-->

<form>
<div class="form-group col-xs-12 col-sm-12 col-lg-12">
	<div id="modalDocentes" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      	<div class="modal-header modal-delete-border">
        	<h4 class="modal-title">Registro de Docentes</h4>
      	</div>
      	<div class="modal-body">
        	<label>Numero de Cedula</label>
					<form class="form-inline" role="form">
						<div class="form-group row">
							<div class="col-xs-8 col-sm-9 col-lg-9">
								<input type="text" class="form-control input-border inputColor">
							</div>
							<div class="col-xs-4 col-sm-3 col-lg-3">
								<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
							</div>
					</div>
					<label>Apellidos</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<input type="text" class="form-control input-border inputColor">
							</div>
					</div>
					<label>Grado Academico</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<select class="form-control">
	  							<option>Licenciado(a)</option>
	  							<option>Master</option>
	  							<option>Doctor(a)</option>
								</select>
							</div>
					</div>
					<label>Nombre</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<input type="text" class="form-control input-border inputColor">
							</div>
					</div>
					<label>Tipo de Contrato</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<select class="form-control">
									<option>Interino</option>
									<option>En Propiedad</option>
									<option>Sustituto</option>
								</select>
							</div>
					</div>
				</div>
      	<div class="modal-footer modal-delete-border">
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnModificar" disabled>Modificar</button>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnEliminar" disabled>Eliminar</button>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-block" name="btnAgregar">Agregar</button>
						</div>
      	</div>
    	</div>
  	</div>
	</div>
</div>
</form>
</form>

<!--Modal de Grupos-->

<form>
<div class="form-group col-xs-12 col-sm-12 col-lg-12">
	<div id="modalGrupos" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content col-xs-12 col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 col-lg-11 col-lg-offset-1">
      	<div class="modal-header modal-delete-border">
        	<h4 class="modal-title">Crear curso especifico</h4>
      	</div>
      	<div class="modal-body">
        	<label>Sigla del curso</label>
					<form class="form-inline" role="form">
						<div class="form-group row">
								<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
									<select class="form-control">
										<option>TM4500</option>
										<option>TM4500</option>
										<option>TM4500</option>
									</select>
								</div>
							<div class="col-xs-4 col-sm-3 col-md-9 col-lg-3">
								<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
							</div>
					</div>
					<label>Nombre del Curso</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<input type="text" class="form-control input-border inputColor">
							</div>
					</div>
					<label>Grupo</label>
					<div class="form-group row">
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
								<select class="form-control">
									<?php
									for($i=0;$i<=8;$i++){
										echo "<option>".$i."</option>";
									}
									?>
								</select>
							</div>
						<div class="col-xs-4 col-sm-3 col-md-9 col-lg-3">
							<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
						</div>
				</div>
				<label>Docente</label>
				<div class="form-group row">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<select class="form-control">
								<option>Profesor1</option>
								<option>Profesor1</option>
								<option>Profesor1</option>
							</select>
						</div>
					<div class="col-xs-4 col-sm-3 col-md-9 col-lg-3">
						<button type="submit" class="form-control btn-success btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></button>
					</div>
			</div>
			<label class="col-xs-8 col-sm-8 col-md-8 col-lg-8">Tiempos individuales</label>
			<div class="form-group row">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<select class="form-control">
							<option>3/8</option>
							<option>3/4</option>
							<option>2/4</option>
							<option>1/4</option>
							<option>1/2</option>
							<option>1</option>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control input-border inputColor espacio-botones-modal">
						</div>
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 espacio-botones-modal">
							<button type="submit" class="form-control btn-success btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></button>
						</div>
					</div>
				</div>
				<label>Horario:</label>
				<div class="form-group row">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<select class="form-control">
								<?php
								$semana = array("L","K","M","J","V","S","D");
								for($i=0;$i<=7;$i++){
									echo "<option>".$semana[$i]."</option>";
								}
								?>
							</select>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<select class="form-control">
								<?php
								for($i=6;$i<=22;$i++){
									for($j=0;$j<=50;$j+=10){
										if($j==0){
											echo "<option>".$i." : ".$j."0</option>";
										}else{
											echo "<option>".$i." : ".$j."</option>";
										}
									}
								}
								?>
							</select>
						</div>
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1">a:</label>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<select class="form-control">
								<?php
								for($i=6;$i<=22;$i++){
									for($j=0;$j<=50;$j+=10){
										if($j==0){
											echo "<option>".$i." : ".$j."0</option>";
										}else{
											echo "<option>".$i." : ".$j."</option>";
										}
									}
								}
								?>
							</select>
						</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<button type="submit" class="btn btn-xs form-control btn-success btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></button>
					</div>
			</div>
			<label class="col-xs-12 col-sm-12 col-md-12 col-lg-12  espacio-botones-modal">Jornada</label>
			<div class="form-group row">
					<div class="col-xs-7 col-sm-7 col-md-8 col-lg-7 espacio-botones-modal">
						<select class="form-control">
							<option>3/8</option>
							<option>3/4</option>
							<option>2/4</option>
							<option>1/4</option>
							<option>1/2</option>
							<option>1</option>
						</select>
					</div>
      	<div class="modal-footer modal-delete-border">
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnModificar" disabled>Modificar</button>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnEliminar" disabled>Eliminar</button>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-block" name="btnAgregar">Agregar</button>
						</div>
      	</div>
    	</div>
  	</div>
	</div>
</div>
</form>
</form>

</body>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/planillas.js"></script>

<?php
	if ($_SESSION['registrando'] == 1) {
		echo "<script>
		$('#modalRegistro').modal('show');
		</script>";
	}
?>
</html>
