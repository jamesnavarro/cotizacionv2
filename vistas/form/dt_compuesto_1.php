<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Descripcion Tecnica del producto</title>
    <style>
.CSSTableGenerator {
	margin:0px;padding:0px;
	width:100%;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	background-color:#ffffff;
		

}
.CSSTableGenerator td{
	vertical-align:middle;
	
	background-color:#ffffff;

	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:0px;
	font-size:10px;
	font-family:Arial;
	font-weight:bold;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #00007f 5%, #00007f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #00007f), color-stop(1, #00007f) );
	background:-moz-linear-gradient( center top, #00007f 5%, #00007f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#00007f", endColorstr="#00007f");	background: -o-linear-gradient(top,#00007f,00007f);

	background-color:#00007f;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:10px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #00007f 5%, #00007f 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #00007f), color-stop(1, #00007f) );
	background:-moz-linear-gradient( center top, #00007f 5%, #00007f 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#00007f", endColorstr="#00007f");	background: -o-linear-gradient(top,#00007f,00007f);

	background-color:#00007f;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
        </style>
</head>
<body onload="window.print()">
<?php
 require '../modelo/conexion.php';
 if(isset($_GET['ref'])){
 $sql='select * from producto where id_p="'.$_GET['ref'].'"';
 $fil =mysql_fetch_array(mysql_query($sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $_GET['ancho'];$aa= $_GET['aa'];
        $alto= $_GET['alto'];
        $altura= $_GET['cuerpo'];
        $altura_ventana = $_GET['alto']-$_GET['cuerpo'];
        if($_GET['l']=='Derecho'){
            $ruta= $fil["ruta"];
        }else{
            $ruta= $fil["ruta2"];
        }
        
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$_GET['id_v'].'"';
         $fil2 =mysql_fetch_array(mysql_query($sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET['ancho']/1000) + ($_GET['alto']/1000)) * $costo_v)*$_GET['cant'];
 }

 ?>
<?php if(isset($_GET['ref'])){ ?>          
   <center>   <table class="CSSTableGenerator">
                                                
                                                <tr>
                                                    <td colspan="5">DESCRIPCION TECNICA DE <?php if(isset($_GET['ref'])){echo $producto;} ?></td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="5"><img  style="width: 90px; height: 90px;" src="<?php if(isset($_GET['ref'])){
                                                    if($ruta==''){echo '../producto/no.jpg';}else{echo '../producto/'.$ruta;}} ?>">
                                                
                                               
                                              
                                                 
                                            </td>
                                                    <td width="20%">Linea del Producto</td>
                                                    <td width="20%"><?php if(isset($_GET['ref'])){echo $tipo;} ?></td>
                                                    <td width="20%">Ancho:</td>
                                                    <td width="20%"><?php if(isset($_GET['ref'])){echo $_GET['ancho'];}?><?php if($_GET['aa']!=0){ echo $_GET['aa'];} ?></td>
                                                   
                                         
                                                </tr>
                                                <tr>
                                                     <td>Codigo del Producto</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $codigo;} ?></td>
                                                   
                                                    <td>Alto:</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['alto'];} ?></td>
                                                </tr>
                                                <tr>
                                                     <td></td>
                                                     <td></td>
                                                   
                                                    <td>Cantidad:</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['cant'];} ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Color y Espesor del Vidrio</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['vidrio'].'';} ?></td>
                                                    <td>Altura Cuerpo Fijo ó rejilla</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $altura;} ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Porcentaje Materia Prima</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['por'];} ?></td>
                                                    <td>Altura de Ventana Corrediza</td>
                                                    <td><?php if(isset($_GET['ref'])){$altura_v_c =$_GET['alto']- $altura; echo $altura_v_c;} ?></td>
                                                </tr>
                                                
                                            </table></center>    
                             
<?php 

$alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysql_fetch_array(mysql_query($alum_por));
                $porca= $fia["p"]/100;
                
                $alum_porBOG = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Perfileria'";
                $fiaB =mysql_fetch_array(mysql_query($alum_porBOG));
                $porcaB= $fiaB["p"]/100;
                
                
 $request=mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
   
     
