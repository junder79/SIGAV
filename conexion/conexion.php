<?php

//Conexion a la base de datos 
$host="localhost";
$user="sigav_sigav";
$password="sigav2019";
$database="sigav_sigav2";



$conexion =mysqli_connect($host , $user , $password , $database);


//Comprobar que la conexion sea correcta

if(mysqli_connect_errno()) 
{
    echo "Conexion fallida ";
}
else 
{
    
}

// Consulta para configurar la codificacion de caracteres 
 mysqli_query($conexion,"SET NAMES 'utf-8'");


 
?>