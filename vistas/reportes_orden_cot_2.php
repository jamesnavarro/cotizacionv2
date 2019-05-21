<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=movimientos.xls");
?>

<?php 
 include '../modelo/conexion.php';
  if(isset($_GET['cot'])){
 $sql21 = "SELECT * FROM cotizacion where id_cot=".$_GET['cot'];
            $fila21 =mysql_fetch_array(mysql_query($sql21));
             $numero_cotizacion= $fila21["numero_cotizacion"];
            $id= $fila21["id_cot"];
            $obra= $fila21["obra"];
            $ubicacion= $fila21["ubicacion"];   $pago= $fila21["pago"];
            $linea= $fila21["linea"];
            $orden_p= $fila21["orden"]; $version= $fila21["version"];
            $estado= $fila21["estado"];
            $id_cliente= $fila21["id_tercero"];
            $asesor= $fila21["registrado"];
            $responsable= $fila21["responsable"];
             $tel_responsable= $fila21["tel_responsable"];
              $ciudad= $fila21["municipio"].' - '.$fila21["ciudad"];
              $mu= $fila21["municipio"];
              $ci= $fila21["ciudad"];$grabado= $fila21["grabado"];
              $costo_total= $fila21["costo_total"];
              $costo_instalacion= $fila21["costo_instalacion"];
              $validez= $fila21["validez"];
              $cod_temp=$fila21["cod_temp"];
              $nom_temp=$fila21["nom_temp"];
              $sel_iva=$fila21["sel_iva"];
              $descuento= $fila21["descuento"];$nota= $fila21["nota"];
              $fecha= $fila21["fecha_reg_c"];$tipo= $fila21["tipo"];$pre= $fila21["presupuesto"];


        
 }
	$alb = 0;
	$pesototal = 0;
	$totalvxx = 0;
	$totalvxxsp = 0;
	$mano_obra = array();
	$sw = 0;
	$i = 0;
	$table2 = "";
    $request1=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE id_compuesto=0 and c.id_referencia = a.id_p AND c.id_cot = '" . $_GET['cot'] . "' ORDER BY c.fila ASC");
	if($request1){
		$table = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
		$table = $table . '<thead >';
		$query_columnas_mano_obra = mysql_query("SELECT DISTINCT(c.referencia) FROM producto a, producto_rep_mo b, referencia_mo c, cotizaciones d WHERE b.id_ref_mo = c.id_ref_mo AND a.id_p = b.id_p AND d.id_referencia = a.id_p AND d.id_cot = " . $_GET['cot'] . " ORDER BY c.referencia");
		while ($row_columnas_mano_obra = mysql_fetch_assoc($query_columnas_mano_obra)) {
			if ($row_columnas_mano_obra['referencia'] == '26002') {
				if ($sw == 0) {
					$table2 = $table2 . '<th class="hidden-phone">' . 'Pelicula Protectora' . '</th>';
					$sw = 1;
					$i = $i + 1;
					$mano_obra[] = $row_columnas_mano_obra['referencia'];
				}
			} else {
				$table2 = $table2 . '<th class="hidden-phone">' . $row_columnas_mano_obra['referencia'] . '</th>';
				$i = $i + 1;
				$mano_obra[] = $row_columnas_mano_obra['referencia'];
			}
		}
		$colspan = 24 + $i;
		$table = $table . '<tr BGCOLOR="#4E8CCF"><td colspan="' . $colspan . '" align="center">Descripci�n De Productos</td></tr>'
						. '<tr bgcolor="#D1EEF0">';
		$table = $table . '<th width="2%">' . 'Tipo' . '</th>';
		$table = $table . '<th width="2%">' . '#' . '</th>';
		$table = $table . '<th width="25%">' . 'Producto' . '</th>';
		$table = $table . '<th width="7%">' . 'Ref' . '</th>';
		$table = $table . '<th width="9%">' . 'Color Vid.' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Ancho (mm)' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Alto (mm)' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Cant. Total' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Costo Lista' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Costo Contable' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Precio Und.' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Precio Desc.' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Precio Und. Total' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Precio Total' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Total + Iva.' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'PV.' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'PM.' . '</th>';
		$table = $table . '<th class="hidden-phone">' . '%' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Aluminio' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Vidrio' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Rejillas' . '</th>';
		$table = $table . '<th class="hidden-phone">' . 'Accesorios' . '</th>';
		//$table = $table . '<th class="hidden-phone">' . 'Gastos Maquinaria' . '</th>';
		$table = $table . $table2;
		//$table = $table . '<th class="hidden-phone">' . 'Pelicula Protectora' . '</th>'; //CONSULTAR CUANTAS MANOS DE OBRA HAY Y COLOCARAS EN COLUMNAS
		//$table = $table . '<th class="hidden-phone">' . 'MOF' . '</th>'; //CONSULTAR CUANTAS MANOS DE OBRA HAY Y COLOCARAS EN COLUMNAS
		//$table = $table . '<th class="hidden-phone">' . 'MOF' . '</th>'; //CONSULTAR CUANTAS MANOS DE OBRA HAY Y COLOCARAS EN COLUMNAS
		//$table = $table . '<th class="hidden-phone">' . 'MOI' . '</th>'; //CONSULTAR CUANTAS MANOS DE OBRA HAY Y COLOCARAS EN COLUMNAS
		//$table = $table . '<th class="hidden-phone">' . 'Administrativos' . '</th>';
		$table = $table . '</tr>';
		$table = $table . '</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while ($row = mysql_fetch_array($request1)) {
		//****TOTALIZADOR DE ALUMINIO****\\
                
		$sql = 'SELECT * FROM producto WHERE id_p = "' . $row['id_p'] . ' "';
		$fil = mysql_fetch_array(mysql_query($sql));
		$id_p = $fil["id_p"];
		$producto = $fil["producto"];
		$tipo = $fil["linea"];
		$codigo = $fil["codigo"];
		$tipo_v = $fil["tipo_vidrio"];
		$color_a = $fil["color_alu"];
		$ancho = $row["ancho_c"];
		$aa = $row["ancho_abajo"];
		$kaltt = $row["ancho_c"];
		$kancc = $row["ancho_abajo"];
		$alto = $row["alto_c"];
		$altura = $row["cuerpo"];
		$anchura = $row["lado"];
		$altura_ventana = $row["alto_c"] - $row["cuerpo"];
		$anchura_ventana = $row["ancho_c"] - $row["lado"];
		
		if ($row["imagen"] == 'Derecho') {
			$ruta = $fil["ruta"];
		} else {
			$ruta = $fil["ruta2"];
		}
		$sql45 = 'SELECT * FROM cotizaciones a, cotizacion b WHERE a.id_cot = b.id_cot AND a.id_cotizacion = "' . $row['id_cotizacion'] . '"';
		$rf5 = mysql_fetch_array(mysql_query($sql45));
		$rf5['color_ta'];
		$rf5['pelicula'];
		$rf5['id_dolar'];
		$alum_porr = "SELECT * FROM tipo_aluminio WHERE color_a = '" . $rf5['color_ta'] . "'";
		$fia4 = mysql_fetch_array(mysql_query($alum_porr));
		$vc = $fia4["costo_a"]/100;
		$sql2 = 'SELECT * FROM tipo_vidrio WHERE id_vidrio = "' . $row["id_vidrio"] . '"';
		$fil2 = mysql_fetch_array(mysql_query($sql2));
		$costo_v = $fil2["costo_v"];
		$total_pr = ((($row["ancho_c"] / 1000) + ($row["alto_c"] / 1000)) * $costo_v) * $row["cantidad_c"];
		
		$alum_por = "SELECT (".$row['porcentaje_mp'].") AS p FROM porcentajes WHERE area_por = 'MP' AND grupo = 'Perfileria'";
		$fia = mysql_fetch_array(mysql_query($alum_por));
		$porca = $fia["p"] / 100;
		$alum_porBOG = "SELECT (".$row['porcentaje_mp'].") AS p FROM porcentajes WHERE area_por = 'MPB' AND grupo = 'Perfileria'";
		$fiaB = mysql_fetch_array(mysql_query($alum_porBOG));
		$porcaB = $fiaB["p"] / 100;
		
		$query_total_aluminio = mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia and a.id_p = b.id_p and a.id_p = " . $row['id_p']);
		$ta = 0;
		$ptt = 0;
		$tafom = 0;
		$vr1 = 0;
		$vr2 = 0;
		$vr3 = 0;
		$vr4 = 0;
		$vr5 = 0;
		$vr6 = 0;
		$vr7 = 0;
		$vr8 = 0;
		while ($row_total_aluminio = mysql_fetch_assoc($query_total_aluminio)) {
			$pdlr = "SELECT * FROM dolar_relaciones WHERE id_referencia = " . $row_total_aluminio['id_referencia'] . " AND id_dolar = " . $row['id_dolar'] . " ";
			$fia = mysql_fetch_array(mysql_query($pdlr));
			$precio_actual = $fia["precio_actual"];
			$precio_actual_fom = $fia["precio_act_fom"];
			if ($row_total_aluminio['signo'] == '+') {
				if ($row_total_aluminio['medida_r_a'] == 1) {
					$al = ($altura_ventana + $row_total_aluminio["descuento"]) + $row_total_aluminio['variable'];
				} else {
					if ($row_total_aluminio['medida_r_a'] == 2) {
						$al = ($altura + $row_total_aluminio["descuento"]) + $row_total_aluminio['variable'];
					} else {
						if ($row_total_aluminio['medida_r_a'] == 3) {
							$al = ($anchura + $row_total_aluminio["descuento"]) + $row_total_aluminio['variable'];
						} else {
							if ($row_total_aluminio['medida_r_a'] == 4) {
								$al = ($anchura_ventana + $row_total_aluminio["descuento"]) + $row_total_aluminio['variable'];
							} else {
								if ($row_total_aluminio['lado'] != "Vertical") {
									$al = ($row['ancho_c'] + $row_total_aluminio["descuento"]) + $row_total_aluminio['variable'];
								} else {
									$al = ($row['alto_c'] + $row_total_aluminio["descuento"]) + $row_total_aluminio['variable'];
								}
							}
						}
					}
                }
			} else {
				if ($row_total_aluminio['signo'] == '-') {
					if ($row_total_aluminio['medida_r_a'] == 1) {
						$al = ($altura_ventana + $row_total_aluminio["descuento"]) - $row_total_aluminio['variable'];
					} else {
						if ($row_total_aluminio['medida_r_a'] == 2) {
							$al = ($altura + $row_total_aluminio["descuento"]) - $row_total_aluminio['variable'];
						} else {
							if ($row_total_aluminio['medida_r_a'] == 3) {
								$al = ($anchura + $row_total_aluminio["descuento"]) - $row_total_aluminio['variable'];
							} else {
								if ($row_total_aluminio['medida_r_a'] == 4) {
									$al = ($anchura_ventana + $row_total_aluminio["descuento"]) - $row_total_aluminio['variable'];
								} else {
									if ($row_total_aluminio['lado'] != "Vertical") {
										$al = ($row['ancho_c'] + $row_total_aluminio["descuento"]) - $row_total_aluminio['variable'];
									} else {
										$al = ($row['alto_c'] + $row_total_aluminio["descuento"]) - $row_total_aluminio['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($row_total_aluminio['signo'] == '*') {
						if ($row_total_aluminio['medida_r_a'] == 1) {
							$al = ($altura_ventana + $row_total_aluminio["descuento"]) * $row_total_aluminio['variable'];
						} else {
							if ($row_total_aluminio['medida_r_a'] == 2) {
								$al = ($altura + $row_total_aluminio["descuento"]) * $row_total_aluminio['variable'];
							} else {
								if ($row_total_aluminio['medida_r_a'] == 3) {
									$al = ($anchura + $row_total_aluminio["descuento"]) * $row_total_aluminio['variable'];
								} else {
									if ($row_total_aluminio['medida_r_a'] == 4) {
										$al = ($anchura_ventana + $row_total_aluminio["descuento"]) * $row_total_aluminio['variable'];
									} else {
										if ($row_total_aluminio['lado'] != "Vertical") {
											$al = ($row['ancho_c'] + $row_total_aluminio["descuento"]) * $row_total_aluminio['variable'];
										} else {
											$al = ($row['alto_c'] + $row_total_aluminio["descuento"]) * $row_total_aluminio['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($row_total_aluminio['signo'] == '/') {
							if ($row_total_aluminio['medida_r_a'] == 1) {
								$al = ($altura_ventana + $row_total_aluminio["descuento"]) / $row_total_aluminio['variable'];
							} else {
								if ($row_total_aluminio['medida_r_a'] == 2) {
									$al = ($altura + $row_total_aluminio["descuento"]) / $row_total_aluminio['variable'];
								} else {
									if ($row_total_aluminio['medida_r_a'] == 3) {
										$al = ($anchura + $row_total_aluminio["descuento"]) / $row_total_aluminio['variable'];
									} else {
										if ($row_total_aluminio['medida_r_a'] == 4) {
											$al = ($anchura_ventana + $row_total_aluminio["descuento"]) / $row_total_aluminio['variable'];
										} else {
											if ($row_total_aluminio['lado'] != "Vertical") {
												$al = ($row['ancho_c'] + $row_total_aluminio["descuento"]) / $row_total_aluminio['variable'];
											} else {
												$al = ($row['alto_c'] + $row_total_aluminio["descuento"]) / $row_total_aluminio['variable'];
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if ($row_total_aluminio['lado'] == "Vertical") {
				$al55 = ($row["alto_c"]);
			} else {
				$al55 = ($row['ancho_c']);
            }
			$n = 1000;
			if ($tipo == 'Fachada') {
				if ($row_total_aluminio["lado"] == 'Vertical') {
					if ($row["d1"] == '1') {
						$d = $row['ancho_c'] / ($row['verticales'] + 1);
						$al5 = ($row['verticales']);
					} else {
						$d = $row['verticales'] + 1;
						$al5 = $row['ancho_c'] / ($row['verticales'] + 1);
					}
					$z = $d;
				} else {
					if ($row["d1"] == '1') {
						$d = $row["alto_c"] / ($row['horizontales'] + 1);
						$al5 = ($row['horizontales']);
					} else {
						$d = $row['horizontales'] + 1; 
						$al5 = $row["alto_c"] / ($row['horizontales'] + 1);
					}
					$z = $d;
				}
			} else {
				if ($row_total_aluminio['lado'] == "Vertical") {
					$al5 = ($row["alto_c"]);
				} else {
					$al5 = ($row['ancho_c']);
				}
				$z = 0;
			}
			$mp = $precio_actual / $porca;
			$mpfom = $precio_actual_fom / $porcaB;
			if ($row_total_aluminio["lado"] == 'Vertical') {
				$x = 'Alto';
			} else {
				$x = 'Ancho';
			}
			if ($tipo == 'Fachada') {
				$r = number_format($al5,0);
				$t = '<td class="hidden-phone">' . $r . '</td>';
				if ($row_total_aluminio["division"] == 1) {
					$cantidad= 1;
				} else {
					$cantidad = ceil($z - 1);
				}
				$d = ($cantidad * $row_total_aluminio["cantidad"]) * $row['cantidad_c'];
				$m = $row_total_aluminio["cantidad"] . ' x ';
			} else {
				$t = '';
				$m = '';
				$cantidad = ceil($z + $row_total_aluminio["cantidad"]);
				$d = ($cantidad) * $row['cantidad_c'];
			}
			$numero = (($d) * $al) / $row_total_aluminio["medida"];
			$ta = $ta + ($al * $mp * (($d)) / $n);
			$tafom = $tafom + ($al * $mpfom * (($d)) / $n);
			if ($row_total_aluminio["descuento"] >= 0) {
				$s = '+';
			} else {
				$s = '';
			}
			$formula = '(' . $x . '' . $s . '' . $row_total_aluminio["descuento"] . ')' . $row_total_aluminio["signo"] . '' . $row_total_aluminio["variable"];
			$pst = (($row_total_aluminio['peso'] * $al) / 1000) * $row_total_aluminio["cantidad"] * $row['cantidad_c'];
			$ptt = $ptt + $pst;
			$c1 = (($al * $mp * ($d) / $n) / $row['cantidad_c'] * $porca);
			$c1t = $c1 + ($c1 * $vc);
			$c2 = ($c1t * $row['cantidad_c']);
			$c3 = (($al * $mp * ($d) / $n) / $row['cantidad_c']);
			$c3t = $c3 + ($c3 * $vc);
			$c4 = (($al * $mp * (($d)) / $n));
			$c4t = ($c4 + ($c4 * $vc)); // se agrego la suma de compuesto
			$c5 = (($al * $mpfom * ($d) / $n) / $row['cantidad_c'] * $porcaB);
			$c5t = $c5 + ($c5 * $vc);
			$c6 = ($c5 * $row['cantidad_c']);
			$c6t = $c6 + ($c6 * $vc);
			$c7 = (($al * $mpfom * ($d) / $n) / $row['cantidad_c']);
			$c7t = $c7 + ($c7 * $vc);
			$c8 = (($al * $mpfom * (($d)) / $n));
			$c8t = $c8 + ($c8 * $vc);
			$vr1 += $c1t;
			$vr2 += $c2;
			$vr3 += $c3t;
			$vr4 += $c4t;
			$vr5 += $c5t;
			$vr6 += $c6t;
			$vr7 += $c7t;
			$vr8 += $c8t;
                        
		}
                //include '../vistas/compuestos_materia_prima.php';
		$tap = $vr1;
		$tau = $vr3;
		$tapfom = $vr5;
		$taufom = $vr7;
		$perf_sin_p = $tap;
		$perf_con_p = $tau;
		$perf_fom_sin_p = $tapfom; //costo fom
		$perf_fom_con_p = $taufom;
		//****TOTALIZADOR DE VIDRIOS****\\
		$vidrio_por = "SELECT (" . $row['porcentaje_mp'] . ") AS p FROM porcentajes WHERE area_por = 'MP' AND grupo = 'Vidrios'";
		$fip = mysql_fetch_array(mysql_query($vidrio_por));
		$porcv = $fip["p"] / 100;
		$vidrio_porB = "SELECT (" . $row['porcentaje_mp'] . ") AS p FROM porcentajes WHERE area_por = 'MPB' AND grupo='Vidrios'";
		$fipB = mysql_fetch_array(mysql_query($vidrio_porB));
		$porcvB = $fipB["p"] / 100;
		$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row["id_vidrio"] . "'";
		$fi3 = mysql_fetch_array(mysql_query($s3));
		$costo_vidrio = $fi3["costo_v"] / $porcv;
		$query_total_vidrios = mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c WHERE b.id_ref_vid = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row["id_p"]);
		$total_vid = 0;
		$total_vidsp = 0;
		$cu = 0;
		$peso_vid = 0;
		$ci = 0;
		$altura_v_c = 0;
		$anchura_v_c = 0;
		while ($row_total_vidrios = mysql_fetch_array($query_total_vidrios)) {
			$ci += 1;
			if ($row_total_vidrios["ancho_v"] == 0) {
				$alb = $aa;
				if ($row_total_vidrios["utilizar"] == 0) {
					$al = 0;
				} else {
					$al = $ancho;
				}
			} else {
				$query_total_x_vidrios = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row["id_p"] . " AND b.id_r_a = " . $row_total_vidrios["ancho_v"] . "");
				$fil_an = mysql_fetch_array(mysql_query($query_total_x_vidrios));
				$id_p = $fil_an["id_p"];
				
				if ($fil_an['signo'] == '+') {
					if ($fil_an['medida_r_a'] == 1) {
						$al = ($altura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
					} else {
						if ($fil_an['medida_r_a'] == 2) {
							$al = ($altura + $fil_an["descuento"]) + $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 3) {
								$al = ($anchura + $fil_an["descuento"]) + $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 4) {
									$al = ($anchura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
								} else {
									if ($fil_an['lado'] != "Vertical") {
										$al = ($ancho + $fil_an["descuento"]) + $fil_an['variable'];
										$alb = ($aa + $fil_an["descuento"]) + $fil_an['variable'];
									} else {
										$al = ($alto + $fil_an["descuento"]) + $fil_an['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($fil_an['signo'] == '-') {
						if ($fil_an['medida_r_a'] == 1) {
							$al = ($altura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 2) {
								$al = ($altura + $fil_an["descuento"]) - $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 3) {
									$al = ($anchura + $fil_an["descuento"]) - $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 4) {
										$al = ($anchura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
									} else {
										if ($fil_an['lado'] != "Vertical") {
											$al = ($ancho + $fil_an["descuento"]) - $fil_an['variable'];
											$alb = ($aa + $fil_an["descuento"]) - $fil_an['variable'];
										} else {
											$al = ($alto + $fil_an["descuento"]) - $fil_an['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_an['signo'] == '*') {
							if ($fil_an['medida_r_a'] == 1) {
								$al = ($altura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 2) {
									$al = ($altura + $fil_an["descuento"]) * $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 3) {
										$al = ($anchura + $fil_an["descuento"]) * $fil_an['variable'];
									} else {
										if ($fil_an['medida_r_a'] == 4) {
											$al = ($anchura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
										} else {
											if ($fil_an['lado'] != "Vertical") {
												$al = ($ancho + $fil_an["descuento"]) * $fil_an['variable'];
												$alb = ($aa + $fil_an["descuento"]) * $fil_an['variable'];
											} else {
												$al = ($alto + $fil_an["descuento"]) * $fil_an['variable'];
											}
										}
									}
								}
							}
						} else {
							if ($fil_an['signo'] == '/') {
								if ($fil_an['medida_r_a'] == 1) {
									$al = ($altura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 2) {
										$al = ($altura + $fil_an["descuento"]) / $fil_an['variable'];
									} else {
										if ($fil_an['medida_r_a'] == 3) {
											$al = ($anchura + $fil_an["descuento"]) / $fil_an['variable'];
										} else {
											if ($fil_an['medida_r_a'] == 4) {
												$al = ($anchura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
											} else {
												if ($fil_an['lado'] != "Vertical") {
													$al = ($ancho + $fil_an["descuento"]) / $fil_an['variable'];
													$alb = ($aa + $fil_an["descuento"]) / $fil_an['variable'];
												} else {
													$al = ($alto + $fil_an["descuento"]) / $fil_an['variable'];
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if ($row_total_vidrios["alto_v"] == 0) {
				$al2 = $alto;
                $al2b = $aa;
            } else {
				$tv = $al + $row_total_vidrios['var1'];
				$sqlw =("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_a = " . $row_total_vidrios["alto_v"] . "");
				$fil_al = mysql_fetch_array(mysql_query($sqlw));
				if ($fil_al['signo'] == '+') {
					if ($fil_al['medida_r_a'] == 1) {
						$al2 = ($altura_ventana + $fil_al["descuento"]) + $fil_al['variable'];
					} else {
						if ($fil_al['medida_r_a'] == 2) {
							$al2 = ($altura + $fil_al["descuento"]) + $fil_al['variable'];
						} else {
							if ($fil_al['medida_r_a'] == 3) {
								$al2 = ($anchura + $fil_al["descuento"]) + $fil_al['variable'];
							} else {
								if ($fil_al['medida_r_a'] == 4) {
									$al2 = ($anchura_ventana + $fil_al["descuento"]) + $fil_al['variable'];
								} else {
									if ($fil_al['lado'] != "Vertical") {
										$al2 = ($ancho + $fil_al["descuento"]) + $fil_al['variable'];
										$al2b = ($aa + $fil_al["descuento"]) + $fil_al['variable'];
									} else {
										$al2 = ($alto + $fil_al["descuento"]) + $fil_al['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($fil_al['signo'] == '-') {
						if ($fil_al['medida_r_a'] == 1) {
							$al2 = ($altura_ventana + $fil_al["descuento"]) - $fil_al['variable'];
						} else {
							if ($fil_al['medida_r_a'] == 2) {
								$al2 = ($altura + $fil_al["descuento"]) - $fil_al['variable'];
							} else {
								if ($fil_al['medida_r_a'] == 3) {
									$al2 = ($anchura + $fil_al["descuento"]) - $fil_al['variable'];
								} else {
									if ($fil_al['medida_r_a'] == 4) {
										$al2 = ($anchura_ventana + $fil_al["descuento"]) - $fil_al['variable'];
									} else {
										if ($fil_al['lado'] != "Vertical") {
											$al2 = ($ancho + $fil_al["descuento"]) - $fil_al['variable'];
											$al2b = ($aa + $fil_al["descuento"]) - $fil_al['variable'];
										} else {
											$al2 = ($alto + $fil_al["descuento"]) - $fil_al['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_al['signo'] == '*') {
							if ($fil_al['medida_r_a'] == 1) {
								$al2 = ($altura_ventana + $fil_al["descuento"]) * $fil_al['variable'];
							} else {
								if ($fil_al['medida_r_a'] == 2) {
									$al2 = ($altura + $fil_al["descuento"]) * $fil_al['variable'];
								} else {
									if ($fil_al['medida_r_a'] == 3) {
										$al2 = ($anchura + $fil_al["descuento"]) * $fil_al['variable'];
									} else {
										if ($fil_al['medida_r_a'] == 4) {
											$al2 = ($anchura_ventana + $fil_al["descuento"]) * $fil_al['variable'];
										} else {
											if ($fil_al['lado'] != "Vertical") {
												$al2 = ($ancho + $fil_al["descuento"]) * $fil_al['variable'];
												$al2b = ($aa + $fil_al["descuento"]) * $fil_al['variable'];
											} else {
												$al2 = ($alto + $fil_al["descuento"]) * $fil_al['variable'];
											}
										}
									}
								}
							}
						} else {
							if ($fil_al['signo'] == '/') {
								if ($fil_al['medida_r_a'] == 1) {
									$al2 = ($altura_ventana + $fil_al["descuento"]) / $fil_al['variable'];
								} else {
									if ($fil_al['medida_r_a'] == 2) {
										$al2 = ($altura + $fil_al["descuento"]) / $fil_al['variable'];
									} else {
										if ($fil_al['medida_r_a'] == 3) {
											$al2 = ($anchura + $fil_al["descuento"]) / $fil_al['variable'];
										} else {
											if ($fil_al['medida_r_a'] == 4) {
												$al2 = ($anchura_ventana + $fil_al["descuento"]) / $fil_al['variable'];
											} else {
												if ($fil_al['lado'] != "Vertical") {
													$al2 = ($ancho + $fil_al["descuento"]) / $fil_al['variable'];
													$al2b = ($aa + $fil_al["descuento"]) / $fil_al['variable'];
												} else {
													$al2 = ($alto + $fil_al["descuento"]) / $fil_al['variable'];
												}
											}
										}
									}
								}
							}
						}
					}
				}
            }
			if ($row_total_vidrios['ancho_v2'] != 0) {
				$sqlx2 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_a = " . $row_total_vidrios["ancho_v2"] . "");
				$fil_an2 = mysql_fetch_array(mysql_query($sqlx2));
				if ($fil_an2['signo'] == '+') {
					if ($fil_an2['medida_r_a'] == 1) {
						$al22 = ($altura_v_c + $fil_an2["descuento"]) + $fil_an2['variable'];
					} else {
						if ($fil_an2['medida_r_a'] == 2) {
							$al22 = ($altura + $fil_an2["descuento"]) + $fil_an2['variable'];
						} else {
							if ($fil_an2['medida_r_a'] == 3) {
								$al22 = ($anchura + $fil_an2["descuento"]) + $fil_an2['variable'];
							} else {
								if ($fil_an2['medida_r_a'] == 4) {
									$al22 = ($anchura_v_c + $fil_an2["descuento"]) + $fil_an2['variable'];
								} else {
									if ($fil_an2['lado'] != "Vertical") {
										$al22 = ($ancho + $fil_an2["descuento"]) + $fil_an2['variable'];
										$al22b = ($aa + $fil_an2["descuento"]) + $fil_an2['variable'];
									} else {
										$al22 = ($alto + $fil_an2["descuento"]) + $fil_an2['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($fil_an2['signo'] == '-') {
						if ($fil_an2['medida_r_a'] == 1) {
							$al22 = ($altura_v_c + $fil_an2["descuento"]) - $fil_an2['variable'];
						} else {
							if ($fil_an2['medida_r_a'] == 2) {
								$al22 = ($altura + $fil_an2["descuento"]) - $fil_an2['variable'];
							} else {
								if ($fil_an2['medida_r_a'] == 3) {
									$al22 = ($anchura + $fil_an2["descuento"]) - $fil_an2['variable'];
								} else {
									if ($fil_an2['medida_r_a'] == 4) {
										$al22 = ($anchura_v_c + $fil_an2["descuento"])- $fil_an2['variable'];
									} else {
										if ($fil_an2['lado'] != "Vertical") {
											$al22 = ($ancho + $fil_an2["descuento"]) - $fil_an2['variable'];
											$al22b = ($aa + $fil_an2["descuento"]) - $fil_an2['variable'];
										} else {
											$al22 = ($alto + $fil_an2["descuento"]) - $fil_an2['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_an2['signo'] == '*') {
							if ($fil_an2['medida_r_a'] == 1) {
								$al22 = ($altura_v_c + $fil_an2["descuento"]) * $fil_an2['variable'];
							} else {
								if ($fil_an2['medida_r_a'] == 2) {
									$al22 = ($altura + $fil_an2["descuento"]) * $fil_an2['variable'];
								} else {
									if ($fil_an2['medida_r_a'] == 3) {
										$al22 = ($anchura + $fil_an2["descuento"]) * $fil_an2['variable'];
									} else {
										if ($fil_an2['medida_r_a'] == 4) {
											$al22 = ($anchura_v_c + $fil_an2["descuento"]) * $fil_an2['variable'];
										} else {
											if ($fil_an2['lado'] != "Vertical") {
												$al22 = ($ancho + $fil_an2["descuento"]) * $fil_an2['variable'];
												$al22b = ($aa + $fil_an2["descuento"]) * $fil_an2['variable'];
											} else {
												$al22 = ($alto + $fil_an2["descuento"]) * $fil_an2['variable'];
											}
										}
									}
								}
							}
						} else {
							if ($fil_an2['signo'] == '/') {
								if ($fil_an2['medida_r_a'] == 1) {
									$al22 = ($altura_v_c + $fil_an2["descuento"]) / $fil_an2['variable'];
								} else {
									if ($fil_an2['medida_r_a'] == 2) {
										$al22 = ($altura + $fil_an2["descuento"]) / $fil_an2['variable'];
									} else {
										if ($fil_an2['medida_r_a'] == 3) {
											$al22 = ($anchura + $fil_an2["descuento"]) / $fil_an2['variable'];
										} else {
											if ($fil_an2['medida_r_a'] == 4) {
												$al22 = ($anchura_v_c + $fil_an2["descuento"]) / $fil_an2['variable'];
											} else {
												if ($fil_an2['lado'] != "Vertical") {
													$al22 = ($ancho + $fil_an2["descuento"]) / $fil_an2['variable'];
													$al22b = ($aa + $fil_an2["descuento"]) / $fil_an2['variable'];
												} else {
													$al22 = ($alto + $fil_an2["descuento"]) / $fil_an2['variable'];
												}
											}
										}
									}
								}
							}
						}
					}
				}
			} else {
				$al22 = 0;
				$al22b = 0;
            }
			if ($row_total_vidrios['alto_v2'] != 0) {
				$sqlw2 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_a = " . $row_total_vidrios["alto_v2"] . "");
				$fil_al2 = mysql_fetch_array(mysql_query($sqlw2));
				if ($fil_al2['signo'] == '+') {
					if ($fil_al2['medida_r_a'] == 1) {
						$al2x = ($altura_v_c + $fil_al2["descuento"]) + $fil_al2['variable'];
					} else {
						if ($fil_al2['medida_r_a'] == 2) {
							$al2x = ($altura + $fil_al2["descuento"]) + $fil_al2['variable'];
						} else {
							if ($fil_al2['medida_r_a'] == 3) {
								$al2x = ($anchura + $fil_al2["descuento"]) + $fil_al2['variable'];
							} else {
			                    if($fil_al2['medida_r_a']==2){
									$al2x = ($anchura_v_c + $fil_al2["descuento"]) + $fil_al2['variable'];
								} else {
									if ($fil_al2['lado'] != "Vertical") {
										$al2x = ($ancho + $fil_al2["descuento"]) + $fil_al2['variable'];
										$al2xb = ($aa+$fil_al2["descuento"]) + $fil_al2['variable'];
									} else {
										$al2x = ($alto + $fil_al2["descuento"]) + $fil_al2['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($fil_al2['signo'] == '-') {
						if ($fil_al2['medida_r_a'] == 1) {
							$al2x = ($altura_v_c + $fil_al2["descuento"]) - $fil_al2['variable'];
						} else {
							if ($fil_al2['medida_r_a'] == 2) {
								$al2x = ($altura + $fil_al2["descuento"]) - $fil_al2['variable'];
							} else {
								if ($fil_al2['medida_r_a']==3) {
									$al2x = ($anchura + $fil_al2["descuento"]) - $fil_al2['variable'];
								} else {
									if ($fil_al2['medida_r_a'] == 2) {
										$al2x = ($anchura_v_c + $fil_al2["descuento"]) - $fil_al2['variable'];
									} else {
										if ($fil_al2['lado'] != "Vertical") {
											$al2x = ($ancho + $fil_al2["descuento"]) - $fil_al2['variable'];
											$al2xb = ($aa + $fil_al2["descuento"]) - $fil_al2['variable'];
										} else {
											$al2x = ($alto + $fil_al2["descuento"]) - $fil_al2['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_al2['signo'] == '*') {
							if ($fil_al2['medida_r_a'] == 1) {
								$al2x = ($altura_v_c + $fil_al2["descuento"]) * $fil_al2['variable'];
							} else {
								if ($fil_al2['medida_r_a'] == 2) {
									$al2x = ($altura + $fil_al2["descuento"]) * $fil_al2['variable'];
								} else {
									if ($fil_al2['medida_r_a'] == 3) {
										$al2x = ($anchura + $fil_al2["descuento"]) * $fil_al2['variable'];
									} else {
										if ($fil_al2['medida_r_a'] == 2) {
											$al2x = ($anchura_v_c + $fil_al2["descuento"]) * $fil_al2['variable'];
										} else {
											if ($fil_al2['lado'] != "Vertical") {
												$al2x = ($ancho + $fil_al2["descuento"]) * $fil_al2['variable'];
												$al2xb = ($aa + $fil_al2["descuento"]) * $fil_al2['variable'];
											} else {
												$al2x = ($alto + $fil_al2["descuento"]) * $fil_al2['variable'];
											}
										}
									}
								}
							}
						} else {
							if ($fil_al2['signo'] == '/') {
								if ($fil_al2['medida_r_a'] == 1) {
									$al2x = ($altura_v_c + $fil_al2["descuento"]) / $fil_al2['variable'];
								} else {
									if ($fil_al2['medida_r_a'] == 2) {
										$al2x = ($altura + $fil_al2["descuento"]) / $fil_al2['variable'];
									} else {
										if ($fil_al2['medida_r_a'] == 3) {
											$al2x = ($anchura + $fil_al2["descuento"]) / $fil_al2['variable'];
										} else {
											if ($fil_al2['medida_r_a'] == 2) {
												$al2x = ($anchura_v_c + $fil_al2["descuento"]) / $fil_al2['variable'];
											} else {
												if ($fil_al2['lado'] != "Vertical") {
													$al2x = ($ancho + $fil_al2["descuento"]) / $fil_al2['variable'];
													$al2xb = ($aa + $fil_al2["descuento"]) / $fil_al2['variable'];
												} else {
													$al2x = ($alto + $fil_al2["descuento"]) / $fil_al2['variable'];
												}
											}
										}
									}
								}
							}
						}
					}
				}
			} else {
				$al2xb = 0;
				$al2x = 0;
			}
			$tv = ($al + $row_total_vidrios['var1']) / $row_total_vidrios['divisor'];
			$tv2 = ($al2 + $row_total_vidrios['var2']) / $row_total_vidrios['divisor_alto'];
			$tvb = ($alb + $row_total_vidrios['var1']) / $row_total_vidrios['divisor'];
			if (isset($al22)) {
				$n = $al22;
				$an2 = $tv - $n;
				$an2b = $tvb - $n;
			} else {
				$n = 0;
				$an2 = $tv;
				$an2b = $tvb;
            }
			if ($row_total_vidrios['cp'] == 1) {
				$cf = $altura;
			} else {
				if ($row_total_vidrios['cp'] == -1) {
					$cf = - $altura;
				} else {
					$cf = 0;
				}
			}
			if ($row_total_vidrios['desc'] == 0) {
				$dess = 0;
			} else {
				$dess = $alto;
			}
			if (isset($al2x)) {
				$nx = $al2x;
				$all = $tv2 - $nx + $cf - $dess;
			} else {
				$nx = 0;
				$all = $tv2 + $cf - $dess;
			}
			$m2 = ($an2 / 1000) * ($all / 1000);
			$metross = ($an2 / 1000) * ($all / 1000);
			$metro_t = $metross * $row['cantidad_c'];
			$porc = $porcv;
			
			//Codigos Includes (suma_vidrios_ven.php)
			if ($row_total_vidrios['pertenece'] == 1) {
				if (isset($row['ancho_c'])) {
					$m2 = (($an2 / 1000) * ($all / 1000));//$_GET['cant'];
				} else {
					$m2 = $mt2;
				}
				if ($row['id_vidrio'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id_vidrio'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso1 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid'] .'"';
					$resultc = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($resultc)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$str = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($str));
							$cost= $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso1 * $pa;
							$ti = $peso1 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv1 = (($vvc / $porc) + $total + $stt);
					$totalv1sp = ($vvc + $total + $stt);
				} else {
					$totalv1 = 0;
					$totalv1sp = 0;
				}
				if($row['id_vidrio2'] != 0){
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id_vidrio2'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso2 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta= 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid'] . '"';
					$result6 = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result6)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st4 = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st4));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso2 * $pa;
							$ti = $peso2 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv2 = (($vvc) / $porc) + $total + $stt;
					$totalv2sp = (($vvc)) + $total + $stt;
				} else {
					$totalv2 = 0;
					$totalv2sp = 0;
				}
				if ($row['id_vidrio3'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id_vidrio3'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso3 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid'] . '"';
					$result7 = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result7)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
    						if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st7 = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st7));
							$cost= $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso3 * $pa;
							$ti = $peso3 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv3 = (($vvc / $porc) + $total + $stt);
					$totalv3sp = ($vvc + $total + $stt);
				} else {
					$totalv3 = 0;
					$totalv3sp = 0;
				}
				if ($row['id_vidrio4'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id_vidrio4'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso4 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta7= 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid'] . '"';
					$result8 =  mysql_query($consulta7);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result8)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st8 = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st8));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso4 * $pa;
							$ti = $peso4 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv4 = (($vvc / $porc) + $total + $stt);
					$totalv4sp = ($vvc + $total + $stt);
				} else {
					$totalv4 = 0;
					$totalv4sp = 0;
				}
				if ($row['id_vidrio5'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id_vidrio5'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso5 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta9 = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid'] . '"';
					$result9 = mysql_query($consulta9);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result9)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st9 = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st9));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso5 * $pa;
							$ti = $peso5 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv5 = (($vvc / $porc) + $total + $stt);
					$totalv5sp = ($vvc + $total + $stt);
				} else {
					$totalv5 = 0;
					$totalv5sp = 0;
				}
				if ($row['id_vidrio6'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id_vidrio6'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso6 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta11 = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid'] . '"';
					$result11 = mysql_query($consulta11);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result11)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st11 = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st11));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else{
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso6 * $pa;
							$ti = $peso6 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv6 = (($vvc / $porc) + $total + $stt);
					$totalv6sp = ($vvc + $total + $stt);
				} else {
					$totalv6 = 0;
					$totalv6sp = 0;
				}
				if (!isset($peso2)) {
					$peso2 = 0;
				}
				if (!isset($peso3)) {
					$peso3 = 0;
				}
				if (!isset($peso4)) {
					$peso4 = 0;
				}
				if (!isset($peso5)) {
					$peso5 = 0;
				}
				if (!isset($peso6)) {
					$peso6 = 0;
				}
				$pesototal = $peso1 + $peso2 + $peso3 + $peso4 + $peso5 + $peso6;
				$totalvxx = $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
				$totalvxxsp = $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;
			}
			//Codigos Includes (suma_vidrios_ven_1.php)
			if ($row_total_vidrios['pertenece'] == 2) {
				if (isset($row['ancho_c'])) {
					$m2 = (($an2 / 1000) * ($all / 1000));//*$_GET['cant'];
				} else {
					$m2 = $mt2;
				}
				if($row['id2_vidrio'] != 0){
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id2_vidrio'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso1 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta12 = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid2'] . '"';
					$result12 =  mysql_query($consulta12);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result12)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
    						if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso1 * $pa;
							$ti = $peso1 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv1 = (($vvc / $porc) + $total + $stt);
					$totalv1sp = ($vvc + $total + $stt);
				} else {
					$totalv1=0;
					$totalv1sp=0;
				}
				if ($row['id2_vidrio2'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id2_vidrio2'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso2 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid2'] . '"';
					$result =  mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
    						if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso2 * $pa;
							$ti = $peso2 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv2 = (($vvc) / $porc) + $total + $stt;
					$totalv2sp = (($vvc)) + $total + $stt;
				} else {
					$totalv2 = 0;
					$totalv2sp = 0;
				}
				if ($row['id2_vidrio3'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id2_vidrio3'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso3 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid2'] . '"';
					$result =  mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso3 * $pa;
							$ti = $peso3 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv3 = (($vvc / $porc) + $total + $stt);
					$totalv3sp = ($vvc + $total + $stt);
				} else {
					$totalv3 = 0;
					$totalv3sp = 0;
				}
				if ($row['id2_vidrio4'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id2_vidrio4'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso4 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid2'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso4 * $pa;
							$ti = $peso4 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv4 = (($vvc / $porc) + $total + $stt);
					$totalv4sp = ($vvc + $total + $stt);
				} else {
					$totalv4 = 0;
					$totalv4sp = 0;
				}
				if ($row['id2_vidrio5'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id2_vidrio5'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso5 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid2'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso5 * $pa;
							$ti = $peso5 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv5 = (($vvc / $porc) + $total + $stt);
					$totalv5sp = ($vvc + $total + $stt);
				} else {
					$totalv5 = 0;
					$totalv5sp = 0;
				}
				$totalv6 = 0;
				$totalv6sp = 0;
				if (!isset($peso2)) {
					$peso2 = 0;
				}
				if (!isset($peso3)) {
					$peso3 = 0;
				}
				if (!isset($peso4)) {
					$peso4 = 0;
				}
				if (!isset($peso5)) {
					$peso5 = 0;
				}
				if (!isset($peso6)) {
					$peso6 = 0;
				}
				$pesototal = $peso1 + $peso2 + $peso3 + $peso4 + $peso5 + $peso6;
				$totalvxx = $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
				$totalvxxsp = $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;
			}
			//Codigos Includes (suma_vidrios_ven_2.php)
			if ($row_total_vidrios['pertenece'] == 3) {
				if (isset($row['ancho_c'])) {
					$m2 = (($an2 / 1000) * ($all / 1000));//*$_GET['cant'];
				} else {
					$m2 = $mt2;
				}
				if ($row['id3_vidrio'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id3_vidrio'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso1 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid3'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso1 * $pa;
							$ti = $peso1 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv1 = (($vvc / $porc) + $total + $stt);
					$totalv1sp = ($vvc + $total + $stt);
				} else {
					$totalv1 = 0;
					$totalv1sp = 0;
				}
				if ($row['id3_vidrio2'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id3_vidrio2'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso2 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid3'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso2 * $pa;
							$ti = $peso2 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv2 = (($vvc) / $porc) + $total + $stt;
					$totalv2sp = (($vvc)) + $total + $stt;
				} else {
					$totalv2 = 0;
					$totalv2sp = 0;
				}
				if ($row['id3_vidrio3'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id3_vidrio3'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso3 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid3'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso3 * $pa;
							$ti = $peso3 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv3 = (($vvc / $porc) + $total + $stt);
					$totalv3sp = ($vvc + $total + $stt);
				} else {
					$totalv3 = 0;
					$totalv3sp = 0;
				}
				if ($row['id3_vidrio4'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id3_vidrio4'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso4 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid3'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso4 * $pa;
							$ti = $peso4 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv4 = (($vvc / $porc) + $total + $stt);
					$totalv4sp = ($vvc + $total + $stt);
				} else {
					$totalv4 = 0;
					$totalv4sp = 0;
				}
				if ($row['id3_vidrio5'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id3_vidrio5'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso5 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid3'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso5 * $pa;
							$ti = $peso5 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv5 = (($vvc / $porc) + $total + $stt);
					$totalv5sp = ($vvc + $total + $stt);
				} else {
					$totalv5 = 0;
					$totalv5sp = 0;
				}
				$totalv6 = 0;
				$totalv6sp = 0;
				if (!isset($peso2)) {
					$peso2 = 0;
				}
				if (!isset($peso3)) {
					$peso3 = 0;
				}
				if (!isset($peso4)) {
					$peso4 = 0;
				}
				if (!isset($peso5)) {
					$peso5 = 0;
				}
				if (!isset($peso6)) {
					$peso6 = 0;
				}
				$pesototal = $peso1 + $peso2 + $peso3 + $peso4 + $peso5 + $peso6;
				$totalvxx = $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
				$totalvxxsp = $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;
			}
			//Codigos Includes (suma_vidrios_ven_3.php)
			if ($row_total_vidrios['pertenece'] == 4) {
				if (isset($row['ancho_c'])) {
					$m2 = (($an2 / 1000) * ($all / 1000));//*$_GET['cant'];
				} else {
					$m2 = $mt2;
				}
				if ($row['id4_vidrio'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id4_vidrio'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso1 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid4'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso1 * $pa;
							$ti = $peso1 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv1 = (($vvc / $porc) + $total + $stt);
					$totalv1sp = ($vvc + $total + $stt);
				} else {
					$totalv1 = 0;
					$totalv1sp = 0;
				}
				if ($row['id4_vidrio2'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id4_vidrio2'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso2 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid4'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso2 * $pa;
							$ti = $peso2 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pat;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv2 = (($vvc) / $porc) + $total + $stt;
					$totalv2sp = (($vvc)) + $total + $stt;
				} else {
					$totalv2 = 0;
					$totalv2sp = 0;
				}
				if ($row['id4_vidrio3'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id4_vidrio3'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso3 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid4'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso3 * $pa;
							$ti = $peso3 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv3 = (($vvc / $porc) + $total + $stt);
					$totalv3sp = ($vvc + $total + $stt);
				} else {
					$totalv3 = 0;
					$totalv3sp = 0;
				}
				if ($row['id4_vidrio4'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id4_vidrio4'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color = $fi3['color_v'];
					$peso4 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid4'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso4 * $pa;
							$ti = $peso4 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv4 = (($vvc / $porc) + $total + $stt);
					$totalv4sp = ($vvc + $total + $stt);
				} else {
					$totalv4 = 0;
					$totalv4sp = 0;
				}
				if ($row['id4_vidrio5'] != 0) {
					$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $row['id4_vidrio5'] . "'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$costo_vidrio = $fi3['costo_v'];
					$espesor = $fi3['espesor_v'];
					$color= $fi3['color_v'];
					$peso5 = $m2 * $espesor * 2.5;
					$vvc = $m2 * $costo_vidrio;
					$consulta = 'SELECT * FROM pt_procesos a, subproceso b WHERE a.id_subpro = b.id_subpro AND a.id_proceso = "' . $row['traz_vid4'] . '"';
					$result = mysql_query($consulta);
					$total = 0;
					$total_TEMPLE = 0;
					$total_KG = 0;
					$total_UND = 0;
					$total_M2 = 0;
					$total_und = 0;
					$stt = 0;
					while ($fila = mysql_fetch_array($result)) {
						$valor1 = $fila['id_subpro'];
						$valor2 = $fila['nombre_subpro'];
						$precio_a = $fila['precio'];
						$und_med = $fila['medida'];
						$precio_adicional = $fila['precio_adicional'];
						if ($valor1 == 4) {
							$pa = $precio_adicional * $row['per'];
							$cp = $row['per'];
						} else {
							if ($valor1 == 5) {
								$pa = $precio_adicional * $row['boq'];
								$cp = $row['boq'];
							} else {
								$pa = $precio_adicional;
								$cp = 1;
							}
						}
						if ($valor1 == '7') {
							$st = "SELECT * FROM servicio_temple WHERE espesor = '" . $espesor . "'";
							$fit = mysql_fetch_array(mysql_query($st));
							$cost = $fit['costo'];
							$st = $m2 * $cost;
							$total_TEMPLE = $total_TEMPLE + $st;
						} else {
							$st = 0;
						}
						if ($und_med == 'Kg') {
							$pat = $peso5 * $pa;
							$ti = $peso5 * $precio_a * $cp;
							$total_KG = ($total_KG + ($pat + $ti));
						}
						if ($und_med == 'Und') {
							$pat = $pa;
							$ti = $precio_a * $cp;
							$total_UND = ($total_UND + ($pat + $ti));
						}
						if ($und_med == 'M2') {
							$pat = $m2 * $pa;
							$ti = $m2 * $precio_a * $cp;
							$total_M2 = ($total_M2 + ($pat + $ti));
						}
						$total = $total  + $ti +  $pa;
						$stt = $stt + $st;
						$total_und = ($total_KG + $total_UND + $total_M2 + $total_TEMPLE + ($vvc / $porc));
					}
					$totalv5 = (($vvc / $porc) + $total + $stt);
					$totalv5sp = ($vvc + $total + $stt);
				} else {
					$totalv5 = 0;
					$totalv5sp = 0;
				}
				$totalv6 = 0;
				$totalv6sp = 0;
				if (!isset($peso2)) {
					$peso2 = 0;
				}
				if (!isset($peso3)) {
					$peso3 = 0;
				}
				if (!isset($peso4)) {
					$peso4 = 0;
				}
				if (!isset($peso5)) {
					$peso5 = 0;
				}
				if (!isset($peso6)) {
					$peso6 = 0;
				}
				$pesototal = $peso1 + $peso2 + $peso3 + $peso4 + $peso5 + $peso6;
				$totalvxx= $totalv1 + $totalv2 + $totalv3 + $totalv4 + $totalv5 + $totalv6;
				$totalvxxsp= $totalv1sp + $totalv2sp + $totalv3sp + $totalv4sp + $totalv5sp + $totalv6sp;
			}
			$peso_vid = $peso_vid + $pesototal;
			$total_vid = $total_vid + $totalvxx;
			$total_vidsp = $total_vidsp + $totalvxxsp;
			$cu = $cu + 1;
		}
                
		$vidrio_con_p = $total_vid / $row['cantidad_c'];
		$vidrio_sin_p = $total_vidsp / $row['cantidad_c'];
		
		//****TOTALIZADOR DE REJILLAS****\\
		$query_total_rejilla = mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c WHERE b.id_referencia = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p']);
		$xx = 0;
		$xxfom = 0;
		$peso_rej = 0;
		while ($row_total_rejilla = mysql_fetch_assoc($query_total_rejilla)) {
			$sqlx = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] ."  AND b.id_r_a = " . $row_total_rejilla["id_referencia_med"] . "");
			$fil_an = mysql_fetch_array(mysql_query($sqlx));
			$id_p = $fil_an["id_p"];
			$pdlr = "SELECT * FROM dolar_relaciones WHERE id_referencia = " . $row_total_rejilla['id_referencia'] . " AND id_dolar = " . $row['id_dolar'] . " ";
			$fia = mysql_fetch_array(mysql_query($pdlr));
			$precio_actual = $fia["precio_actual"];
			$precio_actual_fom = $fia["precio_act_fom"];
			if ($fil_an['signo'] == '+') {
				if ($fil_an['medida_r_a'] == 1) {
					$al = ($altura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
				} else {
					if ($fil_an['medida_r_a'] == 2) {
						$al = ($altura + $fil_an["descuento"]) + $fil_an['variable'];
					} else {
						if ($fil_an['medida_r_a'] == 3) {
							$al = ($anchura + $fil_an["descuento"]) + $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 4) {
								$al = ($anchura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
							} else {
								if ($fil_an['lado'] != "Vertical") {
									$al = ($ancho + $fil_an["descuento"]) + $fil_an['variable'];
								} else {
									$al = ($alto + $fil_an["descuento"]) + $fil_an['variable'];
								}
							}
						}
					}
				}
			} else {
				if ($fil_an['signo'] == '-') {
					if ($fil_an['medida_r_a'] == 1) {
						$al = ($altura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
					} else {
						if ($fil_an['medida_r_a'] == 2) {
							$al = ($altura + $fil_an["descuento"]) - $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 3) {
								$al = ($anchura + $fil_an["descuento"]) - $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 4) {
									$al = ($anchura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
								} else {
									if ($fil_an['lado'] != "Vertical") {
										$al = ($ancho + $fil_an["descuento"]) - $fil_an['variable'];
									} else {
										$al = ($alto + $fil_an["descuento"]) - $fil_an['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($fil_an['signo'] == '*') {
						if ($fil_an['medida_r_a'] == 1) {
							$al = ($altura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 2) {
								$al = ($altura + $fil_an["descuento"]) * $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 3) {
									$al = ($anchura + $fil_an["descuento"]) * $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 4) {
										$al = ($anchura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
									} else {
										if ($fil_an['lado'] != "Vertical") {
											$al = ($ancho + $fil_an["descuento"]) * $fil_an['variable'];
										} else {
											$al = ($alto + $fil_an["descuento"]) * $fil_an['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_an['signo'] == '/') {
							if ($fil_an['medida_r_a'] == 1) {
								$al = ($altura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 2) {
									$al = ($altura + $fil_an["descuento"]) / $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 3) {
										$al = ($anchura + $fil_an["descuento"]) / $fil_an['variable'];
									} else {
										if ($fil_an['medida_r_a'] == 4) {
											$al = ($anchura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
										} else {
											if ($fil_an['lado'] != "Vertical") {
												$al = ($ancho + $fil_an["descuento"]) / $fil_an['variable'];
											} else {
												$al = ($alto + $fil_an["descuento"]) / $fil_an['variable'];
											}
										}
									}
								}
							}
						}
					}
				}
			}
			$query_total_v_rejilla = mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c WHERE b.id_ref_vid = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_v = " . $row_total_rejilla["medida_rej"] . " ");
			while ($row_total_v_rejilla = mysql_fetch_array($query_total_v_rejilla)){
				//echo $row_total_v_rejilla["ancho_v"];
				$sqlxr = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_a = " . $row_total_v_rejilla["ancho_v"] . " ");
				$fil_anrej = mysql_fetch_array(mysql_query($sqlxr));
				$id_p = $fil_anrej["id_p"];
				if ($fil_anrej['signo'] == '+') {
					if ($fil_anrej['medida_r_a'] == 1) {
						$alr = ($altura_v_c + $fil_anrej["descuento"]) + $fil_anrej['variable'];
					} else {
						if ($fil_anrej['medida_r_a'] == 2) {
							$alr = ($altura + $fil_anrej["descuento"]) + $fil_anrej['variable'];
						} else {
							if ($fil_anrej['medida_r_a'] == 3) {
								$alr = ($anchura + $fil_anrej["descuento"]) + $fil_anrej['variable'];
							} else {
								if ($fil_anrej['medida_r_a'] == 4) {
									$alr = ($anchura_v_c + $fil_anrej["descuento"]) + $fil_anrej['variable'];
								} else {
									if ($fil_anrej['lado'] != "Vertical") {
										$alr = ($ancho + $fil_anrej["descuento"]) + $fil_anrej['variable'];
									} else {
										$alr = ($alto + $fil_anrej["descuento"]) + $fil_anrej['variable'];
									}
								}
							}
						}
					}
				} else {
					if ($fil_anrej['signo'] == '-') {
						if ($fil_anrej['medida_r_a'] == 1) {
							$alr = ($altura_v_c + $fil_anrej["descuento"]) - $fil_anrej['variable'];
						} else {
							if ($fil_anrej['medida_r_a'] == 2) {
								$alr = ($altura + $fil_anrej["descuento"]) - $fil_anrej['variable'];
							} else {
								if ($fil_anrej['medida_r_a'] == 3) {
									$alr = ($anchura + $fil_anrej["descuento"]) - $fil_anrej['variable'];
								} else {
									if ($fil_anrej['medida_r_a'] == 4) {
										$alr = ($anchura_v_c + $fil_anrej["descuento"]) - $fil_anrej['variable'];
									} else {
										if ($fil_anrej['lado'] != "Vertical") {
											$alr = ($ancho + $fil_anrej["descuento"]) - $fil_anrej['variable'];
										} else {
											$alr = ($alto + $fil_anrej["descuento"]) - $fil_anrej['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_anrej['signo'] == '*') {
							if ($fil_anrej['medida_r_a'] == 1) {
								$alr = ($altura_v_c + $fil_anrej["descuento"]) * $fil_anrej['variable'];
							} else {
								if ($fil_anrej['medida_r_a'] == 2) {
									$alr = ($altura + $fil_anrej["descuento"]) * $fil_anrej['variable'];
								} else {
									if ($fil_anrej['medida_r_a'] == 3) {
										$alr = ($anchura + $fil_anrej["descuento"]) * $fil_anrej['variable'];
									} else {
										if ($fil_anrej['medida_r_a'] == 4) {
											$alr = ($anchura_v_c + $fil_anrej["descuento"]) * $fil_anrej['variable'];
										} else {
											if ($fil_anrej['lado'] != "Vertical") {
												$alr = ($ancho + $fil_anrej["descuento"]) * $fil_anrej['variable'];
											} else {
												$alr = ($alto + $fil_anrej["descuento"]) * $fil_anrej['variable'];
											}
										}
									}
								}
							}
						} else {
							if ($fil_anrej['signo'] == '/') {
								if ($fil_anrej['medida_r_a'] == 1) {
									$alr = ($altura_v_c + $fil_anrej["descuento"]) / $fil_anrej['variable'];
								} else {
									if ($fil_anrej['medida_r_a'] == 2) {
										$alr = ($altura + $fil_anrej["descuento"]) / $fil_anrej['variable'];
									} else {
										if ($fil_anrej['medida_r_a'] == 3) {
											$alr = ($anchura + $fil_anrej["descuento"]) / $fil_anrej['variable'];
										} else {
											if ($fil_anrej['medida_r_a'] == 4) {
												$alr = ($anchura_v_c + $fil_anrej["descuento"]) / $fil_anrej['variable'];
											} else {
												if ($fil_anrej['lado'] != "Vertical") {
													$alr = ($ancho + $fil_anrej["descuento"]) / $fil_anrej['variable'];
												} else {
													$alr = ($alto + $fil_anrej["descuento"]) / $fil_anrej['variable'];
												}
											}
										}
									}
								}
							}
						}
					}
				}
				if ($fil_anrej['lado'] == "Vertical") {
					$al2 = ($alto + $fil_anrej["descuento"]);
				} else {
					$al2 = ($ancho + $fil_anrej["descuento"]);
				}
				$tvR = $alr + $row_total_v_rejilla['var1'];
			}
			$prej = $precio_actual / $porca;
			$prejfom = $precio_actual_fom / $porcaB;
			if ($row_total_rejilla["medida_rej"] == 0) {
				$medrej = ($ancho + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
			} else {
				if ($row_total_rejilla["medida_rej"] == 999999) {
					$medrej = ($alto + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
				} else {
					if ($row_total_rejilla["medida_rej"] == 999998) {
						$medrej = ($altura + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
					} else {
						if ($row_total_rejilla["medida_rej"] == 999997) {
							$medrej = ($altura_v_c + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
						} else {
							if ($row_total_rejilla["medida_rej"] == 999996) {
								$medrej = ($anchura_v_c + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
							} else {
								if ($row_total_rejilla["medida_rej"] == 999995) {
									$medrej = ($anchura + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
								} else {
									$medrej = ($tvR + $row_total_rejilla["varr"]) / $row_total_rejilla["en"];
								}
							}
						}
					}
				}
            }
			$al2 = ($alto + $fil_an["descuento"]);
			$tv2 = ($al / $row_total_rejilla['var3']) * $row_total_rejilla['multiplo'];
			$numero = ($medrej * $tv2) / $row_total_rejilla["medida"];
			$xx = $xx + (($medrej * $tv2 * $prej) * $row['cantidad_c'] / 1000);
			$xxfom = $xxfom + (($medrej * $tv2 * $prejfom) * $row['cantidad_c'] / 1000);
			$pst_rej = (($row_total_rejilla['peso'] * $medrej) / $row_total_rejilla["medida"]) * $tv2 * $row['cantidad_c'];
			$peso_rej = $peso_rej + $pst_rej;
		}
		$fr = $xxfom / $row['cantidad_c'];
		$rejilla_sin_p = $xx * $porca/  $row['cantidad_c'];
		$rejilla_con_p = $xx / $row['cantidad_c'];
		$rejilla_fom_sin_p = $xxfom * $porcaB / $row['cantidad_c'];//costo fom
		$rejilla_fom_con_p = $xxfom / $row['cantidad_c'];
		//****TOTALIZADOR DE ACCESORIOS****\\
		$acc_por = "SELECT (" . $row['porcentaje_mp'] . ") AS p FROM porcentajes WHERE area_por = 'MP' AND grupo = 'Accesorios'";
		$fipa = mysql_fetch_array(mysql_query($acc_por));
		$porcacc = $fipa["p"] / 100;
		$acc_porB = "SELECT (" . $row['porcentaje_mp'] . ") AS p FROM porcentajes WHERE area_por = 'MPB' AND grupo = 'Accesorios'";
		$fipaB = mysql_fetch_array(mysql_query($acc_porB));
		$porcaccB = $fipaB["p"] / 100;
		
		$query_total_accesorios = mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c WHERE b.id_ref_acc = c.id_referencia AND a.id_p = b.id_p and a.id_p = " . $row['id_p'] . " ORDER BY b.para");
		$total2 = 0;
		$tac = 0;
		$tacfom = 0;
		$peso_acc = 0;
		$rf5['pelicula'];
		while($row_total_accesorio = mysql_fetch_array($query_total_accesorios)) {
			if ($row_total_accesorio['can_rej'] != 0) {
				$query_total_v2_accesorio = mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c WHERE b.id_referencia = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_rej = " . $row_total_accesorio['can_rej'] . " ");
				while ($row_total_v2_accesorio = mysql_fetch_array($query_total_v2_accesorio)) {
					$query_total_xy_accesorio = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $row['id_p'] . " AND b.id_r_a = " . $row_total_v2_accesorio["id_referencia_med"] . " ");
					$fil_an = mysql_fetch_array(mysql_query($query_total_xy_accesorio));
					$id_p = $fil_an["id_p"];
					if ($fil_an['signo'] == '+') {
						if ($fil_an['medida_r_a'] == 1) {
							$al = ($altura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 2) {
								$al = ($altura + $fil_an["descuento"]) + $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 3) {
									$al = ($anchura + $fil_an["descuento"]) + $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 4) {
										$al = ($anchura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
									} else {
										if ($fil_an['lado'] != "Vertical") {
											$al = ($ancho + $fil_an["descuento"]) + $fil_an['variable'];
										} else {
											$al = ($alto + $fil_an["descuento"]) + $fil_an['variable'];
										}
									}
								}
							}
						}
					} else {
						if ($fil_an['signo'] == '-') {
							if ($fil_an['medida_r_a'] == 1) {
								$al = ($altura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 2) {
									$al = ($altura + $fil_an["descuento"]) - $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 3) {
										$al = ($anchura + $fil_an["descuento"]) - $fil_an['variable'];
									} else {
										if ($fil_an['medida_r_a'] == 4) {
											$al = ($anchura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
										} else {
											if ($fil_an['lado'] != "Vertical") {
												$al = ($ancho + $fil_an["descuento"]) - $fil_an['variable'];
											} else {
												$al = ($alto + $fil_an["descuento"]) - $fil_an['variable'];
											}
										}
									}
								}
							}
						} else {
							if ($fil_an['signo'] == '*') {
								if ($fil_an['medida_r_a'] == 1) {
									$al = ($altura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 2) {
										$al = ($altura + $fil_an["descuento"]) * $fil_an['variable'];
									} else {
										if ($fil_an['medida_r_a'] == 3) {
											$al = ($anchura + $fil_an["descuento"]) * $fil_an['variable'];
										} else {
											if ($fil_an['medida_r_a'] == 4) {
												$al = ($anchura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
											} else {
												if ($fil_an['lado'] != "Vertical") {
													$al = ($ancho + $fil_an["descuento"]) * $fil_an['variable'];
												} else {
													$al = ($alto + $fil_an["descuento"]) * $fil_an['variable'];
												}
											}
										}
									}
								}
							} else {
								if ($fil_an['signo'] == '/') {
									if ($fil_an['medida_r_a'] == 1) {
										$al = ($altura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
									} else {
										if ($fil_an['medida_r_a'] == 2) {
											$al = ($altura + $fil_an["descuento"]) / $fil_an['variable'];
										} else {
											if ($fil_an['medida_r_a'] == 3) {
												$al = ($anchura + $fil_an["descuento"]) / $fil_an['variable'];
											} else {
												if ($fil_an['medida_r_a'] == 4) {
													$al = ($anchura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
												} else {
													if ($fil_an['lado'] != "Vertical") {
														$al = ($ancho + $fil_an["descuento"]) / $fil_an['variable'];
													} else {
														$al = ($alto + $fil_an["descuento"]) / $fil_an['variable'];
													}
												}
											}
										}
									}
								}
							}
						}
					}
					$cant_rej = number_format(($al / $row_total_v2_accesorio['var3']) * $row_total_v2_accesorio['multiplo']);
				}
			} else {
				$cant_rej = 1;
			}
			if ($tipo == 'Fachada') {
				if ($row_total_accesorio["yes"] == 'Si') {
					if ($row_total_accesorio["lado"] == 'Vertical') {
						$res = ((($row_total_accesorio["cantidad_acc"] * $alto) / $row_total_accesorio["metro"]) + $row_total_accesorio["cantidad_acc"]);
					} else {
						$res = ((($row_total_accesorio["cantidad_acc"] * $ancho) / $row_total_accesorio["metro"]) + $row_total_accesorio["cantidad_acc"]);
					}
				} else {
					$res = $row_total_accesorio["cantidad_acc"];
				}
			} else {
				if ($row_total_accesorio['calcular'] == 'ML') {
					$rs = $row['hojas'] * 2 * $row_total_accesorio["cantidad_acc"];
					$res = (($ancho / 1000) * 2) + (($alto / 1000) * $rs);
				} else {
					if ($row_total_accesorio['calcular'] == 'M2') {
						$res = (($ancho / 1000)) * (($alto / 1000)) * $row_total_accesorio["cantidad_acc"];
					} else {
						if ($row_total_accesorio["yes"] == 'Si') {
							if ($row_total_accesorio["lado"] == 'Vertical') {
								$res = ($row_total_accesorio["cantidad_acc"] * $alto) / $row_total_accesorio["metro"];
							} else {
								$res = ($row_total_accesorio["cantidad_acc"] * $ancho) / $row_total_accesorio["metro"];
							}
						} else {
							$res = $row_total_accesorio["cantidad_acc"];
						}
					}
				}
			}
			$taa = $cant_rej * $res;
			if ($row_total_accesorio["med"] != 1) {
				$m = $row_total_accesorio["med"] / 1000;
				$f = '' . number_format(($taa * $row["cantidad_c"])) . ' ML';
				$ft = $f * $row_total_accesorio["valor_f"];
				$a = $f * $row_total_accesorio["valor_f"];
			} else {
				$m = $row_total_accesorio["med"];
				$f = '' . number_format($taa * $row["cantidad_c"]) . ' ' . $row_total_accesorio["calcular"] . '';
				$ft = 'No aplica';
				$a = '';
			}
			if ($rf5['pelicula'] != 'No Aplica' && $row_total_accesorio['codigo'] == '26002') {
				if ($rf5['pelicula'] == "Una Cara") {
					$v = 1;
				} else {
					$v = 2;
				}
				$tac = $tac + (($taa * $v) * ($row_total_accesorio["costo_mt"] / $porcacc) * $m * $row["cantidad_c"] + $a);
				$tacfom = $tacfom + (($taa * $v) * ($row_total_accesorio["costo_fom"] / $porcaccB) * $m * $row["cantidad_c"] + $a);
				(($taa * $v) * ($row_total_accesorio["costo_mt"] / $porcacc) * $m * $row["cantidad_c"] + $a);
				$taa = $taa * $v;
				//echo $rf5['pelicula'];
            }
			if ($row_total_accesorio['codigo'] != '26002') {
				$tac = $tac + ($taa * ($row_total_accesorio["costo_mt"] / $porcacc) * $m * $row["cantidad_c"] + $a);
				$tacfom = $tacfom + ($taa * ($row_total_accesorio["costo_fom"] / $porcaccB) * $m * $row["cantidad_c"] + $a);
			}
			$pst_acc = (($row_total_accesorio['peso'] * $taa));
			$peso_acc = $peso_acc + $pst_acc;
		}
		$acce_sin_p = $tac * $porcacc / $row["cantidad_c"];
		$acce_con_p = $tac / $row["cantidad_c"];
		$acce_fom_sin_p = $tacfom  * $porcaccB  / $row["cantidad_c"];//costo fom
		$acce_fom_con_p = $tacfom  / $row["cantidad_c"];
		$total_sin_p = $perf_sin_p + $vidrio_sin_p + $rejilla_sin_p + $acce_sin_p;
		$total_con_p = $perf_con_p + $vidrio_con_p + $rejilla_con_p + $acce_con_p;
		$total_fom_sin_p = $perf_fom_sin_p + $vidrio_sin_p + $rejilla_fom_sin_p + $acce_fom_sin_p;//costo fom
		$total_fom_con_p = $perf_fom_con_p + $vidrio_con_p + $rejilla_fom_con_p + $acce_fom_con_p;
		//****TOTALIZADOR DE GASTOS DE MAQUINARIA****\\
		$query_total_gastos_maquinaria = mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c WHERE b.id_ref_ma = c.id_ref_ma AND a.id_p = b.id_p AND a.id_p = " . $row['id_p']);
		$tot2 = 0;
		$tot2_p = 0;
		$tot2fom = 0;
		$tot2_pfom = 0;
		while ($row_total_gastos_maquinaria = mysql_fetch_array($query_total_gastos_maquinaria)) {
			$mt2 = ($row['alto_c'] / 1000) * ($row['ancho_c'] / 1000);
			if ($row_total_gastos_maquinaria['dias'] == 'Si') {
				if ($row['alto_c'] > 3000) {
					$res = $mt2 / 2.25;
				} else {
					$res = 0;
				}
				$r = $row_total_gastos_maquinaria["porcentaje_ma"] * ($res) * $row['duracion'];
				$tot2 = $tot2 + $r;
				$dias = $row['duracion'];
				$p = 'Und';
			} else {
				$r = ($total_sin_p * $row_total_gastos_maquinaria["porcentaje_ma"]) / 100;
				$r_p = ($total_con_p * $row_total_gastos_maquinaria["porcentaje_ma"]) / 100;
				$rfom = ($total_fom_sin_p * $row_total_gastos_maquinaria["porcentaje_ma"]) / 100;
				$r_pfom = ($total_fom_con_p * $row_total_gastos_maquinaria["porcentaje_ma"]) / 100;
				$tot2 = $tot2 + $r;
				$tot2_p = $tot2_p + $r_p;
				$tot2fom = $tot2fom + $rfom;
				$tot2_pfom = $tot2_pfom + $r_pfom;
				$dias = 'No aplica';
				$p = '%';
				$res = 'No aplica';
            }
		}
		$maquina_sin_p = $tot2;
		$maquina_con_p = $tot2_p;
		$maquina_fom_sin_p = $tot2fom;//costo fom
		$maquina_fom_con_p = $tot2_pfom;
		//****TOTALIZADOR DE MANO DE OBRA****\\
		$query_total_mano_obra = mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c WHERE b.id_ref_mo = c.id_ref_mo AND a.id_p = b.id_p AND a.id_p = " . $row["id_p"]);
		$tot = 0;
		$tot_fom = 0;
		while ($row_total_mano_obra = mysql_fetch_assoc($query_total_mano_obra)) {
			$mt2 = ($row['alto_c'] / 1000) * ($row['ancho_c'] / 1000);
			$mtl = ($row['ancho_c'] / 1000);
			if ($mt2 < 1) {
				$mt2 = 1;
			} else {
				$mt2 = $mt2;
            }
			if ($row["install"] == 'Si') {
				if ($row_total_mano_obra['unidad_cobro'] == 'M2') {
					$tar =  $mt2 * ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
                }
				if ($row_total_mano_obra['unidad_cobro'] == 'ML') {
					$tar =  $mtl * ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
                }
				if ($row_total_mano_obra['unidad_cobro'] == 'Und') {
					$tar = ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
				}
				if ($row_total_mano_obra['unidad_cobro'] == 'Kg') {
					$tar = ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
				}
				if ($row_total_mano_obra['instalacion'] == 'No') {
					if ($row_total_mano_obra['unidad_cobro'] == 'M2') {
						$tarf =  $mt2 * ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
					}
					if ($row_total_mano_obra['unidad_cobro'] == 'ML') {
						$tarf =  $mt2 * ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
					}
					if ($row_total_mano_obra['unidad_cobro'] == 'Und') {
						$tarf = ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
					}
					if ($row_total_mano_obra['unidad_cobro'] == 'Kg') {
						$tarf = ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
					}
					if ($row_total_mano_obra['referencia'] != '26002') {
						$tot_fom = $tot_fom + $tarf;
					}
					if ($rf5['pelicula'] != 'No Aplica' && $row_total_mano_obra['referencia'] == '26002') {
						if ($rf5['pelicula'] == "Una Cara") {
							$v = 1;
						} else {
							$v = 2;
						}
						$tot_fom = $tot_fom + ($tarf * $v);
						$tarf = $tarf * $v;
					}
				}
				if ($row_total_mano_obra['referencia'] != '26002') {
					$tot = $tot + $tar;
				}
				if ($rf5['pelicula'] != 'No Aplica' && $row_total_mano_obra['referencia'] == '26002') {
					if ($rf5['pelicula'] == "Una Cara") {
						$v = 1;
					} else {
						$v = 2;
					}
					$tot = $tot + ($tar * $v);
					$tar = $tar * $v;
				}
			} else {
				if ($row_total_mano_obra['instalacion'] == 'No') {
					if ($row_total_mano_obra['unidad_cobro'] == 'M2') {
						$tar = $mt2 * ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
						$tarf = $tar;
					}
					if ($row_total_mano_obra['unidad_cobro'] == 'ML') {
						$tar = $mt2 * ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
						$tarf = $tar;
					}
					if ($row_total_mano_obra['unidad_cobro'] == 'Und') {
						$tar = ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
						$tarf = $tar;
					}
					if ($row_total_mano_obra['unidad_cobro'] == 'Kg') {
						$tar = ($row["cantidad_c"] * $row_total_mano_obra["valor_mo"]);
						$tarf = $tar;
					}
					if ($row_total_mano_obra['referencia'] != '26002') {
						$tot = $tot + $tar;
						$tot_fom = $tot_fom + $tarf;
					}
					if ($rf5['pelicula'] != 'No Aplica' && $row_total_mano_obra['referencia'] == '26002') {
						if ($rf5['pelicula'] == "Una Cara") {
							$v = 1;
						} else {
							$v = 2;
						}
						$tot = $tot + ($tar * $v);
						$tot_fom = $tot_fom + ($tarf* $v);
						$tarf = $tarf * $v;
						$tar = ($tar) * $v;
					}
				} else {
					$tar = 0;
				}
			}
		}
		$mano = $tot / $row['cantidad_c'];
		$mano_fom = $tot_fom / $row['cantidad_c'];
		$sub_total_sin_p = $total_sin_p + $maquina_sin_p + $mano;
		$sub_total_con_p = $total_con_p + $maquina_con_p + $mano;
		$sub_total_fom_sin_p_ori = $total_fom_sin_p + $maquina_fom_sin_p + $mano;//costo fom
		$sub_total_fom_con_p_ori =  $total_fom_con_p + $maquina_fom_con_p + $mano_fom;
		//****TOTALIZADOR DE GASTOS ADMINISTRATIVOS Y UTILIDAD****\\
		$query_total_gastos_administrativos = mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c WHERE b.id_ref_ad = c.id_ref_ad AND a.id_p = b.id_p AND a.id_p = " . $row["id_p"]);
		$tota=0;
		$tota_p=0;
		$totafom=0;
		$tota_pfom=0;
		while ($row_total_gastos_administrativos = mysql_fetch_array($query_total_gastos_administrativos)) {
			$por = 100;
			if ($row_total_gastos_administrativos['referencia_ad'] != 'ADM-007') {
				$totafom = $totafom + (($sub_total_fom_sin_p_ori * $row['cantidad_c']) * $row_total_gastos_administrativos["porcentaje_ad"] / $por);
				$tota_pfom = $tota_pfom + (($sub_total_fom_con_p_ori * $row['cantidad_c']) * $row_total_gastos_administrativos["porcentaje_ad"] / $por);
			}
			$tota = $tota + (($sub_total_sin_p * $row['cantidad_c']) * $row_total_gastos_administrativos["porcentaje_ad"] / $por);
			$tota_p = $tota_p + (($sub_total_con_p * $row['cantidad_c']) * $row_total_gastos_administrativos["porcentaje_ad"] / $por);
		}
		
		
		
               $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysql_fetch_array(mysql_query($cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysql_fetch_array(mysql_query($cons_vir3));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysql_fetch_array(mysql_query($cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysql_fetch_array(mysql_query($cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysql_fetch_array(mysql_query($cons_vi4));
                
                
                if ($row["linea_cot"] == 'Aluminio') {
					$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Aluminio'";
					$fi3 = mysql_fetch_array(mysql_query($s3));
					$mult = $fi3["p"] / 100;
				} else {
					if ($row["linea_cot"] == 'Vidrio') {
						$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Vidrio'";
						$fi3 = mysql_fetch_array(mysql_query($s3));
						$mult = $fi3["p"] / 100;
					} else {
						if ($row["linea_cot"] == 'Fachada') {
							$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Fachada'";
							$fi3 = mysql_fetch_array(mysql_query($s3));
							$mult = $fi3["p"] / 100;
						} else {
							if ($row["linea_cot"] == 'Divisiones') {
								$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Divisiones'";
								$fi3 = mysql_fetch_array(mysql_query($s3));
								$mult = $fi3["p"] / 100;
							} else {
								if ($row["linea_cot"] == 'Barandas en Vidrios') {
									$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Barandas en Vidrios'";
									$fi3 = mysql_fetch_array(mysql_query($s3));
									$mult = $fi3["p"] / 100;
								} else{
									if ($row["linea_cot"] == 'Vidrios Decoracion Jamar') {
										$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Vidrios Decoracion Jamar'";
										$fi3 = mysql_fetch_array(mysql_query($s3));
										$mult = $fi3["p"] / 100;
									} else {
										if ($row["linea_cot"] == 'Puertas Batiente en Vidrio') {
											$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Puertas Batiente en Vidrio'";
											$fi3 = mysql_fetch_array(mysql_query($s3));
											$mult = $fi3["p"] / 100;
										} else {
											$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Acero'";
											$fi3 = mysql_fetch_array(mysql_query($s3));
											$mult = $fi3["p"] / 100;
										}
									}
								}
							}
						}	
				}
				}

            $compu =mysql_query("SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysql_fetch_array($compu)){
         $sx = "SELECT (".$fila["porcentaje_sub"].") as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                $fix =mysql_fetch_array(mysql_query($sx));
                $multx= $fix["p"]/100;
 
          $costo_sp += $fila['valor_sp'] ;
          $costo_fom_sp += $fila['valor_fom_sp'];
          $costo_mp += $fila['valor_c_sub']/$multx;
          $costo_fom_mp += $fila['valor_fom_sub'];
    }
           //$t = $d + $mt + $mtk + $mts;
            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           $a = ($row["valor_c"] / $mult) + $tk+ $pad ;
         

            
//            echo ($tk ) .'';
            if($row["linea_cot"]=='Vidrio'){$d1 = 'Per:'.$row["per"].'Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $cont = $cont + 1;
            
            if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            // modificar de este lado
                                
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;
            if($row["especial"]==1){
                if($ver_pro=='Habilitado'){
                $ver = '<a href="../vistas/?id=ver_fac&ref='.$row["id_referencia"].'&cot='.$row["id_cotizacion"].'&cli='.$_GET["cli"].'&ped='.$_GET["cot"].'">';
                }
                else{$ver =''; }
                }else{
                   
                    }
     $con2= "SELECT * FROM `producto` where id_p=".$row['traz_vid']." ";
$res2=  mysql_query($con2);
while($f8=  mysql_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];
}
if($row['traz_vid2']==0){
    $nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysql_query($con22);
while($f8r=  mysql_fetch_array($res22)){
$idco2=$f8r['id_p'];
$nombr2=$f8r['producto'];
}}
if($row['traz_vid3']==0){
    $nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysql_query($con23);
while($f8=  mysql_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];
}}
if($row['traz_vid4']==0){
    $nombr3='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysql_query($con24);
while($f8=  mysql_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];
}}
$v1 = $fv1['color_v'];
if($fv2['color_v']==''){$v2 = '';}else{$v2 = '+'.$fv2['color_v'];}
if($fv3['color_v']==''){$v3 = '';}else{$v3 = '+'.$fv3['color_v'];}
if($fv4['color_v']==''){$v4 = '';}else{$v4 = '+'.$fv4['color_v'];}
$v21 = $fv21['color_v'];
if($fv22['color_v']==''){$v22 = '';}else{$v22 = '+'.$fv22['color_v'];}
if($fv23['color_v']==''){$v23 = '';}else{$v23 = '+'.$fv23['color_v'];}
if($fv24['color_v']==''){$v24 = '';}else{$v24 = '+'.$fv24['color_v'];}
             $tip =$row['tip']; $tip2 =$row['fila'];
            if($row['id_vidrio']!=0 && $row['id_vidrio2']!=0){
                $vi = $v1.$v2.$v3.$v4.' - '.$nombr;
            }else{
                if($fv1['espesor_v']!='' && $row['producto']!=$nombr){
                 $vi = $fv1['color_v'].' '.$nombr;
                }else{
                 $vi = $fv1['color_v'];
                }
            }
            if($row['id2_vidrio']!=0 && $row['id2_vidrio2']!=0){
                $vi2 = $v21.$v22.$v23.$v24.' - '.$nombr2;
            }else{
                
                 $vi2 = $fv21['color_v'].' - '.$nombr2;
            }
               $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99 ";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
      if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
                if($row['pelicula']=='Una Cara'){
                     
                    $peli = ', + '.($fila21['descripcion_mo']);
            }else{
                  
               $peli = ', + '.($fila21['descripcion_mo']).' ambos lados';
            }
            }
            $iva3 = $ptt * ($sel_iva / 100);
            $tota = $ptt + $iva3;
            if($row["ancho_temp"]=='' || $row["ancho_temp"]==0){
            	$ancho_vista = $row["ancho_c"];
            }else{
				$ancho_vista = $row["ancho_temp"];
            }
            if($row["alto_temp"]=='' || $row["alto_temp"]==0){
            	$alto_vista = $row["alto_c"];
            }else{
				$alto_vista = $row["alto_temp"];
            }


            $table = $table.'<tr>'
. '<td width="5%">'.$tip.'</td>'
. '<td width="5%">'.$tip2.'</td>
<td width="30%">'.($row['producto']).' '.$peli.', '.  ($row['observaciones']).', '.$m.','.$d1.', Cierre: '.$row["cierre"].', Inst: '.$row["install"].', Lam: '.$row["laminas"].'  </td>   
<td width="7%">'.$row['codigo'].'</font></td>                  
<td width="9%">'.($vi).''.($vi2).'</td>
<td class="hidden-phone"><div align="center">'.$ancho_vista.'</div></td>
<td class="hidden-phone"><div align="center">'.$alto_vista.'</div></td>
<td class="hidden-phone"><div align="center">'.$row["cantidad_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.round(($row["valor_c"]/$row["cantidad_c"])+$row["precio_fom_sp"]).'</div></td>
<td class="hidden-phone"><div align="center">'.round(($row["valor_fomp"]/$row["cantidad_c"])+$row["precio_fom_sp"]).'</div></td>
<td class="hidden-phone"><div align="center">'.round($pu).'</div></td>
<td class="hidden-phone"><div align="center">'.round($descpor).'</div></td>
<td class="hidden-phone"><div align="center">'.round($pudt).'</div></td>
<td class="hidden-phone" ><div align="center">'.round($ptt).'</div></td>
<td class="hidden-phone"><div align="center">'.round($tota).'</div></td>
<td class="hidden-phone">'.$row["porcentaje"].'</font></td>
    <td class="hidden-phone">'.$row["porcentaje_mp"].'</font></td>
<td class="hidden-phone">'.$row["desc"].'</a></td>
<td class="hidden-phone">' . round($vr4) . '</td>
<td class="hidden-phone">' . round($total_vid * $row["cantidad_c"]) . '</td>
<td class="hidden-phone">' . round($xx) . '</td>
<td class="hidden-phone">' . round($tac) . '</td>';
		foreach ($mano_obra as $valor_mano_obra) {
			$query_valor_mano_obra = mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c, cotizaciones d WHERE b.id_ref_mo = c.id_ref_mo AND a.id_p = b.id_p AND d.id_referencia = a.id_p AND d.id_cot = " . $_GET['cot'] . " AND a.id_p = " . $row["id_p"] . " AND c.referencia = '" . $valor_mano_obra . "'");
			$row_valor_mano_obra = mysql_fetch_array($query_valor_mano_obra);
			if ($row_valor_mano_obra['referencia'] != "") {
				if ($row_valor_mano_obra['referencia'] != "26002") {
					$mt2 = ($row['alto_c'] / 1000) * ($row['ancho_c'] / 1000);
					$mtl = ($row['ancho_c'] / 1000);
					if ($mt2 < 1) {
						$mt2 = 1;
					} else {
						$mt2 = $mt2;
					}
					if ($row_valor_mano_obra['unidad_cobro'] == 'M2') {
						$table = $table . '<td class="hidden-phone">' . round($mt2 * ($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
					}
					if ($row_valor_mano_obra['unidad_cobro'] == 'ML') {
						$table = $table . '<td class="hidden-phone">' . round($mtl * ($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
					}
					if ($row_valor_mano_obra['unidad_cobro'] == 'Und') {
						$table = $table . '<td class="hidden-phone">' . round(($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
					}
					if ($row_valor_mano_obra['unidad_cobro'] == 'Kg') {
						$table = $table . '<td class="hidden-phone">' . round(($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
					}
					//$table = $table . '<td class="hidden-phone">$ ' . number_format(($row["cantidad_c"] * $row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
				} else {
					if ($row_valor_mano_obra['pelicula'] != "No Aplica" && $row_valor_mano_obra['referencia'] == "26002") {
						$mt2 = ($row['alto_c'] / 1000) * ($row['ancho_c'] / 1000);
						$mtl = ($row['ancho_c'] / 1000);
						if ($mt2 < 1) {
							$mt2 = 1;
						} else {
							$mt2 = $mt2;
						}
						if ($row_valor_mano_obra['unidad_cobro'] == 'M2') {
							$table = $table . '<td class="hidden-phone">' . round($mt2 * ($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
						}
						if ($row_valor_mano_obra['unidad_cobro'] == 'ML') {
							$table = $table . '<td class="hidden-phone">' . round($mtl * ($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
						}
						if ($row_valor_mano_obra['unidad_cobro'] == 'Und') {
							$table = $table . '<td class="hidden-phone">' . round(($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
						}
						if ($row_valor_mano_obra['unidad_cobro'] == 'Kg') {
							$table = $table . '<td class="hidden-phone"> ' . round(($row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
						}
						//$table = $table . '<td class="hidden-phone">$ ' . number_format(($row["cantidad_c"] * $row_valor_mano_obra["valor_mo"]) * $row['cantidad_c']) . '</th>';
					} else {
						$table = $table . '<td class="hidden-phone">$ 0</th>';
					}
				}
			} else {
				$table = $table . '<td class="hidden-phone">$ 0</th>';
			}
		}
//$table = $table . '<td class="hidden-phone">' . round($tota_p) . '</td>';



                
	} 
	$table = $table.'</table>';
        
	echo $table;
        
        ///  --------------------------------------------servicios-----------------------------------------

        if($cont!=0){
     echo '<div align="left"><FONT color="red"><h5>TOTAL COT.: '.round($tacot).'</h5></FONT></div>';} 
     
     
} 


$request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and id_cot_mas=0 ");
    
if($request2){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
             $table2 = $table2.'<thead >';
                           $table2 = $table2.'<tr BGCOLOR="#4E8CCF"><td colspan="9" align="center">Descripcion De Servicios</td></tr>'
                      . '<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion del servicio'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Pago Ins'.'</th>';   
             
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Total Pago'.'</th>'; 
           
              $table2 = $table2.'<th width="10%">'.'Costo Total'.'</th>'; 
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
            
                  $request_ac1=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	while($row1=mysql_fetch_array($request_ac1))
	{       
               $por = 100;
            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);  
            
	} 
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["valor_mo"] + $tota) / $pr;
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd;
              
            $table2 = $table2.'<tr><td width="5%">'.$total2s.'</a></td><td width="5%">'.$row2['id_ref_mo'].'</font></td>'
                    . '<td width="40%">'.$row2['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row2["referencia"].'</td>
               <td width="10%">'.round($fr).'</td>'
                    . '<td width="10%">'.$row2["descuento_serv"].'%</td>'
                    . '<td width="10%">'.$row2["cantidad_serv"].'</td><td width="10%">'.round($dd).'</td>'
                         . '<td width="10%">'.round(($dd)).'</td>';
                    
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2;
         echo '<div align="left"><FONT color="red"><h5>TOTAL SERVICIOS.: '.round($to_serv).'</h5></FONT></div>';
      
  
} 


$request3=mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cot']." ");
    
if($request3){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
             $table2 = $table2.'<thead >';
               $table2 = $table2.'<tr BGCOLOR="#4E8CCF"><td colspan="9" align="center">Descripcion De Materiales</td></tr>'
                      . '<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion de los materiales'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Medida'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Costo'.'</th>';   
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Costo Total'.'</th>';
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_mat =0;
     
                
                
	while($row21=mysql_fetch_array($request3))
	{       
                 $acc_por = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='MP' and grupo='".$row21["grupo"]."'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
             $total2= $total2 +  1;
             if($row21['med']==1){
                 $mt = 1;
             }else{
      
                 $mt = ($row21['med']/1000);
             }
            $au = (100 - $row21['aumento']) / 100;
            $prt3 = $row21["costo_mt"] / $au;
             $desm = ($row21['descuento_mat']/100) * ($prt3*$mt);
             $ddm = ((($prt3*$mt) + $desm) * $row21["cantidad_mat"]) / $porcacc;
             $to_mat = $to_mat + $ddm;
             
             if($row21['color_ma']==''){
                 $cm = '';
             }else{
                  $cm = 'Color: '.$row21['color_ma'];
             }
            $table2 = $table2.'<tr><td width="5%">'.$total2.'</a></td><td width="5%">'.$row21['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21['descripcion'].' '.$cm.'</font></td>'
                    . '<td width="10%">'.$row21["referencia"].'<font></a></td><td width="10%">'.$row21["med"].'</td>
               <td width="10%">'.round(($prt3*$mt)/ $porcacc).'</td>'
                    . '<td width="10%">'.$row21["descuento_mat"].'%</td><td width="10%">'.$row21["cantidad_mat"].'</td>'
                    . '<td width="10%">'.round($ddm).'</td>';
           
		
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2;
         echo '<div align="left"><FONT color="red"><h5>TOTAL MATERIALES.: '.round($to_mat).'</h5></FONT></div>';

} 


$request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']."  and b.comp='0'");
    
if($request4){
//    echo'<hr>';
       $table4 = '<table class="table table-bordered table-striped table-hover" id="" border="1">';
             $table4 = $table4.'<thead >';
               $table4 = $table4.'<tr BGCOLOR="#4E8CCF"><td colspan="9" align="center">Descripcion De KIT</td></tr>'
                      . '<tr bgcolor="#D1EEF0">';
              $table4 = $table4.'<th width="5%">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="5%">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="40%">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Medida'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Costo'.'</th>';   
              $table4 = $table4.'<th width="10%">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Costo Total'.'</th>'; 
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2e=0;
        $to_k =0;
     
                
                
	while($row21k=mysql_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             $ddm = ((($totk) + $desm)) / $porcacc;
             $to_k = $to_k + $ddm;
             
              if($row21k['color_k']==''){
                 $ck = '';
             }else{
                  $ck = 'Color: '.$row21k['color_k'];
             }
            $table4 = $table4.'<tr><td width="5%">'.$t2e.'</a></td>'
                    . '<td width="5%">'.$row21k['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21k['producto'].' '.$ck.'</font></td>'
                    . '<td width="10%">'.$row21k["referencia_p"].'<font></a></td>
                        <td width="10%">N/A</td>
               <td width="10%">'.round(($totk)/ $porcacc).'</td><td width="10%">'.$row21k["desc_k"].'%</td>'
                    . '<td width="10%">'.$row21k["cantidad_k"].'</td><td width="10%">'.round($ddm).'</td>';
		
               
	} 
	$table4 = $table4.'</table>';
        
	echo $table4;
         echo '<div align="left"><FONT color="red"><h5>TOTAL KIT.: '.round($to_k).'</h5></FONT></div>';
         echo '<div align="left"><FONT color="red"><h4>GRAN TOTAL.: '.round($to_serv+$tacot+$to_mat+$to_k).'</h4></FONT></div>';
  
} 
?>