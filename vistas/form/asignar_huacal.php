<?php 
include '../../modelo/conexion.php';
$cotizacion=$_GET["cot"];
$suma=0;
$resultado=0;
$sql=mysqli_query($conexion,"SELECT peso_producto FROM cotizaciones WHERE id_cot='".$cotizacion."' and huacal='Si'");
while ($row=mysqli_fetch_assoc($sql)) {
	$suma= floatval($suma)+ floatval($row['peso_producto']);
	$resultado=number_format($suma);
}
$cantidad=ceil($resultado/80);
$buscar=mysqli_query($conexion,"SELECT id_referencia FROM cotizaciones WHERE id_cot='".$cotizacion."' and id_referencia='1633'");
if($enc=mysqli_num_rows($buscar)==0){
mysqli_query($conexion,"INSERT INTO `cotizaciones` (`id_referencia`,`cantidad_c`,`cant_restante`,`valor_c`,`valor_c_sp`,`valor_fomp`,`estado_c`,`aprobado`,`id_cot`,`porcentaje`,`precio_material`,`id_dolar`)VALUES('1633','".$cantidad."','".$cantidad."','30000','30000','30000','Cotizado','1','".$cotizacion."','0','30000','19')");
mysqli_query($conexion,"UPDATE cotizacion SET peso_cot='".$resultado."', cantidad_huacales='".$cantidad."' WHERE id_cot='".$cotizacion."'");
}else{
mysqli_query($conexion,"UPDATE cotizaciones SET cantidad_c='".$cantidad."' WHERE id_cot='".$cotizacion."' and id_referencia='1633'");
mysqli_query($conexion,"UPDATE cotizacion SET peso_cot='".$resultado."', cantidad_huacales='".$cantidad."' WHERE id_cot='".$cotizacion."'");

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Asignacion</title>
</head>
<body style="background: #4d9900;">
<h1 style="color: white;"><b>Se ha asignado <?php echo $cantidad;?>  huacal a su Orden</b></h1>
<button onclick="window.close();">Salir</button>
</body>
</html>
