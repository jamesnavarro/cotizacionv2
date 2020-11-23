<?php
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $mas = $_GET["mas"];
    $por = $_GET["por"];
    $pagina = $_GET["pagina"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["refe"];
    $color = $_GET["color"];
    $cant = $_GET["cant"];
    $desc = $_GET["desc"];
    $mp = $_GET["mp"];
    
    $sql = "INSERT INTO `cotizaciones_kit` (`por_k`, `id_cot`, `id_producto`, `cantidad_k`, `desc_k`, `id_prod_mas`, `comp`,`color_k`)";
    $sql.= "VALUES ('".$mp."','".$cotizacion."', '".$servicio."', '".$cant."', '".$desc."','".$mas."', '1','".$color."')";
    mysqli_query($conexion,$sql);
    $status = "ok";
    
    $request4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$cotizacion." and b.id_prod_mas=".$mas."  ");
    
if($request4){

        $t2e=0;
        $to_k =0;  
        $tksp = 0;
	while($row21k=mysqli_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$por.") as p FROM porcentajes where  area_por='".$row21k["linea"]."'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
              $porcacc4= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             echo $ddm = ($totk + $desm) / $porcacc4;
             $to_k = $to_k + $ddm; 
              $tksp += $totk; 
	} 
} echo ' ---- '.$to_k;
        $request_ac=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$cotizacion." and a.id_cot=".$mas."  ");
     
if($request_ac){

        $total2=0;
        $cb = 0;
	while($row=mysqli_fetch_array($request_ac))
	{         $s3 = "SELECT (".$_GET["por"].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
                $pp = $row["costo_mt"]/$mult;
                 if($row["calcular"]=='ML'){
                if($row["lado"]=='Vertical'){
                $mt = ($alto/1000)*($row["metro"]/1000);
                }else{
                $mt = ($ancho/1000)*($row["metro"]/1000);
                }

                }else{
                 $mt = $row["cantidad_m"];
                }
 $total2 = ($total2 +$mt*$pp);
      $cb += $row["costo_mt"] * $mt;         
	} 
$t = $to_k + $total2;
$tmpsp = $cb + $tksp;
}

$sql3 = "UPDATE `cotizaciones` SET `precio_material`='".$t."',`precio_fom_sp`='".$tmpsp."'   WHERE `id_cotizacion` = ".$mas.";";
mysqli_query($conexion,$sql3);
            
    $clases->mostrarItems3($cotizacion,$cliente,$mas,$por,$pagina); 
?>