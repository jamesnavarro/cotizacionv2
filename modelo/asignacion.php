<?php 
session_start();
require("conexion.php");
$status = "";

 $a2= $_POST["user"];

 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `acabados` SET `acabado` = '".$a2."' WHERE `id_acabado` = ".$_GET["editar"].";";
                
                mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=acabado"</script>'; 

        }else{


            $sql = "INSERT INTO `asignacion` (`id_area`, `id_user`, `por`)";
            $sql.= "VALUES ('".$_GET['cod']."', '".$a2."', '".$_SESSION['k_username']."')";
            mysql_query($sql, $conexion);

            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=add_user&cod='.$_GET['cod'].'"</script>'; 

        }
                    