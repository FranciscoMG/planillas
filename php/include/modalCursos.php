<?php session_start(); ?>
<?php include_once("conexionBD/cursosBD.php"); ?>
<?php 
  $db = new cursosBD(); 
?>

<div id="modalCursos" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content ">
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

          <div id="cursosEliminarModificar" class="col-xs-12 col-sm-12 col-lg-12">
            <select class="form-control" name="cboxSigla" id="selectCursos" onchange="cargarDatosCursos(this)">
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

          <div id="cursosAgregar" class="col-xs-12 col-sm-12 col-lg-12 hide">
            <input type="text" class="form-control input-border" name="txtSigla" placeholder="Sigla">
          </div>

      <div id="seccionCursosEliminar">

        <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="cboxtxtCarrera">Carrera del curso:</label>
          </div>
          <div id="" class="col-xs-12 col-sm-12 col-lg-12">
            <select class="form-control" name="cboxtxtCarrera" id="" onchange="">
            <?php 
            if ($_GET['modalCursos'] == 1) {
              echo "<option value='".$_GET['id_Carrera']."'>".$_GET['nombre_Carrera']."</option>";
              $resultado = $db->obtenerCarreras();
              while ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['id_Carrera'] != $_GET['id_Carrera']) {
                  echo "<option value='".$fila['id_Carrera']."'>".$fila['nombre_Carrera']."</option>";
                }
              }
            } else {
              $resultado = $db->obtenerCarreras();
              while ($fila = mysqli_fetch_assoc($resultado)) {
                  echo "<option value='".$fila['id_Carrera']."'>".$fila['nombre_Carrera']."</option>";
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
            type="text" class="form-control input-border" name="txtNombreCurso" placeholder="Nombre">
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
            echo"
	      <option>1/16</option>
              <option>1/8</option>
              <option>1/4</option>
              <option>3/8</option>
              <option>1/2</option>
              <option>5/8</option>
              <option>3/4</option>
              <option>7/8</option>
              <option>1</option>";

              ?>
            </select>
          </div>
          </div>
          <br><br><br>
        </div>
        <!-- Mensaje -->
        <!-- Footer -->
				<div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div id='cursosBtnModificar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
              </div>
              <div id='cursosBtnEliminar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 hide' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
				  <div id="cursosBtnAgregar" class="col-xs-12 col-sm-12 col-lg-12 hide">
					  <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar">Registrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
