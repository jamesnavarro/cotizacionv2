<?php
session_start();
require("conexion.php");
$status = "";
           $linea= $_POST["linea"];
            $cot= $_GET["cot"];
            
            $ref= $_POST["ref"];
            $cliente= $_GET["cli"];
            $tipo_cli= $_GET["tipo_cli"];
            $vid= $_POST["vid"];
            if(isset($_POST["modulo"])){ $modulo= $_POST["modulo"];}else{$modulo='';}
            $tip= 0;
            if(isset($_POST["vidd"])){$vidd = $_POST["vidd"];}else{$vidd = '';}
            if(isset($_POST["vidt"])){$vidt = $_POST["vidt"];}else{$vidt = '';}
            if(isset($_POST["vidc"])){$vidc = $_POST["vidc"];}else{$vidc = '';}
            $cantidad= $_POST["cant"];
            $ancho= $_POST["ancho"];
            $ancho_a= $_POST["ancho_abajo"];$aa= $_POST["ancho_abajo"];
            $alto= $_POST["alto"];
            $traz_vid = $_POST["traz_vid"];
            if(isset($_POST["traz_vid2"])){$traz_vid2 = $_POST["traz_vid2"];}else{$traz_vid2 = '';}
            if(isset($_POST["traz_vid3"])){$traz_vid3 = $_POST["traz_vid3"];}else{$traz_vid3 = '';}
            if(isset($_POST["traz_vid4"])){$traz_vid4 = $_POST["traz_vid4"];}else{$traz_vid4 = '';}
            $ubicacion= $_POST["ubicacion"];
            $cierre= $_POST["cierre"];
            $precio= $_POST["precio"];
            $pel= $_POST["pel"];
            $precio_mp= $_POST["precio_mp"];
            $duracion = $_POST["duracion"];
            $alum= $_POST["alum"]; $lado= $_POST["lado"]; 
            $laminas= $_POST["laminas"];
            if(isset($_POST["laminas2"])){$laminas2 = $_POST["laminas2"];}else{$laminas2 = '';}
            if(isset($_POST["laminas3"])){$laminas3 = $_POST["laminas3"];}else{$laminas3 = '';}
            if(isset($_POST["laminas4"])){$laminas4 = $_POST["laminas4"];}else{$laminas4 = '';}
            $install= $_POST["install"];
             if(isset($_POST["cuerpo"])){$cuerpo= $_POST["cuerpo"];}else{$cuerpo=0;};
             $hoja= $_POST["hoja"];
             $desc= $_POST["desc"];
             if(isset($_POST["vert"])){$vert= $_POST["vert"];}else{$vert= 0;}
              if(isset($_POST["hori"])){$hori= $_POST["hori"];}else{$hori= 0;}
             $descripcion= $_POST["descripcion"];
               if(isset($_POST["d1"])){$ds= $_POST["d1"];}else{$ds= 0;}
        $altura_v_c = $_POST["alto"] - $_POST["cuerpo"];
            $estado = 'Cotizado';
            if(isset($_POST["vid2"])){$vid2 = $_POST["vid2"];}else{$vid2 = '';}
            if(isset($_POST["vid3"])){$vid3 = $_POST["vid3"];}else{$vid3 = '';}
            if(isset($_POST["vid4"])){$vid4 = $_POST["vid4"];}else{$vid4 = '';}
            if(isset($_POST["vid5"])){$vid5 = $_POST["vid5"];}else{$vid5 = '';}
            if(isset($_POST["vid6"])){$vid6 = $_POST["vid6"];}else{$vid6 = '';}
            if(isset($_POST["vidd2"])){$vidd2 = $_POST["vidd2"];}else{$vidd2 = '';}
            if(isset($_POST["vidd3"])){$vidd3 = $_POST["vidd3"];}else{$vidd3 = '';}
            if(isset($_POST["vidd4"])){$vidd4 = $_POST["vidd4"];}else{$vidd4 = '';}
            if(isset($_POST["vidd5"])){$vidd5 = $_POST["vidd5"];}else{$vidd5 = '';}
            if(isset($_POST["vidd6"])){$vidd6 = $_POST["vidd6"];}else{$vidd6 = '';}
            if(isset($_POST["vidt2"])){$vidt2 = $_POST["vidt2"];}else{$vidt2 = '';}
            if(isset($_POST["vidt3"])){$vidt3 = $_POST["vidt3"];}else{$vidt3 = '';}
            if(isset($_POST["vidt4"])){$vidt4 = $_POST["vidt4"];}else{$vidt4 = '';}
            if(isset($_POST["vidt5"])){$vidt5 = $_POST["vidt5"];}else{$vidt5 = '';}
            if(isset($_POST["vidt6"])){$vidt6 = $_POST["vidt6"];}else{$vidt6 = '';}
            if(isset($_POST["vidc2"])){$vidc2 = $_POST["vidc2"];}else{$vidc2 = '';}
            if(isset($_POST["vidc3"])){$vidc3 = $_POST["vidc3"];}else{$vidc3 = '';}
            if(isset($_POST["vidc4"])){$vidc4 = $_POST["vidc4"];}else{$vidc4 = '';}
            if(isset($_POST["vidc5"])){$vidc5 = $_POST["vidc5"];}else{$vidc5 = '';}
            if(isset($_POST["vidc6"])){$vidc6 = $_POST["vidc6"];}else{$vidc6 = '';}
            if(isset($_POST["cod1"])){$cod1 = $_POST["cod1"];}else{$cod1 = '';}
            if(isset($_POST["cod2"])){$cod2 = $_POST["cod2"];}else{$cod2 = '';}
            if(isset($_POST["cod3"])){$cod3 = $_POST["cod3"];}else{$cod3 = '';}
            if(isset($_POST["cod4"])){$cod4 = $_POST["cod4"];}else{$cod4 = '';}
            if(isset($_POST["cod5"])){$cod5 = $_POST["cod5"];}else{$cod5 = '';}
            if(isset($_POST["cod6"])){$cod6 = $_POST["cod6"];}else{$cod6 = '';}
            if(isset($_POST["cod7"])){$cod7 = $_POST["cod7"];}else{$cod7 = '';}
            if(isset($_POST["cod8"])){$cod8 = $_POST["cod8"];}else{$cod8 = '';}
            if(isset($_POST["cod9"])){$cod9 = $_POST["cod9"];}else{$cod9 = '';}
            if(isset($_POST["cod10"])){$cod10 = $_POST["cod10"];}else{$cod10 = '';}
            if(isset($_POST["cod11"])){$cod11 = $_POST["cod11"];}else{$cod11 = '';}
            if(isset($_POST["cod12"])){$cod12 = $_POST["cod12"];}else{$cod12 = '';}
            if(isset($_POST["cod13"])){$cod13 = $_POST["cod13"];}else{$cod13 = '';}
            if(isset($_POST["cod14"])){$cod14 = $_POST["cod14"];}else{$cod14 = '';}
            if(isset($_POST["per"])){$per = $_POST["per"];}else{$per = '';}
            if(isset($_POST["boq"])){$boq = $_POST["boq"];}else{$boq = '';}
            if(isset($_POST["pelicula"])){$pelicula = $_POST["pelicula"];}else{$pelicula = 0;}
            $area = $cod1.''.$cod2.''.$cod3.''.$cod4.''.$cod5.''.$cod6.''.$cod7.''.$cod8.''.$cod9.''.$cod10.''.$cod11.''.$cod12.''.$cod13.''.$cod14;
