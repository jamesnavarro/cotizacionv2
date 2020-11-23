<?php
    require '../../modelo/conexion.php';
    $solicitudes = mysqli_query($conexion,"select * from solicitudes_diseno where id_cot='".$_GET['cot']."' ");
    $s = mysqli_fetch_array($solicitudes);
    $des = $s[1].'.xls';
if (isset($_GET['exportar'])){
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$des); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",true);
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
        <title>Imprimir excel</title>
               <style>  
           .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #2A2D2E;font-size: 12px;border-bottom: 1px solid #36393B;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }</style>

    </head>
    <body>
        <?php

     if($s[0]){
         $disabled = 'disabled';
     }else{
         $disabled = '';
     }
        ?>
    
        <div id="tblReporte"  class="datagrid">
        <table style="width:100%">
             <tr>
                 <td colspan="5"><b>SOLICITUD DE COMPRA</b></td>
                                 </tr>
                                 <tr>
                                     <td>Cotizacion</td>
                                     <td><?php echo $s[1]; ?></td>
                                     <td>Fecha de Registro</td>
                                     <td><?php echo $s[6] ?></td>
                                     <td rowspan="2"></td>
                                 </tr>
                                 <tr>
                                     <td>Solicitante</td>
                                     <td><?php echo $s[3] ?></td>
                                     <td>Solicitud No.</td>
                                     <td><?php echo $s[0]; ?></td>
                                 </tr>
                                 <tr>
                                     <td colspan="2"><?php echo $s[8]; ?></td>
                                 </tr>
                             </table>
                             <table class="table table-bordered table-striped table-hover" style="width:100%">
                                           <thead><tr bgcolor="#D1EEF0">
                                                <th>ITEMS</th>
                                                <th>CANT <br>REQUERIDA</th>
                                                <th>BODEGA 14<br> EXISTENTE</th>
                                                <th>14 COLOR<br> APINTAR</th>
                                                <th>BODEGA 28<br> EXISTENTE</th>
                                                <th>28 COLOR<br> APINTAR </th>
                                                <th>CANT A<br> PEDIR</th>
                                                <th>REFERENCIA</th>
                                                <th>DESCRICION</th>
                                                <th>MEDIDA</th>
                                                <th>PERTENECE</th>
                                                <th>COLOR</th>
                                                <th>CODIGO</th>
                                                <th>PESO(KG)</th>
                                                <th>AREA</th>
                                       
                                            </tr></thead>
                                           <tbody id="mostrar_items">
                                            <?php
                                                    $cot = $_GET['cot'];
        $query = mysqli_query($conexion,"select *, sum(cantidad_sc) as cant from  solicitudes_items where id_cotizacion='$cot' group by referencia_sc, perfil_sc order by sistema,referencia_sc, perfil_sc asc");
        $iten = 0;
        $pesot=0;
        $areat=0;
        $co = 0;
        $vidrios = '';
        $sistema = '';
        $v = '';
        $re='';
        while($m = mysqli_fetch_array($query)){
            $iten += 1;
            if($m['codigo']=='0'){
              
               $peso=0;
               $area=0;
            }else{
            $result = mysqli_query($conexion,"select peso,area from  referencias where codigo='".$m['codigo']."'");
            $p = mysqli_fetch_array($result);
               $peso = ($p['peso']*$m['cant']);
               $area = ($p['area']*$m['cant']);
            }
               $pesot += $peso;
               $areat += $area;
              
            
               $re=$m['referencia_sc'];
               if($sistema!=$m['sistema']){
         
                   echo  '<tr style="background:#F2F966;"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td style="text-align:center"><b>Sistema '.$m['sistema'].' </b></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>'; 
               }
               $queru = mysqli_query($conexion,"select items from  solicitudes_items where id_cotizacion='$cot' and sistema='".$m['sistema']."' and perfil_sc=".$m['perfil_sc']." and referencia_sc='".$m['referencia_sc']."' group by items ");
                   $ti='';
                   while($vt = mysqli_fetch_array($queru)){
                       $ti = $ti.' '.$vt[0].', ';
                   }
               $sistema=$m['sistema'];
               
               $co = $m['id_cot_items'];
               $idp = $m['id_producto'];
               $cadena_de_texto = $m['descripcion_sc'];
            $cadena_buscada   = 'MM';
            $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
            if ($posicion_coincidencia === false) {
                $cadena = $m['descripcion_sc'];
            }ELSE{
                $cadena = substr($m['descripcion_sc'], 0,-6).' '.$m['perfil_sc'].'MM';
            }
            $perfil = $m['perfil_sc']/1000;
            echo '<tr>'
            . '<td style="text-align:center">'.$iten.'</td>'
            . '<td style="text-align:center">'.$m['cant'].'</td>'
            . '<td style="text-align:center"></td>'
            . '<td style="text-align:center"></td>'
            . '<td style="text-align:center"></td>'
            . '<td style="text-align:center"></td>'
            . '<td style="text-align:center"></td>'
            . '<td>'.$m['codigo'].'</td>'
            . '<td>'.  utf8_decode($cadena).'</td>'
            . '<td>'.number_format($perfil, 2,',','00').'</td>'
            . '<td>'.$ti.'</td>'
            . '<td>'.$m['color_sc'].'</td>'
            . '<td>'.$m['referencia_sc'].'</td>'
            . '<td>'.$peso.' Kg</td>'
            . '<td>'.$area.' M<sup>2</td>';

        }
        
         echo '<tr>'
            . '<td style="text-align:center">'.$iten.'</td>'
            . '<td style="text-align:center">-</td>'
                 . '<td style="text-align:center">-</td>'
                 . '<td style="text-align:center">-</td>'
                 . '<td style="text-align:center">-</td>'
                 . '<td style="text-align:center">-</td>'
                 . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">-</td>'
            . '<td style="text-align:center">'.$pesot.'</td>'
            . '<td style="text-align:center">'.$areat.'</td>'

                                            
                                            ?>
                                           </tbody> 
                                        </table>  
            <table class="table table-bordered table-striped table-hover" style="width:100%">
                <tr>
                    <td>Items Vidrios</td>
                    <td>Espesor y Color</td>
                    <td>Tipo de Vidrio</td>
                    <td>Metros Cuadrados</td>
                    
                </tr>
                <?php
                $vervid = mysqli_query($conexion,"SELECT a.id_vidrio, traz_vid, ancho_c, alto_c,sum((ancho_c/1000)*(alto_c/1000)) as mt , color_v, producto FROM cotizaciones a, tipo_vidrio b, producto c where a.id_vidrio=b.id_vidrio and a.traz_vid=c.id_p and a.id_cot=$cot and a.estado_item='Aprobado' group by a.id_vidrio, a.traz_vid");
        $vp = '';$num=0;
        $idv = '';
        $mtt = 0;
        while($vd = mysqli_fetch_array($vervid)){
                $num++;
//                $vp = $vp.''.$vd[5].' '.$vd[6].' '.number_format($vd[4],2,',','').'<br>';
                echo '<tr> '
                        . '<td>'.$num.'</td>'
                        . '<td>'.$vd[5].'</td>'
                        . '<td>'.$vd[6].'</td>'
                        . '<td>'.number_format($vd[4],2,',','').'</td>';
              
        }
                
                ?>
            </table>
            
            </div>
    </body>
</html>
<script>
//    function descargarExcel(){
//        //Creamos un Elemento Temporal en forma de enlace
//        var tmpElemento = document.createElement('a');
//        // obtenemos la información desde el div que lo contiene en el html
//        // Obtenemos la información de la tabla
//        var data_type = 'data:application/vnd.ms-excel';
//        var tabla_div = document.getElementById('tblReporte');
//        var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
//        tmpElemento.href = data_type + ', ' + tabla_html;
//        //Asignamos el nombre a nuestro EXCEL
//        tmpElemento.download = 'reporte_desglose.xls';
//        // Simulamos el click al elemento creado para descargarlo
//        tmpElemento.click();
//    }
//    descargarExcel();
</script>