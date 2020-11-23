<?php
 require '../../modelo/conexion.php';
 session_start();
 if(isset($_GET['cot'])){
 $sql='select * from producto where id_p="'.$_GET['ref'].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $_GET["ancho"];$aa= $_GET["aa"];
         $kaltt = $_GET["ancho"];$kancc= $_GET["aa"];
        $alto= $_GET["alto"];
        $altura= $_GET["cuerpo"];$anchura= $_GET["lado"];
        $altura_ventana = $_GET["alto"]-$_GET["cuerpo"];
        $anchura_ventana = $_GET["ancho"]-$_GET["lado"];
        if($_GET["l"]=='Derecho'){
            $ruta= $fil["ruta"];
        }else{
            $ruta= $fil["ruta2"];
        }
         if(isset($_GET['compuesto'])){
             $sql45='select * from cotizaciones_sub a, cotizacion b where a.id_cot_sub=b.id_cot and a.id_cotizacion_sub="'.$_GET['idcot'].'"';
             $rf5 =mysqli_fetch_array(mysqli_query($conexion,$sql45));
             $color_t= $rf5['color_ta_sub'];
             $rf5['pelicula'];
             $rf5['id_dolar'];
             $rollo = $rf5["rollo"];
             $laminas = $rf5["laminas"];
             $ciudad = $rf5["ciudad"];
         }else{
             $sql45='select * from cotizaciones a, cotizacion b where a.id_cot=b.id_cot and a.id_cotizacion="'.$_GET['idcot'].'"';
             $rf5 =mysqli_fetch_array(mysqli_query($conexion,$sql45));
             $color_t= $rf5['color_ta'];
             $rf5['pelicula'];
             $rf5['id_dolar'];
             $rollo = $rf5["rollo"];
             $laminas = $rf5["cantlam"];
             $ciudad = $rf5["ciudad"];
         }
         
          
          $alum_porr = "SELECT * FROM tipo_aluminio where color_a='".$color_t."'";
          $fia4 =mysqli_fetch_array(mysqli_query($conexion,$alum_porr));
          $vc= $fia4["costo_a"];
                
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$_GET["id_v"].'"';
         $fil2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET["ancho"]/1000) + ($_GET["alto"]/1000)) * $costo_v)*$_GET["cant"];
 }
$ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET["ref"]."  ");
$cm = mysqli_fetch_array($ac);
$mt = $cm['count(*)'];
 ?>
<?php if(isset($_GET['ref'])){  ?>   

                             <div class="row-fluid">
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">

                            <section id="collapse2" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
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

$alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
                $porca= $fia["p"]/100;
                
                $alum_porBOG = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Perfileria'";
                $fiaB =mysqli_fetch_array(mysqli_query($conexion,$alum_porBOG));
                $porcaB= $fiaB["p"]/100;
  echo 'Desperdicio : '.(100 - $fia["p"]) .'%';              
                
 $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET["ref"]);
   
     
if($request){
//    echo'<hr>'; 
	//Por cada resultado pintamos una linea
          $table = '<table class="table table-bordered table-striped table-hover" id="">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Cod. Comercial'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Costo Perfil Ml'.'</th>';

              $table = $table.'<th width="4%">'.'Lado'.'</th>'; 
              if($tipo=='Fachada'){$table = $table.'<th  class="hidden-phone">'.'Distancia'.'</th>';}
               $table = $table.'<th width="5%">'.'Und.'.'</th>';
               $table = $table.'<th width="10%">'.'Medida.'.'</th>';
               $table = $table.'<th width="10%">'.'Peso T(Kg).'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista. Items'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista. Items Total'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Items+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Items Total+P'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;$ptt =0;$tafom =0;
        $vr1 = 0;$vr2 = 0;$vr3 = 0;$vr4 = 0;
        $vr5 = 0;$vr6 = 0;$vr7 = 0;$vr8 = 0;
        $contador_alu = 0;
	while($row=mysqli_fetch_array($request))
	{    
            
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$rf5['id_dolar']."  ";
                $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
                $precio_actual= $fia["precio_actual"];
                $precio_actual_fom = $fia["precio_act_fom"];
                $perimetro = $row["area"]/1000;
                
                
            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])+ $row['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])- $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])- $row['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($row['signo']=='*'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])* $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])* $row['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])/ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])/ $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])/ $row['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al55 = ($_GET['alto']);
            }else{
                $al55 = ($_GET['ancho']);
            }
            
           
            if($tipo=='Fachada'){
            if($row["lado"]=='Vertical'){
                if($_GET["d1"]== '1'){ 
                $d =$_GET['ancho']/($_GET['v']+1);
                $al5 = ($_GET['v']);
                }else{
                    $d=$_GET['v']+1; 
                $al5 = $_GET['ancho']/($_GET['v']+1);
               
                } $z = $d;
            }else{
                if($_GET["d1"]== '1'){
                    $d =$_GET['alto']/($_GET['h']+1);
                    $al5 = ($_GET['h']); 
  
                }else{
                 $d=$_GET['h']+1; 
                $al5 = $_GET['alto']/($_GET['h']+1);
                }
                $z = $d;
            }
            }else{
                 if($row['lado']=="Vertical"){
                $al5 = ($_GET['alto']);
            }else{
                $al5 = ($_GET['ancho']);
            }
                $z = 0;}
