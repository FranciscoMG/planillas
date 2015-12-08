<?php
session_start();
?>
<!-- Modal -->
<div id="modalBD" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Importar base de datos</h4>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <div class="text-center">
          <p class="texto-efectos1">¿Desea importar un archivo .sql y sobreescribir <br> la base de datos existente?</p>
          <br/>
          Los backups se encuentran en la ruta: /var/www/html/SIDOP/backups/
          <br/><br/>
        </div>
        <form action="BD_Backup/importarBD.php" method="POST">
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <input class="form-control" type="file" name="fileName" accept=".sql">
          </div>
          <br/>
          <!-- Footer -->
          <div class="modal-footer modal-delete-border">
            <div class="espacio-boton col-xs-6 col-md-6">
              <button type="submit" class="btn btn-success btn-block">Importar</button>
            </div>
            <div class="espacio-boton col-xs-6 col-md-6">
              <a type="button" href="masterPage.php" class="btn btn-warning btn-block">Regresar</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
