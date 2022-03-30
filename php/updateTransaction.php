<?php 

include('conexion.php');
$params = json_decode(file_get_contents('php://input'),true);


$date = $params['date'];
$type = $params['type'];
$concept = $params['concept'];
$user = $params['user'];
$amount = str_replace(',','.',$params['amount']);
$id = $params['id'];


$query = "UPDATE trade SET type = '$type', amount = $amount, user = '$user', concept = '$concept', date = '$date' WHERE id = $id";
$resultado = $mysqli->query($query);

if (!$resultado) {
    die('Error en la consulta: '.$mysqli->error);
}

$mysqli->close();
?>