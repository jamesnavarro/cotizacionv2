<?php
include '../clases/clases2.php'; 
    $clases = new general2;
    
    @session_start();
    include '../modelo/conexion.php';
    include '../modelo/consultar_permisos.php';
    
    $mas= $_GET['mas'] = $_GET["mas"];
    $por= $_GET['por'] = $_GET["por"];
    $pagina= $_GET['pagina'] = $_GET["pagina"];
    $idkit = $_GET["idkit"];
    $cotizacion = $_GET['cot'] = $_GET["cot"] = $_GET["cotizacion"];
    $cliente = $_GET["cliente"];

    $sql = "DELETE FROM cotizaciones_kit WHERE id_ck = ".$idkit."";
    mysqli_query($conexion,$sql);
    
    $request_ac=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET['mas']."  ");
      $s3 = "SELECT * FROM cotizaciones where id_cotizacion=".$_GET['mas']."";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $ancho= $fi3["ancho_c"];
                $alto= $fi3["alto_c"];
if($request_ac){
        $total2=0; $cb = 0;
	while($row=mysqli_fetch_array($request_ac))
	{       
              $s3 = "SELECT (".$_GET["por"].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
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
 $total2= $total2 +$mt*$pp;
               $cb += $row["costo_mt"] * $mt;  
	} 
}$request2=mysqli_query($conexion,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=".$_GET['mas']." ");
    
if($request2){
        $total2s=0;
        $to_serv =0;
	while($row2=mysqli_fetch_array($request2))
	{    
               $request_ac1=mysqli_query($conexion,"SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	while($row1=mysqli_fetch_array($request_ac1))
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
$request4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$_GET['mas']."  ");
    
if($request4){

        $t2e=0;
        $to_k =0;   $tksp = 0;    
	while($row21k=mysqli_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
             $t2e= $t2e + 1;
                include '../modelo/suma_kit.php';
            
             $desm = ($row21k['desc_k']/100) * ($totk);
             $ddm = ((($totk) + $desm)) / $porcacc;
             $to_k = $to_k + $ddm; 
                $tksp += $totk; 
	} 
} 
   $t = $to_k + $total2 + $to_serv;
   $tmpsp = $cb + $tksp + $to_serv;
$sql3 = "UPDATE `cotizaciones` SET `precio_material`='".$t."',`precio_fom_sp`='".$tmpsp."'  WHERE `id_cotizacion` = ".$_GET["mas"].";";
                 mysqli_query($conexion,$sql3);

    $clases->mostrarItems3($cotizacion,$cliente,$mas,$por,$pagina); 

?>