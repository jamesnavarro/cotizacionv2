<?php
include '../../modelo/conexion.php';
 $resu = mysqli_query($conexion,"select * from cotizacion where id_cot = '".$_GET['cot']."'  ");
                $c = mysqli_fetch_array($resu);
                $num = $c['numero_cotizacion'].'.'.$c['version'];

                $solicitudes = mysqli_query($conexion,"select count(id_cot) from desgloses_material where id_cot='".$_GET['cot']."' and linea='Accesorios'  ");
                $s = mysqli_fetch_array($solicitudes);
                
               $reques=mysqli_query($conexion,"SELECT * FROM cotizaciones where id_compuesto=0 and id_cot=".$_GET["cot"]." and linea_cot not in ('Acero')  and estado_item=''  ORDER BY fila ASC ");
               $ci=0;
               
	       while($rowp=mysqli_fetch_array($reques)){
               
           
               $_GET['item']= $rowp["id_cotizacion"];
               include '../cotizacion/consultar_item.php'; 
              
               echo '<tr style="background:#E4E935">'
                    . '<td>'.$tip.'</td><td colspan="6">'.$producto.' | '.$color.' | Cant: '.$cant_item.' </td>';
               $cantidad_pricipal = $cant_item;
                   $request_acE=mysqli_query($conexion,"SELECT *,c.id_referencia as refer FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." order by b.para");

        $peso_acc=0;
        $costo_total_acc=0;
        $costo_desp_acc = 0;
        
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

  while($row=mysqli_fetch_array($request_acE))
  {      
                $referencia_material = $row['refer']; 
    //--------------------------------------------------------------------
                
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_rej=".$row['can_rej']." ");
    $rowz=mysqli_fetch_array($request_v2);

             if($rowz["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($rowz["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowz["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowz["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlxy=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowz["id_referencia_med"]."");
                $fil_an =mysqli_fetch_array($sqlxy);
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
                include '../../vistas/version2/productos/formula_perfil.php';
                $al = $med_perfil;
            }
                $cant_rej = (($al / $rowz['var3']) * $rowz['multiplo']);
  

            }else{
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
                 $canfach = $canfach  ;
                 $ambos = $row["ambos"];
             }else{
                 $canfach = 1;
                 $ambos = 1;
             }
             //formula para calcular medida fijas
             if($row['fija']==1){ 
                 $res = $row["cantidad_acc"]*($row["med"]/1000); // OK
             }else{
                if($row['calcular']=='ML'){

                  $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$row["cantidad_acc"] + $ambos_alto +$ambos_ancho;
                }else{
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
              //echo '<tr><td colspan="7">'.$taa.' =:'.$cant_rej.' * '.$res.'</d>'; solo para pruebas
             if($row["med"]!=1){
                 $m = 1;
                 $f = ($taa*$cant_item);
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
            echo $pelicula;
            }
            if($row['codigo']!='26044'){ 
            $tac = $tac + ($taa * ($costo/$porcacc) * $m * $cant_item + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
             
             $costo_total_acc +=($taa*($costo)*$m*$cant_item + $a);
             $costo_desp_acc += ($taa*($costo/$porcacc)*$m*$cant_item + $a);
             

if($pelicula!='No Aplica' && $row['codigo']=='26044'){    
    $ci++;
    if($s[0]==0){
                    $check = 'P<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                  echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">';             
                echo '<tr><td>*'.$ci.'</td><td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                . '<td width="5%">'.$row['codigo'].' </a></td>'
                        . '<td width="5%">'.$row['referencia'].'</a></td>
                <td width="40%">'.$row['descripcion'].'</td>
               <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
                <td class="hidden-phone">'.$taa.' </font></td>
                <td class="hidden-phone">'.number_format($f,2).''.$row["calcular"].'</td>'
                .'<td  id="msgx'.$ci.'">'.$check.'</td></tr>';   
      }     
  if($row['codigo']!='26044'){   
      $ci++;
         if($s[0]==0){
           $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
         }else{
           $check  = '<img src="../images/autorizacion.png">';  
         }
         echo '<tr><td><input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">';
         
echo  ''.$ci.'</td>'
        . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td><td width="5%"  title="'.$al.' '.$taa.' ='. $cant_rej.' *'. $res.' ; '.$canfach.'">='.$row['codigo'].' </a></td>'
.'<td width="5%">'.$row['referencia'].'</a></td>
<td width="40%">'.$row['descripcion'].' </td>
    <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
<td class="hidden-phone">'.number_format($taa,2).' '.$row["calcular"].'</font></td> 
<td class="hidden-phone">'.number_format($f,2).''.$row["calcular"].'</td>'
        . '<td id="msgx'.$ci.'">'.$check.'</td></tr>';   
      }   
               
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
      
      $mt2 = (($alto/1000)*($ancho/1000)) * $cantlam;
      
      
      if($dolar_actual==0){
          $costo = $row["costo_mt"];
      }else{
           $queryx = mysqli_query($conexion,"select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='$rollo' and b.categoria!='vidrio' ");
           $o = mysqli_fetch_array($queryx);
           $costo = $o["precio_actual"];
      }
      
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
      $ci++;
             if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                   echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">';
                   
                    echo '<tr><td>*='.$ci.'</td>'
                            . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                            . '<td width="5%">'.$row['referencia'].'</a></td>
                    <td width="5%">'.$row['codigo'].'</a></td>
                    <td width="40%">'.$row['descripcion'].'</font></td>
                        <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
                    <td class="hidden-phone">'.$mt2.' M2</td>
                   
                    <td class="hidden-phone">'.$can_tot.' M2</font></td><td>'.$check.'</td></tr>';     

  }
  //24061
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
      $can_tott = $cankitt * $cant_item;
     $modu = $rowt["modulo"];
     if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
      
                    echo '<tr style="color:#86BE8C"><td>*'.$ci.'</td><td width="5%">'.$rowt['idkit'].'</a></td>
                    <td width="5%">'.$rowt['idkit'].'</a></td>
                    <td width="40%" >'.$rowt['descripcion'].'</font></td>
                
                    <td class="hidden-phone">'.$cankitt.' </td>
      
                    <td class="hidden-phone">'.$can_tott.' Und</font></td><td id="msgx'.$ci.'">'.$check.'</td></tr>';  
                    
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
      $ci++;
//     if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
//                  }else{
//                    $check  = '<img src="../images/autorizacion.png">';
//                  }
        echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo_pro"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo_pro"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">';
        
                    echo '<tr><td>++'.$ci.'</td>'
                            . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                            . '<td width="5%">'.$row['codigo_pro'].'</a></td>
                    <td width="5%">'.$row['codigo_pro'].'</a></td>
                    <td width="40%">'.$row['descripcion_pro'].'</font></td>
                        <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value=""></td>
                    <td class="hidden-phone">'.$cankit.' </td>
      
                    <td class="hidden-phone">'.$can_tot.' Und</font></td><td id="msgx'.$ci.'">'.$check.'</td></tr>';  
      
  }              
                    

  }
        
            
            $reques_comp=mysqli_query($conexion,"SELECT * FROM cotizaciones where id_compuesto='".$rowp["id_cotizacion"]."' and id_cot=".$_GET["cot"]." and linea_cot not in ('Vidrio','Acero')  ORDER BY fila ASC ");
              
	       while($rowc=mysqli_fetch_array($reques_comp)){
            
           
               $_GET['item']= $rowc["id_cotizacion"];
               include '../cotizacion/consultar_item.php';
               $cant_item = $cant_item * $cantidad_pricipal;
               echo '<tr style="background:#F9FBE2">'
                    . '<td>-Compuesto-</td><td colspan="6">'.$producto.' | '.$color.' | Cant: '.$cant_item.' </td>';
                 $request_acE=mysqli_query($conexion,"SELECT *,c.id_referencia as refer FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." order by b.para");
  

        $peso_acc=0;
        $costo_total_acc=0;
        $costo_desp_acc = 0;
        
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

  while($row=mysqli_fetch_array($request_acE))
  {      
          $referencia_material = $row['refer']; 
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxy));
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
            $anchura_v_c = $anchura_v_c; //ancho ventana corrediza;
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
                 $ambos_alto = $row["ambos"] * ($alto / 1000)*$vert;
                 $ambos_ancho = 0;
                 
             }else{
                 $canfach = $hori;
                 $ambos_alto = 0;
                 $ambos_ancho = $row["ambos"] * ($ancho / 1000)*$hori;
             }
             if($row["multiplica"]=='Si'){
                 $canfach = $canfach  ;
                 $ambos = $row["ambos"];
             }else{
                 $canfach = 1;
                 $ambos = $row["ambos"];
             }
             //formula para calcular medida fijas
             if($row['fija']==1){
                 $res = $row["cantidad_acc"]*($row["med"]/1000);
             }else{
                if($row['calcular']=='ML'){

                  $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$row["cantidad_acc"] + $ambos_alto +$ambos_ancho;
                }else{
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
                 $f = ($taa*$cant_item);
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
            //echo $pelicula;
            }
            if($row['codigo']!='26044'){ 
            $tac = $tac + ($taa * ($costo/$porcacc) * $m * $cant_item + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
             
             $costo_total_acc +=($taa*($costo)*$m*$cant_item + $a);
             $costo_desp_acc += ($taa*($costo/$porcacc)*$m*$cant_item + $a);
             
        
if($pelicula!='No Aplica' && $row['codigo']=='26044'){     
    $ci++;
             if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                  
                  echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">';
                  
echo '<tr><td>'.$ci.'</td>'
        . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
        . '<td width="5%">'.$row['referencia'].'</a></td>
<td width="5%">'.$row['codigo'].' </a></td>
<td width="40%">'.$row['descripcion'].'</td>
<td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
<td class="hidden-phone">'.$taa.' </font></td>
<td class="hidden-phone">'.number_format($f,2).''.$row["calcular"].'</td><td id="msgx'.$ci.'">'.$check.'</td></tr>';   
      }     
  if($row['codigo']!='26044'){   
      $ci++;
             if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                  
                                 echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$f.'">';
                                 
                    echo  '<tr><td>'.$ci.'</td>'
                            . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                            . '<td width="5%">' .$row['referencia'].'</a></td>
                    <td width="5%">'.$row['codigo'].'</a></td>
                    <td width="40%">'.$row['descripcion'].' x '.$canfach.'</td>
                        <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
                    <td class="hidden-phone">'.number_format($taa,2).' '.$row["calcular"].'</font></td>
                    <td class="hidden-phone">'.number_format($f,2).''.$row["calcular"].'</td><td id="msgx'.$ci.'">'.$check.'</td></tr>';   
                          }   
               
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
      
      $mt2 = (($alto/1000)*($ancho/1000)) * $cantlam;
      
      
      if($dolar_actual==0){
          $costo = $row["costo_mt"];
      }else{
           $queryx = mysqli_query($conexion,"select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='$rollo' and b.categoria!='vidrio' ");
           $o = mysqli_fetch_array($queryx);
           $costo = $o["precio_actual"];
      }
      
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
      $ci++;
             if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                  
                   echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">';
                                 
                    echo '<tr><td>'.$ci.'</td>'
                            . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                            . '<td width="5%">'.$row['referencia'].'</a></td>
                    <td width="5%">'.$row['codigo'].'</a></td>
                    <td width="40%">'.$row['descripcion'].'</font></td>
                        <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
                    <td class="hidden-phone">'.$mt2.' M2</td>
            
                    <td class="hidden-phone">'.$can_tot.' M2</font></td><td id="msgx'.$ci.'">'.$check.'</td></tr>';     

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
      $can_tott = $cankitt * $cant_item;
     $modu = $rowt["modulo"];
     $ci++;
     if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
      
                   echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$can_tott.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$can_tott.'">';
                   
                    echo '<tr style="color:#86BE8C"><td>kit'.$ci.'</td>'
                            . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                            . '<td width="5%">'.$rowt['idkit'].'</a></td>
                    <td width="5%">'.$rowt['idkit'].'</a></td>
                    <td width="40%">'.$rowt['descripcion'].'</font></td>
                <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value="'.$row["colores"].'"></td>
                    <td class="hidden-phone">'.$cankitt.' </td>
      
                    <td class="hidden-phone">'.$can_tott.' Und</font></td><td id="msgx'.$ci.'">'.$check.'</td></tr>';  
                    
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
     $ci++;
      if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                     echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo_pro"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$row["codigo_pro"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$can_tot.'">';
                     
                    echo '<tr><td>'.$ci.'</td>'
                            . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                 . '<td width="5%">'.$row['codigo_pro'].'</a></td>
                    <td width="5%">'.$row['codigo_pro'].'</a></td>
                    <td width="40%">'.$row['descripcion_pro'].'</font></td>
                        <td><input type="text" id="coloa'.$ci.'" style="width:60px;text-align:center" value=""></td>
                    <td class="hidden-phone">'.$cankit.' </td>
                    <td class="hidden-phone">'.$can_tot.' Und</font></td>'
                  . '<td id="msgx'.$ci.'">'.$check.'</td></tr>';  
      
  }              
                    

  }
               
              
               }
              $request_aca=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_cot=".$rowp['id_cotizacion']."  and grupo='Accesorios'   ");
                
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
                
                //$total2= $total2 + ($mte * $pp);
                  if($s[0]==0){
                     $check = '<input type="checkbox" id="'.$ci.'" name="item3" checked>';
                  }else{
                     $check  = '<img src="../images/autorizacion.png">';
                  }
             echo '<input type="hidden" id="itema'.$ci.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                      . '<input type="hidden" id="coda'.$ci.'" style="width:60px;text-align:center" value="'.$rowac["codigo"].'">'
                      . '<input type="hidden" id="refa'.$ci.'" style="width:60px;text-align:center" value="'.$rowac["referencia"].'">'
                      . ''
                      . '<input type="hidden" id="meda'.$ci.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$ci.'" style="width:60px;text-align:center" value="'.$rowac["cantidad_m"]*$cantidad_pricipal.'">'
                      . '<input type="hidden" id="cana'.$ci.'" style="width:60px;text-align:center" value="'.$rowac["cantidad_m"]*$cantidad_pricipal.'">';
                echo '<tr><td>*'.$ci.'</td>'
                        . '<td><input type="text" id="tipoa'.$ci.'" style="width:60px;text-align:center" value="'.$tip.'"></td>'
                    . '<td>'.$rowac['codigo'].'</td>'
                    . '<td>'.$rowac["referencia"].'</td>'
                    . '<td>'.$rowac['descripcion'].'</td>'
                    . '<td>'.$rowac["cantidad_m"]*$cantidad_pricipal.' </td>'
                    . '<td>'.($rowac["med"]*$cantidad_pricipal).' '.$rowac["calcular"].''
                    . '<td>'.$check.'</td></tr>';   
          
		
               
	} 
        }
       
