 <?php 
 include '../../modelo/conexion.php';
session_start();
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Planilla de Costo</title>
    <script src="../../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../../js/ajax.js" type="text/javascript"></script>
            <script src="funciones.js?<?php echo rand(1,999) ?>" type="text/javascript"></script>
    </head>
    <body>
              <table>
                  <label></label>
                  <th><input type="hidden" id="total" value="<?php echo $_GET['t'] ?>"/>
                      </th>
              </table>  
                       
<?php
if(isset($_GET['despalu'])){$despalu =  $_GET['despalu'];}else{ $despalu= 20;}
if(isset($_GET['despvid'])){$despvid =  $_GET['despvid'];}else{ $despvid= 20;}
if(isset($_GET['despacc'])){$despacc =  $_GET['despacc'];}else{ $despacc= 5;}
$total_alum = ($_GET['t_alu'] / ((100-$despalu)/100) ) - $_GET['t_alu'];
$total_vid = ($_GET['t_vid'] / ((100-$despvid)/100) ) - $_GET['t_vid'];
$suma_acc = $_GET['t_acc'] + $_GET['t_kit'] + $_GET['t_adi'];
$total_acc = ($suma_acc / ((100-$despacc)/100) ) - $suma_acc;

$fabricacion = $_GET['t_mob'] * 1.45;
$instalacion = $_GET['t_ins'] * 1.45;
$poli = $_GET['t_pol'] * 1.45;
//con este es N25 base del calculo
$costo_totales = $_GET['t_and'] +  $_GET['t_alu'] + $_GET['t_vid'] + $suma_acc + $total_alum + $total_vid + $total_acc + $fabricacion + $instalacion + $poli;


