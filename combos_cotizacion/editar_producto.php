<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
     $id_cotizacion = $_POST['idcoti'] = $_GET["idcoti"];
    
    $pagina = $_GET["pagina"];
    $adicional = $_GET["adicional"];
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
     $aa = $ancho_a = $_POST["anchoabajo"]= $_POST["ancho_abajo"] = $_POST['anchoabajo'] = $_GET["anchoabajo"];
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
    $vid2 = $_POST["vid2"] = $_POST["valor4"] = $_POST['valor4'] = $_GET["valor4"];
    if(isset($_GET["valor6"])){$vid3 = $_POST["vid3"] = $_POST["valor6"] = $_POST['valor6'] = $_GET["valor6"];}else{$vid3 = '';}
    if(isset($_GET["valor8"])){$vid4 = $_POST["vid4"] = $_POST["valor8"] = $_POST['valor8'] = $_GET["valor8"];}else{$vid4 = '';}
    if(isset($_GET["valor10"])){$vid5 = $_POST["vid5"] = $_POST["valor10"] = $_POST['valor10'] = $_GET["valor10"];}else{$vid5 = '';}
    if(isset($_GET["valor12"])){$vid6 = $_POST["vid6"] = $_POST["valor12"] = $_POST['valor12'] = $_GET["valor12"];}else{$vid6 = '';}
    if(isset($_GET["valor24"])){$vidd2 = $_POST["vidd2"] = $_POST["valor24"] = $_POST['valor24'] = $_GET["valor24"];}else{$vidd2 = '';}
    if(isset($_GET["valor26"])){$vidd3 = $_POST["vidd3"] = $_POST["valor26"] = $_POST['valor26'] = $_GET["valor26"];}else{$vidd3 = '';}
    if(isset($_GET["valor28"])){$vidd4  = $_POST["vidd4"]= $_POST["valor28"] = $_POST['valor28'] = $_GET["valor28"];}else{$vidd4 = '';}
    if(isset($_GET["valor210"])){$vidd5 = $_POST["vidd5"] = $_POST["valor210"] = $_POST['valor210'] = $_GET["valor210"];}else{$vidd5 = '';}
    if(isset($_GET["valor212"])){$vidd6 = $_POST["vidd6"] = $_POST["valor212"] = $_POST['valor212'] = $_GET["valor212"];}else{$vidd6 = '';}
    if(isset($_GET["valor34"])){$vidt2  = $_POST["vidt2"]= $_POST["valor34"] = $_POST['valor34'] = $_GET["valor34"];}else{$vidt2 = '';}
    if(isset($_GET["valor36"])){$vidt3  = $_POST["vidt3"]= $_POST["valor36"] = $_POST['valor36'] = $_GET["valor36"];}else{$vidt3 = '';}
    if(isset($_GET["valor38"])){$vidt4  = $_POST["vidt4"]= $_POST["valor38"] = $_POST['valor38'] = $_GET["valor38"];}else{$vidt4 = '';}
    if(isset($_GET["valor310"])){$vidt5  = $_POST["vidt5"]= $_POST["valor310"] = $_POST['valor310'] = $_GET["valor310"];}else{$vidt5 = '';}
    if(isset($_GET["valor312"])){$vidt6  = $_POST["vidt6"]= $_POST["valor312"] = $_POST['valor312'] = $_GET["valor312"];}else{$vidt6 = '';}
    if(isset($_GET["valor44"])){$vidc2  = $_POST["vidc2"]= $_POST["valor44"] = $_POST['valor44'] = $_GET["valor44"];}else{$vidc2 = '';}
    if(isset($_GET["valor46"])){$vidc3  = $_POST["vidc3"]= $_POST["valor46"] = $_POST['valor46'] = $_GET["valor46"];}else{$vidc3 = '';}
    if(isset($_GET["valor48"])){$vidc4  = $_POST["vidc4"]= $_POST["valor48"] = $_POST['valor48'] = $_GET["valor48"];}else{$vidc4 = '';}
    if(isset($_GET["valor410"])){$vidc5  = $_POST["vidc5"]= $_POST["valor410"] = $_POST['valor410'] = $_GET["valor410"];}else{$vidc5 = '';}
    if(isset($_GET["valor412"])){$vidc6  = $_POST["vidc6"]= $_POST["valor412"] = $_POST['valor412'] = $_GET["valor412"];}else{$vidc6 = '';}
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
$altura_ventana = $alto - $cuerpo;
$anchura= $ladomm;
$anchura_ventana = $ancho - $ladomm;
$instal= $install;

