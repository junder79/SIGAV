<?php

session_start();
$var=$_SESSION['admin'];
if ($var==null || $var = '')
{
  print "<script>window.location='index.php';</script>";    
  die();
}

include 'conexion/conexion.php';

$query=("

SELECT cs.id_carga_stock , p.nombre_producto , cs.cantidad , cs.fecha_carga from carga_stock cs
join productos p 
on p.id_producto=cs.id_producto
order by cs.fecha_carga desc
	");

$resultado_consulta=mysqli_query($conexion , $query);



?>

<!DOCTYPE html>
<html>
<head>
	<title>Historial de Stock</title>

</head>
<body>
<?php  include 'navbar.php'; ?>
<div class="main-content">
	<div class="container " >
		<h1>Historial de Stock</h1>
		<div style="overflow: scroll; height:510px; ">
		<table class="table" >
			<thead>
				<tr style="background-color: #ff8a80;">
					<th  scope="col">ID Carga Stock</th>
					<th scope="col">Producto</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Fecha</th>
				</tr>
			</thead>
			<tbody>
				
					<?php

					while ($filas=mysqli_fetch_array($resultado_consulta) )  {  ?>
						<tr>
					<td><?php echo $filas['id_carga_stock']; ?></td>
					<td><?php echo $filas['nombre_producto']; ?></td>
					<td><?php echo $filas['cantidad']; ?></td>
					<td><?php echo $filas['fecha_carga']; ?></td>		
					</tr>
				<?php	}   ?>
				
			</tbody>
		</table>
	</div>
	</div>
</div>
</body>
</html>