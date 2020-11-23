<?php
session_start();
require("conexion.php");

$status = "";
             $med = $_POST["med"];
            $ref = $_POST["ref_ac"];
            $cantidad =$_POST["cantidad"];
            $pro = $_GET['mas'];
            $cot = $_GET['cot'];
             $calcular = $_POST["calcular"];
            $metro =$_POST["metro"];
            $yes = $_POST["yes"];
            $lado =$_POST["lado"];
           $s3 = "SELECT * FROM cotizaciones where id_cotizacion=".$_GET['mas']."";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $ancho= $fi3["ancho_c"];
                $alto= $fi3["alto_c"];
        if(isset($_GET['editar'])){
                $sql = "UPDATE `referencia_acce` SET `med`='".$med."', `num_ref`='".$ref."',`id_cot`='".$pro."',`cantidad_m`='".$cantidad."', `calcular`='".$calcular."',`metro`='".$metro."',`yes`='".$yes."', `lado`='".$lado."' WHERE `id_ref_acce` = ".$_GET["editar"].";";
                 mysqli_query($conexion,$sql);
        }else{
            $sql = "INSERT INTO `referencia_acce` (`med`, `cotizacion`, `num_ref`, `id_cot`, `cantidad_m`, `calcular`, `metro`, `yes`, `lado`)";
            $sql.= "VALUES ('".$med."', '".$cot."', '".$ref."', '".$pro."',  '".$cantidad."', '".$calcular."', '".$metro."', '".$yes."',  '".$lado."')";
            mysqli_query($conexion,$sql);
        }

$id_items = $_GET['mas'];
$_GET['item'] = $_GET['mas'];
include '../vistas/cotizacion/calculo_producto.php';

$sql3 = "UPDATE `cotizaciones` SET `precio_item`='".$precio_venta_total."'  WHERE `id_cotizacion` = ".$_GET["mas"].";";
mysqli_query($conexion,$sql3);    

echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente '.$total2.' ");location.href="../vistas/?id=add_acc&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&mas='.$_GET['mas'].'&por='.$_GET['por'].'&pagina='.$_GET['pagina'].'&tipo_cli='.$_GET['tipo_cli'].'"</script>'; 

      