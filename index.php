<?php 

//Comienza la Sesión
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!--FONT AWESOME-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!--CSS LOGIN-->
  <link rel="stylesheet" type="text/css" href="css/estilos_login.css">

</head>
<body>
<div class="modal-dialog text-center">
  <div class="col-sm-8 main-section"> 
    <div class="modal-content">
      <div class="col-12 user-img">
        <img src="img/avatar.png">
      </div>
      <form method="POST" action="login.php" class="col-12">
        <div class="form-group" id="user-group">
          <input type="text" placeholder="Usuario" class="form-control"   required="" name="nombre_usuario">
        </div>
        <div class="form-group" id="pasw-group">
          <input type="password" placeholder="Contraseña" class="form-control" required="" name="contrasena">
        </div>
        <input type="submit" class="btn btn-danger mt-2 mb-2" value="Ingresar" name="">
      </form>
    </div>
  </div>
</div>
</body>
</html>