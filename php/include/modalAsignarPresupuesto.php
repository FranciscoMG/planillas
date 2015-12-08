<?php
session_start();
?>
<?php include_once("conexionBD/presupuestoBD.php"); ?>
<?php $db = new presupuestoBD(); ?>

<div id="modalAsignarPresupuesto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Asignar Presupuesto</h4>
      </div>
      <!-- Body -->
      <form action="presupuestos/gestorPresupuesto.php<?php echo "?carrera=".$_GET['carrera']."&curso=".$_GET['curso']."&num_grupo=".$_GET['num_grupo']."&num_grupo_doble=".$_GET['num_grupo_doble']."&total_tiempos=".$_GET['total_tiempos']; if ($_GET['modalAsignarPresup'] == 2) { echo "&id_presupuesto=".$_GET['id_presupuesto']; }?>" method="post">
        <div class="modal-body">
          <div id="asignarGrupoPresup" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPresupuestoGrupo">Presupuesto que lo respalda:</label>
            <select class="form-control" name="cboPresupuestoGrupo">
              <option value="0"></option>
              <?php
                $resultado = $db->obtenerlistadoDePresupuesto();

                while ($fila = mysqli_fetch_assoc($resultado)) {
                  echo "<option value='".$fila['id_presupuesto']."'>";
                  echo $fila['nombre_presupuesto'];
                  echo "</option>";
                }
              ?>
            </select>
          </div>
          <div id="eliminarGrupoPresup" class="hide">
            <center class="texto-efectos2">¿Desea quitar el presupuesto de este grupo?</center>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div id="btnAsignarGrupoPresup" class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-primary btn-block" name="btnAsignarGrupoPresup">Asignar presupuesto</button>
          </div>
          <div id="btnEliminarGrupoPresup" class="hide">
            <a class="btn btn-danger" href="masterPage.php">No</a>
            <button type="submit" class="btn btn-success" name="btnEliminarGrupoPresup">Eliminar presupuesto</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
