<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

$filename = $_GET['filename'];
$backup = '/var/www/html/Copias_de_seguridad/'.$filename;
$user = 'phpmyadmin';
$database = 'phpmyadmin';
$password = 'bananapi';
$command = "/var/www/html/import.sh $filename";
$output;
exec($command, $output, $var);

echo $var;

?>