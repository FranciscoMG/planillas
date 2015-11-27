<?php include_once("include/conversor.php"); ?>
<?php include_once("conexionBD/cursosBD.php"); ?>
<?php $dbCursos = new cursosBD(); ?>
	<div class="container" id="contenedor-tabla">

			<a onclick="cambiarTableHorizontal()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-horizontal"class="glyphicon glyphicon-resize-full"  ></span></a>

			<a onclick="cambiarTableVertical()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-vertical"class="glyphicon glyphicon-menu-up"  ></span></a>

			<div class="contenedor-tabla-2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tabla table-responsive contenedor-tabla-1" id="tabla-planillas">
					<table id="example" class="display table table-hover text-center" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="th_style">Sigla</th>
								<th class="th_style">Nombre</th>
								<th class="th_style">Jornada</th>
								<th class="th_style">Créditos</th>
								<th class="th_style">Grupo</th>
								<th class="th_style">Horario</th>
								<th class="th_style">Docente</th>
								<th class="th_style">PO 1050</th>
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

						$resultadoCursos = $dbCursos->obtenerCursos();

						while ($fila = mysqli_fetch_assoc($resultadoCursos)) {
							echo "<tr class='tr_style' >";
								echo "<td>".$fila['sigla']."</td>";
								echo "<td>".$fila['nombre_curso']."</td>";
								echo "<td>".convertirDobleFraciones ($fila['jornada'])."</td>";
								echo "<td>".$fila['creditos']."</td>";
								echo "<td>Datos ".$cantidad."</td>";
								echo "<td>Datos ".$cantidad."</td>";
								echo "<td>Datos ".$cantidad."</td>";
								echo "<td>Datos ".$cantidad."</td>";
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
