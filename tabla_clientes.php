<?php  
//action.php
include 'conexion/conexion.php';


$input = filter_input_array(INPUT_POST);


if($input["action"] === 'edit')
{
 $query = "
 UPDATE  clientes
 SET
 nombre_cliente = '".$input['nombre_cliente']."' ,
 giro_cliente = '".$input['giro_cliente']."' ,
 direccion_cliente = '".$input['direccion_cliente']."' ,
 telefono_cliente = '".$input['telefono_cliente']."' ,
 email_cliente = '".$input['email_cliente']."' 
 WHERE id_cliente = '".$input["id_cliente"]."'
 ";

mysqli_query($conexion , $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM clientes
 WHERE id_cliente = '".$input["id_cliente"]."'
 ";
mysqli_query($conexion , $query);
}


echo json_encode($input);

?>
