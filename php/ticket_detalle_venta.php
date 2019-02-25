<?php 


include '../conexion/conexion.php';
$query=("select  dv.numero_boleta,c.nombre_cliente, p.nombre_producto ,dv.cantidad , FORMAT((p.valor_producto*dv.cantidad),0,'de_DE')  as 'total'  from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
join clientes c 
on c.id_cliente=dv.id_cliente
where dv.numero_boleta = (SELECT max(numero_boleta) from detalle_venta)");

$resultado=mysqli_query($conexion , $query);
$result=mysqli_fetch_array($resultado);

echo json_encode($result);


?>