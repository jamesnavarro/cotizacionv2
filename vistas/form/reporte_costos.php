<?php 
if(isset($_GET['d'])){
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ReporteDeCosto.xls");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Costos</title>
            <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../../js/ajax.js" type="text/javascript"></script>
        <style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 2px solid #E1EEF4;font-size: 12px;border-bottom: 2px solid #E1EEF4;font-weight: normal; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; } </style>
    <script> 
        function planilla(cot,gt){
            var t_alu = $("#t_alu").val();
            var t_vid = $("#t_vid").val();
            var t_acc = $("#t_acc").val();
            var t_adi = $("#t_adi").val();
            var t_kit = $("#t_kit").val();
            var t_mob = $("#t_mob").val();
            var t_ins = $("#t_ins").val();
            var t_pol = $("#t_pol").val();
            var t_and = $("#t_and").val();
            var to_serv = $("#to_serv").val();
            var to_mat = $("#to_mat").val();
            var to_k = $("#to_k").val();
            var t = $("#totales").val();
            t_kit = parseFloat(t_kit) + parseFloat(to_k);
            t_acc = parseFloat(t_acc);
            t_ins =  parseFloat(t_ins);
            window.open("../../vistas/costos/planilla_costo.php?cot="+cot+"&t="+t+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_adi="+t_adi+"&t_kit="+t_kit+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol+"&t_and="+t_and+"&gt="+gt+" ", "Planilla", "width=1000 , height=600 ");
        }
        </script>

    </head>
    <body>
        <?php
             require '../../modelo/conexion.php';
        ?>
        <div class="datagrid">
            <span id="btn"> 
                <button onclick="window.print()">Imprimir Pdf</button> 
                | <a href="<?php echo $_SERVER["REQUEST_URI"].'&d'; ?>"><button>Descargar Excel</button></a>
                
            </span>
        <table>
            <thead>
            <tr>
                <th>Items</th>
                <th>Descripcion</th>
                <th>Costo Aluminio</th>
                <th>Peso Aluminio</th>
                <th>Costo Vidrios</th>
                <th>Peso Vidrio</th>
                <th>Costo Accesorios</th>
                <th>Costo Accesorios Adicional</th>
                <th>Peso Acces.</th>
                <th>Costo Kits</th>
                <th>Costo Mano de Obra</th>
                <th>Costo de Instalacion</th>
                <th>Instalacion Polimask</th>
                <th>Costo Andamios</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $request=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " and c.id_compuesto=0 ORDER BY c.fila ASC ");
                $t_alu = 0;
                $t_vid = 0;
                $t_acc = 0;
                $t_adi = 0;
                $t_kit = 0;
                $t_mob = 0;
                $t_ins = 0;
                $t_pol = 0;
                $t_and = 0;
                $p_alu = 0;
                $p_vid = 0;
                $p_acc = 0;
                while($row=mysql_fetch_array($request))
	        {
                    echo '<tr>';
                    echo '<td>'.$row['tip'].'</td>';
                    echo '<td>'.$row['producto'].'</td>';
                    $query_alu = mysql_query("select ifnull(sum(costo_totales),0),porcentajes,ifnull(sum(peso_totales),0) from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Aluminio','Rejillas') ");
                    $a = mysql_fetch_row($query_alu);
                    echo '<td style="text-align:right">'.number_format($a[0]).'</td><td style="text-align:right">'.number_format($a[2]).'</td>';
                    $query_vid = mysql_query("select ifnull(sum(costo_totales),0),porcentajes,ifnull(sum(peso_totales),0) from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Vidrio') ");
                    $v = mysql_fetch_row($query_vid);
                    echo '<td style="text-align:right">'.number_format(($v[0])).'</td><td style="text-align:right">'.number_format($v[2]).'</td>';
                    $query_acc = mysql_query("select ifnull(sum(costo_totales),0),porcentajes,ifnull(sum(peso_totales),0) from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Accesorios') ");
                    $ac = mysql_fetch_row($query_acc);
                    echo '<td style="text-align:right">'.number_format($ac[0]).'</td>';
                     $query_ad = mysql_query("select ifnull(sum(costo_totales),0),porcentajes,ifnull(sum(peso_totales),0) from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Adicional') ");
                    $ad = mysql_fetch_row($query_ad);
                    echo '<td style="text-align:right">'.number_format($ad[0]).'</td><td style="text-align:right">'.number_format($ad[2]+$ac[2]).'</td>';
                    $query_ki = mysql_query("select ifnull(sum(costo_totales),0),porcentajes from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Kits') ");
                    $ki = mysql_fetch_row($query_ki);
                    echo '<td style="text-align:right">'.number_format($ki[0]).'</td>';
                    $query_mo = mysql_query("select ifnull(sum(costo_totales),0),porcentajes from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Fabricacion') ");
                    $mo = mysql_fetch_row($query_mo);
                    echo '<td style="text-align:right">'.number_format($mo[0]).'</td>';
                    $query_in = mysql_query("select ifnull(sum(costo_totales),0),porcentajes from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Instalacion') ");
                    $i = mysql_fetch_row($query_in);
                    echo '<td style="text-align:right">'.number_format($i[0]).'</td>';
                    $query_p = mysql_query("select ifnull(sum(costo_totales),0),porcentajes from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Polimask') ");
                    $p = mysql_fetch_row($query_p);
                    echo '<td style="text-align:right">'.number_format($p[0]).'</td>';
                    $query_an = mysql_query("select ifnull(sum(costo_totales),0),porcentajes from costo_totales where id_cot=".$_GET["cot"]." and (id_cotizaciones='".$row['id_cotizacion']."' or id_cotizacion_mas='".$row['id_cotizacion']."') and tipo_costo in ('Andamios') ");
                    $an = mysql_fetch_row($query_an);
                    echo '<td style="text-align:right">'.number_format($an[0]).'</td>';
                    $t_alu += $a[0];
                    $t_vid += ($v[0]);
                    $t_acc += $ac[0];
                    $t_adi += $ad[0];
                    $t_kit += $ki[0];
                    $t_mob += $mo[0];
                    $t_ins += $i[0];
                    $t_pol += $p[0];
                    $t_and += $an[0];
                    $p_alu += $a[2];
                    $p_vid += ($v[2]);
                    $p_acc += $ac[2]+$ad[2];
        
                }
            ?>
                    <tr>
                        <td colspan="2">Totales</td>
                        <td style="text-align:right"><?php echo number_format($t_alu) ?><input type="hidden" id="t_alu" value="<?php echo ($t_alu) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($p_alu) ?><input type="hidden" id="p_alu" value="<?php echo ($p_alu) ?>"> Kg </td>
                        <td style="text-align:right"><?php echo number_format($t_vid) ?><input type="hidden" id="t_vid" value="<?php echo ($t_vid) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($p_vid) ?><input type="hidden" id="p_vid" value="<?php echo ($p_vid) ?>"> Kg </td>
                        <td style="text-align:right"><?php echo number_format($t_acc) ?><input type="hidden" id="t_acc" value="<?php echo ($t_acc) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_adi) ?></td>
                        <td style="text-align:right"><?php echo number_format($p_acc) ?><input type="hidden" id="p_acc" value="<?php echo ($p_acc) ?>"> Kg </td>
                        <td style="text-align:right"><?php echo number_format($t_kit) ?></td>
                        <td style="text-align:right"><?php echo number_format($t_mob) ?><input type="hidden" id="t_mob" value="<?php echo ($t_mob) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_ins) ?></td>
                        <td style="text-align:right"><?php echo number_format($t_pol) ?><input type="hidden" id="t_pol" value="<?php echo ($t_pol) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_and) ?><input type="hidden" id="t_and" value="<?php echo ($t_and) ?>"></td>
                    <tr>
                        <tr>
                        <td colspan="13">Total Costo Directo
                            <button onclick="planilla(<?php echo $_GET['cot']; ?>,<?php echo $_GET['gt']; ?>)">Planilla de Costo</button>
                        </td>
                        <td style="text-align:right">
                            <?php echo number_format($t_and+$t_pol+$t_alu+$t_ins+$t_vid+$t_acc+$t_adi+$t_kit+$t_mob) ?>
                            <input type="hidden" id="totales" value="<?php echo ($t_and+$t_pol+$t_alu+$t_ins+$t_vid+$t_acc+$t_adi+$t_kit+$t_mob) ?>">
                        </td>
                    <tr>
                        <td colspan="13">Peso Total 
                           
                        </td>
                        <td style="text-align:right">
                            <?php echo number_format($p_alu+$p_vid+$p_acc) ?>
                            <input type="hidden" id="totales" value="<?php echo ($p_alu+$p_vid+$p_acc) ?>">Kg
                        </td>
                        </tbody>

        </table>
            
            <hr>
            <?php
            $request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and id_cot_mas=0 ");
    
if($request2){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
             $table2 = $table2.'<thead >';
                           $table2 = $table2.'<tr BGCOLOR="#4E8CCF"><td colspan="9" align="center">Descripcion De Servicios</td></tr>'
                      . '<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion del servicio..'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Pago Ins'.'</th>';   
             
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Total Pago'.'</th>'; 
           
              $table2 = $table2.'<th width="10%">'.'Costo Total'.'</th>'; 
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';  //54668
	
        
	//Por cada resultado pintamos una linea
        $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
            
            
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["precio_servicio"]) ;
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd;
              
            $table2 = $table2.'<tr><td width="5%">'.$total2s.'</a></td><td width="5%">'.$row2['id_ref_mo'].'</font></td>'
                    . '<td width="40%">'.$row2['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row2["referencia"].'</td>
               <td width="10%">'.round($fr).'</td>'
                    . '<td width="10%">'.$row2["descuento_serv"].'%</td>'
                    . '<td width="10%">'.$row2["cantidad_serv"].'</td><td width="10%">'.round($dd).'</td>'
                         . '<td width="10%">'.round(($dd)).'</td>';
                    
               
	} 
	$table2 = $table2.'</table>';
         
	echo $table2;
         echo '<div align="left"><FONT color="red"><h5>TOTAL SERVICIOS.: '.round($to_serv).'</h5></FONT></div>';
      ?>
            <input type="hidden" id="to_serv" value="<?php echo ($to_serv) ?>">
            <?php
  
} 
?>

