<?php 

include('conexion.php');

$id = $_GET['id'];

$query = "DELETE FROM Transacciones WHERE Id = $id";
$resultado = $mysqli->query($query);

if (!$resultado) {
    die('Error en la consulta: '.$mysqli->error.$query);
}

$mysqli->close();
?>