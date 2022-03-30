<?php 

include('conexion.php');

$id = $_GET['id'];

$query = "DELETE FROM trade WHERE id = $id";
$resultado = $mysqli->query($query);

if (!$resultado) {
    die('Error en la consulta: '.$mysqli->error.$query);
}

$mysqli->close();
?>