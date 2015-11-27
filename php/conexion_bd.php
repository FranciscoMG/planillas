<?php
  define("DB_SERV", "localhost");
  define("DB_USER", "admin_db");
  define("DB_PASSWD", "SIDOP_key");
  define("DB_NAME", "SIDOP");

  mysql_connect(DB_SERV, DB_USER, DB_PASSWD) or die ("Error al conectar a la base: ".mysql_error());
  mysql_select_db(DB_NAME) or die ("Error al seleccionar la base: ".mysql_error());
?>
