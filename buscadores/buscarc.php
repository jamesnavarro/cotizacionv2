<?php
session_start();
include "../modelo/conexion.php";
include "../modelo/consultar_permisos.php";
function interval_date($init,$finish)
{
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
 
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    if($diferencia < 60){
        $tiempo = "Hace " . floor($diferencia) . " segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo = "Hace " . floor($diferencia/60) . " minutos'";
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo = "Hace " . floor($diferencia/3600) . " horas";
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo = "Hace " . floor($diferencia/86400) . " días";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo = "Hace " . floor($diferencia/2592000) . " meses";
    }else if($diferencia > 31104000){
        $tiempo = "Hace " . floor($diferencia/31104000) . " años";
    }else{
        $tiempo = "Error";
    }
    return $tiempo;
}
function interval_date2($init,$finish)
{
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
 
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    if($diferencia < 60){
        $tiempo =  floor($diferencia) . " segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo =  floor($diferencia/60) . " minutos'";
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo =  floor($diferencia/3600) . " horas";
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo =  floor($diferencia/86400) . " días";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo =  floor($diferencia/2592000) . " meses";
    }else if($diferencia > 31104000){
        $tiempo =  floor($diferencia/31104000) . " años";
    }else{
        $tiempo = "Error";
    }
    return $tiempo;
}
if (isset($_POST["cot"])) { 

}	?>
            
<table class="table table-bordered table-striped table-hover" id="">
           <thead >
          <tr BGCOLOR="#C3D9FF">
                
           <th width="10%">No Documento</th>
           <th width="30%">Nombre del Cliente</th>
            <th width="30%">Telefono</th>
                       <th width="10%">Desc. Vid</th>
              <th width="10%">Desc. Alum</th>
              <th width="10%">Desc. Acero</th>
              <th width="10%">Desc. Autorizado</th>
            </tr>
        </thead>
<?php
if($_POST['cot']!=''){ $cot = ' and cod_ter like "%'.$_POST['cot'].'%"'; }else{$cot = ''; }
if($_POST['nom']!=''){ $nom = ' and nom_ter like "%'.$_POST['nom'].'%"'; }else{$nom = ''; }
if($_POST['cot']=='' && $_POST['nom']=='' ){
    $request2=mysqli_query($conexion,"SELECT * FROM cont_terceros  where estado_ter='0' order by nom_ter asc LIMIT 30 ");
}else{
    if($_POST['cot']==''&& $_POST['nom']!='' ){
   
    $request2=mysqli_query($conexion,"SELECT * FROM cont_terceros where estado_ter='0' $nom "); 
}
    if($_POST['nom']==''&& $_POST['cot']!='' ){
   
    $request2=mysqli_query($conexion,"SELECT * FROM cont_terceros where estado_ter='0' $cot "); 
    }
if($_POST['cot']!='' && $_POST['nom']!='' ){
   $request2=mysqli_query($conexion,"SELECT * FROM cont_terceros where estado_ter='0' $cot and $nom "); 
}

}
	while($rowk=mysqli_fetch_array($request2))
	{       
           ?> 
           <tr>
                  <td width="5%"><?php echo $rowk['cod_ter'];?></font></td>
                  <td width="30%"><a href="../vistas/terceros.php?codigo=<?php echo $rowk["id_ter"]?>"><?php echo $rowk['nom_ter'];?></a></td>
                  <td width="5%"><?php echo $rowk['telfijo_ter'];?></font></td>
                  <td><?php if($_SESSION['admin']=='Si'){ ?> 
                      <input type="number" id="tervid<?php echo $rowk['id_ter'];?>" onchange="cambiar(<?php echo $rowk['id_ter'];?>)" value="<?php echo $rowk['pvi'];?>" style="width:50px;">
                  <?php }else{  echo $rowk['pvi'];  } ?></td>
                  <td><?php if($_SESSION['admin']=='Si'){ ?> 
                      <input type="number" id="teral<?php echo $rowk['id_ter'];?>" onchange="cambiar(<?php echo $rowk['id_ter'];?>)" value="<?php echo $rowk['pal'];?>" style="width:50px;">
                  <?php }else{  echo $rowk['pal'];  } ?></td>
                  <td><?php if($_SESSION['admin']=='Si'){ ?> 
                      <input type="number" id="terac<?php echo $rowk['id_ter'];?>" onchange="cambiar(<?php echo $rowk['id_ter'];?>)" value="<?php echo $rowk['pac'];?>" style="width:50px;">
                  <?php }else{  echo $rowk['pac'];  } ?></td>
                  <td id="aut<?php echo $rowk['id_ter'];?>"><?php echo $rowk['autorizacion'];?></td>
                   </tr>
           
		
        <?php          
	} 	    ?> 
 </table>
