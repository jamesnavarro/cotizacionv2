 <?php
 if(isset($rowk["id_p"])){
 $reff = $rowk["id_p"];
 $linea_cot = $rowk["linea"];
 $cann = 1;
 $install='Si'; $instal='Si';
 }else{
    $reff = $row21k["id_p"];
 $linea_cot = $row21k["linea"];
 $cann = $row21k["cantidad_k"];
 $install='Si'; $instal='Si';  
 }
//
// FIN REJILLASSSS----------------------------------------<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>
 $acc_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
$request_acE=mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_acE){

     
        $tac = 0;
	while($row=mysql_fetch_array($request_acE))
	{  
                                  
               if($row["med"]!=1){
                   $m = $row["med"]/1000;}else{$m = $row["med"];
                   
                   }
                        if($linea_cot=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$altt) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }else{
                         $res = ($row["cantidad_acc"]*$ancc) / $row["metro"];
                     }              
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{
              if($row['calcular']=='ML'){
               $rs = $hoja * 2 ;
               $res = (($ancc / 1000) * 2) + (($altt/1000)*$rs);
            }ELSE{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$altt) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancc) / $row["metro"];
                     }    
                 }else{
                      $res = $row["cantidad_acc"];
                 } 
            }}
            $taa =  $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$cann)*$m).' ML';
                 $ft = $f * $row["valor_f"] ;$a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$cann).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            $tac = ($taa*$cann*$m)*($row["costo_mt"]/$porcacc) + $tac + $a;
           //echo $tac.'<br>';
	} 

}
//echo 'Accesorios'.$tac.'<br>';
// FIN DE ACCESORIOS-----------------<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>


    
   
    $ff = $tac;
    $tv2 =0;
    $ta = 0;
    $total_vid =0;
    $xx=0;
$request_mano=mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_mano){

        $tot2=0;
	while($row=mysql_fetch_array($request_mano))
	{       
             
           
                $r = $row["porcentaje_ma"]/100*$ff;
                $tot2 = $tot2 + $r;
           
            
	    
               
	} 

}
//echo 'maquinaria'.$tot2.'<br>';
//echo $ta.'<br>';
//echo $total_vid.'<br>';
//echo $ff.'<br>';
//echo 'maquinaria'.$tot2.'<br>';
// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

$request_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='No' and b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$reff);
    
  
if($request_maq){

        $tot=0;
	while($row=mysql_fetch_array($request_maq))
	{       
            $mt2 = ($altt/1000)*($ancc/1000);
            $mtl = ($altt/1000)+($ancc/1000);
          
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($cann*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
     
	} 

}

if($instal=='Si'){
$req=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='Si' and  b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$reff);   
if($req){

        $totsi=0;
	while($row=mysql_fetch_array($req))
	{      
            if(isset($altt)){
                $altt = $altt; 
            }else{
                $altt = 1;
            }
            
            if(isset($ancc)){
                $ancc = $ancc; 
            }else{
                $ancc = 1;
            }
            $mt2 = ($altt/1000)*($ancc/1000);
            $mtl = ($altt/1000)+($ancc/1000);
       
                
                if($row['unidad_cobro']=='M2'){
                    $tars =  $mt2*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tars =  $mtl*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tars =  ($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tars =  ($cann*$row["valor_mo"]);
                }
                $totsi = $totsi + $tars;     
	} 
}}

//echo 'mano de obra'.$tot.'<br>';
//echo 'Instalacion-: '.$instal.'<br>';
///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
$total = $ta + $tv2 + $tac+ $tot;
$request_ad=mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_ad){

        $tota=0;
	while($row=mysql_fetch_array($request_ad))
	{       
            $por = 100;
             $tota = $tota + ($ff*$row["porcentaje_ad"]/$por);
  
	} 

}
//echo 'Administracion'.$tota.'<br>';
/// gastos administrativos



$request_ot=mysql_query("SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_ot){

        $t2=0;
	while($row=mysql_fetch_array($request_ot))
	{       
             $t2 = $t2 + $row['valor_ot']*$cann*$row['cantidad_ot'];
  
	} 

  
}
//echo 'otros'.$t2.'<br>';

       if(isset($totsi)){
           if($linea_cot!='Vidrio'){
               $si = $totsi;
           }else{
              $si =0; 
           }
    
}else{$si =0;}
$totk = $ta  + $tac + $tota +$tot2;
//
//echo 'total de $ta= '.$ta.'<br>';
//echo 'total de $total_vid= '.$total_vid.'<br>';
//echo 'total de $tac= '.$tac.'<br>';
//echo 'total de $tot2= '.$tot2.'<br>';
//echo 'total de $tot= '.$tot.'<br>';
//echo 'total de $tota= '.$tota.'<br>';
//echo 'total de $t2= '.$t2.'<br>';
//echo 'total de $si= '.$si.'<br>';
//echo 'total de suma_1 xx= '.$totk.'<br>';

//dd