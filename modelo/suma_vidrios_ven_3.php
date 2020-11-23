<?php
// se calcula los metros cuadrados del vidrio
if(isset($_GET['ancho'])){
    $m2 = (($an2/1000)*($all/1000))*$_GET['cant'];
}else{
    $m2 = $mt2;
}


//echo 'metro cuadrado:'.$m2.'<br>';

//luego se calcula el peso del vidrio
if($_GET['id4_v']!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id4_v']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3['costo_v'];
$espesor= $fi3['espesor_v'];
$color= $fi3['color_v'];
$peso1 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado
//echo 'Costo'. $costo_vidrio;
$vvc = $m2 * $costo_vidrio;
  $tabla = '<table  class="table table-bordered table-striped table-hover">';
             $tabla = $tabla.'<thead >';
              $tabla = $tabla.'<tr BGCOLOR="#C3D9FF">';
              $tabla = $tabla.'<th>'.$color.' ('.$nombr4.')</th>';
                             $tabla = $tabla.'<th>'.'Costo Und'.'</th>';
                             $tabla = $tabla.'<th>'.'Costo Perforacion y Boquete'.'</th>';
                            $tabla = $tabla.'<th>'.'Cantidad'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Total'.'</th>';
               $tabla = $tabla.'<th>'.'Und Med.'.'</th>';
                $tabla = $tabla.'</tr>';
              $tabla = $tabla.'</thead>';
              
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> :<b><font color="green">'.number_format($vvc/$_GET['cant']).' X '.number_format($_GET['cant']).' = '.number_format($vvc).'</font></b></td>
 <td align="right">-</td>
 <td></td>
 <td align="right">-</td>
 <td align="right">-</td>
 <td></td>
 </tr>';
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td>
 <td align="right">'.number_format(($vvc/$porc)/$_GET['cant']).'</td>
 <td></td>
  <td align="right">'.number_format($_GET['cant']).'</td>
 <td align="right">'.number_format($vvc/$porc).'</td>
 </td><td>
 </tr>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET['tv4'].'"';                     
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
$pa = $precio_adicional * $_GET['per'];
$cp = $_GET['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_GET['boq'];
       $cp = $_GET['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit['costo'];

    $st = $m2 * $cost;
    $tabla = $tabla.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $pat = $peso1 * $pa;
    $ti = $peso1 * $precio_a * $cp;
    $tabla = $tabla.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pat.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $pat = $_GET['cant'] * $pa;
    $ti = $_GET['cant'] * $precio_a * $cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pat.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
     $pat = $m2 * $pa;
    $ti = $m2 * $precio_a * $cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pat.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti +  $pat;
$stt = $stt + $st;

}
$totalv1 = (($vvc)/$porc)+$total + $stt;
$totalv1sp = (($vvc))+$total + $stt;
$tabla = $tabla.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv1/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">$'.number_format($totalv1).'</td></td><td></tr></table>';

echo $tabla;
}else{
    $totalv1=0;
    $totalv1sp=0;
}

/// vidrio 2

if($_GET['id4_v2']!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id4_v2']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3['costo_v'];
$espesor= $fi3['espesor_v'];
$color= $fi3['color_v'];
$peso2 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $tabla = '<table  class="table table-bordered table-striped table-hover">';
             $tabla = $tabla.'<thead >';
              $tabla = $tabla.'<tr BGCOLOR="#C3D9FF">';
              $tabla = $tabla.'<th>'.$color.' ('.$nombr4.')</th>';
                             $tabla = $tabla.'<th>'.'Costo Und'.'</th>';
                             $tabla = $tabla.'<th>'.'Costo Perforacion y Boquete'.'</th>';
                            $tabla = $tabla.'<th>'.'Cantidad'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Total'.'</th>';
               $tabla = $tabla.'<th>'.'Und Med.'.'</th>';
                $tabla = $tabla.'</tr>';
              $tabla = $tabla.'</thead>';
              
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> :<b><font color="green">'.number_format($vvc/$_GET['cant']).' X '.number_format($_GET['cant']).' = '.number_format($vvc).'</font></b></td>
 <td align="right">-</td>
 <td></td>
 <td align="right">-</td>
 <td align="right">-</td>
 <td></td>
 </tr>';
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td>
 <td align="right">'.number_format(($vvc/$porc)/$_GET['cant']).'</td>
 <td></td>
  <td align="right">'.number_format($_GET['cant']).'</td>
 <td align="right">'.number_format($vvc/$porc).'</td>
 </td><td>
 </tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET['tv4'].'"';                     
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
$pa = $precio_adicional * $_GET['per'];
$cp = $_GET['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_GET['boq'];
       $cp = $_GET['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit['costo'];

    $st = $m2 * $cost;
    $tabla = $tabla.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $pat = $peso2 * $pa;
    $ti = $peso2 * $precio_a * $cp;
    $tabla = $tabla.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pat.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $pat = $_GET['cant'] * $pa;
    $ti = $_GET['cant'] * $precio_a * $cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pat.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
     $pat = $m2 * $pa;
    $ti = $m2 * $precio_a * $cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pat.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti +  $pat;
$stt = $stt + $st;

}
$totalv2 = (($vvc)/$porc)+$total + $stt;
$totalv2sp = (($vvc))+$total + $stt;
$tabla = $tabla.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv2/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">$'.number_format($totalv2).'</td></td><td></tr></table>';

echo $tabla;
}else{
    $totalv2=0; $totalv2sp=0;
}
// vidrio 3

if($_GET['id4_v3']!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id4_v3']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3['costo_v'];
$espesor= $fi3['espesor_v'];
$color= $fi3['color_v'];
$peso3 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $tabla = '<table  class="table table-bordered table-striped table-hover">';
             $tabla = $tabla.'<thead >';
              $tabla = $tabla.'<tr BGCOLOR="#C3D9FF">';
              $tabla = $tabla.'<th>'.$color.' ('.$nombr4.')</th>';
                             $tabla = $tabla.'<th>'.'Costo Und'.'</th>';
                             $tabla = $tabla.'<th>'.'Costo Perforacion y Boquete'.'</th>';
                            $tabla = $tabla.'<th>'.'Cantidad'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Total'.'</th>';
               $tabla = $tabla.'<th>'.'Und Med.'.'</th>';
                $tabla = $tabla.'</tr>';
              $tabla = $tabla.'</thead>';
              
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> :<b><font color="green">'.number_format($vvc/$_GET['cant']).' X '.number_format($_GET['cant']).' = '.number_format($vvc).'</font></b></td>
 <td align="right">-</td>
 <td></td>
 <td align="right">-</td>
 <td align="right">-</td>
 <td></td>
 </tr>';
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td>
 <td align="right">'.number_format(($vvc/$porc)/$_GET['cant']).'</td>
 <td></td>
  <td align="right">'.number_format($_GET['cant']).'</td>
 <td align="right">'.number_format($vvc/$porc).'</td>
 </td><td>
 </tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET['tv4'].'"';                     
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
$pa = $precio_adicional * $_GET['per'];
$cp = $_GET['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_GET['boq'];
       $cp = $_GET['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit['costo'];

    $st = $m2 * $cost;
    $tabla = $tabla.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso3 * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET['cant'] * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti +  $pa;
$stt = $stt + $st;

}
$totalv3 = (($vvc)/$porc)+$total + $stt;
$totalv3sp = (($vvc))+$total + $stt;
$tabla = $tabla.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv3/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">$'.number_format($totalv3).'</td></td><td></tr></table>';

echo $tabla;
}else{
    $totalv3=0; $totalv3sp=0;
}

// vidrio 4  



if($_GET['id4_v4']!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id4_v4']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3['costo_v'];
$espesor= $fi3['espesor_v'];
$color= $fi3['color_v'];
$peso4 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
   $tabla = '<table  class="table table-bordered table-striped table-hover">';
             $tabla = $tabla.'<thead >';
              $tabla = $tabla.'<tr BGCOLOR="#C3D9FF">';
              $tabla = $tabla.'<th>'.$color.' ('.$nombr4.')</th>';
                             $tabla = $tabla.'<th>'.'Costo Und'.'</th>';
                             $tabla = $tabla.'<th>'.'Costo Perforacion y Boquete'.'</th>';
                            $tabla = $tabla.'<th>'.'Cantidad'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Total'.'</th>';
               $tabla = $tabla.'<th>'.'Und Med.'.'</th>';
                $tabla = $tabla.'</tr>';
              $tabla = $tabla.'</thead>';
              
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> :<b><font color="green">'.number_format($vvc/$_GET['cant']).' X '.number_format($_GET['cant']).' = '.number_format($vvc).'</font></b></td>
 <td align="right">-</td>
 <td></td>
 <td align="right">-</td>
 <td align="right">-</td>
 <td></td>
 </tr>';
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td>
 <td align="right">'.number_format(($vvc/$porc)/$_GET['cant']).'</td>
 <td></td>
  <td align="right">'.number_format($_GET['cant']).'</td>
 <td align="right">'.number_format($vvc/$porc).'</td>
 </td><td>
 </tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET['tv4'].'"';                     
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
$pa = $precio_adicional * $_GET['per'];
$cp = $_GET['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_GET['boq'];
       $cp = $_GET['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit['costo'];

    $st = $m2 * $cost;
    $tabla = $tabla.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso4 * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET['cant'] * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti +  $pa;
$stt = $stt + $st;

}
$totalv4 = (($vvc)/$porc)+$total + $stt;
$totalv4sp = (($vvc))+$total + $stt;
$tabla = $tabla.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv4/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">$'.number_format($totalv4).'</td></td><td></tr></table>';

echo $tabla;
}else{
    $totalv4=0; $totalv4sp=0;
}

// vidrio 5

if($_GET['id4_v5']!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id4_v5']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3['costo_v'];
$espesor= $fi3['espesor_v'];
$color= $fi3['color_v'];
$peso5 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
   $tabla = '<table  class="table table-bordered table-striped table-hover">';
             $tabla = $tabla.'<thead >';
              $tabla = $tabla.'<tr BGCOLOR="#C3D9FF">';
              $tabla = $tabla.'<th>'.$color.' ('.$nombr4.')</th>';
                             $tabla = $tabla.'<th>'.'Costo Und'.'</th>';
                             $tabla = $tabla.'<th>'.'Costo Perforacion y Boquete'.'</th>';
                            $tabla = $tabla.'<th>'.'Cantidad'.'</th>';
               $tabla = $tabla.'<th>'.'Costo Total'.'</th>';
               $tabla = $tabla.'<th>'.'Und Med.'.'</th>';
                $tabla = $tabla.'</tr>';
              $tabla = $tabla.'</thead>';
              
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> :<b><font color="green">'.number_format($vvc/$_GET['cant']).' X '.number_format($_GET['cant']).' = '.number_format($vvc).'</font></b></td>
 <td align="right">-</td>
 <td></td>
 <td align="right">-</td>
 <td align="right">-</td>
 <td></td>
 </tr>';
 $tabla = $tabla.'<tr>
 <td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td>
 <td align="right">'.number_format(($vvc/$porc)/$_GET['cant']).'</td>
 <td></td>
  <td align="right">'.number_format($_GET['cant']).'</td>
 <td align="right">'.number_format($vvc/$porc).'</td>
 </td><td>
 </tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET['tv4'].'"';                     
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
$pa = $precio_adicional * $_GET['per'];
$cp = $_GET['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_GET['boq'];
       $cp = $_GET['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit['costo'];

    $st = $m2 * $cost;
    $tabla = $tabla.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso5 * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET['cant'] * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a*$cp;
    $tabla = $tabla.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format(($ti/$_GET['cant'])).'</td><td>'.$pa.'</td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">'.number_format($ti + $pa).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti +  $pa;
$stt = $stt + $st;

}
$totalv5 = (($vvc)/$porc)+$total + $stt;
$totalv5sp = (($vvc))+$total + $stt;
$tabla = $tabla.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv5/$_GET['cant']).'</td><td></td><td align="right">'.number_format($_GET['cant']).'</td><td align="right">$'.number_format($totalv5).'</td></td><td></tr></table>';

echo $tabla;
}else{
    $totalv5=0; $totalv5sp=0;
}

// vidrio 6

    $totalv6=0; $totalv6sp=0;

if(!isset($peso2)){
    $peso2=0;
}
if(!isset($peso3)){
    $peso3=0;
}
if(!isset($peso4)){
    $peso4=0;
}
if(!isset($peso5)){
    $peso5=0;
}
if(!isset($peso6)){
    $peso6=0;
}
 $pesototal = $peso1 + $peso2 + $peso3 + $peso4+ $peso5+$peso6;
    $totalvxx= $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
    $totalvxxsp= $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;