<?php include_once("conexionBD/docentesBD.php"); ?>
<?php $db = new docentesBD(); ?>
<?php
session_start();
?>

<div id="modalDocentes" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
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
            <select id="selectEliminarDocente" class="form-control" name="cboxIDDocente" onchange="cargarDatosDocentes(this)">
              <?php
                echo "<option value='0'></option>";
                $resultado = $db->obtenerDocentes();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if (isset($_GET['modalDocentes']) && $_GET['cedula'] == $fila['cedula']) {
                    echo "<option value='".$fila['cedula']."' selected>".$fila['cedula']." - ".$fila['nombre']." ".$fila['apellidos']."</option>";
                  } else {
                    echo "<option value='".$fila['cedula']."'>".$fila['cedula']." - ".$fila['nombre']." ".$fila['apellidos']."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <br/>
          <div id="seccionEliminarDocente">
            <div id="docenteAgregar" class="col-xs-12 col-sm-12 col-lg-12 hide">
              <input maxlength="25" type="text" class="form-control input-border" name="txtCedula" placeholder="Cédula" <?php
              if (isset($_GET['modalDocentes'])) {
                echo "value=".$_GET['cedula'];
              } ?>>
            </div><br/><br/><br/>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="txtNombre">Nombre:</label>
              <input maxlength="20" type="text" class="form-control input-border" name="txtNombre" placeholder="Nombre" <?php
              if (isset($_GET['modalDocentes'])) {
                echo "value=".$_GET['nombre'];
              } ?>>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="txtApellidos">Apellidos:</label>
              <input maxlength="40" type="text" class="form-control input-border" name="txtApellidos" placeholder="Apellidos" <?php
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
            if ($_SESSION['masterActivo'] == 1) {
              echo "<br/>
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton' id='docentesBtnModificar'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
              </div>
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide' id='docentesBtnEliminar'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
          <div class="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide" id='docentesBtnAgregar'>
            <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
