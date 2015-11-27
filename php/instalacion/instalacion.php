<?php
  mysql_connect("localhost","root","interactivas") or die ("Error al realizar la conexión inicial: ".mysql_error());

  mysql_query("CREATE DATABASE SIDOP DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;") or die ("Error a crear la base de datos: ".mysql_error());
  mysql_select_db("SIDOP");

  mysql_query("CREATE TABLE tb_Usuario (
               usuario VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci PRIMARY KEY,
               contrasena VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
               nombre_usuario VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
               apellido_usuario VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
               perfil INT(1) NOT NULL,
               correo_usuario VARCHAR(80) NOT NULL,
               habilitado BOOLEAN NOT NULL) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;") or die ("Error a crear la base de datos: ".mysql_error());

  mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, ALTER, SUPER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO 'admin_db'@'localhost' IDENTIFIED BY PASSWORD '*FCF9D342730D26CEEDE3BF8E23DF7040CC0BA26B';") or die ("Error al crear el usuario: ".mysql_error());

  mysql_query("INSERT INTO tb_Usuario VALUES ('admin', 'abc93ffecd07d06922d1232c7beff0a8', 'Administrador', 'del Sistema', '0', '', '1');") or die ("Error al insertar el primer usuario: ".mysql_error());

  mysql_query("CREATE TABLE tb_Docente (
    cedula varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    nombre varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    apellidos varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    grado_academico int(1) NOT NULL,
    tipo_contrato int(1) NOT NULL,
    PRIMARY KEY (`cedula`)) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

  mysql_query("CREATE TABLE tb_Cursos (
    sigla varchar(10) not null primary key,
    nombre_curso varchar(100) not null,
    creditos int not null,
    jornada double not null
    );") or die ("Error al crear la tabla tb_Cursos".mysql_error());

  echo ("La base fue creada correctamente. <a href='../../index.php'>Inicie el sistema</a>");
?>
