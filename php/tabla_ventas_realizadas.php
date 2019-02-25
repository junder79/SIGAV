<?php

include '../conexion/conexion.php';


$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
  $desde = $hasta;
}

if(isset($hasta)==false){
  $hasta = $desde;
}



$query=("SELECT dv.id_venta , c.nombre_cliente,c.telefono_cliente,c.giro_cliente,c.email_cliente,dv.numero_boleta
from detalle_venta dv 
join productos p  on p.id_producto=dv.id_producto
join clientes c 
on c.id_cliente=dv.id_cliente
where dv.estado=1 and dv.fecha_venta BETWEEN '$desde' AND '$hasta'
group by dv.numero_boleta order by dv.id_venta desc;");

$resultado=mysqli_query($conexion , $query);


//Consulta para obtener el total de ventas en fechas
$q=mysqli_query($conexion , "SELECT format(sum((dv.cantidad*p.valor_producto)),0,'de_DE') as 'total' from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
where  dv.fecha_venta BETWEEN '$desde' and '$hasta' and dv.estado=1  and dv.tipo_pago='EFECTIVO' ");


//Creamos la Vista para mostrar el total de ventas por fechas
if (mysqli_num_rows($q)>0)
{
  while($filas_total_ventas_fechas=mysqli_fetch_array($q))
  {
    

    echo '
    <div class="row">
    <div class="col-lg-3 ml-0 mt-4 mb-4">
    <div class="card" style="background-color:#b71c1c; color:white;">
      <div class="card-body">
     <span class="mt-2" style="font-weight:normal; font-size:15px;">Total Efectivo: $ '.$filas_total_ventas_fechas['total'].'</span>
      </div>
    </div>
    </div>
    ';

  }
} else 
{
  echo '<h1>ERROR</h1>'; 
}
//Consulta para obtener el total de ventas en fechas
$q=mysqli_query($conexion , "SELECT format(sum((dv.cantidad*p.valor_producto)),0,'de_DE') as 'total' from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
where  dv.fecha_venta BETWEEN '$desde' and '$hasta' and dv.estado=1 and dv.tipo_pago='TRANSBANK' ");


//Creamos la Vista para mostrar el total de ventas por fechas
if (mysqli_num_rows($q)>0)
{
  while($filas_total_ventas_fechas=mysqli_fetch_array($q))
  {
    

    echo '
    <div class="col-lg-3 ml-0 mt-4 mb-4">
    <div class="card" style="background-color:#b71c1c; color:white;">
      <div class="card-body">
     <span class="mt-2" style="font-weight:normal; font-size:15px;">Total Transbank: $ '.$filas_total_ventas_fechas['total'].'</span>
      </div>
    </div>
    </div>
    ';

  }
} else 
{
  echo '<h1>ERROR</h1>'; 
}

//Consulta para obtener el total de ventas en fechas
$q=mysqli_query($conexion , "SELECT format(sum((dv.cantidad*p.valor_producto)),0,'de_DE') as 'total' from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
where  dv.fecha_venta BETWEEN '$desde' and '$hasta' and dv.estado=1 and dv.tipo_pago='CRÉDITO' ");


//Creamos la Vista para mostrar el total de ventas por fechas
if (mysqli_num_rows($q)>0)
{
  while($filas_total_ventas_fechas=mysqli_fetch_array($q))
  {
    

    echo '
    <div class="col-lg-3 ml-0 mt-4 mb-4">
    <div class="card" style="background-color:#b71c1c; color:white;">
      <div class="card-body">
     <span class="mt-2" style="font-weight:normal; font-size:15px;">Total Crédito: $ '.$filas_total_ventas_fechas['total'].'</span>
      </div>
    </div>
    </div>
    ';

  }
} else 
{
  echo '<h1>ERROR</h1>'; 
}

//Consulta para obtener el total de ventas en fechas
$q=mysqli_query($conexion , "SELECT format(sum((dv.cantidad*p.valor_producto)),0,'de_DE') as 'total' from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
where  dv.fecha_venta BETWEEN '$desde' and '$hasta' and dv.estado=1");


//Creamos la Vista para mostrar el total de ventas por fechas
if (mysqli_num_rows($q)>0)
{
  while($filas_total_ventas_fechas=mysqli_fetch_array($q))
  {
    

    echo '
    <div class="col-lg-3 ml-0 mt-4 mb-4">
    <div class="card" style="background-color:#b71c1c; color:white;">
      <div class="card-body">
     <span class="mt-2" style="font-weight:normal; font-size:15px;">Total: $ '.$filas_total_ventas_fechas['total'].'</span>
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

<div style="overflow: scroll; height: 230px;">

        <table class="table table-bordered table-striped" >
  <thead>
    <tr style="background-color: #004d40 ; color:white;">
       <th scope="col">ID Venta</th>
      <th scope="col">CLIENTE</th>
      <th scope="col">TELÉFONO</th>
      <th scope="col">GIRO</th>
      <th scope="col">EMAIL</th>
      <th scope="col">N° BOLETA</th>
      <th scope="col">OPCIÓN</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  if(mysqli_num_rows($resultado)>0){  
 	while ($fila=mysqli_fetch_array($resultado)) { ?>
   		

 				<tr>
              <td><?php echo $fila['id_venta']; ?></td>
              <td><?php echo $fila['nombre_cliente']; ?></td>
              <td><?php echo $fila['telefono_cliente']; ?></td>
              <td><?php echo $fila["giro_cliente"] ?> </td>
              <td><?php echo $fila["email_cliente"] ?> </td>
              <td><?php echo $fila["numero_boleta"] ?> </td>
              <td><button type="button" style="background-color:#00897b;color: white; " class="btn  "   data-toggle="modal" data-target="#modal_detalles_v_realizadas"   id="<?php echo $fila['numero_boleta']; ?>" onclick="obtenerId_venta(this);">DETALLE<i class="ml-2 fas fa-info"></i></button></td>
            </tr>

			<?php }}else{
  echo '<tr>
        <td colspan="6">No se encontraron resultados</td>
      </tr>';
} ?>
  </tbody>
</table>
</div>
