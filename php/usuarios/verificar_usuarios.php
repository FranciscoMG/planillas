
<?php include_once("../conexionBD/usuariosBD.php"); ?>
<?php include_once("../conexionBD/logBD.php"); ?>
  
<?php 
  session_start();

  $usuario= isset($_POST['txtUsuario'])?$_POST['txtUsuario']:"";
  $contrasena= isset($_POST['txtContrasena'])?$_POST['txtContrasena']:"";

  //
  $db = new usuariosBD();
  $dbLog = new logBD();
  //

  if(empty($usuario) || empty($contrasena)) {
    $_SESSION['mensaje']= "Se debe indicar el usuario y/o contraseña";
    header("Location: ../inicio.php");
  } else {
    //$sql="SELECT * FROM tb_Usuario";

  //
  $resultado = $db->obtenerlistadoDeUsuarios();
  //




  //$resultado = mysql_query($sql) or die ("Sql error".mysql_error());


  //

    while ($fila = mysqli_fetch_assoc($resultado)) {
  //
      if ($usuario == $fila['usuario']) {

        if (md5($contrasena) == $fila['contrasena']) {

          if($fila['habilitado']== 1) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipoPerfil']=$fila['perfil'];
            $_SESSION['nombre_usuario_perfil']=$fila['nombre_usuario']." ".$fila['apellido_usuario'];
            header("Location: ../masterPage.php");
	          ////////////////// LOG /////////////////////
            $utc = date("U");
            $anio = date("Y");
            $mes = date("m");
            $dia = date("d");
            $hora = date("G");
            $minuto = date("i");
            $segundo = date("s");
            @$ip = getenv(REMOTE_ADDR);
            $navegador = $_SERVER["HTTP_USER_AGENT"]; 
            $dbLog->agregarLog($utc , $anio , $mes , $dia , $hora , $minuto , $segundo , $ip , $navegador , $usuario , md5($contrasena) , $fila['nombre_usuario'] , $fila['apellido_usuario']);
            /////////////////////////////////////////////
            exit();
        } else {
          $_SESSION['mensaje']= "El perfil no está habilitado";
          header("Location: ../inicio.php");
          exit();
        }
        } else {
          $_SESSION['mensaje']="La contraseña es inválida";
          header("Location: ../inicio.php");
          exit();
        }
      } else {
        $_SESSION['mensaje']= "El usuario no existe";
      }
    }


}
  header("Location: ../inicio.php");

  echo "<script> alert('No hay información en la base de datos'); </script>";
?>
