<script >
    var mostrarValor = function(x){
        
            document.getElementById('ase').value=x;

    }
    var mostrarValor2 = function(y){
        
            document.getElementById('reg').value=y;

    }
    $(document).keyup(function(event){
    if(event.keyCode == 13){
        $("#xbuscador").click();
    }
});
</script>
    <?php 
if(isset($_POST['cadena'])){
    if($_POST['fecha1']=='' && $_POST['fecha2']==''){
         $request=mysqli_query($conexion,"SELECT count(*) FROM cotizacion a, sis_contacto b where a.id_cliente=b.id_contacto and CONCAT(b.nombre_cont, ' ', b.apellido_cont,' ', b.cedula_cont,' ', a.obra) like '%".$_POST['cadena']."%' and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%' and a.grabado  like '%".$_POST['presupuesto']."%'  and a.estado like '".$_POST['estado']."%'  union"
          . " SELECT count(*) FROM cotizacion a, sis_empresa b where a.id_cliente=b.id_empresa and CONCAT(b.nombre_emp,' ', b.nit_emp,' ', a.obra) like '%".$_POST['cadena']."%'  and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%'  and a.grabado  like '%".$_POST['presupuesto']."%' and a.estado like '".$_POST['estado']."%'");
    }else{
         $request=mysqli_query($conexion,"SELECT count(*)  FROM cotizacion a, sis_contacto b where a.id_cliente=b.id_contacto and CONCAT(b.nombre_cont, ' ', b.apellido_cont,' ', b.cedula_cont,' ', a.obra) like '%".$_POST['cadena']."%' and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%' and a.grabado  like '%".$_POST['presupuesto']."%'  and a.estado like '".$_POST['estado']."%' and a.fecha_reg_c between '".$_POST['fecha1']." 00:00:00' and '".$_POST['fecha2']." 23:00:00'  union"
          . " SELECT count(*) FROM cotizacion a, sis_empresa b where a.id_cliente=b.id_empresa and CONCAT(b.nombre_emp,' ', b.nit_emp,' ', a.obra) like '%".$_POST['cadena']."%'  and a.numero_cotizacion  like '%".$_POST['numero']."%'  and a.registrado  like '%".$_POST['asesor']."%'  and a.grabado  like '%".$_POST['presupuesto']."%' and a.estado like '".$_POST['estado']."%'  and a.fecha_reg_c between '".$_POST['fecha1']." 00:00:00' and '".$_POST['fecha2']." 23:00:00'");
    }
    }else{
        if(isset($_GET['cadena'])){
            $_POST['numero'] = $_GET['numero'];
            $_POST['asesor'] = $_GET['asesor'];
            $_POST['presupuesto'] = $_GET['presupuesto'];
            $_POST['estado'] = $_GET['estado'];
            $_POST['fecha1'] = $_GET['fecha1'];
            $_POST['fecha2'] = $_GET['fecha2'];
            $_POST['cadena'] = $_GET['cadena'];
    if($_GET['fecha1']=='' && $_GET['fecha2']==''){
         $request=mysqli_query($conexion,"SELECT count(*) FROM cotizacion a, sis_contacto b where a.id_cliente=b.id_contacto and CONCAT(b.nombre_cont, ' ', b.apellido_cont,' ', b.cedula_cont,' ', a.obra) like '%".$_GET['cadena']."%' and a.numero_cotizacion  like '%".$_GET['numero']."%'  and a.registrado  like '%".$_GET['asesor']."%' and a.grabado  like '%".$_GET['presupuesto']."%'  and a.estado like '".$_GET['estado']."%'  union"
          . " SELECT count(*) FROM cotizacion a, sis_empresa b where a.id_cliente=b.id_empresa and CONCAT(b.nombre_emp,' ', b.nit_emp,' ', a.obra) like '%".$_GET['cadena']."%'  and a.numero_cotizacion  like '%".$_GET['numero']."%'  and a.registrado  like '%".$_GET['asesor']."%'  and a.grabado  like '%".$_GET['presupuesto']."%' and a.estado like '".$_GET['estado']."%'");
    }else{
         $request=mysqli_query($conexion,"SELECT count(*)  FROM cotizacion a, sis_contacto b where a.id_cliente=b.id_contacto and CONCAT(b.nombre_cont, ' ', b.apellido_cont,' ', b.cedula_cont,' ', a.obra) like '%".$_GET['cadena']."%' and a.numero_cotizacion  like '%".$_GET['numero']."%'  and a.registrado  like '%".$_GET['asesor']."%' and a.grabado  like '%".$_GET['presupuesto']."%'  and a.estado like '".$_GET['estado']."%' and a.fecha_reg_c between '".$_GET['fecha1']." 00:00:00' and '".$_GET['fecha2']." 23:00:00'  union"
          . " SELECT count(*) FROM cotizacion a, sis_empresa b where a.id_cliente=b.id_empresa and CONCAT(b.nombre_emp,' ', b.nit_emp,' ', a.obra) like '%".$_GET['cadena']."%'  and a.numero_cotizacion  like '%".$_GET['numero']."%'  and a.registrado  like '%".$_GET['asesor']."%'  and a.grabado  like '%".$_GET['presupuesto']."%' and a.estado like '".$_GET['estado']."%'  and a.fecha_reg_c between '".$_GET['fecha1']." 00:00:00' and '".$_GET['fecha2']." 23:00:00'");
    }
    }else{
       $request=mysqli_query($conexion,'select count(*) from cotizacion  where estado="Aprobado"');
    }}
