<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

$params = json_decode(file_get_contents('php://input'),true);

$date = $params['date'];
$type = $params['type'];
$concept = $params['concept'];
$user = $params['user'];
$amount = str_replace(',','.',$params['amount']);

$id = date('YmdHis');

$mysqli->query('DELETE from trade WHERE id = $id');
$query = "INSERT into trade (id,type,date,amount,user,concept) values ($id,'{$type}','{$date}',{$amount},'{$user}','{$concept}')";
$resultado = $mysqli->query($query);

if (!$resultado) {
    die('Error en la consulta: '.$mysqli->error.'/n Query: '.$query.'/nPOST: '.$params);
}

$mysqli->close();
?>