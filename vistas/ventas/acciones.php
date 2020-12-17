<?php
include '../../modelo/conexion.php';
session_start();

switch ($_GET['sw']){
    case 1:
              $request2=mysqli_query($conexion,'select * from cont_terceros WHERE cod_ter="'.$_GET["doc"].'"');
              $row2=mysqli_fetch_array($request2);
              $p = array();
              $p[0] = $row2["id_ter"];
              $p[1] = $row2["cod_ter"];
              $p[2] = $row2["dir_ter"];
              $p[3] = $row2["telfijo_ter"];
              $p[4] = $row2["telmovil_ter"];
              $p[5] = $row2["correo_ter"];
              $p[6] = $row2["cont_ter"];
              $p[7] = $row2["nom_ter"];
              $p[8] = $row2["ciudad_ter"];
              $p[9] = $row2["municipio_ter"];
              $p[10] = $row2["vendedor"];
              $p[11] = $row2["pvi"];
              echo json_encode($p);
              exit();
        break;
    case 2:
        $request2=mysqli_query($conexion,'SELECT * FROM producto WHERE codigo="'.$_GET['cod'].'"');
        $row2=mysqli_fetch_array($request2);
        $p = array();
        $p[0] = $row2["id_p"];
          $p[1] = $row2["producto"];
          $p[2] = $row2["codigo"];
          $p[3] = $row2["referencia_p"];
            $cadena_de_texto = $row2["producto"];
            $cadena_per   = 'PERFORACION';
            $per = strrpos($cadena_de_texto, $cadena_per);
            $cadena_boq   = 'BOQUETE';
            $boq = strrpos($cadena_de_texto, $cadena_boq);
            if ($per === false) {
            $pe = 0;
            } else {
            $pe = 1;
            }
            if ($boq === false) {
            $bo = 0;
            } else {
            $bo = 1;
            }
          $p[4] = $pe;
          $p[5] = $bo;
          $p[6] = $row2["laminas"];
        echo json_encode($p);
        exit();
        break;
        case 3:
        $linea= 'Vidrio';
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= $_GET["vid2"];
        $vid3= $_GET["vid3"];
        $vid4= $_GET["vid4"];
        $vid5= $_GET["vid5"];
        //$vty = $vid.'-'.$vid2.'-'.$vid3.'-'.$vid4;
        $precio_mp ='p1';
        $precio= 'p1';
        $an2 = $_GET["ancho"];
        $cann = $_GET["cant"];
        $all = $_GET["alto"];
        $pelicula = $_GET["pelicula"];
        $cantidad = $cann;
        $install = $_GET["install"];
        $desc= $_GET["desc"];
        $des= $_GET["des"];
        $adi= $_GET["adi"];
        $m2 = (($an2/1000)*($all/1000))*$_GET['cant'];
        //PORCENTAJE DE P1 PARA LOS 4 VIDRIOS
        $ajuste = mysqli_query($conexion,"select * from ajustes where id_referencia=$ref and id_vidrio=$vid ");
        $aj = mysqli_fetch_array($ajuste);
        if($aj){
        $vj = $aj['ajuste'] * (($_GET['ancho']/1000) * ($_GET['alto']/1000));
        $vjt = $vj * $_GET['cant'];
        }else{
        $vj = 0;
        }
        if($_GET['per']>5){
        $_GET['per'] = ($_GET['per'] - 5);
        }else{
         $_GET['per'] = 0;
        } 
        if($_GET['boq']>3){
        $_GET['boq'] = ($_GET['boq'] - 3);
        }else{
        $_GET['boq'] = 0;
        }    
        //$resultado = '$vty= '.$vty.', $all='.$all.' $an2='.$an2.' $desc='.$desc.',$install='.$install.' , $_GET["per"]= '.$_GET['per'].' , $cantidad='.$cantidad.', $ref='.$ref.', $vid='.$vid.', $st='.$st;
        $resultado = '';
        //CALCULO DE VIDRIO 1
        if($vid!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
        $result=  mysqli_query($conexion,$consulta);
        $total = 0;
        $stt =0;
        //echo 'cantidad'.$cantidad.'<br>'; 
        $precio_adi_total = 0;
        while($fila=  mysqli_fetch_array($result)){
        $valor1=$fila['id_subpro'];
        $valor2=$fila['nombre_subpro'];
        $precio_a = $fila['precio'];
        $precio_adicional = $fila['precio_adicional'];
        $und_med = $fila['medida'];
        if($valor1==4){
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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
        $precio_adi_total += $pat;
        $total = $total  + $ti ;
        $stt = $stt + $st;
        }
        $s3 = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
        $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $porc= $fi3["p"]/100;
        $totalv1 = $total + ($vvc/$porc)+$stt ;
        $totalv1sp = $total + $vvc+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv1 = 0 ; 
           $totalv1sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 1

        //CALCULO DE VIDRIO 2
                if($vid2!='' && $vid2!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid2."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
        $pa = $precio_adicional * $_GET['per'];
        $cp =0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
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
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv2 = 0 ;  $totalv2sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 2
        //CALCULO VIDRIO 3
        if($vid3!='' && $vid3!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid3."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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

        $totalv3 = $total + (($vvc)/$porc)+$stt;
        $totalv3sp = $total + (($vvc))+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv3 = 0 ;  $totalv3sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 3
        //CALCULO VIDRIO 4
        if($vid4!='' && $vid4!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid4."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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
        $totalv4 = $total + (($vvc)/$porc)+$stt;
        $totalv4sp = $total + (($vvc))+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv4 = 0 ;  $totalv4sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 4
        //CALCULO VIDRIO 5
        if($vid5!='' && $vid5!=0){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid5."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;

        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
        $pa = $precio_adicional * $_GET['per'];
        $cp = 0;
        }else{
        if($valor1==5){
        $pa = $precio_adicional * $_GET['boq'];
        $cp = 0;
        }else{
        $pa = $precio_adicional;
        $cp = 1;
        }
        }
        if($valor1=='7'){
        $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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
        $totalv5 = $total + (($vvc)/$porc)+$stt;
        $totalv5sp = $total + (($vvc))+$stt;
        //echo $totalv1;  total de precio de vidrios con p1
        }else{
           $totalv5 = 0 ;  $totalv5sp = 0 ;
        }

        //FIN DE CALCULO VIDRIO 5



        // SUMA DE ACCESORIOS
         $acc_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
        $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
        $porcacc= $fipa["p"]/100; 
         $acc_porB = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
        $fipaB =mysqli_fetch_array(mysqli_query($conexion,$acc_porB));
        $porcaccB= $fipaB["p"]/100; 
          $request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." order by b.para ");
        if($request_acE){

        $tac = 0; $tacfom = 0; $tacfomp = 0;
        while($row=mysqli_fetch_array($request_acE))
        {  
        //--------------------------------------------------------------------
        if($row['can_rej']!=0){
        $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_rej=".$row['can_rej']." ");
        while($rowz=mysqli_fetch_array($request_v2))
        {
        $sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_a=".$rowz["id_referencia_med"]."");
        $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxy));
        $id_p= $fil_an["id_p"];

        if($fil_an['signo']=='+'){
        if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])+ $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])+ $fil_an['variable'];
        }
        }
        }
        }

        }

        }else{
        if($fil_an['signo']=='-'){
        if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])- $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])- $fil_an['variable'];
        }
        }
        }
        }

        }
        }else{
        if($fil_an['signo']=='*'){
         if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])* $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])* $fil_an['variable'];
        }
        }
        }
        }

        }
        }else{
        if($fil_an['signo']=='/'){
        if($fil_an['medida_r_a']==1){
            $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==2){
            $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
            if($fil_an['medida_r_a']==3){
            $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
             if($fil_an['medida_r_a']==4){
            $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
        }else{
             if($fil_an['lado']!="Vertical"){
        $al = ($_GET['ancho']+$fil_an["descuento"])/ $fil_an['variable'];

        }else{
        $al = ($_GET['alto']+$fil_an["descuento"])/ $fil_an['variable'];
        }
        }
        }
        }

        }
        }
        }
        } 
        }
        $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);

        }}else{
        $cant_rej = 1;
        }

        //---------------------------------------------------------------------

        if($linea=='Fachada'){
         if($row["yes"]=='Si'){
             if($row["lado"]=='Vertical'){
                 $res = ((($row["cantidad_acc"]*$_GET['alto']) / $row["metro"])+$row["cantidad_acc"]);
             }else{
                 $res = ((($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"])+$row["cantidad_acc"]);
             }         
         }else{
              $res = $row["cantidad_acc"];
         }
        }else{      
        if($row['calcular']=='ML'){
        $rs = $_GET['hoja'] * 2 * $row["cantidad_acc"];
        $res = (($_GET['ancho'] / 1000) * 2) + (($_GET['alto']/1000)*$rs);
        }ELSE{
          if($row['calcular']=='M2'){
              $res = (($_GET['alto'] / 1000)) * (($_GET['ancho']/1000))* $row["cantidad_acc"];
        }else{
         if($row["yes"]=='Si'){
             if($row["lado"]=='Vertical'){
                 $res = ($row["cantidad_acc"]*$_GET['alto']) / $row["metro"];
             }else{
                 $res = ($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"];
             }             
         }else{
              $res = $row["cantidad_acc"];
         }            
        }}}
        $taa = $cant_rej * $res;
        if($row["med"]!=1){
         $m = $row["med"]/1000;
         $f = ''.number_format(($taa*$_GET["cant"])).' ML';
         $ft = $f * $row["valor_f"] ;
         $a = $f * $row["valor_f"] ;
        }else{
         $m = $row["med"];
         $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].' ';
         $ft = 'No aplica' ;$a = '' ;
        }
        if($_GET['pelicula']!="No Aplica"  && $row['codigo']=='26002'){
        if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
        $tac = $tac + (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
        //            echo (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
        $tacfom = $tacfom + (($taa * $v) * ($row["costo_fom"])*$m*$_GET['cant'] + $a);
        $tacfomp = $tacfomp + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);

        }
        if($row['codigo']!='26002'){ 
        //                echo ($taa*($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
        $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
        $tacfom = $tacfom + ($taa*($row["costo_fom"])*$m*$_GET['cant'] + $a);
        $tacfomp = $tacfomp + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
        }
        //echo $tac.'<br>';
        } 

        }
        $accesorios = $tac;
        $accesorios_sinp = $tac * $porcacc;
        $accesorios_fom = $tacfomp;
        $accesorios_fom_sinp = $tacfomp * $porcaccB;
        // FIN DE ACCESORIOS
        // 
        $suma = $totalv1+$totalv2+$totalv3+$totalv4+$totalv5 + $accesorios;
        $suma_sp = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp+$totalv5sp + $accesorios_sinp;
        $suma_fom = $totalv1+$totalv2+$totalv3+$totalv4+$totalv5 + $accesorios;
        $suma_fom_sin_p = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp+$totalv5sp + $accesorios_sinp + $accesorios_sinp;
        //comienzo de maquinaria          
        $request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$ref);    
        if($request_mano){
        $tot2=0;$tot2fom=0;$tot2fomp=0; $totsinp = 0;
        while($row=mysqli_fetch_array($request_mano))
        {       
        $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
        if($row['dias']=='Si'){
        if($_GET['alto']>3000){
            $res = $mt2 /2.25;
        }else{
            $res = 1;
        }
        $duracion=1;//esta variable viene del formulario, le coloque 1 
        $r = $row["porcentaje_ma"]*($res)*$duracion;
        $tot2 = $tot2 + $r ;
        $tot2fom = $tot2fom + $r ;
        $tot2fomp = $tot2fomp + $r ;
        $totsinp = $totsinp + $r ;
        }else{
        $r = $row["porcentaje_ma"]/100*$suma;
        $tot2 = $tot2 + $r;

        $r2 = $row["porcentaje_ma"]/100*$suma_fom;
         $tot2fom = $tot2fom + $r2 ; 

         $r3 = $row["porcentaje_ma"]/100*$suma_fom_sin_p;
         $tot2fomp = $tot2fomp + $r3 ;

         $r4 = $row["porcentaje_ma"]/100*$suma_sp;
         $totsinp = $totsinp + $r4 ;
        }    
        } 
        }
        //fin de maquinaria
        //
        //comienzo de mano de obra
        $maquina = $tot2;
        $maquina_sinp = $totsinp;
        $maquina_fom = $tot2fom;
        $maquina_fom_sinp = $tot2fomp;

        // fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

        $req=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$ref);
        if($req){
        $tot=0;$tot_fom = 0;
        while($row=mysqli_fetch_array($req))
        {       
        $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
        $mtl = ($_GET['ancho']/1000);
        if($mt2<1){
        $mt2 = 1;
        }  else {
        $mt2 = $mt2;
        }
        if($_GET["install"]=="Si"){

        if($row['unidad_cobro']=='M2'){
            $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='ML'){
            $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Und'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Kg'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
           if($row['instalacion']=='No'){
        if($row['unidad_cobro']=='M2'){
            $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);

        }
        if($row['unidad_cobro']=='ML'){
            $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);

        }
        if($row['unidad_cobro']=='Und'){
            $tarf =  ($_GET["cant"]*$row["valor_mo"]);

        }
        if($row['unidad_cobro']=='Kg'){
            $tarf =  ($_GET["cant"]*$row["valor_mo"]);

        }
           if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
               if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 

               $tot_fom = $tot_fom + ($tarf * $v);
           }
         if($row['referencia']!='26002'){
               $tot_fom = $tot_fom + $tarf;
           }
        }
        if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
            if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
             $tot = $tot + ($tar * $v);

        }
        if($row['referencia']!='26002'){
             $tot = $tot + $tar;
        }
        }else{
        if($row['instalacion']=='No'){
        if($row['unidad_cobro']=='M2'){
            $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='ML'){
            $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Und'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
        if($row['unidad_cobro']=='Kg'){
            $tar =  ($_GET["cant"]*$row["valor_mo"]);
        }
        if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
            if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
             $tot = $tot + ($tar * $v);
        }
        if($row['referencia']!='26002'){
             $tot = $tot + $tar;
        }
        }else{
            $tar = 0;
        }
        }
        } 

        }
        $mano = $tot;
        $mano_fom = $tot_fom;

        ///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
        $suma_maq = $suma + $maquina + $mano;
        $suma_maq_sp = $suma_sp + $maquina_sinp + $mano;
        $suma_maq_fom = $suma_fom + $maquina_fom + $mano_fom;
        $suma_maq_fom_sin_p = $maquina_fom_sinp+ $suma_fom_sin_p + $mano;
        $request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$ref);


        if($request_ad){

        $tota=0;  $tota_sinp=0;$totafom=0;$totafom_sinp=0;
        while($row=mysqli_fetch_array($request_ad))
        {              
        $por = 100;
        if($row['referencia_ad']!='ADM-007'){
           $totafom = $totafom + ($suma_maq_fom*$row["porcentaje_ad"]/$por);
           $totafom_sinp = $totafom_sinp + ($suma_maq_fom_sin_p*$row["porcentaje_ad"]/$por);
        }
        $tota = $tota + ($suma_maq*$row["porcentaje_ad"]/$por);
        $tota_sinp = $tota_sinp + ($suma_maq_sp*$row["porcentaje_ad"]/$por);

        } 

        }
        $admin = $tota;
        $admin_sinp = $tota_sinp;
        $admin_fom = $totafom;
        $admin_fom_sinp = $totafom_sinp;
        /// gastos administrativos
        //echo 'otros'.$admin.'<br>';
        //  FIN DE OTROS ---------------------------------<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>
        if(isset($totsi)){
        $si = $totsi;
        }else{$si =0;}

        $totalx = $suma_maq + $admin;
        $totalx_sinp = $suma_maq_sp + $admin_sinp;
        $totalxfom = $suma_maq_fom + $admin_fom;
        $totalxfom_sinp = $suma_maq_fom_sin_p + $admin_fom_sinp;
        // se verifica que tenga ajuste de precio
        
        //porcentaje de venta P1
        $s3 = "SELECT (".$precio.") as p FROM porcentajes where area_por='Vidrio'";
        $fi3 = mysqli_fetch_array(mysqli_query($conexion,$s3));
        $mult = $fi3["p"]/100;
        $a = (($totalx / $mult) + $vjt);
        //valor unidad sin iva
        $adi = $precio_adi_total / $cann;
        $und = ($a / $cann);

        $tiva = ($a + $precio_adi_total) * 0.19;
        $t = ($a + $precio_adi_total) + $tiva;
        $to = $t * ($desc/100);
        $total = ($t + $to);
        
        $medida = $_GET['ancho'].'X'.$_GET['alto'];
       
        $sqlpedido = "update cotizacion_pedidos set  `medida`='$medida',`cantidad`='$cann',valor_und='$und', valor_total='".($pud * $cann)."' where `id_items`='".$_GET["idcot"]."'; ";
        $ver2 = mysqli_query($conexion,$sqlpedido); 
        
        if($und > 5000){

        $p = array();
        $p[0]= number_format(($a +$precio_adi_total),0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($und,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx ;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = ($a / $cann);
        $descpor = $pu * ($desc / 100);
        $pud = ($pu + $descpor) + $adi;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        
        $p[13] = $precio_adi_total;
            //------------------------------------------------------------
        }else{
            //-------------------------------------------------------------
        $p = array();
        $cadena_de_texto = $des;
        $cadena_buscada   = 'CRUDO';
        $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
        if ($posicion_coincidencia === false) {
        $precio = 10000;
        }else{
        $precio = 5000;
        }
        $tiva = ($precio*$cann) * 0.19;
        $t = ($precio*$cann) + $tiva;
        $to = $t * ($desc/100);
        $total = $t + $to;
        
        $p[0]= number_format(($a +$precio_adi_total),0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($precio,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = $precio;
        $descpor = $pu * ($desc / 100);
        $pud = ($pu + $descpor) + $adi;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        $p[13] = $precio_adi_total;
        //$p[13]=$posicion_coincidencia;
        }


        echo json_encode($p);
        exit();

        break;
        case 4:
        $desc = $_GET['desc'];
        $piva = $_GET['piva'];
        $to = $piva * ($desc/100);
        $total = $piva + $to;
        echo number_format($total,0,'','');
        break;
        case 5:
        $linea= 'Vidrio';
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= $_GET["vid2"];
        $vid3= $_GET["vid3"];
        $vid4= $_GET["vid4"];
        $vid5= $_GET["vid5"];
        $cot= $_GET["cot"];
        $cliente= $_GET["idc"];
        $precio_mp ='P1';
        $precio= 'P1';
        $ancho = $_GET["ancho"];
        $cantidad = $_GET["cant"];
        $alto = $_GET["alto"];
        $pelicula = $_GET["pelicula"];
        $install = $_GET["install"];
        $desc= $_GET["desc"];
        $per= $_GET["per"];
        $boq= $_GET["boq"];
        $rep= $_GET["rep"];
        $p4= $_GET["p4"];
        $p5= $_GET["p5"];
        $p6= $_GET["p6"];
        $p7= $_GET["p7"];
        $ajuste= $_GET["ajuste"];
        $adi= $_GET["adi"];

        $ubc= $_GET["ubc"];
        $obs= $_GET["obse"];
        $precioitem= $_GET["precio"];
        $pi = $precioitem * ($desc/100);
        $pitem = $precioitem + $pi;
        //echo $precioitem.' - '.$pi.' - '.$pitem;
        $maxid = mysqli_fetch_array(mysqli_query($conexion,"select max(id_dolar) from dolares"));
        $dolar = $maxid['max(id_dolar)'];
        $ct= $_GET["ct"];
        for($i=1;$i<=$rep;$i++){
            $ct = $ct + 1;
         $sql = "INSERT INTO `cotizaciones` (`adicional_per`,`ajuste`,`ubicacion_c`,`observaciones`,`fila`,`precio_item`, `lado`, `id_dolar`, `valor_c_sp`, `valor_fomp`, `ancho_temp`, `alto_temp`, `pelicula`, `valor_fom`, `modulo`, `imagen_mas`, `tip`,`imagen`, `ancho_abajo`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `install`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`,`tipo_c`, `duracion`, `horizontales`,`verticales`,`desc`, `observaciones2`, `hojas`, `cuerpo`, `color_ta`, `porcentaje`, `porcentaje_mp`, `per`, `boq`, `cod_traz`, `linea_cot`, `id_cot`, `cierre`, `id_referencia`, `id_vidrio`, `ancho_c`, `alto_c`, `valor_c`, `cant_restante`, `cantidad_c`, `id_cliente`, `estado_c`, `registrado_por_c` , `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
                               $sql.= "VALUES ('".$adi."','".$ajuste."','".$ubc."','".$obs."','".$ct."','".$pitem."','0', '".$dolar."', '".$p5."', '".$p7."', '0', '0', '".$pelicula."', '".$p6."', '0', '', '0','0', '0', '".$ref."', '0', '0', '0', '1', '0', '0', '0', '".$install."', '".$vid2."', '".$vid3."', '".$vid4."', '".$vid5."', '0','', '0', '0', '0','$desc', '', '1','0', 'N/A', 'P1', 'P1', '".$per."', '".$boq."','', '".$linea."', '".$cot."', 'No', '".$ref."', '".$vid."', '".$ancho."', '".$alto."',  '".$p4."',  '".$cantidad."',  '".$cantidad."', '".$cliente."', 'Cotizado', '".$_SESSION['k_username']."', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
         echo $ok = mysqli_query($conexion,$sql) ;
        }

        break;
        case 6:
            $idc= $_GET["idc"];
            $cot= $_GET["cot"];
            $ana= $_GET["ana"];
            $dep= $_GET["dep"];
            $ciu= $_GET["ciu"];
            $ase= $_GET["ase"];
            $dir= $_GET["dir"];
            $ent= $_GET["ent"];
            $obra= $_GET["obra"];
            $obs= $_GET["obs"];
            $ser= $_GET["exp"];
            $pag= $_GET["pag"];
            $tel= $_GET["tel"];
            $fecha_hoy = date("Y-m-d");
            if($cot==''){
            $sx = "SELECT max(numero_cotizacion) FROM cotizacion";
                                    $filax =mysqli_fetch_array(mysqli_query($conexion,$sx));
                                    $max_nc= $filax["max(numero_cotizacion)"]+1;
                                    if ($ent != "") {
                                        $fecha_serv_express = $ent;
                                    } else {
                                        $fecha_serv_express = '0000-00-00';
                                    }
                                    //echo "<script>alert('" . $_POST['serv_express'] . " - " . $fecha_serv_express . "');</script>";
                                    $sql = "INSERT INTO `cotizacion` (`sel_iva`, `express`, `fecha_de_entrega`, `nota`, `fecha_modificacion`, `fecha_reg_c`, `pago`, `registrado`, `version`, `numero_cotizacion`,`presupuesto`,`tipo`, `instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`municipio`,`id_tercero`, `grabado`, `estado`, `obra`, `ubicacion`, `linea`,`validez`,`cod_temp`,`nom_temp`)";
                                    $sql.= "VALUES ('19', '" .$ser."', '".$fecha_serv_express."', '".$obs."','".$fecha_hoy."', '".$fecha_hoy."', '".$pag."', '".$ase."', '1', '".$max_nc."', '".$ana."','Empresarial','Si','p1','No','','".$tel."','".$dep."','".$ciu."','".$idc."', '".$_SESSION['k_username']."', 'En proceso', '".$obra."', '".$dir."', 'Vidrio','30 dias','','')";
                                    $res = mysqli_query($conexion,$sql) ;



                                    $sql21 = "SELECT max(id_cot) FROM cotizacion";
                                    $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
                                    $max= $fila21["max(id_cot)"];
                                    $p = array();
                                    $p[0] = $max;
                                    $p[1] = $max_nc;
                                    $p[2] = 1;
                                    $p[3] = 'En proceso';
                                    $p[4] = $res;
                                    echo json_encode($p);
                                    exit();
            }else{
                date_default_timezone_set("America/Bogota" ) ; 
                $hora = date('H:i:s',time() - 3600*date('I'));
                $fecha_hoy = date("Y-m-d").' '.$hora;

                $result = mysqli_query($conexion,"select ultimo_estado from cotizacion where id_cot=".$cot." ");
                 $cq= mysqli_fetch_array($result);
                 if($cq['ultimo_estado']==''){
                     $estado_u = 'Pedido por aprobar';
                     mysqli_query($conexion,"update cotizacion set fecha_guardado='".date("Y-m-d H:m:s")."', registrado='$ase', express='$ser',fecha_de_entrega='$ent',nota='$obs',obra='$obra',validez='$pag', ubicacion='$dir', estado='$estado_u' where id_cot='$cot'  ");
                 }else{
                     $estado_u = $cq['ultimo_estado'];
                     mysqli_query($conexion,"update cotizacion set fecha_guardado='".date("Y-m-d H:m:s")."', registrado='$ase', express='$ser',fecha_de_entrega='$ent',nota='$obs',obra='$obra',validez='$pag', ubicacion='$dir', estado='$estado_u' where id_cot='$cot'  ");
                     mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`,registro)"
            . " VALUES (NULL, 'Cotizacion guardada por ".$_SESSION['k_username']." ultimo estado $estado_u ', '".$_SESSION['k_username']."', 'Cotizacion', '".$cot."','$fecha_hoy')");
                 }
                                $p = array();
                                     $p[0] = $cot;
                                    $p[1] = 0;
                                    $p[2] = 1;
                                    $p[3] = $estado_u;
                                    echo json_encode($p);
                                    exit();
            }
            break;
        case 7:
        $cot = $_GET['cot'];
        $result = mysqli_query($conexion,"SELECT *, d.estado FROM producto a, cotizaciones c, cotizacion d where c.linea_cot='Vidrio' and c.id_referencia=a.id_p and c.id_cot=d.id_cot and c.id_cot=".$cot."  order by c.fila asc");
        $c = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
        while($row = mysqli_fetch_array($result)){
        $c +=1;
        $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
        $fv1 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
        $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
        $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
        $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
        $fv3 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi3));
        $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
        $fv4 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
        $cons_vi5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio5']." ";
        $fv5 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi5));
        $valor_c = $row['valor_c'];
        $totalx = $valor_c;
        //$totalx_sinp = $suma_maq_sp + $admin_sinp;
        //$totalxfom = $suma_maq_fom + $admin_fom;
        //$totalxfom_sinp = $suma_maq_fom_sin_p + $admin_fom_sinp;
        //porcentaje de venta P1
        $s3 = "SELECT (".$row['porcentaje'].") as p FROM porcentajes where area_por='Vidrio'";
        $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $mult= $fi3["p"]/100;
        $a = ($totalx / $mult) + ($row['ajuste']*$row['cantidad_c']);
        $at = ($totalx) + ($row['ajuste']*$row['cantidad_c']);
        $und = ($a / $row['cantidad_c']);
        $adi = $row["adicional_per"] / $row['cantidad_c'];
        $tiva = ($a + $row["adicional_per"]) * 0.19;
        $t = ($a + $row["adicional_per"]) + $tiva;
        $to = $t * ($row['desc']/100);
        $total = $t + $to;
        
        $gtiva += $total;
        $ct += $row['cantidad_c'];
        if($row['estado']!='En proceso'){
           $di = 'disabled';
        }else{
           $di = '';
        }
        if($_GET['ser']=='1'){
           $dix = 'disabled';
        }else{
           $dix = '';
        }
        if($row['per']>0){
           $diper = '';
        }else{
           $diper = 'disabled';
        }
        if($row['per']>5){
           $a_per = $row['per'] - 5;
        }else{
           $a_per = 0;
        }
        if($row['boq']>3){
           $a_boq = $row['boq'] - 3;
        }else{
           $a_boq = 0;
        }
        if($row['boq']>0){
           $diboq = '';
        }else{
           $diboq = 'disabled';
        }
        if($row['id_vidrio2']!=0){
           $text2 = 'text';
           $px='20';
        }else{
           $text2 = 'hidden';
           $px='80';
        }
        if($row['id_vidrio3']!=0){
           $text3 = 'text';
        }else{
           $text3 = 'hidden';
        }
        if($row['id_vidrio4']!=0){
           $text4 = 'text';
        }else{
           $text4 = 'hidden';
        }
        if($row['id_vidrio5']!=0){
           $text5 = 'text';
        }else{
           $text5 = 'hidden';
        }
        
        $pu = ($a / $row["cantidad_c"]);
        $descpor = $pu * $row["desc"] / 100;
        $pud = $pu + $descpor;
        $descuento_g = ($row["descuento_g"] / 100) * $pud;
        $pudt = ($pud - $descuento_g) + $adi;
        $ptt2 = ($pudt ) * $row["cantidad_c"];
        $gt += $ptt2;
        ?>
        <tr>
            <td>
            <input type="hidden" id="id_cotizacion<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['id_cotizacion']; ?>">
            <input type="hidden" id="p4<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['valor_c']; ?>">
            <input type="hidden" id="p5<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['valor_c_sp']; ?>">
            <input type="hidden" id="p6<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['valor_fom']; ?>">
            <input type="hidden" id="p7<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['valor_fomp']; ?>">
         <input type="hidden" id="adi_per_boq<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['adicional_per']; ?>">
            <input type="text" <?php echo $di; ?> id="tipo<?php echo $c; ?>" style="text-align: center" class="input6" value="<?php echo $row['fila']; ?>"></td>
            <td><input type="hidden" id="idp<?php echo $c; ?>" class="input6" value="<?php echo $row['id_referencia']; ?>">
            <input type="text" id="cod<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['codigo']; ?>"></td>
            <td><input type="text" id="des<?php echo $c; ?>" style="width: 150px" disabled value="<?php echo $row['producto']; ?>" title="<?php echo $row['producto']; ?>"></td>
            <td><input type="hidden" id="ajuste<?php echo $c; ?>"  style="width: 70px" disabled value="<?php echo $row['ajuste']; ?>">
                <input type="hidden" id="idv<?php echo $c; ?>" style="width: 80px" value="<?php echo $row['id_vidrio']; ?>">
                <input type="text" <?php echo $di; ?> onclick="lista_vidrios(<?php echo $c; ?>)" id="vid<?php echo $c; ?>" style="width: <?php echo $px; ?>px"  value="<?php echo $fv1['color_v']; ?>" title="<?php echo $fv1['color_v']; ?>">

                <input type="hidden" id="idva<?php echo $c; ?>" style="width: 20px" value="<?php echo $row['id_vidrio2']; ?>">
                <input type="<?php echo $text2; ?>" <?php echo $di; ?> onclick="lista_vidrios2(<?php echo $c; ?>)" id="vida<?php echo $c; ?>" style="width: 20px"  value="<?php echo $fv2['color_v']; ?>" title="<?php echo $fv2['color_v']; ?>">

                <input type="hidden" id="idvb<?php echo $c; ?>" style="width: 20px" value="<?php echo $row['id_vidrio3']; ?>">
                <input type="<?php echo $text3; ?>" <?php echo $di; ?> onclick="lista_vidrios3(<?php echo $c; ?>)" id="vidb<?php echo $c; ?>" style="width: 20px"  value="<?php echo $fv3['color_v']; ?>" title="<?php echo $fv3['color_v']; ?>">

                <input type="hidden" id="idvc<?php echo $c; ?>" style="width: 20px" value="<?php echo $row['id_vidrio4']; ?>">
                <input type="<?php echo $text4; ?>" <?php echo $di; ?> onclick="lista_vidrios4(<?php echo $c; ?>)" id="vidc<?php echo $c; ?>" style="width: 20px"  value="<?php echo $fv4['color_v']; ?>" title="<?php echo $fv4['color_v']; ?>">

                <input type="hidden" id="idvc<?php echo $c; ?>" style="width: 20px" value="<?php echo $row['id_vidrio5']; ?>">
                <input type="<?php echo $text5; ?>" <?php echo $di; ?> onclick="lista_vidrios5(<?php echo $c; ?>)" id="vidc<?php echo $c; ?>" style="width: 20px"  value="<?php echo $fv5['color_v']; ?>" title="<?php echo $fv5['color_v']; ?>">

            </td>
            <td><input type="text" <?php echo $di; ?> onchange="validarinput('ancho',<?php echo $c; ?>);actualizaritems(<?php echo $c; ?>);" id="ancho<?php echo $c; ?>" style="width: 40px" value="<?php echo $row['ancho_c']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> onchange="validarinput('alto',<?php echo $c; ?>);actualizaritems(<?php echo $c; ?>);" id="alto<?php echo $c; ?>" style="width: 40px" value="<?php echo $row['alto_c']; ?>"></td>
            <td><input type="number" id="per<?php echo $c; ?>"  onchange="validarinput('per',<?php echo $c; ?>)" style="width: 25px" <?php echo $diper; ?> value="<?php echo $row['per']; ?>"></td>
            <td><input type="number" id="boq<?php echo $c; ?>"  onchange="validarinput('per',<?php echo $c; ?>)" style="width: 25px" <?php echo $diboq; ?> value="<?php echo $row['boq']; ?>"></td>
            <td><input type="number" <?php echo $di; ?> onchange="actualizaritems(<?php echo $c; ?>);" style="text-align: center" id="cant<?php echo $c; ?>" class="input6" value="<?php echo $row['cantidad_c']; ?>"></td>
            <td><input type="hidden" id="preund<?php echo $c; ?>"  style="width: 60px;text-align: right" disabled value="<?php echo round($und); ?>">
            <input type="text"  id="pud<?php echo $c; ?>"  style="width: 60px;text-align: right" disabled value="<?php echo round($pudt); ?>"></td>
            <td><input type="hidden" id="pretotal<?php echo $c; ?>"  style="width: 60px;text-align: right" disabled value="<?php echo round($a+$row['adicional_per']); ?>">
            <input type="text"  id="ptd<?php echo $c; ?>"  style="width: 60px;text-align: right" disabled value="<?php echo round($ptt2); ?>"></td>
            <td><input type="text"  id="piva<?php echo $c; ?>"  style="width: 60px;text-align: right" disabled value="<?php echo round($total); ?>">

            <input type="hidden" id="pivaOut<?php echo $c; ?>"  style="width: 60px" disabled value="<?php echo round($t); ?>"></td>
            <td><input type="number" <?php echo $dix; ?> onchange="actualizaritems(<?php echo $c; ?>);" id="desc<?php echo $c; ?>" style="width: 35px" maxlength="3"  value="<?php echo $row['desc']; ?>"></td>

            <td><input type="text" id="ubc<?php echo $c; ?>" style="width: 50px" value="<?php echo $row['ubicacion_c']; ?>" title="<?php echo $row['ubicacion_c']; ?>"></td>
            <td><input type="text" id="obse<?php echo $c; ?>" style="width: 50px" value="<?php echo $row['observaciones']; ?>" title="<?php echo $row['observaciones']; ?>"></td>
            <td><input type="text" id="rep<?php echo $c; ?>" style="width: 20px" value="1"></td>
            <td> <div id="boton<?php echo $c; ?>"><button <?php echo $di; ?> onclick="del_item(<?php echo $c.','.$row['id_cotizacion']; ?>);" id="bot<?php echo $c; ?>" >-</button>
            <button <?php echo $di; ?> onclick="rep_item(<?php echo $c.','.$row['id_cotizacion']; ?>);" id="bot<?php echo $c; ?>" >R</button></div></td>

        </tr>


        <?php
        }
        ?>
        <tr>
            <th><input type="text" id="ct" style="width: 40px" value="<?php echo $c; ?>" disabled></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Totales:</th>
            <th><input type="text" id="cantotal"  class="input6" disabled value="<?php echo number_format($ct); ?>"></th>
            <th></th>
            <th><input type="text" id=""  style="width: 70px;text-align: right" disabled value="<?php echo number_format($gt); ?>"></th>
            <th><input type="text" id="grantotal"  style="width: 70px;text-align: right" disabled value="<?php echo number_format($gtiva); ?>"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
        mysqli_query($conexion,"update cotizacion set costo_total='$gt' where id_cot='$cot' ");
        break;
        case 8:
        $id=$_GET['id'];
        mysqli_query($conexion,"delete from cotizaciones where id_cotizacion='$id' ");

        break;
        case 9:
        $id  = $_GET['id'];
        $rep = $_GET['rep'];

        $result = mysqli_query($conexion,"select * from cotizaciones where id_cotizacion='$id' ");
        $row = mysqli_fetch_array($result);
        for($i=1;$i<=$rep;$i++){
         $ct = $_GET['ct'] + $i;
           $sql2 = "INSERT INTO `cotizaciones` (`ajuste`,`precio_item`,`precio_fom_sp`,`lado`,`id_dolar`,`descuento_g`, `ancho_temp`, `alto_temp`, `valor_c_sp`,`valor_fom`,`valor_costob`,`valor_fomp`, `pelicula`, `precio_adicional`,`precio_material`,`modulo`, `observaciones2`,`an`, `al`, `fila`, `tip`, `imagen_mas`, `imagen`, `ancho_abajo`, `ubicacion_c`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `install`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`,`tipo_c`, `duracion`, `horizontales`,`verticales`,`desc`, `observaciones`, `hojas`, `cuerpo`, `color_ta`, `porcentaje`, `porcentaje_mp`, `per`, `boq`, `cod_traz`, `linea_cot`, `id_cot`, `cierre`, `id_referencia`, `id_vidrio`, `ancho_c`, `alto_c`, `valor_c`, `cant_restante`, `cantidad_c`, `id_cliente`, `estado_c`, `registrado_por_c` , `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
         $sql2.= "VALUES ('".$row['ajuste']."','".$row['precio_item']."','".$row['precio_fom_sp']."','".$row['lado']."','".$row['id_dolar']."','".$row['descuento_g']."', '".$row['ancho_temp']."','".$row['alto_temp']."','".$row['valor_c_sp']."','".$row['valor_fom']."','".$row['valor_costob']."','".$row['valor_fomp']."','".$row['pelicula']."', '".$row['precio_adicional']."','".$row['precio_material']."','".$row['modulo']."', '".$row['observaciones2']."','".$row['an']."','".$row['al']."','".$ct."','".$row['tip']."','".$row['imagen_mas']."','".$row['imagen']."','".$row['ancho_abajo']."', '".$row['ubicacion_c']."', '".$row['traz_vid']."', '".$row['traz_vid2']."', '".$row['traz_vid3']."', '".$row['traz_vid4']."', '".$row['laminas']."', '".$row['laminas2']."', '".$row['laminas3']."', '".$row['laminas4']."', '".$row['install']."', '".$row['id_vidrio2']."', '".$row['id_vidrio3']."', '".$row['id_vidrio4']."', '".$row['id_vidrio5']."', '".$row['id_vidrio6']."','".$row['tipo_c']."', '".$row['duracion']."', '".$row['horizontales']."', '".$row['verticales']."','".$row['desc']."', '".$row['observaciones']."', '".$row['hojas']."', '".$row['cuerpo']."', '".$row['color_ta']."', '".$row['porcentaje']."', '".$row['porcentaje_mp']."', '".$row['per']."', '".$row['boq']."','".$row['cod_traz']."', '".$row['linea_cot']."', '".$row['id_cot']."', '".$row['cierre']."', '".$row['id_referencia']."', '".$row['id_vidrio']."', '".$row['ancho_c']."', '".$row['alto_c']."',  '".$row['valor_c']."',  '".$row['cantidad_c']."',  '".$row['cantidad_c']."', '".$row['id_cliente']."', 'Cotizado', '".$_SESSION['k_username']."', '".$row['d1']."', '".$row['id2_vidrio']."', '".$row['id2_vidrio2']."', '".$row['id2_vidrio3']."', '".$row['id2_vidrio4']."', '".$row['id2_vidrio5']."', '".$row['id3_vidrio']."', '".$row['id3_vidrio2']."', '".$row['id3_vidrio3']."', '".$row['id3_vidrio4']."', '".$row['id3_vidrio5']."', '".$row['id4_vidrio']."', '".$row['id4_vidrio2']."', '".$row['id4_vidrio3']."', '".$row['id4_vidrio4']."', '".$row['id4_vidrio5']."')";
         mysqli_query($conexion,$sql2);
        }



        break;
        case 10:
        $linea= 'Vidrio';
        $id_cot= $_GET["id_cot"];
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= $_GET["vid2"];
        $vid3= $_GET["vid3"];
        $vid4= $_GET["vid4"];
        $cot= $_GET["cot"];
        $cliente= $_GET["idc"];
        $precio_mp ='P1';
        $precio= 'P1';
        $ancho = $_GET["ancho"];
        $cantidad = $_GET["cant"];
        $alto = $_GET["alto"];
        $pelicula = $_GET["pelicula"];
        $install = $_GET["install"];
        $desc= $_GET["desc"];
        $per= $_GET["per"];
        $boq= $_GET["boq"];
        $rep= $_GET["rep"];
        $p4= $_GET["p4"];
        $p5= $_GET["p5"];
        $p6= $_GET["p6"];
        $p7= $_GET["p7"];
        $ajuste= $_GET["ajuste"];
        $ubc= $_GET["ubc"];
        $obse= $_GET["obse"];
        $fila= $_GET["fila"];
        $precioitem= $_GET["precio"];
        $adi= $_GET["adi"];
        $pi = $precioitem * ($desc/100);
        $pitem = $precioitem + $pi;
        $vtt = $pitem / $cantidad;
        $sql = "update cotizaciones set  `adicional_per`='$adi',`ajuste`='$ajuste',`ubicacion_c`='$ubc',`observaciones`='$obse',`fila`='$fila',`id_vidrio`='$vid',`id_vidrio2`='$vid2',`id_vidrio3`='$vid3',`id_vidrio4`='$vid4', `cantidad_c`='$cantidad', `cant_restante`='$cantidad', `valor_c`= '$p4', `valor_c_sp`='$p5', `valor_fom`='$p6', `valor_fomp`='$p7', `precio_item`='$pitem', `desc`='".$desc."', `per`='$per', `boq`='$boq', `ancho_c`='$ancho', `alto_c`='$alto' where `id_cotizacion`='".$id_cot."'; ";
        $ver = mysqli_query($conexion,$sql) ;
        date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('H:i:s',time() - 3600*date('I'));
        $fecha_hoy = date("Y-m-d").' '.$hora;

        mysqli_query($conexion,"INSERT INTO `modificaciones` (`id_m`, `descripcion`, `por`, `modulo`, `id_cotizacion`,registro)"
            . " VALUES (NULL, 'Items  $id_cot actualizado por ".$_SESSION['k_username']." ', '".$_SESSION['k_username']."', 'Cotizacion', '".$cot."','$fecha_hoy')");
        
        
        echo $pi;
        break;
        case 11:
        $request2=mysqli_query($conexion,'select * from cotizacion a, cont_terceros b WHERE a.id_tercero=b.id_ter and a.id_cot="'.$_GET["cot"].'"');
        $row2=mysqli_fetch_array($request2);
        $p = array();
        $p[0] = $row2["id_ter"];
        $p[1] = $row2["cod_ter"];
        $p[2] = $row2["dir_ter"];
        $p[3] = $row2["telfijo_ter"];
        $p[4] = $row2["telmovil_ter"];
        $p[5] = $row2["correo_ter"];
        $p[6] = $row2["cont_ter"];
        $p[7] = $row2["nom_ter"];
        $p[8] = $row2["ciudad_ter"];
        $p[9] = $row2["municipio_ter"];
        $p[10] = $row2["vendedor"];
        $p[11] = $row2["pvi"];

        $p[12] = $row2["ubicacion"];
        $p[13] = $row2["obra"];
        $p[14] = substr($row2["fecha_reg_c"],0,-9);
        $p[15] = $row2["registrado"];
        $p[16] = $row2["estado"];
        $p[17] = $row2["linea"];
        $p[18] = $row2["tel_responsable"];
        $p[19] = $row2["ciudad"];
        $p[20] = $row2["municipio"];
        $p[21] = $row2["numero_cotizacion"];
        $p[22] = $row2["version"];
        $p[23] = $row2["validez"];
        $p[24] = $row2["express"];
        $p[25] = $row2["fecha_de_entrega"];
        $p[26] = $row2["nota"];
        $p[27] = $row2["presupuesto"];
        $p[28] = $row2["registrado"];
        echo json_encode($p);
        exit();
        break;
        case 12:
        $ref= $_GET["ref"];
        $esp= $_GET["esp"];
        $pre= $_GET["pre"];
        $und= $_GET["und"];
        $aju= $_GET["aju"];
        $user= $_SESSION['k_username'];
        $fecha= date('Y-m-d');
        $ver = mysqli_query($conexion,"select count(id_ajuste), id_ajuste from ajustes where id_referencia=$ref and id_vidrio=$esp  ");
        $v = mysqli_fetch_array($ver);
        if($v[0]==0){
            $ok = mysqli_query($conexion,"insert into ajustes (id_referencia, id_vidrio, valor, precio, ajuste, por) values ($ref,$esp,$pre,$und,$aju, '$user')") ;
            echo $ok;
        }else{
           $id = $v[1];
           mysqli_query($conexion,"update ajustes set precio = $pre, valor= $und, ajuste= $aju, por= '$user' where id_ajuste=$id ");
            echo "2";
        }


        break;
        case 13:
            if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='STEFANNYR' || $_SESSION['k_username']=='jbarco' || $_SESSION['k_username']=='samir'){
                $dis = '';
            }else{
                $dis = 'disabled';
            }
        if($_GET['pro']!=''){
          $pro = ' and c.id_referencia = "'.$_GET['pro'].'" ';
        }else{
            $pro = '  ';
        }
        if($_GET['esp']!=''){
           $esp= ' and c.id_vidrio like "%'.$_GET['esp'].'%" ';
        }else{
           $esp = '';
        }
        $result = mysqli_query($conexion,"SELECT id_ajuste, producto, color_v, valor, ajuste, precio, fecha, por, c.id_referencia, c.id_vidrio FROM producto a, tipo_vidrio b, ajustes c where a.id_p=c.id_referencia and b.id_vidrio=c.id_vidrio ".$esp."  ".$pro." ");
    
        while ($r = mysqli_fetch_array($result)) {
           echo "<tr>
               <td>$r[0]</td>
               <td>".$r[8]." - ".$r[1]."</td>
               <td>".$r[9]." - $r[2]</td>
               <td><input type='' id='a".$r[0]."' value='".$r[3]."' style='width:80px;text-align:right' onchange='ajuste_manual(".$r[0].")' disabled></td>
               <td><input type='' id='b".$r[0]."' value='".$r[4]."' style='width:80px;text-align:right' onchange='ajuste_manual(".$r[0].")' disabled></td>
               <td><input type='' id='c".$r[0]."' value='".$r[5]."' style='width:80px;text-align:right' onchange='ajuste_manual(".$r[0].")' $dis></td>
               <td>$r[6]</td>
               <td id='por".$r[0]."'>$r[7]</td>"
            . "<td><button onclick='eliminar($r[0]);' $dis tittle='Eliminar registro'>x</button>"
                   . " <button onclick='recalcular(".$r[8].",".$r[9].",".$r[0].");' $dis  data-toggle='tooltip' data-placement='top' title='Recalcular Ajuste de precio y actualizarlo'>R</button>"
                   . "<span id='ok".$r[0]."'></span></td>";
        }

        break;
        case 14:
        $id= $_GET["id"];
        $vid= $_GET["vid"];
        $alu= $_GET["alu"];
        $ace= $_GET["ace"];
        mysqli_query($conexion,"update cont_terceros set pvi='$vid', pal='$alu', pac='$ace', autorizacion='".$_SESSION['k_username']."' where id_ter='$id' ");
        echo $_SESSION['k_username'];
        break;
        case 15:
        $id= $_GET["id"];
        $est= $_GET["est"];

        mysqli_query($conexion,"update tipo_vidrio set estado='$est', modi='".$_SESSION['k_username']."' where id_vidrio='$id' ");
        echo $_SESSION['k_username'];

        break;
        case 16:
        if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='STEFANNYR' || $_SESSION['k_username']=='TATIANA.JULIAO' || $_SESSION['k_username']=='LTAMAYO'){
        $id= $_GET["id"];
        mysqli_query($conexion,"delete from ajustes where id_ajuste='$id' ");
        }

        break;
        case 17:
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $ver = mysqli_query($conexion,"select count(*) from ajustes where id_referencia=$ref and id_vidrio=$vid  ");
        $v = mysqli_fetch_array($ver);
        echo $v[0];
        break;
        case 18:
        $linea= 'Vidrio';
        $ref= $_GET["ref"];
        $vid= $_GET["vid"];
        $vid2= 0;
        $vid3= 0;
        $vid4= 0;
        $precio_mp ='P1';
        $precio= 'P1';
        $an2 = 1000;
        $cann = 1;
        $all = 1000;
        $pelicula = 'No Aplica';
        $cantidad = $cann;
        $install ='No';
        $desc= 0;
        $des= 0;
        $m2 = (($an2/1000)*($all/1000))*$_GET['cant'];
        //PORCENTAJE DE P1 PARA LOS 4 VIDRIOS
//se quito esta parte para el calculo individual del vidrio sin el ajuste
            $vj = 0;
            $vjt = 0;
   
            if($_GET['per']>5){
            $_GET['per'] = $_GET['per'];
        }else{
            $_GET['per'] = 0;
        } 
        if($_GET['boq']>3){
            $_GET['boq'] = $_GET['boq'];
        }else{
            $_GET['boq'] = 0;
        }    
        //CALCULO DE VIDRIO 1
        if($vid!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
                $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv1 = 0 ;  $totalv1sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 1
                
                //CALCULO DE VIDRIO 2
                        if($vid2!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid2."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv2 = 0 ;  $totalv2sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 2
                //CALCULO VIDRIO 3
                if($vid3!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid3."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
                $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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

                $totalv3 = $total + (($vvc)/$porc)+$stt;
                $totalv3sp = $total + (($vvc))+$stt;
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv3 = 0 ;  $totalv3sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 3
                //CALCULO VIDRIO 4
                if($vid4!=''){
        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$vid4."'";
        $fi31 =mysqli_fetch_array(mysqli_query($conexion,$s3));
        $costo_vidrio= $fi31["costo_v"];
        $espesor= $fi31["espesor_v"];
        $vvc = $m2 * $costo_vidrio;
        //calcular peso del vidrio
        $peso = $m2 * $espesor * 2.5;
        
        $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$ref.'"';                     
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
                $st = "SELECT costo FROM servicio_temple where espesor='".$espesor."'";
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
                $totalv4 = $total + (($vvc)/$porc)+$stt;
                $totalv4sp = $total + (($vvc))+$stt;
                //echo $totalv1;  total de precio de vidrios con p1
                }else{
                   $totalv4 = 0 ;  $totalv4sp = 0 ;
                }
                
                //FIN DE CALCULO VIDRIO 4
                


                // SUMA DE ACCESORIOS
                 $acc_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
                 $acc_porB = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fipaB =mysqli_fetch_array(mysqli_query($conexion,$acc_porB));
                $porcaccB= $fipaB["p"]/100; 
                  $request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." order by b.para ");
if($request_acE){

        $tac = 0; $tacfom = 0; $tacfomp = 0;
	while($row=mysqli_fetch_array($request_acE))
	{  
       //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$ref." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxy));
            $id_p= $fil_an["id_p"];
        
                if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
        
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])- $fil_an['variable'];
      
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='*'){
                 if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])* $fil_an['variable'];
              
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an['signo']=='/'){
               if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_GET['ancho']+$fil_an["descuento"])/ $fil_an['variable'];
           
            }else{
                $al = ($_GET['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($linea=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$_GET['alto']) / $row["metro"])+$row["cantidad_acc"]);
                     }else{
                         $res = ((($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"])+$row["cantidad_acc"]);
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_GET['hoja'] * 2 * $row["cantidad_acc"];
               $res = (($_GET['ancho'] / 1000) * 2) + (($_GET['alto']/1000)*$rs);
            }ELSE{
                  if($row['calcular']=='M2'){
                      $res = (($_GET['alto'] / 1000)) * (($_GET['ancho']/1000))* $row["cantidad_acc"];
                }else{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$_GET['alto']) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$_GET['ancho']) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_GET["cant"])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].' ';
                 $ft = 'No aplica' ;$a = '' ;
             }
            if($_GET['pelicula']!="No Aplica"  && $row['codigo']=='26002'){
            if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
            $tac = $tac + (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
//            echo (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
            $tacfom = $tacfom + (($taa * $v) * ($row["costo_fom"])*$m*$_GET['cant'] + $a);
            $tacfomp = $tacfomp + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
           
            }
            if($row['codigo']!='26002'){ 
//                echo ($taa*($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
            $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['cant'] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"])*$m*$_GET['cant'] + $a);
            $tacfomp = $tacfomp + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET['cant'] + $a);
            }
           //echo $tac.'<br>';
	} 

}
$accesorios = $tac;
$accesorios_sinp = $tac * $porcacc;
$accesorios_fom = $tacfomp;
$accesorios_fom_sinp = $tacfomp * $porcaccB;
                // FIN DE ACCESORIOS
                // 
                $suma = $totalv1+$totalv2+$totalv3+$totalv4 + $accesorios;
                $suma_sp = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp + $accesorios_sinp;
                $suma_fom = $totalv1+$totalv2+$totalv3+$totalv4 + $accesorios;
                $suma_fom_sin_p = $totalv1sp+$totalv2sp+$totalv3sp+$totalv4sp + $accesorios_sinp + $accesorios_sinp;
//comienzo de maquinaria          
$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$ref);    
if($request_mano){
        $tot2=0;$tot2fom=0;$tot2fomp=0; $totsinp = 0;
	while($row=mysqli_fetch_array($request_mano))
	{       
              $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            if($row['dias']=='Si'){
                if($_GET['alto']>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 1;
                }
                $duracion=1;//esta variable viene del formulario, le coloque 1 
               $r = $row["porcentaje_ma"]*($res)*$duracion;
                $tot2 = $tot2 + $r ;
                $tot2fom = $tot2fom + $r ;
                $tot2fomp = $tot2fomp + $r ;
                $totsinp = $totsinp + $r ;
            }else{
                $r = $row["porcentaje_ma"]/100*$suma;
                $tot2 = $tot2 + $r;
                
                $r2 = $row["porcentaje_ma"]/100*$suma_fom;
                 $tot2fom = $tot2fom + $r2 ; 
                 
                 $r3 = $row["porcentaje_ma"]/100*$suma_fom_sin_p;
                 $tot2fomp = $tot2fomp + $r3 ;
                 
                 $r4 = $row["porcentaje_ma"]/100*$suma_sp;
                 $totsinp = $totsinp + $r4 ;
            }    
	} 
}
//fin de maquinaria
//
//comienzo de mano de obra
$maquina = $tot2;
$maquina_sinp = $totsinp;
$maquina_fom = $tot2fom;
$maquina_fom_sinp = $tot2fomp;

// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

           $req=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$ref);
        if($req){
        $tot=0;$tot_fom = 0;
	while($row=mysqli_fetch_array($req))
	{       
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
             if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
           if($_GET["install"]=="Si"){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                   if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($_GET["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($_GET["cant"]*$row["valor_mo"]);
                    
                }
                   if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                       if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                    
                       $tot_fom = $tot_fom + ($tarf * $v);
                   }
                 if($row['referencia']!='26002'){
                       $tot_fom = $tot_fom + $tarf;
                   }
                }
                if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                    if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                  
                }
                if($row['referencia']!='26002'){
                     $tot = $tot + $tar;
                }
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($_GET['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                    if($_GET['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                }
                if($row['referencia']!='26002'){
                     $tot = $tot + $tar;
                }
                }else{
                    $tar = 0;
                }
            }
	} 

}
$mano = $tot;
$mano_fom = $tot_fom;

///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
$suma_maq = $suma + $maquina + $mano;
$suma_maq_sp = $suma_sp + $maquina_sinp + $mano;
$suma_maq_fom = $suma_fom + $maquina_fom + $mano_fom;
$suma_maq_fom_sin_p = $maquina_fom_sinp+ $suma_fom_sin_p + $mano;
$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$ref);
    

if($request_ad){

        $tota=0;  $tota_sinp=0;$totafom=0;$totafom_sinp=0;
	while($row=mysqli_fetch_array($request_ad))
	{              
             $por = 100;
              if($row['referencia_ad']!='ADM-007'){
                   $totafom = $totafom + ($suma_maq_fom*$row["porcentaje_ad"]/$por);
                   $totafom_sinp = $totafom_sinp + ($suma_maq_fom_sin_p*$row["porcentaje_ad"]/$por);
              }
             $tota = $tota + ($suma_maq*$row["porcentaje_ad"]/$por);
             $tota_sinp = $tota_sinp + ($suma_maq_sp*$row["porcentaje_ad"]/$por);
            
	} 

}
$admin = $tota;
$admin_sinp = $tota_sinp;
$admin_fom = $totafom;
$admin_fom_sinp = $totafom_sinp;
/// gastos administrativos
//echo 'otros'.$admin.'<br>';
//  FIN DE OTROS ---------------------------------<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>
  if(isset($totsi)){
    $si = $totsi;
}else{$si =0;}

$totalx = $suma_maq + $admin;
$totalx_sinp = $suma_maq_sp + $admin_sinp;
$totalxfom = $suma_maq_fom + $admin_fom;
$totalxfom_sinp = $suma_maq_fom_sin_p + $admin_fom_sinp;
// se verifica que tenga ajuste de precio

//porcentaje de venta P1
$s3 = "SELECT (".$precio.") as p FROM porcentajes where area_por='Vidrio'";
                $fi3 = mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult = $fi3["p"]/100;
                $a = (($totalx / $mult));
                //valor unidad sin iva
                $und = ($a / $cann) ;
 
               $tiva = $a * 0.19;
               $t = $a + $tiva;
               $to = $t * ($desc/100);
               $total = $t + $to;
               
    if($und > 5000){

        $p = array();
        $p[0]= number_format($a,0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($und,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = ($a / $cann);
        $descpor = $pu * ($desc / 100);
        $pud = $pu + $descpor;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        
    }else{
        $p = array();
        $cadena_de_texto = $des;
        $cadena_buscada   = 'CRUDO';
        $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
        if ($posicion_coincidencia === false) {
            $precio = 10000;
        }else{
            $precio = 5000;
        }
               $tiva = ($precio*$cann) * 0.19;
               $t = ($precio*$cann) + $tiva;
               $to = $t * ($desc/100);
               $total = $t + $to;
               
        $p[0]= number_format($a,0,'','');
        $p[1]= number_format($tiva,0,'','');
        $p[2]= number_format($precio,0,'','');
        $p[3]= number_format($total,0,'','');
        $p[4]=$totalx;
        $p[5]=$totalx_sinp;
        $p[6]=$totalxfom;
        $p[7]=$totalxfom_sinp;
        $p[8]= number_format($t,0,'','');
        $p[9]= 'vidrios: '.$suma.' - ';
        $p[10]= $vj;

        $pu = $precio;
        $descpor = $pu * ($desc / 100);
        $pud = $pu + $descpor;
        $p[11]= number_format($pud,0,'','');
        $p[12]= number_format(($pud * $cann),0,'','');
        //$p[13]=$posicion_coincidencia;
    }
        
                
        echo json_encode($p);
        exit();
        
        break;
    case 19:
        $id = $_GET['id'];
        $cos = $_GET['cos'];
        $pre = $_GET['pre'];
        $aju = $_GET['aju'];
        $use = $_SESSION['k_username'];
        mysqli_query($conexion,"update ajustes set valor='$cos', precio='$pre', ajuste='$aju', por='$use' where id_ajuste='$id' ");
        echo $use;
        break;
        case 20:
            $cot = $_GET['cot'];
            $cod = $_GET['cod'];
            $id = $_GET['id'];
            $descri = $_GET['descri'];
            $col = $_GET['col'];
            $med = $_GET['med'];
            $can = $_GET['can'];
            $pre = $_GET['pre'];
            $pre_r = $_GET['pre_r'];
            $neto = $_GET['neto'];
            $tota = $_GET['tota'];
            $des = $_GET['des'];
            $m = $_GET['m'];
            
            $sql = "INSERT INTO `cotizaciones_materiales` (`color_ma`, `med`, `pe`, `id_cotizacion`, `id_material`, `cantidad_mat`, `descuento_mat`, `valor_und`, `valor_neto`, `valor_pagar`, `descripcion_material`, `codigo_material`)";
            $sql.= "VALUES ('".$col."', '".$med."', 'p1','".$cot."', '".$id."', '".$can."', '".$des."', '".$pre_r."', '".$neto."', '".$tota."', '".$descri."', '".$cod."')";
            $ver = mysqli_query($conexion,$sql) ;
            echo $ver;
            
            
        break;
        case 21:
        $cot = $_GET['cot'];
        $query = mysqli_query($conexion,"select * from cotizaciones_materiales where id_cotizacion = '$cot' ");
        
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_row($query)){
            $c ++;
            $nt += $f[12];
            $tt += $f[13];
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$f[15].'</td>'
                    . '<td>'.$f[14].'</td>'
                    . '<td>'.$f[9].'</td>'
                    . '<td><input type="number" id="v_med'.$f[0].'" value="'.$f[7].'" style="width:60px" disabled></td>'
                    . '<td><input type="number" id="v_can'.$f[0].'" value="'.$f[3].'" style="width:50px" disabled></td>'
                    . '<td><input type="number" id="v_und'.$f[0].'" value="'.$f[11].'" style="width:80px;text-align:right" disabled></td>'
                    . '<td><input type="number" id="v_net'.$f[0].'" value="'.$f[12].'" style="width:80px;text-align:right" disabled></td>'
                    . '<td><input type="number" id="v_tot'.$f[0].'" value="'.$f[13].'" style="width:80px;text-align:right" disabled></td>'
                    . '<td><input type="number" id="v_por'.$f[0].'" value="'.$f[4].'" style="width:60px;text-align:right"  disabled></td>'
                    . '<td><button id="btn_del_ven" onclick="del_ventas('.$f[0].')"> - </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nt).'</td>'
                    . '<td style="text-align:right">'.number_format($tt).'</td>'
                    . '<td style="text-align:right"></td>'
                    . '<td></td>';
        break;
    case 22:
        $id = $_GET['id'];
        $query = mysqli_query($conexion,"delete from cotizaciones_materiales where id_cot_mat = '$id' ");
        echo $query;
        break;
    case 23:
         $id = $_GET['id'];
          $uti = $_GET['uti'];
           $costo = $_GET['cos'];
           $ver = mysqli_query($conexion,"update referencias set costo_mt='$costo', utilidad='$uti', modificado='".$_SESSION['k_username']."' where id_referencia='$id' ") ;
           echo $ver. mysqli_error($conexion);
           break;
        
        
    
}
