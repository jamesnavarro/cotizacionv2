<?php 
if(isset($_GET['excel'])){
    header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=costo_vs_contable.xls");
}
?>
<!DOCTYPE html>
<?php
include '../modelo/conexion.php';
if(isset($_GET['cot'])){ 
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." order by c.fila asc");

     
if($request){
$strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['cot']."'";
	$pacientes3 = mysqli_query($conexion,$strConsulta3);
	$fila3 = mysqli_fetch_array($pacientes3);
        
         $strConsulta3 = "select * from cont_terceros  where id_ter=".$fila3['id_tercero']."";
	$empresa = mysqli_query($conexion,$strConsulta3);
	$filae = mysqli_fetch_array($empresa);
        $nombre = $filae['nom_ter'];
        $documento =$filae['cod_ter'];
        $telefono =$filae['telfijo_ter'];
        $direccion =$filae['dir_ter'];
        if($fila3['orden']=='0'){$abc = 'COTIZACION No. : ';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PEDIDO No. :';$num = $fila3['orden'];}
}
  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UTILIDAD TEMPLADO VS COSTO CONTABLE PARA BOGOTA  No.<?php echo $num ?></title>
    
    </head>
    <body <?php if(!isset($_GET['excel'])){echo 'onload="window.print()"'; } ?> >

        
<?php 
 
function tabla(){ 
     $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." order by c.tip asc");
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s',time() - 3600*date('I'));
     
if($request){
$strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['cot']."'";
	$pacientes3 = mysqli_query($conexion,$strConsulta3);
	$fila3 = mysqli_fetch_array($pacientes3);
         
        
        
        if($fila3['tipo']=='Empresarial'){
     	
        $strConsulta3 = "select * from sis_empresa  where id_empresa=".$fila3['id_cliente']."";
	$empresa = mysqli_query($conexion,$strConsulta3);
	$filae = mysqli_fetch_array($empresa);
        $nombre = $filae['nombre_emp'];
        $documento =$filae['nit_emp'];
        $telefono =$filae['tel_oficina_emp'];
        $direccion =$filae['direccionr_emp'];
        }else{
       	
        $strConsultap = "select * from sis_contacto  where id_contacto=".$fila3['id_cliente']."";
	$personal = mysqli_query($conexion,$strConsultap);
	$filae = mysqli_fetch_array($personal);
        $nombre = $filae['nombre_cont'].' '.$filae['apellido_cont'];
        $documento =$filae['cedula_cont'];
        $telefono =$filae['tel_oficina'];
        $direccion =$filae['direccionf'];
        }
        if($fila3['orden']=='0'){$abc = 'COT. No. : ';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PED No. :';$num = $fila3['orden'];}
}
    ?>         
        <table class="estilo1" border="0"  cellpadding="0" cellspacing="0">
<tr>
<th ALIGN=left style="color:white">.</th>
<td width="25%" style="color:white">.</td>

   <th ALIGN=left style="color:white">.</th>
<td width="25%" style="color:white">.</td>

</tr>
<tr>

<th ALIGN=left>CLIENTE:</th>
<td width="25%"><?php echo $nombre;  ?></td>

   <th ALIGN=left><?php echo $abc;  ?></th>
<td width="25%"><?php echo $num;  ?></td>

</tr>
<tr>
<th ALIGN=left>C.C ó NIT:</th>
<td width="20%"><?php echo $documento;  ?></td>
<th ALIGN=left>CONTACTO:</th>
<td width="15%"><?php echo $fila3['responsable'];  ?></td>

</tr>
<tr>
<th ALIGN=left>OBRA:</th>
<td width="20%"><?php echo $fila3['obra'];  ?></td>
<th ALIGN=left>ASESOR:</th>
<td width="15%"><?php echo $fila3['registrado'];  ?></td>

</tr>
<tr>
<th ALIGN=left>DIRECCION:</th>
<td width="20%"><?php echo $fila3['ubicacion'];  ?></td>
<th ALIGN=left>VALIDEZ:</th>
<td width="15%"><?php echo '120 dias';  ?></td>

</tr>
<tr>
 <th ALIGN=left>TELEFONO:</th>
<td width="25%"><?php echo $fila3['tel_responsable'];  ?></td>
   <th ALIGN=left>PAGO:</th>
<td><?php echo $fila3['pago'];  ?></td>
</tr>
<tr>
    <th ALIGN=left>IMPRESION: </th><td><?php echo date('Y-m-d').' '.$hora;  ?></td>
 
<th ALIGN=left>REGISTRO:</th>
<td><?php echo $fila3['fecha_reg_c'];  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php    ?> </td>
</tr>
<tr>
    <th ALIGN=left>CIUDAD: </th><td><?php echo $fila3['municipio'].' - '.$fila3['ciudad'];  ?></td>
 
<th ALIGN=left></th>
<td> </td>
</tr>
<tr>

<th ALIGN=left  style="color:white">.</th>
<td width="25%" style="color:white">.</td>

   <th ALIGN=left style="color:white">.</th>
<td width="25%" style="color:white">.</td>

</tr>
</table>
    
<?php  }  ?>       
        
      
     
        
        <?php
	//Por cada resultado pintamos una linea
        $total2=0;
        $tad =0;
      $tad3 =0;
    $cont =0;$es2=0;
   $pag = 0;
       $a1 = 0 * $_GET['col'];
        $a2 = 1 * $_GET['col'];
        $a3 = 2 * $_GET['col'];
       $a4 = 3 * $_GET['col'];
        $aa5 = 4 * $_GET['col'];
        $aa6 = 5 * $_GET['col'];
        $aa7 = 6 * $_GET['col'];
        $aa8 = 7 * $_GET['col'];
        $aa9 = 8 * $_GET['col'];
        $aa10 = 9 * $_GET['col'];
        $CT = 0; $port = 0;
	while($row=mysqli_fetch_array($request))
	{    
                       if($cont==$a1 || $cont==$a2 || $cont==$a3 || $cont==$a4 || $cont==$aa5 || $cont==$aa6 || $cont == $aa7 || $cont==$aa8  || $cont==$aa9 || $cont==$aa10){
                $pag +=1;
//                  echo '<fieldset style="height:670px;">';
               tabla();
             
              $table3 = '<table border="1"  class="estilo2">';
             $table3 = $table3.'<thead >';
              $table3 = $table3.'<tr BGCOLOR="#13173B">';
                  $table3 = $table3.'<th width="4%" style="font-size:8px; color:white">'.'TIPO'.'</h6></th>';  
              $table3 = $table3.'<th width="23%" style="font-size:8px; color:white">'.'DESCRIPCION'.'</th>';
              
              $table3 = $table3.'<th width="8%" style="font-size:8px; color:white">'.'VIDRIO'.'</th>';
               $table3 = $table3.'<th  width="8%" style="font-size:8px; color:white">'.'ANCHO X ALTO'.'</th>';

               $table3 = $table3.'<th  width="3%" style="font-size:8px; color:white">'.'UND'.'</th>';
               $table3 = $table3.'<th  width="7%" style="font-size:8px; color:white">'.'COSTO UND PRESUPUESTO'.'</th>';
                $table3 = $table3.'<th  width="7%" style="font-size:8px; color:white">'.'VLR VENTA UND.'.'</th>';
                $table3 = $table3.'<th  width="8%" style="font-size:8px; color:white">'.'VLR COSTO T. PRESUPUESTADO.'.'</th>';
               $table3 = $table3.'<th  width="10%" style="font-size:8px; color:white">'.'V.TOTAL VENTAS'.'</th>';
                $table3 = $table3.'<th  width="7%" style="font-size:8px; color:white">'.'UTILIDAD'.'</th>';
                 $table3 = $table3.'<th  width="7%" style="font-size:8px; color:white">'.'% UTILIDAD'.'</th>';
             
              $table3 = $table3.'</tr>';
              $table3 = $table3.'</thead>'; 
              }else{
                   $table3 = '<table   border="1"  class="estilo2">';
              }
                
       $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv22 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id3_vidrio']." ";
                $fv3 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi3));
               $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id4_vidrio']." ";
                $fv4 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
                
                
                  
               if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
            }else{
               if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
               }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
               }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
              }
              } 
            }
            $comp=mysqli_query($conexion,"SELECT count(*) FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm2 = mysqli_fetch_array($comp);
            $d = $cm2['count(*)'];
            
            $ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysqli_fetch_array($ac);
            $mt = $cm['count(*)'];
            $t = $d + $mt;
            

   


            if($row["linea_cot"]=='Vidrio'){
                if($row["boq"]==0){ $d1 = '';}else{
                $d1 = 'Per:'.$row["per"].'Boq:'.$row["boq"];
                }
            }else{
                $d1 = 'Color Alum: '.$row["color_ta"].'';}

                                if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
                                            
            $tk = (($row["precio_adicional"] + $row["precio_material"])* $row["cantidad_c"]);
            $a = ($row["valor_c"] + $tk)/ $mult;
            $pu = ($a/$row["cantidad_c"]);
             $descpor = $pu *  $row["desc"]/100;
             $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
             $ptt2 = ($pudt) * $row["cantidad_c"];
              $pu3 = ($a/$row["cantidad_c"]);
             $ptt3 = ($pu3) * $row["cantidad_c"];
          
            $tad3 = $tad3 + $ptt3;
                if($row["imagen_mas"]!=''){
                    $fi = '../adicionales/'.$row["imagen_mas"];
                    list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
                    
                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
                    $img = '<img src="../adicionales/'.$row["imagen_mas"].'" width="'.$pi1.'px">';
                }else{
                    
               IF($row["imagen"]=='Derecho'){
                   IF($row["ruta"]==''){ 
                $img = '<img src="../producto/no.jpg" width="35px" heigth="35px">';
            }else{
                $fi = '../producto/'.$row["ruta"];
                list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
                $img = '<img src="../producto/'.$row["ruta"].'"  width="'.$pi1.'px">';
            }
            }else
                {
                IF($row["ruta"]==''){
                $img = '<img src="../producto/no.jpg" width="35px" heigth="30px">';
            }else{
                $fi = '../producto/'.$row["ruta2"];
                list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);;
                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
                $img = '<img src="../producto/'.$row["ruta2"].'"  width="'.$pi1.'px">';
            }
                }
                
                    }
            
