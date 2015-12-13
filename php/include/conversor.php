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
		default:
			$valor = 0;
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
		default:
			$valor = "Ad honorem";
			break;
	}
	return $valor;
} // fin de funcion
////////////////////////////////////////////////////
function convertirDiaSemanaInt($letraDiaSemana) {
	$diaSemana = array("L","K","M","J","V","S");
	for($dS=0;$dS< count($diaSemana);$dS++) {
		if($letraDiaSemana == $diaSemana[$dS]) {
			return $dS;
		}
	}
	return -1;
}

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

?>
