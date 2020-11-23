<?php
 require '../modelo/conexion.php';
 if(isset($row["id_referencia"])){
 $sqlq='select * from producto where id_p="'.$row["id_referencia"].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sqlq));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $row["ancho_c"];$aa= $row["ancho_abajo"];
        $alto= $row["alto_c"];
        $altura= $row["cuerpo"];
        $altura_ventana = $row["alto_c"]-$row["cuerpo"];
        $ruta= $fil["ruta"];
        
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$row["id_vidrio"].'"';
         $fil2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($row["ancho_c"]/1000) + ($row["alto_c"]/1000)) * $costo_v)*$row["id_referencia"];
 }
$ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_referencia"]."  ");
$cm = mysqli_fetch_array($ac);
$mt = $cm['count(*)'];
 ?>
<?php if(isset($row["id_referencia"])){ ?>          

<?php    if($tipo!='Vidrio'){   ?>

                                  
<?php 

$alum_por = "SELECT (".$row["porcentaje_mp"].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
                $porca= $fia["p"]/100;
 $request1=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
   
     
if($request1){
//    echo'<hr>';
	//Por cada resultado pintamos una linea
        $ta =0;$ptt =0;$al=0;//$al Codigo Agregado (Jaime)
	while($rower=mysqli_fetch_array($request1))
	{    
            if($rower['signo']=='+'){
                if($rower['medida_r_a']==1){
                    $al = ($altura_ventana+$rower["descuento"])+ $rower['variable'];
                }else{
                    if($rower['medida_r_a']==2){
                    $al = ($altura+$rower["descuento"])+ $rower['variable'];
                }else{
                     if($rower['lado']!="Vertical"){
                $al = ($row["ancho_c"]+$rower["descuento"])+ $rower['variable'];
            }else{
                $al = ($row["alto_c"]+$rower["descuento"])+ $rower['variable'];
            }
                }
                   
                }
                
            }else{
               if($rower['signo']=='-'){
                if($rower['medida_r_a']==1){
                    $al = ($altura_ventana+$rower["descuento"])- $rower['variable'];
                }else{
                    if($rower['medida_r_a']==2){
                    $al = ($altura+$rower["descuento"])- $rower['variable'];
                }else{
                       if($rower['lado']!="Vertical"){
                $al = ($row["ancho_c"]+$rower["descuento"])- $rower['variable'];
            }else{
                $al = ($row["alto_c"]+$rower["descuento"])- $rower['variable'];
            }
                }
                 
                }
            }else{
                if($rower['signo']=='*'){
                  if($rower['medida_r_a']==1){
                    $al = ($altura_ventana+$rower["descuento"])* $rower['variable'];
                }else{
                     if($rower['medida_r_a']==2){
                    $al = ($altura+$rower["descuento"])* $rower['variable'];
                }else{
                    
                }
                    if($rower['lado']!="Vertical"){
                $al = ($row["ancho_c"]+$rower["descuento"])* $rower['variable'];
            }else{
                $al = ($row["alto_c"]+$rower["descuento"])* $rower['variable'];
            }
                }
            }else{
                if($rower['signo']=='/'){
                if($rower['medida_r_a']==1){
                    $al = ($altura_ventana+$rower["descuento"])/ $rower['variable'];
                }else{
                    if($rower['medida_r_a']==2){
                    $al = ($altura+$rower["descuento"])/ $rower['variable'];
                }else{
                       if($rower['lado']!="Vertical"){
                $al = ($row["ancho_c"]+$rower["descuento"])/ $rower['variable'];
            }else{
                $al = ($row["alto_c"]+$rower["descuento"])/ $rower['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($rower['lado']=="Vertical"){
                $al55 = ($row["alto_c"]);
            }else{
                $al55 = ($row["ancho_c"]);
            }
            $n=1000;
           
            if($tipo=='Fachada'){
            if($rower["lado"]=='Vertical'){
                if($row["d1"]== '1'){ 
                $d =$row["ancho_c"]/($row["verticales"]+1);
                $al5 = ($row["verticales"]);
                }else{
                    $d=$row["verticales"]+1; 
                $al5 = $row["ancho_c"]/($row["verticales"]+1);
               
                } $z = $d;
            }else{
                if($row["d1"]== '1'){
                    $d =$row["alto_c"]/($row["horizontales"]+1);
                    $al5 = ($row["horizontales"]); 
  
                }else{
                $d=$row["horizontales"]+1; 
                $al5 = $row["alto_c"]/($row["horizontales"]+1);
                }$z = $d;
            }
            }else{
                 if($rower['lado']=="Vertical"){
                $al5 = ($row["alto_c"]);
            }else{
                $al5 = ($row["ancho_c"]);
            }
                $z = 0;}
            $mp = $rower["costo_mt"]/$porca;
            
        
           if($rower["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($tipo=='Fachada'){
               $r = number_format($al5,0);
               $t ='<td class="hidden-phone">'.$r.'</td>';
               $cantidad= ceil($z+1);
               $d = ($cantidad*$rower["cantidad"])*$row["cantidad_c"];
               $m = $rower["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantidad= ceil($z+$rower["cantidad"]);
               $d = ($cantidad)*$row["cantidad_c"];
           }
           $numero = (($d)*$al55)/$rower["medida"]; 
           $ta = $ta + ($al*$mp*(($d))/$n);
           if($rower["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$rower["descuento"].')'.$rower["signo"].''.$rower["variable"];
           
           $pst = (($rower['peso'] * $al) / $rower["medida"])*$rower["cantidad"]*$row["cantidad_c"];
           $ptt = $ptt + $pst;
	} 
	
     
} 
   
 ?>
                             
<?php 
$vidrio_por = "SELECT (".$row["porcentaje_mp"].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
    
     
if($request_v){
	//Por cada resultado pintamos una linea
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$alb=0;//$alb Codigo Agregado (Jaime)
        $altura_v_c=0;//$altura_v_c Codigo Agregado (Jaime)
	while($rower=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$rower["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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
            if($fil_an['lado']=="Vertical"){
                $al2 = ($alto+$fil_an["descuento"]);
            }else{
                $al2 = ($ancho+$fil_an["descuento"]);
                $al2b = ($aa+$fil_an["descuento"]);
            }
            
            $tv = $al + $rower['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$rower["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
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
            }
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($rower['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$rower["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
  
            
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
            
           
            if($rower['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$rower["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
            
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
             $tv = $al + $rower['var1'];
             $tv2 = $al2 + $rower['var2'];
             
             $tvb = $alb + $rower['var1'];
             $tv2b = $al2b + $rower['var2'];
             
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
                $an2b = $tvb - $n;
            }else{
                $n = 0;
                $an2 = $tv;
                $an2b = $tvb;
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx;
            }else{
                $nx = 0;
                $all = $tv2;
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($alto+$fil_al["descuento"]);
            }else{
                $al3 = ($ancho+$fil_al["descuento"]);
            }
            
          
         
            $m2 = ($an2/1000)*($all/1000);
 
         $porc = $porcv;   
                   include '../modelo/suma_peso.php';
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


$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
                          
     
if($request_rej){

        $xx=0; 
        $peso_rej=0;
	while($rower=mysqli_fetch_array($request_rej))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$rower["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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
       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_v=".$rower["medida_rej"]." ");
       $tvR=0;
       while($col=mysqli_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($conexion,$sqlxr));
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
         $prej = $rower["costo_mt"] / $porca;
              $medrej = $tvR + $rower["varr"]; 
       
            $al2 = ($alto+$fil_an["descuento"]);
          
            $tv2 = $al / $rower['var3'];
            
            $numero = ($medrej*$tv2)/$rower["medida"];
            $xx = $xx + (($medrej*$tv2*$prej)*$row["cantidad_c"]/1000);
            
            $pst_rej = (($rower['peso'] * $medrej) / $rower["medida"])*$tv2*$row["cantidad_c"];
            $peso_rej = $peso_rej + $pst_rej;
          

               
	} 

}

  }if($tipo=='Vidrio'){  ?>


                                

<?php 
if(isset($_GET['up_db'])){           
?>
     
                                    <?php
}else{
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, vidrios_divisiones b, referencias c where b.id_vidrio=c.id_referencia and a.id_p=b.id_producto and a.id_p=".$row["id_referencia"]);
    
     
if($request_v){

	//Por cada resultado pintamos una linea
        $t=0;
	while($rower=mysqli_fetch_array($request_v))
	{      
            if($rower['ancho_db']==1){$v = $ancho; }else{$v = 0;}
            if($aa!=0 && $t==0){$ancho_abajo = $aa - $rower['ancho_db'] + $rower['desc_an_db'];}else{$ancho_abajo = '';}
            $ancho_arriba = $v + $rower['ancho_db'] + $rower['desc_an_db'];
            $alto_arriba = $alto + $rower['alto_db'] + $rower['desc_al_db'];
           
		$t = $t + 1;
               
	}
}
}
 ?>

                          <?php }  ?>
                                  
<?php 
  $acc_por = "SELECT (".$row["porcentaje_mp"].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
$request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." order by b.para ");
    
     
if($request_acE){

	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tac = 0;
        $peso_acc=0;
	while($rower=mysqli_fetch_array($request_acE))
	{      
            
            //--------------------------------------------------------------------
                        if($rower['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_rej=".$rower['can_rej']." ");
while($rowerz=mysqli_fetch_array($request_v2))
{
$sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]." and b.id_r_a=".$rowerz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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
     $cant_rej = number_format($al / $rowerz['var3']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($tipo=='Fachada'){
                 if($rower["yes"]=='Si'){
                     if($rower["lado"]=='Vertical'){
                         $res = ((($rower["cantidad_acc"]*$alto) / $rower["metro"])+$rower["cantidad_acc"])*$d;
                     }else{
                         $res = ((($rower["cantidad_acc"]*$ancho) / $rower["metro"])+$rower["cantidad_acc"])*$d;
                     }         
                 }else{
                      $res = $rower["cantidad_acc"];
                 }
            }else{      
             if($rower['calcular']=='ML'){
               $rs = $row["hojas"] * 2 * $rower["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                 if($rower["yes"]=='Si'){
                     if($rower["lado"]=='Vertical'){
                         $res = ($rower["cantidad_acc"]*$alto) / $rower["metro"];
                     }else{
                         $res = ($rower["cantidad_acc"]*$ancho) / $rower["metro"];
                     }             
                 }else{
                      $res = $rower["cantidad_acc"];
                 }            
            }}
            if(isset($cant_rej)){
                $cant_rej = $cant_rej;
            }else{
                $cant_rej = 0;
            }
             $taa = $cant_rej * $res;
             if($rower["med"]!=1){
                 $m = $rower["med"]/1000;
                 $f = ''.number_format(($taa*$row["id_referencia"])*$m).' ML';
                 $ft = $f * $rower["valor_f"] ;
                 $a = $f * $rower["valor_f"] ;
             }else{
                 $m = $rower["med"];
                 $f = ''.number_format($taa*$row["id_referencia"]).' '.$rower["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            
            $tac = $tac + ($taa*($rower["costo_mt"]/$porcacc)*$m*$row["id_referencia"] + $a);
            
             $pst_acc = (($rower['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
 
           
		
               
	} 

        $request_ac=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
     
if($request_ac){

	//Por cada resultado pintamos una linea
        $t=0;$total2a=0;
	while($rower=mysqli_fetch_array($request_ac))
	{       $t = $t +1;
            $s3 = "SELECT (".$row["porcentaje_mp"].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
                if($rower["calcular"]=='ML'){
                if($rower["lado"]=='Vertical'){
                $mt = ($alto/1000)*($rower["metro"]/1000);
                }else{
                $mt = ($ancho/1000)*($rower["metro"]/1000);
                }
                }else{
                 $mt = $rower["cantidad_m"];
                }
                $pp = $rower["costo_mt"]/$mult;
 $total2a= $total2a +$mt*$pp;

          
		
               
	} 
}
}
 ?>
                            </section>
                        </div>
                        
<?php 
$tac = $tac;

if(isset($total_vid)){
    $txx = $total_vid + $ta + $tac + $xx;

}else{
      $s3 = "SELECT (".$row["porcentaje_mp"].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
                
                
    
    
    $tv2 =0;
    $ta = 0;
    $total_vid =0;
    $total_vidsp =0;
    $xx=0;
    $ta_p =0;
    $xx_p=0;
    
  
   include '../modelo/suma_vidrios_print.php';

    $txx = $totalv + $tac;

   $txx_p = $totalvsp ;
}

   
$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
    
     
if($request_mano){

        $tot2=0;
        $tot2_p=0;
	while($rower=mysqli_fetch_array($request_mano))
	{      
            $mt2 = ($row["alto_c"]/1000)*($row["ancho_c"]/1000);
            if($rower['dias']=='Si'){
                if($row["alto_c"]>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 0;
                }
               $r = $rower["porcentaje_ma"]*($res)*$row["duracion"];
                $tot2 = $tot2 + $r ;
                $dias = $row["duracion"];
                $p = 'Und';
            }else{
                $r = ($txx*$rower["porcentaje_ma"])/100;
                
                $tot2 = $tot2 + $r;
             
                $dias = 'No aplica';
                $p = '%';
                $res = 'No aplica';
            }
   
	} 
  
}

  
$request_maq=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
    
     
if($request_maq){

        $tot=0;
	while($rower=mysqli_fetch_array($request_maq))
	{       
            $mt2 = ($row["alto_c"]/1000)*($row["ancho_c"]/1000);
            $mtl = ($row["alto_c"]/1000)+($row["ancho_c"]/1000);
            if($row["install"]=='Si'){
                
                if($rower['unidad_cobro']=='M2'){
                    $tar =  $mt2*($row["id_referencia"]*$rower["valor_mo"]);
                }
                if($rower['unidad_cobro']=='ML'){
                    $tar =  $mtl*($row["id_referencia"]*$rower["valor_mo"]);
                }
                if($rower['unidad_cobro']=='Und'){
                    $tar =  ($row["id_referencia"]*$rower["valor_mo"]);
                }
                if($rower['unidad_cobro']=='Kg'){
                    $tar =  ($row["id_referencia"]*$rower["valor_mo"]);
                }
                $tot = $tot + $tar;
            }else{
                if($rower['instalacion']=='No'){
             if($rower['unidad_cobro']=='M2'){
                    $tar =  $mt2*($row["id_referencia"]*$rower["valor_mo"]);
                }
                if($rower['unidad_cobro']=='ML'){
                    $tar =  $mtl*($row["id_referencia"]*$rower["valor_mo"]);
                }
                if($rower['unidad_cobro']=='Und'){
                    $tar =  ($row["id_referencia"]*$rower["valor_mo"]);
                }
                if($rower['unidad_cobro']=='Kg'){
                    $tar =  ($row["id_referencia"]*$rower["valor_mo"]);
                }
                $tot = $tot + $tar;
                }else{
                    $tar = 0;
                }
            }

           
		
               
	} 

}

if(isset($tv2)){
    $total= $ta + $tv2 + $tac+ $tot+$tot2;
    
}else{
    $total = $ta  + $tac+ $tot+$tot2;
    
}
$txx = $txx + $tot;

?>
                        <!--/ END Datatable 2 -->
                 
                                  
<?php 
   
$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
    
     
if($request_ad){

	
        
	//Por cada resultado pintamos una linea
        $tota=0;$tota_p=0;
	while($rower=mysqli_fetch_array($request_ad))
	{       
            $por = 100;
            $tota = $tota + ($txx*$rower["porcentaje_ad"]/$por);
     
	
               
	} 
	
  
}
 
$request_ot=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$row["id_referencia"]);
    
     
if($request_ot){
        $t2=0;
	while($rower=mysqli_fetch_array($request_ot))
	{       
             $t2 = $t2 + $rower['valor_ot']*$row["cantidad_c"]*$rower['cantidad_ot'];
        
		
               
	} 

  
}

       if(isset($totalv)){$mas =$totalv;$mas2 =$totalvsp;}else{$mas =0;$mas2 =0;}
$totalx = $ta + $xx + $tac + $total_vid +  $tot2 + $tot + $tota + $t2 + $mas;


$kg2 =  $peso_acc;
} ?> 
