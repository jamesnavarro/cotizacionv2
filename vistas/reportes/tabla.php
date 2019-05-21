<?php
	include "../../modelo/conexion.php";
	include "../../modelo/consultar_permisos.php";
        session_start();
        $nombre_ord = $_POST['ord'];
        $asc_desc = $_POST['orden'];
         $ano = $_POST['ano'];
         $mes = $_POST['mes'];
         $vciu = $_POST['vciu'];
         $vest = $_POST['vest'];
         $vopc = $_POST['vopc'];
         $vdir = $_POST['vdir'];
         $vase = $_POST['vase'];
         $vfec = $_POST['vfec'];
         $seg = $_POST['seg'];
         if($seg==''){
             $qseg = '';
         }else{
             $qseg = ' AND a.seguimiento="'.$seg.'"  ';
         }
         if($ano!='' && $mes!=''){
             $fecha = ' and fecha_reg_c between  "' . $ano . '" and "' . $mes . '" ';
         }else{
             $fecha = '';
         }
          $vcot = $_POST['vcot'];
//         if($mes==''){
//             $fecha = ' and fecha_reg_c like "' . $ano . '%" ';
//         }else{
//             $fecha = ' and fecha_reg_c like "' . $ano.'-'.$mes . '%" ';
//         }
		if ($_POST['cot'] != '') {
			$cot = ' AND a.numero_cotizacion in ('. $_POST['cot'] . ') ';
                         $asc = '  a.version ';
		} else {
			$cot = '';
                         $asc = '  a.numero_cotizacion ';
		}
		if ($_POST['cli'] != '') {
			$nom = ' AND CONCAT(b.nom_ter, " ", a.nom_temp) LIKE "%' . $_POST['cli'] . '%" ';
		} else {
			$nom = '';
		}
                if ($_POST['pre'] != '') {
			$valor = ' AND a.costo_total  BETWEEN  "' .$_POST['pre'] .'" and "' .$_POST['pref'] .'" ';
		} else {
			$valor = '';
		}
		if ($_POST['obr'] != '') {
			$obr = ' AND a.obra LIKE "%'.$_POST['obr'].'%" ';
		} else {
			$obr = '';
		}
		if ($_POST['ase'] != '') {
			$reg = ' AND a.registrado = "' . $_POST['ase'] . '" ';
		} else {
			$reg = '';
		}
               
                if ($_POST['est'] != '') {
                    
			$est = ' AND a.estado in (' . $_POST['est'] . ') ';
		} else {
			$est = '';
		}
                 if ($_POST['ciu'] != '') {
			$ciu = ' AND a.municipio like "%' . $_POST['ciu'] . '%" ';
		} else {
			$ciu = '';
		}
                
