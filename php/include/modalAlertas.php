<?php session_start(); ?>

<div id="modalAlertas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php if ($_SESSION['alerta'] == 1) {echo "Alerta";} else {echo"<br/>";} ?></h4>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <div class="text-center">
        <?php
        if ($_SESSION['alerta'] == 1) {
          echo '<p class="texto-efectos1">';
            echo $_SESSION['alerta-contenido'];
        } else {
          if ($_SESSION['alerta'] == 2) {
            echo '<p class="texto-efectos2">';
            echo $_SESSION['alerta-contenido'];
          } else {
            if ($_SESSION['alerta'] == 3) {
            echo '<p class="">';
            echo $_SESSION['alerta-contenido'];
          }
        }
      }
        echo "</p>";
        ?>
        
        </div>
      </div>
      <!-- Footer -->
      <div class="modal-footer modal-delete-border">
      <?php 
      if ($_SESSION['alerta'] == 1) {
        echo ' <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar </button>';
        } else {
          if ($_SESSION['alerta'] == 2) {
          echo ' <button type="button" class="btn btn-success" data-dismiss="modal"> Aceptar </button>';
          } else {
            if ($_SESSION['alerta'] == 3) {
              echo ' <button type="button" class="btn btn-info" data-dismiss="modal"> Aceptar </button>';
            }
          }
        }
        ?>
        
      </div>
    </div>
  </div>
</div>