//                   echo '<script>alert("B cant1: '.$d.'")</script>'; 
           
                    
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($tipo=='Fachada'){//analizar con tiempo esta parte. se cambio a fachadax
               $r = number_format($al5,0);
               $t ='<td class="hidden-phone">'.$r.'</td>';
               if($row["division"]==1){
                   $cantidad= 1;
               }else{
                   $cantidad= ceil($z-1);
                   //echo '<script>alert('.$z.');</script>';
               }
               
               $d = ($cantidad*$row["cantidad"])*$_GET['cant'];
               $cantidad = $cantidad*$row["cantidad"];
               $m = $row["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantidad= ceil($z+$row["cantidad"]);
               $d = ($cantidad)*$_GET['cant'];
           }
           $n=1000;
            $mp = $precio_actual/$porca;
            $mpfom = $precio_actual_fom/$porcaB;
            
           $numero = (($d)*$al)/$row["medida"]; 
           $ta = $ta + ($al*$mp*(($d))/$n);
           $tafom = $tafom + ($al*$mpfom*(($d))/$n);
           
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
           
           $pst = (($row['peso'] * $al) / 1000)*$d;
           $ptt = $ptt + $pst;
           $c1 = (($al*$mp*($d)/$n)/$_GET['cant']*$porca);
           $c1t = ($c1 + ($c1 + $vc))* ($pst/$_GET['cant']);
           $c2 = ($c1t*$_GET['cant']);
           $c3 = (($al*$mp*($d)/$n)/$_GET['cant']);
           $c3t = $c3 + ($c3 + $vc);
           $c4 = (($al*$mp*(($d))/$n));
           $c4t = $c4 + ($c4 + $vc);
           $c5 = (($al*$mpfom*($d)/$n)/$_GET['cant']*$porcaB);
           $c5t = $c5 + ($c5 + $vc);
           $c6 = ($c5*$_GET['cant']);
           $c6t = $c6 + ($c6 + $vc);
           $c7 = (($al*$mpfom*($d)/$n)/$_GET['cant']);
           $c7t = $c7 + ($c7 + $vc);
           $c8 = (($al*$mpfom*(($d))/$n));
           $c8t = $c8 + ($c8 + $vc);
           

           $vr5 += $c5t;$vr6 += $c6t;$vr7 += $c7t;$vr8 += $c8t;
           $contador_alu ++;
           //formula del acabado
           if($perimetro=='0'){
               $valor_acabado = $vc;
           }else{
               $valor_acabado = $vc * $perimetro* ($al/1000) * $cantidad ;
           }
           
           //formulas nuevas ------------16/09/2017
           $costo_und = ($precio_actual * $cantidad * ($al/1000)) + $valor_acabado;
           $costo_tot = $costo_und * $_GET['cant'];
           //fin costo
           $costo_und_desp = $costo_und / $porca;
           $costo_tot_desp = $costo_und_desp * $_GET['cant'];
           //fin costo mas desperdicio
           $vr1 += $costo_und;
           $vr2 += $costo_tot;
           //suma de costo 
           $vr3 += $costo_und_desp;
           $vr4 += $costo_tot_desp;
         $l = substr($row['lado'], 0,1)  ;
$table = $table.'<tr><td width="10%">'.$row['referencia'].'-'.$valor_acabado.'</td>
<td width="10%">'.$row['codigo'].'</a></td>
<td width="10%">'.$row['descripcion'].'<br>Perimetro: '.$perimetro.'mt | Peso :'.$row['peso'].' Kg</td>
<td width="10%">$ '.number_format($precio_actual).'</td>'
. '<td width="4%">'.$l.'</td>
'.$t.'
<td width="5%">'.$m.' '.$cantidad.'</a></td>
<td width="10%">'.number_format($al).' mm<font></a></td>
<td width="10%">'.number_format($pst,3,',','.').' Kg</td><td class="hidden-phone">'.$d.'</font></td>
<td class="hidden-phone" style="text-align:right">$'.number_format($costo_und).'</font></td>
<td class="hidden-phone" style="text-align:right">$'.number_format($costo_tot).'</font></td>
<td class="hidden-phone" style="text-align:right">$<font color="red">'.number_format($costo_und_desp).'</font></td>
<td class="hidden-phone" style="text-align:right"><font color="red">$'.number_format($costo_tot_desp).'</font></td>'
. '</tr>';   
	} 
 $table = $table.'<tr><td>-<td style="text-align:center"><b>TOTALES</b><td>-<td>-<td>-<td>-<td>-<td>-<td>'
         . '<td style="text-align:right">'.number_format($tap = $vr1).''
         . '<td style="text-align:right">'.number_format($ta_p = $vr2).''
         . '<td style="text-align:right">'.number_format( $tau = $vr3).''
         . '<td style="text-align:right">'.number_format($vr4).'';       
	$table = $table.'</table>';
        
	echo $table;
    
} 
mysqli_query($conexion,"DELETE FROM `costo_totales` WHERE `id_cotizaciones` = '".$_GET['idcot']."'");
echo '<b>Costo Total de aluminio '.number_format($vr2).' </b>';
if($vr2!=0){
   $aluminio = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Aluminio' and id_cotizacion_mas=0 ");
   $at = mysqli_fetch_row($aluminio);
   if($at[0]==0){
      $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
               . " values ('".$_GET['cot']."','".$_GET['idcot']."','Aluminio','Ml','$vr2','$porca','$contador_alu','$ptt') ") ;
   }
   
}
 ?>
                                </div>
                            </section>
                        </div>
                        <table  class="table table-bordered table-striped table-hover">
<tr>
<td><?php echo 'Costo Lista Unidad es: $'.number_format($tap = $vr1).'</font>';  ?></td>
<td><?php echo 'Costo Lista Unidad + P: $<font color="red">'.number_format( $tau = $vr3).'</font>';  ?></td>

<td><?php echo 'El Peso Und de los perfiles son:'.number_format($ptt/$_GET['cant'],2,',','.').'Kgs';  ?></td>  
  
<tr>
<td><?php echo 'El Costo Lista Total es: $'.number_format($ta_p = $vr2).'</font>';  ?></td>
<td><?php echo 'Costo Lista Total + P: $<font color="red">'.number_format($vr4).'</font>';  ?></td>

<td><?php echo 'El Peso total de los perfiles son:'.number_format($ptt,2,',','.').'Kgs';  ?></td>                  
                      </table>
            <?php  
             $perf_sin_p = $tap;
             $perf_con_p = $tau;
             $perf_fom_sin_p = 0; //costo fom
             $perf_fom_con_p = 0;
            
            ?>
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">

                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
    <?php
    $vidrio_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
    ?>
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Reparto de vidrios | Desperdicio de <?php  echo (100-$fip["p"]) ?> %</h4>
                                <!-- START Toolbar -->
                             
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse3" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 

                
                $vidrio_porB = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Vidrios'";
                $fipB =mysqli_fetch_array(mysqli_query($conexion,$vidrio_porB));
                $porcvB= $fipB["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET["ref"]);
    
     
if($request_v){


	//Por cada resultado pintamos una linea
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
        $metro_cuadrado = 0;
        $nombre_vidrio = '';
	while($row=mysqli_fetch_array($request_v))
	{      
            $ci += 1;
             if($row["ancho_v"]==0){
                
                $alb = $aa;
                if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $ancho;
                 }
            }else{
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
               if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                 if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }}

            if($row["alto_v"]==0){
                $al2= $alto;
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_al['signo']=='-'){
                 if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al['signo']=='*'){
                   if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al['signo']=='/'){
                 if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }}
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])+ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])+ $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an2['signo']=='-'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])- $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])- $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an2['signo']=='*'){
                  if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])* $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])* $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])* $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an2['signo']=='/'){
               if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                      if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_v_c+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])/ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])/ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])/ $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            }else{
               
                
                $al22 = 0;
                $al22b = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])+ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])+ $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_al2['signo']=='-'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])- $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])- $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al2['signo']=='*'){
                  if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])* $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])*$fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al2['signo']=='/'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])/$fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_v_c+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])/ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])/ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])/ $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            }else{
               $al2xb = 0;
                $al2x = 0;
            }
              $tv = ($al + $row['var1']) / $row['divisor'];
             $tv2 = ($al2 + $row['var2']) / $row['divisor_alto'];
             
            
             
             $tvb = ($alb + $row['var1']) / $row['divisor'];
