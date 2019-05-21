<!DOCTYPE html>
<?php
	include '../modelo/conexion.php';
	$sqld = "UPDATE  `cotizacion` SET `impresion` = '" . $fecha_hoy . "' WHERE `id_cot` = '" . $_GET['cot'] . "'";
	mysql_query($sqld, $conexion);
	if (isset($_GET['cot'])) {
    	$request = mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND c.servicio = 0 AND c.id_cot = " . $_GET["cot"] . " ORDER BY c.fila ASC");
		if ($request) {
        	$strConsulta3 = "select * from cotizacion  where id_cot='" . $_GET['cot'] . "'";
        	$pacientes3 = mysql_query($strConsulta3);
        	$fila3 = mysql_fetch_array($pacientes3);
                $sel_iva = $fila3['sel_iva'];

        $strConsulta3 = "select * from cont_terceros  where id_ter=" . $fila3['id_tercero'] . "";
        $empresat = mysql_query($strConsulta3);
        $filae = mysql_fetch_array($empresat);
        $nombre = $filae['nom_ter'];
        $documento = $filae['cod_ter'];
        $telefono = $filae['telfijo_ter'];
        $direccion = $filae['dir_ter'];



        if ($fila3['orden'] == '0') {
            $abc = 'COTIZACION No. : ';
            $num = $fila3['numero_cotizacion'] . '- V.' . $fila3['version'];
        } else {
            $abc = 'PEDIDO No. :';
            $num = $fila3['orden'];
        }
    }
    $str = "select estado from cotizacion  where id_cot='" . $_GET['cot'] . "'";
                    $pac = mysql_query($str);
                    $fx = mysql_fetch_row($pac);
                    $pr = $fx[0];
                    
                   
                            
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>DETALLES DE LA COTIZACIÓN No. <?php echo $num ?></title>
            <style type="text/css">

                footer {
                    position: relative;
                    /* Altura total del footer en px con valor negativo */
                    margin-top: 1px;
                    /* Altura del footer en px. Se han restado los 5px del margen
                       superior mas los 5px del margen inferior
                    */
                    height: 1px; 
                    padding:5px 0px;
                    clear: both;
                    background: #fff;
                    text-align: center;

                    font-family: Arial;
                    font-size: 7px; 
                    color: #000000; 
                }

                /* Esta clase define la anchura del contenido y la posicion centrada 
                   El contenido queda centrado y limitado, pero la cabecera y el pie
                   llegan hasta los limites del navegador.
                */
                .define {
                    width:960px;
                    margin:0 auto;
                }
                @media all {
                    div.saltopagina{
                        display: none;
                    }
                }

                @media print{
                    div.saltopagina{ 
                        display:block; 
                        page-break-before:always;
                    }
                }
                .estilo1 { 
                    font-family: Arial;
                    font-size: 8px; 
                    color: #000000; 
                } 
                td.estilo1 {
                    border:hidden;
                }
                table.estilo1 {
                    border: 1px solid #000000;
                }
                table.estilo2 {
                    border: 0.4px solid #000000;
                    border-top: 1px solid transparent;
                    border-collapse: collapse;
                }
                i { 
                    font-family: Arial;
                    font-size: 7px; 
                    color: #000000; 
                }
                .estilo2 { 
                    font-family: Arial; 
                    font-size: 14px; 
                    color: #000000; 
                } 

                th.estilo2 {
                    font-size: 10px; 
                }
                #piedepagina{
                    width:800px; 
                    position: absolute;
                    bottom: 0 !important;
                    bottom: -1px;
                }
            </style>
        </head>
        <body onload="window.print()" <?php if($pr=='En proceso'){  ?>style="background-image: url('../images/sin.png');background-repeat: no-repeat;background-size: 480px;background-position-x: 400px;background-position-y: 250px" <?php } ?> >
          

            <?php

            function tabla() {
                $request = mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=" . $_GET["cot"] . " order by c.tip asc");
                date_default_timezone_set("America/Bogota");
                $hora = date('h:i:s', time() - 3600 * date('I'));

                if ($request) {
                    $strConsulta3 = "select * from cotizacion  where id_cot='" . $_GET['cot'] . "'";
                    $pacientes3 = mysql_query($strConsulta3);
                    $fila3 = mysql_fetch_array($pacientes3);
                     $sel_iva = $fila3['sel_iva'];
                    if ($fila3['nom_temp'] == '') {
                        $strConsulta3 = "select * from cont_terceros  where id_ter=" . $fila3['id_tercero'] . "";
                        $empresat = mysql_query($strConsulta3);
                        $fila6 = mysql_fetch_array($empresat);
                        $nombre = $fila6['nom_ter'];
                        $documento = $fila6['cod_ter'];
                        $telefono = $fila6['telfijo_ter'];
                        $direccion = $fila6['dir_ter'];
                    } else {
                        $nombre = $fila3['nom_temp'];
                        $documento = $fila3['cod_temp'];
                    }
                    if ($fila3['orden'] == '0') {
                        $abc = 'COT. No. : ';
                        $num = $fila3['numero_cotizacion'] . '- V.' . $fila3['version'];
                    } else {
                        $abc = 'PED No. :';
                        $num = $fila3['orden'];
                    }
                }
                ?>         
                <table class="estilo1" border="0"  cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="9"  style="margin: 15px;padding: 15px;color:white" width="50%">
        <?php if ($_GET['ciudad'] == 'Barranquilla') { ?>
                                <img src="../imagenes/logo2.png" width="200" height="80">
        <?php } else { ?>
                                <img src="../imagenes/logo3.png" width="200" height="80">
        <?php } ?>
                        </td>
                        <th ALIGN=left style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                        <th ALIGN=left style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                    </tr>
                    <tr>

                        <th ALIGN=left>CLIENTE:</th>
                        <td width="25%"><?php echo $nombre; ?></td>

                        <th ALIGN=left><?php echo $abc; ?></th>
                        <td width="25%"><?php echo $num; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>C.C ó NIT:</th>
                        <td width="20%"><?php echo $documento; ?></td>
                        <th ALIGN=left>CONTACTO:</th>
                        <td width="15%"><?php echo $fila3['responsable']; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>OBRA:</th>
                        <td width="20%"><?php echo $fila3['obra']; ?></td>
                        <th ALIGN=left>ASESOR:</th>
                        <td width="15%"><?php echo $fila3['registrado']; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>DIRECCION:</th>
                        <td width="20%"><?php echo $fila3['ubicacion']; ?></td>
                        <th ALIGN=left>VALIDEZ:</th>
                        <td width="15%"><?php echo $fila3['validez']; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>TELEFONO:</th>
                        <td width="25%"><?php echo $fila3['tel_responsable']; ?></td>
                        <th ALIGN=left>PAGO:</th>
                        <td><?php echo $fila3['pago']; ?></td>
                    </tr>
                    <tr>
                        <th ALIGN=left>IMPRESION: </th><td><?php echo date('Y-m-d') . ' ' . $hora; ?></td>

                        <th ALIGN=left>REGISTRO:</th>
                        <td><?php echo $fila3['fecha_reg_c'] . ' por: ' . $fila3['grabado']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php ?> </td>
                    </tr>
                    <tr>
                        <th ALIGN=left>CIUDAD: </th><td><?php echo $fila3['municipio'] . ' - ' . $fila3['ciudad']; ?></td>

                        <th ALIGN=left></th>
                        <td> </td>
                    </tr>
                    <tr>

                        <th ALIGN=left  style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                        <th ALIGN=left style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                    </tr>
                </table>

            <?php } ?>       




            <?php
            //Por cada resultado pintamos una linea
            $total2 = 0;
            $tad = 0;
			$des = 0;//Codigo Adicionado (Jaime)
            $cont = 0;
            $es2 = 0;
            $pag = 0;
            $a1 = 0 * $_GET['col'];
            $a2 = 1 * $_GET['col'];
            $a3 = 2 * $_GET['col'];
            $a4 = 3 * $_GET['col'];
            $aa5 = 4 * $_GET['col'];
            $aa6 = 5 * $_GET['col'];
            $aa7 = 6 * $_GET['col'];
            $aa8 = 7 * $_GET['col'];
            $aa9 = 8 * $_GET['col'];
            $aa10 = 9 * $_GET['col'];
            $aa11 = 10 * $_GET['col'];
            $aa12 = 11 * $_GET['col'];
            $aa13 = 12 * $_GET['col'];
            $aa14 = 13 * $_GET['col'];
            $aa15 = 14 * $_GET['col'];
            $aa16 = 15 * $_GET['col'];
            $aa17 = 16 * $_GET['col'];
            $aa18 = 17 * $_GET['col'];
            $aa19 = 18 * $_GET['col'];
            $aa20 = 19 * $_GET['col'];
            $aa21 = 20 * $_GET['col'];
            $aa22 = 21 * $_GET['col'];
            $aa23 = 22 * $_GET['col'];
            $aa24 = 23 * $_GET['col'];
            $aa25 = 24 * $_GET['col'];
            $aa26 = 25 * $_GET['col'];
            $aa27 = 26 * $_GET['col'];
            $aa28 = 27 * $_GET['col'];
            $aa29 = 28 * $_GET['col'];
            $aa30 = 29 * $_GET['col'];
            $aa31 = 30 * $_GET['col'];
            $aa32 = 31 * $_GET['col'];
            $aa33 = 32 * $_GET['col'];
            $aa34 = 33 * $_GET['col'];
            $aa35 = 34 * $_GET['col'];
            $aa36 = 35 * $_GET['col'];
            $aa37 = 36 * $_GET['col'];
            while ($row = mysql_fetch_array($request)) {

                if ($cont == $a1 || $cont == $a2 || $cont == $a3 || $cont == $a4 || $cont == $aa5 || $cont == $aa6 || $cont == $aa7 || $cont == $aa8 || $cont == $aa9 || $cont == $aa10 || $cont == $aa11 ||
                        $cont == $aa12 || $cont == $aa13 || $cont == $aa14 || $cont == $aa15 || $cont == $aa16 || $cont == $aa17 || $cont == $aa18 || $cont == $aa19 || $cont == $aa20 || $cont == $aa21 ||
                        $cont == $aa22 || $cont == $aa23 || $cont == $aa24 || $cont == $aa25 || $cont == $aa26 || $cont == $aa27 || $cont == $aa28 || $cont == $aa29 || $cont == $aa30 || $cont == $aa31 || $cont == $aa32 || $cont == $aa33 || $cont == $aa34 || $cont == $aa35 || $cont == $aa36 || $cont == $aa37) {
                    $pag +=1;
//                  echo '<fieldset style="height:670px;">';
                    tabla();

					$table3 = '<table border="1"  class="estilo2" width="965px">';
					$table3 = $table3 .'<thead >';
					$table3 = $table3 .'<tr BGCOLOR="#13173B">';
					$table3 = $table3 .'<th width="4%" style="font-size:8px; color:white">' . 'TIPO'.'</h6></th>';
					$table3 = $table3 .'<th width="43%" style="font-size:8px; color:white">' . 'DESCRIPCION' . '</th>';
					$table3 = $table3 .'<th width="8%" style="font-size:8px; color:white">' . 'UBICACION' . '</th>';
					$table3 = $table3 .'<th width="8%" style="font-size:8px; color:white">' . 'VIDRIO' . '</th>';
					$table3 = $table3 .'<th  width="8%" style="font-size:8px; color:white">' . 'ANCHO X ALTO' . '</th>';
					$table3 = $table3 .'<th  width="5%" style="font-size:8px; color:white">' . 'AREA M2' . '</th>';
					$table3 = $table3 .'<th  width="3%" style="font-size:8px; color:white">' . 'UND.' . '</th>';
					$table3 = $table3 .'<th  width="7%" style="font-size:8px; color:white">' . 'VLR. UND.' . '</th>';
					$table3 = $table3 .'<th  width="8%" style="font-size:8px; color:white">' . 'V. TOTAL' . '</th>';
					$table3 = $table3 . '</tr>';
					$table3 = $table3 . '</thead>';
                } else {
                    $table3 = '<table   border="1"  class="estilo2" width="965px">';
                }

                $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id_vidrio'] . " ";
                $fv1 = mysql_fetch_array(mysql_query($cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id_vidrio2'] . " ";
                $fv2 = mysql_fetch_array(mysql_query($cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id_vidrio3'] . " ";
                $fv3 = mysql_fetch_array(mysql_query($cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id_vidrio4'] . " ";
                $fv4 = mysql_fetch_array(mysql_query($cons_vir3));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id2_vidrio'] . " ";
                $fv21 = mysql_fetch_array(mysql_query($cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id2_vidrio2'] . " ";
                $fv22 = mysql_fetch_array(mysql_query($cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id2_vidrio3'] . " ";
                $fv23 = mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=" . $row['id2_vidrio3'] . " ";
                $fv24 = mysql_fetch_array(mysql_query($cons_vi4));

               
                $s3 = "SELECT (p1) AS p FROM porcentajes WHERE area_por = '".$row["linea_cot"]."'";
                $fi3 = mysql_fetch_array(mysql_query($s3));
                $mult = $fi3["p"] / 100;
				
                $comp = mysql_query("SELECT count(*) FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=" . $_GET["cot"] . " and c.id_producto_cot=" . $row["id_cotizacion"] . "");
                $cm2 = mysql_fetch_array($comp);
                $d = $cm2['count(*)'];

                $ac = mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=" . $_GET['cot'] . " and a.id_cot=" . $row["id_cotizacion"] . "  ");
                $cm = mysql_fetch_array($ac);
                $mt = $cm['count(*)'];
                $t = $d + $mt;
                $compu = mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=" . $_GET["cot"] . " and c.id_producto_cot=" . $row["id_cotizacion"] . "");
                $costo_sp = 0;
                $costo_fom_sp = 0;
                $costo_mp = 0;
                $costo_fom_mp = 0;
                $c = '';
                $mc = '';
                $img2 = '';
                while ($fila = mysql_fetch_array($compu)) {
                    IF ($fila["ruta"] == '') {
                        $img3 = '<img src="../producto/no.jpg" width="60" heigth="40">';
                    } else {
                        $img3 = '<img src="../adicionales/' . $fila["ruta"] . '" width="60" heigth="40">';
                    }
                    if (isset($fila['producto'])) {
                        $c = $c . ', + :' . $fila['producto'];
                        $mc = $mc . '<br>' . $fila['ancho_c_sub'] . ' x ' . $fila['alto_c_sub'];
                        $img2 = $img2 . '<br>' . $img3;
                    } else {
                        $c = $c . '';
                        $mc = $mc . '';
                        $img2 = $img2 . '';
                    }
					$sx = "SELECT (p1) as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                	$fix =mysql_fetch_array(mysql_query($sx));
                	$multx= $fix["p"]/100;
                    $costo_sp += $fila['valor_sp'];
                    $costo_fom_sp += $fila['valor_fom_sp'];
                    $costo_mp += $fila['valor_c_sub'] /$multx;
                    $costo_fom_mp += $fila['valor_fom_sub'];
                }

                $adi = $row["adicional_per"] / $row['cantidad_c'];
                
                $pad = (($costo_mp * $row["cantidad_c"]));
                $tk = ($row["precio_material"]) * $row["cantidad_c"];
                $a = (($row["valor_c"] / $mult) + ($row["ajuste"]* $row["cantidad_c"])) + $tk + $pad;

                if ($row["linea_cot"] == 'Vidrio' || $row["linea_cot"]=='VIDRIO') {
                      if ($row["per"] == 0 && $row["boq"] == 0) {
                        $d1 = '';
                    } else {
                        $d1 = '<br>Per:' . $row["per"] . '<br>Boq:' . $row["boq"];
                    }
                } else {
                    $d1 = '<br>Color: ' . $row["color_ta"] . '';
                }

                if ($row["cuerpo"] != 0) {
                    $mx = '<br>- Cuerpo Fijo: ' . $row["cuerpo"] . ' mm';
                } else {
                    $mx = '';
                }
                $pu = ($a / $row["cantidad_c"]);
                $descpor = $pu * $row["desc"] / 100;
                $pud = $pu + $descpor;
                $descuento_g = ($row["descuento_g"] / 100) * $pud;
                $pudt = ($pud - $descuento_g) + $adi;
                $ptt2 = ($pudt * $row["cantidad_c"]);


                if ($row["imagen_mas"] != '') {
                    $fi = '../adicionales/' . $row["imagen_mas"];
                    list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);

                    if ($row["an"] == 0) {
                        $pi1 = $ancho;
                    } else {
                        $pi1 = $row["an"];
                    }
                    if ($row["al"] == 0) {
                        $pi2 = $alto;
                    } else {
                        $pi2 = $row["al"];
                    }
                    $img = '<img src="../adicionales/' . $row["imagen_mas"] . '" width="' . $pi1 . 'px"  height="' . $pi2 . 'px">';
                } else {

                    IF ($row["imagen"] == 'Derecho') {
                        IF ($row["ruta"] == '') {
                            $img = '<img src="../producto/no.jpg" width="35px" heigth="35px">';
                        } else {
                            $fi = '../producto/' . $row["ruta"];
                            list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
                            if ($row["an"] == 0) {
                                $pi1 = $ancho;
                            } else {
                                $pi1 = $row["an"];
                            }
                            if ($row["al"] == 0) {
                                $pi2 = $alto;
                            } else {
                                $pi2 = $row["al"];
                            }
                            $img = '<img src="../producto/' . $row["ruta"] . '"  width="' . $pi1 . 'px"  height="' . $pi2 . 'px">';
                        }
                    } else {
                        IF ($row["ruta"] == '') {
                            $img = '<img src="../producto/no.jpg" width="35px" heigth="30px">';
                        } else {
                            $fi = '../producto/' . $row["ruta2"];
                            list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
                            ;
                            if ($row["an"] == 0) {
                                $pi1 = $ancho;
                            } else {
                                $pi1 = $row["an"];
                            }
                            $img = '<img src="../producto/' . $row["ruta2"] . '"  width="' . $pi1 . 'px">';
                        }
                    }
                }

                $con2 = "SELECT * FROM `producto` where id_p=" . $row['traz_vid'] . " ";
                $res2 = mysql_query($con2);
                while ($f8 = mysql_fetch_array($res2)) {
                    $idco = $f8['id_p'];
                    $nombr = $f8['producto'];
                }
                if ($row['traz_vid2'] == 0) {
                    $nombr2 = '';
                } else {
                    $con22 = "SELECT * FROM `producto` where id_p=" . $row['traz_vid2'] . " ";
                    $res22 = mysql_query($con22);
                    while ($f8 = mysql_fetch_array($res22)) {
                        $idco2 = $f8['id_p'];
                        $nombr2 = $f8['producto'];
                    }
                }
                if ($row['traz_vid3'] == 0) {
                    $nombr3 = '';
                } else {
                    $con23 = "SELECT * FROM `producto` where id_p=" . $row['traz_vid3'] . " ";
                    $res23 = mysql_query($con23);
                    while ($f8 = mysql_fetch_array($res23)) {
                        $idco3 = $f8['id_p'];
                        $nombr3 = $f8['producto'];
                    }
                }
                if ($row['traz_vid4'] == 0) {
                    $nombr4 = '';
                } else {
                    $con24 = "SELECT * FROM `producto` where id_p=" . $row['traz_vid4'] . " ";
                    $res24 = mysql_query($con24);
                    while ($f8 = mysql_fetch_array($res24)) {
                        $idco4 = $f8['id_p'];
                        $nombr4 = $f8['producto'];
                    }
                }


                $mt2 = ($row["ancho_c"] / 1000) * ($row["alto_c"] / 1000);
                $_GET["id_v"] = $row["id_vidrio"];
                $_GET["id_v2"] = $row["id_vidrio2"];
                $_GET["id_v3"] = $row["id_vidrio3"];
                $_GET["id_v4"] = $row["id_vidrio4"];
                $_GET["id_v5"] = $row["id_vidrio5"];
                $_GET["id_v6"] = $row["id_vidrio6"];
                $_GET["cant"] = $row["cantidad_c"];
                $_GET["por"] = $row["porcentaje_mp"];
                $_GET["ref"] = $row["id_referencia"];
                require '../vistas/form/apeso.php';

                if ($row['linea'] == 'Vidrio') {
                    $kk = $mt2 * $fv1['espesor_v'] * 2.5;
                    $es2 = $es2 + $kk;
                    $kg2 = $kk;
                } else {
                    $es2 = $es2 + $kg2;
                    $kg2 = $kg2;
                }

                if ($row['traz_vid'] != 0) {
                    if ($row['producto'] == $nombr) {
                        $res = '*********';
                        $res2 = '';
                        $res3 = '';
                        $res4 = '';
                    } else {
                        if ($row['linea'] == 'Acero') {
                            $res = '*********';
                            $res2 = '';
                            $res3 = '';
                            $res4 = '';
                        } else {
                            $res = ', ' . $nombr;
                            $res2 = ', ' . $nombr2;
                            $res3 = ', ' . $nombr3;
                            $res4 = ', ' . $nombr4;
                        }
                    }
                } else {
                    $res = '';
                    $res2 = '';
                    $res3 = '';
                    $res4 = '';
                }
                $v1 = $fv1['color_v'];
                if ($fv2['color_v'] == '') {
                    $v2 = '';
                } else {
                    $v2 = '+' . $fv2['color_v'];
                }
                if ($fv3['color_v'] == '') {
                    $v3 = '';
                } else {
                    $v3 = '+' . $fv3['color_v'];
                }
                if ($fv4['color_v'] == '') {
                    $v4 = '';
                } else {
                    $v4 = '+' . $fv4['color_v'];
                }
                $v21 = $fv21['color_v'];
                if ($fv22['color_v'] == '') {
                    $v22 = '';
                } else {
                    $v22 = '+' . $fv22['color_v'];
                }
                if ($fv23['color_v'] == '') {
                    $v23 = '';
                } else {
                    $v23 = '+' . $fv23['color_v'];
                }
                if ($fv24['color_v'] == '') {
                    $v24 = '';
                } else {
                    $v24 = '+' . $fv24['color_v'];
                }
                $tip = $row['tip'];
                $tip2 = $row['fila'];
                if ($row['id_vidrio'] != 0 && $row['id_vidrio2'] != 0) {
                    if (strlen($nombr) > 46) {
                        $name = '';
                    } else {
                        $name = $nombr;
                    }
                    $vi = $v1 . $v2 . $v3 . $v4 . ' - ' . $nombr;
                } else {
                    if ($fv1['espesor_v'] != '' && $row['producto'] != $nombr) {
                        if (strlen($nombr) > 46) {
                            $name = '';
                        } else {
                            $name = $nombr; //ANTES ERA $name.
                        }
                        $vi = $fv1['color_v'] . ' ' . $nombr; //ANTES ERA $name.
                    } else {
                        $vi = $fv1['color_v'];
                    }
                }
                if ($row['id2_vidrio'] != 0 && $row['id2_vidrio2'] != 0) {
                    if (strlen($nombr2) > 46) {
                        $name2 = '';
                    } else {
                        $name2 = $nombr2;
                    }
                    $vi2 = $v21 . $v22 . $v23 . $v24 . ' - ' . $name2;
                } else {
                    if (strlen($nombr2) > 46) {
                        $name2 = '';
                    } else {
                        $name2 = $nombr2;
                    }
                    $vi2 = $fv21['color_v'] . ' - ' . $name2;
                }




                $c = '';
                $mc = '';
                $img2 = '';
                $compu = mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=" . $_GET["cot"] . " and c.id_producto_cot=" . $row["id_cotizacion"] . "");
                $art = 0;
                while ($fila = mysql_fetch_array($compu)) {
                    IF ($fila["ruta"] == '') {
                        $img3 = '<img src="../producto/no.jpg" width="60" heigth="40">';
                    } else {
                        $img3 = '<img src="../adicionales/' . $fila["ruta"] . '" width="60" heigth="40">';
                    }
                    $ar = ($fila['ancho_c_sub'] / 1000) * ($fila['alto_c_sub'] / 1000);
                    $art +=$ar;
                    if (isset($fila['producto'])) {
                        $c = $c . ', + :' . $fila['producto'];
                        $mc = $mc . '<br>' . $fila['ancho_c_sub'] . ' x ' . $fila['alto_c_sub'];
                        $img2 = $img2 . '<br>' . $img3;
                    } else {
                        $c = $c . '';
                        $mc = $mc . '';
                        $img2 = $img2 . '';
                    }
                }
                $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99 ";
                $fila21 = mysql_fetch_array(mysql_query($sql21));
                if ($row['pelicula'] == 'No Aplica') {
                    $peli = '';
                } else {
                    if ($row['pelicula'] == 'Una Cara') {

                        $peli = '<br> Pelicula: ' . $row['pelicula'];
                    } else {

                        $peli = '<br> Pelicula: ' . $row['pelicula'] . ' ambos lados';
                    }
                }
                if ($row['install'] == 'Si') {
                    $v = '<br><b>(Suministro e Instalación)</b>(Cod.'.number_format($row['desc'],2,'.','').')'; //16004
                } else {
                    $v = '<br><b>(Suministro)</b>(Cod.'.number_format($row['desc'],2,'.','').')' ;
                }
                if ($row['ancho_temp'] != 0 && $row['alto_temp'] != 0) {
                    $med = $row['ancho_temp'] . ' x ' . $row['alto_temp'];
                    $artt = ($row['ancho_temp'] / 1000) * ($row['alto_temp'] / 1000);
                } else {
                    $med = '' . $row["ancho_c"] . ' x ' . $row["alto_c"] . '' . $mc . '';
                    $artt = $mt2 + $art;
                }

                if ($row["cierre"] == 'No') {
                    $cierre = '';
                } else {
                    $cierre = ' , Cierre:' . $row["cierre"] . '';
                }
                if ($row["valor_temp"] == '0') {
                    $pudt = $pudt;
                    $ptt2 = $ptt2;
                } else {
                    $pudt = $row["valor_temp"];
                    $ptt2 = $row["valor_temp"] * $row["cantidad_c"];
                }
                if ($row['observaciones'] == '') {
                    $obs = '';
                    if ($row['linea_cot'] == 'Vidrio') {
                        $esp = '<font color="white">espacios en blanco de la cotizacion y en blanco</font>';
                    } else {
                        $esp = '';
                    }
                } else {
                    $obs = ', ' . $row['observaciones'];
                    $esp = '';
                }
                if ($row['observaciones2'] == '') {
                    $obs2 = '';
                } else {
                    $obs2 = '<br>OBSERVACIONES: ' . $row['observaciones2'];
                }


                $tad = $tad + $ptt2;
    $table3 = $table3.'<tr>'
                    . '<td width="4%"  height="20" style="font-size:8px"><p align="center">'.$row['tip'].'</p></td>          
                       <td width="43%" style="font-size:8px"><p align="justify">  '.strtoupper($row['producto']).' '.$esp.' '.strtoupper($obs).' '.strtoupper($v).' '.strtoupper($peli).'  '.strtoupper($d1).'  '.strtoupper($obs2).' </p></td>
                       <td width="8%" style="font-size:8px"><p align="center">'.$row["ubicacion_c"].'</p></h6></td>'
                    . '<td width="8%" style="font-size:8px"><p align="center">'.$vi.'<br><br>'.$vi2.'</p></td>             
                       <td  width="8%" style="font-size:8px"><p align="center">'.$med.'</p></td>'
                    . '<td  width="5%" style="font-size:8px"><p align="center">'.number_format($artt,2,',','.').'</p></td>'
                    . '
                       <td  width="3%" style="font-size:8px"><p align="center">'.$row["cantidad_c"].' </p></h6></td>
                       <td  width="7%" style="font-size:8px"><p align="center">$'.number_format($pudt).'</p></td>
                       <td  width="8%" style="font-size:8px"><p align="center">$'.number_format($ptt2).'</p></td></tr></div>';   
           $table3 = $table3.'</table>';

                echo $table3;

                $cont = $cont + 1;
				//echo $_GET['total_item'];
                if ($cont == $_GET['total_item']) {//Codigo Agregado (Jaime)
                    $r2 = mysql_query("SELECT count(*) FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=" . $_GET['cot'] . " and b.id_cot_mas=0");
                    $c21 = mysql_fetch_array($r2);
                    $csv2 = $c21['count(*)'];
                    $r3 = mysql_query("SELECT count(*) FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=" . $_GET['cot'] . " ");
                    $c31 = mysql_fetch_array($r3);
                    $ccv2 = $c31['count(*)'];
                    $r4 = mysql_query("SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=" . $_GET['cot'] . " and b.comp='0' ");
                    $c22 = mysql_fetch_array($r4);
                    $ckv2 = $c22['count(*)'];
                    $ft2 = $csv2 + $ccv2 + $ckv2;

                    $fila3['desc_general'];
                    $ff = $tad;
                    $des = ($fila3['desc_general'] / 100) * $ff;
                    $iva = ($ff - $des) * ($sel_iva/100);
                    echo '<i>Nota: ' . $fila3['nota'] . '</i><br>';
                    if ($ft2 == 0) {
                        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format(($tad) - $des) . '</td></tr>'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">IVA '.$sel_iva.'%: $<td  align="right" width="100px" style="font-size:80%;color:white;">' . number_format($iva) . '</td></tr>'
                        . '</table><br><br>';
                        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format(($ff + $iva) - $des) . '</td></tr>'
                        . '</table><br>';
                    } else {
                        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL REF.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format(($tad) - $des) . '</td></tr>'
                        . '</table><br>';
                    }
                }
                if ($cont == $a1 || $cont == $a2 || $cont == $a3 || $cont == $a4 || $cont == $aa5 || $cont == $aa6 || $cont == $aa7 || $cont == $aa8 || $cont == $aa9 || $cont == $aa10 || $cont == $aa11 ||
                        $cont == $aa12 || $cont == $aa13 || $cont == $aa14 || $cont == $aa15 || $cont == $aa16 || $cont == $aa17 || $cont == $aa18 || $cont == $aa19 || $cont == $aa20 || $cont == $aa21 ||
                        $cont == $aa22 || $cont == $aa23 || $cont == $aa24 || $cont == $aa25 || $cont == $aa26 || $cont == $aa27 || $cont == $aa28 || $cont == $aa29 || $cont == $aa30 || $cont == $aa31 || $cont == $aa32 || $cont == $aa33 || $cont == $aa34 || $cont == $aa35 || $cont == $aa36 || $cont == $aa37) {
                    echo '<div class="saltopagina"></div>';
                }
            }

//-----------------------------------------servicios-----------------------------------------------
            $request2 = mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=" . $_GET['cot'] . " and b.id_cot_mas=0");
            $r2 = mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=" . $_GET['cot'] . " and b.id_cot_mas=0");
            $c21 = mysql_fetch_row($r2);
            $csv = $c21[0];
            $r3 = mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=" . $_GET['cot'] . " ");
            $c31 = mysql_fetch_row($r3);
            $ccv = $c31[0];
            $r4 = mysql_query("SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=" . $_GET['cot'] . " and b.comp='0' ");
            $c22 = mysql_fetch_row($r4);
            $ckv = $c22[0];
            $ft = $csv + $ccv + $ckv;
            if ($ft != 0) {
                echo '<div class="saltopagina"></div>';
                tabla();
            }
            if ($csv != 0) {


                $table2 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
                $table2 = $table2 . '<thead >';
                $table2 = $table2 . '<tr BGCOLOR="#13173B">';
                $table2 = $table2 . '<th width="5%" style="font-size:8px; color:white">' . 'ITEMS' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'CODIGO' . '</th>';
                //$table2 = $table2 . '<th width="40%" style="font-size:8px; color:white">' . 'DESCRIPCION DEL SERVICIO' . '</th>';
                $table2 = $table2 . '<th width="40%" style="font-size:8px; color:white">' . 'DESCRIPCIÓN' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'REFERENCIA' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'MEDIDA' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'CANTIDAD' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'VLR. UND.' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'V. TOTAL SERVICIO' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'V. TOTAL ACCESORIOS' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'V. TOTAL' . '</th>';
                $table2 = $table2 . '</tr>';
                $table2 = $table2 . '</thead>';


                //Por cada resultado pintamos una linea
                $total2 = 0;
                $to_serv = 0;
                while ($row2 = mysql_fetch_array($request2)) {

                    $request_ac1 = mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=" . $row2["id_ref_mo"]);
                    $tota = 0;
                    while ($row1 = mysql_fetch_array($request_ac1)) {
                        $por = 100;
                        $tota = $tota + ($row2["valor_mo"] * $row1["porcentaje_ad"] / $por);
                    }
                    $pr = (100 - $row2["utilidad"]) / 100;
                    $fr = ($row2["valor_mo"] + $tota) / $pr;

                    $total2 = $total2 + 1;
                    $des = ($row2['descuento_serv'] / 100) * $fr;
                    $dd = ($fr + $des) * $row2["cantidad_serv"];

                    $to_serv = $to_serv + $dd + $row2["precio_accesorios"];

                    $table2 = $table2 . '<tr>'
                            . '<td width="5%" style="font-size:8px;"  align="center">' . $total2 . '</td>'
                            . '<td width="10%" style="font-size:8px;"  align="center" >' . $row2['id_ref_mo'] . '</td>'
                            //. '<td width="40%" style="font-size:8px; "  align="center">' . $row2['descripcion_mo'] . '</td>'
                            . '<td width="40%" style="font-size:8px; "  align="center">' . $row2['observaciones'] . '</td>'
                            . '<td width="10%" style="font-size:8px;"   align="center">' . $row2["referencia"] . '</td>'
                            . '<td width="10%" style="font-size:8px;" align="center">N/A</td>'
                            . '<td width="10%" style="font-size:8px; "  align="center">' . $row2["cantidad_serv"] . '</td>'
                            . '<td width="10%" style="font-size:8px;"   align="center">' . number_format(($dd ) / $row2["cantidad_serv"]) . '</td>'
                            . '<td width="10%" style="font-size:8px;"   align="center" >' . number_format(($dd)) . '</td>'
                            . '<td width="10%" style="font-size:8px;"   align="center" >' . number_format(($row2["precio_accesorios"])) . '</td>'
                            . '<td width="10%" style="font-size:8px;"   align="center" >' . number_format(($dd + $row2["precio_accesorios"])) . '</td>'
                            . '</tr>';
                }
                $table2 = $table2 . '</table>';


                echo 'Servicios<hr>';
                echo $table2 . '<hr>';
                //echo '<h5><p align="right">TOTAL SERV.: $<strong>' . number_format($to_serv) . '</strong></h5></p>';
				echo "<br>";
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL SERV.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($to_serv) . '</td></tr>'
                . '</table><br>';
            } else {
                $to_serv = 0;
            }

//----------------------------------------fin servicios--------------------------------------------
//---------------------------------suministros-----------------------------------------

            $request3 = mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=" . $_GET['cot'] . " ");

            if ($ccv != 0) {
//    echo'<hr>';
                $table2 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0" width="100%">';
                $table2 = $table2 . '<thead >';
                $table2 = $table2 . '<tr BGCOLOR="#13173B">';
                $table2 = $table2 . '<th width="5%" style="font-size:8px; color:white">' . 'ITEMS' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'CODIGO' . '</th>';
                $table2 = $table2 . '<th width="40%" style="font-size:8px; color:white">' . 'DESCRIPCION DE LOS MATERIALES' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'REFERENCIA' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'MEDIDA' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'CANTIDAD' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'VLR UND.' . '</th>';
                $table2 = $table2 . '<th width="10%" style="font-size:8px; color:white">' . 'V. TOTAL' . '</th>';
                $table2 = $table2 . '</tr>';
                $table2 = $table2 . '</thead>';


                //Por cada resultado pintamos una linea
                $total2 = 0;
                $to_mat = 0;
                while ($row21 = mysql_fetch_array($request3)) {
                    $acc_porv = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='Aluminio' and division='Venta'";
                    $fipav =mysql_fetch_array(mysql_query($acc_porv));
                    $porcven= $fipav["p"]/100; 
             
                    $acc_por = "SELECT (" . $row21['pe'] . ") as p FROM porcentajes where area_por='MP' and grupo='" . $row21["grupo"] . "'";
                    $fipa = mysql_fetch_array(mysql_query($acc_por));
                    $porcacc = $fipa["p"] / 100;
                    $total2 = $total2 + 1;
                    if ($row21['med'] == 1) {
                        $mt = 1;
                    } else {

                        $mt = ($row21['med'] / 1000);
                    }
                    $au = (100 - $row21['aumento']) / 100;
                    $prt3 = $row21["costo_mt"] / $au;
                    $desm = ($row21['descuento_mat'] / 100) * ($prt3 * $mt);
                    $ddm = (((($prt3 * $mt) + $desm) * $row21["cantidad_mat"]) / $porcacc)/$porcven;
                    $to_mat = $to_mat + $row21["valor_neto"];
                    if ($row21['color_ma'] == '') {
                        $cm = '';
                    } else {
                        $cm = 'Color: ' . $row21['color_ma'];
                    }

                    $table2 = $table2 . '<tr><td width="5%" style="font-size:10px;" align="center">' . $total2 . '</a></td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . $row21['codigo'] . '</font></td>'
                            . '<td width="40%" style="font-size:8px;" align="left">' . $row21['descripcion'] . ' ' . $cm . '</font></td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . $row21["referencia"] . '<font></a></td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . $row21["med"] . '</td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . $row21["cantidad_mat"] . '</td>'
                            . '<td width="10%" style="font-size:8px;" align="center">$' . number_format($row21["valor_neto"] / $row21["cantidad_mat"]) . '</td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . number_format($row21["valor_neto"]) . '</td>'
                            . '</tr>';
                }
                $table2 = $table2 . '</table>';
                echo 'Suministros/Instalación<hr>';
                echo $table2;


                //echo '<h5><p align="right">TOTAL SUMINISTROS.: $<strong>' . number_format($to_mat) . '</strong></p></h5>';
                echo "<br>";
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL SUMINISTROS.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($to_mat) . '</td></tr>'
                . '</table><br>';
            } else {
                $to_mat = 0;
            }

//--------------------------------fin de suministro------------------------------------
//-----------------------------------kit-----------------------------------------------

            $request4 = mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=" . $_GET['cot'] . " and b.comp='0' ");


            if ($ckv != 0) {
//    echo'<hr>';
                $table4 = '<table  class="estilo2" border="1"  cellpadding="0" cellspacing="0">';
                $table4 = $table4 . '<thead >';
                $table4 = $table4 . '<tr BGCOLOR="#13173B">';
                $table4 = $table4 . '<th width="5%" style="font-size:8px; color:white">' . 'ITEMS' . '</th>';
                $table4 = $table4 . '<th width="10%" style="font-size:8px; color:white">' . 'CODIGO' . '</th>';
                $table4 = $table4 . '<th width="40%" style="font-size:8px; color:white">' . 'DESCRIPCION DEL KIT' . '</th>';
                $table4 = $table4 . '<th width="10%" style="font-size:8px; color:white">' . 'REFERENCIA' . '</th>';
                $table4 = $table4 . '<th width="10%" style="font-size:8px; color:white">' . 'MEDIDA' . '</th>';
                $table4 = $table4 . '<th width="10%" style="font-size:8px; color:white">' . 'CANTIDAD' . '</th>';
                $table4 = $table4 . '<th width="10%" style="font-size:8px; color:white">' . 'VLR. UND.' . '</th>';
                $table4 = $table4 . '<th width="10%" style="font-size:8px; color:white">' . 'V. TOTAL' . '</th>';
                $table4 = $table4 . '</tr>';
                $table4 = $table4 . '</thead>';


                //Por cada resultado pintamos una linea
                $t2e = 0;
                $to_k = 0;



                while ($row21k = mysql_fetch_array($request4)) {
                    $acc_por = "SELECT (" . $row21k['por_k'] . ") as p FROM porcentajes where area_por='" . $row21k["linea"] . "'";
                    $fipa = mysql_fetch_array(mysql_query($acc_por));
                    $porcacc = $fipa["p"] / 100;
                    $t2e = $t2e + 1;
                    include '../modelo/suma_kit.php';

                    $desm = ($row21k['desc_k'] / 100) * ($totk);
                    $ddm = ((($totk) + $desm)) / $porcacc;
                    $to_k = $to_k + $ddm;
                    if ($row21k['color_k'] == '') {
                        $ck = '';
                    } else {
                        $ck = 'Color: ' . $row21k['color_k'];
                    }

                    $table4 = $table4 . '<tr><td width="5%" style="font-size:8px;" align="center">' . $t2e . '</a></td>'
                            . '<td  width="10%" style="font-size:8px;" align="center">' . $row21k['codigo'] . '</font></td>'
                            . '<td  width="40%" style="font-size:8px;" align="center">' . $row21k['producto'] . ' ' . $ck . '</font></td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . $row21k["referencia_p"] . '<font></a></td>
                        <td  width="10%" style="font-size:8px;" align="center">N/A</td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . $row21k["cantidad_k"] . '</td>'
                            . '<td  width="10%" style="font-size:8px;" align="center">$' . number_format($ddm / $row21k["cantidad_k"]) . '</td>'
                            . '<td width="10%" style="font-size:8px;" align="center">' . number_format($ddm) . '</td>'
                            . '</tr>';
                }
                $table4 = $table4 . '</table>';
                echo 'Kit de Accesorios<hr>';
                echo $table4;
                //echo '<div align="right"><h5>TOTAL KIT.: $' . number_format($to_k) . '</h5></div>';
                echo "<br>";
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL KIT.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($to_k) . '</td></tr>'
                . '</table><br>';
            } else {
                $to_k = 0;
            }


//---------------------------------fin kit---------------------------------------------

            $ff = $to_serv + $to_mat + $to_k + (($tad) - $des);
            $iva = $ff * ($sel_iva/100);
            if ($ft != 0) {
            	echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($to_serv + $to_mat + $to_k + (($tad) - $des)) . '</td></tr>'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">IVA '.$sel_iva.'%: $<td  align="right" width="100px" style="font-size:80%;color:white;">' . number_format($iva) . '</td></tr>'
                . ''
                . '</table><br><br>';
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($ff + $iva) . '</td></tr>'
                . '</table><br>';
            }


            echo '<div class="saltopagina"></div>';
        }
         $query = mysql_query("select texto_pol from politicas where id_pol=1 ");
                    $p = mysql_fetch_row($query);
         $textos = $p[0];
        echo '<div class="saltopagina"></div>';
        tabla();
        echo '<p align="justify" style="font-size:9px">' . $textos . '</p><br><br>';
        echo '_______________________________  ' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . '_______________________________<br> ';
        echo 'Firma del Asesor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma cliente<br>';
        echo 'C.C.';
        $pag2 = $pag + 1;

        echo '<br><br><footer>
        <div class="define">
            <p>TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - cotizacion@templadosa.com<br>Pág ' . $pag2 . '</p>
        </div>
    </footer>';
        ?>
        <h5></h5>&nbsp;

    </body>
</html>