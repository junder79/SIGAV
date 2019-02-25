<?php

include 'conexion/conexion.php';

$nombre_producto=$_POST['nombre_producto'];
$cantidad_producto=$_POST['cantidad_producto'];
$costo_producto=$_POST['costo_producto'];
$valor_producto=$_POST['valor_producto'];

$query="INSERT INTO productos values (null , '$nombre_producto' ,  '$cantidad_producto'  ,'$costo_producto' , '$valor_producto' )";
$ejecutar_consulta=mysqli_query($conexion , $query);


// verificar el registro de los datos 
if ($ejecutar_consulta) 
{
    echo '<script language="javascript">';
	echo 'alert("Producto Agregado Exitosamente")';
	echo '</script>';
	print "<script>window.location='productos.php';</script>";	
}
else 
{
    echo "---------Error------------ al insertar"; 
}

?>