//             $tv2b = ($al2b + $row['var2']) / $row['divisor_alto'];
             
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
                $an2b = $tvb - $n;
            }else{
                $n = 0;
                $an2 = $tv;
                $an2b = $tvb;
            }
            if($row['cp']==1){
                $cf = $altura;
              
            }else{
                if($row['cp']==-1){
                $cf = - $altura;
              
            }else{
                $cf = 0;
              
            }
              
            }
            if($row['desc']==0){
                $dess = 0;
              
            }else{
                $dess = $alto;
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx + $cf - $dess;
            }else{
                $nx = 0;
                $all = $tv2 + $cf - $dess;
            }

            $m2 = ($an2/1000)*($all/1000);

              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $_GET['cant'];
		echo '<span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho: '.number_format($an2).' x Alto: '.number_format($all).',   M<sup>2</sup>: '.number_format($metross,2,',','.').' , Total M<sup>2</sup>: '.number_format($metro_t,2,',','.').'</span>';
                if($aa!=0 && $cu==0){echo '<br><span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho Abajo: '.number_format($an2b).' x Alto: '.number_format($all).'</span>';}
         $porc = $porcv;
         
         $con2= "SELECT * FROM `producto` where id_p=".$_GET['tv']." ";
$res2=  mysqli_query($conexion,$con2);
while($f8=  mysqli_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];

}
if($_GET['tv2']==0){
$nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$_GET['tv2']." ";
$res22=  mysqli_query($conexion,$con22);
while($f8=  mysqli_fetch_array($res22)){
$idco2=$f8['id_p'];
$nombr2=$f8['producto'];

}}
if($_GET['tv3']==0){
$nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$_GET['tv3']." ";
$res23=  mysqli_query($conexion,$con23);
while($f8=  mysqli_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];

}}
if($_GET['tv4']==0){
$nombr4='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$_GET['tv4']." ";
$res24=  mysqli_query($conexion,$con24);
while($f8=  mysqli_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];

}}
     $metro_cuadrado += $metro_t;
         
                  if(1==$row['pertenece']){
                   include '../../modelo/suma_vidrios_ven.php';
                     
                  }
                  if(2==$row['pertenece']){
                   include '../../modelo/suma_vidrios_ven_1.php';
                   
                  }
                  if(3==$row['pertenece']){
                   include '../../modelo/suma_vidrios_ven_2.php';
                   
                  }
                  if(4==$row['pertenece']){
                   include '../../modelo/suma_vidrios_ven_3.php';
                   
                  }
                  
//                   echo $m2;
                   $peso_vid = $peso_vid + $pesototal;
                   $total_vid = $total_vid + $totalvxx;
                   $total_vidsp = $total_vidsp + $totalvxxsp;
                   $cu = $cu + 1;
          
	} 
       $rt = $total_vid * $porcv; 
        if($total_vidsp!=0){
                $vidrios = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Vidrio' and id_cotizacion_mas=0 ");
                       $av = mysqli_fetch_row($vidrios);
                       if($av[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('$nombre_vidrio','".$_GET['cot']."','".$_GET['idcot']."','Vidrio','M2', '$metro_cuadrado' ,'".($rt)."','$porc','".$_GET['cant']."','$peso_vid') ") ;
                       }
                        
        }
}
 ?></div>
                            </section>
</div>
<table  class="table table-bordered table-striped table-hover">
<tr>  
<?php echo '<td>Costo Und: $'.number_format($total_vidsp / $_GET['cant']);  ?>
<?php echo '<td>Costo Und + Desperdicio: $ <font color="red">'.number_format($total_vid / $_GET['cant']).'</font>';  ?>
<?php echo '<td>El peso und del vidrio es: '.number_format($peso_vid/ $_GET['cant'],2,',','.').' Kgs';  ?>
<tr>
    <?php echo '<td>Costo Total: $'.number_format($total_vidsp);  ?>
<?php echo '<td>Costo Total + Desperdicio: $<font color="red">'.number_format($total_vid);  ?>

<?php echo '<td>El peso total del vidrio es: '.number_format($peso_vid,2,',','.').' Kgs';  ?>
</table>
<?php 
$vidrio_con_p = $total_vid / $_GET['cant'];
$vidrio_sin_p = $total_vidsp / $_GET['cant'];
?>
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="row-fluid">
                     
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
                               <!--Modulo de regillas -->
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalles de la ventana con rejillas</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse3" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab12">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 

