<?php include_once("../conexionBD/presupuestoDocenteBD.php"); ?>
<?php $dbPresupuestoDocente = new presupuestoDocenteBD() ?>
<?php include_once("../conexionBD/docentesConPermisosBD.php"); ?>
<?php $dbDocentesConPermisos = new docentesConPermisoBD(); ?>
<?php include_once("../conexionBD/gruposBD.php"); ?>
<?php $dbGrupos = new gruposBD(); ?>

<?php

/////////////////////// Verifica que un docente no se pase de 1 tiempo ///////////////
function verificarTiemposDocente($id){
	/////////////////////////
	global $dbDocentesConPermisos , $dbPresupuestoDocente , $dbGrupos;

	$cedula = $id;
	$totalTiempos = 0;
	//// verifica de la tabal docente con permisos temporales
	$resultad = $dbDocentesConPermisos->obtenerDocentesConPermiso();
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
