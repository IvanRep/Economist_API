<?php 

include('conexion.php');
$params = json_decode(file_get_contents('php://input'),true);


$date = $params['date'];
$type = $params['type'];
$concept = $params['concept'];
$user = $params['user'];
$amount = str_replace(',','.',$params['amount']);
$id = $params['id'];


$query = "UPDATE Transacciones SET Tipo = '$type', Importe = $amount, Usuario = '$user', Concepto = '$concept', Fecha = '$date' WHERE id = $id";
$resultado = $mysqli->query($query);

if (!$resultado) {
    die('Error en la consulta: '.$mysqli->error);
}

$mysqli->close();
?>