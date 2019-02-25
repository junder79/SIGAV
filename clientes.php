<?php 

session_start();
$var=$_SESSION['admin'];
if ($var==null || $var = '')
{

  print "<script>window.location='index.php';</script>";    
  die();
}
?>
<!DOCTYPE html>
<html>
  <head>

    <title>Inicio</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="js/jquery.js"></script>
     <script type="text/javascript" src="js/jquery.tabledit.js"></script>
     <script src="js/validarRUT.js"></script>
  </head>
  <body>
   <?php include 'navbar.php';  ?>
   <div class="main-content">

     <div class="container">  
       <h1>Clientes</h1>
              <div class="row mt-4 mb-4">
        <div class="col-lg-4" >
          <input type="text" name="busqueda" class="form-control" id="busqueda" placeholder="Buscar por Nombre">
        </div>       
     </div>  
<!-- Button trigger modal -->
<button  type="button" class="mt-2 mb-2 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Agregar Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="registrar_clientes.php">
   <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
    <label for="">RUT</label>
     <input type="text" id="rut"  name="rut_cliente" class="form-control" required oninput="checkRut(this)" placeholder="Ingrese RUT">
  </div>
    </div>
    <div class="col-lg-6">
       <div class="form-group">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombre_cliente" id="" required="" aria-describedby="" placeholder="Nombre ">
  </div>
    </div>
   </div>       
  
<div class="row">
<div class="col-lg-6">  

 <div class="form-group">
    <label for="">Correo</label>
    <input type="email" name="correo_cliente" class="form-control" id="" aria-describedby="" placeholder="Correo">
  </div>
</div>  
<div class="col-lg-6">  
   <div class="form-group">
    <label for="">Giro</label>
    <input type="text" name="giro_cliente" required="" class="form-control" id="" aria-describedby="" placeholder="Giro">
  </div>

</div>  
</div>


<div class="row">
    
<div class="col-lg-6">  
   <div class="form-group">
    <label for="">Dirección</label>
    <input type="text" name="direccion_cliente" class="form-control" required="" id="" aria-describedby="" placeholder="Direccion">
  </div>
</div>  
<div class="col-lg-6">  

 <div class="form-group">
    <label for="">Teléfono</label>
    <input type="text" name="telefono_cliente" class="form-control" id="" required="" aria-describedby="" placeholder="Teléfono">
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
<div id="tabla_resultado"></div>
            
      </div>
 
  
</div>

</div>


   <script type="text/javascript">
  $(obtener_registros());

function obtener_registros(nombre_cliente)
{
  $.ajax({
    url : 'buscador_clientes_tabla.php',
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
   </div>
  </body>
</html>