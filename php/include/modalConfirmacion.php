<?php
  session_start();
?>
<!-- Modal -->
<div id="modalConfirmacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content ">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <!-- Body -->
      <div class="modal-body text-center">
        <p class="texto-efectos1">
          <?php 
            echo "¿Desea crear un respaldo de la base de datos?";
           ?>
        </p>
      <br>

         <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <a href="BD_Backup/obtenerBD.php" class="btn btn-success"> aceptar</a>
            </div>
    
            <div class="btn-group" role="group">
              <a href="masterPage.php" class="btn btn-warning"> regresar</a>
            </div>
        </div>

    </div>
    </div>
    
  </div>
</div>