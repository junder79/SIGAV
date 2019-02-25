<?php
session_start();
$var=$_SESSION['admin'];
if ($var==null || $var = '')
{
  print "<script>window.location='index.php';</script>";    
  die();
}

include 'conexion/conexion.php';

$query=("SELECT id_producto , nombre_producto , cantidad_producto ,format(costo_producto , 0 ,'de_DE') as 'costo' , format(valor_producto , 0 , 'de_DE') as 'valor' from productos  order by nombre_producto asc");
$resultado_consulta=mysqli_query($conexion , $query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>
  <meta charset="utf-8">
	   <script type="text/javascript" src="js/jquery.js"></script>
     <script type="text/javascript" src="js/jquery.tabledit.js"></script>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="main-content">
<div class="container">
<h1>Productos</h1>
<button class="btn btn-info" data-toggle="modal" data-target="#exampleModal" >Agregar Productos</button>	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="registrar_productos.php">
   <div class="row">
   	<div class="col-lg-6">
   		<div class="form-group">
    <label for="">Nombre del Producto</label>
    <input type="text" name="nombre_producto" class="form-control" id="" required="" aria-describedby="" placeholder="Nombre">
  </div>
   	</div>
   	<div class="col-lg-6">
   		 <div class="form-group">
    <label for="">Cantidad</label>
    <input type="number" class="form-control" min="1" name="cantidad_producto" required="" id="" aria-describedby="" placeholder="Cantidad">
  </div>
   	</div>
   </div>      	
  
<div class="row">
<div class="col-lg-6">	

 <div class="form-group">
    <label for="">Costo </label>
    <input type="text" name="costo_producto" class="form-control" id="" required="" aria-describedby="" placeholder="Costo">
  </div>
</div>	
<div class="col-lg-6">	
	 <div class="form-group">
    <label for="">Valor</label>
    <input type="text" name="valor_producto" class="form-control" required="" id="" aria-describedby="" placeholder="Valor">
  </div>

</div>	
</div>


      <input type="submit" name="" class="btn btn-success " value="Registrar">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div style="overflow: scroll; height: 470px;">
  <!--TABLA DE PRODUCTOS AGREGADOS-->
<table id="tabla_editable_productos" class="table table-striped mt-2">
  <thead>
    <tr>
      <th scope="col">ID PRODUCTO</th>
      <th scope="col">Nombre Producto</th>
      <th scope="col">Stock Producto</th>
      <th scope="col">Costo</th>
      <th scope="col">Valor</th>
    </tr>
  </thead>
  <tbody>
   
              <?php 

          while ($filas=mysqli_fetch_array($resultado_consulta)) { ?>



            <tr>
              <td><?php echo $filas["id_producto"] ?> </td>
              <td><?php echo $filas["nombre_producto"] ?> </td>
              <td><?php echo $filas["cantidad_producto"] ?> </td>
              <td><?php echo $filas["costo"] ?> </td>
              <td><?php echo $filas["valor"] ?> </td>
              <td><button type="button" class="btn btn-info"  data-toggle="modal" data-target="#editar_stock" id="<?php echo $filas['id_producto']; ?>" onclick="obtenerId_producto(this);"><i class="fas fa-plus-square mr-2"></i>Stock</button></td>
            </tr>
        


         <?php }  ?>
          
  </tbody>
</table>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editar_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Cantidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST" action="php/modificar_stock.php">
         <label style="font-size: 40px;" >Stock Actual : <span " id="stock_actual"></span></label>
         <br>
          <div class="row"  style=" margin-left: 0px; width: 100px; height: 100px;">
          <label>Agregar Cantidad</label>
         <input type="number" min="1" class="form-control" name="stock_nuevo">
          </div>
          <br>
         <input type="text" hidden="" id="id_producto" class="form-control" name="id_producto">
         <input type="submit" class="btn btn-success" name="" value="GUARDAR">
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
       function obtenerId_producto(button){
    var id_producto=button.id;
    $.ajax({
      url:"php/obtener_id_producto.php",
      method:"GET", 
      data:{"id_producto":id_producto},
      success:function(response){

        var datos=JSON.parse(response);
        $("#stock_actual").text(datos.cantidad_producto);
         $("#id_producto").val(datos.id_producto);
        // alert(response);


      }
    });
  }
</script>
<script>  
$(document).ready(function(){
    $('#tabla_editable_productos').Tabledit({
        deleteButton: true,
        editButton: true,
        restoreButton:false,
         buttons: {
                edit: {
                    class: 'btn btn-sm btn-warning',
                    html: 'Editar',
                    action: 'edit'
                },
                delete: {
                    class: 'btn btn-sm btn-danger',
                    html: 'Eliminar',
                    action: 'delete'
                },
                save: {   
                    class: 'btn btn-sm btn-success',
                    html: 'Guardar',
                    action:'save'
                },
                confirm: {
                    class: 'btn btn-sm btn-dark',
                    html: 'Confirmar' ,
                    action:'confirm'
                }
            },                
        columns: {
         identifier:[0, "id_producto"],
        editable:[[1, 'nombre_producto'] , [3, 'costo_producto'] ,[4, 'valor_producto'] ]
  
        },

        hideIdentifier:true,
        url: 'tabla_productos.php'      
    });
});
 </script>

</div>
</div>
</body>
</html>