// aqui se suma todos los accesorios de la ventana
if($linea=='VIDRIO'){
//    include '../modelo/suma_vidrios.php';
    include '../modelo/suma.php';
    $total = $totalx ;
     $totalfom = $totalxfom;
       $totalfom_sinp = $totalxfom_sinp;
}else{
  include '../modelo/suma.php';
  $total = $totalx;
  $totalfom = $totalxfom;
  $totalfom_sinp = $totalxfom_sinp;
}
//echo $totalxfom_sinp;

        $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99";
        $fila21 =mysqli_fetch_array(mysqli_query($conexion,$sql21));
        $request_ac1=mysqli_query($conexion,"SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$fila21["id_ref_mo"]);
        $tota3=0;
        if($request_ac1){
            while($row1=mysqli_fetch_array($request_ac1))
            {       
                $por = 100;
                $tota3 = $tota3 + ($fila21["valor_mo"]*$row1["porcentaje_ad"]/$por);     
            }  
        }
            $pr = (100 - $fila21["utilidad"]) / 100;
            $fr = (($fila21["valor_mo"] + $tota3) / $pr)*$cantidad;
            $mtr = ($alto/1000)*($ancho/1000);
         
            if($pelicula=='No Aplica'){
                $GT = $total;
          
            }else{
                if($pelicula=='Una Cara'){
                 
                      $tpel = $fr * $mtr;
                $GT = $total;
         
            }else{
                  $tpel = $fr * ($mtr*2);
                  $GT = $total ;

            }
            }
        $res = 'select * from cotizaciones a, producto b  where a.id_referencia=b.id_p and a.id_cotizacion='.$id_cotizacion.' ';
        $f =mysqli_fetch_array(mysqli_query($conexion,$res));
        $a = $f['producto'];

        if($f['ancho_c'] != $ancho || $f['alto_c'] != $alto){
            $me = 'Se cambiaron las medidas de:'.$f['ancho_c'].'x'.$f['alto_c'].', por '.$ancho.'x'.$alto.',';
        }else{
            $me = '';
        }
        if($f['cantidad_c'] != $cantidad){
            $ca = 'Se cambiaron las cantidades de:'.$f['cantidad_c'].', por '.$cantidad;
        }else{
            $ca = '';
        }

        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
        $sqlr.= "VALUES ('Se Modifico el producto ".$a.", Detalles: ".$me." ".$ca." ', '".$cotizacion."', '".$_SESSION['k_username']."', 'Cotizacion')";
        mysqli_query($conexion,$sqlr);

                  $sql = "UPDATE `cotizaciones` SET `imagen_mas`='".$adicional."',`lado`='".$anchura."', `id_dolar`='".$dolar."',`ancho_temp`='".$ancho_temp."',`alto_temp`='".$alto_temp."',`pelicula`='".$pelicula."',`modulo`='".$modulo."', `imagen`='".$lado."',"
                          . " `tip`='".$tip."', `per`='".$per."', `boq`='".$boq."', `ancho_abajo`='".$ancho_a."',"
                          . " `ubicacion_c`='".$ubicacion."', `traz_vid`='".$traz_vid."', `traz_vid2`='".$traz_vid2."', `traz_vid3`='".$traz_vid3."', `traz_vid4`='".$traz_vid4."',"
                          . " `laminas`='".$laminas."', `laminas2`='".$laminas2."', `laminas3`='".$laminas3."', `laminas4`='".$laminas4."',"
                          . "`install`='".$install."',`d1`='".$ds."', `duracion`='".$duracion."', `horizontales`='".$hori."',"
                          . " `verticales`='".$vert."',`desc`='".$desc."', `observaciones`='".$descripcion."', `observaciones2`='".$obs2."',"
                          . " `hojas`='".$hoja."', `cuerpo`='".$cuerpo."', `color_ta`='".$alum."', `porcentaje`='".$precio."',"
                          . " `porcentaje_mp`='".$precio_mp."', `valor_c`='".$GT."',`valor_c_sp`='".$totalx_sinp."', `valor_fom`='".$totalxfom."',`valor_fomp`='".$totalxfom_sinp."',`cod_traz`='".$area."',"
                          . " `linea_cot`='".$linea."', `id_referencia`='".$ref."',`cierre`='".$cierre."',"
                          . "`id_vidrio`='".$vid."',`id_vidrio2`='".$vid2."',`id_vidrio3`='".$vid3."',`id_vidrio4`='".$vid4."',`id_vidrio5`='".$vid5."',`id_vidrio6`='".$vid6."',"
                          . "`id2_vidrio`='".$vidd."',`id2_vidrio2`='".$vidd2."',`id2_vidrio3`='".$vidd3."',`id2_vidrio4`='".$vidd4."',`id2_vidrio5`='".$vidd5."',"
                          . "`id3_vidrio`='".$vidt."',`id3_vidrio2`='".$vidt2."',`id3_vidrio3`='".$vidt3."',`id3_vidrio4`='".$vidt4."',`id3_vidrio5`='".$vidt5."',"
                          . "`id4_vidrio`='".$vidc."',`id4_vidrio2`='".$vidc2."',`id4_vidrio3`='".$vidc3."',`id4_vidrio4`='".$vidc4."',`id4_vidrio5`='".$vidc5."',"
                          . "`ancho_c`='".$ancho."',`alto_c`='".$alto."',`cantidad_c`='".$cantidad."',`cant_restante`='".$cantidad."' WHERE `id_cotizacion` = ".$id_cotizacion.";";
        mysqli_query($conexion,$sql);
        $sql2 = "UPDATE `cotizacion` SET precio='px' WHERE `id_cot` = ".$cotizacion."";
        mysqli_query($conexion,$sql2);
        
           

        $sql = "UPDATE  `cotizacion` SET `fecha_modificacion` = '".$fecha_hoy."' WHERE `id_cot` = '".$cotizacion."'";
        mysqli_query($conexion,$sql);

    $clases->mostrarItems5($cotizacion,$cliente,$pagina); 
    
    
    
?>

