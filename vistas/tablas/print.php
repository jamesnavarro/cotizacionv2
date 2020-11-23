<!DOCTYPE html>
<?php
include '../modelo/conexion.php';
if(isset($_GET['cot'])){ 
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]);

     
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
        if($fila3['orden']=='0'){$abc = 'COTIZACION No. : ';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PEDIDO No. :';$num = $fila3['orden'];}
}
  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalles de la Cotizacion No. <?php echo $num ?></title>
        <style type="text/css">
		@media all {
			div.saltopagina{
				display: none;
			}
		}
			
		@media print{
			div.saltopagina{ 
				display:block; 
				page-break-before:always;
			}
		}
                .estilo1 { 
font-family: Arial;
font-size: 7px; 
color: #000000; 
} 
td.estilo1 {
border:hidden;
}
table.estilo1 {
border: 1px solid #000000;
}
table.estilo2 {
border: 0.5px solid #000000;padding:0px;

}
td.estilo2{
border: 0.5px solid #000000;padding:0px;
}
.estilo2 { 
font-family: Arial; 
font-size: 14px; 
color: #000000; 
border: 1px #A0A0A0;
} 

th.estilo2 {
font-size: 10px; 
}
#piedepagina{
width:800px; 
position: absolute;
bottom: 0 !important;
bottom: -1px;
}
	</style>
    </head>
    <body onload="window.print()">

        
<?php function tabla(){ 
     $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]);
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
<td rowspan="6" width="50%"><img src="../imagenes/templado.jpg" width="120" height="60"> </td>
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
    <th>IMPRESION: </th><td><?php echo date('Y-m-d').' '.$hora;  ?></td>
 
<th ALIGN=left>REGISTRO:</th>
<td><?php echo $fila3['fecha_reg_c'];  ?> </td>
</tr>
</table>
        
