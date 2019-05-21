<?php
session_start();
require("conexion.php");

$status = "";
           $s3 = "SELECT * FROM cotizaciones where id_cotizacion=".$_GET['mas']."";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $ancho= $fi3["ancho_c"];
                $alto= $fi3["alto_c"];
            $servicio= $_POST["servicio"];
            $name= $_POST["name_servicio"];
            $cant = $_POST["cant"];
            $desc = $_POST["desc"];
            $valor = $_POST["valor"];
            $obs = $_POST["obs"];
            $total = $cant * $valor;
           //echo $servicio;
        if(isset($_GET['editar'])){
                $sql = "UPDATE `cotizaciones_servicios` SET `id_servicio`='".$servicio."',`cantidad_serv`='".$cant."',`descuento_serv`='".$desc."',`precio_servicio`='".$valor."' WHERE `id_cot_serv` = ".$_GET["editar"].";";
                 mysql_query($sql, $conexion);
       }else{
            if($servicio==''){
                $max = mysql_query("select max(id_ref_mo) from referencia_mo ");
                $m = mysql_fetch_row($max);
                $referencia = 'TEMP-'.($m[0]+1);
                $servicio = ($m[0]+1);
                
                $pr = (100 - 40) / 100; 
                $fr = ($valor);
        
                mysql_query("insert into referencia_mo (referencia,descripcion_mo, valor_mo, instalacion, unidad_cobro,utilidad)"
                        . " values ('$referencia','$name','$valor','No','Und','40')");
                echo '<script lanquage="javascript">alert("Se ha Guardado con exito este servicio, recuerde que el valor agregado se le suma un 40% de utilidad\nPrecio establecido '.$fr.' ");"</script>'; 
            }
            
            $sql = "INSERT INTO `cotizaciones_servicios` (`obs_servicio`, `id_cot_mas`, `id_cotizacion`, `id_servicio`, `cantidad_serv`, `descuento_serv`, `precio_servicio`)";
            $sql.= "VALUES ('$obs', '".$_GET['mas']."', '".$_GET['cot']."', '".$servicio."', '".$cant."', '".$desc."', '".$valor."')";
            mysql_query($sql, $conexion);
        }
$id_items = $_GET['mas'];
$_GET['item'] = $_GET['mas'];
include '../vistas/cotizacion/calculo_producto.php';

$sql3 = "UPDATE `cotizaciones` SET `precio_item`='".$precio_venta_total."'  WHERE `id_cotizacion` = ".$_GET["mas"].";";
mysql_query($sql3, $conexion);        

echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente ");location.href="../vistas/?id=add_acc&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&mas='.$_GET['mas'].'&por='.$_GET['por'].'&pagina='.$_GET['pagina'].'&tipo_cli='.$_GET['tipo_cli'].'"</script>'; 

      