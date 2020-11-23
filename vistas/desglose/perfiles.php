<?php

 $resu = mysqli_query($conexion,"select * from cotizacion where id_cot = '".$_GET['cot']."'  ");
                $c = mysqli_fetch_array($resu);
                $num = $c['numero_cotizacion'].'.'.$c['version'];

                $solicitudes = mysqli_query($conexion,"select count(id_cot) from desgloses_material where id_cot='".$_GET['cot']."' and linea='Perfileria' ");
                $s = mysqli_fetch_array($solicitudes);
                
               $reques=mysqli_query($conexion,"SELECT * FROM cotizaciones where id_compuesto=0 and id_cot=".$_GET["cot"]." and linea_cot not in ('Acero') and estado_item='' ORDER BY fila ASC ");
               $contador=0;
	       while($rowp=mysqli_fetch_array($reques)){
            
               
               $_GET['item']= $rowp["id_cotizacion"];
               include '../cotizacion/consultar_item.php';
               $tip= $rowp["tip"];
               echo '<tr style="background:#E4E935">'
                    . '<td>'.$s[0].' '.$tip.'</td><td colspan="13">'.$producto.' | '.$color.' | Cant: '.$cant_item.' </td>'
                    . '';
            $cantidad_pricipal = $cant_item;
                        
            $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
            $descuento_riel = 0;
              $descuento_alfa = 0;
            while($row=mysqli_fetch_array($request))
            {   
                $contador++;
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
            $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
            $precio_actual= $fia["precio_actual"];
            $perimetro = $row["area"]/1000;
            $sumaperfil = $row["sumaperfil"];
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

            include '../cotizacion/formula_perfil.php';
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
            $medida = $med_perfil-$deto-$detoa+$sumaperfil;
            $cantidad = $row['cantidad']*$cant_item*$canfac;
            
            include '../cotizacion/costopintura.php';
                 
            $n=1000;
            
            
            $pst = (($row['peso'] * $medida) / 1000)*$cantidad;
            
            if($row['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
            }
            
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
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
            }
            
            
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            //$peso_perfiles += $pst;
            if($row['grupo']=='Perfileria Acero'){
                $peso_acero += $pst;
            }else{
                $peso_perfiles += $pst;
            }
            $result23 = mysqli_query($conexion,"select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                     $entro = 'perfil no';
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    $entro = 'perfil si';
                 }
                  if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                   $mystring = $row['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $row['descripcion'];
                    } else {
                        $descripcion = substr($row['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
           
            echo '<tr><td width="10%" title="'. $med_perfil.'-'.$deto.'-'.$detoa.'">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$row['codigo'].'"></td>
            <td width="40%">'.$row['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$row['referencia'].'" disabled></td> 
            <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$row['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$row['dado'].'</a></td>
                <td width="10%">'.$row['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
  } 
   
     
         $sql_alf = mysqli_query($conexion,"SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
              $descuento_riel = 0;
              $descuento_alfa = 0;
              
              while($sa = mysqli_fetch_array($sql_alf)){
                       $contador++;
                        if($sa['grupo']=='Perfileria Acero'){
                            $peso_acero += $pst*$cantidad;
                        }else{
                            $peso_perfiles += $pst*$cantidad;
                        }
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
                        

                        include 'costopintura.php';

                        $n=1000;


                        $medtotal = $medida*$cantidad;
                        $perfiles = $medtotal / 6000;
                      if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      $mystring = $sa['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $sa['descripcion'];
                    } else {
                        $descripcion = substr($sa['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 

                      
                        
                        
            echo '<tr><td width="10%" title="">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$sa['codigo'].'"></td>
            
            <td width="40%">'.$sa['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$sa['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$sa['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
           
                  
              }
              $medida =0;
              $request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
              while($rowrej=mysqli_fetch_array($request_rej))
  {     
                  $sumaperfil=$rowrej["sumaperfil"];
                     $pdlr = "select * from dolar_relaciones where id_referencia=".$rowrej['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
             $precio_actual = $fia["precio_actual"];
             
                   if($rowrej["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($rowrej["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowrej["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowrej["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{ 
                $sqlxu=mysqli_query($conexion,"SELECT * FROM producto_rep_alu  where id_p=".$id_referencia." and id_r_a='".$rowrej["id_referencia_med"]."' ");
                $fil_antw =mysqli_fetch_array($sqlxu);
                $id_p= $fil_antw["id_p"];

                 $nw_medida = $fil_antw['medida_r_a'];
                $nw_lado = $fil_antw['lado'];
                $nw_var1 = $fil_antw['descuento'];
                $nw_ope = $fil_antw['signo'];
                $nw_var2 = $fil_antw['variable'];
                $nw_cant = $fil_antw['cantidad'];
                $nw_div = $fil_antw['division'];
                $altura_v_c = $altura_v_c; // altura ventana corrediza
                $altura = $altura;// altura cuerpo fijo
                $anchura = $anchura; //ancho cuerpo fijo
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;
                $rtt = '"'.$nw_medida.' '.$nw_lado.' '.$nw_ope.'"';
//                if($rowrej["id_referencia_med"]=='20847'){
//                 echo '<script>console.log('.($med_perfil+1).');</script>';
//                }
                include '../../vistas/version2/productos/formula_perfil.php';
                
                $al = $med_perfil;
            }

       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$rowrej["medida_rej"]." ");
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
          
         
             if($rowrej["medida_rej"]==0 || $rowrej["medida_rej"]==999994){
                $medrej = ($ancho + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999999){
                $medrej = ($alto + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999998){
                $medrej = ($altura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999997){
                $medrej = ($altura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999995){
                $medrej = ($anchura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                $medrej = ($tvR + $rowrej["varr"]) / $rowrej["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
            $tv2 = ($al / $rowrej['var3']) * $rowrej['multiplo'];
          //parte nueva del cobro del anonisado
            $perimetro = $rowrej["area"]/1000;
           if($perimetro=='0'){
                $valor_acabado = $vc;
           }else{
               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
           }
            
            
            $pst_rej = (($rowrej['peso'] * ($medrej/1000)))*$tv2*$cant_item;
            $peso_rej = $peso_rej + $pst_rej;
            $contador++;
            if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      
        
                    $mystring = $rowrej['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowrej['descripcion'];
                    } else {
                        $descripcion = substr($rowrej['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10);    
                    $car = ($tv2)*$cant_item;
                    // 9 + 9 = 18
                        
            echo '<tr><td width="10%" title="'.$rowrej["id_referencia_med"].' '.$al .'/'. $rowrej['var3'].' *'. $rowrej['multiplo'].'">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$rowrej['codigo'].'"></td>
            
            <td width="40%">'.$rowrej['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['sistema'].'" disabled></td>
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medrej.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.($car).'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">R'.$contador.' '.$check.'</td>'
            . '</tr>';   
                         
  } 
            $request_aca=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_cot=".$rowp['id_cotizacion']."  and grupo='Perfileria'   ");
                
	while($rowac=mysqli_fetch_array($request_aca))
	{       $ci++;
          
                //$mult= (100-$porca)/100;
                if($rowac["med"]==1){
                    $v = 1;
                }else{
                    $v = $rowac["med"]/1000;
                }
                if($rowac["calcular"]=='ML'){
                if($rowac["lado"]=='Vertical'){
                    $mt = $rowac["cantidad_m"] * ($rowac["med"]/1000);
                    $mte =  $rowac["cantidad_m"] *($rowac["med"]/1000);
                }else{
                    $mt = $rowac["cantidad_m"] * ($rowac["med"]/1000);
                    $mte = $rowac["cantidad_m"] * ($rowac["med"]/1000);//($ancho/1000)*
                }
                }else{
                    $mt = $rowac["cantidad_m"];
                    $mte = $rowac["cantidad_m"] * $v;
                }
                //$pp = $rowac["costo_mt"]/$mult;
                $valora = $rowac["costo_mt"] * $mte;
                $contador++;
                //$total2= $total2 + ($mte * $pp);
         if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                  $medida = $rowac["med"]*$rowac["cantidad_m"];
                  
                   $result23 = mysqli_query($conexion,"select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                     $entro = 'perfil no';
                 }else{
                    //2.paso
                    $canper = ceil($rowac["cantidad_m"] /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    $entro = 'perfil si';
                 }
                 
             echo '<input type="hidden" id="itema'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'

                      . '<input type="hidden" id="cola'.$contador.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="meda'.$contador.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["cantidad_m"].'">'
                      . '';
                echo '<tr>'
                    . '<td><input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["codigo"].'">*</td>'
                    . '<td>'.$rowac['descripcion'].'</td>'
                        . '<td><input type="text" id="ref'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["referencia"].'"></td>'
                         . '<td><input type="text" id="sis'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["sistema"].'"></td>'
                         . '<td><input type="text" id="col'.$contador.'" style="width:60px;text-align:center" value="'.$codcol.'"></td>'
                    . '<td>'.$rowac["dado"].' </td><td>-</td>'
                        . '<td><input type="text" id="med'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["med"].'"></td>'
                        . '<td>-</td><td> <input type="text" id="und'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["cantidad_m"].'"></td>'
                        . '<td><input type="text" id="medt'.$contador.'" style="width:60px;text-align:center" value="'.$medida.'"></td>'
                    . '<td><input type="text" id="can'.$contador.'" style="width:60px;text-align:center" value="'.$canper.'">'
                        . '<td><input type="text" id="per'.$contador.'" style="width:60px;text-align:center" value="'.$perfil.'">'
                    . '<td>'.$contador.' '.$check.'</td></tr>';   
          
		
               
	} 
            $reques_comp=mysqli_query($conexion,"SELECT * FROM cotizaciones where id_compuesto='".$rowp["id_cotizacion"]."' and id_cot=".$_GET["cot"]." and linea_cot not in ('Vidrio','Acero')  ORDER BY fila ASC ");
              
	       while($rowc=mysqli_fetch_array($reques_comp)){
            
           
               $_GET['item']= $rowc["id_cotizacion"];
               include '../cotizacion/consultar_item.php';
               $tip= $rowp["tip"];
               
               $cant_item = $cant_item *$cantidad_pricipal;
               echo '<tr style="background:#F9FBE2">'
                    . '<td>-Compuesto- '.$tip.'</td><td colspan="13">'.$producto.' | '.$color.' | Cant: '.$cant_item.' </td>'
                    . '';
               
                $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
            
            while($row=mysqli_fetch_array($request))
            {   
                $contador++;
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

            include '../cotizacion/formula_perfil.php';
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
            
            include '../cotizacion/costopintura.php';
                 
            $n=1000;
            
            
            $pst = (($row['peso'] * $medida) / 1000)*$cantidad;
            
            if($row['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
            }
            
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
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
            }
            
            
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            //$peso_perfiles += $pst;
            if($row['grupo']=='Perfileria Acero'){
                $peso_acero += $pst;
            }else{
                $peso_perfiles += $pst;
            }
            $result23 = mysqli_query($conexion,"select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    
                 }
                  if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                   $mystring = $row['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $row['descripcion'];
                    } else {
                        $descripcion = substr($row['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
           
            echo '<tr><td width="10%" title="">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$row['codigo'].'"></td>
            
            <td width="40%">'.$row['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$row['referencia'].'" disabled></td> 
            <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$row['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$row['dado'].'</a></td>
                <td width="10%">'.$row['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
  } 
   
     
         $sql_alf = mysqli_query($conexion,"SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
           
              while($sa = mysqli_fetch_array($sql_alf)){
                       $contador++;
                        if($sa['grupo']=='Perfileria Acero'){
                            $peso_acero += $pst*$cantidad;
                        }else{
                            $peso_perfiles += $pst*$cantidad;
                        }
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

                        include 'costopintura.php';

                        $n=1000;


                        $medtotal = $medida*$cantidad;
                        $perfiles = $medtotal / 6000;
                      if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      $mystring = $sa['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $sa['descripcion'];
                    } else {
                        $descripcion = substr($sa['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 

                      $tip= $rowp["tip"];
                        
                        
            echo '<tr><td width="10%" title="">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$sa['codigo'].'"></td>
            
            <td width="40%">'.$sa['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$sa['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$sa['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
           
                  
              }
              
              $request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
              while($rowrej=mysqli_fetch_array($request_rej))
  {     
            $pdlr = "select * from dolar_relaciones where id_referencia=".$rowrej['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysqli_fetch_array(mysqli_query($conexion,$pdlr));
             $precio_actual = $fia["precio_actual"];
            if($rowrej["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($rowrej["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowrej["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowrej["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
             
          
                 $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowrej["id_referencia_med"]."");
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

       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$rowrej["medida_rej"]." ");
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
          
         
             if($rowrej["medida_rej"]==0 || $rowrej["medida_rej"]==999994){
                $medrej = ($ancho + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999999){
                $medrej = ($alto + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999998){
                $medrej = ($altura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999997){
                $medrej = ($altura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999995){
                $medrej = ($anchura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                $medrej = ($tvR + $rowrej["varr"]) / $rowrej["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
            $tv2 = ($al / $rowrej['var3']) * $rowrej['multiplo'];
          //parte nueva del cobro del anonisado
            $perimetro = $rowrej["area"]/1000;
           if($perimetro=='0'){
                $valor_acabado = $vc;
           }else{
               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
           }
            
            
            $pst_rej = (($rowrej['peso'] * ($medrej/1000)))*$tv2*$cant_item;
            $peso_rej = $peso_rej + $pst_rej;
            $contador++;
            if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      
        
                    $mystring = $rowrej['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowrej['descripcion'];
                    } else {
                        $descripcion = substr($rowrej['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10);     
                        
                        $tip= $rowp["tip"];
            echo '<tr><td width="10%" title="">'
                 . '*<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$rowrej['codigo'].'"></td>
            
            <td width="40%">'.$rowrej['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['sistema'].'" disabled></td>
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
                         
  } 
               
               }
            
        }
        
