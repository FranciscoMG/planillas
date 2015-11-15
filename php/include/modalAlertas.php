<?php session_start(); ?>
<!-- Modal -->
<div id="modalAlertas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title ">Alerta</h4>
      </div>
      <div class="modal-body text-danger">
        <p><?php echo $_SESSION['alerta-contenido']; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>