$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
                          
     
if($request_rej){
//    echo'<hr>';
	
        
	//Por cada resultado pintamos una linea
        $xx=0; $xxfom=0; 
        $peso_rej=0;
	while($row=mysqli_fetch_array($request_rej))
	{     
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
             $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$rf5['id_dolar']."  ";
                $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
                $precio_actual = $fia["precio_actual"];
                 $precio_actual_fom = $fia["precio_act_fom"];
                
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
          
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
               if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
        
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                 if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
           
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
        
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }

       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
	{
    echo $col["ancho_v"];
            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($conexion,$sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            if($fil_anrej['signo']=='+'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_anrej['signo']=='-'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_anrej['signo']=='*'){
                 if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])*$fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_anrej['signo']=='/'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_v_c+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            if($fil_anrej['lado']=="Vertical"){
                $al2 = ($alto+$fil_anrej["descuento"]);
            }else{
                $al2 = ($ancho+$fil_anrej["descuento"]);
            }
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $precio_actual / $porca;
         $prejfom = $precio_actual_fom / $porcaB; 
          
         
             if($row["medida_rej"]==0){
                $medrej = ($ancho + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999999){
                $medrej = ($alto + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999998){
                $medrej = ($altura + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999997){
                $medrej = ($altura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999995){
                $medrej = ($anchura + $row["varr"]) / $row["en"]; 
            }else{
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
          
            
             $tv2 = ($al / $row['var3']) * $row['multiplo'];
             
             //parte nueva del cobro del anonisado
            $perimetro = $row["area"]/1000;
           if($perimetro=='0'){
                $valor_acabado = $vc;
           }else{
               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
           }
           //fin de cobro
            $valor_u = ($precio_actual * $tv2 * ($medrej/1000)) + $valor_acabado;
            $valor_t = $valor_u * $_GET['cant'];
            
            $valor_und_desp = $valor_u / $porca;
            $valor_tot_desp = $valor_und_desp * $_GET['cant'];
            $xx = $xx + $valor_t;
            $xxfom = $xxfom + (($medrej*$tv2*$prejfom)*$_GET['cant']/1000);
            
            $pst_rej = ($row['peso'] * ($medrej / 1000))*$tv2*$_GET['cant'];
            $peso_rej = $peso_rej + $pst_rej;
          

           
		
               
	} 

}

 ?></div>
                            </section>
                        </div>
<?php 
//echo 'rejilla : '.$row["medida_rej"].'<br>';
//echo '$tv2'.$tv2.'<br>';
//echo 'costo'.$row["costo_mt"].'<br>';
echo '<table  class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($xx * $porca/  $_GET['cant']).'</font>';
echo '<td>Costo Lista Unidad con P: $<font color="red">'.number_format($xx / $_GET['cant']).'</font>'; 
echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($xx_p = $xx).'</font>'; 
echo '<td>Costo Lista Total con P: $<font color="red">'.number_format($xx).'</font>';
echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '</table>';
$fr = $xxfom / $_GET['cant'];
$rejilla_sin_p = $xx * $porca/  $_GET['cant'];
$rejilla_con_p = $xx / $_GET['cant'];
$rejilla_fom_sin_p = $xxfom * $porcaB /  $_GET['cant']; //costo fom
$rejilla_fom_con_p = $xxfom / $_GET['cant'];
if($xx_p!=0){
   $aluminior = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Rejillas' and id_cotizacion_mas=0 ");
   $atr = mysqli_fetch_row($aluminior);
   if($atr[0]==0){
      $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
               . " values ('".$_GET['cot']."','".$_GET['idcot']."','Rejillas','Ml','$xx_p','$porca','1','$peso_rej') ") ;
   }
   
}
?>

                    </div>
                    <!--/ END Row -->
                                    </div>
                     
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
<!--Fin Modulo de regillas -->
<?php
  $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
?>
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE ACCESORIOS PARA FABRICACIÓN | Desperdicio de <?php echo (100-$fipa["p"]) ?>%</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                           
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab3">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 

                
                  $acc_porB = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fipaB =mysqli_fetch_array(mysqli_query($conexion,$acc_porB));
                $porcaccB= $fipaB["p"]/100; 

    $request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET["ref"]." order by b.para");
  
           
  
     
if($request_acE){
 
	//Por cada resultado pintamos una linea
        $total2=0;
        $tac = 0;$tacfom = 0;
        $peso_acc=0;
        $rf5['pelicula'];$cacc = 0;
        $nombre_accesorios = '';
	while($row=mysqli_fetch_array($request_acE))
	{      $cacc ++;
           
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxy));
            $id_p= $fil_an["id_p"];
        
             if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
          
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
               if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])-$fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
        
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                 if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
           
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==4){
                    $al = ($anchura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
        
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($tipo=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$alto) / $row["metro"])+$row["cantidad_acc"]);
                     }else{
                         $res = ((($row["cantidad_acc"]*$ancho) / $row["metro"])+$row["cantidad_acc"]);
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_GET['hojas'] * 2 * $row["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                if($row['calcular']=='M2'){
                      $res = (($ancho / 1000)) * (($alto/1000))* $row["cantidad_acc"];
                }else{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$alto) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_GET["cant"])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            if($rf5['pelicula']!='No Aplica' && $row['codigo']=='26044'){ 
            if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; }          
            $tac = $tac + (($taa * $v) *($row["costo_mt"]/$porcacc)*$m*$_GET["cant"] + $a);   
            $tacfom = $tacfom + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_GET["cant"] + $a);
            (($taa * $v) *($row["costo_mt"]/$porcacc)*$m*$_GET["cant"] + $a); 
            $taa = $taa * $v;
            echo $rf5['pelicula'];
            }
            if($row['codigo']!='26044'){ 
            $tac = $tac + ($taa * ($row["costo_mt"]/$porcacc) * $m * $_GET["cant"] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET["cant"] + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
if($rf5['pelicula']!='No Aplica' && $row['codigo']=='26044'){  
    if($nombre_accesorios==''){
        $nombre_accesorios = $row['descripcion'];
    }else{
        $nombre_accesorios = $nombre_accesorios.','.$row['descripcion'];
    }
 
      }     
	if($row['codigo']!='26044'){  
                if($nombre_accesorios==''){
        $nombre_accesorios = $row['descripcion'];
    }else{
        $nombre_accesorios = $nombre_accesorios.','.$row['descripcion'];
    }

      } 	
               
	}
          $request_acE2=mysqli_query($conexion,"SELECT * FROM referencias where id_referencia='".$rollo."' ");
        $total2=$total2;
        $tac = $tac;
        $tacfom = $tacfom;
  while($row = mysqli_fetch_array($request_acE2)){
      if($laminas>2){
          $lam = $laminas - 1;
      }else{
          $lam = 1;
      }
      $mt2 = (($_GET['alto']/1000)*($_GET['ancho']/1000)) * $laminas;
      $cos_und = $row["costo_mt"] * $mt2;
      $cos_tot = $cos_und * $_GET['cant'];
      $vlr_und = $cos_und / $porcacc;
      $vlr_tot = $vlr_und * $_GET['cant'];
      $tac += $vlr_tot;
      
      $cosf_und = $row["costo_fom"] * $mt2;
      $cosf_tot = $cosf_und * $_GET['cant'];
      $vlrf_und = $cosf_und / $porcaccB;
      $vlrf_tot = $vlrf_und * $_GET['cant'];
      $tacfom += $vlrf_tot;
      
      $can_tot = $mt2 * $_GET['cant'];
          if($nombre_accesorios==''){
        $nombre_accesorios = $row['descripcion'];
    }else{
        $nombre_accesorios = $nombre_accesorios.','.$row['descripcion'];
    }
  

  }
  
number_format($tac_p = $tac * $porcacc);
        


        $tac_p = $tac * $porcacc;
        if($tac_p!=0){
                  $accesorios = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Accesorios' and id_cotizacion_mas=0 ");
                       $aa = mysqli_fetch_row($accesorios);
                       if($aa[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('$nombre_accesorios','".$_GET['cot']."','".$_GET['idcot']."','Accesorios','Und', '0' ,'$tac_p','$porcacc','".$cacc."','0') ") ;
                       }
                          
        }
echo '<table   class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($tac * $porcacc / $_GET["cant"]).'</font></td>';
echo '<td>Costo Lista Unidad + P: $<font color="red">'.number_format($tac / $_GET["cant"]).'</font></td>'; 
echo '<td>El peso ud de los insumos es de:'.number_format($peso_acc / $_GET["cant"],3,',','.').' Kgs</td>'; 
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($tac_p).'</font></td>'; 
echo '<td>Costo Lista Total + P: $<font color="red">'.number_format($tac).'</font></td>'; 

echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,3,',','.').' Kgs</td>'; 
echo '</table>';
$acce_sin_p = $tac * $porcacc / $_GET["cant"];
$acce_con_p = $tac / $_GET["cant"];
$acce_fom_sin_p = $tacfom  * $porcaccB  / $_GET["cant"];//costo fom
$acce_fom_con_p = $tacfom  / $_GET["cant"];
}
 ?>
                            </section>
                        </div>
                        