$sql='select * from producto where id_p="'.$_POST["ref"].'"';
$fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
$variable= $fil["tipo_vidrio"];
$altura= $_POST["cuerpo"];
$altura_ventana = $_POST["alto"] - $_POST["cuerpo"].'<br>';
$sqlcot='select * from cotizacion where id_cot='.$_GET["cot"].'';
$filc =mysqli_fetch_array(mysqli_query($conexion,$sqlcot));
$instal= $filc["instalacion"];
  // aqui se suma todos los accesorios de la ventana
//echo '<script>alert("ola" '.$pel.');</script>';
include '../modelo/suma.php';

$totalfom = $totalxfom;

$a = $totalx * $variable /100;
$GT = $totalx;

        if(isset($_GET['editar'])){
            $cons = mysqli_fetch_array(mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1"));
            $dol = $cons['id_dolar'];
            $query2= "SELECT descripcion FROM `referencias` where id_referencia in ($pel) ";                     
            $resul2=  mysqli_query($conexion,$query2);
            $d = mysqli_fetch_array($resul2);

            $sql = "UPDATE `cotizaciones_sub` SET `descripcion_rollo`='".$d[0]."', `rollo`='".$pel."',`id_dolar`='".$dol."',`pelicula`='".$pelicula."',`imagen_sub`='".$lado."', "
                    . "`modulo`='".$modulo."',`ancho_abajo`='".$ancho_a."',`ubicacion_c`='".$ubicacion."',`traz_vid`='".$traz_vid."', `traz_vid2`='".$traz_vid2."', `traz_vid3`='".$traz_vid3."', `traz_vid4`='".$traz_vid4."',"
                    . "`tipo_c_sub`='".$tipo_cli."',`laminas`='".$laminas."', `laminas2`='".$laminas2."', `laminas3`='".$laminas3."', `laminas4`='".$laminas4."',`install`='".$install."',"
                    . "`d1`='".$ds."', `duracion`='".$duracion."', `horizontales`='".$hori."',"
                    . " `verticales`='".$vert."',`desc_sub`='".$desc."',"
                    . " `observaciones_sub`='".$descripcion."', `hojas_sub`='".$hoja."',"
                    . " `cuerpo_sub`='".$cuerpo."', `color_ta_sub`='".$alum."', `porcentaje_sub`='".$precio."', "
                    . "`porcentaje_mp_sub`='".$precio_mp."', `valor_fom_sub`='".$totalfom."', `valor_c_sub`='".$GT."'"
                    . ", `valor_sp`='".$totalx_sinp."', `valor_fom_sp`='".$totalxfom_sinp."',`cod_traz_sub`='".$area."', "
                    . "`linea_cot_sub`='".$linea."', `id_referencia_sub`='".$ref."',`cierre_sub`='".$cierre."',"
                    . "`id_vidrio_sub`='".$vid."',`id_vidrio_sub2`='".$vid2."',`id_vidrio_sub3`='".$vid3."',`id_vidrio_sub4`='".$vid4."',`id_vidrio_sub5`='".$vid5."',`id_vidrio_sub6`='".$vid6."',"
                      . "`id2_vidrio`='".$vidd."',`id2_vidrio2`='".$vidd2."',`id2_vidrio3`='".$vidd3."',`id2_vidrio4`='".$vidd4."',`id2_vidrio5`='".$vidd5."',"
                          . "`id3_vidrio`='".$vidt."',`id3_vidrio2`='".$vidt2."',`id3_vidrio3`='".$vidt3."',`id3_vidrio4`='".$vidt4."',`id3_vidrio5`='".$vidt5."',"
                          . "`id4_vidrio`='".$vidc."',`id4_vidrio2`='".$vidc2."',`id4_vidrio3`='".$vidc3."',`id4_vidrio4`='".$vidc4."',`id4_vidrio5`='".$vidc5."',"
                    . "`ancho_c_sub`='".$ancho."',`alto_c_sub`='".$alto."',`cantidad_c_sub`='".$cantidad."' WHERE `id_cotizacion_sub` = ".$_GET["editar"].";";
                 mysqli_query($conexion,$sql);
                 
                             
            
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c  where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['mas']."");
     
if($request){
        $ta2 =0;$ta3 =0;
        $cont =0;
	while($row=mysqli_fetch_array($request))
	{
           
                        $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
                    $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                    $mult2= $fi3["p"]/100;
                    $PB = $row["linea_cot_sub"].' Bogota';
                    $s33 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$PB."'";
                    $fi33 =mysqli_fetch_array(mysqli_query($conexion,$s33));
                    $mult3= $fi33["p"]/100;
                    $cont = $cont + 1;
                    $suma2 = $row["valor_c_sub"];
                    $suma3 = $row["valor_fom_sub"];
              $a = $suma2 / $mult2;
              $a3 = $suma3;
      
            $ta2 = $ta2 + $a;
            $ta3 = $ta3 + $a3;
      
//            $pu = ($b)/$row["cantidad_c_sub"];     
	} 
} 

$sql3 = "UPDATE `cotizaciones` SET `precio_adicional`='".$ta2."',`valor_costob`='".$ta3."'  WHERE `id_cotizacion` = ".$_GET["mas"].";";
                 mysqli_query($conexion,$sql3);
            $status = "ok";
            
                  echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la cotizacion");location.href="../vistas/?id=add_acc&cot='.$cot.'&cli='.$cliente.'&por='.$_GET['por'].'&mas='.$_GET['mas'].'&pagina='.$_GET['pagina'].'&tipo_cli='.$_GET['tipo_cli'].'"</script>'; 
       
        }else{
            $cons = mysqli_fetch_array(mysqli_query($conexion,"select * from dolares order by id_dolar desc limit 1"));
            $dol = $cons['id_dolar'];
          $query2= "SELECT descripcion FROM `referencias` where id_referencia in ($pel) ";                     
          $resul2=  mysqli_query($conexion,$query2);
          $d = mysqli_fetch_array($resul2);
                  

           $sql = "INSERT INTO `cotizaciones_sub` (`descripcion_rollo`,`rollo`,`id_dolar`,`pelicula`, `valor_sp`,`valor_fom_sp`,`valor_fom_sub`, `modulo`,`imagen_sub`, `ancho_abajo`, `ubicacion_c`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `tipo_c_sub`, `install`, `horizontales`,`verticales`,`desc_sub`, `observaciones_sub`, `hojas_sub`, `cuerpo_sub`, `color_ta_sub`, `porcentaje_sub`, `porcentaje_mp_sub`, `per_sub`, `boq_sub`, `cod_traz_sub`, `linea_cot_sub`, `id_cot_sub`, `cierre_sub`, `id_referencia_sub`, `id_vidrio_sub`, `id_vidrio_sub2`, `id_vidrio_sub3`, `id_vidrio_sub4`, `id_vidrio_sub5`, `id_vidrio_sub6`, `ancho_c_sub`, `alto_c_sub`, `valor_c_sub`, `cantidad_c_sub`, `cant_restante`, `id_cliente_sub`, `estado_c_sub`, `registrado_por_c_sub`, `id_producto_cot`, `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
           $sql.= "VALUES ('".$d[0]."','".$pel."','".$dol."','".$pelicula."','".$totalx_sinp."','".$totalxfom_sinp."','".$totalfom."', '".$modulo."', '".$lado."', '".$ancho_a."', '".$ubicacion."', '".$traz_vid."', '".$traz_vid2."', '".$traz_vid3."', '".$traz_vid4."', '".$laminas."', '".$laminas2."', '".$laminas3."', '".$laminas4."', '".$tipo_cli."', '".$install."','".$hori."', '".$vert."','".$desc."', '".$descripcion."', '".$hoja."', '".$cuerpo."', '".$alum."', '".$precio."', '".$precio_mp."', '".$per."', '".$boq."','".$area."', '".$linea."', '".$cot."', '".$cierre."', '".$ref."', '".$vid."', '".$vid2."', '".$vid3."', '".$vid4."', '".$vid5."', '".$vid6."', '".$ancho."', '".$alto."',  '".$GT."',  '".$cantidad."',  '".$cantidad."', '".$cliente."', '".$estado."', '".$_SESSION['k_username']."', '".$_GET['mas']."', '".$ds."', '".$vidd."', '".$vidd2."', '".$vidd3."', '".$vidd4."', '".$vidd5."', '".$vidt."', '".$vidt2."', '".$vidt3."', '".$vidt4."', '".$vidt5."', '".$vidc."', '".$vidc2."', '".$vidc3."', '".$vidc4."', '".$vidc5."')";
            mysqli_query($conexion,$sql);
            
            
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['mas']."");
     
