<?php
session_start();
?>
<!-- Modal -->
<div id="modalConfirmacion" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Respaldo base de datos</h4>
      </div>
      <!-- Body -->
      <div class="modal-body text-center">
        <p class="texto-efectos1">
          <?php
            echo "¿Desea crear un respaldo de la base de datos?";
          ?>
        </p>
        <br/>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <div class="espacio-boton col-xs-6 col-md-6">
            <a href="BD_Backup/obtenerBD.php" class="btn btn-success btn-block">Aceptar</a>
          </div>
          <div class="espacio-boton col-xs-6 col-md-6">
            <a href="masterPage.php" class="btn btn-warning btn-block">Regresar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
