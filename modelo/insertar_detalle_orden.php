<?php
require("conexion.php");
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$status = "";

       $ref = $_GET["ord"];
       $can = $_POST["cantidad"];
       $user = 0;
       $obs = '';
       $ubic = $_POST["ubicacion"];


  
            $sql21 = ("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cotizacion=".$_GET["ord"]);
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $id= $fila21["id_cot"];
            
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$fila21['id_vidrio']." ";
                $fv =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$fila21['id2_vidrio']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$fila21['id3_vidrio']." ";
                $fv3 =mysql_fetch_array(mysql_query($cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$fila21['id4_vidrio']." ";
                $fv4 =mysql_fetch_array(mysql_query($cons_vi4));
            
            $precio_mp= $fila21["porcentaje_mp"];
            $id_vidrio= $fila21["id_vidrio"];
            $id2_vidrio= $fila21["id2_vidrio"];
            $id3_vidrio= $fila21["id3_vidrio"];
            $id4_vidrio= $fila21["id4_vidrio"];
            $cierre= $fila21["cierre"];
            $ancho_c= $_POST["ancho"];
            $alto_c= $_POST["alto"];
            $aa= $fila21["ancho_abajo"];
            $cantidad_c= $fila21["cantidad_c"];
            $cantidad_r= $fila21["cant_restante"];
            $valor_c= $fila21["valor_c"];
            $estado_c= $fila21["estado_c"];
            $num_pedido= $fila21["num_pedido"];
            $orden_p= $fila21["orden"];
            $color_v= $fv["color_v"];
            $espesor= $fv["espesor_v"];
            $color_v2= $fv2["color_v"];
            $espesor2= $fv2["espesor_v"];
            $color_v3= $fv3["color_v"];
            $espesor3= $fv3["espesor_v"];
            $color_v4= $fv4["color_v"];
            $espesor4= $fv4["espesor_v"];
            $hojas= $fila21["hojas"];
            $cuerpo= $fila21["cuerpo"];
            $codigo = $_GET['op'];
            $area= $fila21["linea"];
            $tc =  $cantidad_r;
            $re = $tc - $can;
            $altura= $cuerpo;
            $altura_ventana = $_POST["alto"] - $cuerpo;
            
            $traz_vid= $fila21["traz_vid"];
            $traz_vid2= $fila21["traz_vid2"];
            $traz_vid3= $fila21["traz_vid3"];
            $traz_vid4= $fila21["traz_vid4"];
            $modulo= $fila21["modulo"];
            $id_referencia= $_GET["id"];
            $id_ref_cambio= $_POST["id"];
            $lado = $_POST["lado"];
            $anmin = $_POST["ancho1"] - 100;
            $anmax = $_POST["ancho1"] + 100;
            $almin = $_POST["alto1"] - 100;           
            $almax = $_POST["alto1"] + 100;
            
            if($_POST["ancho"] < $anmin || $_POST["ancho"] > $anmax){
                echo '<script lanquage="javascript">alert("El ancho digitado sobrepasa los descuento de la medida");location.href="../vistas/?id=detalle_op&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&op='.$_GET['op'].'"</script>'; 
            
            }else{
            
            if($_POST["alto"] < $almin || $_POST["alto"] > $almax){
                echo '<script lanquage="javascript">alert("El alto digitado supera los cambios establecido");location.href="../vistas/?id=detalle_op&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&op='.$_GET['op'].'"</script>'; 
            
            }else{
      
       
       
        if ($_POST["cantidad"] > $cantidad_r) {
        echo '<script lanquage="javascript">alert("la cantidad a producir es mayor a la cantidad pendiente");location.href="../vistas/?id=detalle_op&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&op='.$_GET['op'].'"</script>'; 
        }else{ 
        
        $sql211 = "SELECT max(item_unico) FROM orden_detalle where id_op=".$_GET["ord"]."";
        $fila211 =mysql_fetch_array(mysql_query($sql211));
        $maxei= $fila211["max(item_unico)"]+1;
            $producto = 'Especificacion #'.$maxei;

	$sql = "INSERT INTO `orden_detalle`(`id_prod_cambio`, `lado`, `ubic`, `estado_op`, `id_producto`, `relacionado`, `sede_od`, `asignado`,`descripcion`,`codigo`, `item_unico`, `producto_od`, `cantidad`, `cant_ordenada`, `medida1`, `medida2`, `medida3`, `color`,  `id_proceso`,`id_op`)";
        $sql.= "VALUES ('".$id_ref_cambio."', '".$lado."', '".$ubic."','1', '".$id_referencia."', '".$_GET["ord"]."', '".$area."', '".$user."','".$obs."','".$codigo."', '".$maxei."', '".$producto."', '".$tc."', '".$can."', '".$ancho_c."', '".$alto_c."', '".$espesor."', '".$color_v."', '".$id_referencia."', '".$_GET["ord"]."')";
        mysql_query($sql);
        
        

	$status = "ok";
        
        $sqlt = "SELECT max(id_orden_d) FROM orden_detalle";
        $filat =mysql_fetch_array(mysql_query($sqlt));
        $max= $filat["max(id_orden_d)"];
        
        $n = $_POST["cantidad"];
        $por = 100 / $n;
        $paso=1;
        
//         $consulta= mysql_query('select a.*, b.* from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$ref.' order by a.orden asc limit 1');  
//      $fil = mysql_fetch_array($consulta);
//      $id_subpr = $fil['id_subpro'];
      
//      $menor = mysql_query("SELECT * FROM subproceso_maq where ocupado=(select min(ocupado) from subproceso a, subproceso_maq b where a.id_subpro=b.id_subproceso and a.id_subpro=".$id_subpr.") and id_subproceso=".$id_subpr." ");
//       $mi = mysql_fetch_array($menor);
//       $sig = $mi['paso_maq'];
//       
//       $ma = "SELECT max(ocupado) FROM subproceso_maq where id_subproceso=".$id_subpr."";
//        $filt =mysql_fetch_array(mysql_query($ma));
//        $maxa= $filt["max(ocupado)"] + 1;
//        
//         $sql34 = "UPDATE `subproceso_maq` SET `ocupado`='".$maxa."' WHERE id_subproceso=".$id_subpr." and ocupado=".$filt["max(ocupado)"].";";
//         mysql_query($sql34);
        
        for($x=1; $x<=$n; $x=$x+1){ 
            
     
       $barra = $_GET["ord"].''.$maxei;
        $it = $barra.$x;
        
       $cc = $codigo.$x;
        $sql1 = "INSERT INTO `procesos_activos`(`barra_item`, `area_proceso`, `barra`, `paso`, `paso_maq`, `id_op`, `id_orden_d`, `item`, `codigo`, `porcentaje`, `hora_in`, `fecha_in`, `fecha_llegada`, `hora_llegada`, `llegada`, `usuario`)";
        $sql1.= "VALUES ('".$it."', '".$area."', '".$barra."','".$paso."','0','".$_GET['op']."', '".$max."', '".$x."', '".$cc."', '".$por."', '".date("H:i:s")."', '".date("Y-m-d")."', '".date("Y-m-d")."', '".date("H:i:s")."', '".date("Y-m-d H:i:s")."', '".$user."')";
        mysql_query($sql1); 
       
        }
        if($traz_vid!=0){           
        require '../modelo/calculo_vidrio.php';  
        }
        $sq = "SELECT count(*) FROM `procesos_activos` WHERE id_op=".$_GET['op']."";
        $fil =mysql_fetch_array(mysql_query($sq));
        $con= $fil["count(*)"];
        
        $t = 100 / $con;
         $sql3 = "UPDATE `procesos_activos` SET `por_global`='".$t."' WHERE id_op=".$_GET['op'].";";
         mysql_query($sql3);
         
          
          $sql4 = "UPDATE `cotizaciones` SET `cant_restante`=".$re." WHERE id_cotizacion=".$ref.";";
         mysql_query($sql4);
         
//         
          echo '<script lanquage="javascript">alert(" ha ingresado a produccion");location.href="../vistas/?id=detalle_op&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&op='.$_GET['op'].'"</script>'; 
      
      

        
            }}}
?>