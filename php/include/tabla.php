<?php include_once("include/conversor.php"); ?>
<?php include_once("conexionBD/cursosBD.php"); ?>
<?php include_once("conexionBD/gruposBD.php"); ?>

<?php $dbGrupos = new gruposBD(); ?>

<?php $dbCursos = new cursosBD(); ?>

	<div class="container" id="contenedor-tabla">

			<a onclick="cambiarTableHorizontal()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-horizontal"class="glyphicon glyphicon-resize-full"  ></span></a>

			<a onclick="cambiarTableVertical()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-vertical"class="glyphicon glyphicon-menu-up"  ></span></a>

			<div class="contenedor-tabla-2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row ">
					<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4 form-inline">
						<div class="form-group">
							  <label for="sel1">Carrera:</label>
							  <select class="form-control input-sm" id="sel1" onchange="cargarCboxPorCarrera(this)">
								<?php 
							 	 $resultadoGrupos = $dbGrupos->obtenerCarrera();

								if ($_GET['cargarPorCarrera'] != "") {
									echo "<option >".$_GET['valorPorCarreraTexto']."</option>";
								} else {
								}
								if ($_GET['valorPorCarreraTexto'] != 'Todo') {
									echo " <option value='all'>Todo</option>";
								}

								 ?>


							  <?php 

							  while ($fila = mysqli_fetch_assoc($resultadoGrupos)) {
							  	if ($fila['nombre_Carrera'] != $_GET['valorPorCarreraTexto']) {
							  	echo "<option value='".$fila['id_Carrera']."'>";
							  	echo $fila['nombre_Carrera'];
							  	echo "</option>";
							  	}
							  }
							   ?>
							  </select>
						</div>
						</div>
					</div>
				<div class="tabla table-responsive contenedor-tabla-1" id="tabla-planillas">
						<br>
					<table id="example" class="display table table-hover text-center" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="th_style">Sigla</th>
								<th class="th_style">Nombre</th>
								<th class="th_style">Jornada</th>
								<th class="th_style">Créditos</th>
								<th class="th_style">Grupo</th>
								<th class="th_style"> Horario </th>
								<th class="th_style">Docente</th>
								<th class="th_style">PO 1052</th>
								<th class="th_style">Apoyo Vic Doc..</th>

								<?php 
								if ($_SESSION['tipoPerfil'] == 1 || $_SESSION['tipoPerfil'] == 0) {
									echo '<th class="">Eliminar Grupo</th>';
								}
								if ($_SESSION['tipoPerfil'] == 2 || $_SESSION['tipoPerfil'] == 0) {
									echo '<th class="">Eliminar Presup.</th>';
								}
								 ?>
							</tr>
						</thead>
						<tbody>
						<?php 
						$cantidad=0;

						$resultadoGrupos = $dbGrupos->llenarTabla($_GET['cargarPorCarrera']);

						while ($fila = mysqli_fetch_assoc($resultadoGrupos)) {
							echo "<tr class='tr_style' >";
								echo "<td>".$fila['fk_curso']."</td>";
								echo "<td>".$fila['nombre_curso']."</td>";
								echo "<td>".convertirDobleFraciones ($fila['jornada'])."</td>";
								echo "<td>".$fila['creditos']."</td>";
								echo "<td>".$fila['num_grupo']."</td>";
								echo "<td>".$fila['diaSemana']." ".substr($fila['hora_inicio'], 0,5 )." - ".substr($fila['hora_fin'], 0,5 )."</td>";
								echo "<td>".$fila['nombre']." ".$fila['apellidos']."</td>";
								echo "<td>Datos ".$cantidad."</td>";
								echo "<td>Datos ".$cantidad."</td>";


								if ($_SESSION['tipoPerfil'] == 1 || $_SESSION['tipoPerfil'] == 0) {
									echo "<td> <a class='a_click'>eliminar grupo</a> </td>";
								}
								if ($_SESSION['tipoPerfil'] == 2 || $_SESSION['tipoPerfil'] == 0) {
									echo "<td> <a class='a_click'>eliminar presup.</a> </td>";
								}

							echo "</tr>";
							$cantidad = $cantidad+1;
						}

						 ?>
						</tbody>
					</table>
				</div>
				<br>
				<div class="row">
				<?php 
				if ($revisiones == 1 && $_SESSION['tipoPerfil'] == 0) {
					echo '<a class="btn btn-success btn-sm pull-right " data-toggle="modal" data-target="#modalAlertaRevisiones">Finalizar Proceso</a>';
				} else {
					if ($_SESSION['tipoPerfil'] == 0) {
						if($estado == $_SESSION['tipoPerfil']) {
							echo '<a class="btn btn-success btn-sm pull-right " data-toggle="modal" data-target="#modalAlertaRevisiones">Aprovar</a>';
						} else {
							echo '<a class="btn btn-success btn-sm pull-right disabled" data-toggle="modal" data-target="#modalAlertaRevisiones">Aprovar</a>';
						}
					} else {
						if($estado == $_SESSION['tipoPerfil']) {
						echo '<a class="btn btn-success btn-sm pull-right " data-toggle="modal" data-target="#modalAlertaRevisiones">Enviar a revisión</a>';
						} else {
							echo '<a class="btn btn-success btn-sm pull-right disabled" data-toggle="modal" data-target="#modalAlertaRevisiones">Enviar a revisión</a>';
						}
					}
				}

				if ($_SESSION['tipoPerfil'] == 0) {
					if($estado == $_SESSION['tipoPerfil']) {
					echo '<a class="btn btn-danger btn-sm pull-right btn-revision " data-toggle="modal" data-target="#modalAlertaRevisionesRechasar">Rechasar datos</a>';
					} else {
						echo '<a class="btn btn-danger btn-sm pull-right btn-revision disabled" data-toggle="modal" data-target="#modalAlertaRevisionesRechasar">Rechasar datos</a>';
					}
				}
				?>
				</div>
				<br>
			</div>
		</div>