<?php  }  ?>       
        
      
     
	
        <?php
	//Por cada resultado pintamos una linea
        $total2=0;
        $tad =0;
      
    $cont =0;
    $es2=0;
    $pag = 0;
	while($row=mysqli_fetch_array($request))
	{    
               
              if($cont==0 || $cont==5|| $cont==10|| $cont==15|| $cont==20|| $cont==25|| $cont==30){
                  $pag +=1;
               tabla();
              $table3 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
             $table3 = $table3.'<thead >';
              $table3 = $table3.'<tr BGCOLOR="#9289AB">';
                  $table3 = $table3.'<th width="4%" style="font-size:8px; color:black">'.'TIPO'.'</h6></th>';  
              $table3 = $table3.'<th width="23%" style="font-size:8px; color:black">'.'DESCRIPCION'.'</th>';
               $table3 = $table3.'<th width="10%" style="font-size:8px; color:black">'.'UBICACION'.'</th>';
              $table3 = $table3.'<th width="9%" style="font-size:8px; color:black">'.'VIDRIO'.'</th>';
               $table3 = $table3.'<th  width="9%" style="font-size:8px; color:black">'.'ANCHO X ALTO'.'</th>';
                $table3 = $table3.'<th  width="5%" style="font-size:8px; color:black">'.'m2 aprox'.'</th>';
                $table3 = $table3.'<th  width="5%" style="font-size:8px; color:black">'.'KGS'.'</th>';
                $table3 = $table3.'<th  width="21%" style="font-size:8px; color:black">'.'DISEÑO'.'</th>';
               $table3 = $table3.'<th  width="3%" style="font-size:8px; color:black">'.'UND'.'</th>';
                $table3 = $table3.'<th  width="5%" style="font-size:8px; color:black">'.'VLR UND.'.'</th>';
               $table3 = $table3.'<th  width="12%" style="font-size:8px; color:black">'.'V.TOTAL'.'</th>';
             
              $table3 = $table3.'</tr>';
              $table3 = $table3.'</thead>'; 
              }else{
                   $table3 = '<table   class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
              }
              
              $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                
                
                  
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
            
           
            $suma2 = $row["valor_c"];
            $a = $suma2 / $mult;
            $tk = ($row["precio_adicional"] + $row["precio_material"]);
            $b = $a;
            $descpor = $b *  $row["desc"]/100;
            $b = $b + $descpor;
            if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum: '.$row["color_ta"].'';}
            $cont = $cont + 1;
            
                echo '<div id="factura">';
           
            
          
        
                                if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            $pu = ($b/$row["cantidad_c"]) + $tk;
             $ptt2 = ($pu) * $row["cantidad_c"];
            $tad = $tad + $ptt2;
            
                if($row["imagen_mas"]!=''){
                    $img = '<img src="../adicionales/'.$row["imagen_mas"].'" width="60" heigth="40">';
                }else{
               IF($row["imagen"]=='Derecho'){
                   IF($row["ruta"]==''){
                $img = '<img src="../producto/no.jpg" width="60" heigth="40">';
            }else{
                $img = '<img src="../producto/'.$row["ruta"].'" width="60" heigth="40">';
            }
            }else{
                IF($row["ruta"]==''){
                $img = '<img src="../producto/no.jpg" width="60" heigth="40">';
            }else{
                $img = '<img src="../producto/'.$row["ruta2"].'" width="60" heigth="40">';
            }
                }}
            
                $con2= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$row['traz_vid']." ";
                                                        $res2=  mysqli_query($conexion,$con2);
                                                         while($f8=  mysqli_fetch_array($res2)){
                                                        $idco=$f8['id_p'];
                                                        $nombr=$f8['producto'];
                                                        
                                                        }
                                                    
        $mt2 = ($row["ancho_c"]/1000) * ($row["alto_c"]/1000)*$row["cantidad_c"];
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
            $kk = $mt2 * $fi3['espesor_v'] * 2.5;
            $es2 = $es2 + $kk;
            $kg2 = $kk;
        }else{
            $es2 = $es2 + $kg2;
            $kg2 = $kg2;
        }
   
  
   if($row['producto'] == $nombr){
       $res = '*********';
   }else{
       if($row['linea'] == 'Acero'){
       $res = '*********';
   }else{
       $res = ', '.$nombr;
   } 
   } 
   $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
                if($fv2==''){
                    $seg = '';
                }else{
                    $seg = '.<br>Lam 2. '.$fv2["color_v"].''.$res;
                }
   $c = '';
   $mc='';
   $img2 = '';
    $compu =mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
          while ($fila=mysqli_fetch_array($compu)){
           IF($fila["ruta"]==''){
                $img3 = '<img src="../producto/no.jpg" width="60" heigth="40">';
            }else{
                $img3 = '<img src="../adicionales/'.$fila["ruta"].'" width="60" heigth="40">';
            }
          if(isset($fila['producto'])){
              $c = $c.', + :'.$fila['producto'];
              $mc =$mc. '<br>'.$fila['ancho_c_sub'].' x '.$fila['alto_c_sub'];
              $img2 = $img2.'<br>'.$img3;
          }else{
              $c =$c.'';
              $mc =$mc.'';
              $img2 = $img2.'';
          }
    }
    
    if($row['install']=='Si'){
        $v = '<br><b>(Suministro e Instalación)</b>';//16004
    }else{
        $v = '<br><b>(Suministro)</b>';
    }
    $table3 = $table3.'<tr>'
                    . '<td width="4%" style="font-size:8px"><p align="center">'.$row['tip'].'</p></a></td>          
                    <td width="23%" style="font-size:8px"><p align="center">  '.$row['producto'].', '.$m.','.$d1.','.$row['observaciones'].', Cierre:'.$row["cierre"].''.$c.' '.$v.'</p></td>
                    <td width="10%" style="font-size:8px"><p align="center">'.$row["ubicacion_c"].'</p></h6></td>'
                    . '  <td width="9%" style="font-size:8px"><p align="center">'.$fv["color_v"].' '.$res.' '.$seg.'</p></td>             
                       <td  width="9%" style="font-size:8px"><p align="center">'.$row["ancho_c"].' x '.$row["alto_c"].''.$mc.'</p></td>'
                    . '<td  width="5%" style="font-size:8px"><p align="center">'.number_format($mt2,1,',','.').'</p></td>'
                    . '<td  width="5%" style="font-size:8px"><p align="center">'.number_format($kg2,1,',','.').'</p></td>
                           <td  width="21%"><p align="center">'.$img.' </p></td>
                               <td  width="3%" style="font-size:8px"><p align="center">'.$row["cantidad_c"].' </p></h6></td>
                   <td  width="5%" style="font-size:8px"><p align="center">$'.number_format($pu).'</p></td>
                       <td  width="15%" style="font-size:8px"><p align="center">$'.number_format($ptt2).'</p></td></tr></div>';   
           $table3 = $table3.'</table>';
        
	echo $table3;
        

        if($cont==0 || $cont==5|| $cont==10|| $cont==15|| $cont==20|| $cont==25|| $cont==30){
             echo '<p align="center"  style="font-size:10px">TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - cotizacion@templadosa.com<br>Pagina '.$pag.'</p>';
             echo '<div class="saltopagina"></div>';
         }
	
	} 
        echo 'Peso Total: '.number_format($es2).' kg';
