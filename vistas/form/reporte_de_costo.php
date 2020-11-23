<?php 
 require '../../modelo/conexion.php';
    $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " ORDER BY c.fila ASC ");
    while($row=mysqli_fetch_array($request))
	{
          $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir3));
                $cons_vir5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio5']." ";
                $fv5 =mysqli_fetch_array(mysqli_query($conexion,$cons_vir5));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
                $cons_vi5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio4']." ";
                $fv25 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi5));
                $v1 = $fv1['color_v'];
                
//                        $ver = '?l='.$row["imagen"].''
//                        . '&mod='.$row["modulo"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
//                        . '&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion"].'&tv='.$row["traz_vid"].''
//                                . '&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
//                        . '&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c"].'&alto='.$row["alto_c"].''
//                        . '&cant='.$row["cantidad_c"].'&vidrio='.$fv1["color_v"].'('.$fv1["espesor_v"].'mm)'
//                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
//                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
//                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
//                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
//                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
//                        . '&por='.$row["porcentaje_mp"].'&por_venta='.$row["porcentaje"].'&v='.$row["verticales"].''
//                        . '&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&lado='.$row["lado"].'&unidad=0&descuento=0&ciudad='.$_GET['ciudad'].'"';

                        $_GET['vidrio'] = $fv1["color_v"].'('.$fv1["espesor_v"].'mm)';
                        $_GET['ins'] = $row["install"] ;
                        $_GET['l'] = $row["imagen"] ;
                        $_GET['idcot'] = $row["id_cotizacion"] ;
                         $_GET["idcot"] = $row["id_cotizacion"] ;
                         $_GET['ref'] = $row["id_referencia"] ;
                        $_GET['por'] = $row["porcentaje_mp"] ;
                        $_GET['por_venta'] = $row["porcentaje"] ;
                        $_GET['v'] = $row["verticales"] ;
                        $_GET['h'] = $row["horizontales"] ;
                        $_GET['d1'] = $row["d1"] ;
                        $_GET['dias'] = $row["duracion"] ;
                        $_GET['lado'] = $row["lado"] ;
                        $_GET['unidad'] = 0 ;
                        $_GET['descuento'] = 0;
                        $_GET['ciudad'] = $_GET['ciudad'] ;
                        $_GET['mod'] = $row["modulo"] ;
                        $_GET['per'] = $row["per"] ;
                        $_GET['boq'] = $row["boq"] ;
                        $_GET['cot'] = $_GET['cot'];
                        $_GET['tv'] = $row["traz_vid"] ;
                        $_GET['tv2'] = $row["traz_vid2"] ;
                        $_GET['tv3'] = $row["traz_vid3"] ;
                        $_GET['tv4'] = $row["traz_vid4"] ;
                        $_GET['aa'] = $row["ancho_abajo"] ;
                        $_GET['ancho'] = $row["ancho_c"] ;
                        $_GET['alto'] = $row["alto_c"] ;
                        $_GET['cant'] = $row["cantidad_c"] ;
                        $_GET['id_v'] = $row["id_vidrio"] ;
                        $_GET['id_v2'] = $row["id_vidrio2"] ;
                        $_GET['id_v3'] = $row["id_vidrio3"] ;
                        $_GET['id_v4'] = $row["id_vidrio4"] ;
                        $_GET['id_v5'] = $row["id_vidrio5"] ;
                        $_GET['id_v6'] = $row["id_vidrio6"] ;
                        $_GET['id2_v'] = $row["id2_vidrio"] ;
                        $_GET['id2_v2'] = $row["id2_vidrio2"] ;
                        $_GET['id2_v3'] = $row["id2_vidrio3"] ;
                        $_GET['id2_v4'] = $row["id2_vidrio4"] ;
                        $_GET['id2_v5'] = $row["id2_vidrio5"] ;
                         $_GET['id3_v'] = $row["id3_vidrio"] ;
                        $_GET['id3_v2'] = $row["id3_vidrio2"] ;
                        $_GET['id3_v3'] = $row["id3_vidrio3"] ;
                        $_GET['id3_v4'] = $row["id3_vidrio4"] ;
                        $_GET['id3_v5'] = $row["id3_vidrio5"] ;
                         $_GET['id4_v'] = $row["id4_vidrio"] ;
                        $_GET['id4_v2'] = $row["id4_vidrio2"] ;
                        $_GET['id4_v3'] = $row["id4_vidrio3"] ;
                        $_GET['id4_v4'] = $row["id4_vidrio4"] ;
                        $_GET['id4_v5'] = $row["id4_vidrio5"] ;
                        $_GET['cuerpo'] = $row["cuerpo"] ;
                        $_GET['hojas'] = $row["hojas"] ;
                         require '../form/cotizacion_save_reporte.php';
        
         }

