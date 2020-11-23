<?php
include '../modelo/conexion.php';
$ver = mysqli_query($conexion,"SELECT id_p, producto FROM `producto` WHERE producto like '%laminado%' ");
while($f = mysqli_fetch_array($ver)){
    echo $f[0].' - '.$f[1].'<br>';
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1107', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysqli_query($conexion,$sql);
//            
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1764', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysqli_query($conexion,$sql);
//            
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1765', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysqli_query($conexion,$sql);
//            
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1766', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysqli_query($conexion,$sql);
//            borrar registro de producto accesorios           
           mysqli_query($conexion,"delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='808' ");
//            mysqli_query($conexion,"delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='1764' ");
//            mysqli_query($conexion,"delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='1765' ");
//            mysqli_query($conexion,"delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='1766' ");
}

