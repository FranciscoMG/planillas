<?php
<<<<<<< HEAD
  mysql_connect("localhost","root","interactivas") or die ("Error al realizar la conexión inicial: ".mysql_error());
=======
  mysql_connect("localhost","root","") or die ("Error al realizar la conexión inicial: ".mysql_error());
>>>>>>> fd62a098bf25dad4b80098c86b0827131def3925

  mysql_query("CREATE DATABASE SIDOP;") or die ("Error a crear la base de datos: ".mysql_error());
  mysql_select_db("SIDOP");

  mysql_query("CREATE TABLE tb_Usuario (
               usuario VARCHAR(20) PRIMARY KEY,
               contrasena VARCHAR(40) NOT NULL,
               nombre_usuario VARCHAR(20) NOT NULL,
               apellido_usuario VARCHAR(60) NOT NULL,
               perfil INT(1) NOT NULL,
               correo_usuario VARCHAR(80) NOT NULL,
               habilitado BOOLEAN NOT NULL);") or die ("Error a crear la base de datos: ".mysql_error());

  mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, ALTER, SUPER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO 'admin_db'@'localhost' IDENTIFIED BY PASSWORD '*FCF9D342730D26CEEDE3BF8E23DF7040CC0BA26B';") or die ("Error al crear el usuario: ".mysql_error());

<<<<<<< HEAD
  mysql_query("INSERT INTO tb_Usuario VALUES ('admin', 'abc93ffecd07d06922d1232c7beff0a8', 'Administrador', 'del Sistema', '0', '', '1');") or die ("Error al insertar el primer usuario: ".mysql_error());

  echo ("La base fue creada correctamente. <a href='../../index.php'>Inicie el sistema</a>");
=======
  mysql_query("INSERT INTO `SIDOP`.`tb_Usuario` (`usuario`, `contrasena`, `nombre_usuario`, `apellido_usuario`, `perfil`, `correo_usuario`, `habilitado`) VALUES ('administrador', '123', 'pedro', 'rodriguez', '1', 'asdad@asd.com', '1');") or die ("Error al insertar el primer usuaio".mysql_error());

  echo ("La base fue creada correctamente.");
>>>>>>> fd62a098bf25dad4b80098c86b0827131def3925
?>
