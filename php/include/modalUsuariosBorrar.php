<?php
  session_start();

?>

<?php include_once("conexionBD/usuariosBD.php"); ?>
<?php $db = new usuariosBD(); ?>


<div id="modalUsuariosBorrar" class="modal fade" role="dialog">
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
                  echo "<select name='cboUsuario' class='form-control'>";
                    $resultado = $db->obtenerlistadoDeUsuarios();
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      if ($fila['usuario'] != "admin") {
                        echo "<option value='".$fila['usuario']."'>".$fila['usuario']."</option>";
                      }
                    }
                  echo "</select>";
                }
              } else {
                echo '<input type="text" class="form-control input-border" name="txtUsuario" placeholder="Usuario" ';
                    if (!empty($_SESSION['usuario'])) {
                       echo 'value="'.$_SESSION['usuario'].'"';
              }
                echo 'required>';
              }
             ?>

  				</div>

        </div>

				<div class="modal-footer modal-delete-border">
          <?php
          if(isset($_SESSION['masterActivo'])){
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div class='col-xs-12 col-sm-12 col-lg-12 espacio-boton' id='btn_Eliminar'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnEliminar'>Eliminar</button>
              </div>
              <br/>";
            }
          }
          ?>

				</div>
			</form>
		</div>
	</div>
</div>