if($request){
     echo '<table class="CSSTableGenerator"><tr><td>REPARTO DE ALUMINIOS</td></tr></table>';
       $table = '<table class="CSSTableGenerator" id="">';
              
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<td width="10%">'.'Referencia'.'</td>';
              $table = $table.'<td width="10%">'.'Cod. Comercial'.'</td>';
              $table = $table.'<td width="40%">'.'Descripcion'.'</td>';
              $table = $table.'<td width="10%">'.'Lado'.'</td>'; 
              $table = $table.'<td width="10%">'.'Longitud del Perfil'.'</td>';
              if($tipo=='Fachada'){$table = $table.'<td  class="hidden-phone">'.'Distancia'.'</td>';}
              $table = $table.'<td class="hidden-phone">'.'Cant. perfiles'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'cant. und.'.'</td>';
               $table = $table.'<td width="20%">'.'Medida.'.'</td>';
               $table = $table.'<td width="10%">'.'Peso T(Kg).'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Cant. Total.'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista. Items'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista. Items Total'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista Items+P'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista Items Total+P'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Real Items.FOM'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Real Items Total.FOM'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Real Items.FOM+P'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Real Items Total.FOM+P'.'</td>';
              $table = $table.'</tr>';
              
	
        
	//Por cada resultado pintamos una linea
        $ta =0;$ptt =0;$tafom =0;
	while($row=mysql_fetch_array($request))
	{    
            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])+ $row['variable'];
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
                       if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])- $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])- $row['variable'];
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
                    
                }
                    if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])* $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])* $row['variable'];
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
            if($row['lado']=="Vertical"){
                $al55 = ($_GET['alto']);
            }else{
                $al55 = ($_GET['ancho']);
            }
            $n=1000;
           
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
                }$z = $d;
            }
            }else{
                 if($row['lado']=="Vertical"){
                $al5 = ($_GET['alto']);
            }else{
                $al5 = ($_GET['ancho']);
            }
                $z = 0;}
            $mp = $row["costo_mt"]/$porca;
            $mpfom = $row["costo_fom"]/$porcaB;
        
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($tipo=='Fachada'){
               $r = number_format($al5,0);
               $t ='<td class="hidden-phone">'.$r.'</td>';
               $cantidad= ceil($z+1);
               $d = ($cantidad*$row["cantidad"])*$_GET['cant'];
               $m = $row["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantidad= ceil($z+$row["cantidad"]);
               $d = ($cantidad)*$_GET['cant'];
           }
           $numero = (($d)*$al)/$row["medida"]; 
           $ta = $ta + ($al*$mp*(($d))/$n);
           $tafom = $tafom + ($al*$mpfom*(($d))/$n);
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
           
           $pst = (($row['peso'] * $al) / $row["medida"])*$row["cantidad"]*$_GET['cant'];
           $ptt = $ptt + $pst;
$table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>
<td width="10%">'.$row['codigo'].'</a></td>
<td width="10%">'.$row['descripcion'].'</font></td>
<td width="10%">'.$row['lado'].'</a></td>
<td width="10%">'.$row["medida"].' mm<font></a></td>'.$t.'
<td class="hidden-phone">'.  number_format($numero,1,',','.').'</font></td>
<td width="10%">'.$m.' '.$cantidad.'</a></td>
<td width="20%">'.number_format($al).' mm<font></a></td>
<td class="hidden-phone">'.number_format($pst,1,',','.').'</font></td><td class="hidden-phone">'.$d.'</font></td>
<td class="hidden-phone">$'.number_format(($al*$mp*($d)/$n)/$_GET['cant']*$porca).'</font></td>
<td class="hidden-phone">$'.number_format(($al*$mp*($d)/$n)/$_GET['cant']*$porca*$_GET['cant']).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format(($al*$mp*($d)/$n)/$_GET['cant']).'</font></td>
<td class="hidden-phone"><font color="red">$'.number_format(($al*$mp*(($d))/$n)).'</font></td>
<td class="hidden-phone"><font color="blue">$'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']*$porcaB).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']*$porcaB*$_GET['cant']).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']).'</font></td>
<td class="hidden-phone"><font color="blue">$'.number_format(($al*$mpfom*(($d))/$n)).'</font></td>'
. '</tr>';   
	} 
	$table = $table.'</table>';
        
	echo $table;
     
} 
   
 ?>
                                </div>
                            </section>
                        </div>
                        <table  class="CSSTableGenerator">
