<?php
  mysql_connect("localhost","root","interactivas") or die ("Error al realizar la conexión inicial: ".mysql_error());

  mysql_query("CREATE DATABASE SIDOP;") or die ("Error a crear la base de datos: ".mysql_error());
  mysql_select_db("SIDOP");

  mysql_query("CREATE TABLE tb_Usuario (
               usuario VARCHAR(20) PRIMARY KEY,
               contrasena VARCHAR(80) NOT NULL,
               nombre_usuario VARCHAR(20) NOT NULL,
               apellido_usuario VARCHAR(40) NOT NULL,
               perfil INT(1) NOT NULL,
               correo_usuario VARCHAR(40) NOT NULL);") or die ("Error a crear la base de datos: ".mysql_error());

  mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, ALTER, SUPER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO 'admin_db'@'localhost' IDENTIFIED BY PASSWORD '*FCF9D342730D26CEEDE3BF8E23DF7040CC0BA26B';");

  mysql_query("INSERT INTO 'tb_Usuario' VALUES ('administrador', 'admin', 'Administrador', 'Apellido', '0', 'micorreo@esunamentira.com');");
  
  echo ("La base fue creada correctamente.");
?>