?>
  <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
      <div style="float: left">
  <table class="table table-bordered">
      <tr><th  bgcolor="#A9D0F5" colspan="5" style="color:black;text-align:left;">Costo de Produccion</th>
      <tr>
          <td>Materia Prima Aluminio</td>
          <td></td>
          <td><input id="mp_aluminio" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_alu']) ?>"/>
          <input id="mp_aluminio1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_alu']) ?>"/></td>
          <td></td><td><input id="mp_aluminio2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_alu']) ?>"/>
          <input id="mp_aluminio3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_alu']) ?>"/></td>
      </tr>
      <tr>
          <td>Materia Prima Vidrio</td>
          <td></td>
          <td><input id="mp_vidrio" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_vid']) ?>"/>
          <input id="mp_vidrio1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_vid']) ?>"/></td>
          <td></td><td><input id="mp_vidrio2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_vid']) ?>"/>
          <input id="mp_vidrio3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_vid']) ?>"/></td>
      </tr>
      <tr>
          <td>Materia Prima Accesorios</td>
          <td></td>
          <td><input id="mp_accesorios" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_acc']) ?>"/>
          <input id="mp_accesorios1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_acc']) ?>"/></td>
          <td></td><td><input id="mp_accesorios2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_acc']) ?>"/>
          <input id="mp_accesorios3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_acc']) ?>"/></td>
      </tr>
      <tr>
          <td>Accesorios Adicionales</td>
          <td></td>
          <td><input id="mp_adicionales" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_adi']) ?>"/>
          <input id="mp_adicionales1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_adi']) ?>"/></td>
          <td></td><td><input id="mp_adicionales2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_adi']) ?>"/>
          <input id="mp_adicionales3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_adi']) ?>"/></td>
      </tr>
      <tr>
          <td>Kit Adicionales</td>
          <td></td>
          <td><input id="mp_kit" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_kit']) ?>"/>
          <input id="mp_kit1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_kit']) ?>"/></td>
          <td></td><td><input id="mp_kit2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_kit']) ?>"/>
          <input id="mp_kit3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_kit']) ?>"/></td>
      </tr>
      <tr>
          <td>Costo de Mano de Obra Fabr.</td>
          <td></td>
          <td><input id="mp_fabricacion" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($fabricacion) ?>"/>
          <input id="mp_fabricacion1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($fabricacion) ?>"/></td>
          <td></td><td><input id="mp_fabricacion2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($fabricacion) ?>"/>
          <input id="mp_fabricacion3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($fabricacion) ?>"/></td>
      </tr>
      <tr>
          <td>Costo de Mano de Obra de Inst.</td>
          <td></td>
          <td><input id="mp_instalacion" type="hidden" onchange="andamio()" style="width:90px;text-align: right" value="<?php echo ceil($instalacion) ?>"/>
          <input id="mp_instalacion1" type="text" onchange="pasar('mp_instalacion','mp_instalacion1');andamio();" style="width:90px;text-align: right" value="<?php echo number_format($instalacion) ?>"/></td>
          <td></td><td><input id="mp_instalacion2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($instalacion) ?>"/>
          <input id="mp_instalacion3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($instalacion) ?>"/></td>
      </tr>
      <tr>
          <td>Costo Inst. Polimask</td>
          <td></td>
          <td><input id="mp_polimask" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($poli) ?>"/>
          <input id="mp_polimask2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($poli) ?>"/></td>
          <td></td><td><input id="mp_polimask2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($poli) ?>"/>
          <input id="mp_polimask3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($poli) ?>"/>
          </td>
      </tr>
      <tr>
          <td>Costo de Andamios</td>
          <td></td>
          <td><input id="mp_andamio" onchange="andamio()" type="hidden" style="width:90px;text-align: right"  value="<?php echo ceil($_GET['t_and']) ?>"/>
          <input id="mp_andamio1" onkeyup="pasar('mp_andamio','mp_andamio1');andamio()" type="text" style="width:90px;text-align: right"  value="<?php echo number_format($_GET['t_and']) ?>"/></td>
          <td></td><td><input id="mp_andamio2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo ceil($_GET['t_and']) ?>"/>
          <input id="mp_andamio3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_and']) ?>"/></td>
      </tr>
      <tr>
          <td>Desperdicio de Aluminio</td>
          <td><input type="text" id="por_alum" name="por"  onchange="calcular();" value="<?php if(isset($_GET['despalu'])){echo $_GET['despalu'];}else{ echo '20';} ?>"  style="width:50px;text-align: right" />%</td>
          <td><input id="desp_alum" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_alum,2,'.','') ?>"/>
          <input id="desp_alum1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_alum) ?>"/></td>
          <td></td><td><input id="desp_alum2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_alum,2,'.','') ?>"/>
          <input id="desp_alum3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_alum) ?>"/></td>
      </tr>
      <tr>
          <td>Desperdicio de Vidrio</td>
          <td><input type="text" id="por_vid" name="por"  onchange="calcular();" value="<?php if(isset($_GET['despvid'])){echo $_GET['despvid'];}else{ echo '20';} ?>"  style="width:50px;text-align: right" />%</td>
          <td><input id="desp_vidrio" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_vid,2,'.','') ?>"/>
          <input id="desp_vidrio1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_vid) ?>"/></td>
          <td></td><td><input id="desp_vidrio2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_vid,2,'.','') ?>"/>
          <input id="desp_vidrio3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_vid) ?>"/></td>
      </tr>
      <tr>
          <td>Desperdicio de Accesorios</td>
          <td><input type="text" id="por_acc" name="por"  onchange="calcular();" value="<?php if(isset($_GET['despacc'])){echo $_GET['despacc'];}else{ echo '5';} ?>"  style="width:50px;text-align: right" />%</td>
          <td><input id="desp_accesorios" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_acc,2,'.','') ?>"/>
          <input id="desp_accesorios1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_acc) ?>"/></td>
          <td></td><td><input id="desp_accesorios2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_acc,2,'.','') ?>"/>
          <input id="desp_accesorios3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_acc) ?>"/></td>
      </tr>

      <tr   bgcolor="yellow">
          <th>Total Costo de Produccion</th>
          <td></td>
          <td><input id="total_costo_1" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($costo_totales,2,'.','') ?>"/>
          <input id="total_costo_11" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($costo_totales) ?>"/></td>
          <td></td>
          <td><input id="total_costo_2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($costo_totales,2,'.','') ?>"/>
          <input id="total_costo_2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($costo_totales) ?>"/></td>
      </tr>
   
    <?php
 
    $query = mysql_query("SELECT * FROM costos ");

    $encabezado = '';
    $c = 0;
    $cont=0;
    $porcentajes_totales = 0;
    $td = '';
     $suma_por =0;
     $suma_pvbi = 0;
     $sub_total_base = 0;
     $totales_operador_1 = $costo_totales;
     $por_comisiones = 0;
    while ($fila = mysql_fetch_array($query)){
        $cont ++;
        //1 . linea de codigo para mostrar el encabezado de la lista
        
        if($encabezado == $fila['categoria_costos']){
            $c = 0; 
        }else{
            if($c==0){
               
                if($cont!=1){
                        
    $total_operador_1 = $costo_totales * ($porcentajes_totales/100);
    $total_operador_2 = $costo_totales * ($porcentajes_totales/100);
    
    $totales_operador_1 += $total_operador_2;
    
                       $td = '<tr><th>TOTALES'
                       . '<td><input id="por_total'.$cont.'" type="text" style="width:50px;text-align: right" disabled value="'.$porcentajes_totales.'"/>'
                       . '<td><input id="sub_total2'.$cont.'" type="text" value="" style="width:90px;text-align: right" disabled/>'
                       . '<td></td><td><input id="sub_total3'.$cont.'" value="" type="hidden" style="width:90px;text-align: right" disabled/>';
                    $porcentajes_totales = 0;
                }else{
                    $td='';

                } 
                 
               echo $td.'<tr><th  bgcolor="#A9D0F5" colspan="5" style="color:black;text-align:left;">'.$fila['categoria_costos'].'</th>';
               
            }
            
            $c ++;
           
        }
        $porcentajes_totales += $fila['porcentaje'];
        //1. ____----------------------------------------------------
        //esta linea de codigo es para habilitar y deshabilitar las cajas de textos
        if ( $fila['suma_toral']== 'No'){
            $disabled='disabled';
        }else{
            $disabled='';
        }
        if ( $fila['edita_valor']== 'No'){
            $disabled_valor='disabled';
        }else{
            $disabled_valor='';
        }
        if ( $fila['variabledos']== 'No'){
            $x='x';
        }else{
            $x='';
        }
        if ( $fila['suma_porcentaje']== 'Si'){
            $no = '*';
            $suma_por +=$fila['porcentaje'];
        }else{
            $suma_por +=0;
            $no = '';
        }
         $costo_pviv = $costo_totales * $fila['porcentaje'];
         if ( $fila['variabletres']== 'Si'){
            $s='>';
            $suma_pvbi += $fila['porcentaje'];
           
            $sub_total_base += $costo_pviv;
        }else{
            $s='';
            $suma_pvbi += 0;
            $sub_total_base += 0;
        }
        if ( $fila['variableuno']== 'Si'){
            $co='c';
            $p_com = ($fila['porcentaje']/100) * 1.1;
            $por_comisiones += $p_com;
        }else{
            $p_com = 0;
            $co='';
            $por_comisiones += 0;
        }
        
        $operador_1 = $costo_totales * ($fila['porcentaje']/100);
        //fin ----------------------------------------------------------------------precio_base_1
  $precio_base = $costo_totales / ((100-$suma_por) / 100);
$sub_precio_base_2 = $precio_base * 0.15;
$precio_base_2 = $sub_precio_base_2 + $precio_base;

$sub_suma_pvbi = ($suma_pvbi/100) * $precio_base;
$total__pvbi = $sub_suma_pvbi + $precio_base;

$sub_suma_pvbi_2 = ($suma_pvbi/100) * $precio_base;
$total__pvbi_2 = $sub_suma_pvbi_2 + $precio_base_2;

$ganancia_esperada_1 = $precio_base * (0 /100);
$ganancia_esperada_2 = $total__pvbi_2 * ((10/100) + 1);
        $encabezado = $fila['categoria_costos'];
        $numa = "'operacionuno".$cont."'";
        $numb = "'operacionunox".$cont."'";
        echo '<tr>' 
        . '<td><input type="checkbox" id="'.$cont.'" name="item" checked disabled>'.$fila['descripcion'].''
        . '<input type="hidden" id="suma_utilidad'.$cont.'" value="'.$fila['variabledos'].'"/>'
        . '<input type="hidden" id="suma_transporte'.$cont.'" value="'.$fila['variabletres'].'"/>'
        . '<input type="hidden" id="p_comision'.$cont.'" value="'.$fila['variableuno'].'"/>'
        . '<input type="hidden" id="base'.$cont.'" value="'.$fila['operadordos'].'"/></td>'
        . '<td style="text-align:right;"><input type="hidden" id="suma_por'.$cont.'" value="'.$fila['suma_porcentaje'].'"  style="width:30px;text-align: right" '.$disabled.'/>'
        . ' '.$no.' '.$s.''.$x.''.$co.'<input type="text" id="porcen'.$cont.'" onchange="calcular();"  name="por"  onchange="calcular();" value="'.$fila['porcentaje'].'"  style="width:50px;text-align: right" '.$disabled.'/>%</td>' 
        .'<td style="text-align:right;">'
                . '<input id="operacionuno'.$cont.'" '.$disabled_valor.' onchange="recalcular('.$cont.');" type="hidden" value="" style="width:90px;text-align: right" />'
                . '<input id="operacionunox'.$cont.'" '.$disabled_valor.' onchange="pasar('.$numa.','.$numb.');recalcular('.$cont.');" type="text" value="" style="width:90px;text-align: right" /></td>' 
        .'<td></td><td style="text-align:right;"><input id="operaciondos'.$cont.'"  disabled type="hidden" value="" style="width:90px;text-align: right"/>'
                . '<input id="operaciontre'.$cont.'"  disabled type="text" value="" style="width:90px;text-align: right"/></td>';
    }

        $total_operador_1 = $costo_totales * ($porcentajes_totales/100);
    $total_operador_2 = $costo_totales * ($porcentajes_totales/100);
    echo '<tr><th>TOTALES'
                       . '<td><input type="hidden" id="porcentaje_transporte" value="'.$suma_pvbi.'"/>'
                      . '*<input id="por_total'.$cont.'" type="text" style="width:50px;text-align: right" disabled value="'.$porcentajes_totales.'"/>%'
                       . '<td><input id="sub_total2'.$cont.'" value=""  type="text" style="width:90px;text-align: right" disabled/>'
                       . '<td></td><td><input id="sub_total3'.$cont.'" value=""  type="hidden" style="width:90px;text-align: right" disabled/>'
            . '<input id="sub_total4'.$cont.'" value=""  type="text" style="width:90px;text-align: right" disabled/>';