<tr><td><td><td><td><td><tr>
<td><?php echo 'Costo Lista Unidad es: $'.number_format($tap = ($ta/$_GET['cant']) * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Lista Unidad + P: $<font color="red">'.number_format( $tau = $ta/$_GET['cant']).'</font>';  ?></td>
<td><?php echo 'Costo Real Unidad FOM: $<font color="blue">'.number_format($tapfom = ($tafom/$_GET['cant']) * $porcaB).'</font>';  ?></td>
<td><?php echo 'Costo Real Unidad FOM+ P: $<font color="blue">'.number_format( $taufom = $tafom/$_GET['cant']).'</font>';  ?></td>
<td></td>
  
<tr>
<td><?php echo 'El Costo Lista Total es: $'.number_format($ta_p = $ta * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Lista Total + P: $<font color="red">'.number_format($ta).'</font>';  ?></td>
<td><?php echo 'Costo Real Total es FOM: $<font color="blue">'.number_format($ta_pfom = $tafom * $porcaB).'</font>';  ?></td>
<td><?php echo 'Costo Real. Total FOM+P: $<font color="blue">'.number_format($tafom).'</font>';  ?></td>
<td><?php echo 'El Peso total de los perfiles son:'.number_format($ptt,1,',','.').'Kgs';  ?></td>                  
                      </table>
            <?php  
             $perf_sin_p = $tap;
             $perf_con_p = $tau;
             $perf_fom_sin_p = $tapfom;
             $perf_fom_con_p = $taufom;
            
            ?>
                   
                                  
<?php 
$vidrio_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysql_fetch_array(mysql_query($vidrio_por));
                $porcv= $fip["p"]/100;
                
                $vidrio_porB = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Vidrios'";
                $fipB =mysql_fetch_array(mysql_query($vidrio_porB));
                $porcvB= $fipB["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id_v']."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_v){

        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
	while($row=mysql_fetch_array($request_v))
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
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
                 $alb = ($aa+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
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
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
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
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho + $fil_an["descuento"])/ $fil_an['variable'];
                $alb = ($aa + $fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }}
//            if($fil_an['lado']=="Vertical"){
//                $al2 = ($alto+$fil_an["descuento"]);
//            }else{
//                $al2 = ($ancho+$fil_an["descuento"]);
//                $al2b = ($aa+$fil_an["descuento"]);
//            }
            if($row["alto_v"]==0){
                $al2= $alto;
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
//             echo '$row["ancho_v"] : '.$row["ancho_v"].'<br>';
//              echo '$row["alto_v"] : '.$row["alto_v"].'<br>';
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
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
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
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
                    
                }
                    if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
                 $al2b = ($aa+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
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
            }}
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysql_fetch_array(mysql_query($sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])+ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])+ $fil_an2['variable'];
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
                       if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])- $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])- $fil_an2['variable'];
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
                    
                }
                    if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])* $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])* $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])* $fil_an2['variable'];
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
            }else{
               
                
                $al22 = 0;
                $al22b = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysql_fetch_array(mysql_query($sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])+ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])+ $fil_al2['variable'];
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
                       if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])- $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])- $fil_al2['variable'];
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
                    
                }
                    if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])* $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])* $fil_al2['variable'];
            }
                }
            }else{
                if($fil_al2['signo']=='/'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])/ $fil_al2['variable'];
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
		echo '<span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho: '.number_format($an2).' x Alto: '.number_format($all).',   M<sup>2</sup>: '.number_format($metross,1,',','.').' , Total M<sup>2</sup>: '.number_format($metro_t,1,',','.').'</span>';
                if($aa!=0 && $cu==0){echo '<br><span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho Abajo: '.number_format($an2b).' x Alto: '.number_format($all).'</span>';}
         $porc = $porcv;
         
         $con2= "SELECT * FROM `producto` where id_p=".$_GET['tv']." ";
$res2=  mysql_query($con2);
while($f8=  mysql_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];

}
if($_GET['tv2']==0){
$nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$_GET['tv2']." ";
$res22=  mysql_query($con22);
while($f8=  mysql_fetch_array($res22)){
$idco2=$f8['id_p'];
$nombr2=$f8['producto'];

}}
if($_GET['tv3']==0){
$nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$_GET['tv3']." ";
$res23=  mysql_query($con23);
while($f8=  mysql_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];

}}
if($_GET['tv4']==0){
$nombr4='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$_GET['tv4']." ";
$res24=  mysql_query($con24);
while($f8=  mysql_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];

}}
     
         
                     if(1==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_dt.php';
                  }
                  if(2==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_dt_1.php';
                  }
                  if(3==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_dt_2.php';
                  }
                  if(4==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_dt_3.php';
                  }
                  
//                   echo $m2;
                   $peso_vid = $peso_vid + $pesototal;
                   $total_vid = $total_vid + $totalvxx;
                   $total_vidsp = $total_vidsp + $totalvxxsp;
                   $cu = $cu + 1;
          
	} 
//   
//	$table = $table.'</table>';
//   
//	echo $table;
                   
        
}
 ?>