<?php 
 $total_sin_p = $perf_sin_p + $vidrio_sin_p + $rejilla_sin_p + $acce_sin_p;
 $total_con_p = $perf_con_p + $vidrio_con_p + $rejilla_con_p + $acce_con_p;
 $total_fom_sin_p = $perf_fom_sin_p + $vidrio_sin_p + $rejilla_fom_sin_p + $acce_fom_sin_p;
 $total_fom_con_p = $perf_fom_con_p + $vidrio_con_p + $rejilla_fom_con_p + $acce_fom_con_p;
echo number_format($perf_con_p) .'+'. number_format($vidrio_con_p) .'+'. number_format($rejilla_con_p) .'+'. number_format($acce_con_p).'<br>';
echo number_format($total_con_p).'<br>';

?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                  
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
                           </section></div>&nbsp;
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Gastos de maquina</h4>
                                <!-- START Toolbar -->
                                
                                
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                     
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab11">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
  
     
if($request_mano){

	
        
	//Por cada resultado pintamos una linea
        $tot2=0;
        $tot2_p=0;
        $tot2fom=0;
        $tot2_pfom=0;
        $and = 0;
	while($row=mysqli_fetch_array($request_mano))
	{      
            if($row["referencia"]=='AND-001'){
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            if($row['dias']=='Si'){
                if($_GET['alto']>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 1;
                }
                $r = $row["porcentaje_ma"]*($res)*$_GET['dias'];
                $tot2_p = $tot2_p + $r ;
                if($row["referencia"]=='AND-001'){
                    $and += $tot2_p;
                }else{
                    $and += 0;
                }
                $dias = $_GET['dias'];
                $p = 'Und';
            }else{
                $r_p = ($total_sin_p *$row["porcentaje_ma"])/100;
                $r = ($total_con_p *$row["porcentaje_ma"])/100;
                $rfom = ($total_fom_sin_p *$row["porcentaje_ma"])/100;
                $r_pfom = ($total_fom_con_p *$row["porcentaje_ma"])/100;
                $tot2 = $tot2 + $r_p;
                $tot2_p = $tot2_p + $r;
                $tot2fom = $tot2fom + $rfom;
                $tot2_pfom = $tot2_pfom + $r_pfom;
                $dias = 'No aplica';
                $p = '%';
                $res = 'No aplica';
                $and += 0;
            }
            }

	} 
  
}
if($and!=0){
     $andamios = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Andamios' and id_cotizacion_mas=0 ");
                       $aa1 = mysqli_fetch_row($andamios);
                       if($aa1[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('','".$_GET['cot']."','".$_GET['idcot']."','Andamios','Und', '0' ,'$and','0','".$_GET['cant']."','0') ") ;
                       }
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr><td>El valor total de maquinaria sin P es: $<font color="red">'.number_format($tot2).'</font>'; 
echo '<td>El valor total de maquinaria con P es: $<font color="red">'.number_format($tot2_p).'</font>'; 


 
echo '</table>';
$maquina_sin_p = $tot2;
$maquina_con_p = $tot2_p;
$maquina_fom_sin_p = $tot2fom;//costo fom
$maquina_fom_con_p = $tot2_pfom;

?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab12">
                                        <div class="row-fluid">
                             
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div> 
                                          <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Mano de Obra por Producto</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                   
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab7">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_maq=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_GET["ref"]);
    
     
if($request_maq){

        $tot=0;$tot_fom=0;
        $fab = 0; $ins = 0;
        $polip = 0;
	while($row=mysqli_fetch_array($request_maq))
	{       
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
            if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
            if($_GET["ins"]=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($_GET["cant"]*$row["valor_mo"]);
                    
                }  
                if($row['referencia']!='26002'){ 
                $tot_fom = $tot_fom + $tarf;
                }
                if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){
                    if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                  $tot_fom = $tot_fom + ($tarf * $v); 
                  $tarf = $tarf * $v;
                }
                }
                if($row['referencia']!='26002'){ 
                $tot = $tot + $tar;
                }
                
            }else{
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                    $tarf =  $tar;
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['instalacion']=='No'){
             
                if($row['referencia']!='26002'){ 
                $tot = $tot + $tar;
                $tot_fom = $tot_fom + $tarf;
                }
      
                }else{
                     if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){ 
                             if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                    
                     $tar = $tar * $v;
                      
                }else{
                    $tar = 0;
                }
                }
            }
            
              if($row['referencia']!='26002'){
                  if($row['instalacion']=='Si'){
                $ins += $tar;
            }else{
                $ins += 0;
            }
            if($row['instalacion']=='No'){
                $fab += $tar;
            }else{
                $fab += 0;
            }
    
              }else{
                 if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){ 
                             if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                     
                      $polip += $tar;
                }else{
                    $polip += 0;
                }
                  $fab += 0;
                  $ins += 0;
                  
              }

		
               
	} 
