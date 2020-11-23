<?php
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $por = $_POST['por'] = $_GET["por"];
    $pagina = $_POST['pagina'] = $_GET["pagina"];
    $mas = $_POST['mas'] = $_GET["mas"];
    $id_cotizacion = $_POST['idcoti'] = $_GET["idcoti"];
    $cotizacion = $_POST["cotizacion"] = $_POST['cotizacion'] = $_GET["cotizacion"];
    $cliente = $_POST["cliente"] = $_POST['cliente'] = $_GET["cliente"];
    $linea = $_POST["linea"] = $_POST['linea'] = $_GET["linea"];
    $ladomm = $_POST["ladomm"] = $_POST['ladomm'] = $_GET["ladomm"];
    $dolar = $_POST["dolar"] = $_POST['dolar'] = $_GET["dolar"];
    $tip = $_POST["tip"] = $_POST['tip'] = $_GET["tip"];
    $ref = $_POST["ref"] = $_POST['ref'] = $_GET["codig"];
    $vid = $_POST["vid"] = $_POST['valor2'] = $_GET["valor2"];
    if(isset($_GET["valor22"])){$vidd = $_POST["valor22"] = $_POST['valor22'] = $_GET["valor22"];}else{$vidd = '';}
    if(isset($_GET["valor32"])){$vidt = $_POST["valor32"] = $_POST['valor32'] = $_GET["valor32"];}else{$vidt = '';}
    if(isset($_GET["valor42"])){$vidc = $_POST["valor42"] = $_POST['valor42'] = $_GET["valor42"];}else{$vidc = '';}
    $cantidad = $_POST["cant"] = $_POST['cant'] = $_GET["cant"];
    $ancho = $_POST["ancho"] = $_POST['ancho'] = $_GET["ancho"];
    $modulo= 0;
    $aa = $_POST["anchoabajo"] = $_POST['anchoabajo'] = $_GET["anchoabajo"];
    $alto = $_POST["alto"] = $_POST['alto'] = $_GET["alto"];
    $alto_temp = $_POST["altotemp"] = $_POST['altotemp'] = $_GET["altotemp"];
    $ancho_temp = $_POST["anchotemp"] = $_POST['anchotemp'] = $_GET["anchotemp"];
    $traz_vid = $_POST["valo1"] = $_POST['valo1'] = $_GET["valo1"];
    if(isset($_GET["valo3"])){$traz_vid2 = $_POST["valo3"] = $_POST['valo3'] = $_GET["valo3"];}else{$traz_vid2 = '';}
    if(isset($_GET["valo5"])){$traz_vid3 = $_POST["valo5"] = $_POST['valo5'] = $_GET["valo5"];}else{$traz_vid3 = '';}
    if(isset($_GET["valo7"])){$traz_vid4 = $_POST["valo7"] = $_POST['valo7'] = $_GET["valo7"];}else{$traz_vid4 = '';}
    $ubicacion = $_POST["ubicacion"] = $_POST['ubicacion'] = $_GET["ubicacion"];
    $cierre = $_POST["cierre"] = $_POST['cierre'] = $_GET["cierre"];
    $alum = $_POST["alum"] = $_POST['alum'] = $_GET["alum"]; 
    $precio = $_POST["precio"] = $_POST['precio'] = $_GET["precio"];
    $precio_mp = $_POST["preciomp"] = $_POST['preciomp'] = $_GET["preciomp"];
    $duracion = $_POST["duracion"] = $_POST['duracion'] = $_GET["duracion"];
    $lado = $_POST["lado"] = $_POST['lado'] = $_GET["lado"]; 
    $laminas = $_POST["lamina"] = $_POST['lamina'] = $_GET["lamina"];
    if(isset($_GET["lamina2"])){$laminas2 = $_POST["lamina2"] = $_POST['lamina2'] = $_GET["lamina2"];}else{$laminas2 = '';}
    if(isset($_GET["lamina3"])){$laminas3 = $_POST["lamina3"] = $_POST['lamina3'] = $_GET["lamina3"];}else{$laminas3 = '';}
    if(isset($_GET["lamina4"])){$laminas4 = $_POST["lamina4"] = $_POST['lamina4'] = $_GET["lamina4"];}else{$laminas4 = '';}
    $install = $_POST["install"] = $_POST['install'] = $_GET["install"];
    if(isset($_GET["cuerpo"])){$cuerpo = $_POST["cuerpo"] = $_POST['cuerpo'] = $_GET["cuerpo"];}else{$cuerpo=0;};
    $hoja = $_POST["hoja"] = $_POST['hoja'] = $_GET["hoja"];
    $desc = $_POST["desc"] = $_POST['desc'] = $_GET["desc"];
    if(isset($_GET["vert"])){$vert = $_POST["vert"] = $_POST['vert'] = $_GET["vert"];}else{$vert= 0;}
    if(isset($_GET["hori"])){$hori = $_POST["hori"] = $_POST['hori'] = $_GET["hori"];}else{$hori= 0;}
    $descripcion = $_POST["descripcion"] = $_POST['descripcion'] = $_GET["descripcion"];
    $obs2 = $_POST["obs2"] = $_POST['obs2'] = $_GET["obs2"];
    if($_GET["d1"]=='true'){$ds = $_POST["d1"] = $_POST['d1'] = 1;}else{$ds= $_POST["d1"] = $_POST['d1'] =0;}
    $altura_v_c = $_POST["alto"] = $_POST['alto'] = $_GET["alto"] - $cuerpo;
    $estado = 'Cotizado';
    $pelicula = $_POST["pelicula"] = $_POST['pelicula'] = $_GET['pelicula'];
    if(isset($_GET["valor4"])){$vid2 = $_POST["valor4"] = $_POST['valor4'] = $_GET["valor4"];}else{$vid2 = '';}
    if(isset($_GET["valor6"])){$vid3 = $_POST["valor6"] = $_POST['valor6'] = $_GET["valor6"];}else{$vid3 = '';}
    if(isset($_GET["valor8"])){$vid4 = $_POST["valor8"] = $_POST['valor8'] = $_GET["valor8"];}else{$vid4 = '';}
    if(isset($_GET["valor10"])){$vid5 = $_POST["valor10"] = $_POST['valor10'] = $_GET["valor10"];}else{$vid5 = '';}
    if(isset($_GET["valor12"])){$vid6 = $_POST["valor12"] = $_POST['valor12'] = $_GET["valor12"];}else{$vid6 = '';}
    if(isset($_GET["valor24"])){$vidd2 = $_POST["valor24"] = $_POST['valor24'] = $_GET["valor24"];}else{$vidd2 = '';}
    if(isset($_GET["valor26"])){$vidd3 = $_POST["valor26"] = $_POST['valor26'] = $_GET["valor26"];}else{$vidd3 = '';}
    if(isset($_GET["valor28"])){$vidd4 = $_POST["valor28"] = $_POST['valor28'] = $_GET["valor28"];}else{$vidd4 = '';}
    if(isset($_GET["valor210"])){$vidd5 = $_POST["valor210"] = $_POST['valor210'] = $_GET["valor210"];}else{$vidd5 = '';}
    if(isset($_GET["valor212"])){$vidd6 = $_POST["valor212"] = $_POST['valor212'] = $_GET["valor212"];}else{$vidd6 = '';}
    if(isset($_GET["valor34"])){$vidt2 = $_POST["valor34"] = $_POST['valor34'] = $_GET["valor34"];}else{$vidt2 = '';}
    if(isset($_GET["valor36"])){$vidt3 = $_POST["valor36"] = $_POST['valor36'] = $_GET["valor36"];}else{$vidt3 = '';}
    if(isset($_GET["valor38"])){$vidt4 = $_POST["valor38"] = $_POST['valor38'] = $_GET["valor38"];}else{$vidt4 = '';}
    if(isset($_GET["valor310"])){$vidt5 = $_POST["valor310"] = $_POST['valor310'] = $_GET["valor310"];}else{$vidt5 = '';}
    if(isset($_GET["valor312"])){$vidt6 = $_POST["valor312"] = $_POST['valor312'] = $_GET["valor312"];}else{$vidt6 = '';}
    if(isset($_GET["valor44"])){$vidc2 = $_POST["valor44"] = $_POST['valor44'] = $_GET["valor44"];}else{$vidc2 = '';}
    if(isset($_GET["valor46"])){$vidc3 = $_POST["valor46"] = $_POST['valor46'] = $_GET["valor46"];}else{$vidc3 = '';}
    if(isset($_GET["valor48"])){$vidc4 = $_POST["valor48"] = $_POST['valor48'] = $_GET["valor48"];}else{$vidc4 = '';}
    if(isset($_GET["valor410"])){$vidc5 = $_POST["valor410"] = $_POST['valor410'] = $_GET["valor410"];}else{$vidc5 = '';}
    if(isset($_GET["valor412"])){$vidc6 = $_POST["valor412"] = $_POST['valor412'] = $_GET["valor412"];}else{$vidc6 = '';}
    if(isset($_GET["cod1"])){$cod1 = $_POST['cod1'] = $_GET["cod1"];}else{$cod1 = '';}
    if(isset($_GET["cod2"])){$cod2 = $_POST['cod2'] = $_GET["cod2"];}else{$cod2 = '';}
    if(isset($_GET["cod3"])){$cod3 = $_POST['cod3'] = $_GET["cod3"];}else{$cod3 = '';}
    if(isset($_GET["cod4"])){$cod4 = $_POST['cod4'] = $_GET["cod4"];}else{$cod4 = '';}
    if(isset($_GET["cod5"])){$cod5 = $_POST['cod5'] = $_GET["cod5"];}else{$cod5 = '';}
    if(isset($_GET["cod6"])){$cod6 = $_POST['cod6'] = $_GET["cod6"];}else{$cod6 = '';}
    if(isset($_GET["cod7"])){$cod7 = $_POST['cod7'] = $_GET["cod7"];}else{$cod7 = '';}
    if(isset($_GET["cod8"])){$cod8 = $_POST['cod8'] = $_GET["cod8"];}else{$cod8 = '';}
    if(isset($_GET["cod9"])){$cod9 = $_POST['cod9'] = $_GET["cod9"];}else{$cod9 = '';}
    if(isset($_GET["cod10"])){$cod10 = $_POST['cod10'] = $_GET["cod10"];}else{$cod10 = '';}
    if(isset($_GET["cod11"])){$cod11 = $_POST['cod11'] = $_GET["cod11"];}else{$cod11 = '';}
    if(isset($_GET["cod12"])){$cod12 = $_POST['cod12'] = $_GET["cod12"];}else{$cod12 = '';}
    if(isset($_GET["cod13"])){$cod13 = $_POST['cod13'] = $_GET["cod13"];}else{$cod13 = '';}
    if(isset($_GET["cod14"])){$cod14 = $_POST['cod14'] = $_GET["cod14"];}else{$cod14 = '';}
    if(isset($_GET["per"])){$per = $_POST["per"] = $_POST['per'] = $_GET["per"];}else{$per = '';}
    if(isset($_GET["boq"])){$boq = $_POST["boq"] = $_POST['boq'] = $_GET["boq"];}else{$boq = '';}
    $area = $cod1.''.$cod2.''.$cod3.''.$cod4.''.$cod5.''.$cod6.''.$cod7.''.$cod8.''.$cod9.''.$cod10.''.$cod11.''.$cod12.''.$cod13.''.$cod14;

    $sql='select * from producto where id_p="'.$ref.'"';
    $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
    $variable= $fil["tipo_vidrio"];
    $altura= $cuerpo;
    $altura_ventana = $alto - $cuerpo.'<br>';
    $sqlcot='select * from cotizacion where id_cot='.$cotizacion.'';
    $filc =mysqli_fetch_array(mysqli_query($conexion,$sqlcot));
    $instal= $filc["instalacion"];
      // aqui se suma todos los accesorios de la ventana

    include '../modelo/suma.php';

    $totalfom = $totalxfom;

    $a = $totalx * $variable /100;
    $GT = $totalx;

 $sql = "UPDATE `cotizaciones_sub` SET `pelicula`='".$pelicula."',`imagen_sub`='".$lado."', "
                    . "`modulo`='".$modulo."',`ancho_abajo`='".$aa."',`ubicacion_c`='".$ubicacion."',`traz_vid`='".$traz_vid."', `traz_vid2`='".$traz_vid2."', `traz_vid3`='".$traz_vid3."', `traz_vid4`='".$traz_vid4."',"
                    . "`laminas`='".$laminas."', `laminas2`='".$laminas2."', `laminas3`='".$laminas3."', `laminas4`='".$laminas4."',`install`='".$install."',"
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
                    . "`ancho_c_sub`='".$ancho."',`alto_c_sub`='".$alto."',`cantidad_c_sub`='".$cantidad."' WHERE `id_cotizacion_sub` = ".$id_cotizacion.";";
                 mysqli_query($conexion,$sql);
                 
                             
            
$request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c  where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$cotizacion." and c.id_producto_cot=".$mas."");   
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

$sql3 = "UPDATE `cotizaciones` SET `precio_adicional`='".$ta2."',`valor_costob`='".$ta3."'  WHERE `id_cotizacion` = ".$mas.";";
                 mysqli_query($conexion,$sql3);
            $status = "ok";

    $clases->mostrarItems($cotizacion,$cliente,$mas,$por,$pagina); 
    
    
    
?>

