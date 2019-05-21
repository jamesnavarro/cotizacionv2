<!DOCTYPE html>
<?php
include '../modelo/conexion.php';
if(isset($_GET['cot'])){ 
 $request=mysql_query("SELECT * FROM producto a, cotizaciones c, tipo_vidrio d where c.estado_c='Cotizado' and d.id_vidrio=c.id_vidrio and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]);

     
if($request){
$strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['cot']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
        
        if($fila3['tipo']=='Empresarial'){
     	
        $strConsulta3 = "select * from sis_empresa  where id_empresa=".$fila3['id_cliente']."";
	$empresa = mysql_query($strConsulta3);
	$filae = mysql_fetch_array($empresa);
        $nombre = $filae['nombre_emp'];
        $documento =$filae['nit_emp'];
        $telefono =$filae['tel_oficina_emp'];
        $direccion =$filae['direccionr_emp'];
        }else{
       	
        $strConsultap = "select * from sis_contacto  where id_contacto=".$fila3['id_cliente']."";
	$personal = mysql_query($strConsultap);
	$filae = mysql_fetch_array($personal);
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
font-family: Arial, Helvetica, sans-serif; 
font-size: 10px; 
color: #000000; 
} 
td.estilo1 {
border:hidden;
}
table.estilo1 {
border: 1px solid #000000;
}
                .estilo2 { 
font-family: Arial, Helvetica, sans-serif; 
font-size: 15px; 
color: #000000; 
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
     $request=mysql_query("SELECT * FROM producto a, cotizaciones c, tipo_vidrio d where c.estado_c='Cotizado' and d.id_vidrio=c.id_vidrio and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]);

     
if($request){
$strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['cot']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
        
        if($fila3['tipo']=='Empresarial'){
     	
        $strConsulta3 = "select * from sis_empresa  where id_empresa=".$fila3['id_cliente']."";
	$empresa = mysql_query($strConsulta3);
	$filae = mysql_fetch_array($empresa);
        $nombre = $filae['nombre_emp'];
        $documento =$filae['nit_emp'];
        $telefono =$filae['tel_oficina_emp'];
        $direccion =$filae['direccionr_emp'];
        }else{
       	
        $strConsultap = "select * from sis_contacto  where id_contacto=".$fila3['id_cliente']."";
	$personal = mysql_query($strConsultap);
	$filae = mysql_fetch_array($personal);
        $nombre = $filae['nombre_cont'].' '.$filae['apellido_cont'];
        $documento =$filae['cedula_cont'];
        $telefono =$filae['tel_oficina'];
        $direccion =$filae['direccionf'];
        }
        if($fila3['orden']=='0'){$abc = 'COT. No. : ';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PEDIDO No. :';$num = $fila3['orden'];}
}
    ?>         
        <table class="estilo1" border="0"  cellpadding="0" cellspacing="0">
<tr>
<td rowspan="4"><img src="../imagenes/templado.jpg" width="120" height="60"> </td>
<th ALIGN=RIGHT>CLIENTE:</th>
<td width="20%"><?php echo $nombre;  ?></td>
<th ALIGN=RIGHT>TELEFONO:</th>
<td width="20%"><?php echo $fila3['tel_responsable'];  ?></td>
<th ALIGN=RIGHT><?php echo $abc;  ?></th>
<td width="20%"><?php echo $num;  ?></td>
</tr>
<tr>
<th ALIGN=RIGHT>C.C ó NIT:</th>
<td width="20%"><?php echo $documento;  ?></td>
<th ALIGN=RIGHT>CONTACTO:</th>
<td width="15%"><?php echo $fila3['responsable'];  ?></td>
<th ALIGN=RIGHT>REGISTRO:</th>
<td><?php echo $fila3['fecha_reg_c'];  ?></td>
</tr>
<tr>
<th ALIGN=RIGHT>OBRA:</th>
<td width="20%"><?php echo $fila3['obra'];  ?></td>
<th ALIGN=RIGHT>ASESOR:</th>
<td width="15%"><?php echo $fila3['registrado'];  ?></td>
<th ALIGN=RIGHT></th>
<td></td>
</tr>
<tr>
<th ALIGN=RIGHT>DIRECCION:</th>
<td width="20%"><?php echo $fila3['ubicacion'];  ?></td>
<th ALIGN=RIGHT>VALIDEZ OFERTA:</th>
<td width="15%"><?php echo '120 dias';  ?></td>
<th ALIGN=RIGHT>FORMA DE PAGO:</th>
<td><?php echo $fila3['pago'];  ?></td>
</tr>
</table>
        
<?php  }  ?>       
        
      
     
	
        <?php
	//Por cada resultado pintamos una linea
        $total2=0;
        $ta =0;
      
    $cont =0;
	while($row=mysql_fetch_array($request))
	{    
           
              if($cont==0 || $cont==4|| $cont==8|| $cont==12|| $cont==16){
               tabla();
              $table = '<table  border="1"  cellpadding="0" cellspacing="0">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
                  $table = $table.'<th width="4%">'.'#'.'</th>';  
              $table = $table.'<th width="25%">'.'DESCRIPCION'.'</th>';
               $table = $table.'<th width="12%">'.'UBICACION'.'</th>';
              $table = $table.'<th width="9%">'.'VIDRIO'.'</th>';
               $table = $table.'<th  width="9%">'.'MEDIDAS'.'</th>';
                $table = $table.'<th  width="15%">'.'DISEÑO'.'</th>';
               $table = $table.'<th  width="5%">'.'CANT'.'</th>';
                $table = $table.'<th  width="9%">'.'VLR UND.'.'</th>';
               $table = $table.'<th  width="12%">'.'VLR TOTAL.'.'</th>';
             
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              }else{
                   $table = '<table  border="1"  cellpadding="0" cellspacing="0">';
              }
        
               if($row["linea_cot"]=='Aluminio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
            }else{
               if($row["linea_cot"]=='Vidrio'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
               }else{
                if($row["linea_cot"]=='Fachada'){
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
               }else{
                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
              }
              } 
            }
            $comp=mysql_query("SELECT count(*) FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm = mysql_fetch_array($comp);
            $d = $cm['count(*)'];
            
            $ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysql_fetch_array($ac);
            $mt = $cm['count(*)'];
            $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=97 ";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $t = $d + $mt;
              if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
                if($row['pelicula']=='Una Cara'){
                     
                    $peli = ', '.$fila21['descripcion_mo'];
            }else{
                  
               $peli = ', '.$fila21['descripcion_mo'].' ambos lados';
            }
            }
                
                $row["costo_v"];
                $suma2 = $row["valor_c"];
            $a = $suma2 / $mult;
           
            $b = $a + $row["precio_adicional"]+$row["precio_material"];
            $descpor = $b *  $row["desc"]/100;
            $b = $b + $descpor;
            if($row["linea_cot"]=='Vidrio'){$d1 = ', Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = ', Color:'.$row["color_ta"];}
            $cont = $cont + 1;
            
                echo '<div id="factura">';
           
            $ta = $ta + $b;
          
        
                                if($row["cuerpo"]!=0){$m = ', Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            $pu = ($b)/$row["cantidad_c"];
      

            IF($row["ruta"]==''){
                $img = '<img src="../producto/no.jpg" width="60" heigth="40">';
            }else{
                $img = '<img src="../producto/'.$row["ruta"].'" width="60" heigth="40">';
            }
        
            $table = $table.'<tr>'
                    . '<td width="4%">'.$cont.'</a></td>
               
                    <td width="25%"><h6><p align="justify"> '.$row['producto'].' '.$peli.' '.$m.' '.$d1.','.$row['observaciones'].','.$row["cierre"].'</p></h6></td>
                        <td width="12%"><h6>'.$row["ubicacion_c"].'</h6></td>  <td width="9%"><h6>'.$row["color_v"].'</h6></td>             
                       <td  width="9%"><h6>'.$row["ancho_c"].'X'.$row["alto_c"].'</h6></td>
                           <td  width="15%"><p align="center">'.$img.'</p></td>
                               <td  width="5%"><h6>'.$row["cantidad_c"].' (Und)</h6></td>
                   <td  width="9%"><h6>$'.number_format($pu).'</h6></td>
                       <td  width="15%"><h6>$'.number_format($b).'</h6></td></tr></div>';   
           $table = $table.'</table>';
        
	echo $table;
         if($cont==0 || $cont==4|| $cont==8|| $cont==12|| $cont==16){
             echo '<h6><p align="center">TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - ventas@templadosa.com</p></h6>';
             echo '<div class="saltopagina"></div>';
         }
	
	} 
        
	echo '<hr>';
        if($cont!=0){
             $iva = $ta *0.16;
     echo '<p align="right"><FONT color="red">SUBTOTAL COT.: $'.number_format($ta).'<br>'; 
     echo 'IVA 16%: $'.number_format($iva).'<br>';
      echo 'TOTAL COT.: $'.number_format($ta + $iva).'</FONT></p>';
        } 
        
        echo '_______________________________   <br> ';
        echo 'Firma del Asesor<br>';
        echo 'C.C.';
        echo '<h6><p align="center">TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - ventas@templadosa.com</p></h6>';
 
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
                echo '<h6><p align="justify">'.$textos.'</p></h6>';
                echo '<h6><p align="center">TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - ventas@templadosa.com</p></h6>';
              
                                           ?>
        <h5></h5>
        
    </body>
</html>
