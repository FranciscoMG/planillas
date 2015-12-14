Sistema de Planillas de Docentes SIDOP

Universidad de Costa Rica sede Arnoldo Ferreto Segura


REQUERIMIENTOS DEL SERVIDOR 
	Sistema operativo Linux (base Debian).
	Apache 2.4.7
	PHP 5.5.9
	MySQL 5.0.11
	Se debe instalar “mysqlnt” (para conexión mysqli)
	Se recomienda usar el navegador Google Chrome o Firefox.


PROCESO DE INSTALACIÓN
	Crear manualmente una base de datos vacía con el nombre de “SIDOP”
	Importar el archivo SIDOP.sql  dentro de la base de datos (Este archivo crea todas las tablas necesarias para que el sistema funcione correctamente).
	Crear un usuario para la base de datos “admin_db” con la contraseña “SIDOP_key”.


COMO IMPORTAR O EXPORTAR LA BASE DE DATOS DESDE EL SISTEMA
	Se debe modificar los archivos que se encuentran en la ruta /php/BD_Backup y agrégales un usuario de base de datos con permisos suficientes para exportar o importar base de datos.
