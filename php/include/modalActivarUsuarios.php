<?php
  session_start();
?>
<?php include_once("conexionBD/usuariosBD.php"); ?>
<?php $db = new usuariosBD(); ?>

<div id="modalActivarUsuarios" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="">&times;</a>
				<h4 class="modal-title">Activar usuarios</h4>
			</div>
      <!-- Body -->
			<form action="usuarios/agregar_usuario.php" method="post">
				<div class="modal-body">
         
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
    				<label for="cboUsuariosHabilitar">Usuario</label>
            <select class="form-control" name="cboUsuariosHabilitar">
              <?php
                $resultado = $db->obtenerlistadoDeUsuarios();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    if ($fila['usuario'] != "admin") {
                      if ($fila['habilitado'] == 1) {
                       echo "<option style='color: green;' value='".$fila['usuario']."'>".$fila['usuario']."</option>";
                      } else {
                       echo "<option style='color: gray;' value='".$fila['usuario']."'>".$fila['usuario']."</option>";

                      }
                    }
                  }
                  echo "</select>";
              ?>
              <div class="radio">
                  <label><input type="radio" name="isHabilitado" value="si" >Habilitar</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="isHabilitado" value="no" >Deshabilitar</label>
              </div>
           
            </select>
  				</div>
        </div>
        <!-- boton -->
				<div class="form-group col-xs-12 col-sm-12 col-lg-12 text-center">
				  <div class="col-xs-12 col-sm-12 col-lg-12">
					  <button type="submit" class="btn btn-primary btn-block" name="btnModificarHabilitado">Realizar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
