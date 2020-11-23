<?php
                $s3x = "SELECT (".$porcentaje_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3x =mysqli_fetch_array(mysqli_query($conexion,$s3x));
                $porc= $fi3x["p"]/100;
// se calcula los metros cuadrados del vidrio
$m2 = (($ancc/1000)*($altt/1000))*$cann;

//echo 'metro cuadrado:'.$m2.'<br>';

//luego se calcula el peso del vidrio
if($id_vidrio !=0){
$s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
$fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
$costo_vidrio= $fi3["costo_v"];
$espesor= $fi3["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consultax= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$reff.'"';                     
$resultx=  mysqli_query($conexion,$consultax);
$total = 0;
$stt=0;
//echo 'cantidad'.$cann.'<br>';      
while($fila=  mysqli_fetch_array($resultx)){
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
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cann * $precio_a;
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total = $total  + $ti;
$stt = $stt + $st;
}
                          
$totalv1 = $total + (($vvc)/$porc) + $stt;
}else{
    $totalv1 = 0 ;
}
//echo 'total de la cot;'.number_format($totalv1).'<br>';
//echo 'id del pedido --'.$reff.'<br>';

if($id_vidrio2 !=0){
$s32 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio2."'";
$fi32 =mysqli_fetch_array(mysqli_query($conexion,$s32));
$costo_vidrio= $fi32["costo_v"];
$espesor= $fi32["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consultax2= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$reff.'"';                     
$resultx2=  mysqli_query($conexion,$consultax2);
$total2 = 0;
$stt2=0;
//echo 'cantidad'.$cann.'<br>';      
while($fila=  mysqli_fetch_array($resultx2)){
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
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cann * $precio_a;
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total2 = $total2  + $ti;
$stt2 = $stt2 + $st;
}
                          
$totalv2 = $total2 + (($vvc)/$porc) + $stt2;
}else{
    $totalv2 = 0 ;
}
//echo 'total de la cot2;'.number_format($totalv2).'<br>';


if($id_vidrio3 !=0){
$s33 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio3."'";
$fi33 =mysqli_fetch_array(mysqli_query($conexion,$s33));
$costo_vidrio= $fi33["costo_v"];
$espesor= $fi33["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consultax3= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$reff.'"';                     
$resultx3=  mysqli_query($conexion,$consultax3);
$total3 = 0;
$stt3=0;
//echo 'cantidad'.$cann.'<br>';      
while($fila=  mysqli_fetch_array($resultx3)){
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
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cann * $precio_a;
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total3 = $total3  + $ti;
$stt3 = $stt3 + $st;
}
                          
$totalv3 = $total3 + (($vvc)/$porc) + $stt3;
}else{
    $totalv3 = 0 ;
}
//echo 'total de la cot3;'.number_format($totalv3).'<br>';
if($id_vidrio4 !=0){
$s34 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio4."'";
$fi34 =mysqli_fetch_array(mysqli_query($conexion,$s34));
$costo_vidrio= $fi34["costo_v"];
$espesor= $fi34["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consultax4= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$reff.'"';                     
$resultx4=  mysqli_query($conexion,$consultax4);
$total4 = 0;
$stt4=0;
//echo 'cantidad'.$cann.'<br>';      
while($fila=  mysqli_fetch_array($resultx4)){
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
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cann * $precio_a;
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total4 = $total4  + $ti;
$stt4 = $stt4 + $st;
}
                          
$totalv4 = $total4 + (($vvc)/$porc) + $stt4;
}else{
    $totalv4 = 0 ;
}
//echo 'total de la cot4;'.number_format($totalv4).'<br>';

if($id_vidrio5 !=0){
$s35 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio5."'";
$fi35 =mysqli_fetch_array(mysqli_query($conexion,$s35));
$costo_vidrio= $fi35["costo_v"];
$espesor= $fi35["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consultax5= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$reff.'"';                     
$resultx5=  mysqli_query($conexion,$consultax5);
$total5 = 0;
$stt5=0;
//echo 'cantidad'.$cann.'<br>';      
while($fila=  mysqli_fetch_array($resultx5)){
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
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cann * $precio_a;
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total5 = $total5  + $ti;
$stt5 = $stt5 + $st;
}
                          
$totalv5 = $total5 + (($vvc)/$porc) + $stt5;
}else{
    $totalv5 = 0 ;
}
//echo 'total de la cot5;'.number_format($totalv5).'<br>';

if($id_vidrio6 !=0){
$s36 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio6."'";
$fi36 =mysqli_fetch_array(mysqli_query($conexion,$s36));
$costo_vidrio= $fi36["costo_v"];
$espesor= $fi36["espesor_v"];

$peso = $m2 * $espesor * 2.5;
//echo 'peso del vidrio'.number_format($peso).'<br>';
//se calcula el valor total por metro cuadrado del vidrio cotizado

$vvc = $m2 * $costo_vidrio;

//echo 'costo por metro cuadrado'.number_format($vvc).'<br>';
$consultax6= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$reff.'"';                     
$resultx6=  mysqli_query($conexion,$consultax6);
$total6 = 0;
$stt6=0;
//echo 'cantidad'.$cann.'<br>';      
while($fila=  mysqli_fetch_array($resultx6)){
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
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='Und'){
    $ti = $cann * $precio_a;
//   echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}
if($und_med=='M2'){
    $ti = $m2 * $precio_a;
//    echo 'total x items x '.$valor2.' : '.number_format($ti).'<br>';
}

$total6 = $total6  + $ti;
$stt6 = $stt6 + $st;
}
                          
$totalv6 = $total6 + (($vvc)/$porc) + $stt6;
}else{
    $totalv6 = 0 ;
}
//echo 'total de la cot6;'.number_format($totalv6).'<br>';

$totalv =  $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
//echo 'total;'.number_format($totalv).'<br>';
// echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el servicio");location.href=""</script>'; 