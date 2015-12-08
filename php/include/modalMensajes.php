<?php include_once("conexionBD/usuariosBD.php"); ?>
<?php $db = new usuariosBD(); ?>

<div id="modalMensajes" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje</h4>
      </div>
      <!-- Body -->
      <form action="mensajes/manejadorMensajes.php" method="post">
        <div class="modal-body">
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboxReceptorMensaje">Para:</label>
            <select name="cboxReceptorMensaje" class='form-control'>
              <?php
              $resultado = $db->obtenerlistadoDeUsuarios();
              while ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['usuario'] != $_SESSION['usuario']) {
                  echo "<option value='".$fila['usuario']."'>";
                  echo $fila['nombre_usuario']." ".$fila['apellido_usuario'];
                  echo "</option>";
                }
              }
              ?>
            </select>
          </div>
          <br>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="contenido_mensaje">Contenido:</label>
            <textarea name="contenido_mensaje" maxlength="250" class='form-control'></textarea>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div class="col-xs-12 col-sm-12 col-lg-12 espacio-boton">
            <button type="submit" class="btn btn-success" name="enviarMensaje">Enviar</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
