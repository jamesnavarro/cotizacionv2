<?php
         include '../modelo/conexion.php';
         if(isset($_POST['asesor'])){
              $request=mysql_query('SELECT * FROM `usuarios` where concat(nombre," ",apellido) like "%'.$_POST['asesor'].'%" ');
         }else{
              $request=mysql_query('SELECT * FROM `usuarios` where estado="Activo" and area != "Produccion" order by nombre asc ');
         }
    ?>
<table class="table table-bordered table-striped table-hover" id="">
            <thead>
            <tr BGCOLOR="#C3D9FF"> 
              <th width="10%">No Documento</th>
              <th width="30%">Nombre del Vendedor</th>
              <th width="30%">Usuario</th>
              <th width="30%">areas</th>
              </tr>
            </thead>
	
   <?php
	while($rowk=mysql_fetch_array($request))
	{    
            
           ?> 
           <tr>
                <td width="5%"><?php echo $rowk['cedula'];?></font></td>
                <td width="30%"><a href="../vistas/asesor.php?codigo=<?php echo $rowk["id_user"]?>"><?php echo $rowk['nombre'].' '.$rowk['apellido'];?></a></td>
                <td width="5%"><?php echo $rowk['usuario'];?></font></td>
                <td width="5%"><?php echo $rowk['area'];?></font></td>
            </tr>
           	
        <?php          
	} 	
        ?> 
 </table>

