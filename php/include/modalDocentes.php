<?php include_once("conexionBD/docentesBD.php"); ?>
<?php $db = new docentesBD(); ?>
<?php
  session_start();
?>

<div id="modalDocentes" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content ">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="masterPage.php">&times;</a>
				<h4 class="modal-title">Registro Docentes</h4>
			</div>
      <!-- Body -->
			<form action="docentes/gestion_docentes.php" method="post">
				<div class="modal-body">
					<div class="col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtCedula">Cédula:</label>
          </div>
          <div id="docenteEliminarModificar" class="col-xs-12 col-sm-12 col-lg-12">
            <select id="selectEliminarDocente" class="form-control" name="cboxIDocente" onchange="cargarDatosDocentes(this)">
              <?php
              if (isset($_GET['modalDocentes'])) {
                if ($_GET['cedula'] != 1) {
                echo "<option value='".$_GET['cedula']."'>".$_GET['nombre']." ".$_GET['apellidos']."</option>";
              }
              }
              echo "<option></option>";
              $resultado = $db->obtenerDocentes();
              while ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['cedula'] != 1) {
                echo "<option value='".$fila['cedula']."'>".$fila['nombre']." ".$fila['apellidos']."</option>";
              }
              }
               ?>
            </select>
          </div>
          <div id="seccionEliminarDocente">
            <div id="docenteAgregar" class="col-xs-12 col-sm-12 col-lg-12 hide">
              <input type="text" class="form-control input-border" name="txtCedula" placeholder="Cédula" <?php
              if (isset($_GET['modalDocentes'])) {
                echo "value=".$_GET['cedula'];
              } ?>>
            </div>
  					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
      				<label for="txtNombre">Nombre:</label>
      				<input type="text" class="form-control input-border" name="txtNombre" placeholder="Nombre" <?php
              if (isset($_GET['modalDocentes'])) {
                echo "value=".$_GET['nombre'];
              } ?>>
  					</div>
  					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
      				<label for="txtApellidos">Apellidos:</label>
      				<input type="text" class="form-control input-border" name="txtApellidos" placeholder="Apellidos" <?php
              if (isset($_GET['modalDocentes'])) {
                echo "value=".$_GET['apellidos'];
              } ?>>
    				</div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboGrado">Grado Académico:</label>
              <?php
                $grados= array("Bachillerato", "Licenciatura", "Maestría", "Doctorado");
                echo "<select class='form-control' name='cboGrado'>";
                for ($i=0; $i < count($grados); $i++) {
                  if (isset($_GET['modalDocentes'])) {
                    if ($_GET['grado'] == $i) {
                      echo "<option value='".$i."' selected>".$grados[$i]."</option>";
                    } else {
                      echo "<option value='".$i."'>".$grados[$i]."</option>";
                    }
                  }
                  else {
                    echo "<option value='".$i."'>".$grados[$i]."</option>";
                  }
                }
                echo "</select>";
              ?>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboContrato">Tipo contrato:</label>
              <?php
                $contrato= array("Interino", "Propiedad", "Sustituto");
                echo "<select class='form-control' name='cboContrato'>";
                for ($i=0; $i < count($contrato); $i++) {
                  if (isset($_GET['modalDocentes'])) {
                    if ($_GET['contrato'] == $i) {
                      echo "<option value='".$i."' selected>".$contrato[$i]."</option>";
                    } else {
                      echo "<option value='".$i."'>".$contrato[$i]."</option>";
                    }
                  }
                  else {
                    echo "<option value='".$i."'>".$contrato[$i]."</option>";
                  }
                }
                echo "</select>";
              ?>
            </div>
          </div>
        </div>
        <!-- Footer -->
				<div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style='padding-bottom:15px;' id='docentesBtnModificar'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
              </div>
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 hide' style='padding-bottom:15px;' id='docentesBtnEliminar'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
				  <div class="col-xs-12 col-sm-12 col-lg-12 hide" id='docentesBtnAgregar'>
					  <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar">Registrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
