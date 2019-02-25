
<?php

session_start();
$var=$_SESSION['admin'];
if ($var==null || $var = '')
{

  print "<script>window.location='index.php';</script>";    
  die();
}

include 'conexion/conexion.php';


$query=("SELECT numero_boleta from detalle_venta ORDER by numero_boleta desc limit 1");
$resultado_consulta_obtener_ultimo_id=mysqli_query($conexion , $query);


$query_venta=("SELECT id_venta from detalle_venta ORDER by id_venta desc limit 1");
$resultado_consulta_obtener_ultimo_id_venta=mysqli_query($conexion , $query_venta);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ventas</title>
  <meta charset="utf-8">
	<script type="text/javascript" src="js/jquery.js"></script>
  <!--SWETTALERT JS -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!--GOOGLE FONTS-->
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/estilos_ticket.css">
  <script src="js/datepicker.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'navbar.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    // $('#tabla_info_clientes').load('php/tabla_datos_ventas.php');
    $('#tabla_productos_agregados').load('php/tabla_detalles_ventas.php');
    // $('#tabla_ventas_realizadas').load('php/tabla_ventas_realizadas.php');
  });
  </script>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
<!--ANIMATED CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<div class="main-content">
<div class="container">
	<h1 style="font-size: 25px;">Realizar Ventas</h1>
          <div class="row mt-2 mb-1">
        <div class="col-lg-4" >
          <input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Buscar por Nombre">
        </div>       
     </div>  
	<div id="tabla_info_clientes"></div>
  <div id="tabla_resultado"></div>
  <h1 class="mt-4 mb-4" style="font-family: 'Fira Sans Condensed', sans-serif; font-size: 25px; height: ">Ventas Realizadas</h1>
  <div class="row">
  <div class="col-lg-4">
<label>Desde :</label> <input class="datepicker2" id="f-desde" width="276" />
</div>
<div class="col-lg-4">
<label>Hasta :</label> <input class="datepicker"  id="f-hasta" width="276" />
</div> 
</div>
  <!-- <div id="tabla_ventas_realizadas"></div> -->
  <div id="agrega-registros"></div>
<!-- Modal AGREGAR VENTA -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" data-keyboard="false"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventas</h5>
       <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnEliminarventaActiva"  onclick="javascript:window.location.reload();">Cerrar<i class="ml-2 fas fa-times"></i></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="formproductos" >
        	<div class="row">
            <div class="col-lg-6">
              <label>Eliga el Producto</label>
          <select required="" name="id_producto" class="form-control">
            <option selected disabled>-- Seleccionar --</option>
          <?php 
          include 'conexion/conexion.php';
          $query=("SELECT id_producto , nombre_producto , cantidad_producto , costo_producto , valor_producto  from productos");
          $resultado_productos=mysqli_query($conexion , $query);

          while ($fila=mysqli_fetch_array($resultado_productos)) { ?>
            <option value="<?php echo $fila['id_producto'];?>"><?php echo $fila['nombre_producto']; ?></option>
          <?php } ?>

          ?>
          </select>



            </div>
            <div class="col-lg-6">
              
          <label>Cantidad</label>
            <!-- <input class="datepicker" id="datepicker" width="276" /> -->
    <script>
        $('.datepicker').datepicker({

            format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4',

        });
    </script>
        <script>
        $('.datepicker2').datepicker({
            format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4'
        });
    </script>
          <input type="number" value="1" min="1" name="cantidad_temporal" class="form-control">
            </div>
          </div>
        	<input type="text" hidden="" id="id_cliente" class="form-control" name="id_cliente">
          <br>
                 <p><?php
                 
               $ids=mysqli_fetch_array($resultado_consulta_obtener_ultimo_id);
                 

                  

                  ?>

                    <input type="hidden" name="numero_boleta" class="form-control" readonly="readonly" value="<?php echo $ids['numero_boleta']?>">
                  </p>     
                    <p><?php
                 
                 while($ids=mysqli_fetch_array($resultado_consulta_obtener_ultimo_id_venta))
                 {

                  ?>
                    <input type="hidden" name="id_venta" class="form-control" readonly="readonly" value="<?php echo $ids['id_venta']+1;?>">

                  <?php } ?>
                  </p> 
        	<button class="btn btn-success "  id="btnGuardar">Agregar<i class="ml-2 fas fa-cart-plus"></i></button>
          
           <div id="tabla_productos_agregados"></div>
      
            <label>Forma de Pago</label>
          <select  name="tipo_pago" class="form-control">
            <option>EFECTIVO</option>
            <option>TRANSBANK</option>
            <option>CRÉDITO</option>
          </select>
          <button class="btn btn-info mt-2"  id="finalizar_compra" >Finalizar Compra</button>
       </form >
      <div id="boleta_venta"></div> 
      <div class="modal-footer">

        
      </div>
    </div>
  </div>
</div>

</div>	

<!--MODAL DETALLES VENTAS DEL CLIENTE X -->

<!-- Modal -->
<div class="modal fade" id="modal_detalles_v_realizadas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DETALLES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--ESTA TABLA NOS TRAERÁ INFORMACIÓN DETALLADAS DE LAS VENTAS REALIZADAS POR LOS CLIENTES (PUEDEN HABER MAS DE UNA VENTA POR CLIENTE)-->
        <div id="tabla_detalles_ventas_realizadas"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

