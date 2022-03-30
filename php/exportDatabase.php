<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

// IF DIRECTORY DOESN'T EXIST CREATE IT
if (!file_exists('../backup/')) {
    mkdir('../backup/', 0777, true);
}
$fileName = date('d_m_Y-h_i_s').".sql";
$file = fopen("../backup/".$fileName,"w") or die("Error al abrir el archivo!");

$txt = "DROP TABLE IF EXISTS trade;\n
CREATE TABLE trade (id DECIMAL(25,0) PRIMARY KEY,type TEXT,date DATETIME,amount DECIMAL(25,2),user TEXT,concept TEXT);\n";
fwrite($file, $txt);


$query = "SELECT id,type,date,amount,user,concept FROM trade";
$result = $mysqli->query($query);

if (!$result) {
    die('Error en la consulta: '.$mysqli->error);
}

$result->data_seek(0);
while($row = $result->fetch_assoc()) {

    $txt = "INSERT INTO trade (id,type,date,amount,user,concept) VALUES ({$row['id']},'{$row['type']}','{$row['date']}',{$row['amount']},'{$row['user']}','{$row['concept']}');\n";
    fwrite($file, $txt);
}

fclose($file);

echo $fileName;

?>