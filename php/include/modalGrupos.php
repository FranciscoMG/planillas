<?php
  session_start();
?>

<?php
  include_once("conexionBD/gruposBD.php");
  include_once("conexionBD/cursosBD.php");
  include_once("conexionBD/docentesBD.php");
?>
<?php
  $db = new gruposBD();
  $db2 = new cursosBD();
  $db3 = new docentesBD();
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
            <label for="cboIDCarrera">Carrera:</label>
            <select id="selectAgregarCarrera" class="form-control" name="cboIDCarrera" onchange="cargarDatosCarrera(this)">
              <?php
                echo "<option value='0'></option>";
                $resultado = $db2->obtenerCarreras();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($fila['id_carrera'] != 1) {
                    if (isset($_GET['modalGrupos']) && $_GET['id_carrera'] == $fila['id_carrera']) {
                      echo "<option value='".$fila['id_carrera']."' selected>".$fila['nombre_carrera']."</option>";
                    } else {
                      echo "<option value='".$fila['id_carrera']."'>".$fila['nombre_carrera']."</option>";
                    }
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboIDCurso">Nombre del curso:</label>
            <select id="selectAgregarCurso" class="form-control" name="cboIDCurso" onchange="cargarDatosGrupo(this)">
              <option value="0"></option>
              <?php
                if (isset($_GET['id_carrera']) && $_GET['modalGrupos'] == 1) {
                  $resultado = $db2->obtenerCursosCarrera();
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                      if (isset($_GET['curso']) && $_GET['curso'] == $fila['fk_curso']) {
                        echo "<option value='".$fila['fk_curso']."' selected>".$fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                      } else {
                        echo "<option value='".$fila['fk_curso']."'>".$fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                      }
                    }
                  }
                } else {
                  if (isset($_GET['id_carrera']) && $_GET['modalGrupos'] == 2) {
                    $resultado = $db->obtenerGrupos(true);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                        if ($_GET['curso'] == $fila['fk_curso'] && $_GET['num_grupo'] == $fila['num_grupo']) {
                          echo "<option value='".$fila['fk_curso']." ".$fila['num_grupo']." ".$fila['num_grupo_doble']."' selected>G".$fila['num_grupo']." ";
                          if ($fila['num_grupo_doble'] != 0) {
                            echo " y G".$fila['num_grupo_doble']." ";
                          }
                          echo $fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                        } else {
                          echo "<option value='".$fila['fk_curso']." ".$fila['num_grupo']." ".$fila['num_grupo_doble']."'>G".$fila['num_grupo']." ";
                          if ($fila['num_grupo_doble'] != 0) {
                            echo " y G".$fila['num_grupo_doble']." ";
                          }
                          echo $fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                        }
                      }
                    }
                  } else {
                    if (isset($_GET['id_carrera']) && $_GET['modalGrupos'] == 3) {
                      $resultado = $db->obtenerGrupos(TRUE);
                      while ($fila = mysqli_fetch_assoc($resultado)) {
                        if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                          echo "<option value='".$fila['fk_curso']." ".$fila['num_grupo']." ".$fila['num_grupo_doble']." ".$fila['fk_presupuesto']."'>G".$fila['num_grupo']." ";
                          if ($fila['num_grupo_doble'] != 0) {
                            echo " y G".$fila['num_grupo_doble']." ";
                          }
                          echo $fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                        }
                      }
                    }
                  }
                }
              ?>
            </select>
          </div>
          <div id="grupoAgregarModificar">
            <div id="grupoAgregar" class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboGrupo">Número de grupo:</label>
              <select class="form-control" name="cboGrupo">
                <option value="0"></option>
                <?php
                if ($periodo == 0) {
                  for($i=1;$i<=9;$i++){
                    echo "<option>".$i."</option>";
                  }
                } else {
                  for($i=901;$i<=909;$i++){
                    echo "<option>".$i."</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboIDDocente">Docente:</label>
              <select id="selectAgregarDocente" class="form-control" name="cboIDDocente">
                <?php
                  echo "<option value='0'></option>";
                  $resultado = $db3->obtenerDocentes();
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
                <option value="0">Ad honorem</option>
                <?php
                  $tiempos= array('1/16', '1/8', '1/4', '3/8', '1/2', '5/8', '3/4', '7/8', '1');
                  for ($i=0; $i < count($tiempos); $i++) {
                    echo "<option>".$tiempos[$i]."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group col-xs-2 col-sm-2 col-lg-2">
              <button id= "btnProfesor" type="button" class="btn btn-success btn-block" name="btnAgregarProfesor" onclick=""><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div id="div-profesores" class="col-xs-12 col-sm-12 col-lg-12">
              <?php
                if (isset($_GET['docentes'])) {
                  $docentesDiv = unserialize($_GET['docentes']);
                  for ($i=0; $i < count($docentesDiv); $i++) {
                    echo "<div id='divProfesor".$i."' class='form-group'><input id='txtProfesor".$i."' name='txtProfesor".$i."' class='input-readonly' type='text' value='".$docentesDiv[$i][0]." - ".$docentesDiv[$i][1]."' readonly /><button type='button' class='btn btn-danger pull-right btn-xs' onclick='eliminarProfesor(document.getElementById(\"txtProfesor".$i."\"))'><span class='glyphicon glyphicon-minus'></span></button></div>";
                  }
                }
              ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12">
              <label for="cboDiaSemana">Horario:</label>
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
              <label for="cboHoraInicio" style="margin-top:8px;">de</label>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3">
              <select id="selectHoraInicio" class="form-control" name="cboHoraInicio">
                <?php
                  for($i=7;$i<=20;$i++){
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
              <label for="cboHoraFin" style="margin-top:8px;">a</label>
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3">
              <select id="selectHoraFin" class="form-control" name="cboHoraFin">
                <?php
                  for($i=7;$i<=20;$i++){
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
              <button id="btnHorario" type="button" class="btn btn-success btn-block" name="btnAgregarHorario" onclick=""><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div id="div-horarios" class="col-xs-12 col-sm-12 col-lg-12">
              <?php
                if (isset($_GET['horarios'])) {
                  $horariosDiv = unserialize($_GET['horarios']);
                  for ($i=0; $i < count($horariosDiv); $i++) {
                    echo "<div id='divHorario".$i."' class='form-group'><input name='txtHorario".$i."' class='input-readonly' type='text' value='".$horariosDiv[$i][0]." ".$horariosDiv[$i][1]."' readonly /><button type='button' class='btn btn-danger pull-right btn-xs' onclick='document.getElementById(\"divHorario".$i."\").remove()'><span class='glyphicon glyphicon-minus'></span></button></div>";
                  }
                }
              ?>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <?php
                if (isset($_GET['num_grupo_doble']) && $_GET['num_grupo_doble'] != 0) {
                  echo "<input id='cbhGrupoDoble' type='checkbox' name='chbGrupoDoble' onchange='activarGrupoDoble()' checked>";
                  echo "<label for='cbhGrupoDoble' onclick='activarGrupoDoble()'>Este grupo es doble</label>";
                } else {
                  if (isset($_GET['modalGrupos']) && $_GET['modalGrupos'] == 1) {
                    echo "<input id='cbhGrupoDoble' type='checkbox' name='chbGrupoDoble' onchange='activarGrupoDoble()'>";
                    echo "<label for='cbhGrupoDoble' onclick='activarGrupoDoble()'>Este grupo es doble</label>";
                  }
                }
              ?>
            </div>
            <div id="grupoDoble" <?php if($_GET['num_grupo_doble'] != 0) {echo "class=''";} else {echo "class='hide'";} ?>>
              <div id="grupoAgregarDoble" class="form-group col-xs-12 col-sm-12 col-lg-12">
                <label for="cboGrupoDoble">Número de grupo doble:</label>
                <select class="form-control" name="cboGrupoDoble">
                  <option value="0"></option>
                  <?php
                  if ($periodo == 0) {
                    for($i=51;$i<=59;$i++){
                      echo "<option>".$i."</option>";
                    }
                  } else {
                    for($i=951;$i<=959;$i++){
                      echo "<option>".$i."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-xs-12 col-sm-12 col-lg-12">
                <label for="cboIDDocenteDoble">Docente:</label>
                <select id="selectAgregarDocenteDoble" class="form-control" name="cboIDDocenteDoble">
                  <?php
                    echo "<option value='0'></option>";
                    $resultado = $db3->obtenerDocentes();
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
                <label for="cboTiempoProfesorDoble">Cantidad de tiempo individual:</label>
              </div>
              <div class="col-xs-10 col-sm-10 col-lg-10">
                <select id="selectTiempoProfesorDoble" class="form-control" name="cboTiempoProfesorDoble">
                  <option value="0">Ad honorem</option>
                  <?php
                    $tiempos= array('1/16', '1/8', '1/4', '3/8', '1/2', '5/8', '3/4', '7/8', '1');
                    for ($i=0; $i < count($tiempos); $i++) {
                      echo "<option>".$tiempos[$i]."</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group col-xs-2 col-sm-2 col-lg-2">
                <button id= "btnProfesorDoble" type="button" class="btn btn-success btn-block" name="btnAgregarProfesorDoble"><span class="glyphicon glyphicon-plus"></span></button>
              </div>
              <div id="div-profesoresDoble" class="col-xs-12 col-sm-12 col-lg-12">
                <?php
                  if (isset($_GET['docentesDoble'])) {
                    $docentesDobleDiv = unserialize($_GET['docentesDoble']);
                    for ($i=0; $i < count($docentesDobleDiv); $i++) {
                      echo "<div id='divProfesorDoble".$i."' class='form-group'><input name='txtProfesorDoble".$i."' class='input-readonly' type='text' value='".$docentesDobleDiv[$i][0]." - ".$docentesDobleDiv[$i][1]."' readonly /><button type='button' class='btn btn-danger pull-right btn-xs' onclick='eliminarProfesor(document.getElementById(\"txtProfesorDoble".$i."\"))'><span class='glyphicon glyphicon-minus'></span></button></div>";
                    }
                  }
                ?>
              </div>
              <div class="col-xs-12 col-sm-12 col-lg-12">
                <label for="cboDiaSemanaDoble">Horario:</label>
              </div>
              <div class="col-xs-2 col-sm-2 col-lg-2">
                <select id="selectDiaSemanaDoble" class="form-control" name="cboDiaSemanaDoble">
                  <?php
                    $semana = array("L","K","M","J","V","S");
                    for($i=0;$i<=5;$i++) {
                      echo "<option>".$semana[$i]."</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-xs-1 col-sm-1 col-lg-1">
                <label for="cboHoraInicioDoble" style="margin-top:8px;">de</label>
              </div>
              <div class="col-xs-3 col-sm-3 col-lg-3">
                <select id="selectHoraInicioDoble" class="form-control" name="cboHoraInicioDoble">
                  <?php
                    for($i=7;$i<=20;$i++){
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
                <label for="cboHoraFinDoble" style="margin-top:8px;">a</label>
              </div>
              <div class="col-xs-3 col-sm-3 col-lg-3">
                <select id="selectHoraFinDoble" class="form-control" name="cboHoraFinDoble">
                  <?php
                    for($i=7;$i<=20;$i++){
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
                <button id="btnHorarioDoble" type="button" class="btn btn-success btn-block" name="btnAgregarHorarioDoble"><span class="glyphicon glyphicon-plus"></span></button>
              </div>
              <div id="div-horariosDoble" class="col-xs-12 col-sm-12 col-lg-12">
                <?php
                  if (isset($_GET['horariosDoble'])) {
                    $horariosDobleDiv = unserialize($_GET['horariosDoble']);
                    for ($i=0; $i < count($horariosDobleDiv); $i++) {
                      echo "<div id='divHorarioDoble".$i."' class='form-group'><input name='txtHorarioDoble".$i."' class='input-readonly' type='text' value='".$horariosDobleDiv[$i][0]." ".$horariosDobleDiv[$i][1]."' readonly /><button type='button' class='btn btn-danger pull-right btn-xs' onclick='document.getElementById(\"divHorarioDoble".$i."\").remove()'><span class='glyphicon glyphicon-minus'></span></button></div>";
                    }
                  }
                ?>
              </div>
            </div>
            <div id="jornadaGrupo" class="form-group col-xs-6 col-sm-6 col-lg-6">
              <label for="txtJornada">Jornada del grupo:</label>
              <input id="txtJornada" type="text" class="form-control" name="txtJornada" <?php if(isset($_GET['jornada'])) { echo "value='".$_GET['jornada']."'"; } else { echo "value='0'"; }?> readonly>
            </div>
            <div id="jornadaCurso" class="form-group col-xs-6 col-sm-6 col-lg-6">
              <label for="txtJornadaCurso">Jornada del curso:</label>
              <input id="txtJornadaCurso" type="text" class="form-control" name="txtJornadaCurso" value="<?php
                $contarCeros=0;
                $resultado = $db2->obtenerCursosCarrera();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($_GET['id_carrera'] == $fila['fk_carrera'] && $_GET['curso'] == $fila['fk_curso']) {
                    echo $fila['jornada'];
                    $contarCeros++;
                  }
                }
                if ($contarCeros == 0) {
                  echo '0';
                }
              ?>" readonly>
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
