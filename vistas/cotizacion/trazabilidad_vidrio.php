<?php
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$idvidrio."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));

$espesor= $fi3['espesor_v'];
$moneda= $fi3['moneda'];
$color= $fi3['color_v'];
$peso = $m2 * $espesor * 2.5;
if($dolar_actual==0){
    $costo_vidrio= $fi3['costo_v'];
}else{
    $queryx = mysqli_query($conexion,"select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='$idvidrio' and b.categoria='Vidrio' ");
    $o = mysqli_fetch_array($queryx);
    if($moneda=='COP'){
        $costo_vidrio= $o['precio_actual'];
    }else{
        $costo_vidrio= $o['precio_dolar']*$o['precio'];
    }
    
    
    
} 

include 'consultar_trazvid.php';
//echo 'peso del vidrio'.number_format($peso).'<br>';54935  33070182
//se calcula el valor total por metro cuadrado del vidrio cotizado Zorayadeahumada
//echo 'Costo'. $costo_vidrio;
$vvc = $m2 * $costo_vidrio;
  $tabla = '<table  class="table table-bordered table-striped table-hover">';
             $tabla = $tabla.'<thead >';
              $tabla = $tabla.'<tr bgcolor="#D1EEF0">';
              $tabla = $tabla.'<th>*'.$dolar_actual.' '.$idvidrio.' '.$o['id_referencia'].' '.$color.' ('.$moneda.' '.$costo_vidrio.').  </th>';
               $tabla = $tabla.'<th>'.'Costo Und'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Perforacion y Boquete'.'</th>';
                $tabla = $tabla.'<th>'.'Cantidad'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Total'.'</th>';
               $tabla = $tabla.'<th>'.'Costo + Desp'.'</th>';
               $tabla = $tabla.'<th>'.'Und Med.'.'</th>';
                $tabla = $tabla.'</tr>';
              $tabla = $tabla.'</thead>';
              $totdespvid = $vvc/$porc;
 $tabla = $tabla.'<tr>
                    <td colspan="7">COSTO X M<SUP>2</SUP> :<b><font color="green">'.number_format($vvc/$cantidad).' X '.number_format($cantidad).' = '.number_format($vvc).', Peso: '.$peso.' Kg</td>
                    
                    </tr>';
 $tabla = $tabla.'<tr>
                    <td>COSTO X M<SUP>2</SUP> CON <b>'.$despvid.' % </b>:</td>
                    <td align="right">'.number_format($vvc/$cantidad).'</td>
                    <td></td>
                     <td align="right">1 x '.number_format($cantidad).'</td>
                   <td align="right">'.number_format($vvc).'</td>
                    <td align="right">'.number_format($vvc/$porc).'</td>
                    </td><td>
                    </tr>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$idtraz.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
$precio_adicional = $fila['precio_adicional'];

if($valor1==4){
$pa = $precio_adicional * $per;
$cp = $per;
}else{
    if($valor1==5){
       $pa = $precio_adicional * $boq;
       $cp = $boq;
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $str = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$str));
        $cost= $fit['costo'];

    $st = $m2 * $cost;
    $tabla = $tabla.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td>'
            . '<td align="right">'.number_format($st/$cantidad).'</td>'
            . '<td></td><td align="right">'.number_format($cantidad).'</td>'
            . '<td align="right">'.number_format($st).'</td></td><td>'
            . '<td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $pat = $peso * $pa;
    $ti = $peso * $precio_a * $cp;
    $unidades = 'POR KG';
}
if($und_med=='Und'){
    $pat = $cantidad * $pa;
    $ti = $cantidad * $precio_a * $cp;
    $unidades = 'POR UND';
}
if($und_med=='M2'){
     $pat = $m2 * $pa;
    $ti = $m2 * $precio_a * $cp;
    $unidades = 'POR M<sup2</sup>';
}
$tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $ '.$precio_a.'</td>'
        . '<td align="right">'.number_format(($ti/$cantidad)).'</td>'
        . '<td>'.$pat.'</td>'
        . '<td align="right">1 x '.number_format($cantidad).'</td>'
        . '<td align="right">'.number_format($ti + $pa).'</td>'
        . '<td>'.number_format($ti + $pa).'</td>'
        . '<td> '.$unidades.'</td></tr>';
$total = $total  + $ti +  $pat;
$stt = $stt + $st;

}
$totalv1 = (($vvc)/$porc)+$total + $stt;
$totalv1sp = (($vvc))+$total + $stt;
$tabla = $tabla.'<tr><td>COSTO TOTAL : </td>'
        . '<td align="right"></td>'
        . '<td></td>'
        . '<td>-</td>'
        . '<td align="right">$'.number_format($totalv1sp).'</td>'
        . '<td align="right">$'.number_format($totalv1).'</td>'
        . '</td><td></tr></table>';
if(!isset($_POST["linea"])){
echo $tabla;
}
//$total_costo_vidrio = $totalv1sp;
//$total_despe_vidrio = $totalv1;
//$peso_total = $peso;

