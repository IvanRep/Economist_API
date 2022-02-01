<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');
$fileName = date('d_m_Y-h_i_s').".sql";
$file = fopen("../Copias_de_seguridad/".$fileName,"w") or die("Error al abrir el archivo!");

$txt = "DROP TABLE IF EXISTS Transacciones;\n
CREATE TABLE Transacciones (Id DECIMAL(25,0) PRIMARY KEY,Tipo TEXT,Fecha DATETIME,Importe DECIMAL(25,2),Usuario TEXT,Concepto TEXT);\n";
fwrite($file, $txt);


$query = "SELECT Id,Tipo,Fecha,Importe,Usuario,Concepto FROM Transacciones";
$result = $mysqli->query($query);

if (!$result) {
    die('Error en la consulta: '.$mysqli->error);
}

$result->data_seek(0);
while($row = $result->fetch_assoc()) {

    $txt = "INSERT INTO Transacciones (Id,Tipo,Fecha,Importe,Usuario,Concepto) VALUES ({$row['Id']},'{$row['Tipo']}','{$row['Fecha']}',{$row['Importe']},'{$row['Usuario']}','{$row['Concepto']}');\n";
    fwrite($file, $txt);
}

fclose($file);

echo $fileName;

?>