<?php
    include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $mas = $_GET["mas"];
    $por = $_GET["por"];
    $pagina = $_GET["pagina"];
    $idservi = $_GET["idservi"];
    $cotizacion = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];
    $servicio = $_GET["servicio"];
    $cant = $_GET["cant"];
    $desc = $_GET["desc"];
    
    $s3 = "SELECT * FROM cotizaciones where id_cotizacion=".$mas."";
    $fi3 =mysql_fetch_array(mysql_query($s3));
        $ancho= $fi3["ancho_c"];
        $alto= $fi3["alto_c"];
        $servicio= $_GET["servicio"];
        $cant= $_GET["cant"];
        $desc= $_GET["desc"];

    $sql = "UPDATE `cotizaciones_servicios` SET `id_servicio`='".$servicio."',`cantidad_serv`='".$cant."',`descuento_serv`='".$desc."' WHERE `id_cot_serv` = ".$idservi.";";
    mysql_query($sql, $conexion);
    
    $request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$cotizacion." and b.id_cot_mas=".$mas." ");
    
    if($request2){
        $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
               $request_ac1=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	while($row1=mysql_fetch_array($request_ac1))
	{       
            $por = 100;
            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);      
	} 
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["valor_mo"] + $tota) / $pr;
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
             $to_serv = $to_serv + $dd;    
	} 
} 
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

}
$t = $to_k + $total2 + $to_serv;
$tmpsp = $cb + $tksp + $to_serv;
$sql3 = "UPDATE `cotizaciones` SET `precio_material`='".$t."',`precio_fom_sp`='".$tmpsp."'  WHERE `id_cotizacion` = ".$mas.";";
mysql_query($sql3, $conexion);
    
    $clases->mostrarItems2($cotizacion,$cliente,$mas,$por,$pagina); 
    
    
    
?>

