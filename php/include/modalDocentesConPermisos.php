<?php include_once("conexionBD/docentesConPermisosBD.php"); ?>
<?php include_once("conexionBD/presupuestoBD.php"); ?>

<?php $db = new docentesConPermisoBD(); ?>
<?php $dbPresupuesto = new presupuestoBD(); ?>

<?php
session_start();
?>

<div id="modalDocentesConPermisos" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Registro Docentes con Permisos</h4>
      </div>
      <!-- Body -->
      <form action="docentes/gestion_docentesConPermiso.php" method="post">
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtCedula2">Cédula:</label>
          </div>
          <div id="docenteEliminarModificar2" class="col-xs-12 col-sm-12 col-lg-12">
            <select id="selectEliminarDocente2" class="form-control" name="cboxIDDocente2" onchange="cargarDatosDocentesConPermiso(this)">
              <?php
                echo "<option value='0'></option>";
                $resultado = $db->obtenerDocentesConPermiso();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if (isset($_GET['modalDocentesConPermisos']) && $_GET['cedula'] == $fila['cedula'] && $fila['cedula'] != 1) {
                    echo "<option value='".$fila['cedula']."' selected>".$fila['cedula']." - ".$fila['nombre']." ".$fila['apellidos']."</option>";
                  } else {
                    if ($fila['cedula'] != 1) {
                      echo "<option value='".$fila['cedula']."'>".$fila['cedula']." - ".$fila['nombre']." ".$fila['apellidos']."</option>";
                    }
                  }
                }
              ?>
            </select>
          </div>
          <br/>
          <div id="seccionEliminarDocente2">
            <div id="docenteAgregar2" class="col-xs-12 col-sm-12 col-lg-12 hide">
              <input maxlength="25" type="text" class="form-control input-border" name="txtCedula2" placeholder="Cédula" <?php
              if (isset($_GET['modalDocentesConPermisos'])) {
                echo "value=".$_GET['cedula'];
              } ?>>
            </div><br/><br/><br/>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="txtNombre2">Nombre:</label>
              <input maxlength="20" type="text" class="form-control input-border" name="txtNombre2" placeholder="Nombre" <?php
              if (isset($_GET['modalDocentesConPermisos'])) {
                echo "value=".$_GET['nombre'];
              } ?>>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="txtApellidos2">Apellidos:</label>
              <input maxlength="40" type="text" class="form-control input-border" name="txtApellidos2" placeholder="Apellidos" <?php
              if (isset($_GET['modalDocentesConPermisos'])) {
                echo 'value="'.$_GET['apellidos'].'"';
              } ?>>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboGrado2">Grado Académico:</label>
              <?php
                $grados= array("Bachillerato", "Licenciatura", "Maestría", "Doctorado");
                echo "<select class='form-control' name='cboGrado2'>";
                for ($i=0; $i < count($grados); $i++) {
                  if (isset($_GET['modalDocentesConPermisos'])) {
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
              <label for="cboContrato2">Tipo contrato:</label>
              <?php
                $contrato= array("Interino", "Propiedad", "Sustituto");
                echo "<select class='form-control' name='cboContrato2'>";
                for ($i=0; $i < count($contrato); $i++) {
                  if (isset($_GET['modalDocentesConPermisos'])) {
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
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboPresupuesto2">Presupuesto que lo respalda:</label>
              <?php
                $resultado = $dbPresupuesto->obtenerlistadoDePresupuesto();
                echo "<select class='form-control' name='cboPresupuesto2'>";

                if ($_GET['fk_presupuesto'] != 0) {
                  echo "<option value='".$_GET['fk_presupuesto']."'>";
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    if ($fila['id_presupuesto'] == $_GET['fk_presupuesto']) {
                      echo $fila['nombre_presupuesto'];
                    }
                  }
                  echo "</option>";
                }

                $resultado = $dbPresupuesto->obtenerlistadoDePresupuesto();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($_GET['fk_presupuesto'] != $fila['id_presupuesto']) {
                    echo "<option value='".$fila['id_presupuesto']."'>";
                    echo $fila['nombre_presupuesto'];
                    echo "</option>";
                  }
                }
                echo "</select>";
              ?>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboJornadaDocenteConPermiso2">Partida del presupuesto:</label>
              <select class="form-control" name="cboJornadaDocenteConPermiso2">
                <?php
                  if ($_GET['jornada'] != "") {
                    echo "<option>".$_GET['jornada_fraccion']."</option>";
                  }
                  $tiempos= array('1/16', '1/8', '1/4', '3/8', '1/2', '5/8', '3/4', '7/8', '1');
                  for ($i=0; $i < count($tiempos); $i++) {
                    echo "<option>".$tiempos[$i]."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION['masterActivo'] == 1) {
              echo "</br>
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton' id='docentesBtnModificar2'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar2'>Modificar</button>
              </div>
              <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide' id='docentesBtnEliminar2'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar2'>Eliminar</button>
              </div>
              </br>";
            }
          ?>
          <div class="col-xs-12 col-sm-12 col-lg-12 espacio-boton hide" id='docentesBtnAgregar2'>
            <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar2">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
