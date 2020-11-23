<?php 
$request=mysqli_query($conexion,'select count(*) from cotizacion');
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
 
//echo interval_date("2013/07/26","2013/07/28");
//Hace 2 días

//Hace 35 segundos
//echo interval_date("2012/07/28","2013/07/28");
//Hace 1 años
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;


if(isset($_POST['nombre']) || isset($_POST['fecha']) || isset($_POST['user'])){
    $fecha = $_POST['fecha'];
    $aa = substr($fecha, -4); 
    $dd = substr($fecha,  -7, -5); 
    $mm = substr($fecha, 0, -8); 
    if($_POST['fecha']!=''){$fecha = $aa.'-'.$mm.'-'.$dd;}
    

  $request=mysqli_query($conexion,"SELECT * FROM cotizacion a where a.id_cliente like '%".$_POST['nombre']."%' and a.fecha_reg_c like '%".$fecha."%' and a.registrado like '%".$_POST['user']."%'");
}else{
   
        $request=mysqli_query($conexion,"SELECT * FROM cotizacion order by numero_cotizacion desc ");
}
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
               $table = $table.'<th class="hidden-phone">Ver</th>';
              $table = $table.'<th width="5%">'.'Cotizacion No.'.'</th>';             
              $table = $table.'<th width="20%">'.'Cliente'.'</th>';
              $table = $table.'<th width="10%">'.'Nombre de la Obra'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha Registro'.'</th>';
              $table = $table.'<th width="10%">'.'Ultima Modificacion'.'</th>';
            
               $table = $table.'<th width="10%">'.'Ultima Impresion'.'</th>';
             
                $table = $table.'<th width="10%">'.'Guardado'.'</th>';
                $table = $table.'<th width="5%">'.'Tiempo de Cotizacion'.'</th>';
               $table = $table.'<th width="10%">'.'Responsables'.'</th>';

              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Acciones'.'</th>';
             
    
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
          if($row['tipo']=='Empresarial'){
              $sql='select * from sis_empresa where id_empresa="'.$row['id_cliente'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));

$nombre= $fil["nombre_emp"];
          }else{
              $sql='select * from sis_contacto where id_contacto="'.$row['id_cliente'].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$nombre= $fil["nombre_cont"].' '. $fil["apellido_cont"];

          }
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
            $table = $table.'<tr>'
                    . '<td class="hidden-phone"><a href="../vistas/?id=new_fac&cot='.$row['id_cot'].'&cli='.$row['id_cliente'].'">'.$ver.'</a></td>'
                    . '<td width="5%"><a href="../vistas/?id=new_fac&cot='.$row['id_cot'].'&cli='.$row['id_cliente'].'">'.$row['numero_cotizacion'].'.'.$row["version"].'</a></td>'
                    . '<td width="20%">'.$link.''.$nombre.'</a></td>'
                    . '<td width="10%">'.$row["obra"].'<font></a></td>'
                    . '<td width="10%">'.$row["fecha_reg_c"].'<font></a></td>
                        <td width="10%">'.$row["fecha_modificacion"].'<br>'.$tiempo1.'</a></td>
                            
                                <td width="10%">'.$tiempo2.'</td>
                            
                                <td width="10%">'.$tiempo3.'</td>
                                    <td width="10%">'.$led.' '.$tiempo33.'</td>
               <td class="hidden-phone">Reg: '.$row["grabado"].'<br>Asesor: '.$row["registrado"].'</td>'
                    . '<td class="hidden-phone">'.$est.''.$row["estado"].'</font></td>'
                    . '<td class="hidden-phone"><a title="Copiar Cotizacion" href="../modelo/copiar_cotizacion.php?cod='.$row['id_cot'].'"><img width=20 heigth=20 src="../imagenes/copy.png"></a>'
                    . '    <a title="Sacar Version de  Cotizacion" href="../modelo/version_cotizacion.php?cod='.$row['id_cot'].'">'.$v.'</a></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
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