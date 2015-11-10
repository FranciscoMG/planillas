<?php

session_start();


include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class usuariosBD extends conexionBD {
	function __construct()
    {
    	parent::__construct();
	}

	function autenticarUsuario($email, $password)
	{

		$stmt = $this->con->prepare("SELECT * FROM usuario where usuarioEmail = ? and usuarioPassword = ?");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $mysqli->error);
		}

		$password = md5($password);
		$stmt->bind_param('ss', $email, $password);
		$stmt->execute();
		$res = $stmt->get_result();

		if($res->num_rows == 1)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$data[] = array();
			$data['id'] = $row['idusuario'];
			$data['usuario'] = $row['usuarioNombre'].' '.$row['usuarioApellidos'];

			return $data;
		}
		return null;
	}

	function obtenerlistadoDeUsuarios()
	{
		$query = "SELECT * FROM tb_Usuario";
		$rs= $this->con->query($query);
		if($rs->num_rows > 0)
		{
			return $rs; //Retornamos las tuplas encontradas
		}
		$this->cerrar();
		return false;
	}

	function agregarUsuario($usuario, $contrasena, $nombre_usuario, $apellido_usuario, $perfil, $correo_usuario, $habilitado)
	{
		$stmt = $this->con->prepare("INSERT INTO `SIDOP`.`tb_Usuario`
									(`usuario`,
									`contrasena`,
									`nombre_usuario`,
									`apellido_usuario`,
									`perfil`,
									`correo_usuario`,
									`habilitado`)
									VALUES
									(?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?,
									 ?)");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: '. $this->con->error);
		}
		$contrasena = md5($contrasena);
		$stmt->bind_param('ssssisi', $usuario, $contrasena, $nombre_usuario, $apellido_usuario, $perfil, $correo_usuario, $habilitado);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function borrarUsuario($id)
	{
		$stmt = $this->con->prepare("DELETE FROM tb_Usuario where usuario = ?");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $mysqli->error);
		}
		$stmt->bind_param('s', $id);
		return $stmt->execute();
	}
	/*
	function modificarUsuario($id)
	{
		

		$stmt = $this->con->prepare("UPDATE `SIDOP`.`tb_Usuario` SET `contrasena` = \'124\', `nombre_usuario` = \'qw\', `apellido_usuario` = \'qw\', `perfil` = \'0\', `correo_usuario` = \'asd@asd.ase\', `habilitado` = \'1\' WHERE `tb_Usuario`.`usuario` = \'p4\';";);

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $mysqli->error);
		}
		$stmt->bind_param('i', $id);
		return $stmt->execute();
		

	}
*/
}


?>
