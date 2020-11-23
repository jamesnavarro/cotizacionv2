 <?php
    include 'consultar_item.php';

  //comienzo de calculo----------------------------------------------------------------------------------
     $total_perfil_costo = 0;
            $total_perfil_desp = 0;
            $costo_total_item = 0;  //variables totales en cero.
            $costo_total_item_desp = 0;
            
            $costo_aluminio = 0; // variable para guardar costo para planilla
            $peso_aluminio = 0; // calcular peso general del aluminio
            
             if($poralu==0){
                $alum_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $po =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
                $porca= $po["p"]/100;
                $despalu = 100 - $po["p"];
                }else{
                    $porca= (100-$poralu)/100;
                    $despalu = $poralu;
                }
                if($porvid==0){
                $vidrio_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
                $despvid = 100-$fip["p"];
                }else{
                    $porcv= (100-$porvid)/100;
                    $despvid = $porvid;
                }
                if($poracc==0){
                $acc_por = "SELECT (p1) as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100;
                 //$porcacc= 0.95; 
                $despacc = 100-$fipa["p"];
                }else{
                    $porcacc= (100-$poracc)/100;
                    $despacc = $poracc;
                }
                $porcace= (100-$porace)/100;
                    $despace = $porcace;
                
                // calculo de perfiles----------------------------------------------------------------------
                
                 $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
                $sql_alf = mysqli_query($conexion,"SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
              $descuento_riel = 0;
              $descuento_alfa = 0;
               $costo_alu = 0;
                $total_alu = 0;
                $costo_ace = 0;
                $total_ace = 0;
                $crudo = 0;
                $pintado=0;
                $peso_perfiles = 0;
                $peso_acero = 0;
              while($sa = mysqli_fetch_array($sql_alf)){
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
            if($sa['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
                $peso_acero += $pst;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
                 $peso_perfiles += $pst;
            }

           
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000;
            $precio_total = $precio * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            if($sa['grupo']=='Perfileria Acero'){
                $costo_ace += $precio_total_acabado;
                $total_ace += $totadesp;
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
            }
//             $costo_alu += $precio_total_acabado;
//            $total_alu += $totadesp;
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            
           
            }
            
            while($row=mysqli_fetch_array($request))
            {    
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
            $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
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
                    $hori = 0;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 0;
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
            if($row['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
            }
            
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
            if($row['grupo']=='Perfileria Acero'){
                $costo_ace += $precio_total_acabado;
                $total_ace += $totadesp;
                $peso_acero += $pst;
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
                $peso_perfiles += $pst;
            }
//            $costo_alu += $precio_total_acabado;
//            $total_alu += $totadesp;
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            
             
           } 
// suma de perfiles 
           $costo_total_item += $costo_alu+$costo_ace;
           $costo_total_item_desp += $total_alu+$costo_ace;
           
           $costo_aluminio += $costo_alu;
//  echo '<script>alert("precio '.$costo_alu.' + desp '.$total_alu.'")</script>';
           

// calculo de rejillas---------------------------------------------------------------
           
$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
           $xx=0; $xxfom=0; 
        $peso_rej=0;
        $total_costo_rej = 0;
        
        $total_desp_rej = 0;
  while($row=mysqli_fetch_array($request_rej))
  {     
      
      $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
             $precio_actual = $fia["precio_actual"];
             if($row["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($row["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($row["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($row["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["id_referencia_med"]."");
                $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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

       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
  {

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($conexion,$sqlxr));
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
//            $perimetro = $row["area"]/1000;
//           if($perimetro=='0'){
//                $valor_acabado = $vc;
//           }else{
//               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
//           }
           //fin de cobro
            include 'costopintura.php';

            //$numero = ($medrej*$tv2)/$row["medida"];
             $valor_acabado = $vc * $perimetro * ($medrej/1000) * ($tv2 / $rendimiento);
            $valor_acabado = $valor_acabado*$cant_item;
            
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
  $costo_total_item += $total_costo_rej;
$costo_total_item_desp += $total_desp_rej;

$costo_aluminio += $total_costo_rej;
$peso_perfiles +=$peso_rej;
// calculo de vidrio

   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
        $metro_cuadrado=0;
        $peso_vidrio = 0;
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
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
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
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
  
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
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
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
             // descuento o suma del cuerpo fijo
             if($row['cp']=='-1'){
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto'] - $altura; // calcular alto del vidrio
            }elseif($row['cp']=='1'){
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto'] + $altura; // calcular alto del vidrio
            }else{
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto']; // calcular alto del vidrio
            }
             

            // $tvb = ($alb + $row['var1']) / $row['divisor'];
//             $tv2b = ($al2b + $row['var2']) / $row['divisor_alto'];
             
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
               // $an2b = $tvb - $n;
            }else{
                $n = 0;
                $an2 = $tv;
                //$an2b = $tvb;
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
              $metro_cuadrado +=$metro_t;
              
         $porc = $porcv;
         $gttotal_costo_vidrio = 0;
         $gttotal_despe_vidrio = 0;
         $gtpeso_vidrio = 0;
         
         if(1==$row['pertenece']){
         if($traz_vid!=0){
             
                  $idvidrio = $id_vidrio; // espesor del vidrio
                  $idvidrio2 = $id_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id_vidrio4; // espesor del vidrio
                  $traz_vid = $traz_vid;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
  
             
         }
         }
         if(2==$row['pertenece']){
         if($traz_vid2!=0){
                  $idvidrio = $id2_vidrio; // espesor del vidrio
                  $idvidrio2 = $id2_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id2_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id2_vidrio4; // espesor del vidrio
                  $traz_vid = $traz_vid2;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         }
         if(3==$row['pertenece']){
         if($traz_vid3!=0){
                  $idvidrio = $id3_vidrio; // espesor del vidrio
                  $idvidrio2 = $id3_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id3_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id3_vidrio4; // espesor del vidrio
                  $traz_vid = $traz_vid3;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         }
         if(4==$row['pertenece']){
         if($traz_vid4!=0){
                   $idvidrio = $id4_vidrio; // espesor del vidrio
                  $idvidrio2 = $id4_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id4_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id4_vidrio4; // espesor del vidrio
                  $traz_vid = $traz_vid4;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include '../vistas/cotizacion/trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         }
         

                   $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                   $cu = $cu + 1;
          
  } 
  
  //suma de vidrio
  $costo_total_item += $total_vidsp;
  $costo_total_item_desp += ($total_vidsp / $porcv);
  // echo '<script>alert("precio  vid'.$total_vidsp.' + desp vid '.($total_vidsp / $porcv).'")</script>';
  // calculo de accesorios
    if($horizontales==0){
                    $hori = 0;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 0;
                }else{
                    $vert = $verticales;
                }
     $request_acE=mysqli_query($conexion,"SELECT *,c.id_referencia as ref FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." order by b.para");
  $total2=0;
        $tac = 0;$tacfom = 0;
        $peso_acc=0;
        $costo_total_acc=0; 
        $costo_desp_acc = 0;

  while($row=mysqli_fetch_array($request_acE))
  {      
           $referencia_material = $row['ref']; 
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
            if($rowz["id_referencia_med"]=='90001'){
                $al = $alto;
            }else if($rowz["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowz["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowz["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowz["id_referencia_med"]."");
                $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
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
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
                
            if($row["lado"]=='Vertical'){
                 $canfach = $vert;
                 $ambos_alto = $row["ambos"] * ($alto / 1000)*$vert;
                 $ambos_ancho = 0;
             }else{
                 $canfach = $hori;
                 $ambos_alto = 0;
                 $ambos_ancho = $row["ambos"] * ($ancho / 1000)*$hori;
             }
             if($row["multiplica"]=='Si'){
                 $canfach = $canfach;
                  $ambos = $row["ambos"];
             }else{
                 $canfach = 1;
                  $ambos = 1;
             }
             if($row['fija']==1){
                 if($row["lado"]=='Vertical'){
                    $medidalado = ($alto/1000);
                 }else{
                    $medidalado = ($ancho/1000);
                 }
                 if($row["yes"]=='Si'){
                    $metro = $row["metro"];
                     $res = $row["cantidad_acc"]*($medidalado/$row["metro"])*$row["med"]*$ambos;
                 }else{
                    $metro = 1;
                    $res = $row["cantidad_acc"]*($row["med"]/1000);
                 }
                  //$res = $row["cantidad_acc"]*($medidalado/$row["metro"])*$row["med"]*$ambos;
             }else{
             if($row['calcular']=='ML'){
               
               $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$row["cantidad_acc"] + $ambos_alto +$ambos_ancho;
            }ELSE{
                if($row['calcular']=='M2'){
                      $res = (($ancho / 1000)) * (($alto/1000))* $row["cantidad_acc"]*$canfach;
                }else{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = (($row["cantidad_acc"]*$alto) / $row["metro"])*$canfach*$ambos;
                     }else{
                         $res = (($row["cantidad_acc"]*$ancho) / $row["metro"])*$canfach*$ambos;
                     }             
                 }else{
                      $res = $row["cantidad_acc"]*$canfach*$ambos;
                 }            
             }}
             }//se  quito }
             $taa = $cant_rej * $res;
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
             if($dolar_actual==0){
                $costo = $row["costo_mt"];
            }else{
                 $queryx1 = mysqli_query($conexion,"select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='".$referencia_material."' and b.categoria!='vidrio' ");
                 $Co = mysqli_fetch_array($queryx1);
                 $costo = $Co["precio_actual"];
            }
            if($pelicula!='No Aplica' && $row['codigo']=='26044'){ 
            if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; }          
            $tac = $tac + (($taa * $v) *($costo/$porcacc)*$m*$cant_item + $a);   
            $tacfom = $tacfom + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            (($taa * $v) *($costo/$porcacc)*$m*$cant_item + $a); 
            $taa = $taa * $v;
            ////echo $pelicula;
            }
            if($row['codigo']!='26044'){ 
            $tac = $tac + ($taa * ($costo/$porcacc) * $m * $cant_item + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
             
             $costo_total_acc +=($taa*($costo)*$m*$cant_item + $a);
             $costo_desp_acc += ($taa*($costo/$porcacc)*$m*$cant_item + $a);
          
               
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
      if($dolar_actual==0){
          $costo = $row["costo_mt"];
      }else{
           $queryx = mysqli_query($conexion,"select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='$rollo' and b.categoria!='vidrio' ");
           $o = mysqli_fetch_array($queryx);
           $costo = $o["precio_actual"];
      }
      $mt2 = (($alto/1000)*($ancho/1000)) * $cantlam;
      $cos_und = $costo * $mt2;
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
  
    $request_kits=mysqli_query($conexion,"SELECT * FROM receta_kits where idkit in ('$cierres','$rodajas','$idespaciador','$brazos') ");
       
  while($rowt = mysqli_fetch_array($request_kits)){
  
      if($rowt["modulo"]=='Cierres'){
          $cankitt = $cancierres;
      }else if($rowt["modulo"]=='Espaciadores'){
          $cankitt = $canespaciador;
      }else if($rowt["modulo"]=='Brazos'){
          $cankitt = $canbrazos;
      }else{
          $cankitt = $canrodajas;
      }
       $request_kitsi=mysqli_query($conexion,"SELECT * FROM receta_kits_items where idkit in ('".$rowt['idkit']."') ");
       
  while($row = mysqli_fetch_array($request_kitsi)){
      
          $cankit = $cankitt*$row["cantidad"];
     
          if($dolar_actual==0){
          $querypro = mysqli_query($conexion,"select costo_mt from referencias where codigo='".$row['codigo_pro']."'  ");
           $v = mysqli_fetch_array($querypro);
          $costo = $v[0];
      }else{
           $queryx = mysqli_query($conexion,"select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.cod_ref='".$row['codigo_pro']."' and b.categoria!='vidrio' ");
           $o = mysqli_fetch_array($queryx);
           $costo = $o["precio_actual"];
      }
      
      $can_tot = $cankit * $cant_item;
      $cos_und = $costo;
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

$costo_total_item += $tac_p;
$costo_total_item_desp += $tacc;
//echo '<script>alert("precio  $tacc '.$tacc.' + desp acc '.$cancierres.','.$canrodajas.','.$canespaciador.'")</script>';
// calculo de mano de obras

$request_maq=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$id_referencia);
  
        $tot=0;$tot_fom=0;
        $total_fab = 0;
        $total_ins=0;
        $polip = 0;
  while($row=mysqli_fetch_array($request_maq))
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
                
                if($pelicula!='No Aplica' && $row['referencia']=='26002'){
                    if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                  
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
                             $tarp = $tar * $v;
                             $polip += $tarp;
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
                         $polip += $tar;
                     }else{
                         $total_ins += $tar; 
                     } 
                 }
            }
           // echo '<script>alert("mano:'.$install.' '.$tar.' '.$pelicula.' ref '.$row['referencia'].' '.$id_items.' ")</script>';
               
  } 
  
  // suma de mano de obra
  $ser = 0;
$costo_total_item += $tot * 1.45;
$costo_total_item_desp += $tot * 1.45;
$ser += ($tot * 1.45);

// echo '<script>alert("precio  moo  + desp moo  '.($tot * 1.45).'")</script>';
 
// calculo de servicios
$request2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cot_mas=".$id_cotizacion." ");
 $total2s=0;
        $to_serv =0;
	while($row2=mysqli_fetch_array($request2))
	{    
            
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["precio_servicio"]*$cant_item);
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd;
               
	} 
    // suma  de servicios    
 $costo_total_item += $to_serv;
 $costo_total_item_desp += $to_serv * 1.45;
 $ser += ($to_serv * 1.45);
 
  $total_ins += $to_serv;
 //echo '<script>alert("costo '.($to_serv).' desp: '.($to_serv * 1.45).' ")</script>';
 // calculo de elementos adicionales
 // echo '<script>alert("precio  moo  + desp moo 2 '.($to_serv * 1.45).'")</script>';
 
 $request_ack=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_cot=".$id_cotizacion."  ");
          $t=0;
          $total2ak=0;
          $cb=0;
  while($row=mysqli_fetch_array($request_ack))
  {       $t = $t +1;
            
                
                
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
                $pp = $row["costo_mt"]/$porca;
                $total2ak= $total2ak + $mt*$pp;
                $cb += $row["costo_mt"] * $mt;
  
                         
  }  
  
  //suma de de adicionales
 $cbb = $total2ak;
 $costo_total_item += $cb;
 $costo_total_item_desp += $cbb; 
 
 $costo_adicional = $cb*$cant_item;

 
 //calculo de kits
 //echo '<script>alert("adicionales  $cb '.($cb).' + desp moo '.($cbb).'")</script>';
 
 $request4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_prod_mas=".$id_cotizacion." and b.comp='1'  ");

        $t2e=0;
        $to_kk =0;   
        $ksp = 0;    
  while($row21k=mysqli_fetch_array($request4))
  {       
  
            $t2e= $t2e + 1;
            include '../modelo/suma_kit_1.php';
            
             $desm = ($row21k['desc_k']/100) * ($ktotk);
             $ddm = ($ktotk + $desm) / $porcacc;
             $to_kk = $to_kk + $ddm;
             $ksp += $ktotk;
            
  } 
  $costo_kit =$ksp*$cant_item;
 
  // suma de kits
  $costo_total_item += $ksp*$cant_item;
 $costo_total_item_desp += $to_kk*$cant_item;  
 //echo '<script>alert("precio  $ksp '.($ksp).' + desp $to_kk '.($to_kk).'")</script>';
 include 'calculo_planilla.php';
 
 $precio_venta_total;
 $total = $costo_total_item_desp;
 $totalfom_sinp = $costo_total_item;

//guardar costo de aluminio
// borra todos los costos de ese item 
//echo '<b>Costo Total de aluminio '.number_format($costo_aluminio).' </b>';
 if($id_comp!=0){
 $query_c = mysqli_query($conexion,"select cantidad_c from cotizaciones where id_cotizacion='$id_comp'");
 $cc= mysqli_fetch_array($query_c);
      $ctcomp = $cc[0];
 }else{
     $ctcomp = 1;
 }
//aluminio
 $costo_aluminio = $costo_aluminio*$ctcomp;
 $total_vidsp = $total_vidsp*$ctcomp;
 $tacc = $tac_p*$ctcomp;
 $total_fab = $total_fab*$ctcomp;
 $total_ins = $total_ins*$ctcomp;
 $polip = $polip*$ctcomp;
 
 
 
   $aluminiox = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cotizaciones='".$id_cotizacion."' and tipo_costo='Aluminio' and id_cotizacion_mas=0 ");
   $atr = mysqli_fetch_row($aluminiox);
   if($atr[0]==0){
      $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
               . " values ('".$cot."','".$id_cotizacion."','Aluminio','Ml','".$costo_aluminio."','$poralu','0','$peso_perfiles','$id_comp') ") ;
   }
   
   $acero = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cotizaciones='".$id_cotizacion."' and tipo_costo='Acero' and id_cotizacion_mas=0 ");
   $ac = mysqli_fetch_row($acero);
   if($ac[0]==0){
      $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
               . " values ('".$cot."','".$id_cotizacion."','Acero','Ml','".$costo_ace."','$porcace','0','$peso_acero','$id_comp') ") ;
   }
   
//echo 'error '.$ver;
 //inserta los costos de vidrios
  $vidriosx = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cotizaciones='".$id_cotizacion."' and tipo_costo='Vidrio' and id_cotizacion_mas=0 ");
                       $av = mysqli_fetch_row($vidriosx);
                       if($av[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
                                   . " values ('Vidrios','".$cot."','".$id_cotizacion."','Vidrio','M2', '$metro_cuadrado' ,'".($total_vidsp)."','$porvid','0','$peso_vid','$id_comp') ") ;
                       }
 // guardar costo de vidrios 
                       
 $accesoriosx = mysqli_query($conexion,"select count(id_cot) from costo_totales where  id_cotizaciones='".$id_cotizacion."' and tipo_costo='Accesorios' and id_cotizacion_mas=0 ");
                       $aa = mysqli_fetch_row($accesoriosx);
                       if($aa[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
                                   . " values ('Acesorios','".$cot."','".$id_cotizacion."','Accesorios','Und', '0' ,'$tacc','$poracc','0','0','$id_comp') ") ;
                       }
 
 //guardar costos de accesorios
 
                       if($total_fab!=0 || $total_ins!=0 || $costo_adicional!=0){
                       $fabricacion = mysqli_query($conexion,"select count(id_cot) from costo_totales where  id_cotizaciones='".$id_cotizacion."' and tipo_costo='Fabricacion' and id_cotizacion_mas=0 ");
                       $aa1 = mysqli_fetch_row($fabricacion);
                       if($aa1[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
                                   . " values ('','".$cot."','".$id_cotizacion."','Fabricacion','Und', '0' ,'$total_fab','0','0','0','$id_comp') ") ;
                       }
                       $instalacion = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cotizaciones='".$id_cotizacion."' and tipo_costo='Instalacion' and id_cotizacion_mas=0 ");
                       $aa2 = mysqli_fetch_row($instalacion);
                       if($aa2[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
                                   . " values ('','".$cot."','".$id_cotizacion."','Instalacion','Und', '0' ,'$total_ins','0','0','0','$id_comp') ") ;
                       }
                       $polim = mysqli_query($conexion,"select count(id_cot) from costo_totales where  id_cotizaciones='".$id_cotizacion."' and tipo_costo='Polimask' and id_cotizacion_mas=0 ");
                       $aa3 = mysqli_fetch_row($polim);
                       if($aa3[0]==0){
                          $ver =  mysqli_query($conexion,"insert into costo_totales (vidrios,id_cot,id_cotizaciones, tipo_costo,unidad_med,medidas_totales,costo_totales,porcentajes, cantidades_totales,peso_totales,id_cotizacion_mas)"
                                   . " values ('','".$cot."','".$id_cotizacion."','Polimask','Und', '0' ,'$polip','0','0','0','$id_comp') ") ;
                       }
                          $adicional = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cotizaciones='".$id_cotizacion."' and tipo_costo='Adicional' and id_cotizacion_mas=0 ");
                        $at = mysqli_fetch_row($adicional);
                       
                        if($at[0]==0){
                           $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                    . " values ('".$cot."','".$id_cotizacion."','Adicional','Und','".($costo_adicional)."','$poracc','0','0') ") ;

                        }
                        
                        $query_kit = mysqli_query($conexion,"select count(id_cot) from costo_totales where id_cotizaciones='".$id_cotizacion."' and tipo_costo='Kits' and id_cotizacion_mas=0 ");
                           $atk = mysqli_fetch_row($query_kit);
                           if($atk[0]==0){
                              $ver =  mysqli_query($conexion,"insert into costo_totales (id_cot,id_cotizaciones, tipo_costo,unidad_med,costo_totales,porcentajes, cantidades_totales,peso_totales)"
                                       . " values ('".$cot."','".$id_cotizacion."','Kits','Und','".($costo_kit)."','$porcacc','0','0') ") ;
                           }
}
 
 //guardar costos de mano de obra
 
 
 //guardar costos