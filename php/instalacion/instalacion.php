<?php
  //Conexión
  mysql_connect("localhost","root","interactivas") or die ("Error al realizar la conexión inicial: ".mysql_error());

  //Creación base de datos
  mysql_query("CREATE DATABASE IF NOT EXISTS SIDOP DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;") or die ("Error al crear la base de datos: ".mysql_error());
  mysql_select_db("SIDOP");

  //Creación usuario de la base de datos
  mysql_query("GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, ALTER, SUPER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO 'admin_db'@'localhost' IDENTIFIED BY PASSWORD '*FCF9D342730D26CEEDE3BF8E23DF7040CC0BA26B';") or die ("Error al crear el usuario de la base de datos: ".mysql_error());

  //Creación de las tablas

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Usuario (
  usuario varchar(20) NOT NULL,
  contrasena varchar(80) NOT NULL,
  nombre_usuario varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  apellido_usuario varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  perfil int(1) NOT NULL,
  correo_usuario varchar(40) NOT NULL,
  habilitado int(1) NOT NULL,
  PRIMARY KEY (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error a crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Usuario VALUES ('admin', 'abc93ffecd07d06922d1232c7beff0a8', 'Administrador', 'del Sistema', '0', '', '1');") or die ("Error al insertar el usuario administrador de la página: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Carrera (
  id_carrera varchar(8) NOT NULL,
  nombre_carrera varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id_carrera)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Carrera (id_carrera, nombre_carrera) VALUES
  ('1', '1'),
  ('110000', 'Sistema de Estudios Generales'),
  ('320208', 'Enseñanza del Inglés'),
  ('330102', 'Dirección de Empresas'),
  ('330208', 'Administración Aduanera y Comercio Exterior'),
  ('420201', 'Ingeniería Eléctrica'),
  ('600002', 'Informática Empresarial'),
  ('600502', 'Informática y Tecnología Multimedia');") or die ("Error al crear las carreras: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Cursos (
  sigla varchar(10) NOT NULL,
  nombre_curso varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  creditos int(11) NOT NULL,
  jornada double NOT NULL,
  PRIMARY KEY (sigla)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Cursos (sigla, nombre_curso, creditos, jornada) VALUES
('1', '1', 0, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Docente (
  cedula varchar(25) NOT NULL,
  nombre varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  apellidos varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  grado_academico int(1) NOT NULL,
  tipo_contrato int(1) NOT NULL,
  PRIMARY KEY (cedula)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Docente (cedula, nombre, apellidos, grado_academico, tipo_contrato) VALUES
('1', '1', '1', 0, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_DocenteAdministrativo (
  cedula varchar(25) NOT NULL,
  nombre varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  apellidos varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  grado_academico int(1) NOT NULL,
  tipo_contrato int(1) NOT NULL,
  fk_presupuesto int(11) NOT NULL,
  jornada_docenteAdministrativo double DEFAULT NULL,
  PRIMARY KEY (cedula),
  KEY fk_presupuesto (fk_presupuesto)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_DocenteAdministrativo (cedula, nombre, apellidos, grado_academico, tipo_contrato, fk_presupuesto, jornada_docenteAdministrativo) VALUES
('1', '1', '1', 0, 0, 1, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_DocenteConPermiso (
  cedula varchar(25) NOT NULL,
  nombre varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  apellidos varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  grado_academico int(1) NOT NULL,
  tipo_contrato int(1) NOT NULL,
  fk_presupuesto int(11) NOT NULL,
  jornada_docenteConPermiso double DEFAULT NULL,
  PRIMARY KEY (cedula),
  KEY fk_presupuesto (fk_presupuesto)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_DocenteConPermiso (cedula, nombre, apellidos, grado_academico, tipo_contrato, fk_presupuesto, jornada_docenteConPermiso) VALUES
('1', '1', '1', 0, 0, 1, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_estadoDatos (
  id_estadoDatos int(11) NOT NULL,
  estado int(1) NOT NULL,
  revisiones int(11) NOT NULL,
  periodo int(1) NOT NULL,
  PRIMARY KEY (id_estadoDatos)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_estadoDatos (id_estadoDatos, estado, revisiones, periodo) VALUES
(0, 1, 0, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Grupos (
  fk_carrera varchar(8) NOT NULL,
  fk_curso varchar(10) NOT NULL,
  num_grupo int(3) NOT NULL,
  num_grupo_doble int(3) NOT NULL,
  jornada double NOT NULL,
  PRIMARY KEY (fk_carrera,fk_curso,num_grupo),
  KEY fk_curso (fk_curso)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Grupos (fk_carrera, fk_curso, num_grupo, num_grupo_doble, jornada) VALUES
('1', '1', 0, 0, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_GruposDocentes (
  fk_carrera varchar(8) NOT NULL,
  fk_curso varchar(10) NOT NULL,
  num_grupo int(3) NOT NULL,
  fk_docente varchar(25) NOT NULL,
  tiempo_individual double NOT NULL,
  fk_presupuesto int(11) NOT NULL,
  PRIMARY KEY (fk_carrera,fk_curso,num_grupo,fk_docente),
  KEY fk_presupuesto (fk_presupuesto),
  KEY fk_docente (fk_docente)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_GruposDocentes (fk_carrera, fk_curso, num_grupo, fk_docente, tiempo_individual, fk_presupuesto) VALUES
('1', '1', 0, '1', 0, 1);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_GruposHorarios (
  fk_carrera varchar(8) NOT NULL,
  fk_curso varchar(10) NOT NULL,
  num_grupo int(3) NOT NULL,
  dia_semana int(1) NOT NULL,
  hora_inicio time NOT NULL,
  hora_fin time NOT NULL,
  PRIMARY KEY (fk_carrera,fk_curso,num_grupo,dia_semana,hora_inicio)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_GruposHorarios (fk_carrera, fk_curso, num_grupo, dia_semana, hora_inicio, hora_fin) VALUES
('1', '1', 0, 0, '00:00:00', '00:00:00');") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Log (
  utc int(11) NOT NULL,
  anio int(11) NOT NULL,
  mes int(11) NOT NULL,
  dia int(11) DEFAULT NULL,
  hora int(11) NOT NULL,
  minuto int(11) NOT NULL,
  segundo int(11) NOT NULL,
  ip varchar(40) NOT NULL,
  navegador varchar(100) NOT NULL,
  usuario varchar(20) NOT NULL,
  contrasena varchar(80) NOT NULL,
  nombre_usuario varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  apellido_usuario varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Mensaje (
  id_mensaje int(11) NOT NULL AUTO_INCREMENT,
  emisor varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  receptor varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  contenido_mensaje varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  fecha datetime NOT NULL,
  PRIMARY KEY (id_mensaje)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_PlanEstudios (
  fk_carrera varchar(8) NOT NULL,
  fk_curso varchar(10) NOT NULL,
  KEY fk_curso (fk_curso),
  KEY fk_tb_PlanEstudios_1_idx (fk_carrera)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_PlanEstudios (fk_carrera, fk_curso) VALUES
('1', '1');") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Presupuesto (
  id_presupuesto int(11) NOT NULL AUTO_INCREMENT,
  nombre_presupuesto varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  codigo varchar(10) NOT NULL,
  tiempo_presupuesto double NOT NULL,
  tiempo_sobrante double NOT NULL,
  PRIMARY KEY (id_presupuesto)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Presupuesto (id_presupuesto, nombre_presupuesto, codigo, tiempo_presupuesto, tiempo_sobrante) VALUES
(1, '1', '1', 0, 0);") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_PresupuestoDocente (
  fk_id_presupuesto int(11) NOT NULL,
  fk_docente varchar(25) NOT NULL,
  jornada double NOT NULL,
  fk_proyecto int(11) NOT NULL,
  PRIMARY KEY (fk_proyecto),
  KEY fk_id_presupuesto (fk_id_presupuesto),
  KEY fk_docente (fk_docente),
  KEY fk_proyecto (fk_proyecto)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_Proyectos (
  id_proyecto int(11) NOT NULL AUTO_INCREMENT,
  nombre_proyecto varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  tipo_proyecto int(1) NOT NULL,
  jornada_proyecto double NOT NULL,
  fk_encargado varchar(25) NOT NULL,
  fk_ayudante varchar(25) NOT NULL,
  PRIMARY KEY (id_proyecto),
  KEY fk_encargado (fk_encargado),
  KEY fk_ayudante (fk_ayudante)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  mysql_query("INSERT INTO tb_Proyectos (id_proyecto, nombre_proyecto, tipo_proyecto, jornada_proyecto, fk_encargado, fk_ayudante) VALUES
(1, '1', 0, 0, '1', '1');") or die ("Error al llenar una tabla de la base de datos: ".mysql_error());

  mysql_query("CREATE TABLE IF NOT EXISTS tb_RegistroActividad (
  utc int(11) NOT NULL,
  fecha datetime NOT NULL,
  usuario varchar(20) NOT NULL,
  descripcion varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (utc),
  KEY usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die ("Error al crear una tabla de la base de datos: ".mysql_error());

  //Creación de la integridad referencial

  mysql_query("ALTER TABLE tb_DocenteAdministrativo
  ADD CONSTRAINT tb_DocenteAdministrativo_ibfk_1 FOREIGN KEY (fk_presupuesto) REFERENCES tb_Presupuesto (id_presupuesto);
") or die ("Error al crear una clave foránea: ".mysql_error());

  mysql_query("ALTER TABLE tb_DocenteConPermiso
  ADD CONSTRAINT tb_DocenteConPermiso_ibfk_1 FOREIGN KEY (fk_presupuesto) REFERENCES tb_Presupuesto (id_presupuesto);") or die ("Error al crear una clave foránea: ".mysql_error());

  mysql_query("ALTER TABLE tb_Grupos
  ADD CONSTRAINT tb_Grupos_ibfk_1 FOREIGN KEY (fk_carrera) REFERENCES tb_Carrera (id_Carrera),
  ADD CONSTRAINT tb_Grupos_ibfk_2 FOREIGN KEY (fk_curso) REFERENCES tb_Cursos (sigla);") or die ("Error al crear una clave foránea: ".mysql_error());

  mysql_query("ALTER TABLE tb_GruposDocentes
  ADD CONSTRAINT tb_GruposDocentes_ibfk_2 FOREIGN KEY (fk_docente) REFERENCES tb_Docente (cedula),
  ADD CONSTRAINT tb_GruposDocentes_ibfk_1 FOREIGN KEY (fk_presupuesto) REFERENCES tb_Presupuesto (id_presupuesto);") or die ("Error al crear una clave foránea: ".mysql_error());

  mysql_query("ALTER TABLE tb_PlanEstudios
  ADD CONSTRAINT tb_PlanEstudios_ibfk_1 FOREIGN KEY (fk_carrera) REFERENCES tb_Carrera (id_Carrera),
  ADD CONSTRAINT tb_PlanEstudios_ibfk_2 FOREIGN KEY (fk_curso) REFERENCES tb_Cursos (sigla);") or die ("Error al crear una clave foránea: ".mysql_error());

  mysql_query("ALTER TABLE tb_PresupuestoDocente
  ADD CONSTRAINT tb_PresupuestoDocente_ibfk_1 FOREIGN KEY (fk_docente) REFERENCES tb_Docente (cedula),
  ADD CONSTRAINT tb_PresupuestoDocente_ibfk_2 FOREIGN KEY (fk_id_presupuesto) REFERENCES tb_Presupuesto (id_presupuesto),
  ADD CONSTRAINT tb_PresupuestoDocente_ibfk_3 FOREIGN KEY (fk_proyecto) REFERENCES tb_Proyectos (id_proyecto);") or die ("Error al crear una clave foránea: ".mysql_error());

  mysql_query("ALTER TABLE tb_Proyectos
  ADD CONSTRAINT tb_Proyectos_ibfk_1 FOREIGN KEY (fk_encargado) REFERENCES tb_Docente (cedula),
  ADD CONSTRAINT tb_Proyectos_ibfk_2 FOREIGN KEY (fk_ayudante) REFERENCES tb_Docente (cedula);") or die ("Error al crear una clave foránea: ".mysql_error());

  echo ("La base fue creada correctamente. <a href='../../index.php'>Inicie el sistema</a>");
?>