if($fab!=0 || $ins!=0){
                       $fabricacion = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Fabricacion' and id_cotizacion_mas=0 ");
                       $aa1 = mysqli_fetch_row($fabricacion);
                       if($aa1[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('','".$_GET['cot']."','".$_GET['idcot']."','Fabricacion','Und', '0' ,'$fab','0','".$_GET['cant']."','0') ") ;
                       }
                       $instalacion = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Instalacion' and id_cotizacion_mas=0 ");
                       $aa2 = mysqli_fetch_row($instalacion);
                       if($aa2[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('','".$_GET['cot']."','".$_GET['idcot']."','Instalacion','Und', '0' ,'$ins','0','".$_GET['cant']."','0') ") ;
                       }
                       $polim = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['idcot']."' and tipo_costo='Polimask' and id_cotizacion_mas=0 ");
                       $aa3 = mysqli_fetch_row($polim);
                       if($aa3[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('','".$_GET['cot']."','".$_GET['idcot']."','Polimask','Und', '0' ,'$polip','0','".$_GET['cant']."','0') ") ;
                       }
}
                           
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr><td>Total x Unidad en mano de obra : $'.number_format($tot / $_GET['cant']);
echo '<td>Total x Und en mano de obra para Bogota : $'.number_format($tot_fom/ $_GET['cant']);
echo '<tr><td>Total en mano de obra : $'.number_format($tot);
echo '<td>Total en mano de obra para Bogota : $'.number_format($tot_fom);
echo '</table>';

$mano = $tot / $_GET['cant'];
$mano_fom = $tot_fom / $_GET['cant'];

 $sub_total_sin_p = $total_sin_p + $maquina_sin_p + $mano;
 $sub_total_con_p = $total_con_p + $maquina_con_p + $mano;
 $sub_total_fom_sin_p_ori = $total_fom_sin_p + $maquina_fom_sin_p + $mano;//costo fom
 $sub_total_fom_con_p_ori =  $total_fom_con_p + $maquina_fom_con_p + $mano_fom;

echo $total_con_p .'+'. $maquina_con_p .'+'. $mano.'<br>';
echo $sub_total_con_p.'<br>';

?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
              
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section>
</div>
                                 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Gastos Administrativo y Utilidad</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
              
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab9">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
 echo 'SubTotal: $'.number_format($sub_total_sin_p).' | Ciudad:'.$ciudad;  
$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_GET["ref"]);
    
     
if($request_ad){

	
        
	//Por cada resultado pintamos una linea
        $tota=0;$tota_p=0;
        $totafom=0;$tota_pfom=0;
	while($row=mysqli_fetch_array($request_ad))
	{       $por = 100;
            if($row['referencia_ad']!='ADM-007'){
                      $totafom = $totafom + (($sub_total_fom_sin_p_ori * $_GET['cant']) *$row["porcentaje_ad"]/$por);
                      $tota_pfom = $tota_pfom + (($sub_total_fom_con_p_ori * $_GET['cant']) *$row["porcentaje_ad"]/$por);
            }
            if($ciudad=='ATLANTICO' || $ciudad=='MAGDALENA' || $ciudad=='BOLIVAR'){
                if($row['referencia_ad']!='ADM-014'){
                    $total_ad = (($sub_total_sin_p * $_GET['cant']) *$row["porcentaje_ad"]/$por);
                    $tota = $tota + $total_ad;
                    $tota_p = $tota_p + (($sub_total_con_p * $_GET['cant']) *$row["porcentaje_ad"]/$por);
                }else{
                    $total_ad = 0;
                    $tota = $tota + $total_ad;
                    $tota_p = $tota_p + 0;
                }
            }ELSE{
                if($row['referencia_ad']!='ADM-016'){
                    $total_ad = (($sub_total_sin_p * $_GET['cant']) *$row["porcentaje_ad"]/$por);
                    $tota = $tota + $total_ad;
                    $tota_p = $tota_p + (($sub_total_con_p * $_GET['cant']) *$row["porcentaje_ad"]/$por);
                } else {
                    $total_ad = 0;
                    $tota = $tota + $total_ad;
                     $tota_p = $tota_p + 0;
                }
            }
            
      

               
	} 

}
 ?>
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
<table class="table table-bordered table-striped table-hover" id="">
<tr>
<td><?php echo 'Total x UND sin P son : $<font color="red">'.number_format($tota/$_GET['cant']).'</font>'; ?>
<td><?php echo 'Total sin P son : $<font color="red">'.number_format($tota).'</font>'; ?>

<tr>
    <td><?php echo 'Total x UND con P son : $<font color="red">'.number_format($tota_p/$_GET['cant']).'</font>'; ?>
<td><?php echo 'Total con P son : $<font color="red">'.number_format($tota_p).'</font>'; ?>


</table>
                                         <?php
                                         $admin_sin_p = $tota/$_GET['cant']; 
                                         $admin_con_p = $tota_p/$_GET['cant'];
                                         $admin_fom_sin_p_ori = $totafom/$_GET['cant'];//costo fom
                                         $admin_fom_con_p_ori = $tota_pfom/$_GET['cant'];
                                         
                                         $gran_total_fom_con_p_ori = $sub_total_fom_con_p_ori + $admin_fom_con_p_ori;

                                         ?>
                                    </div>
                                    <div class="tab-pane" id="tab10">
                                        <div class="row-fluid">
                        
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
 <?php echo number_format($admin_con_p); ?>

                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Compuestos Adicionales</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse3" class="body collapse in">

                                <div class="body-inner">

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab50">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">
                                           <?php 
   $request2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=".$_GET['idcot']." ");
    
if($request2){
        $total2s=0;
        $to_serv =0;
	while($row2=mysqli_fetch_array($request2))
	{    
            
                  $request_ac1=mysqli_query($conexion,"SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	while($row1=mysqli_fetch_array($request_ac1))
	{       
               $por = 100;
            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);  
            
	} 
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["valor_mo"] + $tota) / $pr;
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            //adicionado el 29 de enero , autorizado por luis felipe, que cobre solo lo asignado
             $frt = ($row2["valor_mo"] * $row2["cantidad_serv"]);
              $to_serv = $to_serv + $frt;
             //$to_serv = $to_serv + $dd;

	
               
	} 

         echo '<div align="right"><FONT color="red"><h5>TOTAL SERVICIOS.: $'.number_format($to_serv).'</h5></FONT></div>';
                 
if($to_serv!=0){
    $tx = $to_serv *$_GET['cant'];
 
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                   . " values ('','".$_GET['cot']."','".$_GET['idcot']."','Instalacion','Und', '0' ,'$tx','0','".$_GET['cant']."','0') ") ;
                       }
  
}     
if(isset($_GET['cot'])){ 
 $requestcomp=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c  where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['idcot']."");
   
     
