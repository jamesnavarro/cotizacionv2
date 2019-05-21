<?php 
session_start();
require("conexion.php");
$status = "";

 $a1= $_POST["inicio"];
 $a2= $_POST["final"];
 $a3= $_POST["precio1"];
 $a4= $_POST["precio2"];
 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `pagos_rangos` SET `inicial` = '".$a1."', `final` = '".$a2."', `precio_oficial` = '".$a3."', `precio_ayud` = '".$a4."' WHERE `id_pr` = ".$_GET["editar"].";";
                
                mysql_query($sql, $conexion) or die(mysql_error());

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=rangos&cod='.$_GET['cod'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `pagos_rangos` (`inicial`,`final`, `precio_oficial`, `precio_ayud`, `id_pago`)";
            $sql.= "VALUES ('".$a1."','".$a2."', '".$a3."', '".$a4."', '".$_GET['cod']."')";
            mysql_query($sql, $conexion) or die(mysql_error());

            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=rangos&cod='.$_GET['cod'].' "</script>'; 

        }
                    