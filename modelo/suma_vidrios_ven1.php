<?php
// se calcula los metros cuadrados del vidrio
if(!isset($cann)){
$cantidad = $_POST['cant'];
}else{
    $cantidad = $cann;
}
$m2 = (($an2/1000)*($all/1000))*$_POST['cant'];
//echo 'Ancho '.$an2.'<br>';
//echo 'Alto '.$all.'<br>';
//echo 'metro cuadrado:'.$m2.'<br>';
if(isset($_POST['vid'])){
    

//luego se calcula el peso del vidrio
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid']."'";
$fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi31["costo_v"];
$espesor= $fi31["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt =0;
//echo 'cantidad'.$cantidad.'<br>';      
while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$precio_adicional = $fila['precio_adicional'];
$und_med = $fila['medida'];
if($valor1==4){
$pa = $precio_adicional * $_POST['per'];
$cp = $_POST['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_POST['boq'];
       $cp = $_POST['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

        $st = $m2 * $cost;

}else{ 
    $st = 0;
}
if($und_med=='Kg'){
    $pat = $peso * $pa;
    $ti = $peso * $precio_a*$cp;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $pat = $cantidad * $pa;
    $ti = $cantidad * $precio_a*$cp;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $pat = $m2 * $pa;
    $ti = $m2 * $precio_a*$cp;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti + $pat;
$stt = $stt + $st;
}
$s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
$totalv1 = $total + (($vvc)/$porc)+$stt;
$totalv1sp = $total + (($vvc))+$stt;
//echo 'total de la cot;'.number_format($totalv1);

}else{
    $totalv1 = 0 ;  $totalv1sp = 0 ;
}
//echo 'total de la cot;'.number_format($totalv1);
if(isset($_POST['vid2'])){
    

//luego se calcula el peso del vidrio
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid2']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt =0;
//echo 'cantidad'.$cantidad.'<br>';      
while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$precio_adicional = $fila['precio_adicional'];
$und_med = $fila['medida'];
if($valor1==4){
$pa = $precio_adicional * $_POST['per'];
$cp = $_POST['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_POST['boq'];
       $cp = $_POST['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

        $st = $m2 * $cost;

}else{ 
    $st = 0;
}
if($und_med=='Kg'){
     $pat = $peso * $pa;
    $ti = $peso * $precio_a*$cp;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
     $pat = $cantidad * $pa;
    $ti = $cantidad * $precio_a*$cp;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
     $pat = $m2 * $pa;
    $ti = $m2 * $precio_a*$cp;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti + $pat;
$stt = $stt + $st;
}
$s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
$totalv2 = $total + (($vvc)/$porc)+$stt;
$totalv2sp = $total + (($vvc))+$stt;
//echo 'total de la cot;'.number_format($totalv);

}else{
    $totalv2 = 0 ;$totalv2sp = 0 ;
}

// vidrio 3

if(isset($_POST['vid3'])){
    

//luego se calcula el peso del vidrio
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid3']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];

$peso = $m2 * $espesor * 2.531;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt =0;
//echo 'cantidad'.$cantidad.'<br>';      
while($fila=  mysqli_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$precio_a = $fila['precio'];
$und_med = $fila['medida'];
$precio_adicional = $fila['precio_adicional'];

if($valor1==4){
$pa = $precio_adicional * $_POST['per'];
$cp = $_POST['per'];
}else{
    if($valor1==5){
       $pa = $precio_adicional * $_POST['boq'];
       $cp = $_POST['boq'];
    }else{
    $pa = $precio_adicional;
    $cp = 1;
    }
}
if($valor1=='7'){
        $st = "SELECT * FROM servicio_temple where espesor='".$espesor."'";
        $fit =mysqli_fetch_array(mysqli_query($conexion,$st));
        $cost= $fit["costo"];

    $st = $m2 * $cost;
  
}else{ $st = 0;}
if($und_med=='Kg'){
    $ti = $peso * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cantidad * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti;
$stt = $stt + $st;
}
$s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
$totalv3 = $total + (($vvc)/$porc)+$stt;
$totalv3sp = $total + (($vvc))+$stt;
//echo 'total de la cot;'.number_format($totalv);

}else{
    $totalv3 = 0 ;  $totalv3sp = 0 ;
}
// vidrio 4

if(isset($_POST['vid4'])){
    

//luego se calcula el peso del vidrio
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid4']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];

$peso = $m2 * $espesor * 2.531;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt =0;
//echo 'cantidad'.$cantidad.'<br>';      
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
    $ti = $peso * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cantidad * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti;
$stt = $stt + $st;
}
$s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
$totalv4 = $total + (($vvc)/$porc)+$stt;
$totalv4sp = $total + (($vvc))+$stt;
//echo 'total de la cot;'.number_format($totalv);

}else{
    $totalv4 = 0 ;$totalv4sp = 0 ;
}

//vidrio 5
if(isset($_POST['vid5'])){
    

//luego se calcula el peso del vidrio
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid5']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt =0;
//echo 'cantidad'.$cantidad.'<br>';      
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
    $ti = $peso * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cantidad * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti;
$stt = $stt + $st;
}
$s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
$totalv5 = $total + (($vvc)/$porc)+$stt;
$totalv5sp = $total + (($vvc))+$stt;
//echo 'total de la cot;'.number_format($totalv);

}else{
    $totalv5 = 0 ;    $totalv5sp = 0 ;
}
//vidrio 6
if(isset($_POST['vid6'])){
    

//luego se calcula el peso del vidrio
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid6']."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];

$peso = $m2 * $espesor * 2.531;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysqli_query($conexion,$consulta);
$total = 0;
$stt =0;
//echo 'cantidad'.$cantidad.'<br>';      
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
    $ti = $peso * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cantidad * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti;
$stt = $stt + $st;
}
$s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $porc= $fi3["p"]/100;
$totalv6 = $total + (($vvc)/$porc)+$stt;
$totalv6sp = $total + (($vvc))+$stt;
//echo 'total de la cot;'.number_format($totalv);

}else{
    $totalv6 = 0 ;$totalv6sp = 0 ;
}

$totalvxx =  $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
$totalvxxsp =  $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;