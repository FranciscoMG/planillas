<?php
  session_start();

?>

<div id="modalGrupos" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content col-xs-12 col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 col-lg-11 col-lg-offset-1">
			<!-- Header -->
      <div class="modal-header modal-delete-border">
				<a type="button" class="close" href="">&times;</a>
				<h4 class="modal-title">Registro Grupos</h4>
			</div>
      <!-- Body -->
			<form action="" method="post">
				<div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtCarrera">Carrera:</label>
          </div>
          <div class="col-xs-10 col-sm-10 col-lg-10">
            <select class="form-control" name="cboCarrera">
              <option>Carrera 1</option>
              <option>Carrera 2</option>
            </select>
          </div>
          <div class="form-group col-xs-2 col-sm-2 col-lg-2">
            <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] == 1 ) {
                echo 'disabled'; } ?> name="btnRegistrar"><span class="glyphicon glyphicon-search"></span></button>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtSigla">Sigla del curso:</label>
          </div>
          <div class="col-xs-10 col-sm-10 col-lg-10">
            <select class="form-control" name="cboSigla">
              <option>TM4100</option>
              <option>TM4200</option>
            </select>
          </div>
          <div class="form-group col-xs-2 col-sm-2 col-lg-2">
            <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] == 1 ) {
                echo 'disabled'; } ?> name="btnRegistrar"><span class="glyphicon glyphicon-search"></span></button>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="txtNombre">Nombre del curso:</label>
            <input type="text" class="form-control input-border" name="txtNombre" disabled>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="cboGrupo">Número de grupo:</label>
          </div>
          <div class="col-xs-10 col-sm-10 col-lg-10">
            <select class="form-control" name="cboGrupo">
              <?php
                for($i=0;$i<=59;$i++){
                  echo "<option>".$i."</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group col-xs-2 col-sm-2 col-lg-2">
            <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] == 1 ) {
                echo 'disabled'; } ?> name="btnRegistrar"><span class="glyphicon glyphicon-search"></span></button>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtDocente">Docente:</label>
          </div>
          <div class="col-xs-10 col-sm-10 col-lg-10">
            <select class="form-control" name="cboDocente">
              <option>Profesor 1</option>
              <option>Profesor 2</option>
            </select>
          </div>
          <div class="form-group col-xs-2 col-sm-2 col-lg-2">
            <button type="submit" class="btn btn-success btn-block" name="btnRegistrar"><span class="glyphicon glyphicon-plus"></span></button>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTiempoProfesor">Cantidad de tiempo individual:</label>
            <select class="form-control" name="cboTiempoProfesor">
              <option>3/4</option>
              <option>2/4</option>
              <option>1/4</option>
              <option>1/2</option>
              <option>1</option>
            </select>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label>Profesor 1 - 3/4</label>
            <button type="submit" class="btn btn-danger pull-right btn-xs" name="btnRegistrar"><span class="glyphicon glyphicon-minus"></span></button>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label for="txtCarrera">Horario:</label>
          </div>
          <div class="col-xs-2 col-sm-2 col-lg-2">
            <select class="form-control" name="cboDiaSemana">
              <?php
                $semana = array("L","K","M","J","V","S");
                for($i=0;$i<=5;$i++) {
                  echo "<option>".$semana[$i]."</option>";
                }
              ?>
            </select>
          </div>
          <div class="col-xs-1 col-sm-1 col-lg-1">
            <label for="txtCarrera">de</label>
          </div>
          <div class="col-xs-3 col-sm-3 col-lg-3">
            <select class="form-control" name="cboCarrera">
              <?php
                for($i=7;$i<=21;$i++){
                  for($j=0;$j<=50;$j+=10){
                    if($j==0){
                      echo "<option>".$i.":".$j."0</option>";
                    }else {
                      echo "<option>".$i.":".$j."</option>";
                    }
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-xs-1 col-sm-1 col-lg-1">
            <label for="txtCarrera">a</label>
          </div>
          <div class="col-xs-3 col-sm-3 col-lg-3">
            <select class="form-control" name="cboCarrera">
              <?php
                for($i=7;$i<=21;$i++){
                  for($j=0;$j<=50;$j+=10){
                    if($j==0){
                      echo "<option>".$i.":".$j."0</option>";
                    }else {
                      echo "<option>".$i.":".$j."</option>";
                    }
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group col-xs-2 col-sm-2 col-lg-2">
            <button type="submit" class="btn btn-success btn-block" name="btnRegistrar"><span class="glyphicon glyphicon-plus"></span></button>
          </div>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <label>L 8:00 - 11:50</label>
            <button type="submit" class="btn btn-danger pull-right btn-xs" name="btnRegistrar"><span class="glyphicon glyphicon-minus"></span></button>
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-lg-12">
            <label for="cboTiempo">Jornada:</label>
            <select class="form-control" name="cboTiempo">
              <option>3/4</option>
              <option>2/4</option>
              <option>1/4</option>
              <option>1/2</option>
              <option>1</option>
            </select>
          </div>
        </div>
        <!-- Mensaje -->
        <div class="form-group col-xs-12 col-sm-12 col-lg-12 text-center">
          <p class="form-control-static texto-efectos1">
          <?php
            if (!empty($_SESSION['mensaje-modal'])) {
              echo $_SESSION['mensaje-modal'];
            }
          ?></p>
        </div>
        <!-- Footer -->
        <div class="modal-footer modal-delete-border">
          <?php
            if ($_SESSION[masterActivo] == 1) {
              echo "
              <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-warning btn-block' name='btnAgregar'>Modificar</button>
              </div>
              <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='padding-bottom:15px;'>
                <button type='submit' class='btn btn-danger btn-revision btn-block' name='btnAgregar'>Eliminar</button>
              </div>
              <br/>";
            }
          ?>
          <div class="col-xs-12 col-sm-12 col-lg-12">
            <button type="submit" class="btn btn-primary btn-block" <?php if ($_SESSION[masterActivo] == 1 ) {echo 'disabled';} ?> name="btnRegistrar">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--
<form>
<div class="form-group col-xs-12 col-sm-12 col-lg-12">
	<div id="modalGrupos" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content col-xs-12 col-sm-11 col-sm-offset-1 col-md-11 col-md-offset-1 col-lg-11 col-lg-offset-1">
      	<div class="modal-header modal-delete-border">
					<button type="submit" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
        	<h4 class="modal-title">Crear curso especifico</h4>
      	</div>
      	<div class="modal-body">
        	<label>Sigla del curso</label>
					<form class="form-inline" role="form">
						<div class="form-group row">
								<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
									<select class="form-control">
										<option>TM4500</option>
										<option>TM4500</option>
										<option>TM4500</option>
									</select>
								</div>
							<div class="col-xs-4 col-sm-3 col-md-9 col-lg-3">
								<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
							</div>
					</div>
					<label>Nombre del Curso</label>
						<div class="form-group row">
							<div class="col-xs-12 col-sm-12 col-lg-12">
								<input type="text" class="form-control input-border inputColor">
							</div>
					</div>
					<label>Grupo</label>
					<div class="form-group row">
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
								<select class="form-control">
									<?php
									/*for($i=0;$i<=8;$i++){
										echo "<option>".$i."</option>";
									}*/
									?>
								</select>
							</div>
						<div class="col-xs-4 col-sm-3 col-md-9 col-lg-3">
							<button type="submit" class="form-control btn-primary btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-search"></span></button>
						</div>
				</div>
				<label>Docente</label>
				<div class="form-group row">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<select class="form-control">
								<option>Profesor1</option>
								<option>Profesor1</option>
								<option>Profesor1</option>
							</select>
						</div>
					<div class="col-xs-4 col-sm-3 col-md-9 col-lg-3">
						<button type="submit" class="form-control btn-success btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></button>
					</div>
			</div>
			<label class="col-xs-8 col-sm-8 col-md-8 col-lg-8">Tiempos individuales</label>
			<div class="form-group row">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<select class="form-control">
							<option>3/8</option>
							<option>3/4</option>
							<option>2/4</option>
							<option>1/4</option>
							<option>1/2</option>
							<option>1</option>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control input-border inputColor espacio-botones-modal">
						</div>
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 espacio-botones-modal">
							<button type="submit" class="form-control btn-success btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></button>
						</div>
					</div>
				</div>
				<label>Horario:</label>
				<div class="form-group row">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<select class="form-control">

							</select>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<select class="form-control">

							</select>
						</div>
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1">a:</label>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<select class="form-control">
								<?php
                /*
								for($i=6;$i<=22;$i++){
									for($j=0;$j<=50;$j+=10){
										if($j==0){
											echo "<option>".$i." : ".$j."0</option>";
										}else{
											echo "<option>".$i." : ".$j."</option>";
										}
									}
								} */
								?>
							</select>
						</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<button type="submit" class="btn btn-xs form-control btn-success btn-block" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></button>
					</div>
			</div>
			<label class="col-xs-12 col-sm-12 col-md-12 col-lg-12  espacio-botones-modal">Jornada</label>
			<div class="form-group row">
					<div class="col-xs-7 col-sm-7 col-md-8 col-lg-7 espacio-botones-modal">
						<select class="form-control">
							<option>3/8</option>
							<option>3/4</option>
							<option>2/4</option>
							<option>1/4</option>
							<option>1/2</option>
							<option>1</option>
						</select>
					</div>
      	<div class="modal-footer modal-delete-border">
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnModificar" disabled>Modificar</button>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-6">
							<button type="submit" class="btn btn-default btn-block espacio-botones-modal" name="btnEliminar" disabled>Eliminar</button>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-block" name="btnAgregar">Agregar</button>
						</div>
      	</div>
    	</div>
  	</div>
	</div>
</div>
</form>
</form>
-->
