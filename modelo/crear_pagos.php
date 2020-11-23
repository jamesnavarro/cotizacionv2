<?php 
session_start();
require("conexion.php");
$status = "";

 $a1= $_POST["pago"];
 $a2= $_POST["codigo"];
 $a3= $_POST["tipo"];

 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `pagos` SET `desc_pago` = '".$a2."', `tipo` = '".$a3."', `observacion` = '".$a1."', `registro_p` = '".$_SESSION['k_username']."' WHERE `id_pago` = ".$_GET["editar"].";";
                
                mysqli_query($conexion,$sql) ;

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=pagos"</script>'; 

        }else{


            $sql = "INSERT INTO `pagos` (`desc_pago`,`tipo`, `observacion`, `registro_p`)";
            $sql.= "VALUES ('".$a2."','".$a3."', '".$a1."', '".$_SESSION['k_username']."')";
            mysqli_query($conexion,$sql) ;

            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=pagos"</script>'; 

        }
                    