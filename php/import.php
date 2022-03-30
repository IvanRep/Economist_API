<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('conexion.php');
include('credentials.php');

$filename = $_GET['filename'];
$backup = '/var/www/html/backup/'.$filename;
$user =  $db_user;
$database = $db_name;
$password = $db_pass;
$command = "./import.sh $filename $db_user $db_pass $db_name";
$output;
exec($command, $output, $var);

echo $var;
?>