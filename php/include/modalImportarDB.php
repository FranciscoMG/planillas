<?php
  session_start();
?>
<!-- Modal -->
<div id="modalBD" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content ">
      <!-- Header -->
      <div class="modal-header modal-delete-border">
        <a type="button" class="close" href="masterPage.php">&times;</a>
        <h4 class="modal-title">Importar Base de Datos</h4>
      </div>
      <!-- Body -->
      <div class="modal-body text-center">
        <p class="texto-efectos1">¿Desea importar un archivo .sql y sobreescribir <br> la base de datos existente?</p>
      <br>
      <br/>Los backups se encuentran en la ruta: /var/www/html/SIDOP/backups/</p>

      <form action="BD_Backup/importarBD.php" method="POST">
         <input class="form-control" type="file" name="fileName" accept=".sql">
        <br>
         <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="submit" class="btn btn-success">importar</button>
            </div>
    
            <div class="btn-group" role="group">
              <a type="button" href="masterPage.php" class="btn btn-warning">regresar</a>
            </div>
        </div>
      </form>

    </div>
    </div>
    
  </div>
</div>