</div>
<?php echo 'El valor total de las hojas de vidrio son: $'.number_format($total_vid);  ?>
<?php echo '<br>El Unitario total de las hojas de vidrio son: $'.number_format($total_vid / $_GET['cant']);  ?>
<?php echo '<br>El valor total de las hojas de vidrio son sin P: $'.number_format($total_vidsp);  ?>
<?php echo '<br>El valor Unitario de las hojas de vidrio son sin P: $'.number_format($total_vidsp / $_GET['cant']);  ?>
<?php echo '<br>El peso total del vidrio es: '.number_format($peso_vid,1,',','.').' Kgs';  ?>
<!--/ END Datatable 2 -->
<?php 
$vidrio_con_p = $total_vid / $_GET['cant'];
$vidrio_sin_p = $total_vidsp / $_GET['cant'];
?>
                 
                                  
<?php 

$request_rej=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
                          
     
if($request_rej){
     echo '<table class="CSSTableGenerator"><tr><td>REPARTO DE REJILLAS</td></tr></table>';
       $table = '<table class="CSSTableGenerator" id="">';
             
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<td width="7%">'.'Referencia'.'</td>'; 
              $table = $table.'<td width="7%">'.'Codigo'.'</td>';             
              $table = $table.'<td width="30%">'.'Descripcion'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Medida'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Peso (Kg)'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Cant. Rejillas Und'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Cant. Rejillas Total'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Cant. Perfiles'.'</td>';
      
              $table = $table.'<td class="hidden-phone">'.'Costo Lista Und'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Costo Lista Total'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Costo Lista Und+P'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Costo Lista Total+P'.'</td>';
             $table = $table.'<td class="hidden-phone">'.'Costo Real Und FOM'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Costo Real Total FOM'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Costo Real Und FOM+P'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Costo Real Total FOM+P'.'</td>';
              $table = $table.'</tr>';
              
	
        
	//Por cada resultado pintamos una linea
        $xx=0; $xxfom=0; 
        $peso_rej=0;
	while($row=mysql_fetch_array($request_rej))
	{     
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
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
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
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

       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
	{
    echo $col["ancho_v"];
            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysql_fetch_array(mysql_query($sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            if($fil_anrej['signo']=='+'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])+ $fil_anrej['variable'];
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
                       if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])- $fil_anrej['variable'];
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
                    
                }
                    if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])* $fil_anrej['variable'];
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
            if($fil_anrej['lado']=="Vertical"){
                $al2 = ($alto+$fil_anrej["descuento"]);
            }else{
                $al2 = ($ancho+$fil_anrej["descuento"]);
            }
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $row["costo_mt"] / $porca;
         $prejfom = $row["costo_fom"] / $porcaB; 
          
         
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
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
          
            
             $tv2 = ($al / $row['var3']) * $row['multiplo'];
            
            $numero = ($medrej*$tv2)/$row["medida"];
            $xx = $xx + (($medrej*$tv2*$prej)*$_GET['cant']/1000);
            $xxfom = $xxfom + (($medrej*$tv2*$prejfom)*$_GET['cant']/1000);
            
            $pst_rej = (($row['peso'] * $medrej) / $row["medida"])*$tv2*$_GET['cant'];
            $peso_rej = $peso_rej + $pst_rej;
          
            $table = $table.'<tr><td width="7%">'.$row['codigo'].'</a></td><td width="7%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>
                   <td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2*$_GET['cant'],1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($numero,1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]/1000).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]*$_GET['cant']/1000).'</font></td>'
                      . '<td class="hidden-phone"><font color="red">'.number_format($medrej*$tv2*$prej/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($medrej*$tv2*$prej*$_GET['cant']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$row["costo_fom"]/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$row["costo_fom"]*$_GET['cant']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$prejfom/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$prejfom*$_GET['cant']/1000).'</font></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
}

 ?></div>
                            </section>
                        </div>
<?php 
//echo 'rejilla : '.$row["medida_rej"].'<br>';
//echo '$tv2'.$tv2.'<br>';
//echo 'costo'.$row["costo_mt"].'<br>';
echo '<table  class="CSSTableGenerator">';
echo '<tr><td><td><td><td><td><tr>';
echo '<td>Costo Lista Unidad: $'.number_format($xx * $porca/  $_GET['cant']).'</font>';
echo '<td>Costo Lista Unidad con P: $<font color="red">'.number_format($xx / $_GET['cant']).'</font>'; 
echo '<td>Costo Real Unidad FOM: $<font color="blue">'.number_format($xxfom * $porcaB /  $_GET['cant']).'</font>';
echo '<td>Costo Real Unidad FOM+ P: $<font color="blue">'.number_format($xxfom / $_GET['cant']).'</font>'; 
echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($xx_p = $xx * $porca).'</font>'; 
echo '<td>Costo Lista Total con P: $<font color="red">'.number_format($xx).'</font>';
echo '<td>Costo Real Total FOM: $<font color="blue">'.number_format($xx_pfom = $xxfom * $porcaB).'</font>'; 
echo '<td>Costo Real Total FOM+ P: $<font color="blue">'.number_format($xxfom).'</font>';

echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '</table>';
$fr = $xxfom / $_GET['cant'];
$rejilla_sin_p = $xx * $porca/  $_GET['cant'];
$rejilla_con_p = $xx / $_GET['cant'];
$rejilla_fom_sin_p = $xxfom * $porcaB /  $_GET['cant'];
$rejilla_fom_con_p = $xxfom / $_GET['cant'];

?>

                  
<?php 
  $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
                
                  $acc_porB = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fipaB =mysql_fetch_array(mysql_query($acc_porB));
                $porcaccB= $fipaB["p"]/100; 
                
$request_acE=mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." order by b.para ");
    
     
if($request_acE){
   echo '<table class="CSSTableGenerator"><tr><td>ACCESORIOS DE FABRICACION E INSTALACION</td></tr></table>';
       $table = '<table class="CSSTableGenerator" id="tabla">';
             
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<td width="5%">'.'Referencia'.'</td>';  
              $table = $table.'<td width="5%">'.'Codigo'.'</td>'; 
              $table = $table.'<td width="20%">'.'Descripcion'.'</td>';
              $table = $table.'<td width="5%">'.'color'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Lado'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Cantidad'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Para'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Cant. Total.'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'$ Fabr..'.'</td>';
                 $table = $table.'<td class="hidden-phone">'.'Costo Lista Und'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista Total'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista Und+P'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Lista Total+P'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Real Und FOM'.'</td>';
            $table = $table.'<td class="hidden-phone">'.'Costo Real Total FOM'.'</td>';
            $table = $table.'<td class="hidden-phone">'.'Costo Real Und FOM+P'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Costo Real Total FOM+P'.'</td>';
              $table = $table.'</tr>';
              
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tac = 0;$tacfom = 0;
        $peso_acc=0;
	while($row=mysql_fetch_array($request_acE))
	{         
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysql_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlxy));
            $id_p= $fil_an["id_p"];
        
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }       
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
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
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
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
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($tipo=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$alto) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }else{
                         $res = ((($row["cantidad_acc"]*$ancho) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_GET['hojas'] * 2 * $row["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$alto) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_GET['cant'])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_GET['cant']).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            
            $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
            
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
                 
$table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
<td width="5%">'.$row['codigo'].'</a></td>
<td width="20%">'.$row['descripcion'].'</font></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.$taa.' '.$row["calcular"].'</font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.$f.'</font></td><td class="hidden-phone">'.$ft.'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m + $a).'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m*$_GET['cant'] + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m*$_GET['cant'] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m*$_GET['cant'] + $a).'</font></td>'
. '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;

echo '<table   class="CSSTableGenerator">';
echo '<tr><td><td><td><td><td><tr>';
echo '<td>Costo Lista Unidad: $'.number_format($tac * $porcacc / $_GET['cant']).'</font></td>';
echo '<td>Costo Lista Unidad + P: $<font color="red">'.number_format($tac / $_GET['cant']).'</font></td>'; 
echo '<td>Costo Real Unidad FOM: $<font color="blue">'.number_format($tacfom * $porcaccB / $_GET['cant']).'</font></td>'; 
echo '<td>Costo Real Unidad FOM + P: $<font color="blue">'.number_format($tacfom  / $_GET['cant']).'</font></td>'; 
echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,1,',','.').' Kgs</td>'; 
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($tac_p = $tac * $porcacc).'</font></td>'; 
echo '<td>Costo Lista Total + P: $<font color="red">'.number_format($tac).'</font></td>'; 
echo '<td>Costo Real Total FOM : $<font color="blue">'.number_format($tac_pfom = $tacfom * $porcaccB).'</font></td>'; 
echo '<td>Costo Real Total FOM + P: $<font color="blue">'.number_format($tacfom).'</font></td>'; 

echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,1,',','.').' Kgs</td>'; 
echo '</table>';
$acce_sin_p = $tac * $porcacc / $_GET['cant'];
$acce_con_p = $tac / $_GET['cant'];
$acce_fom_sin_p = $tacfom  * $porcaccB  / $_GET['cant'];
$acce_fom_con_p = $tacfom  / $_GET['cant'];
}
 ?>
                            </section>
                        </div>
                        
