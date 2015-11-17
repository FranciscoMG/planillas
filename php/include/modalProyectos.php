<?php
  session_start();

?>

<div id="modalProyectos" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="">&times;</a>
				<h4 class="modal-title">Registro Proyectos</h4>
			</div>
      <!-- Body -->
			<form action="" method="post">
				<div class="modal-body">
					<div class="col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtNombre">Nombre del proyecto:</label>
          </div>
          <div class="col-xs-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control input-border" name="txtNombre" placeholder="Nombre">
          </div>
          <div class="form-group col-xs-4 col-sm-4 col-lg-4">
            <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION['masterActivo'] == 1 ) {
                echo 'disabled'; } ?> name="btnRegistrar"><span class="glyphicon glyphicon-search"></span></button>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTipo">Tipo de proyecto:</label>
            <select class="form-control" name="cboTipo">
              <option value="0">Acción Social</option>
              <option value="1">Investigación</option>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTiempo">Cantidad de tiempos:</label>
            <select class="form-control" name="cboTiempo">
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
              <option>Profesor 1</option>
              <option>Profesor 2</option>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboSecundario">Asociado/Colaborador:</label>
            <select class="form-control" name="cboSecundario">
              <option>Profesor 1</option>
              <option>Profesor 2</option>
            </select>
          </div>
        </div>
        <!-- Mensaje -->
				<div class="form-group col-xs-12 col-sm-12 col-lg-12 text-center">
					<p class="form-control-static texto-efectos1">
					<?php
						if (!empty($_SESSION['mensaje-modal'])) {
							echo $_SESSION['mensaje-modal'];
						}
					?></p>
				</div>
        <!-- Footer -->
				<div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION['masterActivo'] == 1) {
              echo "
              <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-warning btn-block' name='btnAgregar'>Modificar</button>
              </div>
              <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnAgregar'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
				  <div class="col-xs-12 col-sm-12 col-lg-12">
					  <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION['masterActivo'] == 1 ) {echo 'disabled';} ?> name="btnRegistrar">Registrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
