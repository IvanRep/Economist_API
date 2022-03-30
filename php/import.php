<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('conexion.php');

$filename = $_GET['filename'];
$backup = '/var/www/html/backup/'.$filename;
$user = 'phpmyadmin';
$database = 'economist';
$password = 'bananapi';
$command = "./import.sh $filename";
$output;
exec($command, $output, $var);

echo $var;

?>