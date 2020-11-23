<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Historial de Modificaciones</title>
    </head>
    <body>
        <?php
        include "../modelo/conexion.php";
        $request=mysqli_query($conexion,"SELECT * FROM modificaciones where id_cotizacion='".$_GET['cod']."' and modulo='Productos'  order by id_m ");

     

//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Id '.'</th>';
              $table = $table.'<th width="50%">'.'Descripcion de Modificacion'.'</th>';             
              $table = $table.'<th width="20%">'.'Fecha de registro'.'</th>';
              $table = $table.'<th  class="hidden-phone">'.'Por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{  
            
             $table = $table.'<tr><td  width="10%">'.$row['id_m'].'</td><td width="50%">'.$row['descripcion'].'</td><td width="10%">'.$row['registro'].'</font></td><td  class="hidden-phone">'.$row["por"].'<font></a></td></tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        ?>
    </body>
</html>
