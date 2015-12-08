<?php session_start(); ?>

<div id="modalAlertaRevisionesRechasar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Denegar datos</h4>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <div class="text-center">
          <?php
            if ($revisiones != 1) {
              echo '<p class="texto-efectos2">¿Desea denegar la información y enviarla a la oficina de <u>Docencia</u> para que se realicen las correcciones?</p>';
            } else {
              echo '<p class="texto-efectos2">¿Desea denegar la información y enviarla para que se realicen las correcciones?</p>';
            }
          ?>
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer modal-delete-border">
        <?php
          if ($revisiones == 0){
            echo '
            <a href="estadoDatos/gestorEstadoDatos.php?estadoDatos='.$estado.'&revisiones='.$revisiones.'&tipoPerfil='.$_SESSION['tipoPerfil'].'&rechasar=1&paraOficina=1" class="btn btn-success btn-sm pull-right">Si</a>';
          } else {
            echo '
            <a href="estadoDatos/gestorEstadoDatos.php?estadoDatos='.$estado.'&revisiones='.$revisiones.'&tipoPerfil='.$_SESSION['tipoPerfil'].'&rechasar=1&paraOficina=1" class="btn btn-success btn-sm pull-right btn-margin-left">Enviar a Docencia</a>';
            echo '
            <a href="estadoDatos/gestorEstadoDatos.php?estadoDatos='.$estado.'&revisiones='.$revisiones.'&tipoPerfil='.$_SESSION['tipoPerfil'].'&rechasar=1&paraOficina=2" class="btn btn-success btn-sm pull-right ">Enviar a Recursos Humanos</a>';
          }

          echo '<a  class="btn btn-danger btn-sm pull-right btn-revision" data-dismiss="modal">No</a>';
        ?>
      </div>
    </div>
  </div>
</div>
