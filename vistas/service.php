<!DOCTYPE html>
<?php
include '../modelo/conexion.php';
if(isset($_GET['cot'])){ 
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." order by c.fila asc");

     
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
        <title>DETALLES DE LA COTIZACIÓN No. <?php echo $num ?></title>
        <style type="text/css">
            
            footer {
            position: relative;
            /* Altura total del footer en px con valor negativo */
            margin-top: 1px;
            /* Altura del footer en px. Se han restado los 5px del margen
               superior mas los 5px del margen inferior
            */
            height: 1px; 
            padding:5px 0px;
            clear: both;
            background: #fff;
            text-align: center;
            
            font-family: Arial;
font-size: 7px; 
color: #000000; 
        }
        
        /* Esta clase define la anchura del contenido y la posicion centrada 
           El contenido queda centrado y limitado, pero la cabecera y el pie
           llegan hasta los limites del navegador.
        */
        .define {
            width:960px;
            margin:0 auto;
        }
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
     border: 0.4px solid #000000;
   border-top: 1px solid transparent;
  border-collapse: collapse;
}
td.estilo2{
   
}
.estilo2 { 
font-family: Arial; 
font-size: 14px; 
color: #000000; 
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

       
<?php 
 
function tabla(){ 
     $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." order by c.tip asc");
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s',time() - 3600*date('I'));
     
if($request){
$strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['cot']."'";
	$pacientes3 = mysqli_query($conexion,$strConsulta3);
	$fila3 = mysqli_fetch_array($pacientes3);
        if ($fila3['nom_temp'] == '') {
                        $strConsulta3 = "select * from cont_terceros  where id_ter=" . $fila3['id_tercero'] . "";
                        $empresat = mysqli_query($conexion,$strConsulta3);
                        $fila6 = mysqli_fetch_array($empresat);
                        $nombre = $fila6['nom_ter'];
                        $documento = $fila6['cod_ter'];
                        $telefono = $fila6['telfijo_ter'];
                        $direccion = $fila6['dir_ter'];
                    } else {
                        $nombre = $fila3['nom_temp'];
                        $documento = $fila3['cod_temp'];
                    }
        if($fila3['orden']=='0'){$abc = 'COT. No. : ';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PED No. :';$num = $fila3['orden'];}
}
    ?>         
        <table class="estilo1" border="0"  cellpadding="0" cellspacing="0">
<tr>
<td rowspan="9"  style="margin: 15px;padding: 15px;color:white" width="50%"><img src="../imagenes/logo2.png" width="200" height="80"> </td>
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

                //-----------------------------------------servicios-----------------------------------------------
$request2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=0");
 $r2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=0");
$c2 = mysqli_fetch_row($r2);
    $c2 = $c2[0];
    tabla();
if($c2!=0){
//    echo'<hr>';
       $table2 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
       $table2 = $table2.'<thead >';
       $table2 = $table2.'<tr  BGCOLOR="#13173B">';
       $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Items'.'</th>';    
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Codigo'.'</th>'; 
       $table2 = $table2.'<th width="50%" style="font-size:10px; color:white">'.'Descripcion del servicio'.'</th>';
    
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Medida'.'</th>';
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Cantidad'.'</th>'; 
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Valor Und'.'</th>'; 
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Valor Total'.'</th>'; 
       $table2 = $table2.'</tr>';
       $table2 = $table2.'</thead>';
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_serv =0;
	while($row2=mysqli_fetch_array($request2))
	{    
          
        
        //$pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["precio_servicio"]) ;
        $total2= $total2 +  1;
        $des = ($row2['descuento_serv']/100) * $fr;
        $dd = ($fr + $des) * $row2["cantidad_serv"] /0.336;
        $to_serv = $to_serv + $dd;

        $table2 = $table2.'<tr>'
                    . '<td width="5%" style="font-size:10px;"  align="center">'.$total2.'</td>'
                    . '<td width="10%" style="font-size:10px;"  align="center" >'.$row2['cod_serv'].'</td>'
                    . '<td width="50%" style="font-size:10px; "  align="center">'.$row2['descripcion_mo'].'</td>'
       
                    . '<td width="10%" style="font-size:10px;" align="center">N/A</td>'
                    . '<td width="10%" style="font-size:10px; "  align="center">'.$row2["cantidad_serv"].'</td>'
                    . '<td width="10%" style="font-size:10px;"   align="center">'.number_format(($dd )/$row2["cantidad_serv"]).'</td>'
                    . '<td width="10%" style="font-size:10px;"   align="center" >'.number_format(($dd )).'</td>'
                    . '</tr>';    
	} 
	$table2 = $table2.'</table>';
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
       $table2 = $table2.'<tr  BGCOLOR="#13173B">';
       $table2 = $table2.'<th width="5%" style="font-size:10px; color:white">'.'Items'.'</th>';    
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Codigo'.'</th>'; 
       $table2 = $table2.'<th width="40%" style="font-size:10px; color:white">'.'Descripcion de los materiales'.'</th>';
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Referencia'.'</th>';
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Medida'.'</th>';
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Cantidad'.'</th>';
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Valor Und'.'</th>';  
       $table2 = $table2.'<th width="10%" style="font-size:10px; color:white">'.'Valor Total'.'</th>'; 
       $table2 = $table2.'</tr>';
       $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_mat =0;     
	while($row21=mysqli_fetch_array($request3))
	{       
          
          $total2= $total2 +  1;
             if($row21['med']==1){
                 $mt = 1;
             }else{
                 $mt = ($row21['med']/1000);
             }
            $au = (100 - $row21['aumento']) / 100;
            $prt3 = $row21["costo_mt"] / $au;
            $desm = ($row21['descuento_mat']/100) * ($prt3*$mt);
            $alum_porr = "SELECT costo_a,variable FROM tipo_aluminio where color_a='".$row21['color_ma']."'";
            $fia4 =mysqli_fetch_array(mysqli_query($conexion,$alum_porr));
            $vc= $fia4["costo_a"];
            $perimetro = $row21["area"]/1000;
               if($perimetro=='0'){
                  $valor_acabado = $vc;
               }else{
                  $valor_acabado = $vc * $perimetro * ($row21["med"]/1000) ;
               }
             $ddm = (((($prt3*$mt + $desm+$valor_acabado) * $row21["cantidad_mat"]) )/0.46275);
             $to_mat = $to_mat + $ddm;
             if($estado=='En proceso'){ 
             if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
             if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
             }else{
                 $ver='';$del='';
             }
             if($row21['color_ma']==''){
                 $cm = '';
             }else{
                 $cm = '<b>Color: </b> '.$row21['color_ma'];
             }
             $totalpintado = ($prt3*$mt) + $valor_acabado;
             $table2 = $table2.'<tr><td width="5%" style="font-size:10px;" align="center">'.$total2.'</a></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21['codigo'].'</font></td>'
                    . '<td width="40%" style="font-size:10px;" align="center">'.$row21['descripcion'].' '.$cm.'<br><b>Ubicacion: </b>'.$row21['ubicacion'].'</font></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21["referencia"].'<font></a></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21["med"].'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21["cantidad_mat"].'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">$'.number_format($ddm/ $row21["cantidad_mat"]).'</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.number_format($ddm).'</td>'
                    . '</tr>'; 	  
	} 
	$table2 = $table2.'</table>';
        echo '<hr>';
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
        $table4 = $table4.'<tr  BGCOLOR="#13173B">';
        $table4 = $table4.'<th width="5%" style="font-size:10px; color:white">'.'Items'.'</th>';    
        $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Codigo'.'</th>'; 
        $table4 = $table4.'<th width="40%" style="font-size:10px; color:white">'.'Descripcion del kit'.'</th>';
        $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Referencia'.'</th>';
        $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Medida'.'</th>';
        $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Cantidad'.'</th>'; 
        $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Valor Und'.'</th>'; 
        $table4 = $table4.'<th width="10%" style="font-size:10px; color:white">'.'Valor Total'.'</th>'; 
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
                    . '<td  width="10%" style="font-size:10px;" align="center">'.$row21k['codigo'].'</font></td>'
                    . '<td  width="40%" style="font-size:10px;" align="center">'.$row21k['producto'].' '.$ck.'</font></td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21k["referencia_p"].'<font></a></td>
                       <td  width="10%" style="font-size:10px;" align="center">N/A</td>'
                    . '<td width="10%" style="font-size:10px;" align="center">'.$row21k["cantidad_k"].'</td>'
                    . '<td  width="10%" style="font-size:10px;" align="center">$'.number_format($ddm/ $row21k["cantidad_k"]).'</td>'
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
	
         $ff = $to_serv+$to_mat+$to_k;
         $iva = $ff * 0.19;
         echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">'.number_format($to_serv+$to_mat+$to_k).'</td></tr>'
        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">IVA 19%: $<td  align="right" width="100px" style="font-size:80%;color:white;">'.number_format($iva).'</td></tr>'
        . ''
        . '</table><br><br>';
        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
        
        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">'.number_format($ff + $iva).'</td></tr>'
        . '</table><br>';

        }  

         echo '<footer>
        <div class="define">
            <p>TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - cotizacion@templadosa.com</p>
        </div>
    </footer>';
    ?>
    
    </body>
</html>