//                if($_POST['dsdd']=='' && $_POST['hstaa']==''){
//                      $fg ='';
//                       }else{
//                      $fg =' and a.fecha_reg_c >= "'.$_POST['est'].'" and a.fecha_reg_c <= "'.$_POST['est'].'" ';
//                       } 
             
	$request = mysql_query('SELECT id_cot, sum(costo_total) FROM cotizacion a, cont_terceros b WHERE  a.id_cot IN (SELECT max(id_cot) FROM `cotizacion` GROUP by numero_cotizacion) and a.id_tercero = b.id_ter ' . $cot . $nom . $obr . $reg  . $est . $valor. $ciu.$fecha. $qseg.' group by numero_cotizacion '   );
	if ($request) {
		$req = mysql_num_rows($request);
                $tt = 0;
                while($sum = mysql_fetch_row($request)){
                    $tt += $sum[1];
                }
		$num_items = $req;
	} else {
		$num_items = 0;
	}
	$rows_by_page = $_POST['lista'];
	$last_page = ceil($num_items / $rows_by_page);
	if (isset($_POST['page'])) {
		$page = $_POST['page'];
	} else {
		$page = 1;
	}
	function interval_date($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = "Hace " . floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = "Hace " . floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = "Hace " . floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = "Hace " . floor($diferencia / 86400) . " días";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = "Hace " . floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = "Hace " . floor($diferencia / 31104000) . " años";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
	function interval_date2($init, $finish){
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = floor($diferencia / 86400) . " días";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = floor($diferencia / 31104000) . " años";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
       ///SELECT max(id_cot), numero_cotizacion,max(version) FROM cotizacion where numero_cotizacion=45490 group by numero_cotizacion order by numero_cotizacion desc
        ?> <br>
<?php
	$limit = 'LIMIT ' . ($page - 1) * $rows_by_page . ',' . $rows_by_page;
        echo '<h3>Cantidad de Registro: '.$num_items. ' | Valor Total en Cotizaciones: $'.  number_format($tt);
        $fuente = $_POST['fuente'];
        if($fuente=='1'){
            $class = 'blueTable';
        }elseif($fuente=='2'){
            $class = 'medio';
        }else{
            $class = 'grande';
        }
?>
<br>
<table class="<?php echo $class; ?>">
            <thead>
                
            <tr>
            <?php if($vcot=='false'){ ?><th>COTIZACION</th><?php } ?>
           
            <th>VALOR</th>
             <th>CLIENTE</th>
            <th>OBRA</th>
            <?php if($vciu=='false'){ ?><th>DEP/CIUDAD</th><?php } ?>
            <?php if($vdir=='false'){ ?><th>DIRECCION</th><?php } ?>
            
            <?php if($vest=='false'){ ?><th>ESTADO</th><?php } ?>
            <?php if($vase=='false'){ ?><th NOWRAP>ASESOR / ANALISTA</th><?php } ?>
            <?php if($vfec=='false'){ ?><th>FECHA</th><?php } ?>
            <?php if($vopc=='false'){ ?><th nowrao>OPCIONES</th><?php } ?>
            
            
            </tr>
            </thead>
            <?php
               $footer = '<tfoot><tr><td colspan="10"><div class="links">';
        if ($page > 1) {
            $footer = $footer . '<a href="#" onclick="mostrar(1)">&laquo;</a> <a class="active" href="#" onclick="mostrar('.($page - 1).')">&laquo;&laquo;</a>';
        }else{
           $footer = $footer . ' <a href="#">&laquo;</a> ';   
        }
           $footer = $footer . ' <a href="#">Pagina '.$page.' de '.$last_page.'</a> ';
        if ($page < $last_page) {
            $footer = $footer . '<a href="#" onclick="mostrar('.($page + 1).')">&raquo;&raquo;</a> <a href="#" onclick="mostrar('.($last_page).')">&raquo;</a>';
        }else{
            $footer = $footer . '<a href="#">&raquo;</a>';
        }
        echo $footer = $footer . '</div></tr></tfoot>';
            ?>
            
            <tbody>
<?php
	$request_ac = mysql_query("SELECT max(a.id_cot) as id_cot, max(a.version) as version,id_tercero,nom_temp,cod_temp,a.seguimiento,a.costo_total,a.estado,numero_cotizacion,obra,ciudad, ubicacion,a.registrado,fecha_reg_c,telfijo_ter,tel_responsable,presupuesto,municipio FROM cotizacion a, cont_terceros b WHERE  a.id_cot IN (SELECT max(id_cot) FROM `cotizacion` GROUP by numero_cotizacion) and  a.id_tercero = b.id_ter " . $cot . $nom . $obr . $reg . $est. $valor .$ciu. $fecha.$qseg. " group by numero_cotizacion ORDER BY $nombre_ord $asc_desc   " . $limit);
   
		if ($request_ac) {
                       $table = '';
			$cont = 0;
			while($row = mysql_fetch_array($request_ac)) {
				$cont = $cont + 1;
				$sql = 'SELECT * FROM cont_terceros WHERE id_ter = "' . $row['id_tercero'] . '"';
				$fil = mysql_fetch_array(mysql_query($sql));
				if ($row["nom_temp"] == '') {
					$nombre = $fil["nom_ter"];
					$documento = $fil["cod_ter"];
				} else {
					$nombre = $row["nom_temp"] ;
					$documento = $row["cod_temp"];
				}

                                if($row['seguimiento']=='0'){
                                              $stilo = ' style="background-color:red; color:white" ';
                                          }else{
                                               $stilo = ' style="background-color:green;color:white" ';
       
                                }
                                if($_SESSION['k_username']=='IVAN.ORDOSGOITIA' || $_SESSION['k_username']=='admin'| $_SESSION['k_username']=='ccastro'){
//                                        if($row["costo_total"]>=500000){ 
                                           if($row["seguimiento"]==0){
                                               $sg = '<button '.$stilo.' onclick="seguir('.$row['id_cot'].');" type="button" title="Seguimiento">S</button>';
                                           }else{
                                               $obra = "'".strtoupper($row["obra"])."'";
                                               $sg = '<button '.$stilo.' onclick="mostrar_seguimientos('.$row['id_cot'].','.$obra.');" type="button" title="Seguimiento" data-toggle="modal" data-target="#myModal">S</button>';
                                           } 
                                            	
                                                $im = '<button  onclick="cot('.$row['id_cot'].');" type="button" title="Imprimir Cotizacion">Imp</button>';
                                                $del = '<button onclick="papelera('.$row['id_cot'].');" type="button" title="Descartar cotizacion"><b>X</b></button>';
//                                        }else{
//                                            $sg = '';
//                                            $im = '';$del = '';
//                                        }
					} else {
						$sg = '';
                                                $im = '';$del = '';
					}
                                                               
                   if($row['tecnica']==''){
                      $tec = '';
                       }else{
                          $tec = '-<font color="purple">'.$row['tecnica'].'</font>';
                              }
			        $table = $table . '<tr>';
                                if($vcot=='false'){ $table = $table . '<td>' . $row['numero_cotizacion'] . '.' . $row["version"] .$tec.'<img src="../../images/costo.png" width=35px onclick="m_cost('.$row['id_cot'].','.$row['costo_total'].')"></td>'; }
                                $table = $table . '<td style="text-align:left;">$' . number_format($row["costo_total"]) . '<font></td>';
				$table = $table . '<td>' . strtoupper($nombre) . '</td>';
				$table = $table . '<td>' . strtoupper($row["obra"]).'</td>';
                                if($vciu=='false'){ $table = $table . '<td>'. strtoupper($row["ciudad"]) .'<br>'. strtoupper($row["municipio"]) . '</td>'; }
                                if($vdir=='false'){ $table = $table . '<td>' . strtoupper($row["ubicacion"]).'<br>'.$row["tel_responsable"].'<font></td>'; }
                                if($vest=='false'){ $table = $table . '<td>' . $row["estado"] . '</font></td>'; }
                                if($vase=='false'){ $table = $table . '<td style="text-align:center;">' . strtoupper($row["registrado"]) .'<br>'. strtoupper($row["presupuesto"]) . '<font></td>'; }
                                if($vfec=='false'){ $table = $table . '<td>' . substr($row["fecha_reg_c"],0,10) . '<font></td>'; }
                                if($vopc=='false'){ $table = $table . '<td nowrap>'.$sg.' '.$im.'&nbsp; &nbsp; '.$del.'</td>'; }
                          
				$table = $table . '</tr>';
			}

		}
                echo $table;
//                $p = array();
//                $p[0] = $table;
//                $p[1] = $footer;
//                echo json_encode($p);
	?>
</tbody>
            
            </table>
