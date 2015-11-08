<?php
include_once("conexionBD.php");
//Nuestra clase solo para manejar a los usuarios hereda de la clase principal de conexión
class usuariosBD extends conexionBD
{
	function __construct($host, $userdb, $passworddb, $dbname)
    {
    	parent::__construct($host, $userdb, $passworddb, $dbname);
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
		  die('prepare() failed: ' . $this->con->error);
		}
		$password = md5($password);
		$stmt->bind_param('sssssisi', $usuario, $contrasena, $nombre_usuario, $apellido_usuario, $perfil, $correo_usuario, $habilitado);
		$stmt->execute();
		$newId = $stmt->insert_id;
		$stmt->close();

		return (!is_nan($newId)) ? $newId : FALSE; //Asignación Ternaria
	}

	function borrarUsuario($id)
	{
		$stmt = $this->con->prepare("DELETE FROM usuario where idusuario = ?");
		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $mysqli->error);
		}
		$stmt->bind_param('i', $id);
		return $stmt->execute();
	}
	function modificarUsuario($id)
	{	
		/*$sql = "UPDATE `udemodb`.`usuario` SET `usuarioNombre` = \'noonn\', `usuarioApellidos` = \'apee\', `usuarioEmail` = \'admin@.admin.co\', `usuarioPassword` = \'1234\', `usuarioTelefono` = \'112233445\' WHERE `usuario`.`idusuario` = 2;"; 

		$stmt = $this->con->prepare("UPDATE `udemodb`.`usuario` SET `usuarioNombre` = \'?\', `usuarioApellidos` = \'?\', `usuarioEmail` = \'?\', `usuarioPassword` = \'?\', `usuarioTelefono` = \'?\' WHERE `usuario`.`idusuario` = ?;"); 

		if ( $stmt === FALSE ) {
		  die('prepare() failed: ' . $mysqli->error);
		}
		$stmt->bind_param('i', $id);
		return $stmt->execute();
		*/
		
	}
	
}


?>