if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
 function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Cotizaciones Realizadas</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

    
                                  <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                              

                                
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">
                              

<?php
if(isset($_GET['pasar'])){
    $re=mysqli_query($conexion,"SELECT * FROM cotizacion ");
    $v = 0;
    while($r=mysqli_fetch_array($re))
	{
          
              $sql='select * from cont_terceros where id_cliente="'.$r['id_cliente'].'" and tipo="'.$r['tipo'].'" ';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$id= $fil["id_ter"];
          
            $v +=1;
            $sql2 = "UPDATE `cotizacion` SET `id_tercero`='".$id."' WHERE `id_cliente`='".$r['id_cliente']."' and tipo='".$r['tipo']."' ;";
            mysqli_query($conexion,$sql2) or die (mysqli_error());

        }
             echo '<script lanquage="javascript">alert("Se ha agregado a la lista de tercero '.$v.'");location.href="../vistas/?id=lista_cot&estado=En proceso"</script>'; 

}else{

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
if(isset($_POST['numero'])){
  
    $lin = '&numero='.$_POST['numero'].'&asesor='.$_POST['asesor'].'&presupuesto='.$_POST['presupuesto'].'&estado='.$_POST['estado'].'&fecha1='.$_POST['fecha1'].'&fecha2='.$_POST['fecha2'].'&cadena='.$_POST['cadena'].' ';
}else{
if(isset($_GET['numero'])){
    
       $lin = '&numero='.$_GET['numero'].'&asesor='.$_GET['asesor'].'&presupuesto='.$_GET['presupuesto'].'&estado='.$_GET['estado'].'&fecha1='.$_GET['fecha1'].'&fecha2='.$_GET['fecha2'].'&cadena='.$_GET['cadena'].' ';

}else{
    $lin ='';
}

}
if($page>1){?>
	<a href="../vistas/?id=lista_cot&page=1<?php echo $lin; ?>"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=lista_cot&page=<?php echo $page - 1;?><?php echo $lin; ?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=lista_cot&page=<?php echo $page + 1;?><?php echo $lin; ?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=lista_cot&page=<?php echo $last_page;?><?php echo $lin; ?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
$request=mysqli_query($conexion,"SELECT *, (select concat(nombre,' ',apellido) from usuarios where id_user=aprobado_por) as nomb, (select sum(cant_restante) from cotizaciones where id_cot=a.id_cot) as cr FROM cotizacion a where a.estado='Aprobado' order by a.numero_cotizacion desc  ".$limit);
   echo '<i>Numero de Cotizaciones: <font color="red">'.$num_items.'</font></i>';  
if($request){
?>
       <table class="table table-bordered table-striped table-hover" id="">

          
             <tr bgcolor="#D1EEF0">
               <th class="hidden-phone">Ver</th>
               <th width="5%"><input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="#" value=""></th> 
              
                <th width="20%"><input type="text"  autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value=""></th>
              <th width="20%"><input type="text" autocomplete="off" class="span12" id="obr" placeholder="Obra" value=""></th>
              
              
               <th>
                  
   
                   <select id="se" name="numero" class="span12" onchange="mostrarValor2(this.value);" required>    
                                                <?php 
     if(isset($_GET['cot'])){echo "<option value='".$reg."'>".$reg."</option>";}else{ echo "<option value=''>Analistas</option>";  }
      $consulta= "SELECT * FROM `usuarios` where cargo='Presupuesto' order by nombre";   
      $result=  mysqli_query($conexion,$consulta);        echo"<option value='ADMIN'>ADMIN</option>";  
      while($fila=  mysqli_fetch_array($result)){       
          $valor3=$fila['usuario'];  
          $valor4=$fila['nombre'].' '.$fila['apellido'];   
   
          echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
          }                                                       
          ?>       
                            </select>
                            
    <input type="hidden"  name="numero2" class="span9" id="reg"  placeholder="Registrador" > 
                           </th>
               <th>
                  
   
    <img src="../images/buscar.png" Style="cursor: pointer" id="xbuscador">
                           </th>
              </tr>

</table>
         <div id="xcotizacione">
          
          <table class="table table-bordered table-striped table-hover" id="">
                 <thead >
            <tr bgcolor="#D1EEF0">
               <th class="hidden-phone">Ver</th>
               <th width="5%">Pedido No.</th> 
              <th width="5%">Cotizacion No.</th> 
              <th width="5%">Documento</th>
              <th width="20%">Cliente</th>
              <th width="10%">Nombre de la Obra</th>
              <th width="10%">Fecha Registro</th>
              <th width="10%">Ultima Modificacion</th>
               <th width="10%">Ultima Impresion</th>
                <th width="10%">Guardado</th>
                <th width="5%">Tiempo de Cotizacion</th>
               <th width="10%">Responsables</th>
              <th class="hidden-phone">Estado</th>
              <th class="hidden-phone">Aprobado por</th>
    
              </tr>
             </thead>
   <?php     
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
              $sql='select * from cont_terceros where id_ter="'.$row['id_tercero'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));

$nombre= $fil["nom_ter"];
$documento = $fil["cod_ter"];
          if($row["estado"]=='Ordenado'){
              $est = '<font color="red">';
              $v = '';
          }else{
              $est = '<font color="blue">';
              $v = '<img  width=20 heigth=20 src="../imagenes/version.png">';
          }
          if($row["copia"]==0){
              $c = '';
          }else{
              $c = $row["copia"];
          }
          $tiempo1 = interval_date($row['fecha_modificacion'],$fecha_hoy);
          if($row["impresion"]=='0000-00-00 00:00:00'){
              $tiempo2 = '<font color="red">'.$row['impresion'].'</font><br>Sin Imprimir';
          }else{
              
              $tiempos = interval_date($row['impresion'],$fecha_hoy);
             $tiempo2 = '<font color="green">'.$row['impresion'].'</font><br>'.$tiempos;
              
          }
          if($row["fecha_guardado"]=='0000-00-00 00:00:00'){
              $tiempo3 = '<font color="red">'.$row['fecha_guardado'].'</font><br>Sin Guardar';
              $led = '<img src="../imagenes/ledrojo.gif"> ';
          }else{
              $tiempos3 = interval_date($row['fecha_guardado'],$fecha_hoy);
                $tiempo3 = '<font color="green">'.$row['fecha_guardado'].'</font><br>'.$tiempos3;
              $led = '<img src="../imagenes/ok.png">';
          }
          if($row["fecha_guardado"]=='0000-00-00 00:00:00'){
              $tiempo33 = 'Sin Guardar';
           
          }else{
              $tiempo33 = interval_date2($row['fecha_reg_c'],$row['fecha_guardado']);
              
      
          }
          if($row['id_cot']=='Personal'){
              $link = '<a href="../vistas/?id=ver_contacto&cod='.$row['id_cliente'].'">';
          }else{
              $link = '<a href="../vistas/?id=ver_empresa&cod='.$row['id_cliente'].'">';
          }
          if($ver_cot=='Habilitado'){$ver='<img src="../imagenes/view.png">';}else{$ver='';}
          if($row["estado"]=='En proceso'){
              $copy = '<a title="Copiar Cotizacion" href="../modelo/copiar_cotizacion.php?cod='.$row['id_cot'].'"><img width=20 heigth=20 src="../imagenes/copy.png"></a>';
          }else{
              if($_SESSION["admin"]=='Si'){
                       $copy = '<a title="Copiar Cotizacion" href="../modelo/copiar_cotizacion.php?cod='.$row['id_cot'].'"><img width=20 heigth=20 src="../imagenes/copy.png"></a>';
         
              }else{
                  $copy = '';
              }
               
          }
          
            if($row["nom_temp"]){
                $nombre_clie = $row["nom_temp"];
            }else{
                $nombre_clie = $nombre;
            }
            if($row["cr"]==0){
                $es = '<font color="red">En produccion';
            }else{
                $es = $est.''.$row["estado"];
            }
          ?>
              
             
              <tr>
<td class="hidden-phone"><a href="../vistas/?id=new_fac&cot=<?php echo $row['id_cot'].'&cli='.$row['id_tercero'] ?>"><?php echo $ver ?></a></td>
<td width="5%"><a href="../vistas/?id=new_fac&cot=<?php echo $row['id_cot'].'&cli='.$row['id_tercero'] ?>"><?php echo $row['orden'] ?></a></td>
<td width="5%"><a href="../vistas/?id=new_fac&cot=<?php echo $row['id_cot'].'&cli='.$row['id_tercero'] ?>"><?php echo $row['numero_cotizacion'].'.'.$row["version"] ?></a></td>
<td width="5%"><?php echo $documento ?></a> </td>
<td width="20%"><?php echo strtoupper ($nombre_clie) ?></a></td>
<td width="10%"><?php echo strtoupper ($row["obra"]) ?><font></a></td>
<td width="10%"><?php echo $row["fecha_reg_c"] ?><font></a></td>
<td width="10%"><?php echo $row["fecha_modificacion"].'<br>'.$tiempo1 ?></a></td>
<td width="10%"><?php echo $tiempo2 ?></td>
<td width="10%"><?php echo $tiempo3 ?></td>
<td width="10%"><?php echo $led.' '.$tiempo33 ?></td>
<td class="hidden-phone"><?php echo 'Reg: '.strtoupper ($row["grabado"]).'<br>Asesor: '.strtoupper ($row["registrado"]) ?></td>
<td class="hidden-phone"><?php echo $es ?></font></td>
<td class="hidden-phone"><?php echo $row["nomb"] ?></td>            </tr>
<?php  } ?>
	</table>
            </div>
	

        
    <?php 
}
}
       
                       ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                   

                                    

                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>

                                    

<!--                                    Insumos-->



                      

                    </div>

  

                            </section></div>