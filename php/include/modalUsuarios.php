<?php
  session_start();
?>

<?php include_once("conexionBD/usuariosBD.php"); ?>
<?php $db = new usuariosBD(); ?>


<div id="modalRegistro" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<div class="modal-header modal-delete-border">
				<a type="button" class="close" href="
          <?php
            if ($_SESSION['masterActivo'] == 1) {
              $_SESSION['registrando'] = 0;
              echo 'sesion/cerrarModal.php';
            } else {
              echo 'sesion/cerrarSesion.php';
            }
           ?>
        ">&times;</a>
				<h4 class="modal-title">Registro Usuarios</h4>
			</div>
			<form action="usuarios/agregar_usuario.php" method="post">
				<div class="modal-body">
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
  					<label for="txtUsuario">Usuario:</label>
            <?php
              if (isset($_SESSION['masterActivo'])) {
                if ($_SESSION['masterActivo'] == 1) {
                  echo "<select name='cboUsuario' class='form-control' onchange='cargarDatosUsuarios(this)'>";
                    $resultado = $db->obtenerlistadoDeUsuarios();
                    if (isset($_GET['modalUsuarios'])) {
                      echo "<option value='".$_GET['usuario']."'>".$_GET['usuario']."</option>";
                    }
                    else
                     {
                      echo "<option></option>";
                    }
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      if ($fila['usuario'] != "admin" && $fila['usuario'] != $_GET['usuario']) {
                        echo "<option value='".$fila['usuario']."'>".$fila['usuario']."</option>";
                      }
                    }
                  echo "</select>";
                }
              } else {
                echo '<input maxlength="20" type="text" class="form-control input-border" maxlength="19" name="txtUsuario" placeholder="Usuario" ';
                    if (!empty($_SESSION['usuario'])) {
                       echo 'value="'.$_SESSION['usuario'].'"';
              }
                echo 'required>';
              }
             ?>

  				</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="txtNombre">Nombre:</label>
    				<input required maxlength="20" type="text" class="form-control input-border" maxlength="19" name="txtNombre" placeholder="Nombre" value="<?php
            if (isset($_GET['modalUsuarios'])) {
              echo $_GET['nombre_usuario'];
            } else {
    					if (!empty($_SESSION['nombre_usuario'])) {
    						echo trim($_SESSION['nombre_usuario']);
    					}
            }
  				 ?>">
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="txtApellidos">Apellidos:</label>
    				<input required maxlength="40" type="text" class="form-control input-border" maxlength="39" name="txtApellidos" placeholder="Apellidos" value="<?php
            if (isset($_GET['modalUsuarios'])) {
              echo $_GET['apellido_usuario'];
            } else {
  						if (!empty($_SESSION['apellidos'])) {
  							echo trim($_SESSION['apellidos']);
    					}
            }
  				 ?>">
  				</div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtCorreo">Correo electrónico:</label>
            <input required type="email" class="form-control input-border" name="txtCorreo" maxlength="39" placeholder="Correo electrónico" value="<?php
            if (isset($_GET['modalUsuarios'])) {
              echo $_GET['correo_usuario'];
            } else {
              if (!empty($_SESSION['correo'])) {
                echo trim($_SESSION['correo']);
              }
            }
           ?>">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtContrasena">Contraseña:</label>
            <input required type="password" class="form-control input-border" name="txtContrasena" maxlength="16" placeholder="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="La contraseña debe tener al menos un numero, una letra mayúscula, letras minúsculas y mínimo 8 carácteres o más. ">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtConfirmar">Confirmar contraseña:</label>
            <input required type="password" class="form-control input-border" name="txtConfirmar" maxlength="16" placeholder="Confirmar contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="La contraseña debe tener al menos un numero, una letra mayúscula, letras minúsculas y mínimo 8 carácteres o más. ">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTipoPerfil">Tipo de perfil:</label>
            <select name="cboTipoPerfil" class="form-control">
            <?php
            if (isset($_GET['modalUsuarios'])) {
              $perfil="";
              if ($_GET['perfil'] == 0) {
                echo
              '<option value="0">Administrativo</option>
              <option value="1">Docencia</option>
              <option value="2">Recursos humanos</option>';
              }
              if ($_GET['perfil'] == 1) {
                echo
              '<option value="1">Docencia</option>
              <option value="0">Administrativo</option>
              <option value="2">Recursos humanos</option>';
              }
              if ($_GET['perfil'] == 2) {
               echo
              '<option value="2">Recursos humanos</option>
              <option value="0">Administrativo</option>
              <option value="1">Docencia</option>';
              }
            } else {
              echo '
              <option value="1">Docencia</option>
              <option value="2">Recursos humanos</option>
              <option value="0">Administrativo</option>';
            }
              ?>
            </select>
          </div>

        </div>
				<div class="modal-footer modal-delete-border">
          <?php
          if(isset($_SESSION['masterActivo'])){
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div class='col-xs-12 col-sm-12 col-lg-12 espacio-boton' id='btn_Modificar'>
                <button type='submit' class='btn btn-warning btn-block' name='btnModificar'>Modificar</button>
              </div>
              <br/>";
            }
          } else {
            echo '<div class="col-xs-12 col-sm-12 col-lg-12 espacio-boton" id="btn_Agregar">
            <button type="submit" class="btn btn-primary btn-block" name="btnRegistrar" id="btn_Agregar">Registrar</button>
          </div>';
          }
          ?>

				</div>
			</form>
		</div>
	</div>
</div>
