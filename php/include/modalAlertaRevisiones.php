<?php session_start(); ?>

<div id="modalAlertaRevisiones" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <?php
          if ($_SESSION['tipoPerfil'] != 0) {
            echo '<h4 class="modal-title ">Enviar a Revisión</h4>';
          } else {
            echo '<h4 class="modal-title ">Aprobar Datos</h4>';
          }
        ?>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <div class="text-center">
          <?php
            if ($revisiones == 0) {
              if ($_SESSION['tipoPerfil'] == 0) {
                echo '<p class="texto-efectos2">¿Desea aprobar los datos y enviarlos a la oficina de <u>Recursos Humanos</u> para que se asignen los presupuestos?</p>';
              } else {
                echo '<p class="texto-efectos2">¿Desea enviar la información a la oficina de <u>Dirección</u> para su aprobación?</p>';
              }
            } else {
              if ($_SESSION['tipoPerfil'] == 0) {
                echo '<p class="texto-efectos2">¿Desea <u>finalizar</u> todo el proceso? Recuerde que una vez finalizado ya no podrá hacer más cambios y todos los datos se congelarán</p>';
              } else {
                echo '<p class="texto-efectos2">¿Desea enviar la información a la oficina de <u>Dirección</u> para su aprobación?</u></p>';
              }
            }
          ?>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer modal-delete-border">
        <?php
          if ($revisiones == 1 && $_SESSION['tipoPerfil'] == 0) {
            echo '<div class=""><a class="btn btn-success btn-sm pull-right">Finalizar Proceso</a></div>';
          } else {
            echo '<div class=""><a href="estadoDatos/gestorEstadoDatos.php?estadoDatos='.$estado.'&revisiones='.$revisiones.'&tipoPerfil='.$_SESSION['tipoPerfil'].'&enviar=1" class="btn btn-success btn-sm pull-right" class="btn btn-success btn-sm pull-right">Si</a></div>
            <div class=""><a class="btn btn-danger btn-sm pull-right btn-revision" data-dismiss="modal">No</a></div>';
          }
        ?>
      </div>
    </div>
  </div>
</div>
