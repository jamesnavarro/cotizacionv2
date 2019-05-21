<?php
if(isset($_GET['add1'])){
     require '../modelo/conexion.php';
$sqle = "UPDATE `item_fachada_c` SET `cantidad_g` = '".$_POST['cant1']."' WHERE `id_c1` = ".$_GET["add1"]."  and id_cot=".$_GET['cot'].";";
                 mysql_query($sqle, $conexion);
                 
      $sqlx = "UPDATE `cotizaciones` SET `valor_c`='".$gtotal."' WHERE `id_cotizacion` = ".$_GET["cot"].";";
mysql_query($sqlx, $conexion);            
                 
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=ver_fac&ref=".$_GET['ref']."&cot=".$_GET['cot']."&ped=".$_GET['ped']."&cli=".$_GET['cli']."'";
echo "</script>";
}
if(isset($_GET['add2'])){
$sqle = "UPDATE `item_fachada_c1` SET `cantidad_1` = '".$_POST['cant2']."' WHERE `id_c1` = ".$_GET["add2"]."  and id_cot=".$_GET['cot'].";";
                 mysql_query($sqle, $conexion);
                 $request_ac1=mysql_query("SELECT * FROM item_fachada_rep a, referencias b, item_fachada_c1 c  where c.id_c1=a.id_fr and  b.id_referencia=a.id_referencia and a.id_ver=".$_GET['ver']."  and c.id_cot=".$_GET['cot']."");   

        $t1 =0;
	while($row=mysql_fetch_array($request_ac1))
	{      
    
                $t = $cantidad_g * $row['cantidad_1'] * $row["cant"];
                $cs = $t * $row["valor"];
                $t1 = $t1 + $cs;
               
	} 
            
        $request_ac2=mysql_query("SELECT * FROM item_fachada_vid a, tipo_vidrio b, item_fachada_c2 c  where a.id_fr=c.id_c1 and b.id_vidrio=a.id_referencia and a.id_ver=".$_GET['ver']."  and c.id_cot=".$_GET['cot']."");
        $t2=0;
	while($row=mysql_fetch_array($request_ac2))
	{    

        $t = $cantidad_g * $row['cantidad_1'] * $row["cant"];
                $cs = $t * $row["valor"];
                $t2 = $t2 + $cs; 
               
	} 
        $tt = $t1 + $t2;
                 $sql1 = "UPDATE `item_fachada_c` SET  `costo_g` = '".$tt."' WHERE `id_fac` = ".$_GET["ver"]."  and id_cot=".$_GET['cot'].";";
                 mysql_query($sql1, $conexion);

                       $sqlx = "UPDATE `cotizaciones` SET `valor_c`='".$gtotal."' WHERE `id_cotizacion` = ".$_GET["cot"].";";
mysql_query($sqlx, $conexion);  

echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=ver_fac&ref=".$_GET['ref']."&cot=".$_GET['cot']."&ver=".$_GET['ver']."&ped=".$_GET['ped']."&cli=".$_GET['cli']."'";
echo "</script>";
}
if(isset($_GET['add3'])){
$sqle = "UPDATE `item_fachada_c2` SET `cantidad_1` = '".$_POST['cant3']."' WHERE `id_c1` = ".$_GET["add3"]."  and id_cot=".$_GET['cot'].";";
                 mysql_query($sqle, $conexion);
                 
     $request_ac1=mysql_query("SELECT * FROM item_fachada_rep a, referencias b, item_fachada_c1 c  where c.id_c1=a.id_fr and  b.id_referencia=a.id_referencia and a.id_ver=".$_GET['ver']."  and c.id_cot=".$_GET['cot']."");   

        $t1 =0;
	while($row=mysql_fetch_array($request_ac1))
	{      
    
                $t = $cantidad_g * $row['cantidad_1'] * $row["cant"];
                $cs = $t * $row["valor"];
                $t1 = $t1 + $cs;
               
	} 
            
        $request_ac2=mysql_query("SELECT * FROM item_fachada_vid a, tipo_vidrio b, item_fachada_c2 c  where a.id_fr=c.id_c1 and b.id_vidrio=a.id_referencia and a.id_ver=".$_GET['ver']."  and c.id_cot=".$_GET['cot']."");
        $t2=0;
	while($row=mysql_fetch_array($request_ac2))
	{    

        $t = $cantidad_g * $row['cantidad_1'] * $row["cant"];
                $cs = $t * $row["valor"];
                $t2 = $t2 + $cs; 
               
	} 
        $tt = $t1 + $t2;
                 $sql1 = "UPDATE `item_fachada_c` SET  `costo_g` = '".$tt."' WHERE `id_fac` = ".$_GET["ver"]."  and id_cot=".$_GET['cot'].";";
                 mysql_query($sql1, $conexion);   
                 
                       $sqlx = "UPDATE `cotizaciones` SET `valor_c`='".$gtotal."' WHERE `id_cotizacion` = ".$_GET["cot"].";";
mysql_query($sqlx, $conexion);  
                 
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=ver_fac&ref=".$_GET['ref']."&cot=".$_GET['cot']."&ver=".$_GET['ver']."&ped=".$_GET['ped']."&cli=".$_GET['cli']."'";
echo "</script>";
}