</div>
<!--FUNCION PARA OBTENER LA ID DEL CLIENTE MEDIANTE AJAX-->
  <script type="text/javascript">

     function obtenerId(button){
    var id_cliente=button.id;
    $.ajax({
      url:"php/obtener_id_cliente.php",
      method:"GET", 
      data:{"id_cliente":id_cliente},
      success:function(response){

      	var datos=JSON.parse(response);
      	$("#id_cliente").val(datos.id_cliente);
        $("#id_cliente_form_venta").val(datos.id_cliente);


      }
    });
  }





</script>
<!--FUNCION PARA OBTENER LA ID DE LA VENTA  MEDIANTE AJAX-->
  <script type="text/javascript">

     function obtenerId_venta(button){
    var numero_boleta=button.id;
    $.ajax({
      url:"php/obtener_id_venta.php",
      method:"GET", 
      data:{"numero_boleta":numero_boleta},
      success:function(response){

        // var datos=JSON.parse(response);
         $('#tabla_detalles_ventas_realizadas').html(response);
        // console.log(response);
        // $("#id_cliente").val(datos.id_cliente);
        // $("#id_cliente_form_venta").val(datos.id_cliente);


      }
    });
  }





</script>
<!--FUNCION PARA FILTRAR POR FECHA-->
  <script type="text/javascript">
    
$(document).ready(function(){
    $('#f-desde').on('change', function(){
    var desde = $('#f-desde').val();
    var hasta = $('#f-hasta').val();
    var url = 'php/tabla_ventas_realizadas.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'desde='+desde+'&hasta='+hasta,
    success: function(datos){
      $('#agrega-registros').html(datos);
    }
  });
  return false;
  });
  
  $('#f-hasta').on('change', function(){
    var desde = $('#f-desde').val();
    var hasta = $('#f-hasta').val();
    var url = 'php/tabla_ventas_realizadas.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'desde='+desde+'&hasta='+hasta,
    success: function(datos){
      $('#agrega-registros').html(datos);
    }
  });
  return false;
  });
});
  </script>
<!--FUNCION PARA FINZALIZAR COMPRA-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#finalizar_compra').click(function(){
      var datos=$('#formproductos').serialize();

         $.ajax({
          type:"POST",
          url:"php/finalizar_compra.php",
          data:datos,
          success:function(r){
             if(r==1){

              
          $('#formproductos').hide();
          $('#boleta_venta').load('php/boleta_venta.php');
         

          alertify.success("Venta Realizada con Éxito");
        }else{
           swal("No hay Productos en el carrito.", "", "error");
        }
    
          }

         });
         return false;

       
    });
  });





</script>
<!--FUNCION PARA ELIMINAR LAS VENTAS ACTIVAS -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#btnEliminarventaActiva').click(function(){
      var datos=$('#formproductos').serialize();
          // alert(datos);

         $.ajax({
          type:"POST",
          url:"php/eliminar_ventas_activas.php",
          data:datos,
          success:function(r){
             if(r==1){
        }else{
          alertify.error("Fallo el servidor");
        }
    
          }

         });
         return false;

       
    });
  });




</script>



<script type="text/javascript">
    
      $(document).ready(function(){
    $('#btnFinalizar').click(function(){
      var datos_2=$('#formventas').serialize();
          // alert(datos);

         $.ajax({
          type:"POST",
          url:"finalizar_compra.php",
          data:datos_2,
          success:function(r){
           if(r==1){
          $('#tabla_productos_agregados').load('php/tabla_detalles_ventas.php');
          alertify.success("Producto Removido");
        }else{
          alertify.error("Fallo el servidor");
        }

          }

         });

         return false;
       
    });
  });


</script>
<script type="text/javascript">
function eliminarDatos(id_producto){

  cadena="id_producto=" + id_producto;

    $.ajax({
      type:"POST",
      url:"php/eliminar_producto_lista.php",
      data:cadena,
      success:function(r){
        if(r==1){
          $('#tabla_productos_agregados').load('php/tabla_detalles_ventas.php');
          alertify.success("Producto Removido");
        }else{
          alertify.error("Fallo el servidor");
        }
      }
    });
}

</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#btnGuardar').click(function(){
      var datos= $('#formproductos').serialize();
         

 // alert('got here');
 

         $.ajax({
          type:"POST",
          url:"registrar_venta.php",
          data:datos,
          success:function(r){
            if(r==1){

           $('#tabla_productos_agregados').load('php/tabla_detalles_ventas.php');
         
            }else{
            swal("Seleccione un producto.", "", "warning");
            }
    
          }

         });
          return false;
       
    });
  });





</script>
<script type="text/javascript">
  $(obtener_registros());

function obtener_registros(nombre_cliente)
{
  $.ajax({
    url : 'buscador_para_realizar_venta.php',
    type : 'POST',
    dataType : 'html',
    data : { nombre_cliente: nombre_cliente },
    })

  .done(function(resultado){
    $("#tabla_resultado").html(resultado);
  })
}

$(document).on('keyup', '#busqueda', function()
{
  var valorBusqueda=$(this).val();
  if (valorBusqueda!="")
  {
    obtener_registros(valorBusqueda);
  }
  else
    {
      obtener_registros();
    }
});

</script> 
</body>
</html>