echo '<tr>'
    . '<td>Total Costos Fijos </td>'
        . '<td>*<input type="text" id="total_costo_fijos_1" value="'.$suma_por.'"  style="width:50px;text-align: right" '.$disabled.'/>%</td>'
        . '<td></td>'
        . '<td>*<input type="text" id="total_costo_fijos_2" value="'.$suma_por.'"  style="width:50px;text-align: right" '.$disabled.'/>%</td>'
        . '<td></td>';
echo '<tr>'
    . '<td>Ganancia esperada</td>'
        . '<td><input type="text" id="ganancia_1" value="0"  onchange="calcular();" style="width:50px;text-align: right" /></td>'
        . '<td><input id="ganancia_esperada_1" type="text" value="'.number_format($ganancia_esperada_1,2,'.','').'" style="width:90px;text-align: right" disabled ></td>'
        . '<td><input type="text" id="ganancia_2" value="15"  onchange="calcular();" style="width:50px;text-align: right" /></td>'
        . '<td><input id="ganancia_esperada_2" type="hidden" value="'.number_format($ganancia_esperada_2,2,'.','').'" style="width:90px;text-align: right" disabled/>'
        . '<input id="ganancia_esperada_3" type="text" value="'.number_format($ganancia_esperada_2).'" style="width:90px;text-align: right" disabled/></td>';