<input type="hidden" id="t_ins" value="<?php echo ($t_ins+$to_serv) ?>">
<?php

$request3=mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cot']." ");
    
if($request3){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
             $table2 = $table2.'<thead >';
               $table2 = $table2.'<tr BGCOLOR="#4E8CCF"><td colspan="10" align="center">Descripcion De Materiales</td></tr>'
                      . '<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion de los materiales'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Medida'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Costo'.'</th>';   
              $table2 = $table2.'<th width="10%">'.'Acabado'.'</th>';  
              
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th nowrap width="10%">'.'Costo Total.'.'</th>';
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_mat =0;
     
                
                
	while($row21=mysql_fetch_array($request3))
	{       
           
             $total2= $total2 +  1;
             if($row21['med']==1){
                 $mt = 1;
             }else{
      
                 $mt = ($row21['med']/1000);
             }
              $alum_porr = "SELECT costo_a,variable FROM tipo_aluminio where color_a='".$row21['color_ma']."'";
            $fia4 =mysql_fetch_array(mysql_query($alum_porr));
            $vc= $fia4["costo_a"];
            $perimetro = $row21["area"]/1000;
               if($perimetro=='0'){
                $valor_acabado = $vc;
               }else{
               $valor_acabado = $vc * $perimetro * ($row21["med"]/1000) ;
               }
            $au = (100 - $row21['aumento']) / 100;
            $prt3 = $row21["costo_mt"] / $au;
             $desm = ($row21['descuento_mat']/100) * ($prt3*$mt);
             $ddm = ((($prt3*$mt)+$valor_acabado) * $row21["cantidad_mat"]);
             $to_mat = $to_mat + $ddm;
             
             if($row21['color_ma']==''){
                 $cm = '';
             }else{
                  $cm = 'Color: '.$row21['color_ma'];
             }
            $table2 = $table2.'<tr><td width="5%">'.$total2.'</a></td><td width="5%">'.$row21['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21['descripcion'].' '.$cm.'</font></td>'
                    . '<td width="10%">'.$row21["referencia"].'<font></a></td><td width="10%">'.$row21["med"].'</td>
               <td width="10%">'.round($prt3*$mt).'</td><td width="10%">'.round($valor_acabado).'</td>'
                    . '<td width="10%">'.$row21["cantidad_mat"].'</td>'
                    . '<td width="10%">'.round($ddm).'</td>';
           
		
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2;
         echo '<div align="left"><FONT color="red"><h5>TOTAL MATERIALES.: '.round($to_mat).'</h5></FONT></div>';

} 
      ?>
            <input type="hidden" id="to_mat" value="<?php echo ($to_mat) ?>">
            <input type="hidden" id="t_adi" value="<?php echo ($t_adi+$to_mat) ?>">
            <?php

$request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']."  and b.comp='0'");
    
if($request4){
//    echo'<hr>';
       $table4 = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
             $table4 = $table4.'<thead >';
               $table4 = $table4.'<tr BGCOLOR="#4E8CCF"><td colspan="9" align="center">Descripcion De KIT</td></tr>'
                      . '<tr bgcolor="#D1EEF0">';
              $table4 = $table4.'<th width="5%">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="5%">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="40%">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Medida'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Costo'.'</th>';   
              $table4 = $table4.'<th width="10%">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Costo Total'.'</th>'; 
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2e=0;
        $to_k =0;
     
                
                
	while($row21k=mysql_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             $ddm = ((($totk) + $desm)) / $porcacc;
             $to_k = $to_k + $ddm;
             
              if($row21k['color_k']==''){
                 $ck = '';
             }else{
                  $ck = 'Color: '.$row21k['color_k'];
             }
            $table4 = $table4.'<tr><td width="5%">'.$t2e.'</a></td>'
                    . '<td width="5%">'.$row21k['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21k['producto'].' '.$ck.'</font></td>'
                    . '<td width="10%">'.$row21k["referencia_p"].'<font></a></td>
                        <td width="10%">N/A</td>
               <td width="10%">'.round(($totk)/ $porcacc).'</td><td width="10%">'.$row21k["desc_k"].'%</td>'
                    . '<td width="10%">'.$row21k["cantidad_k"].'</td><td width="10%">'.round($ddm).'</td>';
		
               
	} 
	$table4 = $table4.'</table>';
        
	echo $table4;
         echo '<div align="left"><FONT color="red"><h5>TOTAL KIT.: '.round($to_k).'</h5></FONT></div>';
         echo '<div align="left"><FONT color="red"><h4>GRAN TOTAL.: '.round($to_serv+$to_mat+$to_k).'</h4></FONT></div>';
  
} 
     ?>
            <input type="hidden" id="t_kit" value="<?php echo ($t_kit+$to_k) ?>">
            <input type="hidden" id="to_k" value="<?php echo ($to_k) ?>">
       
            </div>
    </body>
</html>
