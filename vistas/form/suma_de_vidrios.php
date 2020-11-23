<?php
   $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row33['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row33['id2_vidrio']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
          $_GET['l']= $row33["imagen"]; $_GET['mod']= $row33["modulo"];$_GET['per']= $row33["per"]; $_GET['boq']= $row33["boq"];
          $_GET['ref']= $row33["id_referencia"]; $_GET['idcot']= $row33["id_cotizacion"]; 
          $_GET['tv']= $row33["traz_vid"];$_GET['tv2']= $row33["traz_vid2"];$_GET['tv3']= $row33["traz_vid3"];
          $_GET['tv4']= $row33["traz_vid4"];
          $aa= $row33["ancho_abajo"];$ancho= $row33["ancho_c"];$alto= $row33["alto_c"];
          $_GET['cant']= $row33["cantidad_c"];$_GET['vidrio']= $fv["color_v"].'('.$fv["espesor_v"];
          $_GET['id_v']= $row33["id_vidrio"];$_GET['id_v2']= $row33["id_vidrio2"];$_GET['id_v3']= $row33["id_vidrio3"];
          $_GET['id_v4']= $row33["id_vidrio4"]; $_GET['id_v5']= $row33["id_vidrio5"];$_GET['id_v6']= $row33["id_vidrio6"];         
          $_GET['id2_v']= $row33["id2_vidrio"];$_GET['id2_v2']= $row33["id2_vidrio2"];$_GET['id2_v3']= $row33["id2_vidrio3"];
          $_GET['id2_v4']= $row33["id2_vidrio4"]; $_GET['id2_v5']= $row33["id2_vidrio5"];$_GET['id2_v6']=0;   
          $_GET['id3_v']= $row33["id3_vidrio"];$_GET['id3_v2']= $row33["id3_vidrio2"];$_GET['id3_v3']= $row33["id3_vidrio3"];
          $_GET['id3_v4']= $row33["id3_vidrio4"]; $_GET['id3_v5']= $row33["id3_vidrio5"];$_GET['id3_v6']= 0;       
          $_GET['id4_v']= $row33["id4_vidrio"];$_GET['id4_v2']= $row33["id4_vidrio2"];$_GET['id4_v3']= $row33["id4_vidrio3"];
          $_GET['id4_v4']= $row33["id4_vidrio4"]; $_GET['id4_v5']= $row33["id4_vidrio5"];$_GET['id4_v6']= 0;
          $altura= $row33["cuerpo"]; $_GET['hojas']= $row33["hojas"];$_GET['ins']= $row33["install"];$_GET['por']= $row33["porcentaje_mp"];
          $_GET['v']= $row33["verticales"]; $_GET['h']= $row33["horizontales"]; $_GET['d1']= $row33["d1"];$_GET['dias']= $row33["duracion"];
         
          
$vidrio_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id_v']."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
//echo $row33['id_p'].'<br>';          
$request_v8r=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c, cotizaciones d where d.id_referencia=a.id_p and b.id_ref_vid=c.id_referencia and a.id_p=b.id_p  and d.id_cot=".$row33['id_cot']." and d.traz_vid=".$row33['traz_vid']." and d.id_vidrio=".$row33['id_vidrio']." ");
    
    
if($request_v8r){
       $ci = 0;
        $mtg =0;
              $mtt =0; $anchi_gen = 0; $alti_gen = 0;
	while($rowt=mysqli_fetch_array($request_v8r))
	{  
          $_GET['cant']= $rowt["cantidad_c"];
          $_GET['l']= $rowt["imagen"]; $_GET['mod']= $rowt["modulo"];$_GET['per']= $rowt["per"]; $_GET['boq']= $rowt["boq"];
          $_GET['ref']= $rowt["id_referencia"]; $_GET['idcot']= $rowt["id_cotizacion"]; $_GET['tv']= $rowt["traz_vid"];$_GET['tv2']= $rowt["traz_vid2"];$_GET['tv3']= $rowt["traz_vid3"];$_GET['tv4']= $rowt["traz_vid4"];
          $_GET['aa']= $rowt["ancho_abajo"];$_GET['ancho']= $rowt["ancho_c"];$_GET['alto']= $rowt["alto_c"];
    
        $anchi= $_GET['ancho'];$aaba= $_GET['aa'];
        $alti= $_GET['alto'];
        $alturas= $_GET['cuerpo'];
        $alturas_ventana = $_GET['alto'];
        $alturas_v_c =  $_GET['alto'];
// echo $_GET['tv'].' - '.$rowt["id_vidrio"].' - '.$rowt["id_p"];

   
            $ci += 1;
             if($rowt["ancho_v"]==0){
                
                $alb = $aaba;
                if($rowt["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $anchi;
                 }
            }else{
            $sqlxh=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowt["id_p"]." and b.id_r_a=".$rowt["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxh));
            $id_p= $fil_an["id_p"];
          
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($alturas_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($alturas+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($anchi+$fil_an["descuento"])+ $fil_an['variable'];
                $alb = ($aaba+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alti+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($alturas_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($alturas+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($anchi+$fil_an["descuento"])- $fil_an['variable'];
                 $alb = ($aaba+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alti+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($alturas_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==2){
                    $al = ($alturas+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($anchi+$fil_an["descuento"])* $fil_an['variable'];
                $alb = ($aaba+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alti+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($alturas_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($alturas+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($anchi + $fil_an["descuento"])/ $fil_an['variable'];
                $alb = ($aaba + $fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alti+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }}

            if($rowt["alto_v"]==0){
                $al2= $alti;
                $al2b = $aaba;
            }else{
            
            $tv = $al + $rowt['var1'];
             
             $sqlwj=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowt["id_p"]." and b.id_r_a=".$rowt["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlwj));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($alturas_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($alturas+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($anchi+$fil_al["descuento"])+ $fil_al['variable'];
                $al2b = ($aaba+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alti+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al['signo']=='-'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($alturas_ventana+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($alturas+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($anchi+$fil_al["descuento"])- $fil_al['variable'];
                $al2b = ($aaba+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alti+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al['signo']=='*'){
                  if($fil_al['medida_r_a']==1){
                    $al2 = ($alturas_ventana+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==2){
                    $al2 = ($alturas+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    
                }
                    if($fil_al['lado']!="Vertical"){
                $al2 = ($anchi+$fil_al["descuento"])* $fil_al['variable'];
                 $al2b = ($aaba+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alti+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
            }else{
                if($fil_al['signo']=='/'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($alturas_ventana+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($alturas+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($anchi+$fil_al["descuento"])/ $fil_al['variable'];
                 $al2b = ($aaba+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($alti+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }}
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($rowt['ancho_v2']!=0){
                     $sqlx2k=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowt["id_p"]." and b.id_r_a=".$rowt["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2k));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($alturas_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($alturas+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($anchi+$fil_an2["descuento"])+ $fil_an2['variable'];
                $al22b = ($aaba+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($alti+$fil_an2["descuento"])+ $fil_an2['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an2['signo']=='-'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($alturas_v_c+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($alturas+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                       if($fil_an2['lado']!="Vertical"){
                $al22 = ($anchi+$fil_an2["descuento"])- $fil_an2['variable'];
                $al22b = ($aaba+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($alti+$fil_an2["descuento"])- $fil_an2['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an2['signo']=='*'){
                  if($fil_an2['medida_r_a']==1){
                    $al22 = ($alturas_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==2){
                    $al22 = ($alturas+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                    
                }
                    if($fil_an2['lado']!="Vertical"){
                $al22 = ($anchi+$fil_an2["descuento"])* $fil_an2['variable'];
                $al22b = ($aaba+$fil_an2["descuento"])* $fil_an2['variable'];
            }else{
                $al22 = ($alti+$fil_an2["descuento"])* $fil_an2['variable'];
            }
                }
            }else{
                if($fil_an2['signo']=='/'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($alturas_v_c+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($alturas+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                       if($fil_an2['lado']!="Vertical"){
                $al22 = ($anchi+$fil_an2["descuento"])/ $fil_an2['variable'];
                $al22b = ($aaba+$fil_an2["descuento"])/ $fil_an2['variable'];
            }else{
                $al22 = ($alti+$fil_an2["descuento"])/ $fil_an2['variable'];
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
            
           
            if($rowt['alto_v2']!=0){
             $sqlw2l=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowt["id_p"]." and b.id_r_a=".$rowt["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2l));
             
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($alturas_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($alturas+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($anchi+$fil_al2["descuento"])+ $fil_al2['variable'];
                $al2xb = ($aaba+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($alti+$fil_al2["descuento"])+ $fil_al2['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al2['signo']=='-'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($alturas_v_c+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($alturas+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                       if($fil_al2['lado']!="Vertical"){
                $al2x = ($anchi+$fil_al2["descuento"])- $fil_al2['variable'];
                $al2xb = ($aaba+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($alti+$fil_al2["descuento"])- $fil_al2['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al2['signo']=='*'){
                  if($fil_al2['medida_r_a']==1){
                    $al2x = ($alturas_v_c+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                     if($fil_al2['medida_r_a']==2){
                    $al2x = ($alturas+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    
                }
                    if($fil_al2['lado']!="Vertical"){
                $al2x = ($anchi+$fil_al2["descuento"])* $fil_al2['variable'];
                $al2xb = ($aaba+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($alti+$fil_al2["descuento"])* $fil_al2['variable'];
            }
                }
            }else{
                if($fil_al2['signo']=='/'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($alturas_v_c+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($alturas+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                       if($fil_al2['lado']!="Vertical"){
                $al2x = ($anchi+$fil_al2["descuento"])/ $fil_al2['variable'];
                $al2xb = ($aaba+$fil_al2["descuento"])/ $fil_al2['variable'];
            }else{
                $al2x = ($alti+$fil_al2["descuento"])/ $fil_al2['variable'];
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
              $tv = ($al + $rowt['var1']) / $rowt['divisor'];
             $tv2 = ($al2 + $rowt['var2']) / $rowt['divisor_alto'];
             
            
             
             $tvb = ($alb + $rowt['var1']) / $rowt['divisor'];
//             $tv2b = ($al2b + $rowt['var2']) / $rowt['divisor_alto'];
             
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
                $an2b = $tvb - $n;
            }else{
                $n = 0;
                $an2 = $tv;
                $an2b = $tvb;
            }
            if($rowt['cp']==1){
                $cf = $alturas;
              
            }else{
                if($rowt['cp']==-1){
                $cf = - $alturas;
              
            }else{
                $cf = 0;
              
            }
              
            }
            if($rowt['desc']==0){
                $dess = 0;
              
            }else{
                $dess = $alti;
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx + $cf ;
            }else{
                $nx = 0;
                $all = $tv2 + $cf ;
            }
//         echo '$row["ancho_v"] : '.$rowt["ancho_v"].'<br>';
//              echo '$row["alto_v"] : '.$rowt["alto_v"].'<br>';
//            
          
//          echo 'ancho:'.$an2.' x alto:'.$all.'<br>';
//            echo 'altura'. $alturas_v_c.' altura_ventana: '.$alturas_ventana.'<br>';
//            echo 'ref:'.$row33['id_p'].'<br>';
            $m2 = ($an2/1000)*($all/1000);
  
              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $_GET['cant'];
              $mtg +=$m2;
              $mtt +=$metro_t;
		$anchi_gen += $an2; $alti_gen += $all;
//                echo $metro_t.'  '.$_GET['cant'].'<br>';
          
} }
