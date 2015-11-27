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
	}
	return $valor;
} // fin de funcion


 ?>
