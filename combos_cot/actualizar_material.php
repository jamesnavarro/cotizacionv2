<?php
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $idmaterial = $_GET["idmaterial"];
    $mas = $_GET["mas"];
    $por = $_GET["por"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $refe = $_GET["refe"];
    $cantidad = $_GET["cantidad"];
    $med = $_GET["med"];
    $perimetro = $_GET["perimetro"];
    $metro = $_GET["metro"];
    $yes = $_GET["yes"];
    $lado = $_GET["lado"];

    $s3 = "SELECT * FROM cotizaciones where id_cotizacion=".$mas."";
    $fi3 =mysql_fetch_array(mysql_query($s3));
        $ancho= $fi3["ancho_c"];
        $alto= $fi3["alto_c"];
                
                $sql = "UPDATE `referencia_acce` SET `med`='".$med."', `num_ref`='".$refe."',`id_cot`='".$mas."',`cantidad_m`='".$cantidad."', `calcular`='".$perimetro."',`metro`='".$metro."',`yes`='".$yes."', `lado`='".$lado."' WHERE `id_ref_acce` = ".$idmaterial.";";
                 mysql_query($sql, $conexion);
        

$request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$cotizacion." and b.id_prod_mas=".$mas."  ");
    
if($request4){

        $t2e=0;
        $to_k =0;  $tksp = 0;   
	while($row21k=mysql_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             $ddm = ((($totk) + $desm)) / $porcacc;
             $to_k = $to_k + $ddm; 
             $tksp += $totk; 
	} 
} 	                
$request_ac=mysql_query("SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$cotizacion." and a.id_cot=".$mas."  ");
     
if($request_ac){

        $total2=0; $cb = 0;
	while($row=mysql_fetch_array($request_ac))
	{         $s3 = "SELECT (".$por.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult= $fi3["p"]/100;
                $pp = $row["costo_mt"]/$mult;
                if($row["med"]==1){
                    $v = 1;
                }else{
                    $v = $row["med"]/1000;
                }
                 if($row["calcular"]=='ML'){
                if($row["lado"]=='Vertical'){
                $mt = ($alto/1000)*($row["metro"]/1000);
                }else{
                $mt = ($ancho/1000)*($row["metro"]/1000);
                }

                }else{
                 $mt = $row["cantidad_m"] * $v;
                }
 $total2= ($total2 +$mt*$pp);
  $cb += $row["costo_mt"] * $mt;  
               
	} 
$t = $to_k + $total2;
$tmpsp = $cb + $tksp;
}
$sql3 = "UPDATE `cotizaciones` SET `precio_material`='".$t."',`precio_fom_sp`='".$tmpsp."'  WHERE `id_cotizacion` = ".$mas.";";
mysql_query($sql3, $conexion);   
    
    $clases->mostrarItems6($cotizacion,$cliente,$mas,$por); 
    
    
    
?>

