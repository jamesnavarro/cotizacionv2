<?php

 $reques2=mysql_query("SELECT * FROM producto a, cotizaciones c, producto_rep_alu b, referencias d where b.id_ref_alum=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and d.id_referencia=".$row["id_referencia"]." ");
$total2=0;
        $tacot =0;
        $cont =0; 
        $ta2 =0;
        $ptt =0;
        $med_t = 0;
        $cant_t = 0;
          $ccc = 0;
          $ta2fom =0;
	while($rower=mysql_fetch_array($reques2))
	{            
	            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$rower['id_vidrio']." ";
                $fv =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$rower['id2_vidrio']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vi2));
          $_GET['l']= $rower["imagen"]; $_GET['mod']= $rower["modulo"];$_GET['per']= $rower["per"]; $_GET['boq']= $rower["boq"];
          $_GET['ref']= $rower["id_referencia"]; $_GET['idcot']= $rower["id_cotizacion"]; $_GET['tv']= $rower["traz_vid"];$_GET['tv2']= $rower["traz_vid2"];$_GET['tv3']= $rower["traz_vid3"];$_GET['tv4']= $rower["traz_vid4"];
          $_GET['aa']= $rower["ancho_abajo"];$_GET['ancho']= $rower["ancho_c"];$_GET['alto']= $rower["alto_c"];
          $_GET['cant']= $rower["cantidad_c"];$_GET['vidrio']= $fv["color_v"].'('.$fv["espesor_v"];
          $_GET['id_v']= $rower["id_vidrio"];$_GET['id_v2']= $rower["id_vidrio2"];$_GET['id_v3']= $rower["id_vidrio3"];
          $_GET['id_v4']= $rower["id_vidrio4"]; $_GET['id_v5']= $rower["id_vidrio5"];$_GET['id_v6']= $rower["id_vidrio6"];         
          $_GET['id2_v']= $rower["id2_vidrio"];$_GET['id2_v2']= $rower["id2_vidrio2"];$_GET['id2_v3']= $rower["id2_vidrio3"];
          $_GET['id2_v4']= $rower["id2_vidrio4"]; $_GET['id2_v5']= $rower["id2_vidrio5"];$_GET['id2_v6']=  0;   
          $_GET['id3_v']= $rower["id3_vidrio"];$_GET['id3_v2']= $rower["id3_vidrio2"];$_GET['id3_v3']= $rower["id3_vidrio3"];
          $_GET['id3_v4']= $rower["id3_vidrio4"]; $_GET['id3_v5']= $rower["id3_vidrio5"];$_GET['id3_v6']= 0;       
          $_GET['id4_v']= $rower["id4_vidrio"];$_GET['id4_v2']= $rower["id4_vidrio2"];$_GET['id4_v3']= $rower["id4_vidrio3"];
          $_GET['id4_v4']= $rower["id4_vidrio4"]; $_GET['id4_v5']= $rower["id4_vidrio5"];$_GET['id4_v6']= 0;
          $_GET['cuerpo']= $rower["cuerpo"]; $_GET['hojas']= $rower["hojas"];$_GET['ins']= $rower["install"];$_GET['por']= $rower["porcentaje_mp"];
          $_GET['v']= $rower["verticales"]; $_GET['h']= $rower["horizontales"]; $_GET['d1']= $rower["d1"];$_GET['dias']= $rower["duracion"];
 // fin codigo
  if(isset($_GET['ref'])){
 $sql='select * from producto where id_p="'.$_GET["ref"].'"';
 $fil =mysql_fetch_array(mysql_query($sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $_GET["ancho"];$aa= $_GET["aa"];
        $alto= $_GET["alto"];
        $altura= $_GET["cuerpo"];
        $altura_ventana = $_GET["alto"]-$_GET["cuerpo"];
        if($_GET["l"]=='Derecho'){
            $ruta= $fil["ruta"];
        }else{
            $ruta= $fil["ruta2"];
        }
        
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$_GET["id_v"].'"';
         $fil2 =mysql_fetch_array(mysql_query($sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET["ancho"]/1000) + ($_GET["alto"]/1000)) * $costo_v)*$_GET["cant"];
 }           
	
  $alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysql_fetch_array(mysql_query($alum_por));
                $porca= $fia["p"]/100;   
            if($rower['signo']=='+'){
                if($rower['medida_r_a']==1){
                    $al = ($altura_ventana+$rower["descuento"])+ $rower['variable'];
                }else{
                    if($rower['medida_r_a']==2){
                    $al = ($altura+$rower["descuento"])+ $rower['variable'];
                }else{
                     if($rower['lado']!="Vertical"){
                $al = ($_GET['ancho']+$rower["descuento"])+ $rower['variable'];
            }else{
                $al = ($_GET['alto']+$rower["descuento"])+ $rower['variable'];
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
                $al = ($_GET['ancho']+$rower["descuento"])- $rower['variable'];
            }else{
                $al = ($_GET['alto']+$rower["descuento"])- $rower['variable'];
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
                $al = ($_GET['ancho']+$rower["descuento"])* $rower['variable'];
            }else{
                $al = ($_GET['alto']+$rower["descuento"])* $rower['variable'];
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
                $al = ($_GET['ancho']+$rower["descuento"])/ $rower['variable'];
            }else{
                $al = ($_GET['alto']+$rower["descuento"])/ $rower['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($rower['lado']=="Vertical"){
                $al55 = ($_GET['alto']);
            }else{
                $al55 = ($_GET['ancho']);
            }
            $n=1000;
           
            if($tipo=='Fachada'){
            if($rower["lado"]=='Vertical'){
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
                 if($rower['lado']=="Vertical"){
                $al5 = ($_GET['alto']);
            }else{
                $al5 = ($_GET['ancho']);
            }
                $z = 0;}
            $mp = $rower["costo_mt"]/$porca;
            $mpfom = $rower["costo_fom"]/$porca;
        
           if($rower["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
         
               $t =''; $m ='';
               $cantidad= $z+$rower["cantidad"];
               $dy = ($cantidad)*$_GET['cant'];
                $dy2 = $rower["cantidad"]*$_GET['cant'];
         
           $numero = (($dy2)*$al55)/$rower["medida"]; 
           $ta2 = $ta2 + ($al*$mp*(($dy2))/$n);
           $ta2fom = $ta2fom + ($al*$mpfom*(($dy2))/$n);
           if($rower["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$rower["descuento"].')'.$rower["signo"].' '.$rower["variable"];
           
           $pst = (($rower['peso'] * $al) / $rower["medida"])*$rower["cantidad"];
           $ptt = $ptt + $pst;
           $med_t += $al * $dy2;
           $cant_t += (($al*$mp*(($dy2))/$n));
           $ccc += $dy2;

	} 
        ?>