echo '<tr>'
    . '<td>Margen estimado de contribución</td>'
        . '<td>*<input type="text" id="margen_1" value="'.($suma_por+0).'"  style="width:50px;text-align: right" '.$disabled.'/>%</td>'
        . '<td></td>'
        . '<td>*<input type="text" id="margen_2" value="'.($suma_por+10).'"  style="width:50px;text-align: right" '.$disabled.'/>%</td>'
        . '<td></td>';


    ?>
        <tr   bgcolor="yellow">
          <th colspan="">Precio Base 1</th>
          <td></td>
          <td><input id="precio_base_1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($precio_base,2,'.','') ?>"/></td>
          <td></td>
          <td><input id="precio_base_2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($precio_base_2,2,'.','') ?>"/>
          <input id="precio_base_3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($precio_base_2) ?>"/></td>
      </tr>
              <tr   bgcolor="yellow">
          <th colspan="">Precio de Venta Base Inicial</th>
          <td></td>
          <td><input id="precio_venta_base_1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total__pvbi,2,'.','') ?>"/></td>
          <td></td>
          <td><input id="precio_venta_base_2" type="hidden" style="width:90px;text-align: right" disabled value="<?php echo number_format($total__pvbi_2,2,'.','') ?>"/>
          <input id="precio_venta_base_3" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total__pvbi_2) ?>"/></td>
      </tr>
            </tr>
              <tr   bgcolor="yellow">
          <th colspan="">Ganancia Real</th>
          <td></td>
          <td></td>
          <td><input id="por_ganancia_real" type="text" style="width:40px;text-align: right" disabled value=""/>%</td>
          <td><input id="Ganancia_real" type="hidden" style="width:90px;text-align: right" disabled value=""/>
          <input id="Ganancia_real2" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
          <tr   bgcolor="yellow">
          <th colspan="">Ajuste de Precio</th>
          <td></td>
          <td></td>
          <td><input id="por_ajuste" type="text" style="width:40px;text-align: right" disabled value=""/>%</td>
          <td><input id="ajuste" type="hidden" style="width:90px;text-align: right" disabled value=""/>
          <input id="ajuste2" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
                <tr   bgcolor="yellow">
          <th colspan="">Comisiones</th>
          <td></td>
          <td></td>
          <td></td>
          <td><input id="comision" type="hidden" style="width:90px;text-align: right" disabled value=""/>
          <input id="comision2" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="">Utilidad Neta del Proyecto</th>
          <td></td>
          <td><input id="utilidad_1" type="text" style="width:90px;text-align: right" disabled value=""/></td>
          <td></td>
          <td><input id="utilidad_2" type="hidden" style="width:90px;text-align: right" disabled value=""/>
          <input id="utilidad_3" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
      
      <tr   bgcolor="yellow">
          <th colspan="4">Precio de Venta Planilla </th>
          <td><input id="precio_venta" type="hidden" style="width:90px;text-align: right" disabled value=""/>
              <input id="precio_venta_f" type="hidden" style="width:90px;text-align: right" disabled value=""/>
          <input id="precio_venta_f2" type="text" style="width:90px;text-align: right" disabled value=""/>
          </td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="4">Precio de Venta Presupuesto </th>
          <td><input id="pre" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['gt']) ?>"/></td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="4">Diferencia de Precio </th>
          <td><input id="dif" type="text" style="width:90px;text-align: right" disabled value=""/>
          </td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="4">Porcentaje a subir</th>
          <td><input id="subir" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
  </table> 
 </div>
      <div style="float: right" id="imp">
