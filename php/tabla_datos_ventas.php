<?php

include '../conexion/conexion.php';

$query=("SELECT id_cliente , rut_cliente , nombre_cliente , giro_cliente  from clientes ");

$resultado=mysqli_query($conexion , $query);

?>
  <div  style="overflow: scroll; height: 230px;">
      <table id="tabla_editable" class="table table-bordered table-striped">
        <thead>
          <tr style="background-color: #311b92 ;  color: white;">
              <th>ID Cliente</th>
              <th>RUT</th>
              <th>Nombre</th>
              <th>Giro</th>
              <th></th>
          </tr>
        </thead>

        <tbody>

              <?php 

          while ($filas=mysqli_fetch_array($resultado))  { ?>
            
            <tr>
              <td><?php echo $filas["id_cliente"] ?> </td>
              <td><?php echo $filas["rut_cliente"] ?> </td>
              <td><?php echo $filas["nombre_cliente"] ?> </td>
              <td><?php echo $filas["giro_cliente"] ?> </td>
              <td><button type="button" class="btn btn-danger "  data-toggle="modal" data-target="#exampleModal"   id="<?php echo $filas['id_cliente']; ?>" onclick="obtenerId(this);">Nueva Venta<i class="ml-2 far fa-plus-square"></i></button></td>
            </tr>
        
          
         <?php }  ?>
          

        </tbody>
      </table>
</div>
<!-- FUNCION PARA ELIMINAR LAS VENTAS ACTIVAS-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn-eliminar-venta-activas').click(function(){
      var datos=$('#formproductos').serialize();
          // alert(datos);

         $.ajax({
          type:"POST",
          url:"php/eliminar_ventas_activas.php",
          data:datos,
          success:function(r){
             if(r==1){
          // $('#formproductos').hide();
          // $('#boleta_venta').load('php/boleta_venta.php');
         

          alertify.success("Eliminado");
        }else{
          alertify.error("Fallo el servidor");
        }
    
          }

         });
         return false;

       
    });
  });



</script>