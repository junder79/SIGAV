<?php

include 'conexion/conexion.php';

// $id_numero_detalle_venta=$_POST['id_numero_detalle_venta'];
$id_cliente=$_POST['id_cliente'];
// $tipo_pago=$_POST['tipo_pago'];
$id_producto=$_POST['id_producto'];
$tipo_pago=$_POST['tipo_pago'];
$cantidad=$_POST['cantidad_temporal'];
//El valor es de ejemplo 
$valor=120;
$numero_boleta=$_POST['numero_boleta'];
$numero_boleta_menos=$numero_boleta-1;
$id_venta=$_POST['id_venta'];
// $datos=mysqli_query($conexion , "SELECT numero_boleta from detalle_venta where numero_boleta='$id_producto'");
// $duplicado=mysqli_num_rows($datos);
// if ($duplicado==0)
// {


//ULTIMO AÑADIDO


$query_2=("

SELECT id_producto from detalle_venta where id_producto='$id_producto' and numero_boleta='0'

	");
// // $test=mysql_query($conexion , "SELECT numero_boleta from detalle_venta where numero_boleta='10'");
// // $duplicado_boleta=mysqli_num_rows();
$test=mysqli_query($conexion , $query_2);
$duplicado=mysqli_num_rows($test);

if ($duplicado==0) 
{
$query=("INSERT INTO detalle_venta (id_venta ,numero_boleta ,id_producto,id_cliente ,fecha_venta, cantidad , valor , tipo_pago , estado ) VALUES (null,0 , '$id_producto','$id_cliente' ,NOW(), '$cantidad'  , '$valor' , '$tipo_pago' , 0)");

echo mysqli_query($conexion , $query);

}

else 
{
$query=("UPDATE detalle_venta set cantidad='$cantidad'+cantidad WHERE numero_boleta='0'  and id_producto='$id_producto'   ");
echo mysqli_query($conexion , $query);

}



?>