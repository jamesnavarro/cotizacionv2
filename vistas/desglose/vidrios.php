<table style="width:100%">
    <tr>
        <th>ITEMS</th>
        <th>CODIGO</th>
        <th>ID VIDRIO</th>
        <th>TIPO</th>
        <th>DESCRIPCION</th>
        <th>MEDIDA</th>
        <th>ESPESOR</th>
        <th>CANTIDAD</th>
        
        <th>PESO</th>
        <th>AREA</th>
    </tr>
<?php
include '../../modelo/conexion.php';
$solicitudes = mysqli_query($conexion,"select count(id_cot) from desgloses_vidrios where id_cot='".$_GET['cot']."' ");
                $s = mysqli_fetch_array($solicitudes);
                
$reques=mysqli_query($conexion,"SELECT * FROM cotizaciones where id_cot=".$_GET["cot"]."  and estado_item=''  ORDER BY tip ASC ");
               $contador=0;
               $ci = 0;
               $act = 0;
	       while($rowp=mysqli_fetch_array($reques)){
                   $_GET['item']= $rowp["id_cotizacion"];
               include '../cotizacion/consultar_item.php';
            
               //echo ''.$_GET['item'].' |'.$producto.' | '.$color.' | Cant: '.$cant_item.' '.$ancho.'x'.$alto.' <br>';
              
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
    
 
if($request_v){

 
  //Por cada resultado pintamos una linea
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;
        
        $metro_total = 0;
  while($row=mysqli_fetch_array($request_v))
  {      
            
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

            include '../version2/productos/formula_perfil.php';
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

            include '../version2/productos/formula_perfil.php';
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

            include '../version2/productos/formula_perfil.php';
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

            include '../version2/productos/formula_perfil.php';
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
              if($rowp['tip']==''){
                    if($rowp['id_compuesto']!=0){
                          $query_tipo = mysqli_query($conexion,"select tip from cotizaciones where id_cotizacion='".$rowp['id_compuesto']."' ");
                          $tpo = mysqli_fetch_array($query_tipo);
                          //$tip = $tpo[0];
                          mysqli_query($conexion,"update cotizaciones set tip='".$tpo[0]."'  where id_cotizacion='".$rowp['id_cotizacion']."'  ") ;
                          $act++;
                    }else{
                        
                    }
              }
             if($rowp['id_compuesto']!=0){
                 $tt = 'Compuesto del items '.$tip;
             }else{
                 $tt = 'Principal';
             }
    //echo '<span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho: '.number_format($an2).' x Alto: '.number_format($all).',   M<sup>2</sup>: '.number_format($metross,2,',','.').' , Total M<sup>2</sup>: '.number_format($metro_t,2,',','.').'</span><br>';
                
         $porc = $porcv;
         $gttotal_costo_vidrio = 0;
         $gttotal_despe_vidrio = 0;
         $gtpeso_vidrio = 0;
         $metro_total = 0;
         if($traz_vid!=0){
              
//                  $idvidrio = $id_vidrio; // espesor del vidrio
//                  $idvidrio2 = $id_vidrio2; // espesor del vidrio $id_vidrio2
//                  $idvidrio3 = $id_vidrio3; // espesor del vidrio
//                  $idvidrio4 = $id_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  $metro_total +=$metro_t;
                  //include '../cotizacion/trazabilidad_modulos.php';
                  if($id_vidrio!=0){
                      $ci += 1;
                         $idvidrio = $id_vidrio; 
                         $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$idvidrio."'";
                         $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));

                         $espesor= $fi3['espesor_v'];
                         $moneda= $fi3['moneda'];
                         $color_vi= $fi3['color_v'];
                         $peso = $m2 * $espesor * 2.5;

                          $gttotal_costo_vidrio += $total_costo_vidrio;
                          $gttotal_despe_vidrio += $total_despe_vidrio;
                          $gtpeso_vidrio += $peso;
                          
                          $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                   
                  if($gtpeso_vidrio!=0){
                       include 'mostrar_vidrios_td.php';
                  }
                  }
                  if($id_vidrio2!=0){
                         $ci += 1;
                         $s32 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio2."'";
                         $fi32 =mysqli_fetch_array(mysqli_query($conexion,$s32));
                         $idvidrio = $id_vidrio2;
                         $espesor= $fi32['espesor_v'];
                         $moneda= $fi32['moneda'];
                         $color_vi= $fi32['color_v'];
                         $peso = $m2 * $espesor * 2.5;

                          $gttotal_costo_vidrio += $total_costo_vidrio;
                          $gttotal_despe_vidrio += $total_despe_vidrio;
                          $gtpeso_vidrio += $peso;
                          
                          $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                  
                  if($gtpeso_vidrio!=0){
                        include 'mostrar_vidrios_td.php';
                  }
                  }
  
             
         }
         if($traz_vid2!=0){
              $ci += 1;
                  $idvidrio = $id2_vidrio; // espesor del vidrio
                  $idvidrio2 = $id2_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id2_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id2_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid2;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  $metro_total +=$metro_t;
                  //include '../cotizacion/trazabilidad_modulos.php';
                 $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$idvidrio."'";
                 $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));

                 $espesor= $fi3['espesor_v'];
                 $moneda= $fi3['moneda'];
                 $color_vi= $fi3['color_v'];
                 $peso = $m2 * $espesor * 2.5;
               
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso;
                  
                    $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                   
                  if($gtpeso_vidrio!=0){
                      include 'mostrar_vidrios_td.php';
                  }
                  
         }
         if($traz_vid3!=0){
              $ci += 1;
                  $idvidrio = $id3_vidrio; // espesor del vidrio
                  $idvidrio2 = $id3_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id3_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id3_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid3;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  $metro_total +=$metro_t;
                  $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$idvidrio."'";
                 $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));

                 $espesor= $fi3['espesor_v'];
                 $moneda= $fi3['moneda'];
                 $color_vi= $fi3['color_v'];
                 $peso = $m2 * $espesor * 2.5;
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso;
                  
                    $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                   
                  if($gtpeso_vidrio!=0){
                      include 'mostrar_vidrios_td.php';
                  }
         }
         if($traz_vid4!=0){
              $ci += 1;
                   $idvidrio = $id4_vidrio; // espesor del vidrio
                  $idvidrio2 = $id4_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id4_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id4_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid4;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  $metro_total +=$metro_t;
                  $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$idvidrio."'";
                 $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));

                 $espesor= $fi3['espesor_v'];
                 $moneda= $fi3['moneda'];
                 $color_vi= $fi3['color_v'];
                 $peso = $m2 * $espesor * 2.5;
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  
                  $gtpeso_vidrio += $peso;
                  
                    $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                  
                  if($gtpeso_vidrio!=0){
                       include 'mostrar_vidrios_td.php';
                  }
                  
         }
         

                   
          
  } 
  
//   
//  $table = $table.'</table>';'.$cant_item.'
//   
//  echo $table;
                   
        
}

 }
 //echo '<tr><td colspan="5">Actualizacion de items '.$act.'</td><td></td>';
 ?>
</table>