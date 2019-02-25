<?php 

include '../conexion/conexion.php';
$id_producto= $_GET["id_producto"];
$resultado=mysqli_query($conexion,"

SELECT * from productos where id_producto=$id_producto")or die(mysqli_error()); 
$result=mysqli_fetch_array($resultado);

echo json_encode($result);
?>

