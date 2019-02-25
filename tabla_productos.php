<?php  
//action.php
include 'conexion/conexion.php';


$input = filter_input_array(INPUT_POST);


if($input["action"] === 'edit')
{
 $query = "
 UPDATE productos
 SET
 nombre_producto = '".$input['nombre_producto']."' ,
 costo_producto = '".$input['costo_producto']."' ,
 valor_producto = '".$input['valor_producto']."'
 WHERE id_producto = '".$input["id_producto"]."'
 ";

mysqli_query($conexion , $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM productos
 WHERE id_producto = '".$input["id_producto"]."'
 ";
mysqli_query($conexion , $query);
}


echo json_encode($input);

?>
