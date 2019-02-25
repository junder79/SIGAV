<?php

include '../conexion/conexion.php';


// $id_numero_boleta=$_POST['n_boleta'];

$query_verfificar_estado=("select * from detalle_venta where estado=0");
 $test= mysqli_query($conexion , $query_verfificar_estado);
$duplicado=mysqli_num_rows($test);
if ($duplicado==0)
{
	   echo '<script language="javascript">';
	echo 'alert("ERROR")';
	echo '</script>';

}
else 
{

$estado=1;
$numero_boleta=$_POST['numero_boleta'];
$query=("UPDATE detalle_venta set estado='$estado' ,numero_boleta='$numero_boleta'+1 where estado=0");


echo mysqli_query($conexion , $query);
}
?>