if($request){
        $ta2 =0;$ta3 =0;
        $cont =0;
	while($row=mysqli_fetch_array($request))
	{
           
                        $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
                $PB = $row["linea_cot_sub"].' Bogota';
                   $s33 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$PB."'";
                $fi33 =mysqli_fetch_array(mysqli_query($conexion,$s33));
                $mult3= $fi33["p"]/100;
                
            $cont = $cont + 1;
                    $suma2 = $row["valor_c_sub"];
                    $suma3 = $row["valor_fom_sub"];
            $a = $suma2 / $mult2;
              $a3 = $suma3 / $mult3;
      
            $ta2 = $ta2 + $a;
            $ta3 = $ta3 + $a3;
//            $pu = ($b)/$row["cantidad_c_sub"];     
	} 
} 
//echo 'suma de los '.$ta2;
$sql3 = "UPDATE `cotizaciones` SET `precio_adicional`='".$ta2."',`valor_costob`='".$ta3."'  WHERE `id_cotizacion` = ".$_GET["mas"].";";
                 mysqli_query($conexion,$sql3);
            $status = "ok";
            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la cotizacion");location.href="../vistas/?id=add_acc&cot='.$cot.'&cli='.$cliente.'&por='.$_GET['por'].'&mas='.$_GET['mas'].'&pagina='.$_GET['pagina'].'&tipo_cli='.$_GET['tipo_cli'].'"</script>'; 
        }
	
      
       
    
  
