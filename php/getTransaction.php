<?php 
    
    include('conexion.php');


    $id = $_GET['id'];
    
    $query = "SELECT Id,Tipo,Fecha,Importe,Usuario,Concepto FROM Transacciones WHERE ID = '$id'";

    $resultado = $mysqli->query($query);

    if (!$resultado) {
        die('Error en la consulta: '.$mysqli->error);
    }

    $json = array();
    $resultado->data_seek(0);
    while($row = $resultado->fetch_assoc()) {
        $fechaConFormato = date("d/m/Y", strtotime($row['Fecha']));
        $json = array(
        'id' => $row['Id'],
        'tipo' => $row['Tipo'],
        'fecha' => $fechaConFormato,
        'importe' => $row['Importe'],
        'usuario' => $row['Usuario'],
        'concepto' => $row['Concepto']
        );
    }

    $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonstring;

?>