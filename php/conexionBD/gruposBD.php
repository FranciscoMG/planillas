<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class gruposBD extends conexionBD {
	function __construct() {
    	parent::__construct();
	}

	function agregarGrupo($curso, $num_grupo, $docentes, $horarios, $jornada) {
		for ($i=0; $i < count($docentes); $i++) {
			$this->agregarGrupoDocentes($curso, $num_grupo, $docentes[$i][0], $docentes[$i][1]);
		}/*
		$stmt = $this->con->prepare("INSERT INTO tb_Docente (cedula , nombre, apellidos , grado_academico , tipo_contrato) VALUES ( ? , ? , ? , ? , ? );");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sssii', $cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();*/

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarGrupoDocentes($curso, $num_grupo, $docente, $tiempo_individual) {
		$stmt = $this->con->prepare("INSERT INTO tb_GruposDocentes VALUES (?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sis', $curso, $num_grupo, $docente);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarGrupoHorarios($horarios) {
		$stmt = $this->con->prepare("INSERT INTO tb_Docente (cedula , nombre, apellidos , grado_academico , tipo_contrato) VALUES ( ? , ? , ? , ? , ? );");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sssii', $cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}
}
?>
