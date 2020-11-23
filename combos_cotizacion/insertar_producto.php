<?php
    include '../clases/clases.php'; 
    $clases = new general;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';

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
    $per = $_POST["per"] = $_POST['per'] = $_GET["per"];
    $boq = $_POST["boq"] = $_POST['boq'] = $_GET["boq"];
    $imagen = $_GET["serie"];
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
            
            $sql = "INSERT INTO `cotizaciones` (`imagen_mas`,`an`,`al`,`lado`, `id_dolar`, `valor_c_sp`, `valor_fomp`, `ancho_temp`, `alto_temp`, `pelicula`, `valor_fom`, `modulo`,  `tip`,`imagen`, `ancho_abajo`, `ubicacion_c`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `install`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`, `duracion`, `horizontales`,`verticales`,`desc`, `observaciones`, `observaciones2`, `hojas`, `cuerpo`, `color_ta`, `porcentaje`, `porcentaje_mp`, `per`, `boq`, `cod_traz`, `linea_cot`, `id_cot`, `cierre`, `id_referencia`, `id_vidrio`, `ancho_c`, `alto_c`, `valor_c`, `cant_restante`, `cantidad_c`, `id_cliente`, `estado_c`, `registrado_por_c` , `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
            $sql.= "VALUES ('".$imagen."','100','100', '".$anchura."', "
                    . "'".$dolar."', "
                    . "'".$totalx_sinp."', "
                    . "'".$totalxfom_sinp."', "
                    . "'".$ancho_temp."', "
                    . "'".$alto_temp."', "
                    . "'".$pelicula."', "
                    . "'".$totalxfom."', "
                    . "'".$modulo."', "
                    . "'".$tip."',"
                    . "'".$lado."', "
                    . "'".$aa."', "
                    . "'".$ubicacion."', "
                    . "'".$traz_vid."', "
                    . "'".$traz_vid2."', "
                    . "'".$traz_vid3."', "
                    . "'".$traz_vid4."', "
                    . "'".$laminas."', "
                    . "'".$laminas2."', "
                    . "'".$laminas3."', "
                    . "'".$laminas4."', "
                    . "'".$install."', "
                    . "'".$vid2."', "
                    . "'".$vid3."', "
                    . "'".$vid4."', "
                    . "'".$vid5."', "
                    . "'".$vid6."', "
                    . "'".$duracion."', "
                    . "'".$hori."', "
                    . "'".$vert."',"
                    . "'".$desc."', "
                    . "'".$descripcion."', "
                    . "'".$obs2."', "
                    . "'".$hoja."', "
                    . "'".$cuerpo."', "
                    . "'".$alum."', "
                    . "'".$precio."', "
                    . "'".$precio_mp."', "
                    . "'".$per."', "
                    . "'".$boq."',"
                    . "'".$area."', "
                    . "'".$linea."', "
                    . "'".$cotizacion."', "
                    . "'".$cierre."', "
                    . "'".$ref."', "
                    . "'".$vid."', "
                    . "'".$ancho."', "
                    . "'".$alto."',  "
                    . "'".$GT."',  "
                    . "'".$cantidad."',  "
                    . "'".$cantidad."', "
                    . "'".$cliente."', "
                    . "'".$estado."', "
                    . "'".$_SESSION['k_username']."', "
                    . "'".$ds."', "
                    . "'".$vidd."', "
                    . "'".$vidd2."', "
                    . "'".$vidd3."', "
                    . "'".$vidd4."', "
                    . "'".$vidd5."', "
                    . "'".$vidt."',"
                    . "'".$vidt2."', "
                    . "'".$vidt3."', "
                    . "'".$vidt4."', "
                    . "'".$vidt5."', "
                    . "'".$vidc."', "
                    . "'".$vidc2."', "
                    . "'".$vidc3."', "
                    . "'".$vidc4."', "
                    . "'".$vidc5."')";
            mysqli_query($conexion,$sql);
      
            $sql = "UPDATE  `cotizacion` SET `fecha_modificacion` = '".$fecha_hoy."' WHERE `id_cot` = '".$cotizacion."'";
                  mysqli_query($conexion,$sql);
                  
            $sqx='select max(id_cotizacion) from cotizaciones';
            $filx =mysqli_fetch_array(mysqli_query($conexion,$sqx));
            $id_cotizacion= $filx["max(id_cotizacion)"];
            
            $request_acx=mysqli_query($conexion,"SELECT * FROM producto a, compuestos b where a.id_p=b.id_prod_comp and b.id_prod=".$ref." ");
            while($row=mysqli_fetch_array($request_acx))
	   {   
                
            $sqls = "INSERT INTO `cotizaciones_sub` (`ancho_abajo`, `ubicacion_c`, `traz_vid`, `laminas`, `tipo_c_sub`, `install`, `horizontales`,`verticales`,`desc_sub`, `observaciones_sub`, `hojas_sub`, `cuerpo_sub`, `color_ta_sub`, `porcentaje_sub`, `porcentaje_mp_sub`, `per_sub`, `boq_sub`, `cod_traz_sub`, `linea_cot_sub`, `id_cot_sub`, `cierre_sub`, `id_referencia_sub`, `id_vidrio_sub`, `id_vidrio_sub2`, `id_vidrio_sub3`, `id_vidrio_sub4`, `id_vidrio_sub5`, `id_vidrio_sub6`, `ancho_c_sub`, `alto_c_sub`, `valor_c_sub`, `cantidad_c_sub`, `cant_restante`, `id_cliente_sub`, `estado_c_sub`, `registrado_por_c_sub`, `id_producto_cot`, `d1`)";
            $sqls.= "VALUES ( '1', '".$ubicacion."', '".$traz_vid."', '".$laminas."', '".$tipo_cli."', '".$install."','0', '0','".$desc."', '".$descripcion."', '1', '1', '".$alum."', '".$precio."', '".$precio_mp."', '".$per."', '".$boq."','".$area."', '".$linea."', '".$cot."', '".$cierre."', '".$row['id_prod_comp']."', '".$vid."', '".$vid2."', '".$vid3."', '".$vid4."', '".$vid5."', '".$vid6."', '1', '1',  '0',  '1',  '1', '".$cliente."', '".$estado."', '".$_SESSION['k_username']."', '".$cotizacion."', '".$ds."')";
            mysqli_query($conexion,$sqls);
           
            
           } 
            $status = "ok";
            
    $clases->mostrarItems5($cotizacion,$cliente); 
?>