//        echo '<hr><h5><p align="right">TOTAL COT: $<strong>'.number_format($tad).'</strong></h5></p>'; 
        
                //-----------------------------------------servicios-----------------------------------------------
$request2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']."");
 $r2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']."");
$c2 = mysqli_fetch_row($r2);
    $c2 = $c2[0];
if($c2!=0){
//    echo'<hr>';
       $table2 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
             $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr  BGCOLOR="#3E3471">';
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="30%" style="font-size:10px; color:white">'.'Descripcion del servicio'.'</th>';
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Medida'.'</th>';
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Costo Und'.'</th>'; 

              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Costo Total'.'</th>'; 
           
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_serv =0;
	while($row2=mysqli_fetch_array($request2))
	{    
            
                  $request_ac1=mysqli_query($conexion,"SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	while($row1=mysqli_fetch_array($request_ac1))
	{       
               $por = 100;
            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);  
            
	} 
             $total2= $total2 +  1;
             $des = ($row2['descuento_serv']/100) * $row2["valor_mo"];
             $dd = ($row2["valor_mo"] + $des) * $row2["cantidad_serv"];
             $dd1 = ($tota + $des) * $row2["cantidad_serv"];
             $to_serv = $to_serv + $dd + $dd1;

            $table2 = $table2.'<tr><td width="5%" style="font-size:10px;"  align="center">'.$total2.'</td>'
                    . '<td width="5%" style="font-size:10px;"  align="center" >'.$row2['id_ref_mo'].'</td>'
                    . '<td width="30%" style="font-size:10px; "  align="center">'.$row2['descripcion_mo'].'</td>'
                    . '<td width="10%" style="font-size:10px;"   align="center">'.$row2["referencia"].'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">N/A</td>'
                    . '<td width="5%" style="font-size:10px;"   align="center">'.$row2["descuento_serv"].'%</td>'
                    . '<td width="5%" style="font-size:10px; "  align="center">'.$row2["cantidad_serv"].'</td>'
                    . '<td width="10%" style="font-size:10px;"   align="center">'.number_format(($dd + $dd1)/$row2["cantidad_serv"]).'</td>'
                  
                    . '<td width="10%" style="font-size:10px;"   align="center" >'.number_format(($dd + $dd1)).'</td>'
                    . '</tr>';   
           
		
               
	} 
	$table2 = $table2.'</table>';
        echo '<div class="saltopagina"></div>';
        tabla();
        echo 'Servicios<hr>';
	echo $table2.'<hr>';
        echo '<h5><p align="right">TOTAL SERV.: $<strong>'.number_format($to_serv).'</strong></h5></p>'; 
} else{
    $to_serv = 0;
} 
        
        //----------------------------------------fin servicios--------------------------------------------

//---------------------------------suministros-----------------------------------------

