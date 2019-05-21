<?php
include '../modelo/conexion.php';
$ver = mysql_query("SELECT id_p, producto FROM `producto` WHERE producto like '%laminado%' ");
while($f = mysql_fetch_array($ver)){
    echo $f[0].' - '.$f[1].'<br>';
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1107', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysql_query($sql, $conexion);
//            
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1764', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysql_query($sql, $conexion);
//            
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1765', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysql_query($sql, $conexion);
//            
//            $sql = "INSERT INTO `producto_rep_acc` (`valor_f`, `can_rej`, `med`, `lado`, `metro`, `yes`,`calcular`, `para`, `id_ref_acc`, `color_acc`, `cantidad_acc`, `id_p`)";
//            $sql.= "VALUES ('0','0', '1', 'Horizontal', '1000', 'No','M2', 'Fabricacion', '1766', 'TRANSPARENTE', '1', '".$f['id_p']."')";
//            mysql_query($sql, $conexion);
//            borrar registro de producto accesorios           
           mysql_query("delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='808' ");
//            mysql_query("delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='1764' ");
//            mysql_query("delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='1765' ");
//            mysql_query("delete from producto_rep_acc where id_p='".$f['id_p']."' and id_ref_acc='1766' ");
}

