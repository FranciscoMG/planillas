<?php include_once("conexionBD/proyectosBD.php"); ?>
<?php include_once("conexionBD/docentesBD.php"); ?>
<?php include_once("conexionBD/presupuestoBD.php"); ?>
<?php include_once("conexionBD/presupuestoDocenteBD.php"); ?>

<?php $dbPresupuestoDocente = new presupuestoDocenteBD(); ?>

<?php $dbPresupuesto = new presupuestoBD() ?>
<?php $db = new proyectosBD(); ?>
<?php $dbDocentes = new docentesBD(); ?>
<?php
session_start();
?>

<div id="modalProyectosPresupuesto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title"> Asignación de presupuesto a proyectos </h4>
      </div>
      <!-- Body -->
      <form action="proyectos/gestorProyectosAsignarPresupuesto.php" method="post">
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtNombre">Nombre del proyecto:</label>
          </div>
          <div id="proyectoEliminarModificar2" class="col-xs-12 col-sm-12 col-lg-12">
            <select id="selectEliminarProyecto2" class="form-control" name="cboxIDProyecto2" onchange="<?php if ($_GET["eliminadoPresupuestoProyecto"] == "") {echo "cargarDatosProyectoPresupuestoAgregar(this)";} else {echo "cargarDatosProyectoPresupuestoEliminar(this)";} ?>" style="margin-bottom: 15px;">
              <?php
                if (isset($_GET['modalProyectosPresupuesto'])) {
                  if ($_GET['id_proyecto'] != 1) {
                    echo "<option value='".$_GET['id_proyecto']."'>".$_GET['nombre_proyecto']."</option>";
                  }
                } else {
                  echo "<option></option>";
                }
                $resultado = $db->obtenerProyecto();
                $existe2 = 0;
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($fila['id_proyecto'] != 1) {
                    $existe2 = 0;
                    $resultado2 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
                    while ($fila2 = mysqli_fetch_assoc($resultado2)) {
                      if ($fila2['fk_proyecto'] == $fila['id_proyecto'] && $fila['id_proyecto'] != 1) {
                        $existe2 = 1;
                      }
                    }
                    if ($existe2 == 1) {
                      echo "<option value='".$fila['id_proyecto']."' >Tiene presupuesto    = ".$fila['nombre_proyecto']."</option>";
                    } else {
                      echo "<option value='".$fila['id_proyecto']."' >Sin presupuesto = ".$fila['nombre_proyecto']."</option>";
                    }
                  }
                }
              ?>
            </select>
          </div>
          <div id="seccionEliminarProyecto2">
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboTipo_proyecto2">Tipo de proyecto:</label>
              <select class="form-control" name="cboTipo_proyecto2" <?php if (isset($_GET['modalProyectosPresupuesto'])) { echo " disabled";} ?>>
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
              <select class="form-control disabled" name="cboTiemposProyecto2" readonly >
                <?php
                if (isset($_GET['modalProyectosPresupuesto'])) {
                  echo "<option value='".$_GET['jornada_proyecto']."'>".$_GET['jornada_proyecto']."</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboxPrimario2">Principal/Responsable:</label>
              <select class="form-control" name="cboxPrimario2" readonly >
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
              <select class="form-control" name="cboSecundario" readonly>
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
                    if ($_GET['eliminadoPresupuestoProyecto'] == 1) {
                      $resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
                      while ($fila = mysqli_fetch_assoc($resultado3)) {
                        if ($fila['id_presupuesto'] == $_GET['fk_presupuesto']) {
                          echo "<option value='".$_GET['fk_presupuesto']."'>";
                          echo $fila['nombre_presupuesto'];
                          echo "</option>";
                        }
                      }
                    }else {
                      $resultado3 = $dbPresupuesto->obtenerlistadoDePresupuesto();
                      while ($fila = mysqli_fetch_assoc($resultado3)) {
                        $resultado = $db->obtenerProyecto();
                        echo "<option value='".$fila['id_presupuesto']."'>";
                        echo $fila['nombre_presupuesto'];
                        echo "</option>";
                      }
                    }
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <br><br><br>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div id='proyectosBtnEliminar2' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton <?php if ($_GET["eliminadoPresupuestoProyecto"] == "") {echo "hide";} ?>' style='padding-bottom:15px;'>
            <button name='btnEliminarProyectoPresupuesto' type='submit' class='btn btn-danger btn-revision btn-block' >Eliminar</button>
          </div>
          <br/>
          <div id="proyectosBtnAgregar2" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton <?php if ($_GET["agregandoPresupuestoProyecto"] == "") {echo "hide";} ?>">
            <button name="proyectosBtnAgregarPresupuesto" type="submit" class="btn btn-primary btn-block"  >Agregar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