if($requestcomp){

        $total2=0;
        $ta25 =0;
        $cont =0;
        $costo_lista1 = 0;
        $costo_lista2 = 0;
        $costo_lista3 = 0;
        $costo_lista4 = 0;
        $pv_comp = 0;
        echo $_GET['de']=$_GET['idcot'];
        $_GET['cant_principal']=$_GET['cant'];
        $costo_mp = 0;
        $costo_mp_und=0;
	while($row=mysqli_fetch_array($requestcomp))
	{
            $costo_mp += $row['valor_c_sub'] ;
            $costo_mp_und += $row['valor_c_sub'] / $row['cantidad_c_sub'] ;
                $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio_sub']." ";
                $fv1 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $_GET['l']=$row["imagen_sub"];
                $_GET['id_cot']=$row["id_producto_cot"];
                
                $_GET['mod']=$row["modulo"];
                $_GET['per']=$row["per_sub"];
                $_GET['boq']=$row["boq_sub"];
                $_GET['ref']=$row["id_referencia_sub"];
                $_GET['cot']=$_GET["cot"];
                $_GET['idcot']=$row["id_cotizacion_sub"];
                $_GET['tv']=$row["traz_vid"];
                $_GET['tv2']=$row["traz_vid2"];
                $_GET['tv3']=$row["traz_vid3"];
                $_GET['tv4']=$row["traz_vid4"];
                $_GET['aa']=$row["ancho_abajo"];
                $_GET['ancho']=$row["ancho_c_sub"];
                $_GET['alto']=$row["alto_c_sub"];
                $_GET['canti']=$row["cantidad_c_sub"];
                $_GET['vidrio']=$fv1["color_v"].' '.$fv1["espesor_v"];
                $_GET['id_v']=$row["id_vidrio_sub"];
                $_GET['id_v2']=$row["id_vidrio_sub2"];
                $_GET['id_v3']=$row["id_vidrio_sub3"];
                $_GET['id_v4']=$row["id_vidrio_sub4"];
                $_GET['id_v5']=$row["id_vidrio_sub5"];
                $_GET['id_v6']=$row["id_vidrio_sub6"];
                $_GET['id2_v']=$row["id2_vidrio"];
                $_GET['id2_v2']=$row["id2_vidrio2"];
                $_GET['id2_v3']=$row["id2_vidrio3"];
                $_GET['id2_v4']=$row["id2_vidrio4"];
                $_GET['id2_v5']=$row["id2_vidrio5"];
                $_GET['id3_v']=$row["id3_vidrio"];
                $_GET['id3_v2']=$row["id3_vidrio2"];
                $_GET['id3_v3']=$row["id3_vidrio3"];
                $_GET['id3_v4']=$row["id3_vidrio4"];
                $_GET['id3_v5']=$row["id3_vidrio5"];
                $_GET['id4_v']=$row["id4_vidrio"];
                $_GET['id4_v2']=$row["id4_vidrio2"];
                $_GET['id4_v3']=$row["id4_vidrio3"];
                $_GET['id4_v4']=$row["id4_vidrio4"];
                $_GET['id4_v5']=$row["id4_vidrio5"];
                $_GET['cuerpo']=$row["cuerpo_sub"];
                $_GET['hojas']=$row["hojas_sub"];
                $_GET['ins']=$row["install"];
                $_GET['por']=$row["porcentaje_mp_sub"];
                $_GET['v']=$row["verticales"];
                $_GET['h']=$row["horizontales"];
                $_GET['d1']=$row["d1"];
                $_GET['dias']=$row["duracion"];
                $rollo=$row["rollo"];
                 $laminas = $row["laminas"];
             
  
include '../../vistas/form/dt_compuesto_reporte.php';
      $costo_lista1 += $gran_total_sin_p_comp;
       $costo_lista2 += $gran_total_con_p_comp;
        $costo_lista3 += $gran_total_fom_sin_p_comp;
         $costo_lista4 += $gran_total_fom_con_p_comp;
         $pv_comp +=$precio_venta_con_p_comp;
	} 
	
        $costo_lista2_pruebas = $costo_lista2;
	$ta25 = $costo_lista1;
        
     echo '<div align="right"><FONT color="red"><h5> TOTAL EN COMPUESTOS: $'.number_format($ta25).'</h5></FONT></div>';

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

                    </div>
 </section></div>
<!--Fin Modulo de Vidrio -->


<div class="row-fluid">
      <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE ELEMETOS ADICIONALES (Materia Prima)</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>     
<?php    

$request_ack=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET['de']."  ");
     
if($request_ack){

        $t=0;$total2ak=0;$cb=0;
	while($row=mysqli_fetch_array($request_ack))
	{       $t = $t +1;
            $s3 = "SELECT (".$_GET["por"].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
                
                $s3B = "SELECT (".$_GET["por"].") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fi3B =mysqli_fetch_array(mysqli_query($conexion,$s3B));
                $multB= $fi3B["p"]/100;
                if($row["med"]==1){
                    $v = 1;
                }else{
                    $v = $row["med"]/1000;
                }
                if($row["calcular"]=='ML'){
                if($row["lado"]=='Vertical'){
                $mt = ($alto/1000)*($row["metro"]/1000);
                }else{
                $mt = ($ancho/1000)*($row["metro"]/1000);
                }
                }else{
                 $mt = $row["cantidad_m"] * $v;
                }
                $pp = $row["costo_mt"]/$mult;
                $total2ak= $total2ak + $mt*$pp;
                $cb += $row["costo_mt"] * $mt;
           
	} 
	$table = $table.'</table>';
        
	echo $table;
}
echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional: $'.number_format($cb).'</h5></FONT></div>';
echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional + P: $'.number_format($cbb = $total2ak).'</h5></FONT></div>';
echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional Bogota: $'.number_format($cb*1.1).'</h5></FONT></div>';
        
if($cb!=0){
   $aluminio = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['de']."' and tipo_costo='Adicional' and id_cotizacion_mas=0 ");
   $at = mysqli_fetch_row($aluminio);
   echo $at[0].'<br>'.$_GET['de'].'<br>';
   if($at[0]==0){
      $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
               . " values ('".$_GET['cot']."','".$_GET['de']."','Adicional','Und','".($cb*$_GET['cant_principal'])."','$mult','$t','0') ") ;
   echo $ver;
      
   }
   
}
?>
       
      </div></div>
<div class="row-fluid">
      <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE KIT DE ACCESORIOS</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>     
<?php    

$request4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$_GET['de']." and b.comp='1'  ");

if($request4){

        $t2e=0;
        $to_kk =0;
     
                
            $ksp = 0;    
            $porcacck = 0;
	while($row21k=mysqli_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacck= $fipa["p"]/100; 
             $t2e= $t2e + 1;
             
            include '../../modelo/suma_kit_1.php';
            
             $desm = ($row21k['desc_k']/100) * ($ktotk);
             $ddm = ($ktotk + $desm) / $porcacck;
             $to_kk = $to_kk + $ddm;
             $ksp += $ktotk;


           
		
               
	} 
}
 
echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios: $'.number_format($ksp*$_GET['cant_principal']).'</h5></FONT></div>';
echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios + P: $'.number_format($to_kk).'</h5></FONT></div>';
echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios + P: $'.number_format($clb=$ksp*1.1).'</h5></FONT></div>';
if($ksp!=0){
   $aluminio = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cot='".$_GET['cot']."' and id_cotizaciones='".$_GET['de']."' and tipo_costo='Kits' and id_cotizacion_mas=0 ");
   $at = mysqli_fetch_row($aluminio);
   if($at[0]==0){
      $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
               . " values ('".$_GET['cot']."','".$_GET['de']."','Kits','Und','".($ksp*$_GET['cant_principal'])."','$porcacck','".($t2e*$_GET['cant_principal'])."','0') ") ;
   }
   
}
?>
      </div></div>
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Costo Detallado</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
   
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab13">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_ot=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_ot){

        $t2=0;
	while($row=mysqli_fetch_array($request_ot))
	{       
             $t2 = $t2 + $row['valor_ot']*$_GET['cant']*$row['cantidad_ot'];
        
	} 

        
//	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
//echo 'Total de otros gastos :$'.number_format($t2); 
?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab14">
                                        <div class="row-fluid">
               
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
       <?php 
   // echo 'total '. number_format($sub_total_con_p)  .'+'. number_format($admin_con_p).'<br>';   
