
<!DOCTYPE html>
<html>
<head>
	<title>Detalle Venta</title>
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">   
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="main-content">
	<div class="container">
		<h1>Detalle Venta</h1>
		<h1>id cliente : </h1>
		<h1>id producto</h1>
		<input type="text" id="id_cliente" name="">
	</div>
</div>
  <script type="text/javascript">

     function obtenerId(button){
    var id_cliente=button.id;
    $.ajax({
      url:"obtener_id_cliente.php",
      method:"GET", 
      data:{"id_cliente":id_cliente},
      success:function(response){

      	var datos=JSON.parse(response);
      	$("#id_cliente").val(datos.id_cliente);


      }
    });
  }

</script>
</body>
</html>
