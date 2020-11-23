<?php
session_start();
include '../modelo/conexion.php';
require '../modelo/consultar_permisos.php';
         if(isset($_GET['salir'])){               
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";
         }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <head>
        <meta charset="UTF-8">
        <title>Conf. de idioma</title>
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
        <script src="../js/buscadores.js" type="text/javascript"></script>

              
        <style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#ffffff; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>
<script>

	function isNumeric(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	function actualizar() {
		$("input[name=item]:checked").each(function(){
    
	                 var id = $(this).attr("id");
                         var idcot = $("#idcotizacion"+id).val();
                         var desc = $("#ingles"+id).val();
                    
                          $.ajax({
                                post:'GET',
                                data:'sw=19&idcot='+idcot+'&desc='+desc,
                                url:'../vistas/desglose/acciones.php',
                                success:function(d){
                                    
                                }
                         });
                                
                 });
	}
</script>
    </head>
    <body>
        <button onclick="actualizar()">Actualizar</button>
     
       
        <hr>
	<?php
		if (isset($_GET['cot'])) {
			$sql21 = "SELECT * FROM cotizacion WHERE id_cot = " . $_GET['cot'];
			$fila21 = mysqli_fetch_array(mysqli_query($conexion,$sql21));
			$orden_p = $fila21["orden"];
			$estado = $fila21["estado"];
			$costo_total = $fila21["costo_total"];
			$costo_instalacion = $fila21["costo_instalacion"];
			$descuento = $fila21["descuento"];
			$desc_gen = $fila21["desc_general"];
			$express = $fila21["express"];
      $iva = $fila21["sel_iva"];
 }  
if(isset($_GET['cot'])){ 
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_compuesto=0 and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." order by c.fila asc ");

if($request){
//    echo'<hr>';
       $table = '<div class="datagrid"><table class="table table-bordered table-striped table-hover" id="tabla">';
             $table = $table.'<thead >';
              $table = $table.'<tr>';
        $table = $table.'<th>'.'Tipo'.'</th>'; 
                $table = $table.'<th>'.'#'.'</th>'; 
              $table = $table.'<th>'.'Producto'.'</th>';
              $table = $table.'<th>'.'Descripcion en otro idioma.'.'</th>';
               $table = $table.'<th>'.'Ancho x Alto'.'</th>';
               $table = $table.'<th>Medidas en Pulg.</th>';
               $table = $table.'<th>Mt2</th>';
               $table = $table.'<th>Pie 2</th>';
               $table = $table.'<th>'.'Cant'.'</th>';
               
               $table = $table.'<th>'.'Precio Total.'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead><tbody>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;$CT=0;$ddd = 0;
        $vt = 0;
	while($row=mysqli_fetch_array($request))
	{    
               $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));

                $s3 = "SELECT (".$row["porcentaje"].") as p FROM porcentajes where area_por='".$row["linea_cot"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
                
            $comp=mysqli_query($conexion,"SELECT count(*) FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm1 = mysqli_fetch_array($comp);
            $d = $cm1['count(*)'];
            
            $ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysqli_fetch_array($ac);
            $mt = $cm['count(*)'];
            
              $ak =mysqli_query($conexion,"SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$row["id_cotizacion"]." and b.comp='1'  ");
            $ck = mysqli_fetch_array($ak);
            $mtk = $ck['count(*)'];
             $compu =mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysqli_fetch_array($compu)){
 
                         $sx = "SELECT (".$fila["porcentaje_sub"].") as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                $fix =mysqli_fetch_array(mysqli_query($conexion,$sx));
                $multx= $fix["p"]/100;
                
          $costo_sp += $fila['valor_sp'] ;
          $costo_fom_sp += $fila['valor_fom_sp'];
          $costo_mp += $fila['valor_c_sub']/$multx;
          $costo_fom_mp += $fila['valor_fom_sub'];
    }
            $t = $d + $mt + $mtk;
      
            
     
                $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
            if($row['poralu']!=0){
               $a = $row['precio_item'];
               $version = '<b>Cotizador V 2.0</b>';
           }else{
               $a = (($row["valor_c"] / $mult) + ($row["ajuste"]*$row["cantidad_c"]))  + $pad + $tk;
           }
            $pad2 = (($costo_mp* $row["cantidad_c"]));
            $tk2 = ($row["precio_material"])* $row["cantidad_c"];
           $total_conp = (($row["valor_c"] + $tk2)) + $pad2 ;

            $ddd = $row["descuento_g"];
//            echo ($tk ) .'<br>';
            if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $cont = $cont + 1;
            if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;
            $pu3 = ($a/$row["cantidad_c"]);
             $ptt3 = ($pu3) * $row["cantidad_c"];
            $tip = $row['tip'];
            $tip2 = $row['fila'];
            $select = $row["desc"];

        $select2 = '<input type="HIDDEN" value="'.$row['valor_temp'].'" name="temp'.$cont.'" style="width:90px">'.$row['porcentaje_mp'];
        $vt += $row['valor_temp'] * $row["cantidad_c"];
        
       
        $pulg1 = $row["ancho_c"]*0.0393701;
        $pulg2 = $row["alto_c"]*0.0393701;
        $mt2 = ($row["ancho_c"]/1000)*($row["alto_c"]/1000);
        $pie1 = ($row["ancho_c"]/1000) * 3.28084;
        $pie2 = ($row["alto_c"]/1000) * 3.28084;
        $piecuadrado = $pie1 * $pie2;
        //0.0393701
       $contenido = $row["descripcion_ingles"];
       $query_dolar = "SELECT precio FROM dolar_actual where id_actual=".$row['id_dolar_actual']." ";
       $dll =mysqli_fetch_array(mysqli_query($conexion,$query_dolar));
                
           
            $iva3 = $ptt * ($iva/100);
            $tota = $ptt + $iva3;
                $CT = $CT + ($total_conp);
    $COS = $total_conp / $row["cantidad_c"];
    $POR = (($ptt - ($total_conp)) / $ptt)*100;
    
    $sqft = ($mt2*$row["cantidad_c"]) /  0.0929;
    
    $precio_dolar = $ptt / $dll[0];
            $table = $table.'<tr>'
                    . '<td>'.$tip.'</td>'
                    . '<td>'.$tip2.'</td>
                       <td>'.substr($row['descripciones'], 0, -4).'.'.$dll[0].' '.$row['id_dolar_actual'].'</td>'
                    . '<td><input type="hidden" name="sistema'.$cont.'" id="idcotizacion'.$cont.'" style="width:70px" value="'.$row['id_cotizacion'].'">'
                    . '<textarea id="ingles'.$cont.'">'.$contenido.'</textarea>
                        <input type="checkbox" name="item" id="'.$cont.'" checked></td>
                       <td>'.$row["ancho_c"].'x'.$row["alto_c"].'</td>
                       <td>'.number_format($pulg1,2,',','.').'x'.number_format($pulg2,2,',','.').'</td>
                       <td>'.number_format($sqft,2,',','.').'</td>
                       <td>'.number_format(($piecuadrado*$row["cantidad_c"]),2,',','.').'</td>
                       <td>'.$row["cantidad_c"].'</td><td>$'.number_format($precio_dolar,2,',','.').'</font></td>
                       </tr>';   
           
		    

                
	} 
	$table = $table.'</tbody></table></div>';
        if($estado=='En proceso'){
        if(isset($ch)){
        echo $ch;}
        
        }else{
            echo '<button><img src="../images/ok.png"> Aprobado</button>'; 
        }
	echo $table.'<input type="hidden" name="cant" value="'.$cont.'">';
        
        ///  --------------------------------------------servicios-----------------------------------------

        echo '<hr>';
        ?>
        <form name="buscarA" action="../vistas/print_us.php" method="get"  target="_blank"  enctype="multipart/form-data">
                <div align="right">
                    <input style="width:30px;" type="hidden" name="cot" id="cotizacionx" value="<?php echo $_GET['cot']; ?>">
                    <input style="width:30px;" type="hidden" name="c" value="">
                    <input style="width:30px;" type="hidden" name="ciudad" value="<?php if(isset($_POST['col'])){echo $_POST['ciudad'];} ?>">
                    <input style="width:30px;" type="hidden" name="total_item" id="TotalItem" value="<?php echo $cont; ?>" /><!--Codigo Agregado (Jaime)-->
                    <input style="width:30px;" type="number" name="col" value="<?php if(isset($_POST['col'])){echo $_POST['col'];}else{echo '7';} ?>">
                  <input style="width:30px;" type="hidden" name="granto" id="to" value="<?php echo (($tacot + $iva) - $des); ?>">
                 
                    
                    <button type="submit"><img src="../imagenes/print.png"> Imprimir PDF</button>   
                </div>
          </form>
        <?php
        if($cont!=0){
            if($vt!=0){
                $tacot = $vt;
                $des = $tacot * ($desc_gen / 100);
                $iva = ($tacot - $des) * ($iva/100);
            }else{
                $des = $tacot * ($desc_gen / 100);
                $iva = ($tacot - $des) * ($iva/100);
            }
     echo '<div align="right"><FONT color="red"><h5>SUBTOTAL COT.: $<input style="width:80px;" type="text" value="'.number_format($tacot- $des).'">';
      echo 'DESCUENTO: <input type="text" style="width:40px;" value="'.number_format($ddd).'%"> ';
     echo 'IVA COT.: $<input type="text" style="width:80px;" value="'.number_format($iva).'">';
     echo 'TOTAL COT.: $<input type="text" style="width:90px;" value="'.number_format(($tacot + $iva) - $des).'"></h5></FONT></div><hr>';
     
        } 
     
     
} 
                                           } 
                       

                                           ?>

    </body>
</html>
