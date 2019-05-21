<?php
session_start();
require("conexion.php");

//consulta de la cotizacion original
        $sql6 = "SELECT * FROM cotizacion where id_cot=".$_GET['cod']." ";
        $fila7 =mysql_fetch_array(mysql_query($sql6));
        $numero_cot= $fila7["numero_cotizacion"];

        $sql6 = "SELECT max(numero_cotizacion) FROM cotizacion";
        $fila6 =mysql_fetch_array(mysql_query($sql6));
        $numero_cotizacion= $fila6["max(numero_cotizacion)"]+1;

        $s = "SELECT * FROM cotizacion where id_cot=".$_GET['cod']." ";
        $cot =mysql_fetch_array(mysql_query($s));
        
        
        
        $sql = "INSERT INTO `cotizacion` (`sel_iva`, `cod_temp`,`nom_temp`, `fecha_reg_c`, `fecha_modificacion`, `grabado`, `numero_cotizacion`, `copia`,`version`,`presupuesto`,`tipo`, `instalacion`,`precio`,`aiu`,`responsable`,`tel_responsable`,`ciudad`,`municipio`,`id_cliente`, `registrado`, `estado`, `obra`, `ubicacion`, `linea`, `costo_total`, `descuento`, `desc_general`, `costo_instalacion`, `comision`, `pago`, `nota`, `validez`, `id_tercero`)";
        $sql.= "VALUES ('19','".$cot['cod_temp']."','".$cot['nom_temp']."','".$fecha_hoy."','".$fecha_hoy."','".$_SESSION['k_username']."', '".$numero_cotizacion."', '".$numero_cot."','1','".$cot['presupuesto']."','".$cot['tipo']."','".$cot['instalacion']."','".$cot['precio']."','".$cot['aiu']."','".$cot['responsable']."','".$cot['tel_responsable']."','".$cot['ciudad']."','".$cot['municipio']."','".$cot['id_cliente']."', '".$cot['registrado']."', 'En proceso', '".$cot['obra']."', '".$cot['ubicacion']."', '".$cot['linea']."', '".$cot['costo_total']."', '".$cot['descuento']."', '".$cot['desc_general']."', '".$cot['costo_instalacion']."', '".$cot['comision']."', '".$cot['pago']."', '".$cot['nota']."', '".$cot['validez']."', '".$cot['id_tercero']."')";
        mysql_query($sql, $conexion);
        
        $sql1 = "SELECT max(id_cot) FROM cotizacion";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $max= $fila1["max(id_cot)"];
        
