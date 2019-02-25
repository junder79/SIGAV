<?php

include 'conexion/conexion.php';


$tabla="";
//Consulta que nos devuelte sin rut ingresado 
$query="

SELECT id_cliente , rut_cliente , nombre_cliente , giro_cliente  from clientes order by nombre_cliente asc
	
";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['nombre_cliente']))
{
	$q=$conexion->real_escape_string($_POST['nombre_cliente']);
	$query="

		SELECT id_cliente , rut_cliente , nombre_cliente , giro_cliente from clientes where nombre_cliente like '%$q%' order by nombre_cliente asc

	  ";
}

$buscarNombre=$conexion->query($query);
if ($buscarNombre->num_rows > 0)
{
	$tabla.= 
	'
   <div  style="overflow: scroll; height: 230px;">
	<table id="tabla_editable" class="table table-bordered table-striped">
        <thead>
          <tr style="background-color: #311b92 ;  color: white;">
              <th>RUT</th>
              <th>Nombre</th>
              <th>Giro</th>
              <th width="20%">Opción</th>
          </tr>
        </thead>

         </thead>

        <tbody>

		';

	while($fila=$buscarNombre->fetch_assoc())
	{
		$tabla.=
		' <tr>
              <td>'.$fila["rut_cliente"].'</td>
              <td>'.$fila["nombre_cliente"].'</td>
              <td>'.$fila["giro_cliente"].'</td>
              <td><button type="button" class="btn btn-danger "  data-toggle="modal" data-target="#exampleModal"    id='.$fila['id_cliente'].'  onclick="obtenerId(this);">Nueva Venta<i class="ml-2 far fa-plus-square"></i></button></td>
            </tr>
		';
	}

	$tabla.='


        </tbody>
	</table>
  </div>
  ';
} else
	{
		$tabla="
		<center >
		<h1 >No hay Resultados.</h1>
		<img   height='120' width='120' src='https://www.sitegratisgratis.com.br/wp-content/uploads/2015/12/animat-search-color.gif'>
		</center>
		";
	}


$tabla.="
<!-- FUNCION PARA ELIMINAR LAS VENTAS ACTIVAS-->
<script type='text/javascript'>
  $(document).ready(function(){
    $('.btn-eliminar-venta-activas').click(function(){
      var datos=$('#formproductos').serialize();
          // alert(datos);

         $.ajax({
          type:'POST',
          url:'php/eliminar_ventas_activas.php',
          data:datos,
          success:function(r){
             if(r==1){
          // $('#formproductos').hide();
          // $('#boleta_venta').load('php/boleta_venta.php');
         

          alertify.success('Eliminado');
        }else{
          alertify.error('Fallo el servidor');
        }
    
          }

         });
         return false;

       
    });
  });



</script>
";

echo $tabla;


?>