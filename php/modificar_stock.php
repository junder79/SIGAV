<?php

include '../conexion/conexion.php';

$id_producto=$_POST['id_producto'];
$stock_nuevo=$_POST['stock_nuevo'];

$query=("UPDATE productos set cantidad_producto='$stock_nuevo'+cantidad_producto WHERE id_producto='$id_producto' ");

$resultado_update=mysqli_query($conexion , $query);

// verificar el registro de los datos 
if ($resultado_update) 
{
    echo '<script language="javascript">';
	echo 'alert("Cambio exitoso")';
	echo '</script>';
	print "<script>window.location='../productos.php';</script>";	
}
else 
{
    echo "---------Error------------ al insertar"; 
}



?>