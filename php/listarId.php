<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include('conexion.php');
    
    $filters = json_decode($_GET['filters']);

    $order = $_GET['order'];
    $orderDirection = $_GET['orderDirection'];

    if ($filters->type == 'Todos') {
        $filters->type = '';
    }

    if ($filters->since == '') {
        $sinceQuery = '';
    } else {
        $sinceQuery = "Fecha > '$filters->since' AND ";
    }

    if ($filters->until == '') {
        $untilQuery = '';
    } else {
        $untilQuery = "Fecha < '$filters->until' AND ";
    }

    $query = "SELECT Id FROM Transacciones WHERE
    Tipo LIKE '%$filters->type%' AND 
    Importe > $filters->minimumAmount AND 
    Importe < $filters->maximumAmount AND $sinceQuery $untilQuery
    Usuario LIKE '%$filters->user%' AND 
    Concepto LIKE '%$filters->concept%' 
    ORDER BY $order $orderDirection";

    $resultado = $mysqli->query($query);
    if (!$resultado) {
        die('Error en la consulta: '.$mysqli->error.'Query: '.$query);
    }

    $json = array();
    $resultado->data_seek(0);
    while($row = $resultado->fetch_assoc()) {
        $json[] = array(
        'id' => $row['Id'],
        );
    }

    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>