<?php 
 $total_sin_p = $perf_sin_p + $vidrio_sin_p + $rejilla_sin_p + $acce_sin_p;
 $total_con_p = $perf_con_p + $vidrio_con_p + $rejilla_con_p + $acce_con_p;
 $total_fom_sin_p = $perf_fom_sin_p + $vidrio_sin_p + $rejilla_fom_sin_p + $acce_fom_sin_p;
 $total_fom_con_p = $perf_fom_con_p + $vidrio_con_p + $rejilla_fom_con_p + $acce_fom_con_p;

?>
                
<?php 
   
$request_mano=mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
  
     
if($request_mano){
     echo '<table class="CSSTableGenerator"><tr><td>GASTOS DE MAQUINA</td></tr></table>';
       $table = '<table class="CSSTableGenerator" id="">';
             
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<td width="10%">'.'referencia'.'</td>';             
              $table = $table.'<td width="40%">'.'Descripcion'.'</td>';
              $table = $table.'<td width="10%">'.'Cantidad'.'</td>';
              $table = $table.'<td width="10%">'.'Dias'.'</td>';
              $table = $table.'<td width="10%">'.'Porcentaje.'.'</td>';
               $table = $table.'<td width="10%">'.'Costo.'.'</td>';
                    $table = $table.'<td width="10%">'.'Costo Fom.'.'</td>';
              $table = $table.'</tr>';
              
	
        
	//Por cada resultado pintamos una linea
        $tot2=0;
        $tot2_p=0;
        $tot2fom=0;
        $tot2_pfom=0;
	while($row=mysql_fetch_array($request_mano))
	{      
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            if($row['dias']=='Si'){
                if($_GET['alto']>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 0;
                }
                $r = $row["porcentaje_ma"]*($res)*$_GET['dias'];
                $tot2 = $tot2 + $r ;
                $dias = $_GET['dias'];
                $p = 'Und';
            }else{
                $r = ($total_sin_p *$row["porcentaje_ma"])/100;
                $r_p = ($total_con_p *$row["porcentaje_ma"])/100;
                $rfom = ($total_fom_sin_p *$row["porcentaje_ma"])/100;
                $r_pfom = ($total_fom_con_p *$row["porcentaje_ma"])/100;
                $tot2 = $tot2 + $r;
                $tot2_p = $tot2_p + $r_p;
                $tot2fom = $tot2fom + $rfom;
                $tot2_pfom = $tot2_pfom + $r_pfom;
                $dias = 'No aplica';
                $p = '%';
                $res = 'No aplica';
            }
            
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_ma'].'</font></td>'
                    . '<td width="10%"> '.$res.'</td>'
                    . '<td width="10%"> '.$dias.'</td>'
                    . '<td width="10%"> '.$row["porcentaje_ma"].''.$p.'<font></a></td>
               <td width="10%">$ <font color="red">'.number_format($r).'  </font></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format($rfom).' </font></a></td></tr>';        
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
echo '<table class="CSSTableGenerator" id="">';
echo '<tr><td><td><tr><td>El valor total de maquinaria sin P es: $<font color="red">'.number_format($tot2).'</font>'; 
echo '<td>El valor total de maquinaria sin P es: $<font color="blue">'.number_format($tot2fom).'</font>';
echo '<tr><td>El valor total de maquinaria con P es: $<font color="red">'.number_format($tot2_p).'</font>'; 
echo '<td>El valor total de maquinaria con P es: $<font color="blue">'.number_format($tot2_pfom).'</font>'; 

 
echo '</table>';
$maquina_sin_p = $tot2;
$maquina_con_p = $tot2_p;
$maquina_fom_sin_p = $tot2fom;
$maquina_fom_con_p = $tot2_pfom;

?>
        
                                  
<?php 
   
$request_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_maq){
     echo '<table class="CSSTableGenerator"><tr><td>MANO DE OBRA</td></tr></table>';
       $table = '<table class="CSSTableGenerator" id="">';
             
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<td width="10%">'.'referencia'.'</td>';             
              $table = $table.'<td width="40%">'.'Descripcion'.'</td>';
              $table = $table.'<td width="10%">'.'Instalacion ?'.'</td>';
              $table = $table.'<td width="10%">'.'Cobrado por'.'</td>';
                    $table = $table.'<td width="10%">'.'Cantidad.'.'</td>';
              $table = $table.'<td width="10%">'.'Valor Und.'.'</td>';
              $table = $table.'<td width="10%">'.'Valor Total.'.'</td>';
              $table = $table.'</tr>';
              
	
        
	//Por cada resultado pintamos una linea
        $tot=0;$tot_fom=0;
	while($row=mysql_fetch_array($request_maq))
	{       
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
            if($_GET['ins']=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                }
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($_GET['cant']*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($_GET['cant']*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($_GET['cant']*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($_GET['cant']*$row["valor_mo"]);
                    
                }              
                $tot_fom = $tot_fom + $tarf;
                }
                $tot = $tot + $tar;
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET['cant']*$row["valor_mo"]);
                    $tarf =  $tar;
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mt2*($_GET['cant']*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                $tot = $tot + $tar;
                $tot_fom = $tot_fom + $tarf;
                }else{
                    $tar = 0;
                }
            }
            
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
                    . '<td width="10%">'.$_GET['cant'].'<font></a></td>'
                    . '<td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td width="10%">$ '.number_format($tar).'<font></a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
        
}
 ?>
<?php // 

echo '<table class="CSSTableGenerator" id="">';
echo '<tr><td><td><tr><td>Total x Unidad en mano de obra : $'.number_format($tot / $_GET['cant']);
echo '<td>Total x Und en mano de obra para Bogota : $'.number_format($tot_fom/ $_GET['cant']);
echo '<tr><td>Total en mano de obra : $'.number_format($tot);
echo '<td>Total en mano de obra para Bogota : $'.number_format($tot_fom);
echo '</table>';

$mano = $tot / $_GET['cant'];
$mano_fom = $tot_fom / $_GET['cant'];

 $sub_total_sin_p_comp = $total_sin_p + $maquina_sin_p + $mano;
 $sub_total_con_p_comp = $total_con_p + $maquina_con_p + $mano;
 $sub_total_fom_sin_p_comp = $total_fom_sin_p + $maquina_fom_sin_p + $mano;
 $sub_total_fom_con_p_comp =  $total_fom_con_p + $maquina_fom_con_p + $mano_fom;



?>
                     
                                  
<?php 
   
$request_ad=mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_ad){
     echo '<table class="CSSTableGenerator"><tr><td>GASTOS ADMINISTRATIVOS Y UTILIDAD</td></tr></table>';
       $table = '<table class="CSSTableGenerator" id="">';
             
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<td width="10%">'.'referencia'.'</td>';             
              $table = $table.'<td width="20%">'.'Descripcion'.'</td>';
              $table = $table.'<td width="10%">'.'Porcentaje.'.'</td>';
               $table = $table.'<td width="10%">'.'Valor Und.'.'</td>';
              $table = $table.'<td width="10%">'.'Valor Total.'.'</td>';
               $table = $table.'<td width="10%">'.'Valor Und FOM.'.'</td>';
              $table = $table.'<td width="10%">'.'Valor Total Fom.'.'</td>';
              $table = $table.'</tr>';
              
	
        
	//Por cada resultado pintamos una linea
        $tota=0;$tota_p=0;
        $totafom=0;$tota_pfom=0;
	while($row=mysql_fetch_array($request_ad))
	{       
            $por = 100;
             if($row['referencia_ad']!='ADM-007'){
                   $totafom = $totafom + (($sub_total_fom_sin_p_comp * $_GET['cant']) *$row["porcentaje_ad"]/$por);
                   $tota_pfom = $tota_pfom + (($sub_total_fom_con_p_comp * $_GET['cant']) *$row["porcentaje_ad"]/$por);
             }
            $tota = $tota + (($sub_total_sin_p_comp * $_GET['cant']) *$row["porcentaje_ad"]/$por);
            $tota_p = $tota_p + (($sub_total_con_p_comp * $_GET['cant']) *$row["porcentaje_ad"]/$por);
          
            $table = $table.'<tr><td width="10%">'.$row['referencia_ad'].'</a></td>'
                    . '<td width="20%">'.$row['descripcion_ad'].'</font></td>'
                    . '<td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td width="10%">$ <font color="red">'.number_format(($sub_total_sin_p_comp)*$row["porcentaje_ad"]/$por).' </font></a></td>'
                    . '<td width="10%">$ <font color="red">'.number_format(($sub_total_sin_p_comp * $_GET['cant'])*$row["porcentaje_ad"]/$por).'</font></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format(($sub_total_fom_sin_p_comp)*$row["porcentaje_ad"]/$por).' </font></a></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format(($sub_total_fom_sin_p_comp * $_GET['cant'])*$row["porcentaje_ad"]/$por).'</font></td></tr>';
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>

<table class="CSSTableGenerator" id="">
<tr><td><td><td><td><tr>
<td><?php echo 'Total x UND sin P son : $<font color="red">'.number_format($tota/$_GET['cant']).'</font>'; ?>
<td><?php echo 'Total sin P son : $<font color="red">'.number_format($tota).'</font>'; ?>
<td><?php echo 'Total FOM x UND sin P son : $<font color="blue">'.number_format($totafom/$_GET['cant']).'</font>'; ?>
<td><?php echo 'Total FOM sin P son : $<font color="blue">'.number_format($totafom).'</font>'; ?>
<tr>
    <td><?php echo 'Total x UND con P son : $<font color="red">'.number_format($tota_p/$_GET['cant']).'</font>'; ?>
<td><?php echo 'Total con P son : $<font color="red">'.number_format($tota_p).'</font>'; ?>
<td><?php echo 'Total FOM x UND con P son : $<font color="blue">'.number_format($tota_pfom/$_GET['cant']).'</font>'; ?>
<td><?php echo 'Total FOM con P son : $<font color="blue">'.number_format($tota_pfom).'</font>'; ?>

</table>
                                         <?php
                                         $admin_sin_p_comp = $tota/$_GET['cant']; 
                                         $admin_con_p_comp = $tota_p/$_GET['cant'];
                                         $admin_fom_sin_p = $totafom/$_GET['cant'];
                                         $admin_fom_con_p = $tota_pfom/$_GET['cant'];
                                         ?>

                                <h4 class="title">Costo Detallado del compuesto</h4>
             

       <?php 

$cotid = "SELECT * FROM cotizaciones where id_cotizacion='".$_GET['de']."'";
$fid =mysql_fetch_array(mysql_query($cotid));
 $d1= $fid["desc"]/100;
$d2= $fid["descuento_g"]/100;

if(isset($totalv)){$mas =$totalv;$mas2 =$totalvsp;}else{$mas =0;$mas2 =0;}

$gran_total_sin_p_comp = $sub_total_sin_p_comp + $admin_sin_p_comp;
$gran_total_con_p_comp = $sub_total_con_p_comp + $admin_con_p_comp;
$gran_total_fom_sin_p_comp = $sub_total_fom_sin_p_comp + $admin_fom_sin_p;
$gran_total_fom_con_p_comp = $sub_total_fom_con_p_comp + $admin_fom_con_p;



$alum_por1 = "SELECT * FROM porcentajes where area_por='".$tipo."'";
$fia1 =mysql_fetch_array(mysql_query($alum_por1));
$porcentaje_comp = $fia1["p1"]/100;

$PB = $tipo.' Bogota';
$alum_por1B = "SELECT * FROM porcentajes where area_por='".$PB."'";
$fia1B =mysql_fetch_array(mysql_query($alum_por1B));
$porcentaje_comp_fom = $fia1B["p1"]/100;

$precio_venta_sin_p_comp = $gran_total_sin_p_comp / $porcentaje_comp;
$precio_venta_con_p_comp = $gran_total_con_p_comp / $porcentaje_comp;
$precio_venta_fom_sin_p_comp = $gran_total_fom_sin_p_comp / $porcentaje_comp;
$precio_venta_fom_con_p_comp = $gran_total_fom_con_p_comp / $porcentaje_comp_fom;
$rt = ($precio_venta_con_p_comp * $d1);

$kg = $ptt + $peso_vid + $peso_rej + $peso_acc;
//3007217709
echo '<table class="CSSTableGenerator" id="">';
echo '<tr>';
echo "<td>";
echo "<td>";
echo "<td>";
echo "<td>";
echo '<tr>';
echo "<td>Costo Lista Und del Producto: $<font color='red'>".number_format($gran_total_sin_p_comp).'';
echo "<td>Costo Lista Und del Producto + P: $<font color='red'>".number_format($gran_total_con_p_comp).'';
echo "<td>Costo Real Und del Producto FOM : $<font color='blue'>".number_format($gran_total_fom_sin_p_comp).'';
echo "<td>Costo Real Und del Producto FOM + P: $<font color='blue'>".number_format($gran_total_fom_con_p_comp).'';
echo '<tr>';
echo "<td>Precio de venta: $<font color='red'>".number_format($precio_venta_con_p_comp).'';
echo "<td>Incremento/Descuento x Und. ".$fid["desc"]."% $<font color='red'>".number_format($rt).'';
echo "<td>";
echo "<td>";

echo '</table>';  
} ?> 
               </body></html>
