<?php include_once("conexionBD/presupuestoDocenteBD.php"); ?>
<?php $dbPresupuestoDocente = new presupuestoDocenteBD() ?>
<?php include_once("conexionBD/docentesConPermisosBD.php"); ?>
<?php $dbDocentesConPermisos = new docentesConPermisoBD(); ?>
<?php include_once("conexionBD/gruposBD.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>


<?php

function convertirFraccionesDoble($fraccion){
	$valor = 0.0;
	switch ($fraccion) {
		case '1':
			$valor = 1.000;
			break;
		case '7/8':
			$valor = 0.875;
			break;
		case '3/4':
			$valor = 0.750;
			break;
		case '5/8':
			$valor = 0.625;
			break;
		case '1/2':
			$valor = 0.500;
			break;

		case '3/8':
			$valor = 0.375;
			break;
		case '1/4':
			$valor = 0.250;
			break;
		case '1/8':
			$valor = 0.125;
			break;
		case '1/16':
			$valor = 0.0625;
			break;
	}
	return $valor;
} // fin de funcion

//////////////////////////////////////////////////
function convertirDobleFraciones ($fdouble) {
	$valor = "";
	switch ($fdouble) {
		case 1:
			$valor = "1";
			break;
		case 0.875:
			$valor = "7/8";
			break;
		case 0.750:
			$valor = "3/4";
			break;
		case 0.625:
			$valor = "5/8";
			break;
		case 0.5:
			$valor = "1/2";
			break;

		case 0.375:
			$valor = "3/8";
			break;
		case 0.250:
			$valor = "1/4";
			break;
		case 0.125:
			$valor = "1/8";
			break;
		case 0.0625:
			$valor = "1/16";
			break;
	}
	return $valor;
} // fin de funcion

function convertirIntDiaSemana($intDS) {
  $diaSemana = array("L","K","M","J","V","S");
	return $diaSemana[$intDS];
}
////////////////////////////////////////////////////
function fraccionADecimalPresupuesto($fraccion) {
	$tamano = strlen($fraccion);


	if($tamano == 1 || $tamano ==2) {
		$final = (double) $fraccion;
	}
	if($tamano == 3) {
		switch ($fraccion) {
		case '1':
			$valor = 1.000;
			break;
		case '7/8':
			$valor = 0.875;
			break;
		case '3/4':
			$valor = 0.750;
			break;
		case '5/8':
			$valor = 0.625;
			break;
		case '1/2':
			$valor = 0.500;
			break;
		case '3/8':
			$valor = 0.375;
			break;
		case '1/4':
			$valor = 0.250;
			break;
		case '1/8':
			$valor = 0.125;
			break;
		case '1/16':
			$valor = 0.0625;
			break;
		}
		$final =  $valor;
	}
	if($tamano == 5) {
		$double = (double) substr($fraccion, 0, 1);
		$fraccion = substr($fraccion, 2, 3);;

		switch ($fraccion) {
		case '1':
			$valor = 1.000;
			break;
		case '7/8':
			$valor = 0.875;
			break;
		case '3/4':
			$valor = 0.750;
			break;
		case '5/8':
			$valor = 0.625;
			break;
		case '1/2':
			$valor = 0.500;
			break;

		case '3/8':
			$valor = 0.375;
			break;
		case '1/4':
			$valor = 0.250;
			break;
		case '1/8':
			$valor = 0.125;
			break;
		case '1/16':
			$valor = 0.0625;
			break;
		}

		$double2 = $valor;
		$final = $double2 + $double;

	}
	if($tamano == 6) {
		$double = (double) substr($fraccion, 0, 2);
		$fraccion = substr($fraccion, 3, 3);;

		switch ($fraccion) {
		case '1':
			$valor = 1.000;
			break;
		case '7/8':
			$valor = 0.875;
			break;
		case '3/4':
			$valor = 0.750;
			break;
		case '5/8':
			$valor = 0.625;
			break;
		case '1/2':
			$valor = 0.500;
			break;
		case '3/8':
			$valor = 0.375;
			break;
		case '1/4':
			$valor = 0.250;
			break;
		case '1/8':
			$valor = 0.125;
			break;
		case '1/16':
			$valor = 0.0625;
			break;
		}

		$double2 = $valor;
		$final = $double + $double2;
	}
	return $final;
}

/////////////////////// Verifica que un docente no se pase de 1 tiempo ///////////////
function verificarTiemposDocente($id){
	/////////////////////////
	$cedula = $id;
	$totalTiempos = 0;

	//// verifica de la tabal docente con permisos temporales
	$resultado1 = $dbDocentesConPermisos->obtenerDocentesConPermiso();
	while ($fila1 = mysqli_fetch_assoc($resultado1)) {
		if ($fila1['cedula'] == $cedula && $fila1['fk_presupuesto'] != null) {
			//echo $fila1['cedula']."string <br>";
			$totalTiempos = ($totalTiempos + $fila1['jornada_docenteConPermiso']);
		}
	}
	////////////////////////////

	/// verifica la tabla de grupoDocente
	$resultado2 = $dbGrupos->obtenerGrupoDocentes();
	while ($fila2 = mysqli_fetch_assoc($resultado2)) {
		if ($fila2['fk_docente'] == $cedula && $fila2['fk_presupuesto'] != null) {
			//echo $fila2['fk_docente']."string <br>";
			$totalTiempos = ($totalTiempos + $fila2['tiempo_individual']);
		}
	}
	///////////////////////////

	////// verifica la tabla de presupuestoDocente 
	$resultado3 = $dbPresupuestoDocente->obtenerlistadoDePresupuestoDocente();
	while ($fila3 = mysqli_fetch_assoc($resultado3)) {
		if ($fila3['fk_docente'] == $cedula) {
			echo $fila3['fk_docente']."string <br>";
			$totalTiempos = ($totalTiempos + $fila3['jornada']);
		}
	}
	//////////////////////////
 	return $totalTiempos;
} //// Fin de la funcion

 ?>
