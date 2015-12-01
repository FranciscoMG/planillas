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
            <label for="cboIDCurso">Nombre del curso:</label>
            <select id="selectAgregarCurso" class="form-control" name="cboIDCurso" onchange="cargarDatosGrupo(this)">
              <?php
                echo "<option value='0'></option>";
                if (isset($_GET['id_carrera']) && $_GET['modalGrupos'] == 1) {
                  $resultado = $db2->obtenerCursosCarrera($_GET['id_carrera']);
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                      echo "<option value='".$fila['sigla']."'>".$fila['sigla']." - ".$fila['nombre_curso']."</option>";
                    }
                  }
                } else {
                  if (isset($_GET['id_carrera']) && $_GET['modalGrupos'] == 2) {
                    $resultado = $db->obtenerGrupos(true);
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                        if ($_GET['curso'] == $fila['fk_curso'] && $_GET['num_grupo'] == $fila['num_grupo']) {
                          echo "<option value='".$fila['fk_curso']." ".$fila['num_grupo']."' selected>G".$fila['num_grupo']." ".$fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                        } else {
                          echo "<option value='".$fila['fk_curso']." ".$fila['num_grupo']."'>G".$fila['num_grupo']." ".$fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
                        }
                      }
                    }
                  } else {
                    if (isset($_GET['id_carrera']) && $_GET['modalGrupos'] == 3) {
                      $resultado = $db->obtenerGrupos(TRUE);
                      while ($fila = mysqli_fetch_assoc($resultado)) {
                        if ($_GET['id_carrera'] == $fila['fk_carrera']) {
                          echo "<option value='".$fila['fk_curso']." ".$fila['num_grupo']."'>G".$fila['num_grupo']." ".$fila['fk_curso']." - ".$fila['nombre_curso']."</option>";
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
                <?php
                  for($i=1;$i<=60;$i++){
                    echo "<option>".$i."</option>";
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
		<option>1/16</option>
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
              <button id= "btnProfesor" type="button" class="btn btn-success btn-block" name="btnAgregarProfesor" onclick="cuentaDivs(true)"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div id="div-profesores" class="col-xs-12 col-sm-12 col-lg-12">
              <?php
                if (isset($_GET['docentes'])) {
                  $docentesDiv = unserialize($_GET['docentes']);
                  for ($i=0; $i < count($docentesDiv); $i++) {
                    echo "<div id='#divProfesor".$i."' class='form-group'><input name='txtProfesor".$i."' class='input-readonly' type='text' value='".$docentesDiv[$i][0]." - ".$docentesDiv[$i][1]."' readonly /><button type='button' class='btn btn-danger pull-right btn-xs' onclick='document.getElementById(\"divProfesor".$i."\").remove()'><span class='glyphicon glyphicon-minus'></span></button></div>";
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
              <label for="cboHoraFin" style="margin-top:8px;">a</label>
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
              <button id="btnHorario" type="button" class="btn btn-success btn-block" name="btnAgregarHorario" onclick="cuentaDivs(false)"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div id="div-horarios" class="col-xs-12 col-sm-12 col-lg-12">
              <?php
                if (isset($_GET['horarios'])) {
                  $horariosDiv = unserialize($_GET['horarios']);
                  for ($i=0; $i < count($horariosDiv); $i++) {
                    echo "<div id='#divHorario".$i."' class='form-group'><input name='txtHorario".$i."' class='input-readonly' type='text' value='".$horariosDiv[$i][0]." ".$horariosDiv[$i][1]."' readonly /><button type='button' class='btn btn-danger pull-right btn-xs' onclick='document.getElementById(\"divHorario".$i."\").remove()'><span class='glyphicon glyphicon-minus'></span></button></div>";
                  }
                }
              ?>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-lg-12">
              <label for="cboJornada">Jornada:</label>
              <select class="form-control" name="cboJornada">
                <?php
                  $fracciones = array("1/8","1/4","3/8","1/2","5/8","3/4","7/8","1");
                  for($i=0;$i<count($fracciones);$i++) {
                    if (isset($_GET['jornada']) && $fracciones[$i] == $_GET['jornada']) {
                      echo "<option selected>".$fracciones[$i]."</option>";
                    } else {
                      echo "<option>".$fracciones[$i]."</option>";
                    }
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
  <script type="text/javascript">
    idDiv=0;
    function cuentaDivs(tipoDiv) {
      RevisarDiv= "";
      if (tipoDiv) {
        RevisarDiv= "divProfesor";
      } else {
        RevisarDiv= "divHorario";
      }
      for (var i = 0; i < 6; i++) {
        if ($("#"+RevisarDiv+i).length) {
          if (tipoDiv) {
            $("#"+RevisarDiv+i).attr('id', "#"+RevisarDiv+idDiv);
            idDiv++;
          } else {
            $("#"+RevisarDiv+i).attr('id', "#"+RevisarDiv+idDiv);
            idDiv++;
          }
        }
      }
    }
  </script>
</div>
