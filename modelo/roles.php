<?php
require("conexion.php");
session_start();
$status = "";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if (isset($_POST["acceso"])) {
	



	$modulo = 'Cotizacion';
        $acceso = $_POST["acceso"];
        $eliminar = $_POST["eliminar"];
        $editar = $_POST["editar"];
        $exportar = $_POST["exportar"];
        $importar = $_POST["importar"];
        $listar = $_POST["listar"];
        $ver = $_POST["ver"];
       
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso1"])) {
	



	$modulo = 'Productos';
        $acceso = $_POST["acceso1"];
        $eliminar = $_POST["eliminar1"];
        $editar = $_POST["editar1"];
        $exportar = $_POST["exportar1"];
        $importar = $_POST["importar1"];
        $listar = $_POST["listar1"];
        $ver = $_POST["ver1"];
        
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	


	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso2"])) {
	



	$modulo = 'Contactos';
        $acceso = $_POST["acceso2"];
        $eliminar = $_POST["eliminar2"];
        $editar = $_POST["editar2"];
        $exportar = $_POST["exportar2"];
        $importar = $_POST["importar2"];
        $listar = $_POST["listar2"];
        $ver = $_POST["ver2"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'CRM', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso3"])) {
	



	$modulo = 'Estadisticas';
        $acceso = $_POST["acceso3"];
        $eliminar = $_POST["eliminar3"];
        $editar = $_POST["editar3"];
        $exportar = $_POST["exportar3"];
        $importar = $_POST["importar3"];
        $listar = $_POST["listar3"];
        $ver = $_POST["ver3"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	


	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso4"])) {
	



	$modulo = 'Materiales';
        $acceso = $_POST["acceso4"];
        $eliminar = $_POST["eliminar4"];
        $editar = $_POST["editar4"];
        $exportar = $_POST["exportar4"];
        $importar = $_POST["importar4"];
        $listar = $_POST["listar4"];
        $ver = $_POST["ver4"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	


	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso5"])) {
	



	$modulo = 'Configuracion';
        $acceso = $_POST["acceso5"];
        $eliminar = $_POST["eliminar5"];
        $editar = $_POST["editar5"];
        $exportar = $_POST["exportar5"];
        $importar = $_POST["importar5"];
        $listar = $_POST["listar5"];
        $ver = $_POST["ver5"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('COTIZACION', '".$_GET['codigo']."','".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso6"])) {
	



	$modulo = 'Pedidos';
        $acceso = $_POST["acceso6"];
        $eliminar = $_POST["eliminar6"];
        $editar = $_POST["editar6"];
        $exportar = $_POST["exportar6"];
        $importar = $_POST["importar6"];
        $listar = $_POST["listar6"];
        $ver = $_POST["ver6"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso7"])) {
	



	$modulo = 'Orden de Produccion';
        $acceso = $_POST["acceso7"];
        $eliminar = $_POST["eliminar7"];
        $editar = $_POST["editar7"];
        $exportar = $_POST["exportar7"];
        $importar = $_POST["importar7"];
        $listar = $_POST["listar7"];
        $ver = $_POST["ver7"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	


	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso8"])) {
	



	$modulo = 'OP Retenidas';
        $acceso = $_POST["acceso8"];
        $eliminar = $_POST["eliminar8"];
        $editar = $_POST["editar8"];
        $exportar = $_POST["exportar8"];
        $importar = $_POST["importar8"];
        $listar = $_POST["listar8"];
        $ver = $_POST["ver8"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	


	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso9"])) {
	



	$modulo = 'OP Remision';
        $acceso = $_POST["acceso9"];
        $eliminar = $_POST["eliminar9"];
        $editar = $_POST["editar9"];
        $exportar = $_POST["exportar9"];
        $importar = $_POST["importar9"];
        $listar = $_POST["listar9"];
        $ver = $_POST["ver9"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso10"])) {
	



	$modulo = 'Fletes';
        $acceso = $_POST["acceso10"];
        $eliminar = $_POST["eliminar10"];
        $editar = $_POST["editar10"];
        $exportar = $_POST["exportar10"];
        $importar = $_POST["importar10"];
        $listar = $_POST["listar10"];
        $ver = $_POST["ver10"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso11"])) {
	



	$modulo = 'Vehiculos';
        $acceso = $_POST["acceso11"];
        $eliminar = $_POST["eliminar11"];
        $editar = $_POST["editar11"];
        $exportar = $_POST["exportar11"];
        $importar = $_POST["importar11"];
        $listar = $_POST["listar11"];
        $ver = $_POST["ver11"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso12"])) {
	



	$modulo = 'Hojas';
        $acceso = $_POST["acceso12"];
        $eliminar = $_POST["eliminar12"];
        $editar = $_POST["editar12"];
        $exportar = $_POST["exportar12"];
        $importar = $_POST["importar12"];
        $listar = $_POST["listar12"];
        $ver = $_POST["ver12"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso13"])) {
	



	$modulo = 'trafico';
        $acceso = $_POST["acceso13"];
        $eliminar = $_POST["eliminar13"];
        $editar = $_POST["editar13"];
        $exportar = $_POST["exportar13"];
        $importar = $_POST["importar13"];
        $listar = $_POST["listar13"];
        $ver = $_POST["ver13"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso14"])) {
	



	$modulo = 'Inventario';
        $acceso = $_POST["acceso14"];
        $eliminar = $_POST["eliminar14"];
        $editar = $_POST["editar14"];
        $exportar = $_POST["exportar14"];
        $importar = $_POST["importar14"];
        $listar = $_POST["listar14"];
        $ver = $_POST["ver14"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso15"])) {
	



	$modulo = 'Compras';
        $acceso = $_POST["acceso15"];
        $eliminar = $_POST["eliminar15"];
        $editar = $_POST["editar15"];
        $exportar = $_POST["exportar15"];
        $importar = $_POST["importar15"];
        $listar = $_POST["listar15"];
        $ver = $_POST["ver15"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso16"])) {
	



	$modulo = 'Proveedores';
        $acceso = $_POST["acceso16"];
        $eliminar = $_POST["eliminar16"];
        $editar = $_POST["editar16"];
        $exportar = $_POST["exportar16"];
        $importar = $_POST["importar16"];
        $listar = $_POST["listar16"];
        $ver = $_POST["ver16"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso17"])) {
	



	$modulo = 'Facturacion';
        $acceso = $_POST["acceso17"];
        $eliminar = $_POST["eliminar17"];
        $editar = $_POST["editar17"];
        $exportar = $_POST["exportar17"];
        $importar = $_POST["importar17"];
        $listar = $_POST["listar17"];
        $ver = $_POST["ver17"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso18"])) {
	
        $modulo = 'Tareas';
        $acceso = $_POST["acceso18"];
        $eliminar = $_POST["eliminar18"];
        $editar = $_POST["editar18"];
        $exportar = $_POST["exportar18"];
        $importar = $_POST["importar18"];
        $listar = $_POST["listar18"];
        $ver = $_POST["ver18"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'CRM', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso19"])) {
	
        $modulo = 'Llamadas';
        $acceso = $_POST["acceso19"];
        $eliminar = $_POST["eliminar19"];
        $editar = $_POST["editar19"];
        $exportar = $_POST["exportar19"];
        $importar = $_POST["importar19"];
        $listar = $_POST["listar19"];
        $ver = $_POST["ver19"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'CRM', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso20"])) {
	
        $modulo = 'Reuniones';
        $acceso = $_POST["acceso20"];
        $eliminar = $_POST["eliminar20"];
        $editar = $_POST["editar20"];
        $exportar = $_POST["exportar20"];
        $importar = $_POST["importar20"];
        $listar = $_POST["listar20"];
        $ver = $_POST["ver20"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'CRM', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}

if (isset($_POST["acceso21"])) {
	
        $modulo = 'Notas';
        $acceso = $_POST["acceso21"];
        $eliminar = $_POST["eliminar21"];
        $editar = $_POST["editar21"];
        $exportar = $_POST["exportar21"];
        $importar = $_POST["importar21"];
        $listar = $_POST["listar21"];
        $ver = $_POST["ver21"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'CRM', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}

if (isset($_POST["acceso22"])) {
	
        $modulo = 'Empresas';
        $acceso = $_POST["acceso22"];
        $eliminar = $_POST["eliminar22"];
        $editar = $_POST["editar22"];
        $exportar = $_POST["exportar22"];
        $importar = $_POST["importar22"];
        $listar = $_POST["listar22"];
        $ver = $_POST["ver22"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'CRM', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}

if (isset($_POST["acceso23"])) {
	
        $modulo = 'Solicitudes';
        $acceso = $_POST["acceso23"];
        $eliminar = $_POST["eliminar23"];
        $editar = $_POST["editar23"];
        $exportar = $_POST["exportar23"];
        $importar = $_POST["importar23"];
        $listar = $_POST["listar23"];
        $ver = $_POST["ver23"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}

if (isset($_POST["acceso24"])) {
	
        $modulo = 'Gestiones';
        $acceso = $_POST["acceso24"];
        $eliminar = $_POST["eliminar24"];
        $editar = $_POST["editar24"];
        $exportar = $_POST["exportar24"];
        $importar = $_POST["importar24"];
        $listar = $_POST["listar24"];
        $ver = $_POST["ver24"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}

if (isset($_POST["acceso25"])) {
	
        $modulo = 'Orden de Compra';
        $acceso = $_POST["acceso25"];
        $eliminar = $_POST["eliminar25"];
        $editar = $_POST["editar25"];
        $exportar = $_POST["exportar25"];
        $importar = $_POST["importar25"];
        $listar = $_POST["listar25"];
        $ver = $_POST["ver25"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ( 'COTIZACION', '".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
          echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=rol'";
     
        echo "</script>";

        

?>
 