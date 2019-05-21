<?php
session_start();
require("conexion.php");
$status = "";

            $ref= $_POST["ref"];
            $desc= $_POST["desc"];
            $valor= $_POST["valor"];

           
        if(isset($_GET['up'])){

                $sql = "UPDATE `referencia_vid` SET `ref_vid`='".$ref."',`descripcion_v`='".$desc."',`valor_v`='".$valor."' WHERE `id_ref_v` = ".$_GET["up"].";";
                 mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del vidrio");location.href="../vistas/?id=add_vid"</script>'; 

        }else{


            $sql = "INSERT INTO `referencia_vid` (`ref_vid`, `descripcion_v`, `valor_v`)";
            $sql.= "VALUES ('".$ref."', '".$desc."', '".$valor."')";
            mysql_query($sql, $conexion);

            $status = "ok";

   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el vidrio");location.href="../vistas/?id=add_vid"</script>'; 

        }
	                   