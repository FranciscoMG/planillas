<?php include_once("conexionBD/proyectosBD.php"); ?>
<?php include_once("conexionBD/docentesBD.php"); ?>
<?php $db = new proyectosBD(); ?>
<?php $dbDocentes = new docentesBD(); ?>
<?php
  session_start();
?>

<div id="modalProyectos" class="modal fade" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content ">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="masterPage.php">&times;</a>
				<h4 class="modal-title">Registro Proyectos</h4>
			</div>
      <!-- Body -->
			<form action="proyectos/gestorProyectos.php" method="post">
				<div class="modal-body">
					<div class="col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtNombre">Nombre del proyecto:</label>
          </div>

          <div id="proyectoEliminarModificar" class="col-xs-12 col-sm-12 col-lg-12">
            <select id="selectEliminarProyecto" class="form-control" name="cboxIDProyecto" onchange="cargarDatosProyecto(this)">

              <?php 
              if (isset($_GET['modalProyectos'])) {
                if ($_GET['id_proyecto'] != 1) {
                echo "<option value='".$_GET['id_proyecto']."'>".$_GET['nombre_proyecto']."</option>";
              }
              } else {
               echo "<option></option>";
              } 
              $resultado = $db->obtenerProyecto();
              while ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['id_proyecto'] != 1) {
                echo "<option value='".$fila['id_proyecto']."'>".$fila['nombre_proyecto']."</option>";
              }
              }
               ?>

            </select>
          </div>
        <div id="seccionEliminarProyecto">
          <div id="proyectoAgregar" class="col-xs-12 col-sm-12 col-lg-12 hide">
            <input type="text" class="form-control input-border" name="txtNombre_proyecto" placeholder="Nombre" <?php if (isset($_GET['modalProyectos'])) {
              echo "value=".$_GET['nombre_proyecto'];
            } ?>>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTipo">Tipo de proyecto:</label>
            <select class="form-control" name="cboTipo_proyecto">
            <?php 
            if (isset($_GET['modalProyectos'])) {
              if ($_GET['tipo_proyecto'] == 0) {
                echo "<option value='".$_GET['tipo_proyecto']."'>Acción Social</option>";
                echo "<option value='1'>Investigación</option>";
              } else {
                echo "<option value='".$_GET['tipo_proyecto']."'>Investigación</option>";
                echo "<option value='0'>Acción Social</option>";
            }
            } else {
              echo '
              <option value="0">Acción Social</option>
              <option value="1">Investigación</option>';
            }
             ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTiemposProyecto">Cantidad de tiempos:</label>
            <select class="form-control" name="cboTiemposProyecto">
              <?php 
              if (isset($_GET['modalProyectos'])) {
                echo "<option value='".$_GET['jornada_proyecto']."'>".$_GET['jornada_proyecto']."</option>";
              }
               ?>
              <option>3/4</option>
              <option>2/4</option>
              <option>1/4</option>
              <option>1/2</option>
              <option>1</option>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboPrimario">Principal/Responsable:</label>
            <select class="form-control" name="cboPrimario">
              <?php 
              if (isset($_GET['modalProyectos'])) {
                $resultado2 = $dbDocentes->obtenerUnDocente($_GET['fk_encargado']);
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                  if ($fila['nombre'] != "1") {
                  echo "<option value='".$_GET['fk_encargado']."'>".$fila['nombre']."</option>";
                }
                }
              }
                $resultado = $dbDocentes->obtenerDocentes();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($fila['nombre'] != "1") {
                    echo "<option value='".$fila['cedula']."'>".$fila['nombre']."</option>";
                  }
                }

               ?>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboSecundario">Asociado/Colaborador:</label>
            <select class="form-control" name="cboSecundario">
              <?php 
              if (isset($_GET['modalProyectos'])) {
                $resultado2 = $dbDocentes->obtenerUnDocente($_GET['fk_ayudante']);
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                  if ($fila['nombre'] != "1") {
                  echo "<option value='".$_GET['fk_ayudante']."'>".$fila['nombre']."</option>";
                }
                }
              }
                $resultado = $dbDocentes->obtenerDocentes();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                  if ($fila['nombre'] != "1") {
                    echo "<option value='".$fila['cedula']."'>".$fila['nombre']."</option>";
                  }
                }

               ?>
            </select>
          </div>
          </div>
        </div>
        <br><br><br>
        <!-- Mensaje -->
        <!-- Footer -->
				<div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div id='proyectosBtnModificar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 ' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificarProyectos'>Modificar</button>
              </div>
              <div id='proyectosBtnEliminar' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 hide' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminarProyecto'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
				  <div id="proyectosBtnAgregar" class="col-xs-12 col-sm-12 col-lg-12 hide">
					  <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] != 1 ) {echo 'disabled';} ?> name="proyectosBtnAgregar">Agregar</button>
					</div>
				</div>
			</form>
		</div>
    
	</div>
</div>
