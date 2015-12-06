<?php include_once("conexionBD/proyectosBD.php"); ?>
<?php include_once("conexionBD/docentesBD.php"); ?>
<?php include_once("conexionBD/presupuestoBD.php"); ?>

<?php $dbPresupuesto = new presupuestoBD() ?>
<?php $db = new proyectosBD(); ?>
<?php $dbDocentes = new docentesBD(); ?>
<?php
  session_start();
?>

<div id="modalProyectosPresupuesto" class="modal fade" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content ">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="masterPage.php">&times;</a>
				<h4 class="modal-title">Asignación de presupuesto a proyectos</h4>
			</div>
      <!-- Body -->
			<form action="proyectos/gestorProyectosAsignarPresupuesto.php" method="post">
				<div class="modal-body">
					<div class="col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtNombre">Nombre del proyecto:</label>
          </div>

          <div id="proyectoEliminarModificar2" class="col-xs-12 col-sm-12 col-lg-12">
            <select id="selectEliminarProyecto2" class="form-control" name="cboxIDProyecto2" onchange="<?php if ($_GET["eliminadoPresupuestoProyecto"] == "") {echo "cargarDatosProyectoPresupuestoAgregar(this)";} else {echo "cargarDatosProyectoPresupuestoEliminar(this)";} ?>">

             <?php
              if (isset($_GET['modalProyectosPresupuesto'])) {
                if ($_GET['id_proyecto'] != 1) {
                echo "<option value='".$_GET['id_proyecto']."'>".$_GET['nombre_proyecto']."</option>";
                }
              } else {
               echo "<option></option>";
              }
              $resultado = $db->obtenerProyecto();
              while ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['id_proyecto'] != 1) {
                echo "<option value='".$fila['id_proyecto']."'>".$fila['nombre_proyecto']."</option>";
              }
              }
               ?>

            </select>
          </div>
        <div id="seccionEliminarProyecto2">
          
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTipo_proyecto2">Tipo de proyecto:</label>
            <select class="form-control" name="cboTipo_proyecto2" disabled>
            <?php
            if (isset($_GET['modalProyectosPresupuesto'])) {
              if ($_GET['tipo_proyecto'] == 0) {
                echo "<option value='".$_GET['tipo_proyecto']."'>Acción Social</option>";
                echo "<option value='1'>Investigación</option>";
              } else {
                echo "<option value='".$_GET['tipo_proyecto']."'>Investigación</option>";
                echo "<option value='0'>Acción Social</option>";
            }
            }
             ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTiemposProyecto2">Jornada:</label>
            <select class="form-control disabled" name="cboTiemposProyecto2" >
              <?php
                if (isset($_GET['modalProyectosPresupuesto'])) {
                  echo "<option value='".$_GET['jornada_proyecto']."'>".$_GET['jornada_proyecto']."</option>";
                }
              ?>
	           </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboxPrimario2">Principal/Responsable:</label>
            <select class="form-control" name="cboxPrimario2" >
              <?php
              if (isset($_GET['modalProyectosPresupuesto'])) {
                $resultado2 = $dbDocentes->obtenerUnDocente($_GET['fk_encargado']);
                  while ($fila = mysqli_fetch_assoc($resultado2)) {
                    if ($fila['nombre'] != "1") {
                    echo "<option value='".$_GET['fk_encargado']."'>".$fila['nombre']." ".$fila['apellidos']."</option>";
                    }
                  }
                }
               ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboSecundario">Asociado/Colaborador:</label>
            <select class="form-control" name="cboSecundario" >
              <?php
              if (isset($_GET['modalProyectosPresupuesto'])) {
                $resultado2 = $dbDocentes->obtenerUnDocente($_GET['fk_ayudante']);
                  while ($fila = mysqli_fetch_assoc($resultado2)) {
                    if ($fila['nombre'] != "1") {
                    echo "<option value='".$fila['cedula']."'>".$fila['nombre']." ".$fila['apellidos']."</option>";
                  }
                }
                }
               ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboxPresupuesto2">Presupuesto:</label>
            <select class="form-control" name="cboxPresupuesto2" >
              <?php
              if (isset($_GET['modalProyectosPresupuesto'])) {
                $resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
                 while ($fila = mysqli_fetch_assoc($resultado3)) {
                   echo "<option value='".$fila['id_presupuesto']."'>";
                    echo $fila['nombre_presupuesto'];
                   echo "</option>";
                 }
                }
               ?>
            </select>
          </div>
          </div>
        </div>
        <br><br><br>
        <!-- Mensaje -->
        <!-- Footer -->
				<div class="modal-footer modal-delete-border">
         
           <div id='proyectosBtnEliminar2' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 <?php if ($_GET["eliminadoPresupuestoProyecto"] == "") {echo "hide";} ?>' style='padding-bottom:15px;'>
             
             <button name='btnEliminarProyectoPresupuesto' type='submit' class='btn btn-danger btn-revision btn-block' >Eliminar</button>
             
            </div>
          <br/>
            
				  <div id="proyectosBtnAgregar2" class="col-xs-12 col-sm-12 col-lg-12 <?php if ($_GET["agregandoPresupuestoProyecto"] == "") {echo "hide";} ?>">
					  
            <button name="proyectosBtnAgregarPresupuesto" type="submit" class="btn btn-primary btn-block"  >Agregar</button>

					</div>
				</div>
			</form>
		</div>

	</div>
</div>
