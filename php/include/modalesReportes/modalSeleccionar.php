<?php 
session_start();
	if ($_SESSION['masterActivo'] != 1){
	header('Location: ../../sesion/cerrarSesion.php');
	exit();
	} 
?>
	

<?php include_once('../../conexionBD/docentesBD.php'); ?>
<?php include_once('../../conexionBD/proyectosBD.php'); ?>
<?php include_once('../../conexionBD/presupuestoBD.php'); ?>
<?php include_once('../../conexionBD/gruposBD.php'); ?>

<?php 
//////// Seleccionar Docentes ////
	$dbDocentes = new docentesBD();
/////// Seleccionar Proyectos ////
	$dbProyecto = new proyectosBD();
////// Seleccionar Presupuestos ////
	$dbPresupuesto = new presupuestoBD();
////// Seleccionar grupo ////
	$dbGrupo = new gruposBD();
////////////////////////////////////////////////////////////////////////
 ?>

 <div id="modalReporteSeleccionar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title"></h4>
      </div>

      <!-- Docentes ///////////////////////////////////////////////////////////////-->
      <form id="formReporteDocente" action="reportes/reporteDocenteIndividual.php" target="_blank" method="post" class="hide">
        <div class="modal-body">
          <div id="" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPresupuestoGrupo">Selecione un docente:</label>
            <select class="form-control" name="cedula">
              <option value="0"></option>
              <?php
                $resultadoDocentes = $dbDocentes->obtenerDocentes();
                if ($resultadoDocentes == false) {
                	echo "<option>-- No hay docentes -- </option>";
                }
                while ($fila = mysqli_fetch_assoc($resultadoDocentes)) {
                  echo "<option value='".$fila['cedula']."'>";
                  echo $fila['apellidos']." ".$fila['nombre'];
                  echo "</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div id="" class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-primary btn-block"  name="btnAsignarGrupoPresup">Generar reporte</button>
          </div>
        </div>
      </form>

     

      <!-- Proyectos ///////////////////////////////////////////////////////////////-->
      <form id="formReporteProyecto" action="reportes/reporteProyectoIndividual.php" target="_blank" method="post" class="hide">
        <div class="modal-body">
          <div id="" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPresupuestoGrupo">Selecione un proyecto:</label>
            <select class="form-control" name="id_proyecto">
              <option value="0"></option>
              <?php
                $resultadoProyectos = $dbProyecto->obtenerProyecto();
                if ($resultadoProyectos == false) {
                	echo "<option>-- No hay proyectos --</option>";
                }
                while ($fila = mysqli_fetch_assoc($resultadoProyectos)) {
                	if ($fila['id_proyecto'] != 1) {
		                  echo "<option value='".$fila['id_proyecto']."'>";
		                  echo $fila['nombre_proyecto'];
		                  echo "</option>";
                	}
                }
              ?>
            </select>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div id="" class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-primary btn-block" name="btnAsignarGrupoPresup">Generar reporte</button>
          </div>
        </div>
      </form>

       <!-- Presupuesto /////////////////////////////////////////////////////////////////-->
      <form id="formReportePresupuesto" action="reportes/reportePresupuestoIndividual.php" method="post" class="hide" target="_blank">
        <div class="modal-body">
          <div id="" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPresupuestoGrupo">Selecione un presupuesto:</label>
            <select class="form-control" name="id_presupuesto">
              <option value="0"></option>
              <?php
                $resultadoPresupuesto = $dbPresupuesto->obtenerlistadoDePresupuesto();

                while ($fila = mysqli_fetch_assoc($resultadoPresupuesto)) {
                  echo "<option value='".$fila['id_presupuesto']."'>";
                  echo $fila['nombre_presupuesto'];
                  echo "</option>";
                }
              ?>
            </select>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div id="" class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-primary btn-block" name="btnAsignarGrupoPresup">Generar reporte</button>
          </div>
        </div>
      </form>

       <!-- Grupos ///////////////////////////////////////////////////////////////-->
      <form id="formReporteGrupo" action="reportes/reporteGrupos.php" method="post" class="hide" target="_blank">
        <div class="modal-body">
          <div id="" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPresupuestoGrupo">Selecione un grupo:</label>
            <select class="form-control" name="fk_curso">
              <option value="0"></option>
              <?php
                $resultadoGrupos2 = $dbGrupo->obtenerGrupoDocentes();
                if ($resultadoGrupos2 == false) {
                	echo "<option>-- No hay grupos --</option>";
                }
                 while ($fila = mysqli_fetch_assoc($resultadoGrupos2)) {
	                 if ($fila['num_grupo'] != 0) {
	                  echo "<option value='".$fila['fk_curso']."'>";
	                  echo $fila['fk_curso']." G ".$fila['num_grupo'];
	                  echo "</option>";
	                 }
                }
              ?>
            </select>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div id="" class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-primary btn-block" name="btnAsignarGrupoPresup">Generar reporte</button>
          </div>
        </div>
      </form>



    </div>
  </div>
</div>

