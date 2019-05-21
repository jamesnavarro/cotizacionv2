<?php 
session_start();
require("conexion.php");
$status = "";

 $a1= $_POST["grupo"];
 $a2= $_POST["area"];
 $a3= $_POST["pago"];
 $area = mysql_query("select * from subproceso where id_subpro=".$a2." ");
 $a = mysql_fetch_array($area);
 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `grupo` SET `name` = '".$a1."', `id_area` = '".$a2."', `id_pago` = '".$a3."' WHERE `id_g` = ".$_GET["editar"].";";
                
                mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=grupo"</script>'; 

        }else{


            $sql = "INSERT INTO `grupo` (`id_pago`,`id_area`, `name`, `register`, `fecha_reg`, `sede`)";
            $sql.= "VALUES ('".$a3."','".$a2."', '".$a1."', '".$_SESSION['k_username']."', '".date("Y-m-d")."', '".$a['sede_sub']."')";
            mysql_query($sql, $conexion);

            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=grupo"</script>'; 

        }
                    