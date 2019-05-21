<?php
// se calcula los metros cuadrados del vidrio
if(isset($_GET["ancho"])){
    $m2 = (($_GET["ancho"]/1000)*($_GET["alto"]/1000))*$_GET["cant"];
}else{
    $m2 = $mt2;
}


//echo 'metro cuadrado:'.$m2.'<br>';

//luego se calcula el peso del vidrio
if($_GET["id_v"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v"]."'";
$fi3 =mysql_fetch_array(mysql_query($s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table  class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
               $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$_GET["cant"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td><td align="right">'.number_format(($vvc/$porc)/$_GET["cant"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$row["id_referencia"].'"';                     
$result=  mysql_query($consulta);
$total = 0;
$stt = 0;     

while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysql_fetch_array(mysql_query($st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET["cant"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET["cant"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv1 = (($vvc)/$porc)+$total + $stt;
$totalv1sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv1/$_GET["cant"]).'</td><td align="right">$'.number_format($totalv1).'</td></td><td></tr></table>';

}else{
    $totalv1=0;
}

/// vidrio 2

if($_GET["id_v2"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v2"]."'";
$fi3 =mysql_fetch_array(mysql_query($s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table  class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                 $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$_GET["cant"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td><td align="right">'.number_format(($vvc/$porc)/$_GET["cant"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET["ref"].'"';                     
$result=  mysql_query($consulta);
$total = 0;
$stt = 0;     

while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysql_fetch_array(mysql_query($st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET["cant"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET["cant"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv2 = (($vvc)/$porc)+$total + $stt;
$totalv2sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv2/$_GET["cant"]).'</td><td align="right">$'.number_format($totalv2).'</td></td><td></tr></table>';

}else{
    $totalv2=0; $totalv2sp=0;
}
// vidrio 3

if($_GET["id_v3"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v3"]."'";
$fi3 =mysql_fetch_array(mysql_query($s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table  class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                            $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$_GET["cant"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td><td align="right">'.number_format(($vvc/$porc)/$_GET["cant"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET["ref"].'"';                     
$result=  mysql_query($consulta);
$total = 0;
$stt = 0;     

while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysql_fetch_array(mysql_query($st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET["cant"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET["cant"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv3 = (($vvc)/$porc)+$total + $stt;
$totalv3sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv3/$_GET["cant"]).'</td><td align="right">$'.number_format($totalv3).'</td></td><td></tr></table>';


}else{
    $totalv3=0; $totalv3sp=0;
}

// vidrio 4  



if($_GET["id_v4"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v4"]."'";
$fi3 =mysql_fetch_array(mysql_query($s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso = $m2 * $espesor * 2.531;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table  class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                             $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$_GET["cant"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td><td align="right">'.number_format(($vvc/$porc)/$_GET["cant"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET["ref"].'"';                     
$result=  mysql_query($consulta);
$total = 0;
$stt = 0;     

while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysql_fetch_array(mysql_query($st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET["cant"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET["cant"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv4 = (($vvc)/$porc)+$total + $stt;
$totalv4sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv4/$_GET["cant"]).'</td><td align="right">$'.number_format($totalv4).'</td></td><td></tr></table>';


}else{
    $totalv4=0; $totalv4sp=0;
}

// vidrio 5

if($_GET["id_v5"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v5"]."'";
$fi3 =mysql_fetch_array(mysql_query($s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso = $m2 * $espesor * 2.531;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table  class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                             $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$_GET["cant"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td><td align="right">'.number_format(($vvc/$porc)/$_GET["cant"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET["ref"].'"';                     
$result=  mysql_query($consulta);
$total = 0;
$stt = 0;     

while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysql_fetch_array(mysql_query($st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET["cant"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET["cant"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv5 = (($vvc)/$porc)+$total + $stt;
$totalv5sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv5/$_GET["cant"]).'</td><td align="right">$'.number_format($totalv5).'</td></td><td></tr></table>';

}else{
    $totalv5=0; $totalv5sp=0;
}

// vidrio 6
if($_GET["id_v6"]!=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v6"]."'";
$fi3 =mysql_fetch_array(mysql_query($s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];
$color= $fi3["color_v"];
$peso = $m2 * $espesor * 2.531;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;
  $table = '<table  class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.$color.'</th>';
                        $table = $table.'<th>'.'Costo Und'.'</th>';
               $table = $table.'<th>'.'Costo Total'.'</th>';
               $table = $table.'<th>'.'Und Med.'.'</th>';
                $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> :</td><td align="right">'.number_format($vvc/$_GET["cant"]).'</td><td align="right">'.number_format($vvc).'</td><td></td></tr>';
 $table = $table.'<tr><td>COSTO X M<SUP>2</SUP> CON '.$_GET['por'].' :</td><td align="right">'.number_format(($vvc/$porc)/$_GET["cant"]).'</td><td align="right">'.number_format($vvc/$porc).'</td></td><td></tr>';

$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$_GET["ref"].'"';                     
$result=  mysql_query($consulta);
$total = 0;
$stt = 0;     

while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysql_fetch_array(mysql_query($st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
    $table = $table.'<tr><td>SERVICIO DE TEMPLE x M<sup>2</sup> '.$cost.', TOTAL :</td><td align="right">'.number_format($st/$_GET["cant"]).'</td><td align="right">'.number_format($st).'</td><td> POR KG</td></tr>';
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
    $table = $table.'<tr><td>COSTO DE  '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td > POR KG</td></tr>';
}
if($und_med=='Und'){
    $ti = $_GET["cant"] * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR UND</td></tr>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
    $table = $table.'<tr><td>COSTO DE '.$valor2.' : $</td><td align="right">'.number_format($ti/$_GET["cant"]).'</td><td align="right">'.number_format($ti).'</td><td> POR M<sup2</sup></td></tr>';
}

$total = $total  + $ti;
$stt = $stt + $st;

}
$totalv6 = (($vvc)/$porc)+$total + $stt;
$totalv6sp = (($vvc))+$total + $stt;
$table = $table.'<tr><td>COSTO TOTAL : </td><td align="right">$'.number_format($totalv6/$_GET["cant"]).'</td><td align="right">$'.number_format($totalv6).'</td></td><td></tr></table>';

}else{
    $totalv6=0; $totalv6sp=0;
}

    $totalv= $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
    $totalvsp= $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;


