<?php include_once("include/conversor.php"); ?>
<?php include_once("conexionBD/cursosBD.php"); ?>
<?php include_once("conexionBD/gruposBD.php"); ?>
<?php include_once("conexionBD/presupuestoBD.php"); ?>

<?php
	$dbCursos = new cursosBD();
	$dbGrupos = new gruposBD();
	$dbPresupuesto = new presupuestoBD();
?>

<div class="container" id="contenedor-tabla">
	<a onclick="cambiarTableHorizontal()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-horizontal"class="glyphicon glyphicon-resize-full"  ></span></a>
	<a onclick="cambiarTableVertical()" class="btn btn-lg pull-right"><span id="boton-tamano-tabla-vertical"class="glyphicon glyphicon-menu-up"  ></span></a>
	<div class="contenedor-tabla-2 col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="row">
			<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4 form-inline">
				<div class="form-group">
					<label for="sel1">Carrera:</label>
						<select class="form-control input-sm" id="sel1" onchange="cargarCboxPorCarrera(this)">
							<?php
								$resultadoCarreras = $dbCursos->obtenerCarreras();

								if ($_GET['cargarPorCarrera'] != "") {
									echo "<option >".$_GET['valorPorCarreraTexto']."</option>";
								} else {
								}
								if ($_GET['valorPorCarreraTexto'] != 'Todo') {
									echo " <option value='all'>Todo</option>";
								}
							?>
							<?php
							  while ($fila = mysqli_fetch_assoc($resultadoCarreras)) {
									if ($fila['nombre_carrera'] != $_GET['valorPorCarreraTexto'] && $fila['id_carrera'] != 1) {
								  	echo "<option value='".$fila['id_carrera']."'>";
								  	echo $fila['nombre_carrera'];
								  	echo "</option>";
								  }
								}
							?>
						</select>
				</div>
			</div>
		</div>
		<div class="tabla table-responsive contenedor-tabla-1" id="tabla-planillas">
			<br/>
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
						<th class="th_style">Presupuesto</th>
						<?php
							if ($_SESSION['tipoPerfil'] == 2 || $_SESSION['tipoPerfil'] == 0) {
								echo '<th class="no-sort"></th>';
							}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						$d=0;
						$h=0;
						$dD=0;
						$hD=0;
						$sumaTiempos=0;
						unset($docentes, $horarioCurso, $docentesDoble, $horarioCursoDoble);
						$resultadoGrupos = $dbGrupos->llenarTabla($_GET['cargarPorCarrera']);
						while ($fila = mysqli_fetch_assoc($resultadoGrupos)) {
							if ($fila['fk_carrera'] == $carrera && $fila['fk_curso'] == $curso && $fila['num_grupo'] == $num_grupo && $fila['num_grupo_doble'] == $num_grupo_doble) {
					      $carrera= $fila['fk_carrera'];
					      $curso= $fila['fk_curso'];
								$nombre_curso= $fila['nombre_curso'];
								$creditos= $fila['creditos'];
					      $num_grupo= $fila['num_grupo'];
					      $num_grupo_doble= $fila['num_grupo_doble'];
					      if ($fila['profesorDoble']) {
					        $docentesDoble[$dD][0]= $fila['nombre']." ".$fila['apellidos'];
					        $docentesDoble[$dD][1]= convertirDobleFraciones($fila['tiempo_individual']);
									$docentesDoble[$dD][2]= $fila['fk_docente'];
					        $dD++;
					        $horarioCursoDoble[$hD][0]= convertirIntDiaSemana($fila['dia_semana']);
					        $horarioCursoDoble[$hD][1]= $fila['hora_inicio'];
									$horarioCursoDoble[$hD][2]= $fila['hora_fin'];
					        $hD++;
					      } else {
					        $docentes[$d][0]= $fila['nombre']." ".$fila['apellidos'];
					        $docentes[$d][1]= convertirDobleFraciones($fila['tiempo_individual']);
									$docentes[$d][2]= $fila['fk_docente'];
					        $d++;
					        $horarioCurso[$h][0]= convertirIntDiaSemana($fila['dia_semana']);
					        $horarioCurso[$h][1]= $fila['hora_inicio'];
									$horarioCurso[$h][2]= $fila['hora_fin'];
					        $h++;
					      }
								$jornada= convertirDobleFraciones($fila['jornada']);
								$id_presupuesto= $fila['fk_presupuesto'];
								$nombre_presupuesto= $fila['nombre_presupuesto'];
					    } else {
								if (count($docentes) > 0) {
									$docentes= array_values(array_unique($docentes, SORT_REGULAR));
									$horarioCurso= array_values(array_unique($horarioCurso, SORT_REGULAR));
									$docentesDoble= array_values(array_unique($docentesDoble, SORT_REGULAR));
									$horarioCursoDoble= array_values(array_unique($horarioCursoDoble, SORT_REGULAR));
									echo "<tr class='tr_style'>";
									echo "<td>".$curso."</td>";
									echo "<td>".$nombre_curso."</td>";
									echo "<td>".$jornada."</td>";
									echo "<td>".$creditos."</td>";
									echo "<td><div class='gruposDiv'>".$num_grupo."</div>";
									if ($num_grupo_doble != 0) {
										echo "<div class='gruposDiv'>".$num_grupo_doble."</div>";
									}
									echo "</td>";
									echo "<td>";
									echo "<div class='horariosDiv'>";
									for ($i=0; $i < count($horarioCurso) ; $i++) {
										echo $horarioCurso[$i][0]." ".substr($horarioCurso[$i][1],0,5)." - ".substr($horarioCurso[$i][2],0,5)."</br></br>";
									}
									echo "</div>";
									if ($num_grupo_doble != 0) {
										echo "<div class='horariosDiv'>";
										for ($i=0; $i < count($horarioCursoDoble) ; $i++) {
											echo $horarioCursoDoble[$i][0]." ".substr($horarioCursoDoble[$i][1],0,5)." - ".substr($horarioCursoDoble[$i][2],0,5)."</br></br>";
										}
										echo "</div>";
									}
									echo "</td>";
									echo "<td>";
									echo "<div class='docentesDiv'>";
									for ($i=0; $i < count($docentes) ; $i++) {
										echo $docentes[$i][0]." - ".$docentes[$i][1]." <a target='_blank' href='reportes/reporteDocenteIndividual.php?docente=".$docentes[$i][2]."'><span class='glyphicon glyphicon-share-alt'></span></a><br/><br/>";
										$sumaTiempos+=convertirFraccionesDoble($docentes[$i][1]);
									}
									echo "</div>";
									if ($num_grupo_doble != 0) {
										echo "<div class='docentesDiv'>";
										for ($i=0; $i < count($docentesDoble) ; $i++) {
											echo $docentesDoble[$i][0]." - ".$docentesDoble[$i][1]." <a target='_blank' href='reportes/reporteDocenteIndividual.php?docente=".$docentesDoble[$i][2]."'><span class='glyphicon glyphicon-share-alt'></span></a><br/><br/>";
											$sumaTiempos+=convertirFraccionesDoble($docentesDoble[$i][1]);
										}
										echo "</div>";
									}
									echo "</td>";
									echo "<td>";
									if ($id_presupuesto == 1) {
										echo "Sin asignar";
									} else {
										echo $nombre_presupuesto." "."<a href='reportes/reportePresupuestoIndividual.php?id_presupuesto=".$id_presupuesto."' target='_blank'><span class='glyphicon glyphicon-share-alt'></span></a>";
									}
									echo "</td>";
									if ($_SESSION['tipoPerfil'] == 2 || $_SESSION['tipoPerfil'] == 0) {
										if ($id_presupuesto == 1) {
											echo "<td><a class='btn btn-default";
											if(!($estado == $_SESSION['tipoPerfil'])) {
												echo " disabled";
											}
											echo "' href='masterPage.php?modalAsignarPresup=1&carrera=".$carrera."&curso=".$curso."&num_grupo=".$num_grupo."&num_grupo_doble=".$num_grupo_doble."&total_tiempos=".$sumaTiempos."'>Agregar presup...</a></td>";
										} else {
											echo "<td><a class='btn btn-default";
											if(!($estado == $_SESSION['tipoPerfil'])) {
												echo " disabled";
											}
											echo "' href='masterPage.php?modalAsignarPresup=2&carrera=".$carrera."&curso=".$curso."&num_grupo=".$num_grupo."&num_grupo_doble=".$num_grupo_doble."&total_tiempos=".$sumaTiempos."&id_presupuesto=".$id_presupuesto."'>Eliminar presup...</a></td>";
										}
									}
									echo "</tr>";
								}
								$d=0;
								$h=0;
								$dD=0;
								$hD=0;
								$sumaTiempos=0;
								unset($docentes, $horarioCurso, $docentesDoble, $horarioCursoDoble);
								$carrera= $fila['fk_carrera'];
					      $curso= $fila['fk_curso'];
								$nombre_curso= $fila['nombre_curso'];
								$creditos= $fila['creditos'];
					      $num_grupo= $fila['num_grupo'];
					      $num_grupo_doble= $fila['num_grupo_doble'];
								if ($fila['profesorDoble']) {
									$docentesDoble[$dD][0]= $fila['nombre']." ".$fila['apellidos'];
									$docentesDoble[$dD][1]= convertirDobleFraciones($fila['tiempo_individual']);
									$docentesDoble[$dD][2]= $fila['fk_docente'];
									$dD++;
									$horarioCursoDoble[$hD][0]= convertirIntDiaSemana($fila['dia_semana']);
									$horarioCursoDoble[$hD][1]= $fila['hora_inicio'];
									$horarioCursoDoble[$hD][2]= $fila['hora_fin'];
									$hD++;
								} else {
									$docentes[$d][0]= $fila['nombre']." ".$fila['apellidos'];
									$docentes[$d][1]= convertirDobleFraciones($fila['tiempo_individual']);
									$docentes[$d][2]= $fila['fk_docente'];
									$d++;
									$horarioCurso[$h][0]= convertirIntDiaSemana($fila['dia_semana']);
									$horarioCurso[$h][1]= $fila['hora_inicio'];
									$horarioCurso[$h][2]= $fila['hora_fin'];
									$h++;
								}
								$jornada= convertirDobleFraciones($fila['jornada']);
								$id_presupuesto= $fila['fk_presupuesto'];
								$nombre_presupuesto= $fila['nombre_presupuesto'];
							}
					  }
						if (count($docentes) > 0) {
							$docentes= array_values(array_unique($docentes, SORT_REGULAR));
							$horarioCurso= array_values(array_unique($horarioCurso, SORT_REGULAR));
							$docentesDoble= array_values(array_unique($docentesDoble, SORT_REGULAR));
							$horarioCursoDoble= array_values(array_unique($horarioCursoDoble, SORT_REGULAR));
							echo "<tr class='tr_style'>";
							echo "<td>".$curso."</td>";
							echo "<td>".$nombre_curso."</td>";
							echo "<td>".$jornada."</td>";
							echo "<td>".$creditos."</td>";
							echo "<td><div class='gruposDiv'>".$num_grupo."</div>";
							if ($num_grupo_doble != 0) {
								echo "<div class='gruposDiv'>".$num_grupo_doble."</div>";
							}
							echo "</td>";
							echo "<td>";
							echo "<div class='horariosDiv'>";
							for ($i=0; $i < count($horarioCurso) ; $i++) {
								echo $horarioCurso[$i][0]." ".substr($horarioCurso[$i][1],0,5)." - ".substr($horarioCurso[$i][2],0,5)."</br></br>";
							}
							echo "</div>";
							if ($num_grupo_doble != 0) {
								echo "<div class='horariosDiv'>";
								for ($i=0; $i < count($horarioCursoDoble) ; $i++) {
									echo $horarioCursoDoble[$i][0]." ".substr($horarioCursoDoble[$i][1],0,5)." - ".substr($horarioCursoDoble[$i][2],0,5)."</br></br>";
								}
								echo "</div>";
							}
							echo "</td>";
							echo "<td>";
							echo "<div class='docentesDiv'>";
							for ($i=0; $i < count($docentes) ; $i++) {
								$sumaTiempos+=convertirFraccionesDoble($docentes[$i][1]);
								echo $docentes[$i][0]." - ".$docentes[$i][1]." <a target='_blank' href='reportes/reporteDocenteIndividual.php?docente=".$docentes[$i][2]."'><span class='glyphicon glyphicon-share-alt'></span></a><br/><br/>";
							}
							echo "</div>";
							if ($num_grupo_doble != 0) {
								echo "<div class='docentesDiv'>";
								for ($i=0; $i < count($docentesDoble) ; $i++) {
									$sumaTiempos+=convertirFraccionesDoble($docentesDoble[$i][1]);
									echo $docentesDoble[$i][0]." - ".$docentesDoble[$i][1]." <a target='_blank' href='reportes/reporteDocenteIndividual.php?docente=".$docentesDoble[$i][2]."'><span class='glyphicon glyphicon-share-alt'></span></a><br/><br/>";
								}
								echo "</div>";
							}
							echo "</td>";
							echo "<td>";
							if ($id_presupuesto == 1) {
								echo "Sin asignar";
							} else {
								echo $nombre_presupuesto." "."<a href='reportes/reportePresupuestoIndividual.php?id_presupuesto=".$id_presupuesto."' target='_blank'><span class='glyphicon glyphicon-share-alt'></span></a>";
							}
							echo "</td>";
							if ($_SESSION['tipoPerfil'] == 2 || $_SESSION['tipoPerfil'] == 0) {
								if ($id_presupuesto == 1) {
									echo "<td><a class='btn btn-default";
									if(!($estado == $_SESSION['tipoPerfil'])) {
										echo " disabled";
									}
									echo "' href='masterPage.php?modalAsignarPresup=1&carrera=".$carrera."&curso=".$curso."&num_grupo=".$num_grupo."&num_grupo_doble=".$num_grupo_doble."&total_tiempos=".$sumaTiempos."'>Agregar presup...</a></td>";
								} else {
									echo "<td><a class='btn btn-default";
									if(!($estado == $_SESSION['tipoPerfil'])) {
										echo " disabled";
									}
									echo "' href='masterPage.php?modalAsignarPresup=2&carrera=".$carrera."&curso=".$curso."&num_grupo=".$num_grupo."&num_grupo_doble=".$num_grupo_doble."&total_tiempos=".$sumaTiempos."&id_presupuesto=".$id_presupuesto."'>Eliminar presup...</a></td>";
								}
							}
							echo "</tr>";
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
							echo '<a class="btn btn-success btn-sm pull-right " data-toggle="modal" data-target="#modalAlertaRevisiones">Aprobar</a>';
						} else {
							echo '<a class="btn btn-success btn-sm pull-right disabled" data-toggle="modal" data-target="#modalAlertaRevisiones">Aprobar</a>';
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
					echo '<a class="btn btn-danger btn-sm pull-right btn-revision " data-toggle="modal" data-target="#modalAlertaRevisionesRechasar">Rechazar datos</a>';
					} else {
						echo '<a class="btn btn-danger btn-sm pull-right btn-revision disabled" data-toggle="modal" data-target="#modalAlertaRevisionesRechasar">Rechazar datos</a>';
					}
				}
			?>
		</div>
		<br>
	</div>
</div>
