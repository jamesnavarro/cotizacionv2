<?php
// se calcula los metros cuadrados del vidrio
$m2 = (($an2/1000)*($all/1000))*$row["cantidad_c"];

//echo 'metro cuadrado:'.$m2.'<br>';

//luego se calcula el peso del vidrio
if($row["id_vidrio"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio"]."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso1 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["traz_vid"].'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso1 * $precio_a;
}
if($und_med=='Und'){
    $ti = $row["cantidad_c"] * $precio_a;
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv1 = (($vvc)/$porc)+$total + $stt;
$totalv1sp = (($vvc))+$total + $stt;


}else{
	$peso1 = 0;
    $totalv1=0;
    $totalv1sp=0;
}

/// vidrio 2

if($row["id_vidrio2"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio2"]."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso2 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                 $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$row["porcentaje_mp"].' :</td><td align="right">'.number_format(($vvc/$porc)/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["traz_vid"].'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$row["cantidad_c"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $row["cantidad_c"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv2 = (($vvc)/$porc)+$total + $stt;
$totalv2sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv2/$row["cantidad_c"]).'</td><td align="right">$'.number_format($totalv2).'</td></td><td></tr></table>';


}else{
	$peso2 = 0;
    $totalv2=0;
    $totalv2sp=0;
}
// vidrio 3

if($row["id_vidrio3"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio3"]."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso3 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                            $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$row["porcentaje_mp"].' :</td><td align="right">'.number_format(($vvc/$porc)/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["traz_vid"].'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$row["cantidad_c"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso3 * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $row["cantidad_c"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv3 = (($vvc)/$porc)+$total + $stt;
$totalv3sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv3/$row["cantidad_c"]).'</td><td align="right">$'.number_format($totalv3).'</td></td><td></tr></table>';


}else{
	$peso3 = 0;	
    $totalv3=0;
    $totalv3sp=0;
}

// vidrio 4  



if($row["id_vidrio4"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio4"]."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso4 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                             $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$row["porcentaje_mp"].' :</td><td align="right">'.number_format(($vvc/$porc)/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["traz_vid"].'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$row["cantidad_c"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso4 * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $row["cantidad_c"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv4 = (($vvc)/$porc)+$total + $stt;
$totalv4sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv4/$row["cantidad_c"]).'</td><td align="right">$'.number_format($totalv4).'</td></td><td></tr></table>';


}else{
	$peso4 = 0;
    $totalv4=0;
    $totalv4sp=0;
}

// vidrio 5

if($row["id_vidrio5"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio5"]."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso5 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                             $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$row["porcentaje_mp"].' :</td><td align="right">'.number_format(($vvc/$porc)/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["traz_vid"].'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$row["cantidad_c"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso5 * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $row["cantidad_c"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv5 = (($vvc)/$porc)+$total + $stt;
$totalv5sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv5/$row["cantidad_c"]).'</td><td align="right">$'.number_format($totalv5).'</td></td><td></tr></table>';


}else{
	$peso5 = 0;
    $totalv5=0;
    $totalv5sp=0;
}

// vidrio 6
if($row["id_vidrio6"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$row["id_vidrio6"]."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso6 = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                        $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$row["porcentaje_mp"].' :</td><td align="right">'.number_format(($vvc/$porc)/$row["cantidad_c"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["traz_vid"].'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt = 0;     

while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$row["cantidad_c"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso6 * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $row["cantidad_c"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$row["cantidad_c"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv6 = (($vvc)/$porc)+$total + $stt;
$totalv6sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv6/$row["cantidad_c"]).'</td><td align="right">$'.number_format($totalv6).'</td></td><td></tr></table>';


}else{
	$peso6 = 0;
    $totalv6=0;
    $totalv6sp=0;
}
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


