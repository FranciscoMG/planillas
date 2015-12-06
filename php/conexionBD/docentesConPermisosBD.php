<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class docentesConPermisoBD extends conexionBD {
	function __construct()
    {
    	parent::__construct();
	}

	function obtenerUnDocenteConPermiso($id) {
		$query = "SELECT * FROM tb_DocenteConPermiso WHERE cedula = '".$id."';";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function obtenerDocentesConPermiso() {
		$query = "SELECT * FROM tb_DocenteConPermiso ;";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function agregarDocenteConPermiso($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso) {
		$stmt = $this->con->prepare("INSERT INTO tb_DocenteConPermiso (cedula , nombre, apellidos , grado_academico , tipo_contrato , fk_presupuesto , jornada_docenteConPermiso) VALUES ( ? , ? , ? , ? , ? , ? , ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sssiiid', $cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function modificarDocenteConPermiso($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato , $fk_presupuesto , $jornada_docenteConPermiso) {
		$stmt = $this->con->prepare("UPDATE `SIDOP`.`tb_DocenteConPermiso` SET `nombre` = ?, `apellidos` = ?, `grado_academico` = ?, `tipo_contrato` = ?, `fk_presupuesto` = ?, `jornada_docenteConPermiso` = ? WHERE `tb_DocenteConPermiso`.`cedula` = ?;
");

		if ( $stmt === FALSE ) {
		  return false;
		}
		$stmt->bind_param('ssiiids', $nombre, $apellidos, $grado_academico, $tipo_contrato, $fk_presupuesto, $jornada_docenteConPermiso , $cedula);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	function borrarDocenteConPermiso($cedula) {
		$stmt = $this->con->prepare("DELETE FROM tb_DocenteConPermiso WHERE cedula = ?;");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('s', $cedula);
		return $stmt->execute();
	}
}

?>
