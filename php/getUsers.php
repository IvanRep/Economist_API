<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include('conexion.php');

    $user = $_GET['user'];
    $type = $_GET['type'];

    if ($type == 'Todos') $type = '';

    $query = "SELECT DISTINCT Usuario FROM Transacciones WHERE Usuario LIKE '%$user%' AND Tipo LIKE '%$type%'";

    $resultado = $mysqli->query($query);

    if (!$resultado) {
        die('Error en la consulta: '.$mysqli->error);
    }

    $json = array();
    $resultado->data_seek(0);
    while($row = $resultado->fetch_assoc()) {
        $json[] = array(
        $row['Usuario']
        );
    }

    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>