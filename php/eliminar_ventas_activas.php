<?php

include '../conexion/conexion.php';

$query=("DELETE FROM detalle_venta where estado=0");

echo mysqli_query($conexion , $query);


?>