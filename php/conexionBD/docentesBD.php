<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class docentesBD extends conexionBD {
	function __construct()
    {
    	parent::__construct();
	}


	function obtenerDocentes() {
		$query = "SELECT * FROM tb_Docente";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function agregarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato) {
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Docente`
																(`cedula`,
																`nombre`,
																`apellidos`,
																`grado_academico`,
																`tipo_contrato`) VALUES (
																	?,
																	?,
																	?,
																	?,
																	?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		echo $cedula.', '.$nombre.', '.$apellidos.', '.$grado_academico.', '.$tipo_contrato;
		$stmt->bind_param('sssii', $cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato);
		printf("Error: %s.\n", mysqli_stmt_error($sentencia));
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function modificarDocente($cedula, $nombre, $apellidos, $grado_academico, $tipo_contrato) {
		$stmt = $this->con->prepare("UPDATE tb_Docente SET nombre = ?, apellidos = ?, grado_academico = ?, tipo_contrato = ? WHERE cedula = ?;");

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $this->con->error);
		}
		$stmt->bind_param('ssiis', $nombre, $apellidos, $grado_academico, $tipo_contrato, $cedula);
		$stmt->execute();
		$stmt->close();
		return true;
	}

	function borrarDocente($cedula) {
		$stmt = $this->con->prepare("DELETE FROM tb_Docente WHERE cedula = ?");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' .$this->con->error);
		}
		$stmt->bind_param('s', $cedula);
		return $stmt->execute();
	}
}

?>
