<?php

include '../conexion/conexion.php';

$query=("SELECT dv.id_venta , p.id_producto,dv.numero_boleta, p.nombre_producto , dv.cantidad , (dv.cantidad*p.valor_producto) as 'Total' from detalle_venta dv join productos p  on p.id_producto=dv.id_producto where dv.estado=0");

$resultado=mysqli_query($conexion , $query);


?>

<div style="overflow: scroll; height: 200px;">

        <table class="table" >
  <thead>
    <tr>
       <th scope="col">ID Venta</th>
      <th scope="col">ID Producto</th>
      <th scope="col">N° de Boleta</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">SubTotal</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
 	while ($fila=mysqli_fetch_array($resultado)) { ?>
   		

 				<tr>
              <td><?php echo $fila['id_venta']; ?></td>
              <td><?php echo $fila['id_producto']; ?></td>
              <td><?php echo $fila['numero_boleta']; ?></td>
              <td><?php echo $fila["nombre_producto"] ?> </td>
              <td><?php echo $fila["cantidad"] ?> </td>
              <td><?php echo $fila["Total"] ?> </td>
               <td><button type="button" class="btn btn-danger"   onclick="eliminarDatos('<?php echo $fila['id_producto']; ?>');">Quitar</button></td>

            </tr>

			<?php } ?>
  </tbody>
</table>
</div>
<?php

$consulta_total=("SELECT format(sum(dv.cantidad*p.valor_producto), 0 , 'de_DE') AS 'total' from detalle_venta dv join productos p  on p.id_producto=dv.id_producto where dv.estado=0");
$resultado_total=mysqli_query($conexion , $consulta_total);
while ($row=mysqli_fetch_array($resultado_total)) {
  echo '<h1>Total : $'.$row['total'].'</h1>';
}
?>
