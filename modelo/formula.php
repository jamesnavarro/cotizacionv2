<?php
session_start();
require("conexion.php");
$status = "";
            $nombre= $_POST["nom"];
            $alto= $_POST["alto"];
            $op1= $_POST["op1"];
            $ancho= $_POST["ancho"];
            $op2= $_POST["op2"];
            $var1= $_POST["var1"];
            $op3= $_POST["op3"];
            $var2= $_POST["var2"];

           
        if(isset($_GET['editar'])){

                $sql = "UPDATE `producto_rep_alu` SET `id_ref_alum`='".$ref."',`lado`='".$lado."',`medida_r_a`='".$medida_a."',`descuento`='".$descuento."',`cantidad`='".$cant."' WHERE `id_r_a` = ".$_GET["editar"].";";
                 mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del pefil");location.href="../vistas/?id=add_cot&cod='.$_GET['editar'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `formulas` (`nombre`, `alto`, `op1`, `ancho`, `op2`, `var1`, `op3`, `var2`)";
            $sql.= "VALUES ('".$nombre."', '".$alto."', '".$op1."', '".$ancho."', '".$op2."', '".$var1."', '".$op3."', '".$var2."')";
            mysql_query($sql, $conexion);

            $status = "ok";

   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el vidrio");location.href="../vistas/?id=add_form"</script>'; 

        }
	                   