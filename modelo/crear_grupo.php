<?php 
session_start();
require("conexion.php");
$status = "";

 $a1= $_POST["grupo"];
 $a2= $_POST["area"];
 $a3= $_POST["pago"];
 $area = mysqli_query($conexion,"select * from subproceso where id_subpro=".$a2." ");
 $a = mysqli_fetch_array($area);
 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `grupo` SET `name` = '".$a1."', `id_area` = '".$a2."', `id_pago` = '".$a3."' WHERE `id_g` = ".$_GET["editar"].";";
                
                mysqli_query($conexion,$sql);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=grupo"</script>'; 

        }else{


            $sql = "INSERT INTO `grupo` (`id_pago`,`id_area`, `name`, `register`, `fecha_reg`, `sede`)";
            $sql.= "VALUES ('".$a3."','".$a2."', '".$a1."', '".$_SESSION['k_username']."', '".date("Y-m-d")."', '".$a['sede_sub']."')";
            mysqli_query($conexion,$sql);

            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=grupo"</script>'; 

        }
                    