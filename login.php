<?php

session_start();

$_SESSION['admin']='prueba';

$nombre_usuario=$_POST['nombre_usuario'];
$contrasena=$_POST['contrasena'];


if ($nombre_usuario == "admin"  && $contrasena=="admin456punto" ) {
	print "<script>window.location='clientes.php';</script>";	

}
else 
{
	echo '<script language="javascript">';
	echo 'alert("USUARIO O CONTRASEÑA INCORRECTO")';
	echo '</script>';
	print "<script>window.location='index.php';</script>";	
}

?>


?>