<!--          <table>
              <tr>
                  <th>Seleccionar </th>
                  <th>Comision </th>
                  <th>Incremento </th>
              </tr>
              <?php
                $con = mysql_query("select * from comisiones");
                while($co = mysql_fetch_array($con)){
                    
                    echo '<tr>'
                    . '<td><input type="radio" id="sel'.$co[1].'" value="'.$co[2].'" name="sel"></td>'
                    . '<td>%<input type="text" id="com'.$co[1].'" value="'.$co[1].'" style="width:40px;text-align: right" disabled></td>'
                    . '<td>%<input type="text" id="inc'.$co[1].'" value="'.$co[2].'" style="width:40px;text-align: right" disabled></td>'
                    . '</tr>';
                }
              ?>
          </table>-->
          
           <button class="btn btn-primary" onclick="calcular();">Calcular</button>
           <button class="btn btn-primary" onclick="calcular();">Ajustar Presupuesto</button>
          <button class="btn btn-primary" onclick="imprimir();">Imprimir</button>
          <button class="btn btn-primary" onclick="window.close();">Salir</button>
          <br>
          <br>
          Comision:    <select id="tabla_comision">
              <?php
              $coms = mysql_query("select * from comisiones");
              while($cov = mysql_fetch_array($coms)){
                  echo '<option value="'.$cov[1].'">'.$cov[1].'% + '.$cov[2].'%</option>';
              }
              ?>
          </select>
          <fieldset>
              <legend>Costos</legend>
          <br>
          <table style="width: 100%;text-align: center">
              <tr>
                  <td>Precio de Venta Real</td><tr>
                  <td>$<input type="text" id="venta" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Precio de Venta Presupuesto</td><tr>
                  <td>$<input type="hidden" id="presupuestox" value="<?php echo $_GET['gt'] ?>"  disabled>
                      <input type="text" id="presupuesto" value="<?php echo number_format($_GET['gt']) ?>" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Diferencia</td><tr>
                  <td>$<input type="text" id="diferencia" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Porcentaje de diferencia</td><tr>
                  <td>%<input type="text" id="por_dif" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
          </table>
          </fieldset>
      </div>
    </body>
</html>
