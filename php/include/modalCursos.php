<?php session_start(); ?>
<?php include_once("conexionBD/cursosBD.php"); ?>
<?php $db = new cursosBD(); ?>

<div id="modalCursos" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Registro Cursos</h4>
      </div>
      <!-- Body -->
      <form action="cursos/manejadorCursos.php" method="post">
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtSigla">Sigla del curso:</label>
          </div>
          <div id="cursosEliminarModificar" class="form-group col-xs-12 col-sm-12 col-lg-12">
            <select class="form-control" name="cboxSigla" id="selectCursos" onchange="cargarDatosCursos(this)" style="margin-bottom: 15px;">
              <?php
                if ($_GET['sigla'] != "") {
                  echo " <option value=".$_GET['sigla'].">".$_GET['sigla']."</option>";
                } else {
                  echo " <option ></option>";
                }
                $resultado = $db->obtenerCursos();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($fila['sigla'] != 1 && $fila['sigla'] != $_GET['sigla']) {
                    echo "<option value='".$fila['sigla']."'>".$fila['sigla']." / ".$fila['nombre_curso']."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div id="cursosAgregar" class="form-group col-xs-12 col-sm-12 col-lg-12 hide">
            <input maxlength="10" type="text" class="form-control col-xs-12 col-sm-12 col-lg-12 input-border" name="txtSigla" placeholder="Sigla" style="margin-bottom: 15px;">
          </div>
          <div id="seccionCursosEliminar">
            <div class="col-xs-12 col-sm-12 col-lg-12">
              <label for="cboxtxtCarrera">Carrera del curso:</label>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <select class="form-control" name="cboxtxtCarrera" id="" onchange="">
                <?php
                  if ($_GET['modalCursos'] == 1) {
                    echo "<option value='".$_GET['id_carrera']."'>".$_GET['nombre_carrera']."</option>";

                  } else {
                    $resultado = $db->obtenerCarreras();
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      if ($fila['id_carrera'] != 1) {
                        echo "<option value='".$fila['id_carrera']."'>".$fila['nombre_carrera']."</option>";
                      }
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="txtNombre">Nombre del curso:</label>
              <input
              <?php
                if ($_GET['nombre_curso'] != "") {
                  echo "value ='".$_GET['nombre_curso']."'";
                }
              ?>
              type="text" maxlength="100" class="form-control input-border" name="txtNombreCurso" placeholder="Nombre">
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboCreditos">Cantidad de créditos:</label>
              <select class="form-control" name="cboCreditosCursos">
                <?php
                if ($_GET['creditos'] != "") {
                  echo "<option>".$_GET['creditos']."</option>";
                }
                for($i=0;$i<=14;$i++){
                  echo "<option>".$i."</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboTiempo">Jornada:</label>
              <select class="form-control" name="cboTiempoCursos">
                <?php
                  if ($_GET['jornada'] != "") {
                    echo "<option>".$_GET['jornada']."</option>";
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
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div id='cursosBtnModificar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
              </div>
              <div id='cursosBtnEliminar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
          <div id="cursosBtnAgregar" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide">
            <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
