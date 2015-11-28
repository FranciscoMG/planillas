<?php
  session_start();
?>

<?php
  include_once("conexionBD/cursosBD.php");
  include_once("conexionBD/docentesBD.php");
?>
<?php
  $db = new cursosBD();
  $db2 = new docentesBD();
?>

<div id="modalGrupos" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 col-lg-11 col-lg-offset-1">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="masterPage.php">&times;</a>
				<h4 class="modal-title">Registro Grupos</h4>
			</div>
      <!-- Body -->
			<form id="formGrupos" action="grupos/gestionGrupos.php" method="post">
				<div class="modal-body">
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtCarrera">Carrera:</label>
            <select id="selectAgregarCarrera" class="form-control" name="cboIDCarrera" onchange="cargarDatosCarrera(this)">
              <?php
                echo "<option value='0'></option>";
                $resultado = $db->obtenerCarreras();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if (isset($_GET['modalGrupos']) && $_GET['id_carrera'] == $fila['id_Carrera']) {
                    echo "<option value='".$fila['id_Carrera']."' selected>".$fila['nombre_Carrera']."</option>";
                  } else {
                    echo "<option value='".$fila['id_Carrera']."'>".$fila['nombre_Carrera']."</option>";
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtSigla">Nombre del curso:</label>
            <select id="selectAgregarCurso" class="form-control" name="cboIDCurso" onchange="cargarDatosCursos2(this)">
              <?php
                echo "<option value='0'></option>";
                if (isset($_GET['id_carrera'])) {
                  $resultado = $db->obtenerCursosCarrera($_GET['id_carrera']);
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                      if (isset($_GET['modalGrupos']) && $_GET['id_curso'] == $fila['sigla']) {
                        echo "<option value='".$fila['sigla']."' selected>".$fila['sigla']." - ".$fila['nombre_curso']."</option>";
                      } else {
                        echo "<option value='".$fila['sigla']."'>".$fila['sigla']." - ".$fila['nombre_curso']."</option>";
                      }
                    }
                  }
                }
              ?>
            </select>
          </div>
          <div id="grupoAgregarModificar">
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboGrupo">Número de grupo:</label>
              <select class="form-control" name="cboGrupo">
                <?php
                  for($i=0;$i<=59;$i++){
                    echo "<option>".$i."</option>";
                  }
                ?>
              </select>
            </div>
            <br/><br/><br/><br/>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="txtDocente">Docente:</label>
              <select id="selectAgregarDocente" class="form-control" name="cboIDDocente" onchange="">
                <?php
                  echo "<option value='0'></option>";
                  $resultado = $db2->obtenerDocentes();
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    if (isset($_GET['modalDocentes']) && $_GET['cedula'] == $fila['cedula']) {
                      echo "<option value='".$fila['cedula']."' selected>".$fila['nombre']." ".$fila['apellidos']."</option>";
                    } else {
                      echo "<option value='".$fila['cedula']."'>".$fila['nombre']." ".$fila['apellidos']."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12">
              <label for="cboTiempoProfesor">Cantidad de tiempo individual:</label>
            </div>
            <div class="col-xs-10 col-sm-10 col-lg-10">
              <select id="selectTiempoProfesor" class="form-control" name="cboTiempoProfesor">
                <option>1/8</option>
                <option>1/4</option>
                <option>3/8</option>
                <option>1/2</option>
                <option>5/8</option>
                <option>3/4</option>
                <option>7/8</option>
                <option>1</option>
              </select>
            </div>
            <div class="form-group col-xs-2 col-sm-2 col-lg-2">
              <button id= "btnProfesor" type="button" class="btn btn-success btn-block" name="btnAgregarProfesor" onclick=""><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div id="div-profesores" class="col-xs-12 col-sm-12 col-lg-12">

            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12">
              <label for="txtCarrera">Horario:</label>
            </div>
            <div class="col-xs-2 col-sm-2 col-lg-2">
              <select id="selectDiaSemana" class="form-control" name="cboDiaSemana">
                <?php
                  $semana = array("L","K","M","J","V","S");
                  for($i=0;$i<=5;$i++) {
                    echo "<option>".$semana[$i]."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-xs-1 col-sm-1 col-lg-1">
              <label for="txtCarrera">de</label>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3">
              <select id="selectHoraInicio" class="form-control" name="cboHoraInicio">
                <?php
                  for($i=7;$i<=21;$i++){
                    for($j=0;$j<=50;$j+=10){
                      if($j==0){
                        echo "<option>".$i.":".$j."0</option>";
                      }else {
                        echo "<option>".$i.":".$j."</option>";
                      }
                    }
                  }
                ?>
              </select>
            </div>
            <div class="col-xs-1 col-sm-1 col-lg-1">
              <label for="txtCarrera">a</label>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3">
              <select id="selectHoraFin" class="form-control" name="cboHoraFin">
                <?php
                  for($i=7;$i<=21;$i++){
                    for($j=0;$j<=50;$j+=10){
                      if($j==0){
                        echo "<option>".$i.":".$j."0</option>";
                      }else {
                        echo "<option>".$i.":".$j."</option>";
                      }
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-xs-2 col-sm-2 col-lg-2">
              <button id="btnHorario" type="button" class="btn btn-success btn-block" name="btnAgregarHorario"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div id="div-horarios" class="col-xs-12 col-sm-12 col-lg-12">

            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboTiempo">Jornada:</label>
              <select class="form-control" name="cboJornada">
                <option>1/8</option>
                <option>1/4</option>
                <option>3/8</option>
                <option>1/2</option>
                <option>5/8</option>
                <option>3/4</option>
                <option>7/8</option>
                <option>1</option>
              </select>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION['masterActivo'] == 1) {
              echo "</br>
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide' id='grupoBtnModificar'>
                      <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
                    </div>
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 espacio-boton hide' id='grupoBtnEliminar'>
                      <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
                    </div>
                    </br>";
            }
          ?>
				  <div class="col-xs-12 col-sm-12 col-lg-12 espacio-boton" id='grupoBtnAgregar'>
					  <button id="btnRegistrar" type="submit" class="btn btn-primary btn-block" name="btnRegistrar">Registrar</button>
					</div>
        </div>
      </form>
    </div>
  </div>
</div>
