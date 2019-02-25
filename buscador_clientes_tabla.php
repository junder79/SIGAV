<?php

include 'conexion/conexion.php';


$tabla="";
//Consulta que nos devuelte sin rut ingresado 
$query="

SELECT * from clientes order by nombre_cliente asc;
	
";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['nombre_cliente']))
{
	$q=$conexion->real_escape_string($_POST['nombre_cliente']);
	$query="

		SELECT * from clientes where nombre_cliente like '%$q%' order by nombre_cliente asc;

	  ";
}

$buscarNombre=$conexion->query($query);
if ($buscarNombre->num_rows > 0)
{
	$tabla.= 
	'
	<table id="tabla_editable" class="table table-bordered table-striped">
        <thead>
          <tr>
              <th>ID Cliente</th>
              <th>RUT</th>
              <th>Nombre</th>
              <th>Giro</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Correo</th>  
          </tr>
        </thead>

         </thead>

        <tbody>

		';

	while($fila=$buscarNombre->fetch_assoc())
	{
		$tabla.=
		'<tr>
              <td>'.$fila["id_cliente"].'</td>
        <td>'.$fila["rut_cliente"].'</td>
            <td>'.$fila["nombre_cliente"].'</td>
            <td>'.$fila["giro_cliente"].'</td>
            <td>'.$fila["direccion_cliente"].'</td>
        <td>'.$fila['telefono_cliente'].'</td>
            <td>'.$fila["email_cliente"].'</td>
        </tr>
		';
	}

	$tabla.='


        </tbody>
	</table>';
} else
	{
		$tabla="
		<center>
		<h1>No hay Resultados.</h1>
		<img  height='250' width='250' src='https://www.sitegratisgratis.com.br/wp-content/uploads/2015/12/animat-search-color.gif'>
		</center>
		";
	}


$tabla.="
<script>  
$(document).ready(function(){
    $('#tabla_editable').Tabledit({
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
         identifier:[0, 'id_cliente'],
        editable:[[2, 'nombre_cliente'] ,[3, 'giro_cliente'] , [4, 'direccion_cliente'] , [5, 'telefono_cliente'] , [6, 'email_cliente']]
        },
        hideIdentifier:true,
        url: 'tabla_clientes.php'      
    });
});
 </script>
";

echo $tabla;


?>