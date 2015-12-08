<?php include_once("conexionBD/registroActividadBD.php"); ?>
<?php $dbRegistro = new registroActividadBD(); ?>
<?php include_once("conexionBD/usuariosBD.php"); ?>
<?php $dbUsuarios = new usuariosBD(); ?>
<?php include_once("conexionBD/mensajesBD.php"); ?>
<?php $dbMensajes = new mensajesBD(); ?>

<?php $resultadoRegistro = $dbRegistro->obtenerRegistroActividad(); ?>

<div class="container container-aside">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="aside col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-sx-12">
				<h4>Últimos cambios</h4>
				<div class="separador-horizontal"></div>
				<div class="table table-responsive">
					<table class="table table-striped">
						<?php
							while ($fila = mysqli_fetch_assoc($resultadoRegistro)) {
								echo "<tr><td>";
								$resultadoUsuarios = $dbUsuarios->obtenerUsuario($fila['usuario']);
								echo "<p>";
								while ($fila2 = mysqli_fetch_assoc($resultadoUsuarios)) {
									echo $fila2['nombre_usuario']." ";
									echo $fila2['apellido_usuario']."<br/>";
								}
								echo "Fecha: ".$fila['fecha']."<br/>";
								echo "</p>";
								echo $fila['descripcion'];
								echo "<td><tr>";
							}
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="aside col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-sx-12">
				<h4>Mensajes</h4>
				<div class="separador-horizontal"></div>
				<div class="table table-responsive">
					<table class="table table-striped">
						<?php
							$contador = 0;
							$resultadoMensajes = $dbMensajes->obtenerMensajes($_SESSION['usuario']);
							while ($fila3 = mysqli_fetch_assoc($resultadoMensajes)) {
								echo "<tr><td>";

								if ($contador == 0) {
									echo "<p style='color:blue;'>";
								} else {
									echo "<p>";
								}

								echo $fila3['emisor']."<br/>";
								echo "Fecha: ".$fila3['fecha']."<br/>";
								echo "</p>";
								$contador =1;

								echo $fila3['contenido_mensaje'];
								echo "<td><tr>";
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
