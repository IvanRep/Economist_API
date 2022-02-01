<?php 

chdir("../Copias_de_seguridad/");
$json = array();

array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
foreach($files as $filename)
{

    $json[] = substr($filename, 0, -4);

}

$jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
echo $jsonstring;

?>