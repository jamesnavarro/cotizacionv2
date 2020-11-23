<?php
include '../../modelo/conexion.php'; 
session_start();
  if(isset($_GET['copy'])){
 for($i=1;$i<=$_GET['can'];$i++){
 $res = 'select *, a.laminas from cotizaciones_sub a, producto b  where a.id_referencia_sub=b.id_p and a.id_cotizacion_sub='.$_GET['copy'].' ';
                 $row =mysqli_fetch_array(mysqli_query($conexion,$res));
      
                  
                   $sql = "INSERT INTO `cotizaciones_sub` (`id_dolar`,`pelicula`, `valor_sp`,`valor_fom_sp`,`valor_fom_sub`, `modulo`,`imagen_sub`, `ancho_abajo`, `ubicacion_c`,`traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `tipo_c_sub`, `install`, `horizontales`, `verticales`,`desc_sub`, `observaciones_sub`, `hojas_sub`, `cuerpo_sub`, `color_ta_sub`, `porcentaje_sub`, `porcentaje_mp_sub`,  `per_sub`, `boq_sub`, `cod_traz_sub`, `linea_cot_sub`, `id_cot_sub`, `cierre_sub`, `id_referencia_sub`, `id_vidrio_sub`, `id_vidrio_sub2`, `id_vidrio_sub3`, `id_vidrio_sub4`, `id_vidrio_sub5`, `id_vidrio_sub6`,`ancho_c_sub`, `alto_c_sub`, `valor_c_sub`, `cantidad_c_sub`, `cant_restante`, `id_cliente_sub`,`estado_c_sub`, `registrado_por_c_sub`, `id_producto_cot`, `d1`,`id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`,`id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
                  $sql.= "VALUES ('".$row['id_dolar']."','".$row['pelicula']."','".$row['valor_sp']."','".$row['valor_fom_sp']."','".$row['valor_fom_sub']."', '".$row['modulo']."', '".$row['imagen_sub']."', '".$row['ancho_abajo']."', '".$row['ubicacion_c']."', '".$row['traz_vid']."', '".$row['traz_vid2']."', '".$row['traz_vid3']."', '".$row['traz_vid4']."', '".$row['laminas']."', '".$row['laminas2']."', '".$row['laminas3']."', '".$row['laminas4']."', '".$row['tipo_c_sub']."', '".$row['install']."','".$row['horizontales']."', '".$row['verticales']."','".$row['desc_sub']."', '".$row['observaciones_sub']."', '".$row['hojas_sub']."', '".$row['cuerpo_sub']."', '".$row['color_ta_sub']."', '".$row['porcentaje_sub']."', '".$row['porcentaje_mp_sub']."', '".$row['per_sub']."', '".$row['boq_sub']."','".$row['cod_traz_sub']."', '".$row['linea_cot_sub']."', '".$row['id_cot_sub']."', '".$row['cierre_sub']."', '".$row['id_referencia_sub']."', '".$row['id_vidrio_sub']."', '".$row['id_vidrio_sub2']."', '".$row['id_vidrio_sub3']."', '".$row['id_vidrio_sub4']."', '".$row['id_vidrio_sub5']."', '".$row['id_vidrio_sub6']."', '".$row['ancho_c_sub']."', '".$row['alto_c_sub']."',  '".$row['valor_c_sub']."',  '".$row['cantidad_c_sub']."',  '".$row['cant_restante']."', '".$row['id_cliente_sub']."', '".$row['estado_c_sub']."', '".$_SESSION['k_username']."', '".$row['id_producto_cot']."', '".$row['d1']."', '".$row['id2_vidrio']."', '".$row['id2_vidrio2']."', '".$row['id2_vidrio3']."', '".$row['id2_vidrio4']."', '".$row['id2_vidrio5']."', '".$row['id3_vidrio']."', '".$row['id3_vidrio2']."', '".$row['id3_vidrio3']."', '".$row['id3_vidrio4']."', '".$row['id3_vidrio5']."', '".$row['id4_vidrio']."', '".$row['id4_vidrio2']."', '".$row['id4_vidrio3']."', '".$row['id4_vidrio4']."', '".$row['id4_vidrio5']."')";
                  mysqli_query($conexion,$sql);
                 
                  $sql5 = "SELECT max(id_cotizacion_sub) FROM cotizaciones_sub";
                 $fila5 =mysqli_fetch_array(mysqli_query($conexion,$sql5));
                 $maxcot= $fila5["max(id_cotizacion_sub)"];

 }
     echo 'Se ha Copiado el items  con exito'; 
                       

}   

