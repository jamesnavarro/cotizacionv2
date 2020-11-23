<?php 
session_start();
require("conexion.php");
$status = "";

 $a2= $_POST["user"];

 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `acabados` SET `acabado` = '".$a2."' WHERE `id_acabado` = ".$_GET["editar"].";";
                
                mysqli_query($conexion,$sql);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=acabado"</script>'; 

        }else{


              $sql = "INSERT INTO `grupo_det` (`id_g`, `id_user`, `ingresado_por`, `fecha_ingreso`)";
            $sql.= "VALUES ('".$_GET['cod']."', '".$a2."', '".$_SESSION['k_username']."', '".date("Y-m-d")."')";
            mysqli_query($conexion,$sql);


            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=add_user&cod='.$_GET['cod'].'"</script>'; 

        }
                    