$request3=mysqli_query($conexion,"SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cot']." ");
   $r3=mysqli_query($conexion,"SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cot']." "); 
$c3 = mysqli_fetch_row($r3);
    $c3 = $c3[0];
if($c3!=0){
//    echo'<hr>';
       $table2 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
             $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr  BGCOLOR="#3E3471">';
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="30%" style="font-size:10px; color:white">'.'Descripcion de los materiales'.'</th>';
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Medida'.'</th>';
               
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Cantidad'.'</th>';
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Costo Und'.'</th>';  
              $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Costo Total'.'</th>'; 
           
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_mat =0;     
	while($row21=mysqli_fetch_array($request3))
	{       
                 $acc_por = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='MP' and grupo='".$row21["grupo"]."'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
             $total2= $total2 +  1;
             if($row21['med']==1){
                 $mt = 1;
             }else{
      
                 $mt = ($row21['med']/1000);
             }
            
             $desm = ($row21['descuento_mat']/100) * ($row21["costo_mt"]*$mt);
             $ddm = ((($row21["costo_mt"]*$mt) + $desm) * $row21["cantidad_mat"]) / $porcacc;
             $to_mat = $to_mat + $ddm;
               if($row21['color_ma']==''){
                 $cm = '';
             }else{
                  $cm = 'Color: '.$row21['color_ma'];
             }

            $table2 = $table2.'<tr><td width="5%" style="font-size:10px;" align="center">'.$total2.'</a></td>'
                    . '<td width="5%" style="font-size:10px;" align="center">'.$row21['codigo'].'</font></td>'
                    . '<td width="27%" style="font-size:10px;" align="center">'.$row21['descripcion'].' '.$cm.'</font></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21["referencia"].'<font></a></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21["med"].'</td>'
                    
                    . '<td width="5%" style="font-size:10px;" align="center">'.$row21["descuento_mat"].'%</td>'
                    . '<td width="5%" style="font-size:10px;" align="center">'.$row21["cantidad_mat"].'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">$'.number_format(($row21["costo_mt"]*$mt)/ $porcacc).'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.number_format($ddm).'</td>'
                    . '</tr>';   
           
		
               
	} 
	$table2 = $table2.'</table>';
        echo 'Suministros<hr>';
	echo $table2;
       
       
         echo '<h5><p align="right">TOTAL SUMINISTROS.: $<strong>'.number_format($to_mat).'</strong></p></h5>';
        
  
} else{
    $to_mat = 0;
}

//--------------------------------fin de suministro------------------------------------
//-----------------------------------kit-----------------------------------------------

$request4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.comp='0' ");
$r4=mysqli_query($conexion,"SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.comp='0' ");
    $c1 = mysqli_fetch_row($r4);
    $c1 = $c1[0];
   
if($c1!=0){
//    echo'<hr>';
        $table4 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
             $table4 = $table4.'<thead >';
              $table4 = $table4.'<tr  BGCOLOR="#3E3471">';
              $table4 = $table4.'<th width="5%" style="font-size:10px; color:white">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="5%" style="font-size:10px; color:white">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="30%" style="font-size:10px; color:white">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Medida'.'</th>';
               
              $table4 = $table4.'<th width="5%" style="font-size:10px; color:white">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="5%" style="font-size:10px; color:white">'.'Cantidad'.'</th>'; 
               $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Costo'.'</th>'; 
              $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Costo Total'.'</th>'; 
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2e=0;
        $to_k =0;
     
                
                
	while($row21k=mysqli_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             $ddm = ((($totk) + $desm)) / $porcacc;
             $to_k = $to_k + $ddm;
               if($row21k['color_k']==''){
                 $ck = '';
             }else{
                  $ck = 'Color: '.$row21k['color_k'];
             }

            $table4 = $table4.'<tr><td width="5%" style="font-size:10px;" align="center">'.$t2e.'</a></td>'
                    . '<td  width="5%" style="font-size:10px;" align="center">'.$row21k['codigo'].'</font></td>'
                    . '<td  width="30%" style="font-size:10px;" align="center">'.$row21k['producto'].' '.$ck.'</font></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21k["referencia_p"].'<font></a></td>
                        <td  width="10%" style="font-size:10px;" align="center">N/A</td>
               '
                    . '<td  width="5%" style="font-size:10px;" align="center">'.$row21k["desc_k"].'%</td>'
                    . '<td width="5%" style="font-size:10px;" align="center">'.$row21k["cantidad_k"].'</td>'
                    . '<td  width="10%" style="font-size:10px;" align="center">$'.number_format(($totk)/ $porcacc).'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.number_format($ddm).'</td>'
                    . '</tr>';   
           
		
               
	} 
	$table4 = $table4.'</table>';
         echo 'Kit de Accesorios<hr>';
	echo $table4;
         echo '<div align="right"><h5>TOTAL KIT.: $'.number_format($to_k).'</h5></div>';
         
  
} else{
    $to_k =0;
}


//---------------------------------fin kit---------------------------------------------
	
         $ff = $to_serv+$tad+$to_mat+$to_k;
        if($cont!=0){
     $iva = $ff *0.16;
     
        } 
        echo '<table  align="right"  border="1"  cellpadding="0" cellspacing="0">'
        . '<tr><td style="font-size:80%;" width="" align="right">SUB TOTAL.: $<td width="" style="font-size:80%;">'.number_format($to_serv+$tad+$to_mat+$to_k).'</td></tr>'
        . '<tr><td style="font-size:80%;" width="" align="right">IVA 16%: $<td width="" style="font-size:80%;">'.number_format($iva).'</td></tr>'
        . '<tr><td style="font-size:80%;" width="" align="right">TOTAL.: $<td width="" style="font-size:80%;">'.number_format($ff + $iva).'</td></tr>'
        . '</table><br><br><br>';
        
        
        echo '<h6><p align="center">TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - cotizacion@templadosa.com<br>Pagina '.$pag.'</p></h6>';
 
                                           }  
                $textos = 'POLITICAS DE VENTA TEMPLADO S.A.<BR>
Los pedidos de vidrio tienen un plazo de (4) días hábiles para su entrega. El día sábado no es tenido en cuenta como día hábil. Cuando el pedido tiene un servicio adicional de esmeril, huacal o instalación la fecha de entrega es de 5 días hábiles.
Los vidrios biselados y los de 19mm tienen un plazo de entrega de 6 días hábiles. 
El servicio de temple, perforación, borde pulido y brillado u otros servicios que se ofrece a vidrios propios de clientes exclusivos, tendrá un plazo  de cuatro (4) días hábiles para su proceso. 
El servicio express que prestamos a los clientes es solo para vidrios rectos de espesor de 6mm, 8mm y 10mm, que no lleven algún maquinado especial y una cantidad máxima de 15 vidrios, la fecha de entrega es de 36 horas a partir del momento que ingresa la orden de producción si lleva un servicio adicional de esmeril o huacal cuenta 1 día mas para su entrega.
Los vidrios propios traídos a las instalaciones de Templado S.A para los servicios de Temple, borde pulido y brillados, perforaciones u otros servicios, Templado S.A no se hace responsable por roturas que se presenten en el proceso del vidrio.
La medida mínima de temple es 300 x 300 mm, y la máxima de 2050 x 3300 mm. 
Las medidas de los vidrios se manejan con una tolerancia de + 2mm o - 2mm.
El día numero uno (1) del proceso será el mismo día si la orden de producción ingresa antes de las 11:00 a.m. de lo contrario se comenzará a contar a partir del siguiente día hábil.
Cuando se soliciten modificaciones a los pedidos que ya están en producción, se debe tener presente que sólo se efectuarán reformas en medidas antes de que el(los) vidrio(s) sean cortados, y cambios en maquinado (perforaciones y boquetes) antes de que pasen por estos procesos. De lo contrario serán facturados los vidrios hasta donde se haya efectuado el proceso productivo o en su defecto será cobrado el servicio adicional que necesite para ello. IMPORTANTE: De ser posible algún cambio sobre el pedido, el tiempo de entrega se prolonga 2 días automáticamente.
Únicamente se entregan pedidos totalmente TERMINADOS. Cuando el pedido esté listo se le informará al cliente para que se acerque a la empresa y reclame su pedido o se le informará cuando se le va ha despachar o instalar.
El procedimiento de entrega de pedidos se hará en el orden de llegada de los clientes. 
Templado S.A se hace responsable del producto terminado hasta su entrega, por tanto es de vital importancia que el cliente inspeccione muy bien los vidrios al momento de recibirlos.
Cualquier reclamo por rayas o escarchas sólo se acepta al momento de la recepción de los pedidos. Para reclamos de otro tipo (perforaciones, boquetes o medidas) se otorga un plazo máximo de 30 días (contados a partir de la fecha de entrega del pedido). Para hacer efectivo el reclamo, el cliente debe devolver el producto No conforme, a las instalaciones de TEMPLADO S.A para verificar el problema descrito. 

CONDICIONES DE ENTREGA Y GARANTIAS EN EL PRODUCTO<BR>

El personal del área de Servicio al Cliente, informará telefónicamente al cliente que su pedido esta terminado.
Los horarios de atención al público para la entrega de pedidos es:
Lunes a Viernes de 7:30 a 11:30 a.m. y de 2:00pm a 5:30 p.m.
Sábados de 7:30 a.m. a 12:30 p.m.
El cliente antes de recoger su pedido deberá comunicarse con nuestro personal de “cartera” para consultar el saldo y cancelarlo en las instalaciones o consignar en la cuenta de la empresa. 
BANCO	TIPO DE CUENTA	No. DE CUENTA<BR>
BANCO DE BOGOTA<BR>	Cuenta Corriente	173065434<BR>
Para retirar los pedidos de la Empresa estos deben estar totalmente cancelados, cuando el pedido lleva instalación debe cancelar un 50% de anticipo, el 30% cuando el pedido este listo y el 20% cuando reciba el producto a satisfacción.
El tiempo de entrega de materiales instalados en obras serán acordados después de haber entregado el anticipo y pactadas medidas de vanos. Estos se realizarán  en comités internos realizados por el supervisor de la obra de TEMPLADO S.A y el residente de obra de la firma contratante, teniendo en cuenta para esto el material a utilizar y adelantos de la obra. Las medidas que no sean pactadas en el acta de vanos inicial tendrán otra fecha de entrega  a la inicial.
En la bodega de Almacenamiento y Despachos, el cliente debe revisar uno a uno los vidrios teniendo en cuenta los acabados, las medidas y el número de vidrios según el pedido. Finalizada esta operación el cliente firma como constancia de la entrega y se autoriza la salida del vehículo.
Cuando TEMPLADO S.A  entrega en las instalaciones del cliente, la entrega de la mercancía es en plataforma, es decir, en el vehículo, razón por la cual el cliente debe disponer del personal para el descargue y por ende asume toda responsabilidad de cualquier daño ocasionado sobre el producto durante este proceso. El conductor del vehículo no está autorizado para participar en el descargue.
Cuando TEMPLADO S.A anuncia el envío de los pedidos, no se especificará la hora de envío ni de llegada del mismo, sólo se anunciará la fecha del despacho. 
Ofrecemos garantía por rayas, manchas o escarchas, sólo al momento de la recepción del pedido. Para efectos de garantía garantía, el cliente debe revisar la totalidad del pedido y los defectos deben ser identificados en el momento mismo del descargue e informarlo al conductor inmediatamente, dejando constancia escrita sobre la factura, identificando claramente el ítem a devolver. Dichos vidrios se entregan inmediatamente al conductor. Una vez efectuada la entrega y firmado el recibo por parte del cliente, no se aceptaran reclamos por causas que no hallan sido reportado oportunamente durante el descargue.
Las ventanas o vidrios protegidos con película (Polimax) tienen una caducidad de 4 meses, debido a que los factores ambientales afectan la protección de los rayos uv, ademas la adherencia del pegante ocasiona dificultad al momento de retirarla. Transcurrido este tiempo es responsabilidad de la obra el retiro de la película. 
Cuando en la entrega se identifiquen vidrios pendientes, estos se deben reportar inmediatamente en las instalaciones de TEMPLADO S.A al área de servicio al cliente y se debe registrar en el documento entregado por el conductor del vehículo (Factura o Remisión). De no reportase y no aparecer registrados en el documento, TEMPLADO S.A no se hará responsable por el producto y la reposición del mismo correrá a cargo del cliente.
La fecha límite de almacenamiento del vidrio dentro de las bodegas de TEMPLADO S.A es máximo quince (15) días hábiles después de anunciada la mercancía al cliente, vencida esta fecha TEMPLADO S.A no asume daños ocasionados en el vidrio.
El tiempo de garantía que ofrece TEMPLADO S.A para el servicio de instalación y para los accesorios que maneja en estas instalaciones es de 6 meses.
El tiempo de garantía en los espejos es de 3 meses a partir de la fecha de instalación o recibo del mismo.
La garantía sobre los productos que ofrecemos en Carpintería Metálica es de 12 meses a partir de la fecha de instalación.
Las garantías no serán valida cuando el uso, cuidado y operación del producto no haya sido el apropiado, si el producto ha sido usado fuera de su capacidad, maltratado, golpeado, expuesto a la humedad, mojado por algún liquido o sustancia corrosiva, así como por cualquier otra falla atribuible al consumidor, cuando el producto haya sido desarmado, modificado o reparado por personas no autorizadas por TEMPLADO S.A o si la falla es originada por el desgaste normal de la pieza debido al uso.
';
                  echo '<div class="saltopagina"></div>';
                  tabla();
                echo '<p align="justify" style="font-size:9px">'.$textos.'</p><br><br>';
                echo '_______________________________  '.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'_______________________________<br> ';
        echo 'Firma del Asesor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma cliente<br>';
        echo 'C.C.';
        $pag2 = $pag + 1;
                echo '<p align="center"  style="font-size:10px">TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - cotizacion@templadosa.com<br>Pagina '.$pag2.'</p>';
              
                                           ?>
        <h5></h5>&nbsp;
        
    </body>
</html>