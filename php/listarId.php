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
        $sinceQuery = "date > '$filters->since' AND ";
    }

    if ($filters->until == '') {
        $untilQuery = '';
    } else {
        $untilQuery = "date < '$filters->until' AND ";
    }

    $query = "SELECT id FROM trade WHERE
    type LIKE '%$filters->type%' AND 
    amount > $filters->minimumAmount AND 
    amount < $filters->maximumAmount AND $sinceQuery $untilQuery
    user LIKE '%$filters->user%' AND 
    concept LIKE '%$filters->concept%' 
    ORDER BY $order $orderDirection";

    $resultado = $mysqli->query($query);
    if (!$resultado) {
        die('Error en la consulta: '.$mysqli->error.'Query: '.$query);
    }

    $json = array();
    $resultado->data_seek(0);
    while($row = $resultado->fetch_assoc()) {
        $json[] = array(
        'id' => $row['id'],
        );
    }

    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>