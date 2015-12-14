<?php
	session_start();
	if (!isset($_SESSION['usuario'])) {
		$_SESSION['mensaje']="Debe iniciar sesión para ingresar";
		header("Location: inicio.php");
	}
	$_SESSION['masterActivo']=1;
?>

<?php include_once("conexionBD/estadoDatos.php"); ?>
<?php $dbEstadoDatos = new estadoDatosBD(); ?>
<?php
	$resultadoEstadoDatos = $dbEstadoDatos->obtenerEstadoDatos();
	while ($fila = mysqli_fetch_assoc($resultadoEstadoDatos)) {
		$estado = $fila['estado'];
		$revisiones = $fila['revisiones'];
		$periodo = $fila['periodo'];
	}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>master</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
</head>
<body onload="cambiaDivTabla();">

<!-- //////// Header /////////////////////////////////////////////////////////// -->
	<header>
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
	 							<li class="dropdown-header"><a href="#"> <?php echo $_SESSION['nombre_usuario_perfil']; ?> </a></li>
	 							<li class="divider"></li>
	 							<li><a href="sesion/cerrarSesion.php"><span class='glyphicon glyphicon-user' ></span> Cambiar usuario </a></li>
								<?php if($_SESSION['tipoPerfil'] == 0){
									if ($estado == $_SESSION['tipoPerfil']) {

									echo "<li><a onClick='desabilitar_habiltarOpciones();' class='texto_cambiar'><span class='glyphicon glyphicon-ok-circle' id='spam_h'></span> Cambiar Opciones </a></li>

										";
									}
								}
									?>
	 							<li><a href="" data-toggle="modal" data-target="#modalMensajes"><span class='glyphicon glyphicon-envelope' ></span> Enviar mensaje </a></li>
	 							<li><a href="sesion/cerrarSesion.php?salir=1">Salir</a></li>

	 							<?php if ($_SESSION['tipoPerfil'] == 0) {
	 							echo '
									<li class="divider"></li>

									<li><a href="" data-toggle="modal" data-target="#modalConfirmacion"><span class="glyphicon glyphicon-save " > </span> Exportar BD MySQL</a></li>
									<li><a href="" data-toggle="modal" data-target="#modalBD"><span class="glyphicon glyphicon-open " > </span> Importar BD MySQL</a></li>';
	 							} ?>

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

						<li><a href="masterPage.php">Inicio</a></li>

						<li class="dropdown <?php if($_SESSION['tipoPerfil'] != 0){echo "hide";} ?>">
			              <a class="dropdown-toggle " data-toggle="dropdown" href="#">Usuarios <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="#" data-toggle="modal" data-target="#modalRegistro">Modificar</a></li>
			                <li><a href="#" data-toggle="modal" data-target="#modalUsuariosBorrar">Eliminar</a></li>
			                <li role="separator" class="divider"></li>
			                <li><a class="texto_cambiar" data-toggle="modal" data-target="#modalActivarUsuarios">Activar usuarios</a></li>
			              </ul>
			            </li>

					<?php if(true){
						if ($_SESSION['tipoPerfil'] == 0 || $estado != $_SESSION['tipoPerfil']) {
							echo '<li class="desabilitado_li disabled" id="li_nav">
						              <a class="desabilitado_a disabled" id="a_nav" data-toggle="dropdown" href="#">Docentes <span class="caret"></span></a>';
						} else {
						echo '<li class="" id="li_nav">
						              <a class="" id="a_nav" data-toggle="dropdown" href="#">Docentes <span class="caret"></span></a>';
						}

			          echo '<ul class="dropdown-menu">
						          <li><a href="#" data-toggle="modal" data-target="#modalDocentes" onclick="activarAgregarDocente()">Agregar</a></li>
						          <li><a href="#" data-toggle="modal" data-target="#modalDocentes" onclick="activarModificarDocente()">Modificar</a></li>
						          <li><a href="#" data-toggle="modal" data-target="#modalDocentes" onclick="activarEliminarDocente()">Eliminar</a></li>';

						       	echo '
					              <li class="divider"></li>
					              <li class="dropdown-submenu">
					                <a tabindex="-1" href="#">Docente con permiso </a>
					                <ul class="dropdown-menu">
					                  <li><a tabindex="-1" href="#" data-toggle="modal" data-target="#modalDocentesConPermisos" onclick="activarAgregarDocenteConPermisos();"> Agregar</a></li>
					                  <li><a  href="#" data-toggle="modal" data-target="#modalDocentesConPermisos" onclick="activarModificarDocenteConPermisos();"> Modificar</a></li>
					                  <li><a href="#" data-toggle="modal" data-target="#modalDocentesConPermisos" onclick="activarEliminarDocenteConPermisos();">Eliminar</a></li>
					                </ul>
					              </li>

					              <li class="dropdown-submenu">
					                <a tabindex="-1" href="#">Docente administrativo</a>
					                <ul class="dropdown-menu">
					                  <li><a tabindex="-1" href="#" data-toggle="modal" data-target="#modalDocentesAdministrativo" onclick="activarAgregarDocenteAdministrativo();"> Agregar</a></li>
					                  <li><a  href="#" data-toggle="modal" data-target="#modalDocentesAdministrativo" onclick="activarModificarDocenteAdministrativo();"> Modificar</a></li>
					                  <li><a href="#" data-toggle="modal" data-target="#modalDocentesAdministrativo" onclick="activarEliminarDocenteAdministrativo();"> Eliminar</a></li>
					                </ul>
					              </li>
						    </ul>
						</li>';}?>

				<?php if($_SESSION['tipoPerfil'] == 0 || $_SESSION['tipoPerfil'] == 1){
					if ($_SESSION['tipoPerfil'] == 0 || $estado != $_SESSION['tipoPerfil']) {
							echo '<li class="desabilitado_li disabled" id="li_nav2">';
						    echo '<a class="desabilitado_a disabled" id="a_nav2" data-toggle="dropdown" href="#">Cursos <span class="caret"></span></a>';
						} else {
							echo '<li class="" id="li_nav2">';
						 	echo '<a class="" id="a_nav2" data-toggle="dropdown" href="#">Cursos <span class="caret"></span></a>';
						}
						echo '<ul class="dropdown-menu">
			                <li><a href="#" data-toggle="modal" data-target="#modalCursos" onclick="activarAgregarCursos()">Agregar</a></li>
			                <li><a href="#" data-toggle="modal" data-target="#modalCursos" onclick="activarModificarCursos()">Modificar</a></li>
			                <li><a href="#" data-toggle="modal" data-target="#modalCursos" onclick="activarEliminarCursos()">Eliminar</a></li>
			              </ul>
			            </li>';}?>

				<?php if($_SESSION['tipoPerfil'] == 0 || $_SESSION['tipoPerfil'] == 1){
					if ($_SESSION['tipoPerfil'] == 0 || $estado != $_SESSION['tipoPerfil']) {
							echo '<li class="desabilitado_li disabled" id="li_nav3">';
						    echo '<a class="desabilitado_a disabled" id="a_nav3" data-toggle="dropdown" href="#">Grupos <span class="caret"></span></a>';
						} else {
							echo '<li class="" id="li_nav3">';
						 	echo '<a class="" id="a_nav3" data-toggle="dropdown" href="#">Grupos <span class="caret"></span></a>';
						}
						echo'<ul class="dropdown-menu">
						          <li><a id="a-Agregar" href="#" data-toggle="modal" data-target="#modalGrupos" onclick="activarAgregarGrupos()">Agregar</a></li>
						          <li><a id="a-Modificar" href="#" data-toggle="modal" data-target="#modalGrupos" onclick="activarModificarGrupos()">Modificar</a></li>
						          <li><a id="a-Eliminar" href="#" data-toggle="modal" data-target="#modalGrupos" onclick="activarEliminarGrupos()">Eliminar</a></li>
					          </ul>
						      </li>';}?>

			 <?php if(true){
			 	if ($_SESSION['tipoPerfil'] == 0 || $estado != $_SESSION['tipoPerfil']) {
							echo '<li class="desabilitado_li disabled" id="li_nav4">';
						    echo '<a class="desabilitado_a disabled" id="a_nav4" data-toggle="dropdown" href="#">Proyectos <span class="caret"></span></a>';
						} else {
							echo '<li class="" id="li_nav4">';
						 	echo '<a class="" id="a_nav4" data-toggle="dropdown" href="#">Proyectos <span class="caret"></span></a>';
						}

					echo '<ul class="dropdown-menu">';
					if ($_SESSION['tipoPerfil'] == 0 || $_SESSION['tipoPerfil'] == 1 || $_SESSION['tipoPerfil'] == 2) {
				    echo '<li><a href="#" data-toggle="modal" data-target="#modalProyectos" onclick="activarAgregarProyecto()">Agregar</a></li>
				          <li><a  href="#" data-toggle="modal" data-target="#modalProyectos" onclick="activarModificarProyecto()">Modificar</a></li>
				          <li><a href="#" data-toggle="modal" data-target="#modalProyectos" onclick="activarEliminarProyecto()">Eliminar</a></li>
				          <li class="divider"></li>';
				    }
				    if ($_SESSION['tipoPerfil'] == 0 || $_SESSION['tipoPerfil'] == 2)
				    {
				    echo '<li><a href="#" data-toggle="modal" data-target="#modalProyectosPresupuesto" onclick="activarAgregarProyectoPresupuesto()">Asignar presupuesto a proyecto</a></li>

				        <li><a href="#" data-toggle="modal" data-target="#modalProyectosPresupuesto" onclick="activarEliminarProyectoPresupuesto()">Remover presupuesto de proyecto</a></li>';
				      }
				    echo'</ul>
				      </li>';}?>

			<?php if($_SESSION['tipoPerfil'] == 0 || $_SESSION['tipoPerfil'] == 2){
				if ($_SESSION['tipoPerfil'] == 0 || $estado != $_SESSION['tipoPerfil']) {
				echo '<li class="desabilitado_li disabled" id="li_nav5">
			          <a class="desabilitado_a disabled" id="a_nav5" data-toggle="dropdown" href="#">Presup. <span class="caret"></span></a>';
				} else {
					echo '<li class="" id="li_nav5">
			          <a class="" id="a_nav5" data-toggle="dropdown" href="#">Presup. <span class="caret"></span></a>';
				}
					echo '
			          <ul class="dropdown-menu">
			            <li><a href="#" href="#" data-toggle="modal" data-target="#modalPresupuesto" onclick="activarAgregarPresupuesto()">Agregar</a></li>
			            <li><a href="#" href="#" data-toggle="modal" data-target="#modalPresupuesto" onclick="activarModificarPresupuesto()">Modificar</a></li>
			            <li><a href="#" href="#" data-toggle="modal" data-target="#modalPresupuesto" onclick="activarEliminarPresupuesto()">Eliminar</a></li>
			          </ul>
			        </li>';}?>

						<li class="dropdown" id="">
			              <a class="dropdown-toggle" data-toggle="dropdown" id="a_nav6" href="#">Reportes <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			              <?php
			              	if($_SESSION['tipoPerfil'] == 0){
			              		echo '
			                	<li><a href="reportes/reporteUsuarios.php" target="_blank">Reporte de usuarios</a></li>
			                	<li role="separator" class="divider"></li>';
			              	}
			               ?>
			                <li><a href="" data-toggle="modal" data-target="#modalReporteSeleccionar" onclick="activarModalReportesDocentes();">Reporte individual de docentes</a></li>

			                <li><a href="reportes/reporteDocentes.php" target="_blank">Reporte general de docentes</a></li>

			                <li><a href="reportes/reporteDocentePermiso.php" target="_blank">Reporte de docentes con permisos temporales</a></li>

			                <li><a href="reportes/reporteDocenteAdministrativo.php" target="_blank">Reporte de docentes administrativos</a></li>

			                <li role="separator" class="divider"></li>

			                <li><a href="" data-toggle="modal" data-target="#modalReporteSeleccionar" onclick="activarModalReportesProyectos();">Reporte individual de proyectos</a></li>

			                <li><a href="reportes/reporteProyectos.php" target="_blank">Reporte general de proyectos</a></li>

			                <li role="separator" class="divider"></li>

			                <li><a href="" data-toggle="modal" data-target="#modalReporteSeleccionar" onclick="activarModalReportesPresupuestos();">Reporte individual de presupuesto</a></li>

			                <li><a href="reportes/reportePresupuestos.php" target="_blank">Reporte general de presupuestos</a></li>

			                <li role="separator" class="divider"></li>

			                <li><a href="" data-toggle="modal" data-target="#modalReporteSeleccionar" onclick="activarModalReportesGrupos();">Reporte individual de grupos</a></li>

			                <li><a href="reportes/reporteEducacionGeneral.php" target="_blank">Reporte general de grupos</a></li>
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
<?php require("include/tabla.php"); ?>

<!--************* Aside ********************-->
<?php require("include/asides.php"); ?>


	</main>

<!-- //////// Footer /////////////////////////////////////////////////////////// -->
	<footer class="footer" >
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

<!--/////////////////////////////////  Modal de Usuarios/////////////////////////////////////-->

	<?php require("include/modalUsuarios.php"); ?>
	<?php require("include/modalUsuariosBorrar.php"); ?>
	<?php
		if ($_SESSION['tipoPerfil'] == 0) {
			require("include/modalActivarUsuarios.php");
		}
	?>

<!--/////////////////////////////////  Modal de Mensajes/////////////////////////////////////-->
	<?php require("include/modalMensajes.php"); ?>

<!--/////////////////////////////////  Modal de BD//////////////////////////////////-->
	<?php require("include/modalConfirmacion.php"); ?>

<!--/////////////////////////////////  Modal de BD/////////////////////////////////-->
	<?php require("include/modalImportarDB.php"); ?>

<!--/////////////////////////////////  Modal de Docentes ///////////////////////////-->
	<?php require("include/modalDocentes.php"); ?>

<!--/////////////////////////////////  Modal de Docentes con Permisos //////////////-->
	<?php require("include/modalDocentesConPermisos.php"); ?>

<!--/////////////////////////////////  Modal de Docentes Administrativo //////////////-->
<?php require("include/modalDocenteAdministrativo.php"); ?>

<!--////////////////////////////////////// Modal de Proyectos ////////////////////////-->
	<?php require("include/modalProyectos.php"); ?>

<!--////////////////////////////////////// Modal de Grupos ////////////////////////-->
	<?php require("include/modalGrupos.php"); ?>

<!--////////////////////////////////////// Modal de Alertas ////////////////////////-->
	<?php require("include/modalAlertas.php"); ?>

<!--////////////////////////////////////// Modal de Alertas Revisiones ////////////-->
	<?php require("include/modalAlertaRevisiones.php"); ?>

<!--////////////////////////////////////// Modal de Alertas Revisiones ////////////-->
	<?php require("include/modalAlertaRevisionesRechasar.php"); ?>

<!--/////////////////////////////////  Modal de Cursos ////////////////////////////-->
	<?php require("include/modalCursos.php"); ?>

<!--/////////////  Modal de Asignación de presupuesto a grupos /////////////////////-->
	<?php require("include/modalAsignarPresupuesto.php"); ?>

<!--/////////////////////////////////  Modal de Presupuestos ///////////////////////-->
	<?php require("include/modalProyectosPresupuesto.php"); ?>

<!--/////////////////////////////// PARA REPORTES //////////////////////////////////-->
<!--/////  Modal de Grupo //////////-->
<?php require("include/modalesReportes/modalSeleccionar.php"); ?>

<!--/////////////////////////////////  Modal de Presupuestos ///////////////////////-->
	<?php require("include/modalPresupuesto.php"); ?>


</body>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/planillas.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>

<?php
/////////////// MODAL USUARIOS /////////////
	if ($_GET['modalUsuarios'] == 1) {
		echo "<script>
		$('#modalRegistro').modal('show');
		</script>";
	}
?>

<?php
 /////////////// MODAL DOCENTES /////////////
 	if ($_GET['modalDocentes'] == 1) {
 		echo "<script>
 		$('#modalDocentes').modal('show');

 		</script>";
 	}
?>

<?php
 /////////////// MODAL DOCENTES CON PERMISOS /////////////
 	if ($_GET['modalDocentesConPermisos'] == 1) {
 		echo "<script>
 		$('#modalDocentesConPermisos').modal('show');

 		</script>";
 	}
?>

<?php
 /////////////// MODAL DOCENTES ADMINISTRATIVO /////////////
 	if ($_GET['modalDocenteAdministrativo'] == 1) {
 		echo "<script>
 		$('#modalDocentesAdministrativo').modal('show');

 		</script>";
 	}
?>

<?php
/////////////// MODAL CURSOS /////////////
	if ($_GET['modalCursos'] == 1) {
		echo "<script>
		$('#modalCursos').modal('show');
		</script>";
	}
?>

<?php
/////////////// MODAL GRUPOS /////////////
	if ($_GET['modalGrupos'] == 1) {
		echo "<script>
		$('#a-Agregar').click();
		</script>";
	}
	if ($_GET['modalGrupos'] == 2) {
		echo "<script>
		$('#a-Modificar').click();
		</script>";
	}
	if ($_GET['modalGrupos'] == 3) {
		echo "<script>
		$('#a-Eliminar').click();
		</script>";
	}
?>

<?php
/////////////// MODAL PROYECTOS /////////////
	if ($_GET['modalProyectos'] == 1) {
		echo "<script>
		$('#modalProyectos').modal('show');
		</script>";
	}
?>

<?php
/////////////// MODAL PROYECTOS PRESUPUESTOS ///////
	if ($_GET['modalProyectosPresupuesto'] == 1) {
		echo "<script>
		$('#modalProyectosPresupuesto').modal('show');
		</script>";
	}
?>

<?php
/////////////// MODAL GRUPOS PRESUPUESTOS ///////
	if ($_GET['modalAsignarPresup'] == 1) {
		echo "<script>
		$('#modalAsignarPresupuesto').modal('show');
		activarAsignarPresup();
		</script>";
	}
	if ($_GET['modalAsignarPresup'] == 2) {
		echo "<script>
		$('#modalAsignarPresupuesto').modal('show');
		eliminarAsignarPresup();
		</script>";
	}
?>

<?php
/////////////// MODAL PRESUPUESTO /////////////
	if ($_GET['modalPresupuesto'] == 1) {
		echo "<script>
		$('#modalPresupuesto').modal('show')
		</script>";
	}
?>

<?php
	if ($_SESSION['registrando'] == 1) {
		echo "<script>
		$('#modalRegistro').modal('show');
		</script>";
	}
?>

<?php
/////////////// ALERTAS ///////////
	if ($_SESSION['alerta'] == 1 || $_SESSION['alerta'] == 2 || $_SESSION['alerta'] == 3) {
		echo "<script>
		$('#modalAlertas').modal('show');
		</script>";
		$_SESSION['alerta'] = 0;
	}
?>


<?php
/////////////// Confirmacion ///////////
	if ($_GET['modalConfirmacion'] == 1) {
		echo "<script>
		$('#modalConfirmacion').modal('show');
		</script>";
		$_SESSION['alerta'] = 0;
	}
?>
</html>


<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
