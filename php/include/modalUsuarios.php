<?php
  session_start();

?>


<div id="modalRegistro" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<div class="modal-header modal-delete-border">
				<a type="button" class="close" href="">&times;</a>
				<h4 class="modal-title">Registro Usuarios</h4>
			</div>
			<form action="usuarios/agregar_usuario.php" method="post">
				<div class="modal-body">
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtUsuario">Usuario:</label>
  					<input type="text" class="form-control input-border" name="txtUsuario" placeholder="Usuario" value="<?php
  						if (!empty($_SESSION['usuario'])) {
    						echo $_SESSION['usuario'];
    					}
    				 ?>">
  				</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="txtNombre">Nombre:</label>
    				<input type="text" class="form-control input-border" name="txtNombre" placeholder="Nombre" value="<?php
    					if (!empty($_SESSION['nombre_usuario'])) {
    						echo trim($_SESSION['nombre_usuario']);
    					}
  				 ?>">
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="txtApellidos">Apellidos:</label>
    				<input type="text" class="form-control input-border" name="txtApellidos" placeholder="Apellidos" value="<?php
  						if (!empty($_SESSION['apellidos'])) {
  							echo trim($_SESSION['apellidos']);
    					}
  				 ?>">
  				</div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtCorreo">Correo electrónico:</label>
            <input type="email" class="form-control input-border" name="txtCorreo" placeholder="Correo electrónico" value="<?php
              if (!empty($_SESSION['correo'])) {
                echo trim($_SESSION['correo']);
              }
           ?>">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtContrasena">Contraseña:</label>
            <input type="password" class="form-control input-border" name="txtContrasena" placeholder="Contraseña">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtConfirmar">Confirmar contraseña:</label>
            <input type="password" class="form-control input-border" name="txtConfirmar" placeholder="Confirmar contraseña">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTipoPerfil">Tipo de perfil:</label>
            <select name="cboTipoPerfil" class="form-control">
              <option value="1">Docencia</option>
              <option value="2">Recursos humanos</option>
                <?php
                  if (isset($_SESSION['masterActivo'])) {
                    if ($_SESSION['masterActivo'] == 1 ) {
                      echo "<option value='0'>Administrativo</option>";
                    }
                  }
                ?>
            </select>
          </div>

        </div>
				<div class="form-group col-xs-12 col-sm-12 col-lg-12 text-center">
					<p class="form-control-static texto-efectos1">
					<?php
						if (empty($_SESSION['mensaje-modal'])) {
              if(isset($_SESSION['masterActivo'])){
              if ($_SESSION['masterActivo'] != 1) {
							  echo "¡Usted no podrá usar el perfil hasta que administración lo revise y apruebe!";

              }
            }
						} else {
							echo $_SESSION['mensaje-modal'];
						}
						?></p>
				</div>
				<div class="modal-footer modal-delete-border">
          <?php
          if(isset($_SESSION['masterActivo'])){
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='padding-bottom:15px;' id='btn_Modificar'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
              </div>
              <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='padding-bottom:15px;' id='btn_Eliminar'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
              </div>
              <br/>";
            }
          }
          ?>
          <div class="col-xs-12 col-sm-12 col-lg-12">
					  <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar" id="btn_Agregar">Registrar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