$cotiz = "SELECT * FROM cotizaciones where id_cotizacion='".$_GET['de']."'";
$fi =mysqli_fetch_array(mysqli_query($conexion,$cotiz));
$d1= $fi["desc"]/100;
$d2= $fi["descuento_g"]/100;

if(isset($totalv)){$mas =$totalv;$mas2 =$totalvsp;}else{$mas =0;$mas2 =0;}
$tmatsp = $cb + $ksp;
$tmat = $cbb + $clb;

      $costo_lista1 = $tmatsp + $costo_lista1;
       $costo_lista2 = $costo_mp ;
        $costo_lista3 = $tmatsp + $costo_lista3;
         $costo_lista4 = $tmat + $costo_lista4;
         
$gran_total_sin_p = ($sub_total_sin_p) + $admin_sin_p;
$gran_total_con_p = $sub_total_con_p  + $admin_con_p;
$gran_total_fom_sin_p_ori = ($sub_total_fom_sin_p_ori) + $admin_fom_sin_p_ori;
$gran_total_fom_con_p_ori = $sub_total_fom_con_p_ori  + $admin_fom_con_p_ori;

$total_comp = $pv_comp + $cbb + $to_kk;

$alum_por1 = "SELECT (" . $_GET["por_venta"] . ") AS p FROM porcentajes where area_por='".$tipo."'";
$fia1 =mysqli_fetch_array(mysqli_query($conexion,$alum_por1));
$porcentaje = $fia1["p"]/100;
echo $gran_total_con_p;
//$alum_por1V = "SELECT (" . $_GET["por_venta"] . ") AS p FROM porcentajes where area_por='".$tipo."'";
//$fiaV =mysqli_fetch_array(mysqli_query($conexion,$alum_por1V));
//$porcentajeV = $fiaV["p"]/100;

$PB = $tipo.' Bogota';
$alum_por1B = "SELECT * FROM porcentajes where area_por='".$PB."'";
$fia1B =mysqli_fetch_array(mysqli_query($conexion,$alum_por1B));
$porcentaje_fom = $fia1B["p1"]/100;
if($porcentaje_fom!=0){
   $porcentaje_fom = $porcentaje_fom;
}else{
   $porcentaje_fom = $porcentaje;
}
//echo $precio_venta_con_p .'= '.$gran_total_con_p.'+'. $costo_mp_und.' /'. $porcentaje.'+'. $total2ak .'+'. $to_kk;
$precio_venta_sin_p = $gran_total_sin_p / $porcentaje;
$precio_venta_con_p = (($gran_total_con_p + $costo_mp) / $porcentaje) + $total2ak + $to_kk;
$precio_venta_fom_sin_p = $gran_total_fom_sin_p_ori / $porcentaje;
$precio_venta_fom_con_p = ($gran_total_fom_con_p_ori + $costo_lista4) / $porcentaje_fom;
$descuento = $precio_venta_con_p * $d1;
$tound_desc = $precio_venta_con_p + $descuento;
$desc_general = $tound_desc * $d2;
$total_desc_g = $tound_desc - $desc_general;

$descuento_comp = $total_comp * $d1;
$tound_desc_comp = $total_comp + $descuento_comp;
$desc_general_comp = $tound_desc_comp * $d2;
$total_desc_g_comp = $tound_desc_comp - $desc_general_comp;

$suma_compuesto = $precio_venta_sin_p + $total_comp;
$suma_compuesto_fom = $precio_venta_sin_p + $total_comp;

$kg = $ptt + $peso_vid + $peso_rej + $peso_acc;
//
echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr>';
echo "<td><h5>Costo Compuesto Und del Producto: $<font color='red'>".number_format($costo_lista1).'<h5>';
echo "<td><h5>Costo Compuesto Und del Producto + P: $<font color='red'>".number_format($costo_lista2 + $tmat).'<h5>';
echo '<tr>';
echo "<td><h5>Costo Lista Und del Producto: $<font color='red'>".number_format($gran_total_sin_p).'<h5>';
echo "<td><h5>Costo Lista Und del Producto + P: $<font color='red'>".number_format($gran_total_con_p).'<h5>';
echo '<tr>';
echo "<td><h5> Costo x Und 1: $<font color='red'>".number_format($gran_total_sin_p + $costo_lista1).'<h5>';
echo "<td><h5> Costo x Und 2: $<font color='red'>".number_format($gran_total_con_p + $costo_lista2 +$tmatsp).'<h5>';

echo '<tr>';
echo "<td><h5>Total Costo 1: $<font color='red'>".number_format(($gran_total_sin_p + $costo_lista1)*$_GET['cant']).'<h5>';
echo "<td><h5>Total Costo 2: $<font color='red'>".number_format(($gran_total_con_p + $costo_lista2+$tmatsp)*$_GET['cant']).'<h5>';


echo '<tr>';
echo "<td><h5>Valor de Venta Unitario: $<font color='blue'>".number_format($_GET['unidad']).'<h5>';
echo "<td><h5>Valor de Venta Total : $<font color='blue'>".number_format($_GET['unidad'] * $_GET['cant']).'<h5>';
echo '<tr>';
echo "<td><h5>Incremento/Descuento x Und. ".$fi["desc"]."% $<font color='blue'>".number_format($_GET['descuento']).'<h5>';
echo "<td><h5>Incremento/Descuento Total ".$fi["desc"]."% $<font color='blue'>".number_format($_GET['descuento']*$_GET['cant']).'<h5>';

echo '<tr>';
echo "<td><h5>Neto Total Und $<font color='blue'>".number_format($_GET['unidad']+$_GET['descuento']).'<h5>';
echo "<td><h5>Neto Total $<font color='blue'>".number_format(($_GET['unidad']+$_GET['descuento'])*$_GET['cant']).'<h5>';


echo '<tr>';
echo "<td><h5>Descuento de ".$fi["descuento_g"]." % x Und $<font color='blue'>-".number_format($desc_general).'<h5>';
echo "<td><h5>Descuento Total $<font color='blue'>-".number_format($desc_general*$_GET['cant']).'<h5>';



echo '<tr>';
echo "<td><h5>Gran Total Und. $<font color='blue'>".number_format($_GET['unidad']+$_GET['descuento']).'<h5>';
echo "<td><h3>Gran Total $ <font color='black'>".number_format(($_GET['unidad']+$_GET['descuento'])*$_GET['cant']).'<h3>';
echo "<tr>";
echo "<td><h5>El Peso Und de este Producto es de:  ".number_format($kg / $_GET['cant'],2,',','.').' Kgs</font><h5><td>';
echo "<tr><td><h5>El Peso Total de este Producto es de:  ".number_format($kg,2,',','.').' Kgs</font><h5><td>';
echo '</table>';  
} ?> 
                            </section>
                        </div>
                    
                    </div>
         
 </section></div>


<script>window.close();window.opener.activar_boton(1); </script>


