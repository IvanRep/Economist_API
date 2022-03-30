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

    $query = "SELECT id, type, date, amount, user, concept FROM trade WHERE
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
        $formattedDate = date("d/m/Y/H/i/s", strtotime($row['date']));
        $json[] = array(
        'id' => $row['id'],
        'type' => $row['type'],
        'date' => $formattedDate,
        'amount' => $row['amount'],
        'user' => $row['user'],
        'concept' => $row['concept'],
        );
    }

    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>