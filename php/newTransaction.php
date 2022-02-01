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

$mysqli->query('DELETE from Transacciones WHERE Id = $id');
$query = "INSERT into Transacciones (Id,Tipo,Fecha,Importe,Usuario,Concepto) values ($id,'{$type}','{$date}',{$amount},'{$user}','{$concept}')";
$resultado = $mysqli->query($query);

if (!$resultado) {
    die('Error en la consulta: '.$mysqli->error.'/n Query: '.$query.'/nPOST: '.$params);
}

$mysqli->close();
?>