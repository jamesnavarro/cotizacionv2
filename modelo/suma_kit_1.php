 <?php
 if(isset($rowk["id_p"])){
 $reff = $rowk["id_p"];
 $klinea_cot = $rowk["linea"];
 $kcann = 1;
 $kinstall='Si'; $instal='Si';
 }else{
    $reff = $row21k["id_p"];
 $klinea_cot = $row21k["linea"];
 $kcann = $row21k["cantidad_k"];
 $kinstal='Si'; $instal='Si';  
 }
//
// FIN REJILLASSSS----------------------------------------<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>
 $kacc_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $kfipa =mysql_fetch_array(mysql_query($kacc_por));
                $kporcacc= $kfipa["p"]/100; 
$krequest_acE=mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($krequest_acE){

     
        $ktac = 0;
	while($krow=mysql_fetch_array($krequest_acE))
	{  
                                  
               if($krow["med"]!=1){
                   $km = $krow["med"]/1000;}else{$km = $krow["med"];
                   
                   }
                        if($klinea_cot=='Fachada'){
                 if($krow["yes"]=='Si'){
                     if($krow["lado"]=='Vertical'){
                         $kres = ((($krow["cantidad_acc"]*$kaltt) / $krow["metro"])+$krow["cantidad_acc"])*$kd;
                     }else{
                         $kres = ($krow["cantidad_acc"]*$kancc) / $krow["metro"];
                     }              
                 }else{
                      $kres = $krow["cantidad_acc"];
                 }
            }else{
              if($krow['calcular']=='ML'){
               $krs = $khoja * 2 ;
               $kres = (($kancc / 1000) * 2) + (($kaltt/1000)*$krs);
            }ELSE{
                 if($krow["yes"]=='Si'){
                     if($krow["lado"]=='Vertical'){
                         $kres = ($krow["cantidad_acc"]*$kaltt) / $krow["metro"];
                     }else{
                         $kres = ($krow["cantidad_acc"]*$kancc) / $krow["metro"];
                     }    
                 }else{
                      $kres = $krow["cantidad_acc"];
                 } 
            }}
            $ktaa =  $kres;
             if($krow["med"]!=1){
                 $km = $krow["med"]/1000;
                 $kf = ''.number_format(($ktaa*$kcann)*$km).' ML';
                 $kft = $kf * $krow["valor_f"] ;$ka = $kf * $krow["valor_f"] ;
             }else{
                 $km = $krow["med"];
                 $kf = ''.number_format($ktaa*$kcann).' '.$krow["calcular"].'';
                 $kft = 'No aplica' ;$ka = '' ;
             }
            $ktac = ($ktaa*$kcann*$km)*($krow["costo_mt"]/$kporcacc) + $ktac + $ka;
           //echo $ktac.'<br>';
	} 

}
//echo 'Accesorios'.$ktac.'<br>';
// FIN DE ACCESORIOS-----------------<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>


    
   
    $kff = $ktac;
    $ktv2 =0;
    $kta = 0;
    $ktotal_vid =0;
    $kxx=0;
$krequest_mano=mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($krequest_mano){

        $ktot2=0;
	while($krow=mysql_fetch_array($krequest_mano))
	{       
             
           
                $kr = $krow["porcentaje_ma"]/100*$kff;
                $ktot2 = $ktot2 + $kr;
           
            
	    
               
	} 

}
//echo 'maquinaria'.$ktot2.'<br>';
//echo $kta.'<br>';
//echo $ktotal_vid.'<br>';
//echo $kff.'<br>';
//echo 'maquinaria'.$ktot2.'<br>';
// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

$krequest_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='No' and b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$reff);
    
  
if($krequest_maq){

        $ktot=0;
	while($krow=mysql_fetch_array($krequest_maq))
	{       
            $kmt2 = ($kaltt/1000)*($kancc/1000);
            $kmtl = ($kaltt/1000)+($kancc/1000);
          
                
                if($krow['unidad_cobro']=='M2'){
                    $ktar =  $kmt2*($kcann*$krow["valor_mo"]);
                }
                if($krow['unidad_cobro']=='ML'){
                    $ktar =  $kmtl*($kcann*$krow["valor_mo"]);
                }
                if($krow['unidad_cobro']=='Und'){
                    $ktar =  ($kcann*$krow["valor_mo"]);
                }
                if($krow['unidad_cobro']=='Kg'){
                    $ktar =  ($kcann*$krow["valor_mo"]);
                }
                $ktot = $ktot + $ktar;
     
	} 

}

if($kinstal=='Si'){
$kreq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='Si' and  b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$reff);   
if($kreq){

        $ktotsi=0;
	while($krow=mysql_fetch_array($kreq))
	{       
            $kmt2 = ($kaltt/1000)*($kancc/1000);
            $kmtl = ($kaltt/1000)+($kancc/1000);
       
                
                if($krow['unidad_cobro']=='M2'){
                    $ktars =  $kmt2*($kcann*$krow["valor_mo"]);
                }
                if($krow['unidad_cobro']=='ML'){
                    $ktars =  $kmtl*($kcann*$krow["valor_mo"]);
                }
                if($krow['unidad_cobro']=='Und'){
                    $ktars =  ($kcann*$krow["valor_mo"]);
                }
                if($krow['unidad_cobro']=='Kg'){
                    $ktars =  ($kcann*$krow["valor_mo"]);
                }
                $ktotsi = $ktotsi + $ktars;     
	} 
}}

//echo 'mano de obra'.$ktot.'<br>';
//echo 'Instalacion-: '.$kinstal.'<br>';
///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
$ktotal = $kta + $ktv2 + $ktac+ $ktot;
$krequest_ad=mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($krequest_ad){

        $ktota=0;
	while($krow=mysql_fetch_array($krequest_ad))
	{       
            $kpor = 100;
             $ktota = $ktota + ($kff*$krow["porcentaje_ad"]/$kpor);
  
	} 

}
$krequest_ot=mysql_query("SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$reff);    
if($krequest_ot){

        $kt2=0;
	while($krow=mysql_fetch_array($krequest_ot))
	{       
             $kt2 = $kt2 + $krow['valor_ot']*$kcann*$krow['cantidad_ot'];
  
	}  
}
       if(isset($ktotsi)){
           if($klinea_cot!='Vidrio'){
               $ksi = $ktotsi;
           }else{
              $ksi =0; 
           }
    
}else{$ksi =0;}
$ktotk = $kta  + $ktac + $ktota +$ktot2;


//dd