<?php 
session_start();
require("conexion.php");
$status = "";

 $a2= $_POST["grupo"];

 $sol = mysqli_query($conexion,"SELECT id_g FROM `asignacion_grupo` where id_g=".$a2." and id_area=".$_GET['cod']." ");
 $r = mysqli_fetch_array($sol);
 
            
        if(isset($_GET['editar'])){
             
                $sql = "UPDATE `acabados` SET `acabado` = '".$a2."' WHERE `id_acabado` = ".$_GET["editar"].";";
                
                mysqli_query($conexion,$sql);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=acabado"</script>'; 

        }else{
if($r['id_g']==$a2){
       echo '<script lanquage="javascript">alert("Este grupo ya esta asignado a una area");location.href="../vistas/?id=add_grupo&cod='.$_GET['cod'].'"</script>'; 
}else{

              $sql = "INSERT INTO `asignacion_grupo` (`id_g`, `id_area`, `por`)";
            $sql.= "VALUES ('".$a2."', '".$_GET['cod']."', '".$_SESSION['k_username']."')";
            mysqli_query($conexion,$sql);


            $status = "ok";
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=add_grupo&cod='.$_GET['cod'].'"</script>'; 
}
        }
                    