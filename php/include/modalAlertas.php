<?php session_start(); ?>

<div id="modalAlertas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <div class="text-center">
          <p class="texto-efectos1"><?php echo $_SESSION['alerta-contenido']; ?></p>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer modal-delete-border">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
