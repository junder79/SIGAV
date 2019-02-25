

<?php 

include '../conexion/conexion.php';
$numero_boleta= $_GET["numero_boleta"];
$resultado=mysqli_query($conexion,"

	SELECT dv.id_venta , p.id_producto,dv.numero_boleta, p.nombre_producto , dv.cantidad , (dv.cantidad*p.valor_producto) as 'Total' 
	from detalle_venta dv join productos p  on p.id_producto=dv.id_producto
	where dv.estado=1 and dv.numero_boleta='$numero_boleta'")or die(mysqli_error()); 
// $result=mysqli_fetch_array($resultado);

// echo json_encode($result);
?>
<table  class="table table-bordered">
  <thead style="background-color:  #00897b; color: white;">
    <tr>
      <th scope="col">ID VENTA</th>
      <th scope="col">ID PRODUCTO</th>
      <th scope="col">N° BOLETA</th>
      <th scope="col">PRODUCTO</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">TOTAL</th>
    </tr>
  </thead>
  <tbody style="background-color: #e3f2fd;">
    <tr>
    <?php

    while ($filas = mysqli_fetch_array($resultado)) {
    	echo '<tr>
				<td style="font-size:14px;">'.$filas["id_venta"].'</td>
				<td style="font-size:14px;">'.$filas["id_producto"].'</td>
				<td style="font-size:14px;">'.$filas["numero_boleta"].'</td>
				<td style="font-size:14px;">'.$filas["nombre_producto"].'</td>
				<td style="font-size:14px;">'.$filas["cantidad"].'</td>
		        <td style="font-size:14px;font-weight:bold; "> $'.$filas["Total"].'</td>';
    }

     ?>
    </tr>
  </tbody>
</table>

<!--CONSULTA PARA OBTENER EL VALOR TOTAL DE LOS SERVICIOS AGENDADOS POR LOS CLIENTES-->
<?php


$consulta_total_venta_cliente=mysqli_query($conexion, "SELECT   format(sum(dv.cantidad*p.valor_producto), 0 , 'de_DE') AS 'total' , dv.numero_boleta from detalle_venta dv
join productos p 
on p.id_producto = dv.id_producto
where  dv.numero_boleta='$numero_boleta'")or die(mysqli_error()); 

//Vista para mostrar el total_valor_servicio_cliente
if (mysqli_num_rows($consulta_total_venta_cliente)>0)
{ 
    while ($filas=mysqli_fetch_array($consulta_total_venta_cliente))
    {
      
      echo '
    <div class="row">
      <div class="col-lg-12">
        <div class="card" style="background-color: #e3f2fd;">
          <div class="card-body">
            <span style="font-weight:bold; ">Valor Total : $'.$filas['total'].'</span>
          </div>
        </div>
      </div>
    </div>
      ';

    }

} else 
{
  echo '<h1>ERROR</h1>'; 
}

?>