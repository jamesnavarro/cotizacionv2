<?php
include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $por = $_GET["por"];
    $pagina = $_GET["pagina"];
    $mas = $_GET["mas"];
    $id_cotizacion = $_GET['idcotizacion'];
    $cotizacion = $_GET['cotizacion'];
    $cliente = $_GET['cliente'];

$sql = "DELETE FROM cotizaciones_sub WHERE id_cotizacion_sub = ".$id_cotizacion."";
mysqli_query($conexion,$sql);

$request=mysqli_query($conexion,"SELECT * FROM producto a,  cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$cotizacion." and c.id_producto_cot=".$mas."");   
if($request){
        $ta2 =0;
        $cont =0;
	while($row=mysqli_fetch_array($request))
	{
           
            $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
                
        
            $cont = $cont + 1;
            $suma = $row["valor_c_sub"]+$row["costo_v"];
            $a = $suma * $mult2;
            $b = $a + $suma;
            $ta2 = $ta2 + $b;
            $pu = ($b)/$row["cantidad_c_sub"];       
	} 
} 
//echo 'xxxxx'.$ta2;
$sql3 = "UPDATE `cotizaciones` SET `precio_adicional`='".$ta2."'  WHERE `id_cotizacion` = ".$mas.";";
mysqli_query($conexion,$sql3);

$clases->mostrarItems($cotizacion,$cliente,$mas,$por,$pagina); 

?>