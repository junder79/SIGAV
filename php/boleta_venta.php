<?php

include '../conexion/conexion.php';
$query=("
select p.nombre_producto ,dv.cantidad , FORMAT((p.valor_producto*dv.cantidad),0,'de_DE')  as 'Total'  from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
where dv.numero_boleta = (SELECT max(numero_boleta) from detalle_venta )");

$resultado=mysqli_query($conexion , $query);

?>

<div  class="container">
  <center> <h1>Compra Exitosa</h1>
  <img width="100" height="100"  class="animated fadeIn img-fluid"  src="../sigav/img/icono-check.png"></center>
	<table class="table mt-2">
  <thead>
    <tr>
      <th scope="col">PRODUCTO</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">TOTAL</th>
    </tr>
  </thead>
  <tbody>
    
    	<?php while ($filas=mysqli_fetch_array($resultado))  { ?>
        <tr>
    		<td><?php echo $filas['nombre_producto']; ?></td>
    		<td><?php echo $filas['cantidad']; ?></td>
    		<td>$ <?php echo $filas['Total']; ?></td>
          </tr>
   <?php 	}   ?>
  
  </tbody>
</table>
	<!-- <button id="btn-imprimir" onclick="imprimir();" class="btn btn-success">Imprimir<i class="ml-2 fas fa-print"></i></button> -->
  <div id="printableArea" style='display:none;'>

  <div class="ticket">
    <img class="logotipo" src="../sigav/img/logo_1.png"  alt="Logotipo">
    <p class="centrado">TICKET DE VENTA
      <br>SIGAV
      <br>FECHA: <span id="fecha"></span></p>
      <p><?php     
        include 'conexion/conexion.php';
        $consulta=("SELECT max(dv.numero_boleta) as 'numero_boleta' , c.nombre_cliente , c.direccion_cliente , c.telefono_cliente from detalle_venta dv 
      join clientes c 
      on c.id_cliente = dv.id_cliente");
        $resultado=mysqli_query($conexion , $consulta);
      while($datos=mysqli_fetch_array($resultado))
      {
       echo "<span style='font-size: 10px;margin-top:0px;'>N° BOLETA : ".$datos['numero_boleta']."</span><br>";
      echo "<span style='font-size: 10px;'>CLIENTE : ".$datos['nombre_cliente']."</span><br>";
      echo "<span style='font-size: 10px;'>DIRECCIÓN : ".$datos['direccion_cliente']."</span><br>";
      echo "<span style='font-size: 10px;'>TELÉFONO : ".$datos['telefono_cliente']."</span><br>";
      } ?>
      </p>

    <table>
      <thead>
        <tr>
          <th class="cantidad">PRODUCTO</th>
          <th class="producto">CANT.</th>
          <th class="precio">TOTAL</th>
        </tr>
      </thead>
      <tbody>
      <?php 

  $query=("SELECT  dv.numero_boleta,c.nombre_cliente, p.nombre_producto ,dv.cantidad , FORMAT((p.valor_producto*dv.cantidad),0,'de_DE')  as 'total'  from detalle_venta dv 
join productos p 
on p.id_producto=dv.id_producto
join clientes c 
on c.id_cliente=dv.id_cliente
where dv.numero_boleta = (SELECT max(numero_boleta) from detalle_venta)");

  $resultado=mysqli_query($conexion , $query);

  while ($fila=mysqli_fetch_array($resultado))
  { ?>
  <tr>
    <th><?php echo $fila['nombre_producto'] ?></th>
    <th><?php echo $fila['cantidad'] ?> </th> 
    <th><?php echo "$".$fila['total'] ?></th>
  </tr>

 <?php }

  ?>
      </tbody>
    </table>
    <?php 

    $query=("SELECT FORMAT(sum(p.valor_producto*dv.cantidad),0,'de_DE') as 'total'  from detalle_venta dv 
    join productos p 
    on p.id_producto=dv.id_producto
    join clientes c 
    on c.id_cliente=dv.id_cliente
    where dv.numero_boleta = (SELECT max(numero_boleta) from detalle_venta)");

    $resultado_total=mysqli_query($conexion , $query);
    while ($total_fila=mysqli_fetch_array($resultado_total))
    {
      echo " <p style='font-weight:bold;'>TOTAL COMPRA : $".$total_fila['total']."</p>";
    }
    ?>
   
    <p class="centrado">¡GRACIAS POR SU COMPRA!
      <br>www.sistemadeventa.com</p>
  </div>
</div>

<input type="button" onclick="printDiv('printableArea'); obtenerDatos(this);" class="btn btn-success" value="IMPRIMIR BOLETA" />

        <script type="text/javascript">
          function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
        </script>
</div>

  <script type="text/javascript">

     function obtenerDatos(button){
    var numero_boleta=button.id;
    $.ajax({
      url:"php/ticket_detalle_venta.php",
      method:"GET", 
      data:{"numero_boleta":numero_boleta},
      success:function(response){

        // var datos=JSON.parse(response);
         // $('#tabla_detalles_ventas_realizadas').html(response);
        // console.log(datos);
        // alert(datos);
        // $("#numero_boleta").text(datos.numero_boleta);
        // $("#nombre_producto").text(datos.nombre_producto);
        // $("#cantidad").text(datos.cantidad);
        // $("#nombre_cliente").text(datos.nombre_cliente);
        // $("#5").text(datos.numero_boleta);
        // $("#id_cliente_form_venta").val(datos.id_cliente);


      }
    });
  }





</script>
<script>
$( document ).ready(function() {

    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $("#fecha").text(today);
});
</script>