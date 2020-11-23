<?php
$reques27=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c, producto_rep_acc b, referencias d where b.id_ref_acc=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and d.id_referencia=".$row['id_referencia']." ");


        $cantidad_acc=0;
        $tac2 = 0;
        $peso_acc2 = 0; $cangen = 0;$ff= 0;$aa=0;$mm=0;$porcacc=0;
	while($rowacc=mysqli_fetch_array($reques27))
	{            
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$rowacc['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$rowacc['id2_vidrio']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
          $_GET['l']= $rowacc["imagen"]; $_GET['mod']= $rowacc["modulo"];$_GET['per']= $rowacc["per"]; $_GET['boq']= $rowacc["boq"];
          $_GET['ref']= $rowacc["id_referencia"]; $_GET['idcot']= $rowacc["id_cotizacion"]; $_GET['tv']= $rowacc["traz_vid"];$_GET['tv2']= $rowacc["traz_vid2"];$_GET['tv3']= $rowacc["traz_vid3"];$_GET['tv4']= $rowacc["traz_vid4"];
          $aa= $rowacc["ancho_abajo"];$ancho= $rowacc["ancho_c"];$alto= $rowacc["alto_c"];
          $_GET['cant']= $rowacc["cantidad_c"];$_GET['vidrio']= $fv["color_v"].'('.$fv["espesor_v"];
          $_GET['id_v']= $rowacc["id_vidrio"];$_GET['id_v2']= $rowacc["id_vidrio2"];$_GET['id_v3']= $rowacc["id_vidrio3"];
          $_GET['id_v4']= $rowacc["id_vidrio4"]; $_GET['id_v5']= $rowacc["id_vidrio5"];$_GET['id_v6']= $rowacc["id_vidrio6"];         
          $_GET['id2_v']= $rowacc["id2_vidrio"];$_GET['id2_v2']= $rowacc["id2_vidrio2"];$_GET['id2_v3']= $rowacc["id2_vidrio3"];
          $_GET['id2_v4']= $rowacc["id2_vidrio4"]; $_GET['id2_v5']= $rowacc["id2_vidrio5"];$_GET['id2_v6']=  0;   
          $_GET['id3_v']= $rowacc["id3_vidrio"];$_GET['id3_v2']= $rowacc["id3_vidrio2"];$_GET['id3_v3']= $rowacc["id3_vidrio3"];
          $_GET['id3_v4']= $rowacc["id3_vidrio4"]; $_GET['id3_v5']= $rowacc["id3_vidrio5"];$_GET['id3_v6']= 0;       
          $_GET['id4_v']= $rowacc["id4_vidrio"];$_GET['id4_v2']= $rowacc["id4_vidrio2"];$_GET['id4_v3']= $rowacc["id4_vidrio3"];
          $_GET['id4_v4']= $rowacc["id4_vidrio4"]; $_GET['id4_v5']= $rowacc["id4_vidrio5"];$_GET['id4_v6']= 0;
          $altura= $rowacc["cuerpo"]; $hohas= $rowacc["hojas"];$_GET['ins']= $rowacc["install"];$_GET['por']= $rowacc["porcentaje_mp"];
          $_GET['v']= $rowacc["verticales"]; $_GET['h']= $rowacc["horizontales"]; $_GET['d1']= $rowacc["d1"];$_GET['dias']= $rowacc["duracion"];
 $altura_ventana = $alto - $altura;
     $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
   
          
	//Por cada resultado pintamos una linea
       
  
          
            //--------------------------------------------------------------------
                        if($rowacc['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c, cotizaciones d where d.id_cot=".$_GET['cot']." and d.id_referencia=a.id_p and b.id_referencia=c.id_referencia and a.id_p=b.id_p and d.id_cotizacion=".$rowacc["id_referencia"]." and b.id_r_rej=".$rowacc['can_rej']." ");
while($rowaccz=mysqli_fetch_array($request_v2))
{
    echo '---------------------------<br>';
$sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowacc["id_p"]." and b.id_r_a=".$rowaccz["id_referencia_med"]."");
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
     $cant_rej = number_format(($al / $rowaccz['var3']) * $rowaccz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($tipo=='Fachada'){
                 if($rowacc["yes"]=='Si'){
                     if($rowacc["lado"]=='Vertical'){
                         $res = ((($rowacc["cantidad_acc"]*$alto) / $rowacc["metro"])+$rowacc["cantidad_acc"])*$d;
                     }else{
                         $res = ((($rowacc["cantidad_acc"]*$ancho) / $rowacc["metro"])+$rowacc["cantidad_acc"])*$d;
                     }         
                 }else{
                      $res = $rowacc["cantidad_acc"];
                 }
            }else{      
             if($rowacc['calcular']=='ML'){
               $rs = $_GET['hojas'] * 2 * $rowacc["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                 if($rowacc["yes"]=='Si'){
                     if($rowacc["lado"]=='Vertical'){
                         $res = ($rowacc["cantidad_acc"]*$alto) / $rowacc["metro"];
                     }else{
                         $res = ($rowacc["cantidad_acc"]*$ancho) / $rowacc["metro"];
                     }             
                 }else{
                      $res = $rowacc["cantidad_acc"];
                 }            
            }}
             $taa2 = $cant_rej * $res;
             if($rowacc["med"]!=1){
                 $m = $rowacc["med"]/1000;
                 $f = (($taa2*$_GET['cant'])*$m);
                 $ft = $f * $rowacc["valor_f"] ;
                 $a = $f * $rowacc["valor_f"] ;
             }else{
                 $m = $rowacc["med"];
                 $f = $taa2*$_GET['cant'];
                 $ft = 'No aplica' ;$a = '' ;
             }
            
//            $tac2 = $tac2 + ($taa2*($rowacc["costo_fom"]/$porcacc)*$m*$_GET['cant'] + $a);
            
             $pst_acc = (($rowacc['peso'] * $taa2));
             $peso_acc2 = $peso_acc2 + $pst_acc;
             $cantidad_acc += $taa2;
             $cangen += $_GET['cant'];
             $ff += $f;
             $mm = $m;
             $aa += $a;
          
               
         }

