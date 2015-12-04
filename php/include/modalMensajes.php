<?php include_once("conexionBD/usuariosBD.php"); ?>
<?php $db = new usuariosBD(); ?>

<div id="modalMensajes" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje</h4>
      </div>
    <form action="mensajes/manejadorMensajes.php" method="POST">
      <div class="modal-body">
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
        <br>
        <label for="contenido_mensaje" >Contenido:</label>
        <textarea name="contenido_mensaje" maxlength="250" class='form-control'></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="enviarMensaje"> Enviar </button>
      </div>
    </form>
    </div>

  </div>
</div>