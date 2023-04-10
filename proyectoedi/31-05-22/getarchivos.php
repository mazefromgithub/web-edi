<?php

 $conexion= include('Config/conexion.php');


 

$query="SELECT idArchivo, nombre, descripcion, orden FROM `archivos` AS ar JOIN `archivosact` AS arbo ON ar.id = arbo.idArchivo";
$sth = mysqli_query($conexion, $query);
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);

?>