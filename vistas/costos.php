<!DOCTYPE html>
	<?php
		include '../modelo/conexion.php';
		if (isset($_GET['cot'])) {
			$request = mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND c.id_cot = " . $_GET["cot"] . " ORDER BY c.fila ASC");     
			if ($request) {
				$strConsulta3 = "SELECT * FROM cotizacion WHERE id_cot = '" . $_GET['cot'] . "'";
				$pacientes3 = mysql_query($strConsulta3);
				$fila3 = mysql_fetch_array($pacientes3);
				$strConsulta3 = "SELECT * FROM cont_terceros WHERE id_ter = " . $fila3['id_tercero'] . "";
				$empresa = mysql_query($strConsulta3);
				$filae = mysql_fetch_array($empresa);
				$nombre = $filae['nom_ter'];
				$documento = $filae['cod_ter'];
				$telefono = $filae['telfijo_ter'];
				$direccion = $filae['dir_ter'];
				if ($fila3['orden'] == '0') {
					$abc = 'COTIZACION No. : ';
					$num = $fila3['numero_cotizacion'] . ' - V.' . $fila3['version'];
				} else {
					$abc = 'PEDIDO No. :';
					$num = $fila3['orden'];
				}
			}
	?>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        	<title>UTILIDAD DE LA COTIZACIÓN No. <?php echo $num; ?></title>
			<style type="text/css">
				footer {
					position: relative;
					/* Altura total del footer en px con valor negativo */
					margin-top: 1px;
					/* Altura del footer en px. Se han restado los 5px del margen
					superior mas los 5px del margen inferior*/
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
				llegan hasta los limites del navegador.*/
				.define {
					width:960px;
					margin:0 auto;
				}
				@media all {
					div.saltopagina {
						display: none;
					}
				}
				@media print {
					div.saltopagina {
						display:block;
						page-break-before:always;
					}
				}
				.estilo1 {
					font-family: Arial;
					font-size: 7px;
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
				td.estilo2 {
					
				}
				.estilo2 {
					font-family: Arial;
					font-size: 14px;
					color: #000000;
				}
				th.estilo2 {
					font-size: 10px;
				}
				#piedepagina {
					width:800px;
					position: absolute;
					bottom: 0 !important;
					bottom: -1px;
				}
			</style>
		</head>
		<body onload="window.print()">        
			<?php
				function tabla() {
					$request = mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND c.id_cot = " . $_GET["cot"]. " ORDER BY c.tip ASC");
					date_default_timezone_set("America/Bogota");
					$hora = date('h:i:s',time() - 3600 * date('I'));
					if ($request) {
						$strConsulta3 = "SELECT * FROM cotizacion WHERE id_cot = '" . $_GET['cot'] . "'";
						$pacientes3 = mysql_query($strConsulta3);
						$fila3 = mysql_fetch_array($pacientes3);
						$strConsulta3 = "SELECT * FROM cont_terceros WHERE id_ter = " . $fila3['id_tercero'] . "";
						$empresa = mysql_query($strConsulta3);
						$filae = mysql_fetch_array($empresa);
						$nombre = $filae['nom_ter'];
						$documento = $filae['cod_ter'];
						$telefono = $filae['telfijo_ter'];
						$direccion = $filae['dir_ter'];
						if ($fila3['orden'] == '0') {
							$abc = 'COT. No. : ';
							$num = $fila3['numero_cotizacion'] . ' - V.' . $fila3['version'];
						} else {
							$abc = 'PED No. :';
							$num = $fila3['orden'];
						}
					}
			?>
			<table class="estilo1" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td rowspan="9" style="margin:15px; padding:15px; color:white;" width="50%">
						<img src="../imagenes/logo2.png" width="200" height="80">
					</td>
					<th align=left style="color:white;">.</th>
					<td width="25%" style="color:white;">.</td>
					<th align=left style="color:white;">.</th>
					<td width="25%" style="color:white;">.</td>
				</tr>
				<tr>
					<th align=left>CLIENTE:</th>
					<td width="25%"><?php echo $nombre; ?></td>
					<th align=left><?php echo $abc; ?></th>
					<td width="25%"><?php echo $num; ?></td>
				</tr>
				<tr>
					<th align=left>C.C ó NIT:</th>
					<td width="20%"><?php echo $documento; ?></td>
					<th align=left>CONTACTO:</th>
					<td width="15%"><?php echo $fila3['responsable']; ?></td>
				</tr>
				<tr>
					<th align=left>OBRA:</th>
					<td width="20%"><?php echo $fila3['obra']; ?></td>
					<th align=left>ASESOR:</th>
					<td width="15%"><?php echo $fila3['registrado']; ?></td>
				</tr>
				<tr>
					<th align=left>DIRECCION:</th>
					<td width="20%"><?php echo $fila3['ubicacion']; ?></td>
					<th align=left>VALIDEZ:</th>
					<td width="15%"><?php echo '120 dias'; ?></td>
				</tr>
				<tr>
					<th align=left>TELEFONO:</th>
					<td width="25%"><?php echo $fila3['tel_responsable']; ?></td>
					<th align=left>PAGO:</th>
					<td><?php echo $fila3['pago']; ?></td>
				</tr>
				<tr>
					<th align=left>IMPRESION:</th>
					<td><?php echo date('Y-m-d') . ' ' . $hora; ?></td>
					<th align=left>REGISTRO:</th>
					<td><?php echo $fila3['fecha_reg_c']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php ?></td>
				</tr>
				<tr>
					<th align=left>CIUDAD: </th>
					<td><?php echo $fila3['municipio'] . ' - ' . $fila3['ciudad']; ?></td>
					<th align=left></th>
					<td></td>
				</tr>
				<tr>
					<th align=left style="color:white;">.</th>
					<td width="25%" style="color:white;">.</td>
					<th align=left style="color:white">.</th>
					<td width="25%" style="color:white;">.</td>
				</tr>
			</table>
			<?php
			}
			?>
			<?php
				//Por cada resultado pintamos una linea
				$total2 = 0;
				$tad = 0;
				$tad3 = 0;
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
				$CT = 0;
				$port = 0;
				while ($row = mysql_fetch_array($request)) {
					if ($cont == $a1 || $cont == $a2 || $cont == $a3 || $cont == $a4 || $cont == $aa5 || $cont == $aa6 || $cont == $aa7 || $cont == $aa8 || $cont == $aa9 || $cont == $aa10 ||
						$cont == $aa11 || $cont == $aa12 || $cont == $aa13 || $cont == $aa14 || $cont == $aa15 || $cont == $aa16 || $cont == $aa17 || $cont == $aa18 || $cont == $aa19 ||
						$cont == $aa20 || $cont == $aa21) {
						$pag += 1;
						//echo '<fieldset style="height:670px;">';
						tabla();
						$table3 = '<table border="1" class="estilo2">';
						$table3 = $table3 . '<thead >';
						$table3 = $table3 . '<tr BGCOLOR="#13173B">';
						$table3 = $table3 . '<th width="4%" style="font-size:8px; color:white">' . 'TIPO' . '</h6></th>';
						$table3 = $table3 . '<th width="23%" style="font-size:8px; color:white">' . 'DESCRIPCION' . '</th>';
						$table3 = $table3 . '<th width="8%" style="font-size:8px; color:white">' . 'VIDRIO' . '</th>';
						$table3 = $table3 . '<th width="8%" style="font-size:8px; color:white">' . 'ANCHO X ALTO' . '</th>';
						$table3 = $table3 . '<th width="3%" style="font-size:8px; color:white">' . 'UND' . '</th>';
						$table3 = $table3 . '<th width="7%" style="font-size:8px; color:white">' . 'COSTO UND PRESUPUESTO' . '</th>';
						$table3 = $table3 . '<th width="7%" style="font-size:8px; color:white">' . 'VLR VENTA UND.' . '</th>';
						$table3 = $table3 . '<th width="8%" style="font-size:8px; color:white">' . 'VLR COSTO T. PRESUPUESTADO.' . '</th>';
						$table3 = $table3 . '<th width="10%" style="font-size:8px; color:white">' . 'V.TOTAL VENTAS' . '</th>';
						$table3 = $table3 . '<th width="7%" style="font-size:8px; color:white">' . 'UTILIDAD' . '</th>';
						$table3 = $table3 . '<th width="7%" style="font-size:8px; color:white">' . '% UTILIDAD' . '</th>';
						$table3 = $table3 . '</tr>';
						$table3 = $table3 . '</thead>';
					} else {
						$table3 = '<table border="1" class="estilo2">';
					}
					$cons_vi = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $row['id_vidrio'] . " ";
					$fv = mysql_fetch_array(mysql_query($cons_vi));
					$cons_vi2 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " .$row['id2_vidrio'] . " ";
					$fv22 = mysql_fetch_array(mysql_query($cons_vi2));
					$cons_vi3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $row['id3_vidrio'] . " ";
					$fv3 = mysql_fetch_array(mysql_query($cons_vi3));
					$cons_vi4 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $row['id4_vidrio'] . " ";
					$fv4 = mysql_fetch_array(mysql_query($cons_vi4));
					$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = '" . $row["linea_cot"] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$mult = $fi3["p"] / 100;
					$comp = mysql_query("SELECT COUNT(*) FROM producto a, cotizaciones_sub c, tipo_vidrio d WHERE d.id_vidrio = c.id_vidrio_sub AND c.id_referencia_sub = a.id_p AND c.id_cot_sub = " . $_GET["cot"] . " AND c.id_producto_cot = " . $row["id_cotizacion"] . "");
					$cm2 = mysql_fetch_array($comp);
					$d = $cm2['COUNT(*)'];
					$ac = mysql_query("SELECT COUNT(*) FROM referencia_acce a, referencias b WHERE a.num_ref = b.id_referencia AND a.cotizacion = " . $_GET['cot'] . " AND a.id_cot = " . $row["id_cotizacion"] . "");
					$cm = mysql_fetch_array($ac);
					$mt = $cm['COUNT(*)'];
					$t = $d + $mt;
					if ($row["linea_cot"] == 'Vidrio') {
						if ($row["boq"] == 0) {
							$d1 = '';
						} else {
							$d1 = 'Per: ' . $row["per"] . '<br>Boq: ' . $row["boq"];
						}
					} else {
						$d1 = 'Color Alum: ' . $row["color_ta"] . '';
					}
					if ($row["cuerpo"] != 0) {
						$m = 'Cuerpo Fijo: ' . $row["cuerpo"] . ' mm';
					} else {
						$m = '';
					}
					$compu = mysql_query("SELECT * FROM cotizaciones_sub c WHERE id_cot_sub = " . $_GET["cot"] . " AND id_producto_cot = " . $row["id_cotizacion"] . "");
					$costo_sp = 0;
					$costo_fom_sp = 0;
					$costo_mp = 0;
					$costo_fom_mp = 0;
					$c = '';
					$mc = '';
					$img2 = '';
					while ($fila = mysql_fetch_array($compu)) {
						if ($fila["ruta"] == '') {
							$img3 = '<img src="../producto/no.jpg" width="60" heigth="40">';
						} else {
							$img3 = '<img src="../adicionales/' . $fila["ruta"] . '" width="60" heigth="40">';
						}
						if (isset($fila['producto'])) {
							$c = $c . ', + : ' . $fila['producto'];
							$mc = $mc . '<br>' . $fila['ancho_c_sub'] . ' x ' . $fila['alto_c_sub'];
							$img2 = $img2 . '<br>' . $img3;
						} else {
							$c = $c . '';
							$mc = $mc . '';
							$img2 = $img2 . '';
						}
						$costo_sp += $fila['valor_sp'] ;
						$costo_fom_sp += $fila['valor_fom_sp'] ;
						$costo_mp += $fila['valor_c_sub'] ;
						$costo_fom_mp += $fila['valor_fom_sub'] ;
					}
					$pad = (($row["precio_adicional"] * $row["cantidad_c"]));
					$tk = ($row["precio_material"]) * $row["cantidad_c"];
					$an = ($row["valor_c"] / $mult) + $pad + $tk;
					$pad2 = (($costo_mp * $row["cantidad_c"]));
					$tk2 = ($row["precio_fom_sp"]) * $row["cantidad_c"];
					$total_conp = (($row["valor_c"] + $tk2)) + $pad2;
					$pu = ($an / $row["cantidad_c"]);
					$descpor = $pu * $row["desc"] / 100;
					$pud = $pu + $descpor;
					$descuento_g = ($row["descuento_g"] / 100) * $pud;
					$pudt = $pud - $descuento_g;
					$ptt2 = ($pudt) * $row["cantidad_c"];
					$tad = $tad + $ptt2;
					if ($row["imagen_mas"] != '') {
						$fi = '../adicionales/' . $row["imagen_mas"];
						list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
						if ($row["an"] == 0) {
							$pi1 = $ancho;
						} else {
							$pi1 = $row["an"];
						}
						$img = '<img src="../adicionales/' . $row["imagen_mas"] . '" width="' . $pi1 . 'px">';
					} else {
						if ($row["imagen"] == 'Derecho') {
							if ($row["ruta"] == '') {
								$img = '<img src="../producto/no.jpg" width="35px" heigth="35px">';
							} else {
								$fi = '../producto/' . $row["ruta"];
								list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
								if ($row["an"] == 0) {
									$pi1 = $ancho;
								} else {
									$pi1= $row["an"];
								}
								$img = '<img src="../producto/' . $row["ruta"] . '" width="' . $pi1 . 'px">';
							}
						} else {
							if ($row["ruta"] == '') {
								$img = '<img src="../producto/no.jpg" width="35px" heigth="30px">';
							} else {
								$fi = '../producto/' . $row["ruta2"];
								list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
								if ($row["an"] == 0) {
									$pi1 = $ancho;
								} else {
									$pi1 = $row["an"];
								}
								$img = '<img src="../producto/' . $row["ruta2"] . '" width="' . $pi1 . 'px">';
							}
						}
					}
					$con2 = "SELECT * FROM `producto` WHERE id_p = " . $row['traz_vid'] . " ";
					$res2 = mysql_query($con2);
					while ($f8 = mysql_fetch_array($res2)) {
						$idco = $f8['id_p'];
						$nombr = $f8['producto'];
					}
					if ($row['traz_vid2'] == 0) {
						$nombr2='';
					} else {
						$con22 = "SELECT * FROM `producto` WHERE id_p = " . $row['traz_vid2'] . " ";
						$res22 = mysql_query($con22);
						while ($f8 = mysql_fetch_array($res22)) {
							$idco2 = $f8['id_p'];
							$nombr2 = $f8['producto'];
						}
					}
					if ($row['traz_vid3'] == 0) {
						$nombr3 = '';
					} else {
						$con23 = "SELECT * FROM `producto` WHERE id_p = " . $row['traz_vid3'] . " ";
						$res23 = mysql_query($con23);
						while ($f8 = mysql_fetch_array($res23)) {
							$idco3 = $f8['id_p'];
							$nombr3 = $f8['producto'];
						}
					}
					if ($row['traz_vid4'] == 0) {
						$nombr4 = '';
					} else {
						$con24 = "SELECT * FROM `producto` WHERE id_p = " . $row['traz_vid4'] . " ";
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
						$kk = $mt2 * $fv['espesor_v'] * 2.5;
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
					$cons_vi2 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $row['id_vidrio2'] . " ";
					$fv2 = mysql_fetch_array(mysql_query($cons_vi2));
					if ($fv2 == '') {
						$seg = '';
					} else {
						$seg = '.<br>Lam 2. ' . $fv2["color_v"] . '' . $res;
					}
					$vv = '' . $fv["color_v"] . ' ' . $res . '<br>' . $fv22["color_v"] . ' ' . $res2 . ' ';
					$c = '';
					$mc = '';
					$img2 = '';
					$suma_spt = ($costo_sp + $row['valor_costob']) * $row["cantidad_c"];
					if ($row['install'] == 'Si') {
						$v = '<br><b>(Suministro e Instalación)</b>';//16004
					} else {
						$v = '<br><b>(Suministro)</b>';
					}
					$mas_porc = ($row['valor_c_sp'] + $suma_spt);
					if ($row["cierre"] == 'No') {
						$cierre = '';
					} else {
						$cierre = ' , Cierre: ' . $row["cierre"] . '';
					}
					$CT = $CT + ($total_conp);
					$COS = ($total_conp / $row["cantidad_c"]);
					$POR = (($ptt2 - $total_conp) / $ptt2) * 100;
					$port += $POR;
					$table3 = $table3 . '<tr>'
										. '<td width="4%"  height="20" style="font-size:8px"><p align="center">' . $row['tip'] . '</p></td>
										<td width="23%" style="font-size:8px"><p align="justify">' . $row['producto'] . ', ' . $m . ', ' . $d1 . ', ' . $row['observaciones'] . ', Cierre: ' . $row["cierre"] . '' . $c . ' ' . $v . '<br>Observaciones: ' . $row['observaciones2'] . '</p></td>'
										. '<td width="8%" style="font-size:8px"><p align="center">' . $vv . '</p></td>
										<td width="8%" style="font-size:8px"><p align="center">' . $row["ancho_c"] . ' x ' . $row["alto_c"] . '' . $mc . '</p></td>'
										. ''
										. '<td width="3%" style="font-size:8px"><p align="center">' . $row["cantidad_c"] . '</p></h6></td>
										<td width="7%" style="font-size:8px"><p align="center">$ ' . number_format($COS) . '</p></td>'
										. '<td width="7%" style="font-size:8px"><p align="center">$ ' . number_format($ptt2 / $row["cantidad_c"]) . '</p></td>'
										. '<td width="8%" style="font-size:8px"><p align="center">$ ' . number_format($total_conp) . '</p></td>'
										. '<td width="10%" style="font-size:8px"><p align="center">$ ' . number_format($ptt2) . '</p></td>'
										. '<td width="7%" style="font-size:8px"><p align="center">$ ' . number_format($ptt2 - $total_conp) . '</p></td>'
										. '<td width="7%" style="font-size:8px"><p align="center">' . number_format($POR) . '%</p></td></tr></div>';
					$table3 = $table3.'</table>';
					echo $table3;
					$cont = $cont + 1;      
					if ($cont == $a1 || $cont == $a2 || $cont == $a3 || $cont == $a4 || $cont == $aa5 || $cont == $aa6 || $cont == $aa7 || $cont == $aa8 || $cont == $aa9 || $cont == $aa10 ||
						$cont == $aa11 || $cont == $aa12 || $cont == $aa13 || $cont == $aa14 || $cont == $aa15 || $cont == $aa16 || $cont == $aa17 || $cont == $aa18 || $cont == $aa19 ||
						$cont == $aa20 || $cont == $aa21) {
						echo '<div class="saltopagina"></div>';
					}
				}
				if ($cont != 0) {
					$iva = $tad * 0.16;
					$iva2 = $CT * 0.16;
				}
				$porce = (($tad - $CT) / $tad) * 100;
				echo '<table align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
						. '<tr BGCOLOR="#13173B">'
							. '<td style="font-size:80%;color:white;" width="180px" align="right">'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">VLR COSTO</td>'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">VLR TOTAL VENTAS</td>'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">UTILIDAD</td>'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">% UTILIDAD</td>'
						. '</tr>'
						. '<tr BGCOLOR="#13173B">'
							. '<td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $ '
							. '<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($CT) . '</td>'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($tad) . '</td>'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($tad - $CT) . '</td>'
							. '<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($porce) . ' %</td>'
						. '</tr>'
					. '</table><br>';
			}
			?>
			<h5></h5>&nbsp;
		</body>
	</html>