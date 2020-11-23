<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
//print "&nbsp;$hora&nbsp;"; 
?>
<?php
session_start();
include "../modelo/conexion.php";
$status = "";

        
  if (isset($_GET['editar'])) {
	
	$modulo = 'Cotizacion';
        $acceso = $_POST["acceso"];
        $eliminar = $_POST["eliminar"];
        $editar = $_POST["editar"];
        $exportar = $_POST["exportar"];
        $importar = $_POST["importar"];
        $listar = $_POST["listar"];
        $ver = $_POST["ver"];
       
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso."', `eliminar` = '".$eliminar."', `editar` = '".$editar."', `exportar` = '".$exportar."', `importar` = '".$importar."', `listar` = '".$listar."', `ver` = '".$ver."', `fecha_modificacion` = '".$fecha_modificacion_rol."' WHERE `roles_accion`.`modulo` = '".$modulo."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo1 = 'Productos';
        $acceso1= $_POST["acceso1"];
        $eliminar1 = $_POST["eliminar1"];
        $editar1 = $_POST["editar1"];
        $exportar1 = $_POST["exportar1"];
        $importar1 = $_POST["importar1"];
        $listar1 = $_POST["listar1"];
        $ver1 = $_POST["ver1"];
       
        $fecha_modificacion_rol1 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso1."', `eliminar` = '".$eliminar1."', `editar` = '".$editar1."', `exportar` = '".$exportar1."', `importar` = '".$importar1."', `listar` = '".$listar1."', `ver` = '".$ver1."', `fecha_modificacion` = '".$fecha_modificacion_rol1."' WHERE `roles_accion`.`modulo` = '".$modulo1."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";

    }
    if (isset($_GET['editar'])) {
	
	$modulo2 = 'Contactos';
        $acceso2 = $_POST["acceso2"];
        $eliminar2 = $_POST["eliminar2"];
        $editar2 = $_POST["editar2"];
        $exportar2 = $_POST["exportar2"];
        $importar2 = $_POST["importar2"];
        $listar2 = $_POST["listar2"];
        $ver2 = $_POST["ver2"];
       
        $fecha_modificacion_rol2 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso2."', `eliminar` = '".$eliminar2."', `editar` = '".$editar2."', `exportar` = '".$exportar2."', `importar` = '".$importar2."', `listar` = '".$listar2."', `ver` = '".$ver2."', `fecha_modificacion` = '".$fecha_modificacion_rol2."' WHERE `roles_accion`.`modulo` = '".$modulo2."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo3 = 'Estadisticas';
        $acceso3 = $_POST["acceso3"];
        $eliminar3 = $_POST["eliminar3"];
        $editar3 = $_POST["editar3"];
        $exportar3 = $_POST["exportar3"];
        $importar3 = $_POST["importar3"];
        $listar3 = $_POST["listar3"];
        $ver3 = $_POST["ver3"];
       
        $fecha_modificacion_rol3 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso3."', `eliminar` = '".$eliminar3."', `editar` = '".$editar3."', `exportar` = '".$exportar3."', `importar` = '".$importar3."', `listar` = '".$listar3."', `ver` = '".$ver3."', `fecha_modificacion` = '".$fecha_modificacion_rol3."' WHERE `roles_accion`.`modulo` = '".$modulo3."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo4 = 'Materiales';
        $acceso4 = $_POST["acceso4"];
        $eliminar4 = $_POST["eliminar4"];
        $editar4 = $_POST["editar4"];
        $exportar4 = $_POST["exportar4"];
        $importar4 = $_POST["importar4"];
        $listar4 = $_POST["listar4"];
        $ver4 = $_POST["ver4"];
       
        $fecha_modificacion_rol4 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso4."', `eliminar` = '".$eliminar4."', `editar` = '".$editar4."', `exportar` = '".$exportar4."', `importar` = '".$importar4."', `listar` = '".$listar4."', `ver` = '".$ver4."', `fecha_modificacion` = '".$fecha_modificacion_rol4."' WHERE `roles_accion`.`modulo` = '".$modulo4."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo5 = 'Configuracion';
        $acceso5 = $_POST["acceso5"];
        $eliminar5 = $_POST["eliminar5"];
        $editar5 = $_POST["editar5"];
        $exportar5 = $_POST["exportar5"];
        $importar5 = $_POST["importar5"];
        $listar5 = $_POST["listar5"];
        $ver5 = $_POST["ver5"];
       
        $fecha_modificacion_rol5 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso5."', `eliminar` = '".$eliminar5."', `editar` = '".$editar5."', `exportar` = '".$exportar5."', `importar` = '".$importar5."', `listar` = '".$listar5."', `ver` = '".$ver5."', `fecha_modificacion` = '".$fecha_modificacion_rol5."' WHERE `roles_accion`.`modulo` = '".$modulo5."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo6 = 'Pedidos';
        $acceso6 = $_POST["acceso6"];
        $eliminar6 = $_POST["eliminar6"];
        $editar6 = $_POST["editar6"];
        $exportar6 = $_POST["exportar6"];
        $importar6 = $_POST["importar6"];
        $listar6 = $_POST["listar6"];
        $ver6 = $_POST["ver6"];
       
        $fecha_modificacion_rol6 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso6."', `eliminar` = '".$eliminar6."', `editar` = '".$editar6."', `exportar` = '".$exportar6."', `importar` = '".$importar6."', `listar` = '".$listar6."', `ver` = '".$ver6."', `fecha_modificacion` = '".$fecha_modificacion_rol6."' WHERE `roles_accion`.`modulo` = '".$modulo6."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo7 = 'Orden de Produccion';
        $acceso7 = $_POST["acceso7"];
        $eliminar7 = $_POST["eliminar7"];
        $editar7 = $_POST["editar7"];
        $exportar7 = $_POST["exportar7"];
        $importar7 = $_POST["importar7"];
        $listar7 = $_POST["listar7"];
        $ver7 = $_POST["ver7"];
       
        $fecha_modificacion_rol7 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso7."', `eliminar` = '".$eliminar7."', `editar` = '".$editar7."', `exportar` = '".$exportar7."', `importar` = '".$importar7."', `listar` = '".$listar7."', `ver` = '".$ver7."', `fecha_modificacion` = '".$fecha_modificacion_rol7."' WHERE `roles_accion`.`modulo` = '".$modulo7."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo8 = 'OP Retenidas';
        $acceso8 = $_POST["acceso8"];
        $eliminar8 = $_POST["eliminar8"];
        $editar8 = $_POST["editar8"];
        $exportar8 = $_POST["exportar8"];
        $importar8 = $_POST["importar8"];
        $listar8 = $_POST["listar8"];
        $ver8 = $_POST["ver8"];
       
        $fecha_modificacion_rol8 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso8."', `eliminar` = '".$eliminar8."', `editar` = '".$editar8."', `exportar` = '".$exportar8."', `importar` = '".$importar8."', `listar` = '".$listar8."', `ver` = '".$ver8."', `fecha_modificacion` = '".$fecha_modificacion_rol8."' WHERE `roles_accion`.`modulo` = '".$modulo8."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'OP Remision';
        $acceso9 = $_POST["acceso9"];
        $eliminar9 = $_POST["eliminar9"];
        $editar9 = $_POST["editar9"];
        $exportar9 = $_POST["exportar9"];
        $importar9 = $_POST["importar9"];
        $listar9 = $_POST["listar9"];
        $ver9 = $_POST["ver9"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	
	$modulo9 = 'Fletes';
        $acceso9 = $_POST["acceso10"];
        $eliminar9 = $_POST["eliminar10"];
        $editar9 = $_POST["editar10"];
        $exportar9 = $_POST["exportar10"];
        $importar9 = $_POST["importar10"];
        $listar9 = $_POST["listar10"];
        $ver9 = $_POST["ver10"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	
	$modulo9 = 'Vehiculos';
        $acceso9 = $_POST["acceso11"];
        $eliminar9 = $_POST["eliminar11"];
        $editar9 = $_POST["editar11"];
        $exportar9 = $_POST["exportar11"];
        $importar9 = $_POST["importar11"];
        $listar9 = $_POST["listar11"];
        $ver9 = $_POST["ver11"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	
	$modulo9 = 'Hojas';
        $acceso9 = $_POST["acceso12"];
        $eliminar9 = $_POST["eliminar12"];
        $editar9 = $_POST["editar12"];
        $exportar9 = $_POST["exportar12"];
        $importar9 = $_POST["importar12"];
        $listar9 = $_POST["listar12"];
        $ver9 = $_POST["ver12"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	
	$modulo9 = 'trafico';
        $acceso9 = $_POST["acceso13"];
        $eliminar9 = $_POST["eliminar13"];
        $editar9 = $_POST["editar13"];
        $exportar9 = $_POST["exportar13"];
        $importar9 = $_POST["importar13"];
        $listar9 = $_POST["listar13"];
        $ver9 = $_POST["ver13"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Inventario';
        $acceso9 = $_POST["acceso14"];
        $eliminar9 = $_POST["eliminar14"];
        $editar9 = $_POST["editar14"];
        $exportar9 = $_POST["exportar14"];
        $importar9 = $_POST["importar14"];
        $listar9 = $_POST["listar14"];
        $ver9 = $_POST["ver14"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Compras';
        $acceso9 = $_POST["acceso15"];
        $eliminar9 = $_POST["eliminar15"];
        $editar9 = $_POST["editar15"];
        $exportar9 = $_POST["exportar15"];
        $importar9 = $_POST["importar15"];
        $listar9 = $_POST["listar15"];
        $ver9 = $_POST["ver15"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Proveedores';
        $acceso9 = $_POST["acceso16"];
        $eliminar9 = $_POST["eliminar16"];
        $editar9 = $_POST["editar16"];
        $exportar9 = $_POST["exportar16"];
        $importar9 = $_POST["importar16"];
        $listar9 = $_POST["listar16"];
        $ver9 = $_POST["ver16"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Facturacion';
        $acceso9 = $_POST["acceso17"];
        $eliminar9 = $_POST["eliminar17"];
        $editar9 = $_POST["editar17"];
        $exportar9 = $_POST["exportar17"];
        $importar9 = $_POST["importar17"];
        $listar9 = $_POST["listar17"];
        $ver9 = $_POST["ver17"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Tareas';
        $acceso9 = $_POST["acceso18"];
        $eliminar9 = $_POST["eliminar18"];
        $editar9 = $_POST["editar18"];
        $exportar9 = $_POST["exportar18"];
        $importar9 = $_POST["importar18"];
        $listar9 = $_POST["listar18"];
        $ver9 = $_POST["ver18"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Llamadas';
        $acceso9 = $_POST["acceso19"];
        $eliminar9 = $_POST["eliminar19"];
        $editar9 = $_POST["editar19"];
        $exportar9 = $_POST["exportar19"];
        $importar9 = $_POST["importar19"];
        $listar9 = $_POST["listar19"];
        $ver9 = $_POST["ver19"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Reuniones';
        $acceso9 = $_POST["acceso20"];
        $eliminar9 = $_POST["eliminar20"];
        $editar9 = $_POST["editar20"];
        $exportar9 = $_POST["exportar20"];
        $importar9 = $_POST["importar20"];
        $listar9 = $_POST["listar20"];
        $ver9 = $_POST["ver20"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo9 = 'Notas';
        $acceso9 = $_POST["acceso21"];
        $eliminar9 = $_POST["eliminar21"];
        $editar9 = $_POST["editar21"];
        $exportar9 = $_POST["exportar21"];
        $importar9 = $_POST["importar21"];
        $listar9 = $_POST["listar21"];
        $ver9 = $_POST["ver21"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `roles_accion`.`modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
     if (isset($_GET['editar'])) {
	
	$modulo2 = 'Empresas';
        $acceso2 = $_POST["acceso22"];
        $eliminar2 = $_POST["eliminar22"];
        $editar2 = $_POST["editar22"];
        $exportar2 = $_POST["exportar22"];
        $importar2 = $_POST["importar22"];
        $listar2 = $_POST["listar22"];
        $ver2 = $_POST["ver22"];
       
        $fecha_modificacion_rol2 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso2."', `eliminar` = '".$eliminar2."', `editar` = '".$editar2."', `exportar` = '".$exportar2."', `importar` = '".$importar2."', `listar` = '".$listar2."', `ver` = '".$ver2."', `fecha_modificacion` = '".$fecha_modificacion_rol2."' WHERE `roles_accion`.`modulo` = '".$modulo2."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo2 = 'Solicitudes';
        $acceso2 = $_POST["acceso23"];
        $eliminar2 = $_POST["eliminar23"];
        $editar2 = $_POST["editar23"];
        $exportar2 = $_POST["exportar23"];
        $importar2 = $_POST["importar23"];
        $listar2 = $_POST["listar23"];
        $ver2 = $_POST["ver23"];
       
        $fecha_modificacion_rol2 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso2."', `eliminar` = '".$eliminar2."', `editar` = '".$editar2."', `exportar` = '".$exportar2."', `importar` = '".$importar2."', `listar` = '".$listar2."', `ver` = '".$ver2."', `fecha_modificacion` = '".$fecha_modificacion_rol2."' WHERE `roles_accion`.`modulo` = '".$modulo2."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo2 = 'Gestiones';
        $acceso2 = $_POST["acceso24"];
        $eliminar2 = $_POST["eliminar24"];
        $editar2 = $_POST["editar24"];
        $exportar2 = $_POST["exportar24"];
        $importar2 = $_POST["importar24"];
        $listar2 = $_POST["listar24"];
        $ver2 = $_POST["ver24"];
       
        $fecha_modificacion_rol2 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso2."', `eliminar` = '".$eliminar2."', `editar` = '".$editar2."', `exportar` = '".$exportar2."', `importar` = '".$importar2."', `listar` = '".$listar2."', `ver` = '".$ver2."', `fecha_modificacion` = '".$fecha_modificacion_rol2."' WHERE `roles_accion`.`modulo` = '".$modulo2."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
    
    if (isset($_GET['editar'])) {
	
	$modulo2 = 'Orden de Compra';
        $acceso2 = $_POST["acceso25"];
        $eliminar2 = $_POST["eliminar25"];
        $editar2 = $_POST["editar25"];
        $exportar2 = $_POST["exportar25"];
        $importar2 = $_POST["importar25"];
        $listar2 = $_POST["listar25"];
        $ver2 = $_POST["ver25"];
       
        $fecha_modificacion_rol2 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso2."', `eliminar` = '".$eliminar2."', `editar` = '".$editar2."', `exportar` = '".$exportar2."', `importar` = '".$importar2."', `listar` = '".$listar2."', `ver` = '".$ver2."', `fecha_modificacion` = '".$fecha_modificacion_rol2."' WHERE `roles_accion`.`modulo` = '".$modulo2."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysqli_query($conexion,$sql);
       $status = "ok";
        
    }
       echo '<script lanquage="javascript">alert("Se ha editado exitosamente");location.href="../vistas/?id=rol&codigo='.$_GET['editar'].'"</script>'; 
  
     
    ?>