<?php 
    
    include('conexion.php');


    $id = $_GET['id'];
    
    $query = "SELECT id,type,date,amount,user,concept FROM trade WHERE id = '$id'";

    $resultado = $mysqli->query($query);

    if (!$resultado) {
        die('Error en la consulta: '.$mysqli->error);
    }

    $json = array();
    $resultado->data_seek(0);
    while($row = $resultado->fetch_assoc()) {
        $fechaConFormato = date("d/m/Y", strtotime($row['date']));
        $json = array(
        'id' => $row['id'],
        'tipo' => $row['type'],
        'fecha' => $fechaConFormato,
        'importe' => $row['amount'],
        'usuario' => $row['user'],
        'concepto' => $row['concept']
        );
    }

    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>