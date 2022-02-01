<?php

require_once('./credentials.php');

date_default_timezone_set('Europe/Madrid'); //Edito la zona horaria del servidor
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, DELETE');
header('Access-Control-Allow-Headers: Content-Type');  

$mysqli = new MySQLi($db_host, $db_user, $db_pass, $db_name);

mysqli_set_charset($mysqli, "utf8");
if ($mysqli->connect_error) {
echo "Could not connect to $db_user, error: " . $mysqli->connect_error;
}

?>