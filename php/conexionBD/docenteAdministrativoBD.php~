<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class docenteAdministrativoBD extends conexionBD {
	function __construct()
    {
    	parent::__construct();
	}

	function obtenerUnDocenteAdministrativo($id) {
		$query = "SELECT * FROM tb_DocenteAdministrativo WHERE cedula = '".$id."';";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function obtenerDocenteAdministrativo() {
		$query = "SELECT * FROM tb_DocenteAdministrativo ;";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function agregarDocenteAdministrativo($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteAdministrativo) {
		$stmt = $this->con->prepare("INSERT INTO tb_DocenteAdministrativo (cedula , nombre, apellidos , grado_academico , tipo_contrato , fk_presupuesto , jornada_docenteAdministrativo) VALUES ( ? , ? , ? , ? , ? , ? , ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sssiiid', $cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteAdministrativo);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function modificarDocenteAdministrativo($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteAdministrativo) {
		$stmt = $this->con->prepare("UPDATE `SIDOP`.`tb_DocenteAdministrativo` SET `nombre` = ?, `apellidos` = ?, `grado_academico` = ?, `tipo_contrato` = ?, `fk_presupuesto` = ?, `jornada_docenteAdministrativo` = ? WHERE `tb_DocenteAdministrativo`.`cedula` = ?;
");

		if ( $stmt === FALSE ) {
		  return false;
		}
		$stmt->bind_param('ssiiids', $nombre, $apellidos, $grado_academico, $tipo_contrato, $fk_presupuesto, $jornada_docenteAdministrativo , $cedula);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	function borrarDocenteAdministrativo($cedula) {
		$stmt = $this->con->prepare("DELETE FROM tb_DocenteAdministrativo WHERE cedula = ?;");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('s', $cedula);
		return $stmt->execute();
	}
}

?>