//se consulta las cotizaciones realizadas
        
         $request=mysql_query("SELECT * FROM producto a, cotizaciones c where  c.id_referencia=a.id_p and c.id_cot=".$_GET["cod"]);
         while($row=mysql_fetch_array($request))
	 {  
             $idcc = $row['id_cotizacion'];
                 // se insertan las referencias de la cotizacion
                mysql_query("insert into cotizaciones (`imagen`, `id_cot`, `id_referencia`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `id_vidrio`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`, `cierre`, `ancho_c`, `ancho_c_original`, `alto_c`, `ancho_abajo`, `hojas`, `cuerpo`, `lado`, `cantidad_c`, `cantidad_temp`, `cant_restante`, `valor_c`, `valor_c_sp`, `valor_fom`, `valor_costob`, `valor_fomp`, `id_cliente`, `tipo_c`, `fecha_c`, `estado_c`, `registrado_por_c`, `aprobado`, `num_pedido`, `orden`, `asignado_a`, `linea_cot`, `cod_traz`, `boq`, `per`, `porcentaje`, `porcentaje_mp`, `descuento_g`, `color_ta`, `precio_item`, `precio_adicional`, `precio_material`, `precio_fom_sp`, `observaciones`, `observaciones2`, `desc`, `verticales`, `horizontales`, `d1`, `duracion`, `install`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `ubicacion_c`, `tip`, `imagen_mas`, `an`, `al`, `fila`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`, `modulo`, `pelicula`, `huacal`, `ancho_temp`, `alto_temp`, `valor_temp`, `id_dolar`, `p_act_sp`, `p_act_cp`, `aprobado_por`, `servicio`, `estado_item`, `aprobado_por_user`, `fecha_aprobada`, `iva`, `ajuste`, `msg`, `msg2`, `peso_producto`, `valor_adicional`, `adicional_per`, `rollo`, `descripcion_rollo`, `cont_item`, `cantlam`, `poli`, `poli_v`, `poli_h`, `verpoli`, `rieles`, `alfajia`, `rejillas`, `cierres`, `rodajas`, `bisagras`, `can_rieles`, `can_alfajia`, `can_rejillas`, `can_cierres`, `can_rodajas`, `can_bisagras`, `poralu`, `porvid`, `poracc`, `porace`, `id_compuesto`, `compuestos`,`termovid1`,`termovid2`,`termovid3`,`termovid4`,`idespaciador`,`cantespaciador`) select  `imagen`, '$max', `id_referencia`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `id_vidrio`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`, `cierre`, `ancho_c`, `ancho_c_original`, `alto_c`, `ancho_abajo`, `hojas`, `cuerpo`, `lado`, `cantidad_c`, `cantidad_temp`, `cant_restante`, `valor_c`, `valor_c_sp`, `valor_fom`, `valor_costob`, `valor_fomp`, `id_cliente`, `tipo_c`, `fecha_c`, `estado_c`, `registrado_por_c`, `aprobado`, `num_pedido`, `orden`, `asignado_a`, `linea_cot`, `cod_traz`, `boq`, `per`, `porcentaje`, `porcentaje_mp`, `descuento_g`, `color_ta`, `precio_item`, `precio_adicional`, `precio_material`, `precio_fom_sp`, `observaciones`, `observaciones2`, `desc`, `verticales`, `horizontales`, `d1`, `duracion`, `install`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `ubicacion_c`, `tip`, `imagen_mas`, `an`, `al`, `fila`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`, `modulo`, `pelicula`, `huacal`, `ancho_temp`, `alto_temp`, `valor_temp`, `id_dolar`, `p_act_sp`, `p_act_cp`, `aprobado_por`, `servicio`, `estado_item`, `aprobado_por_user`, `fecha_aprobada`, `iva`, `ajuste`, `msg`, `msg2`, `peso_producto`, `valor_adicional`, `adicional_per`, `rollo`, `descripcion_rollo`, `cont_item`, `cantlam`, `poli`, `poli_v`, `poli_h`, `verpoli`, `rieles`, `alfajia`, `rejillas`, `cierres`, `rodajas`, `bisagras`, `can_rieles`, `can_alfajia`, `can_rejillas`, `can_cierres`, `can_rodajas`, `can_bisagras`, `poralu`, `porvid`, `poracc`, `porace`, `id_compuesto`, `compuestos`,`termovid1`,`termovid2`,`termovid3`,`termovid4`,`idespaciador`,`cantespaciador` from cotizaciones where id_cotizacion='".$idcc."' ");
                 
                 $sql5 = "SELECT max(id_cotizacion) FROM cotizaciones";
                 $fila5 =mysql_fetch_array(mysql_query($sql5));
                 $maxcot= $fila5["max(id_cotizacion)"];
                 
                 mysql_query("insert into cotizaciones (`imagen`, `id_cot`, `id_referencia`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `id_vidrio`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`, `cierre`, `ancho_c`, `ancho_c_original`, `alto_c`, `ancho_abajo`, `hojas`, `cuerpo`, `lado`, `cantidad_c`, `cantidad_temp`, `cant_restante`, `valor_c`, `valor_c_sp`, `valor_fom`, `valor_costob`, `valor_fomp`, `id_cliente`, `tipo_c`, `fecha_c`, `estado_c`, `registrado_por_c`, `aprobado`, `num_pedido`, `orden`, `asignado_a`, `linea_cot`, `cod_traz`, `boq`, `per`, `porcentaje`, `porcentaje_mp`, `descuento_g`, `color_ta`, `precio_item`, `precio_adicional`, `precio_material`, `precio_fom_sp`, `observaciones`, `observaciones2`, `desc`, `verticales`, `horizontales`, `d1`, `duracion`, `install`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `ubicacion_c`, `tip`, `imagen_mas`, `an`, `al`, `fila`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`, `modulo`, `pelicula`, `huacal`, `ancho_temp`, `alto_temp`, `valor_temp`, `id_dolar`, `p_act_sp`, `p_act_cp`, `aprobado_por`, `servicio`, `estado_item`, `aprobado_por_user`, `fecha_aprobada`, `iva`, `ajuste`, `msg`, `msg2`, `peso_producto`, `valor_adicional`, `adicional_per`, `rollo`, `descripcion_rollo`, `cont_item`, `cantlam`, `poli`, `poli_v`, `poli_h`, `verpoli`, `rieles`, `alfajia`, `rejillas`, `cierres`, `rodajas`, `bisagras`, `can_rieles`, `can_alfajia`, `can_rejillas`, `can_cierres`, `can_rodajas`, `can_bisagras`, `poralu`, `porvid`, `poracc`, `porace`, `id_compuesto`, `compuestos`,`termovid1`,`termovid2`,`termovid3`,`termovid4`,`idespaciador`,`cantespaciador`) select  `imagen`, '$maxcot', `id_referencia`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `id_vidrio`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`, `cierre`, `ancho_c`, `ancho_c_original`, `alto_c`, `ancho_abajo`, `hojas`, `cuerpo`, `lado`, `cantidad_c`, `cantidad_temp`, `cant_restante`, `valor_c`, `valor_c_sp`, `valor_fom`, `valor_costob`, `valor_fomp`, `id_cliente`, `tipo_c`, `fecha_c`, `estado_c`, `registrado_por_c`, `aprobado`, `num_pedido`, `orden`, `asignado_a`, `linea_cot`, `cod_traz`, `boq`, `per`, `porcentaje`, `porcentaje_mp`, `descuento_g`, `color_ta`, `precio_item`, `precio_adicional`, `precio_material`, `precio_fom_sp`, `observaciones`, `observaciones2`, `desc`, `verticales`, `horizontales`, `d1`, `duracion`, `install`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `ubicacion_c`, `tip`, `imagen_mas`, `an`, `al`, `fila`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`, `modulo`, `pelicula`, `huacal`, `ancho_temp`, `alto_temp`, `valor_temp`, `id_dolar`, `p_act_sp`, `p_act_cp`, `aprobado_por`, `servicio`, `estado_item`, `aprobado_por_user`, `fecha_aprobada`, `iva`, `ajuste`, `msg`, `msg2`, `peso_producto`, `valor_adicional`, `adicional_per`, `rollo`, `descripcion_rollo`, `cont_item`, `cantlam`, `poli`, `poli_v`, `poli_h`, `verpoli`, `rieles`, `alfajia`, `rejillas`, `cierres`, `rodajas`, `bisagras`, `can_rieles`, `can_alfajia`, `can_rejillas`, `can_cierres`, `can_rodajas`, `can_bisagras`, `poralu`, `porvid`, `poracc`, `porace`, '$maxcot', `compuestos`,`termovid1`,`termovid2`,`termovid3`,`termovid4`,`idespaciador`,`cantespaciador` from cotizaciones where id_compuesto='".$idcc."' ");
                 
                 
                  $result5 = mysql_query("select * from comentarios where id_cotizacion='".$row['id_cotizacion']."' ");
                 while($m = mysql_fetch_array($result5)){
                     mysql_query("insert into comentarios (textos_com,id_cotizacion,fecha_registro_com,registrado_com)"
                             . " values('".$m['textos_com']."','".$maxcot."','".$m['fecha_registro_com']."','".$m['registrado_com']."') ");
                 }
                 
                 //copia de servicios
                 $requestser=mysql_query("SELECT * FROM cotizaciones_servicios b where id_cotizacion=".$_GET['cod']." and id_cot_mas=".$row['id_cotizacion']." ");
         while($row55=mysql_fetch_array($requestser))
	 {
             
            $sql55 = "INSERT INTO `cotizaciones_servicios` (`id_cot_mas`,`id_cotizacion`, `id_servicio`, `cantidad_serv`, `descuento_serv`, `obs_servicio`, `precio_servicio`)";
            $sql55.= "VALUES ('".$maxcot."','".$max."', '".$row55['id_servicio']."', '".$row55['cantidad_serv']."', '".$row55['descuento_serv']."', '".$row55['obs_servicio']."', '".$row55['precio_servicio']."')";
            mysql_query($sql55, $conexion);
             
         }
                 
                 //se consultan los compuestos de esta referencia  -- parte de los materi prima
                 $request_acc=mysql_query("SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET["cod"]." and a.id_cot=".$row['id_cotizacion']."  ");
                 while($row3=mysql_fetch_array($request_acc))
                 {   
                     $sql3 = "INSERT INTO `referencia_acce` (`cotizacion`, `num_ref`, `id_cot`, `cantidad_m`, `calcular`, `metro`, `yes`, `lado`, `med`)";
                     $sql3.= "VALUES ('".$max."', '".$row3['num_ref']."', '".$maxcot."',  '".$row3['cantidad_m']."', '".$row3['calcular']."', '".$row3['metro']."', '".$row3['yes']."', '".$row3['lado']."', '".$row3['med']."')";
                     mysql_query($sql3, $conexion);

                 }
                
                 // se agrega los kit 
                 
                 $request_kit=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cod']." and b.id_prod_mas=".$row['id_cotizacion']." and b.comp='1' ");
                 while($row5=mysql_fetch_array($request_kit))
                 {   
                     $sql3 = "INSERT INTO `cotizaciones_kit` (`id_producto`, `id_cot`, `cantidad_k`, `por_k`, `desc_k`, `id_prod_mas`, `color_k`, `comp`)";
                     $sql3.= "VALUES ('".$row5['id_producto']."', '".$max."', '".$row5['cantidad_k']."', '".$row5['por_k']."',  '".$row3['desc_k']."', '".$maxcot."', '".$row5['color_k']."', '".$row5['comp']."')";
                     mysql_query($sql3, $conexion);

                 }
                 
                 // se agrega los compuesto
                  $request2=mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cod"]." and c.id_producto_cot=".$row['id_cotizacion']."");
                  while($row4=mysql_fetch_array($request2))
	          {
                     $sql4 = "INSERT INTO `cotizaciones_sub` (`id_dolar`,`msg`,`msg2`,`rollo`,`descripcion_rollo`,`valor_fom_sub`, `pelicula`,`valor_sp`,`valor_fom_sp`,`imagen_adic`, `imagen_sub`,`laminas`,`laminas2`,`laminas3`,`laminas4`, `tipo_c_sub`, `install`, `horizontales`,`verticales`,`desc_sub`, `observaciones_sub`, `hojas_sub`, `cuerpo_sub`, `color_ta_sub`, `porcentaje_sub`, `porcentaje_mp_sub`, `per_sub`, `boq_sub`, `cod_traz_sub`, `linea_cot_sub`, `id_cot_sub`, `cierre_sub`, `id_referencia_sub`, `id_vidrio_sub`, `id_vidrio_sub2`, `id_vidrio_sub3`, `id_vidrio_sub4`, `id_vidrio_sub5`, `id_vidrio_sub6`, `ancho_c_sub`, `alto_c_sub`, `valor_c_sub`, `cantidad_c_sub`, `cant_restante`, `id_cliente_sub`, `estado_c_sub`, `registrado_por_c_sub`, `id_producto_cot`, `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`)";
                     $sql4.= "VALUES ('".$row4['id_dolar']."','".$row4['msg']."','".$row4['msg2']."','".$row4['rollo']."','".$row4['descripcion_rollo']."','".$row4['valor_fom_sub']."','".$row4['pelicula']."','".$row4['valor_sp']."','".$row4['valor_fom_sp']."','".$row4['imagen_adic']."', '".$row4['imagen_sub']."', '".$row4['laminas']."', '".$row4['laminas2']."', '".$row4['laminas3']."', '".$row4['laminas4']."', '".$row4['tipo_c_sub']."', '".$row4['install']."','".$row4['horizontales']."', '".$row4['verticales']."','".$row4['desc_sub']."', '".$row4['observaciones_sub']."', '".$row4['hojas_sub']."', '".$row4['cuerpo_sub']."', '".$row4['color_ta_sub']."', '".$row4['porcentaje_sub']."', '".$row4['porcentaje_mp_sub']."', '".$row4['per_sub']."','".$row4['boq_sub']."', '".$row4['cod_traz_sub']."', '".$row4['linea_cot_sub']."', '".$max."', '".$row4['cierre_sub']."', '".$row4['id_referencia_sub']."', '".$row4['id_vidrio_sub']."', '".$row4['id_vidrio_sub2']."', '".$row4['id_vidrio_sub3']."', '".$row4['id_vidrio_sub4']."', '".$row4['id_vidrio_sub5']."', '".$row4['id_vidrio_sub6']."', '".$row4['ancho_c_sub']."',  '".$row4['alto_c_sub']."',  '".$row4['valor_c_sub']."',  '".$row4['cantidad_c_sub']."', '".$row4['cantidad_c_sub']."', '".$row4['id_cliente_sub']."', '".$row4['estado_c_sub']."', '".$_SESSION['k_username']."', '".$maxcot."', '".$row4['d1']."', '".$row4['id2_vidrio']."', '".$row4['id2_vidrio2']."', '".$row4['id2_vidrio3']."', '".$row4['id2_vidrio4']."', '".$row4['id2_vidrio5']."', '".$row4['id3_vidrio']."', '".$row4['id3_vidrio2']."', '".$row4['id3_vidrio3']."', '".$row4['id3_vidrio4']."', '".$row4['id3_vidrio5']."', '".$row4['id4_vidrio']."', '".$row4['id4_vidrio2']."', '".$row4['id4_vidrio3']."', '".$row4['id4_vidrio4']."', '".$row4['id4_vidrio5']."', '".$row4['traz_vid']."', '".$row4['traz_vid2']."', '".$row4['traz_vid3']."', '".$row4['traz_vid4']."')";
                      mysql_query($sql4, $conexion);
                      
                      
                      
                  }
             
         }
         $request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cod']." and id_cot_mas=0 ");
         while($row2=mysql_fetch_array($request2))
	 {
             
            $sql56 = "INSERT INTO `cotizaciones_servicios` (`id_cotizacion`, `id_servicio`, `cantidad_serv`, `descuento_serv`)";
            $sql56.= "VALUES ('".$max."', '".$row2['id_servicio']."', '".$row2['cantidad_serv']."', '".$row2['descuento_serv']."')";
            mysql_query($sql56, $conexion);
             
         }
         $request3=mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cod']." ");
         while($row21=mysql_fetch_array($request3))
	{
               $sql6 = "INSERT INTO `cotizaciones_materiales` (`color_ma`, `med`, `pe`, `id_cotizacion`, `id_material`, `cantidad_mat`, `descuento_mat`)";
            $sql6.= "VALUES ('".$row21['color_ma']."', '".$row21['med']."', '".$row21['pe']."','".$max."', '".$row21['id_material']."', '".$row21['cantidad_mat']."', '".$row21['descuento_mat']."')";
            mysql_query($sql6, $conexion);
             
         }
         $request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cod']."  and b.comp='0'");
    while($row21k=mysql_fetch_array($request4))
	{  
        
        $sql7 = "INSERT INTO `cotizaciones_kit` (`color_k`, `por_k`, `id_cot`, `id_producto`, `cantidad_k`, `desc_k`)";
            $sql7.= "VALUES ('".$row21k['color_k']."', '".$row21k['por_k']."','".$max."', '".$row21k['id_producto']."', '".$row21k['cantidad_k']."', '".$row21k['desc_k']."')";
            mysql_query($sql7, $conexion);
    }
         
          echo '<script lanquage="javascript">alert("Se ha Copiado la cotizacion #'.$numero_cot.', Su nueva cotizacion es '.$numero_cotizacion.' ");location.href="../vistas/?id=lista_cot "</script>'; 
         
         
         