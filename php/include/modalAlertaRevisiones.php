<?php session_start(); ?>



<!-- Modal -->
<div id="modalAlertaRevisiones" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <?php 
        if ($_SESSION['tipoPerfil'] != 0) {
          echo '<h4 class="modal-title ">Enviar a Revisión</h4>';
        } else {
          echo '<h4 class="modal-title ">Aprovar Datos</h4>';
        }

         ?>
      </div>
      <div class="modal-body text-center">

      <?php 
      if ($revisiones == 0) {
        if ($_SESSION['tipoPerfil'] == 0) {
        echo '<p class="texto-efectos2">¿Desea Aprovar los datos y enviarlos a la oficina de <u>Recursos Humanos</u> para que se asignen los presupuestos?</p>';
        } else {
          echo '<p class="texto-efectos2">¿Desea enviar la información a la oficina de <u>Dirección</u> para su aprovación?</p>';
        }
      } else {
        if ($_SESSION['tipoPerfil'] == 0) {
          echo '<p class="texto-efectos2">¿Desea finalizar todo el proceso? Recuerde que una vez finalizado ya no podrá hacer más cambios y todos los datos se conjelarán</p>';
        } else {
        echo '<p class="texto-efectos2">¿Desea enviar la información a la oficina de <u>Dirección</u> para su aprovación?</u></p>';
      }
      }

       ?>

      </div>
      <div class="modal-footer">

      <?php 
      if ($revisiones == 1 && $_SESSION['tipoPerfil'] == 0) {
          echo '<a class="btn btn-success btn-sm pull-right " >Finalizar Proceso</a>';
        } else {

       echo '
        <a href="estadoDatos/gestorEstadoDatos.php?estadoDatos='.$estado.'&revisiones='.$revisiones.'&tipoPerfil='.$_SESSION['tipoPerfil'].'&enviar=1" class="btn btn-success btn-sm pull-right" class="btn btn-success btn-sm pull-right">Si</a>

        <a  class="btn btn-danger btn-sm pull-right btn-revision" data-dismiss="modal">No</a> ';
      }
        ?>

      </div>
    </div>

  </div>
</div>