$con2= "SELECT * FROM `producto` where id_p=".$row['traz_vid']." ";
$res2=  mysqli_query($conexion,$con2);
while($f8=  mysqli_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];

}
if($row['traz_vid2']==0){
$nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysqli_query($conexion,$con22);
while($f8=  mysqli_fetch_array($res22)){
$idco2=$f8['id_p'];
$nombr2=$f8['producto'];

}}
if($row['traz_vid3']==0){
$nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysqli_query($conexion,$con23);
while($f8=  mysqli_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];

}}
if($row['traz_vid4']==0){
$nombr4='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysqli_query($conexion,$con24);
while($f8=  mysqli_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];

}}
                                                        
                                                   
        $mt2 = ($row["ancho_c"]/1000) * ($row["alto_c"]/1000);
        $_GET["id_v"] = $row["id_vidrio"];
        $_GET["id_v2"] = $row["id_vidrio2"];
        $_GET["id_v3"] = $row["id_vidrio3"];
        $_GET["id_v4"] = $row["id_vidrio4"];
        $_GET["id_v5"] = $row["id_vidrio5"];
        $_GET["id_v6"] = $row["id_vidrio6"];
        $_GET["cant"] = $row["cantidad_c"];
        $_GET["por"] = $row["porcentaje_mp"];
        $_GET["ref"] = $row["id_referencia"];
        require '../vistas/form/apeso.php';
       
        if($row['linea'] == 'Vidrio'){
            $kk = $mt2 * $fv['espesor_v'] * 2.5;
            $es2 = $es2 + $kk;
            $kg2 = $kk;
        }else{
            $es2 = $es2 + $kg2;
            $kg2 = $kg2;
        }
   
   if($row['traz_vid']!=0){
   if($row['producto'] == $nombr){
       $res = '*********';
       $res2 = '';
       $res3 = '';
       $res4 = '';
   }else{
       if($row['linea'] == 'Acero'){
       $res = '*********';
       $res2 = '';
       $res3 = '';
       $res4 = '';
   }else{
       $res = ', '.$nombr;
       $res2 = ', '.$nombr2;
       $res3 = ', '.$nombr3;
       $res4 = ', '.$nombr4;
       
   } 
   }
   } else{
       $res = '';
       $res2 = '';
       $res3 = '';
       $res4 = '';
   }
   $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
                if($fv2==''){
                    $seg = '';
                }else{
                    $seg = '.Lam 2. '.$fv2["color_v"].''.$res;
                }
               
   
        $vv = ''.$fv["color_v"].' '.$res.' '.$fv22["color_v"].' '.$res2.' ';
    
   $c = '';
   $mc='';
   $img2 = '';
 $compu =mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysqli_fetch_array($compu)){
           IF($fila["ruta"]==''){
                $img3 = '<img src="../producto/no.jpg" width="60" heigth="40">';
            }else{
                $img3 = '<img src="../adicionales/'.$fila["ruta"].'" width="60" heigth="40">';
            }
          if(isset($fila['producto'])){
              $c = $c.', + :'.$fila['producto'];
              $mc =$mc. ''.$fila['ancho_c_sub'].' x '.$fila['alto_c_sub'];
              $img2 = $img2.''.$img3;
          }else{
              $c =$c.'';
              $mc =$mc.'';
              $img2 = $img2.'';
          }
          $costo_sp += $fila['valor_sp'] *$fila['cantidad_c_sub'];
          $costo_fom_sp += $fila['valor_fom_sp']*$fila['cantidad_c_sub'];
          $costo_mp += $fila['valor_c_sub']*$fila['cantidad_c_sub'];
          $costo_fom_mp += $fila['valor_fom_sub']*$fila['cantidad_c_sub'];
    }
