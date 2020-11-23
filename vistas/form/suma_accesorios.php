<?php
$reques27=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowd["id_p"]." and c.id_referencia=".$row['ref']." ");


        $cantidad_acc=0;
        $tac2 = 0;
        $peso_acc2 = 0; $cangen = 0;$ff= 0;$aa=0;$mm=0;$porcacc=0;
	while($rowacc=mysqli_fetch_array($reques27))
	{            
  
 // fin codigo	
     $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
   
          
	//Por cada resultado pintamos una linea
       
  
          
            //--------------------------------------------------------------------
                        if($rowacc['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowd["id_p"]." and b.id_r_rej=".$rowacc['can_rej']." ");
while($rowaccz=mysqli_fetch_array($request_v2))
{

$sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$rowd["id_p"]." and b.id_r_a=".$rowaccz["id_referencia_med"]."");
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
               $rs = $rowd["cuerpo"] * 2 * $rowacc["cantidad_acc"];
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
                 $f = number_format(($taa2*$rowd["cantidad_c"])*$m);
                 $ft = $f * $rowacc["valor_f"] ;
                 $a = $f * $rowacc["valor_f"] ;
             }else{
                 $m = $rowacc["med"];
                 $f = number_format($taa2*$rowd["cantidad_c"]);
                 $ft = 'No aplica' ;$a = '' ;
             }
            
            $tac2 = $tac2 + ($taa2*($rowacc["costo_mt"]/$porcacc)*$m*$rowd["cantidad_c"] + $a);
            
             $pst_acc = (($rowacc['peso'] * $taa2));
             $peso_acc2 = $peso_acc2 + $pst_acc;
             $cantidad_acc += $taa2;
             $cangen += $rowd["cantidad_c"];
             $ff += $f;
             $mm = $m;
             $aa += $a;
             

         }
echo $row['codigo'] . ' - '.$f.'<br>';
