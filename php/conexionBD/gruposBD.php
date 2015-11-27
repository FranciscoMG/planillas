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
		}
		for ($i=0; $i < count($horarios); $i++) {
			$diaSemana = array("L","K","M","J","V","S");
			for($dS=0;$dS< count($diaSemana);$dS++) {
				if($horarios[$i][0] == $diaSemana[$dS]) {
					$horarios[$i][0]= $dS;
				}
			}
			$this->agregarGrupoHorarios($curso, $num_grupo, $horarios[$i][0], $horarios[$i][1], $horarios[$i][2]);
		}

		$stmt = $this->con->prepare("INSERT INTO tb_Grupos VALUES (?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sid', $curso, $num_grupo, $jornada);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarGrupoDocentes($curso, $num_grupo, $docente, $tiempo_individual) {
		$stmt = $this->con->prepare("INSERT INTO tb_GruposDocentes VALUES (?, ?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('sisd', $curso, $num_grupo, $docente, $tiempo_individual);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function agregarGrupoHorarios($curso, $num_grupo, $diaSemana, $horaInicio, $horaFin) {
		$stmt = $this->con->prepare("INSERT INTO tb_GruposHorarios VALUES (?, ?, ?, ?, ?);");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}

		$stmt->bind_param('siiss', $curso, $num_grupo, $diaSemana, $horaInicio, $horaFin);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}
}
?>