//    echo $costo_fom_mp.'';
    if($row['install']=='Si'){
        $v = '<b>(Suministro e Instalación)</b>';//16004
    }else{
        $v = '<b>(Suministro)</b>';
    }
    $PB = $row["linea_cot"].' Bogota';
    $alum_por1B = "SELECT * FROM porcentajes where area_por='".$PB."'";
    $fia1B =mysqli_fetch_array(mysqli_query($conexion,$alum_por1B));
    $porcentaje_fom = $fia1B["p1"]/100;
    $compue = $row['valor_costob'] * $porcentaje_fom;
    $k =  ($row['precio_material'] +$costo_fom_mp)*$row["cantidad_c"];
    $mas_porc = ($row['valor_fom'] + $k);
    $ptt = ($mas_porc / $porcentaje_fom) ;
    if($row["cierre"]=='No'){$cierre= '';}else{$cierre= ' , Cierre:'.$row["cierre"].'';}
    $CT = $CT + ($mas_porc);
    $COS = ($mas_porc / $row["cantidad_c"]);
    $POR = (($ptt - $mas_porc)/ $ptt)*100;
    $port = $POR;
      $tad = $tad + $ptt;
    $table3 = $table3.'<tr>'
                    . '<td width="4%" ><p align="center">'.$row['tip'].'</p></td>          
                    <td width="23%" ><p align="justify">  '.$row['producto'].', '.$m.','.$d1.','.$row['observaciones'].', Cierre:'.$row["cierre"].''.$c.' '.$v.', Observaciones:'.$row['observaciones2'].'</p></td>
                    '
                    . '  <td width="8%" ><p align="center">'.$vv.'</p></td>             
                       <td  width="8%" ><p align="center">'.$row["ancho_c"].' x '.$row["alto_c"].''.$mc.'</p></td>'
                    . ''
                    . '<td  width="3%" ><p align="center">'.$row["cantidad_c"].' </p></td>
                   <td  width="7%" ><p align="center">$'.round($COS).'</p></td>'
            . '<td  width="7%" ><p align="center">$'.round($ptt/ $row["cantidad_c"]).'</p></td>'
            . '<td  width="8%" ><p align="center">$'.round($mas_porc).'</p></td>'
            . '<td  width="10%" ><p align="center">$'.round($ptt).'</p></td>'
            . '<td  width="7%" ><p align="center">$'.round($ptt - $mas_porc).'</p></td>'
            . '<td  width="7%" ><p align="center">'.round($POR).'%</p></td></tr></div>';   
           $table3 = $table3.'</table>';
       
	echo $table3;
        
          $cont = $cont + 1;
                          
             if($cont==$a1 || $cont==$a2 || $cont==$a3 || $cont==$a4 || $cont==$aa5|| $cont == $aa6 || $cont == $aa7 || $cont==$aa8  || $cont==$aa9 || $cont==$aa10){

           echo '<div class="saltopagina"></div>';
           
         }

	
	} 


        
        if($cont!=0){
     $iva = $tad *0.16;
     $iva2 = $CT *0.16;
        } 
        $porce = $port;
        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
        . '<tr BGCOLOR="#13173B">'
                . '<td style="font-size:80%;color:white;" width="180px" align="right">'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">VLR COSTO</td>'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">VLR TOTAL VENTAS</td>'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">UTILIDAD</td>'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">% UTILIDAD</td>'
                . '</tr>'
        . '<tr BGCOLOR="#13173B">'
                . '<td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">'.round($CT).'</td>'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">'.round($tad).'</td>'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">'.round($tad - $CT).'</td>'
                . '<td align="right" width="100px" style="font-size:80%;color:white;">'.round($porce).' %</td>'
                . '</tr>'

        . '</table>';
                       }  

                                           ?>
        <h5></h5>&nbsp;
       
    </body>
</html>