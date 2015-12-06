<?php
  session_start();
?>
<?php include_once("conexionBD/presupuestoBD.php"); ?>
<?php $db = new presupuestoBD(); ?>

<div id="modalAsignarPresupuesto" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="masterPage.php">&times;</a>
				<h4 class="modal-title">Asignar Presupuesto</h4>
			</div>
      <!-- Body -->
			<form action="presupuestos/gestorPresupuesto.php" method="post">
				<div class="modal-body">
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
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
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-primary btn-block" name="btnAsignarGrupoPresup">Asignar presupuesto</button>
          </div>
        </div>
  		</form>
  	</div>
  </div>
</div>
