<?php include_once("conexionBD/presupuestoBD.php"); ?>
<?php $db = new presupuestoBD(); ?>
<?php
  session_start();
?>

<div id="modalPresupuesto" class="modal fade" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="masterPage.php">&times;</a>
				<h4 class="modal-title">Registro Presupuesto</h4>
			</div>
      <!-- Body -->
			<form action="presupuestos/gestorPresupuesto.php" method="post">
				<div class="modal-body">
					<div class="col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtNombrePresupuesto">Nombre del presupuesto:</label>
          </div>

          <div id="presupuestoEliminarModificar" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <select id="selectEliminarPresupuesto" class="form-control" name="cboxIDPresupuesto" onchange="cargarDatosPresupuesto(this)">
            <?php
              if (isset($_GET['modalPresupuesto'])) {
                echo "<option value='".$_GET['id_presupuesto']."'>".$_GET['nombre_presupuesto']."</option>";
                  $resultado = $db->obtenerlistadoDePresupuesto();
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    if ($fila['id_presupuesto'] != $_GET['id_presupuesto']) {
                      echo "<option value='".$fila['id_presupuesto']."'>".$fila['nombre_presupuesto']."</option>";
                    }
                }
              } else {
                echo "<option></option>";
                $resultado = $db->obtenerlistadoDePresupuesto();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='".$fila['id_presupuesto']."'>".$fila['nombre_presupuesto']."</option>";
                }
              }
             ?>
            </select>
          </div>
        <div id="seccionEliminarPresupuesto">
          <div id="presupuestoAgregar" class="form-group col-xs-12 col-sm-12 col-lg-12 hide">
            <input maxlength="80" class="form-control input-border"  type="text" name="txtNombrePresupuesto" placeholder="Nombre" <?php if (isset($_GET['modalPresupuesto'])) {
              echo "value=".$_GET['nombre_presupuesto'];
            } ?>>
          </div>
          <br/><br/><br/><br/>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPrimario">Código:</label>
            <input maxlength="10" class="form-control input-border" type="text" name="txtCodigoPresupuesto" placeholder="Código" <?php if (isset($_GET['modalPresupuesto'])) {
              echo "value='".$_GET['codigo']."'";
            } ?>>
          </div>

          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTiemposPresupuesto">Cantidad de tiempos:</label>
            <select class="form-control" name="cboTiemposPresupuesto" <?php if (isset($_GET['modalPresupuesto'])) {echo " disabled";} ?>>
              <?php
              if (isset($_GET['modalPresupuesto'])) {
                echo "<option>".$_GET['tiempo_presupuesto']."</option>";
              }
               ?>
               <option>1/8</option>
               <option>1/4</option>
               <option>3/8</option>
               <option>1/2</option>
               <option>5/8</option>
               <option>3/4</option>
               <option>7/8</option>
               <option>1</option>
              <?php
                $valor=1;
                while ($valor < 99) {
                  echo"
                <option>".$valor." 1/8</option>
                <option>".$valor." 1/4</option>
                <option>".$valor." 3/8</option>
                <option>".$valor." 1/2</option>
                <option>".$valor." 5/8</option>
                <option>".$valor." 3/4</option>
                <option>".$valor." 7/8</option>";
                $valor = $valor + 1;
                echo "
                <option>".$valor."</option>";
                }
                $valor=0;
                while ($valor < 100) {
                  $valor=$valor+0.0625;

                }
               ?>
            </select>
          </div>
        </div>
        <!-- Footer -->
				<div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div id='presupuestoBtnModificar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificarPresupuesto'>Modificar</button>
              </div>
              <div id='presupuestoBtnEliminar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminarPresupuesto' style='margin-top: 15px;'>Eliminar</button>
              </div>";
            }
          ?>
				  <div id="presupuestoBtnAgregar" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide">
					  <button type="submit" class="btn btn-primary btn-block" <?php if ( $_SESSION[masterActivo] != 1 ) { echo 'disabled'; } ?> name="presupuestoBtnAgregar">Agregar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
