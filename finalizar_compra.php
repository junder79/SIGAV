<?php

include 'conexion/conexion.php';

$id_cliente=$_POST['id_cliente_form_venta'];
$tipo_pago=$_POST['tipo_pago'];

$query=("INSERT INTO ventas (id_venta , fecha_venta , id_cliente , tipo_pago) VALUES (null ,NOW() ,'$id_cliente','$tipo_pago' )");

$resultado_insertar_venta=mysqli_query($conexion , $query);


// verificar el registro de los datos 
if ($resultado_insertar_venta) 
{
    echo '<script language="javascript">';
	echo 'alert("Venta Exitosa")';
	echo '</script>';
	print "<script>window.location='ventas.php';</script>";	
}
else 
{
   printf("Connect failed: %s\n", mysqli_connect_error());
}

?>