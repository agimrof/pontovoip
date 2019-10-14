<?php


define('DB_HOSTNAME', '10.8.0.9');
define('DB_USER', 'admast');
define('DB_PASSWORD', 'sup3rPw#');
define('DB_DATABASE', 'astdb');

$conexao = mysqli_connect(DB_HOSTNAME, DB_USER, DB_PASSWORD, DB_DATABASE) or die('Não foi possível conectar');
  
?>

