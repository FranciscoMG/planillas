<?php
  session_start();

?>

<div id="modalDocentes" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="">&times;</a>
				<h4 class="modal-title">Registro Docentes</h4>
			</div>
      <!-- Body -->
			<form action="" method="post">
				<div class="modal-body">
					<div class="col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtCedula">Cédula:</label>
          </div>
          <div class="col-xs-8 col-sm-8 col-lg-8">
            <input type="text" class="form-control input-border" name="txtCedula" placeholder="Cédula">
          </div>
          <div class="form-group col-xs-4 col-sm-4 col-lg-4">
            <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] == 1 ) {
                echo 'disabled'; } ?> name="btnRegistrar"><span class="glyphicon glyphicon-search"></span></button>
          </div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="txtNombre">Nombre:</label>
    				<input type="text" class="form-control input-border" name="txtNombre" placeholder="Nombre">
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="txtApellidos">Apellidos:</label>
    				<input type="text" class="form-control input-border" name="txtApellidos" placeholder="Apellidos">
  				</div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboGrado">Grado Académico:</label>
            <select class="form-control" name="cboGrado">
              <option value="0">Bachillerato</option>
              <option value="1">Licenciatura</option>
              <option value="2">Maestría</option>
              <option value="3">Doctorado</option>
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboContrato">Tipo contrato:</label>
            <select class="form-control" name="cboContrato">
              <option value="0">Interino(a)</option>
              <option value="1">Propiedad</option>
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
            if ($_SESSION[masterActivo] == 1) {
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
					  <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] == 1 ) {echo 'disabled';} ?> name="btnRegistrar">Registrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
