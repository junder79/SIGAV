<?php

include 'conexion/conexion.php';
//Datos enviamos por el formulario POST
$nombre_cliente=$_POST['nombre_cliente']; 
$rut_cliente=$_POST['rut_cliente'];
$correo_cliente=$_POST['correo_cliente'];
$giro_cliente=$_POST['giro_cliente'];
$direccion_cliente=$_POST['direccion_cliente'];
$telefono_cliente=$_POST['telefono_cliente'];

//Validacion de que no se registre un cliente con el mismo rut 
$consultaValidacion=("SELECT * FROM clientes WHERE rut_cliente ='$rut_cliente'");
$validarUsuario=mysqli_query($conexion , $consultaValidacion);


if (mysqli_num_rows($validarUsuario)==0)
{

//Insertar datos en la base de datos


$query="INSERT INTO clientes values (null , '$rut_cliente' , '$nombre_cliente' , '$giro_cliente '  , '$direccion_cliente' , '$telefono_cliente' , '$correo_cliente'  )";
$conexion_insertar=mysqli_query($conexion ,$query);
if(mail("$correo_cliente", 'CORREO DE PRUEBA','
---------CORREO DE PRUEBA-----------------------------
---------CORREO DE PRUEBA HTML TEST-------------------
SIGAV
		')){
		echo "";
	}else{
		echo "ALGO SALIO MAL UPS";
	}

// verificar el registro de los datos 
if ($conexion_insertar) 
{
    echo '<script language="javascript">';
	echo 'alert("Registro exitoso")';
	echo '</script>';
	print "<script>window.location='index.php';</script>";	
}
else 
{
    echo "---------Error------------ al insertar"; 
}

}
else 
{
  echo '<script language="javascript">';
 echo 'alert("ERROR : Ya está registrado este Cliente")';
 echo '</script>';
 print "<script>window.location='index.php';</script>"; 
}




?>