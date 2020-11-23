<?php
         include '../modelo/conexion.php';
         if(isset($_POST['ciudad'])){
              $request=mysqli_query($conexion,"SELECT * FROM departamentos where nombre_dep = '".$_POST['munix']."' and nombre_mun like '%".$_POST['ciudad']."%' ");
         }else{
    $request=mysqli_query($conexion,"SELECT * FROM departamentos where nombre_dep = '".$_GET['muni']."' ");
         }
?>
<table class="table table-bordered table-striped table-hover" id="">
            <thead >
            <tr BGCOLOR="#C3D9FF">
                
              <th width="30%">Codigo del Municipio</th>
              <th width="30%">Nombre del Municipio</th>
              
              </tr>
              </thead>
	
    
   <?php
	while($rowk=mysqli_fetch_array($request))
	{    
           ?> 
           <tr><td width="5%"><?php echo $rowk['cod_mun'];?></font></td>
                  <td width="30%"><a href="../vistas/municipio.php?codigo=<?php echo $rowk["id"]?>"><?php echo $rowk['nombre_mun'];?></a></td>
                  
            </tr>
           	
        <?php          
	} 	
        ?> 
 </table>

