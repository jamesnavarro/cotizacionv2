<?php
if(isset($id_items)){
    include 'consultar_item.php';
}else{

            $linea_cot= $linea;
            $id_referencia= $ref;
            $id_cotizacion= $idct;
            $id_cot= $cot;
            //$producto= $fila21["producto"];
            //$codigo= $fila21["codigo"];
            $id_vidrio= $vid;
            $id_vidrio2= $vid2;
            $id_vidrio3= $vid3;
            $id_vidrio4= $vid4;
            $id_vidrio5= $vid5;
            $id_vidrio6= $vid6;
            $pelicula= $pelicula;
            
            $id2_vidrio= $vidd;
            $id2_vidrio2= $vidd2;
            $id2_vidrio3= $vidd3;
            $id2_vidrio4= $vidd4;
            $id2_vidrio5= $vidd5;

            $id3_vidrio=$vidt;
            $id3_vidrio2= $vidt2;
            $id3_vidrio3= $vidt3;
            $id3_vidrio4= $vidt4;
            $id3_vidrio5= $vidt5;

            $id4_vidrio= $vidc;
            $id4_vidrio2= $vidc2;
            $id4_vidrio3= $vidc3;
            $id4_vidrio4= $vidc4;
            $id4_vidrio5= $vidc5;
            //$lado= $fila21["imagen"];
            
            $laminas= $laminas;
            $laminas2= $laminas2;
            $laminas3= $laminas3;
            $laminas4= $laminas4;
            $traz_vid= $traz_vid;
            $traz_vid2= $traz_vid2;
            $traz_vid3= $traz_vid3;
            $traz_vid4= $traz_vid4;
            //$cierre_cot = $fila21["cierre"];
            $ancho= $ancho;
            $aa= $ancho_a;
            $alto= $alto;
            $ancho_temp= $ancho_temp;
            $alto_temp= $alto_temp;
            $cant_item= $cantidad;
            //$por= $fila21["porcentaje"];
            //$por_mp= $fila21["porcentaje_mp"];
            //$ruta= $fila21["ruta"];
            //$ruta2= $fila21["ruta2"];
            $color= $alum;
            $altura= $altura;
            $altura_v_c =  $alto - $altura;
            $anchura = $anchura;
            $anchura_v_c = $ancho - $anchura;
            //$tip= $fila21["tip"];
            $hoja= $hoja;
            $pel= $pel;
            $rollo= $pel;
            $desc= $desc;
            $per= $per;
            $boq= $boq;
            $install= $install;
            //$obs= $fila21["observaciones"];
            //$obs2= $fila21["observaciones2"];
            //$modulo= $fila21["modulo"];
            $huacal= $huacal;
            $verticales= $vert;
            //$ubica= $fila21["ubicacion_c"];
            //$adicional= $fila21["imagen_mas"];
            $horizontales= $hori; 
            //$d1= $fila21["d1"];   automatico de los verticales de fachada
            //$duracion= $fila21["duracion"];
            //$ancho_maximo= $fila21["ancho_maximo"];
            //$alto_maximo= $fila21["alto_maximo"];
            //$msg= $fila21["msg"];
            //$msg2= $fila21["msg2"];
            $cantlam= $cantlam;
            $poli= $poli;
            $dolar= $dolar;
            $poli_v= $cvp;
            $poli_h= $chp;
            
            $rieles = $rieles;
            $alfajia = $alfajias;
            $cierres = $cierres;
            $rodajas = $rodajas;
            
            $cancierres = $cancier;
            $canrodajas = $canroda; 
            $poralu = $despalu;
            $porvid = $despvid;
            $poracc = $despacc;
            $porace = $despace;
}      
session_start();
//comienzo de calculo----------------------------------------------------------------------------------
            $costo_total_item = 0;  //variables totales en cero
            $costo_total_item_desp = 0;
            
             if($poralu==0){
                $alum_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $po =mysql_fetch_array(mysql_query($alum_por));
                $porca= $po["p"]/100;
                $despalu = 100 - $po["p"];
                }else{
                    $porca= (100-$poralu)/100;
                    $despalu = $poralu;
                }
                if($porvid==0){
                $vidrio_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysql_fetch_array(mysql_query($vidrio_por));
                $porcv= $fip["p"]/100;
                $despvid = 100-$fip["p"];
                }else{
                    $porcv= (100-$porvid)/100;
                    $despvid = $porvid;
                }
                if($poracc==0){
                $acc_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100;
                 //$porcacc= 0.95; 
                $despacc = 100-$fipa["p"];
                }else{
                    $porcacc= (100-$poracc)/100;
                    $despacc = $poracc;
                }
                $porcace = $porace;
                
                // calculo de perfiles----------------------------------------------------------------------
                
                 $request=mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
                $sql_alf = mysql_query("SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
              $descuento_riel = 0;
              $descuento_alfa = 0;
               $costo_alu = 0;
                $total_alu = 0;
                $crudo = 0;
                $pintado=0;
                $peso_perfiles = 0;
              while($sa = mysql_fetch_array($sql_alf)){
                  if($sa['modulo']=='Rieles'){
                      $descuento_riel = $sa['descuento'];
                  }
                  if($sa['modulo']=='Alfajia'){
                      $descuento_alfa = $sa['descuento'];
                  }
                  $perimetro = $sa['area']/1000;
                  $pst = (($sa['peso'] * $ancho) / 1000);
                  $precio = $sa['costo_mt'];
                   $medida = $ancho; //-$descuento_riel-$descuento_alfa
            $cantidad = $cant_item;
            
            include '../vistas/cotizacion/costopintura.php';
                 
            $n=1000;

           
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000;
            $precio_total = $precio * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            
             $costo_alu += $precio_total_acabado;
            $total_alu += $totadesp;
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            $peso_perfiles += $pst*$cantidad;
           
            }
            
            while($row=mysql_fetch_array($request))
            {    
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
            $fia =mysql_fetch_array(mysql_query($pdlr));
            $precio_actual= $fia["precio_actual"];
            $perimetro = $row["area"]/1000;
                 
            $nw_medida = $row['medida_r_a'];
            $nw_lado = $row['lado'];
            $nw_var1 = $row['descuento'];
            $nw_ope = $row['signo'];
            $nw_var2 = $row['variable'];
            $nw_cant = $row['cantidad'];
            $nw_div = $row['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
              if($horizontales==0){
                    $hori = 1;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 1;
                }else{
                    $vert = $verticales;
                }

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
            
              if($nw_lado=='Vertical'){
                    $deto = $descuento_riel;
                    $detoa = $descuento_alfa;
                    $canfac = $vert;
                }else{
                    $deto = 0;
                    $detoa = 0;
                    $canfac = $hori;
                }
                if($nw_div=='1'){
                    $canfac = $canfac;
                    $perfac = $canfac.' '.$nw_lado;
                }else{
                    $canfac = 1;
                    $perfac='';
                }
            $medida = $med_perfil-$deto-$detoa;
            $cantidad = $row['cantidad']*$cant_item*$canfac;
            
            include '../vistas/cotizacion/costopintura.php';
                 
            $n=1000;
            
            
            $pst = (($row['peso'] * $medida) / 1000)*$cantidad;
            
            $medida = $medida; //-$deto-$detoa
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000;
            $precio_total = $precio_actual * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            $total_perfil_costo += $precio_total;
            $total_perfil_desp += $totadesp;

            $pre_und = $precio_total / $cantidad;
            
            $costo_alu += $precio_total_acabado;
            $total_alu += $totadesp;
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            $peso_perfiles += $pst*$cantidad;
             
           } 
// suma de perfiles 
            //echo '<SCRIPT>alert('.$total_alu.')</SCRIPT>';
           $costo_total_item += $costo_alu;
           $costo_total_item_desp += $total_alu;
//  //echo '<script>alert("precio '.$costo_alu.' + desp '.$total_alu.'")</script>';


// calculo de rejillas---------------------------------------------------------------
           
$request_rej=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
           $xx=0; $xxfom=0; 
        $peso_rej=0;
        $total_costo_rej = 0;
        $total_desp_rej = 0;
  while($row=mysql_fetch_array($request_rej))
  {     
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
             $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysql_fetch_array(mysql_query($pdlr));
             $precio_actual = $fia["precio_actual"];
          
                 
             $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;

       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
  {

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysql_fetch_array(mysql_query($sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            $nw_medida = $fil_anrej['medida_r_a'];
            $nw_lado = $fil_anrej['lado'];
            $nw_var1 = $fil_anrej['descuento'];
            $nw_ope = $fil_anrej['signo'];
            $nw_var2 = $fil_anrej['variable'];
            $nw_cant = $fil_anrej['cantidad'];
            $nw_div = $fil_anrej['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $alr = $med_perfil;
            
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $precio_actual / $porca;
         $prejfom = $precio_actual_fom / $porcaB; 
          
         
             if($row["medida_rej"]==0 || $row["medida_rej"]==999994){
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

            //$numero = ($medrej*$tv2)/$row["medida"];
             
            
            
            $pst_rej = (($row['peso'] * ($medrej/1000)))*$tv2*$cant_item;
            $peso_rej = $peso_rej + $pst_rej;
            
            $valor_u = ($precio_actual * $tv2 * ($medrej/1000));
            $valor_t = ($valor_u * $cant_item);
            
            $valor_total_rej = $valor_t  + $valor_acabado;
            
            $valor_tot_desp = $valor_total_rej / $porca;
            
           
            $total_costo_rej += $valor_total_rej;
            $total_desp_rej += $valor_tot_desp;
          
  } 
  
  // suma de rejillas 
  //echo '<SCRIPT>alert('.$total_desp_rej.')</SCRIPT>';
  $costo_total_item += $total_costo_rej;
$costo_total_item_desp += $total_desp_rej;

// calculo de vidrio

   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
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
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
            
            $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
 
            }

            if($row["alto_v"]==0){
                $al2= $alto;
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            $nw_medida = $fil_al['medida_r_a'];
            $nw_lado = $fil_al['lado'];
            $nw_var1 = $fil_al['descuento'];
            $nw_ope = $fil_al['signo'];
            $nw_var2 = $fil_al['variable'];
            $nw_cant = $fil_al['cantidad'];
            $nw_div = $fil_al['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al2 = $med_perfil;
            }
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysql_fetch_array(mysql_query($sqlx2));
  
            $nw_medida = $fil_an2['medida_r_a'];
            $nw_lado = $fil_an2['lado'];
            $nw_var1 = $fil_an2['descuento'];
            $nw_ope = $fil_an2['signo'];
            $nw_var2 = $fil_an2['variable'];
            $nw_cant = $fil_an2['cantidad'];
            $nw_div = $fil_an2['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al22 = $med_perfil;
            }else{
               
                
                $al22 = 0;
                $al22b = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysql_fetch_array(mysql_query($sqlw2));
            $nw_medida = $fil_al2['medida_r_a'];
            $nw_lado = $fil_al2['lado'];
            $nw_var1 = $fil_al2['descuento'];
            $nw_ope = $fil_al2['signo'];
            $nw_var2 = $fil_al2['variable'];
            $nw_cant = $fil_al2['cantidad'];
            $nw_div = $fil_al2['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al2x = $med_perfil;
            }else{
               $al2xb = 0;
                $al2x = 0;
            }
              $tv = ($al + $row['var1']) / $row['divisor'];
             $tv2 = ($al2 + $row['var2']- $al2x) / $row['divisor_alto'];
             

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
                $all = $tv2 - $dess;
            }else{
                $nx = 0;
                $all = $tv2 + $cf - $dess;
            }

            $m2 = ($an2/1000)*($all/1000);

              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $cant_item;

              
         $porc = $porcv;
         $gttotal_costo_vidrio = 0;
         $gttotal_despe_vidrio = 0;
         $gtpeso_vidrio = 0;
         if($traz_vid!=0){
             
                  $idvidrio = $id_vidrio; // espesor del vidrio
                  $idvidrio2 = $id_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
  
             
         }
         if($traz_vid2!=0){
                  $idvidrio = $id2_vidrio; // espesor del vidrio
                  $idvidrio2 = $id2_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id2_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id2_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid2;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         if($traz_vid3!=0){
                  $idvidrio = $id3_vidrio; // espesor del vidrio
                  $idvidrio2 = $id3_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id3_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id3_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid3;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         if($traz_vid4!=0){
                   $idvidrio = $id4_vidrio; // espesor del vidrio
                  $idvidrio2 = $id4_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id4_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id4_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid4;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         

                   $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                   $cu = $cu + 1;
          
  } 
  //echo '<SCRIPT>alert('.($total_vidsp / $porcv).')</SCRIPT>';
  //suma de vidrio
  $costo_total_item += $total_vidsp;
  $costo_total_item_desp += ($total_vidsp / $porcv);
  // //echo '<script>alert("precio  vid'.$total_vidsp.' + desp vid '.($total_vidsp / $porcv).'")</script>';
  // calculo de accesorios
   if($horizontales==0){
                    $hori = 1;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 1;
                }else{
                    $vert = $verticales;
                }
     $request_acE=mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." order by b.para");
  $total2=0;
        $tac = 0;$tacfom = 0;
        $peso_acc=0;
        $costo_total_acc=0;
        $costo_desp_acc = 0;

  while($row=mysql_fetch_array($request_acE))
  {      
           
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysql_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlxy));
            $id_p= $fil_an["id_p"];
             $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
                
        if($row["lado"]=='Vertical'){
                 $canfach = $vert;
             }else{
                 $canfach = $vert;
             }
             if($row["multiplica"]=='Si'){
                 $canfach = $canfach;
             }else{
                 $canfach = 1;
             }
             if($row['calcular']=='ML'){
               $rs = $hoja * 2 * $row["cantidad_acc"];
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
            }} //se  quito }
             $taa = $cant_rej * $res*$canfach;
             if($row["med"]!=1){
                 $m = 1;
                 $f = ''.($taa*$cant_item).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.($taa*$cant_item).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            if($pelicula!='No Aplica' && $row['codigo']=='26044'){ 
            if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; }          
            $tac = $tac + (($taa * $v) *($row["costo_mt"]/$porcacc)*$m*$cant_item + $a);   
            $tacfom = $tacfom + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            (($taa * $v) *($row["costo_mt"]/$porcacc)*$m*$cant_item + $a); 
            $taa = $taa * $v;
            ////echo $pelicula;
            }
            if($row['codigo']!='26044'){ 
            $tac = $tac + ($taa * ($row["costo_mt"]/$porcacc) * $m * $cant_item + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
             
             $costo_total_acc +=($taa*($row["costo_mt"])*$m*$cant_item + $a);
             $costo_desp_acc += ($taa*($row["costo_mt"]/$porcacc)*$m*$cant_item + $a);
          
               
  }
        $request_acE2=mysql_query("SELECT * FROM referencias where id_referencia='".$rollo."' ");
        $total2=$total2;
        $tac = $tac;
        $tacfom = $tacfom;
  while($row = mysql_fetch_array($request_acE2)){
      if($laminas>2){
          $lam = $laminas - 1;
      }else{
          $lam = 1;
      }
      $mt2 = (($alto/1000)*($ancho/1000)) * $cantlam;
      $cos_und = $row["costo_mt"] * $mt2;
      $cos_tot = $cos_und * $cant_item;
      $vlr_und = $cos_und / $porcacc;
      $vlr_tot = $vlr_und * $cant_item;
      $tac += $vlr_tot;
      
      $cosf_und = $row["costo_fom"] * $mt2;
      $cosf_tot = $cosf_und * $cant_item;
      $vlrf_und = $cosf_und / $porcaccB;
      $vlrf_tot = $vlrf_und * $cant_item;
      $tacfom += $vlrf_tot;
      
      $can_tot = $mt2 * $cant_item;
      
      $costo_total_acc +=($cos_tot);
      $costo_desp_acc += ($vlr_tot);
                 

  }
  
    $request_kits=mysql_query("SELECT * FROM receta_kits where idkit in ('$cierres','$rodajas','$idespaciador') ");
       
  while($rowt = mysql_fetch_array($request_kits)){
  
      if($rowt["modulo"]=='Cierres'){
          $cankitt = $cancierres;
      }else if($rowt["modulo"]=='Espaciadores'){
          $cankitt = $canespaciador;
      }else{
          $cankitt = $canrodajas;
      }
       $request_kitsi=mysql_query("SELECT * FROM receta_kits_items where idkit in ('".$rowt['idkit']."') ");
       
  while($row = mysql_fetch_array($request_kitsi)){
      
          $cankit = $cankitt*$row["cantidad"];
     
          $querypro = mysql_query("select costo_mt from referencias where codigo='".$row['codigo_pro']."'  ");
          $v = mysql_fetch_array($querypro);
      
      $can_tot = $cankit * $cant_item;
      $cos_und = $v[0];
      $cos_tot = $cos_und * $can_tot;
      $vlr_und = $cos_und / $porcacc;
      $vlr_tot = $vlr_und * $can_tot;
      $tac += $vlr_tot;
     
      $costo_total_acc +=($cos_tot);
      $costo_desp_acc += ($vlr_tot);
      
      }  
  
  }
$tac_p = $tac * $porcacc;
//suma de accesorios
  //echo '<SCRIPT>alert("accesorios '.$rollo.' '.$tac.'")</SCRIPT>'; 
$costo_total_item += $tac_p;
$costo_total_item_desp += $tac;
// //echo '<script>alert("precio  acc '.$tac_p.' + desp acc '.($tac_p).'")</script>';
// calculo de mano de obras

$request_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$id_referencia);
  
        $totmo=0;
        $tot_fom=0;
        $total_fab = 0;
        $total_ins=0;
        $total_pol=0;
  while($row=mysql_fetch_array($request_maq))
  {       
            $mt2 = ($alto/1000)*($ancho/1000);
            $mtl = ($ancho/1000);
            if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
            if($install=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($cant_item*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($cant_item*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                }
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($cant_item*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($cant_item*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($cant_item*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($cant_item*$row["valor_mo"]);
                    
                }  
                if($row['referencia']!='26002'){ 
                $tot_fom = $tot_fom + $tarf;
                }
                if($pelicula!='No Aplica' && $row['referencia']=='26002'){
                    if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                  $tot_fom = $tot_fom + ($tarf * $v); 
                  $tarf = $tarf * $v;
                }
                }
                if($row['referencia']!='26002'){ 
                $totmo = $totmo + $tar;
                }
              
                
            }else{
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($cant_item*$row["valor_mo"]);
                    $tarf =  $tar;
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mt2*($cant_item*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['instalacion']=='No'){
             
                if($row['referencia']!='26002'){ 
                $totmo = $totmo + $tar;
                $tot_fom = $tot_fom + $tarf;
                
                }
               
                }else{
                    if($pelicula!='No Aplica' && $row['referencia']=='26002'){ 
                             if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                             $totmo = $totmo + ($tar * $v);
                             $tar = $tar * $v;
                    }else{
                        $tar = 0;
                    }
                    
                }
            }
            if($row['instalacion']=='No'){
                 $total_fab += $tar;
            }else{
                 if($pelicula=='No Aplica'){
                     if($row['referencia']!='26002'){ 
                         $total_ins += $tar;
                     }
                 }else{
                     if($row['referencia']=='26002'){ 
                         $total_pol += $tar;
                     }else{
                         $total_ins += $tar; 
                     }
                 }
            }
             
               
  } 
  
  // suma de mano de obra
  $ser=0;
  $sertt = $total_fab + $total_ins + $total_pol;

     //echo '<SCRIPT>alert("mobra  '.$totmo.'")</SCRIPT>'; 
$costo_total_item += $sertt ;
$costo_total_item_desp += $sertt * 1.45;
$ser += ($sertt * 1.45);

// //echo '<script>alert("precio  moo  + desp moo  '.($tot * 1.45).'")</script>';
 
// calculo de servicios
$request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cot_mas=".$id_cotizacion." ");
 $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
            
//                  $request_ac1=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
//               $tota=0;
//	while($row1=mysql_fetch_array($request_ac1))
//	{       
//               $por = 100;
//            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);  
//            
//	} 
        $pr = (100 - $row2["utilidad"]) / 100; 
        $fr = ($row2["precio_servicio"]*$cant_item);
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd;
               
	} 
    // suma  de servicios   
    //echo '<SCRIPT>alert('.$to_serv.')</SCRIPT>'; 
 $costo_total_item += $to_serv;
 $costo_total_item_desp += $to_serv * 1.45;
 $ser += ($to_serv * 1.45);
 ////echo '<script>alert("costo '.($to_serv).' desp: '.($to_serv * 1.45).' ")</script>';
 // calculo de elementos adicionales
 // //echo '<script>alert("precio  moo  + desp moo 2 '.($to_serv * 1.45).'")</script>';
 
 $request_ack=mysql_query("SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_cot=".$id_cotizacion."  ");
          $t=0;$total2ak=0;$cb=0;
  while($row=mysql_fetch_array($request_ack))
  {       $t = $t +1;
            
                
                
                if($row["med"]==1){
                    $v = 1*$cant_item;
                }else{
                    $v = ($row["med"]/1000)*$cant_item;
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
                $pp = $row["costo_mt"]/$porca;
                $total2ak= $total2ak + $mt*$pp;
                $cb += ($row["costo_mt"] * $mt*$cant_item);
  
                         
  }  
  //echo '<SCRIPT>alert('.$cb.')</SCRIPT>';
  //suma de de adicionales
 $cbb = $total2ak;
 $costo_total_item += $cb;
 $costo_total_item_desp += $cbb; 
 
 //calculo de kits
 ////echo '<script>alert("precio  $cb '.($cb).' + desp moo '.($cbb).'")</script>';
 
 $request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_prod_mas=".$id_cotizacion." and b.comp='1'  ");

        $t2e=0;
        $to_kk =0;   
        $ksp = 0;    
  while($row21k=mysql_fetch_array($request4))
  {       
  
            $t2e= $t2e + 1;
            include '../modelo/suma_kit_1.php';
            
             $desm = ($row21k['desc_k']/100) * ($ktotk);
             $ddm = ($ktotk + $desm) / $porcacc;
             $to_kk = $to_kk + $ddm;
             $ksp += $ktotk;
            
  } 
  ////echo '<SCRIPT>alert("kit  '.$ksp.'")</SCRIPT>'; 
  // suma de kits
  $costo_total_item += $ksp;
 $costo_total_item_desp += $to_kk;  
// if($_SESSION['k_username']=='admin'){
//    echo '<script>alert("costo total '.$costo_total_item.' + desp '.$costo_total_item_desp.' ")</script>';
// }
 include 'calculo_planilla.php';
 
 $precio_venta_total;
 $total = $costo_total_item_desp;
  $totalfom_sinp = $costo_total_item;

   $request26t=mysql_query("SELECT precio_item FROM cotizaciones  WHERE id_compuesto = " .$id_cotizacion. "  ");
   $total_compuestost=0;
   while($rowt=mysql_fetch_array($request26t)){
      $total_compuestost += $rowt['precio_item']*$cant_item;

    }
    
    $precio_venta_total = $precio_venta_total + $total_compuestost;
