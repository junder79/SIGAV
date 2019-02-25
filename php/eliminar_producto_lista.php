<?php

include '../conexion/conexion.php';

$id_producto=$_POST['id_producto'];
$numero_boleta=$_POST['numero_boleta'];
$sql="DELETE FROM detalle_venta where  numero_boleta=0 and id_producto='$id_producto'";
echo $result=mysqli_query($conexion , $sql);

?>