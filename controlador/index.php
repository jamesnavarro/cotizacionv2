<?php
include "../modelo/conexion.php";
if(isset($_SESSION['k_username'])){
    //formularios 478ab3d6f1745eb134e89f149ed87c54
    $sql2m = "SELECT id_emisor,count(*) FROM mensajes where visto=0 and id_receptor='".$_SESSION['id_user']."' group by id_emisor";
$fi =mysql_fetch_array(mysql_query($sql2m));
$m= $fi["count(*)"];
if ($m>=1){
    
  $reg=$fi['id_emisor'];
 
  
}
     if($_GET['id']=='cot_aprobadas'){if($crear_conf=='Habilitado'){include '../vistas/tablas/cotizaciones_ok.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='add_cot'){if($crear_conf=='Habilitado'){include '../vistas/form/crear_cot.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='conf_kits'){if($crear_conf=='Habilitado'){include '../vistas/version2/kits/index.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='nuevo_producto'){if($crear_conf=='Habilitado'){include '../vistas/version2/nuevo_producto.php';}else{include '../vistas/form/denied.php';}}
      if($_GET['id']=='sincronizar'){if($crear_conf=='Habilitado'){include '../vistas/version2/materiales/index.php';}else{include '../vistas/form/denied.php';}}
      
    if($_GET['id']=='add_fac'){if($crear_conf=='Habilitado'){include '../vistas/form/fachada.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='ver_fac'){if($acceso_cot=='Habilitado'){include '../vistas/form/fachada_cot.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='procesos'){if($acceso_cot=='Habilitado'){include '../vistas/form/procesos.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='new_cot'){if($acceso_cot=='Habilitado'){include '../vistas/form/cotizacion.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='add_acc'){if($acceso_cot=='Habilitado'){include '../vistas/form/crear_acc.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='add_per'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_per.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='add_vid'){if($acceso_cot=='Habilitado'){include '../vistas/form/crear_vid.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='new_cli'){if($crear_con=='Habilitado'){include '../vistas/form/clientes.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='add_form'){if($acceso_cot=='Habilitado'){include '../vistas/form/crear_formula.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='add_gastos'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_gastos.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='md'){if($acceso_conf=='Habilitado'){include '../vistas/form/conf_dolar.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='add_mo'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_mo.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='add_otro'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_otro.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='Actividad'){if($crear_pro=='Habilitado'){include '../vistas/form/actividad.php';}else{include '../vistas/form/denied.php';}}
      if($_GET['id']=='llamada'){if($crear_act=='Habilitado'){include '../vistas/form/llamadas.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='reunion'){if($crear_pro=='Habilitado'){include '../vistas/form/reuniones.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='casos'){if($crear_cas=='Habilitado'){include '../vistas/form/casos.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='incidencias'){if($crear_inc=='Habilitado'){include '../vistas/form/incidencias.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='precios'){if($acceso_conf=='Habilitado'){include '../vistas/form/precios_up.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='porcentajes'){if($acceso_conf=='Habilitado'){include '../vistas/form/porcentajes.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='precios_area'){if($_SESSION["admin"]=='Si'){include '../vistas/form/precios_areas.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='master'){if($acceso_pro=='Habilitado'){include '../vistas/produccion/master_produccion.php';}else{include '../vistas/form/denied.php';}}
       if($_GET['id']=='lineas'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_lineas.php';}else{include '../vistas/form/denied.php';}}
        if($_GET['id']=='color'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_color.php';}else{include '../vistas/form/denied.php';}}
         if($_GET['id']=='historial'){if($acceso_conf=='Habilitado'){include '../vistas/form/movimiento_referencias.php';}else{include '../vistas/form/denied.php';}}
                if($_GET['id']=='maq'){if($acceso_conf=='Habilitado'){include '../vistas/form/maquinas.php';}else{include '../vistas/form/denied.php';}}
                if($_GET['id']=='user'){if($_SESSION["admin"]=='Si'){include '../vistas/form/usuarios.php';}else{include '../vistas/form/denied.php';}}
          if($_GET['id']=='temple'){if($acceso_conf=='Habilitado'){include '../vistas/form/temple.php';}else{include '../vistas/form/denied.php';}}
            if($_GET['id']=='new_fac'){if($acceso_cot=='Habilitado'){include '../vistas/form/cotizacion_1.php';}else{include '../vistas/form/denied.php';}}
            if($_GET['id']=='new_fac_aprobadas'){if($acceso_cot=='Habilitado'){include '../vistas/form/cotizacion_aprobadas.php';}else{include '../vistas/form/denied.php';}}
            if($_GET['id']=='send'){if($acceso_cot=='Habilitado'){include '../vistas/form/email.php';}else{include '../vistas/form/denied.php';}}
            if($_GET['id']=='rol'){if($_SESSION["admin"]=='Si'){include '../vistas/form/rol.php';}else{include '../vistas/form/denied.php';}}
         if($_GET['id']=='op'){if($acceso_op=='Habilitado'){include '../vistas/form/generar_op.php';}else{include '../vistas/form/denied.php';}}
         if($_GET['id']=='detalle_op'){if($acceso_cot=='Habilitado'){include '../vistas/form/orden_produccion.php';}else{include '../vistas/form/denied.php';}}
         if($_GET['id']=='servicios'){if($acceso_conf=='Habilitado'){include '../vistas/form/crear_servicios.php';}else{include '../vistas/form/denied.php';}}
         if($_GET['id']=='add_ga'){if($acceso_conf=='Habilitado'){include '../vistas/form/gastos_admin.php';}else{include '../vistas/form/denied.php';}}
          if($_GET['id']=='ver_gastos'){if($acceso_conf=='Habilitado'){include '../vistas/form/gastos_admin_1.php';}else{include '../vistas/form/denied.php';}}
          if($_GET['id']=='compuestos'){if($crear_pro=='Habilitado'){include '../vistas/form/crear_compuestos.php';}else{include '../vistas/form/denied.php';}}
           if($_GET['id']=='soporte'){if($acceso_conf=='Habilitado'){include '../vistas/reportes.php';}else{include '../vistas/form/denied.php';}}
   if($_GET['id']=='movimientos'){if($acceso_conf=='Habilitado'){include '../vistas/form/ingreso_items.php';}else{include '../vistas/form/denied.php';}}
         if($_GET['id']=='tiempo'){if($ver_cot=='Habilitado'){include '../vistas/estadistica.php';}else{include '../vistas/form/denied.php';}}
      if($_GET['id']=='tiempo_asesores'){if($ver_cot=='Habilitado'){include '../vistas/estadistica_asesores.php';}else{include '../vistas/form/denied.php';}}
         //tablas
   
     if($_GET['id']=='terceros'){if($crear_con=='Habilitado'){include '../vistas/contactos/terceros.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='contactos'){if($acceso_con=='Habilitado'){include '../vistas/contactos/lista.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='ver_contacto'){if($ver_con=='Habilitado'){include '../vistas/contactos/ver_contacto.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='empresa'){if($crear_emp=='Habilitado'){include '../vistas/empresa/empresa.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='empresas'){if($acceso_emp=='Habilitado'){include '../vistas/empresa/lista.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='ver_empresa'){if($ver_emp=='Habilitado'){include '../vistas/empresa/ver_empresa.php';}else{include '../vistas/form/denied.php';}}
     
    if($_GET['id']=='lista'){if($acceso_conf=='Habilitado'){include '../vistas/tablas/lista.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='lista_ok'){if($acceso_conf=='Habilitado'){include '../vistas/tablas/lista-ok.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='lista_anuladas'){if($acceso_conf=='Habilitado'){include '../vistas/tablas/lista_2.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='lista_sa'){if($acceso_conf=='Habilitado'){include '../vistas/tablas/lista_sin_aprobar.php';}else{include '../vistas/form/denied.php';}}
     
    if($_GET['id']=='lista_cli'){if($acceso_con=='Habilitado'){include '../vistas/tablas/lista_1.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='lista_cot'){if($acceso_cot=='Habilitado'){include '../vistas/tablas/cotizaciones.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='pedidos'){if($acceso_ped=='Habilitado'){include '../vistas/tablas/pedidos.php';}else{include '../vistas/form/denied.php';}}
      if($_GET['id']=='list_user'){if($_SESSION["admin"]=='Si'){include '../vistas/tablas/lista_1_1.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='add_user'){if($acceso_cot=='Habilitado'){include '../vistas/form/asignar_user.php';}else{include '../vistas/form/denied.php';}}
     if($_GET['id']=='add_grupo'){if($acceso_cot=='Habilitado'){include '../vistas/form/asignar_grupo.php';}else{include '../vistas/form/denied.php';}}
      if($_GET['id']=='grupo'){if($acceso_cot=='Habilitado'){include '../vistas/form/grupos.php';}else{include '../vistas/form/denied.php';}}
           if($_GET['id']=='pagos'){if($acceso_cot=='Habilitado'){include '../vistas/form/pagos.php';}else{include '../vistas/form/denied.php';}}
                if($_GET['id']=='rangos'){if($acceso_cot=='Habilitado'){include '../vistas/form/pagos_rangos.php';}else{include '../vistas/form/denied.php';}}
     //ver detalles 
     if($_GET['id']=='ver_proyecto'){if($acceso_cot=='Habilitado'){include '../vistas/detalles/proyecto.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='ver_pro'){if($ver_pro=='Habilitado'){include '../vistas/form/cotizacion_save.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='ver_dt'){if($ver_pro=='Habilitado'){include '../vistas/cotizacion/dt.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='ver_pro_fom'){if($ver_pro=='Habilitado'){include '../vistas/form/cotizacion_save_fom.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='add_fachada'){if($crear_conf=='Habilitado'){include '../vistas/form/crear_cot_fachada.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='stad'){if($acceso_est=='Habilitado'){include '../vistas/form/stadistica.php';}else{include '../vistas/form/denied.php';}}
 
 if($_GET['id']=='areas_vi'){if($acceso_pro=='Habilitado'){include '../vistas/areas/vidrio.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='areas_al'){if($acceso_pro=='Habilitado'){include '../vistas/areas/aluminio.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='areas_ac'){if($acceso_pro=='Habilitado'){include '../vistas/areas/acero.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='mi_area'){include '../vistas/areas/areas_user.php';}
  if($_GET['id']=='pr'){if($acceso_rem=='Habilitado'){include '../vistas/form/productos_terminados.php';}else{include '../vistas/form/denied.php';}}
   if($_GET['id']=='pt'){if($acceso_ret=='Habilitado'){include '../vistas/form/productos_retenidos.php';}else{include '../vistas/form/denied.php';}}
   if($_GET['id']=='pt_detalles'){if($acceso_ret=='Habilitado'){include '../vistas/form/productos_retenidos_poraprobar.php';}else{include '../vistas/form/denied.php';}}
  if($_GET['id']=='facturar'){include '../vistas/form/productos_facturar.php';}
  if($_GET['id']=='remisiones'){if($acceso_rem=='Habilitado'){include '../vistas/form/productos_remisionados.php';}else{include '../vistas/form/denied.php';}}
    if($_GET['id']=='remision'){include '../vistas/form/remisiones.php';}
if($_GET['id']=='comisiones'){if($acceso_rem=='Habilitado'){include '../vistas/form/comisiones.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='lista_empresa'){if($acceso_cot=='Habilitado'){include '../vistas/lista_empresa.php';}else{include '../vistas/form/denied.php';}}
 
 if($_GET['id']=='asignar_area'){if($acceso_est=='Habilitado'){include '../vistas/areas/asignaciones.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='2'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/casos.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='3'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/cliente.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='4'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/clientes_potenciales.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='5'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/contacto.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='6'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/empresa.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='7'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/incidencias.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='8'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/llamadas.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='9'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/notas.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='hola'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/oportunidades.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='11'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/proyecto.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='12'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/proyectos.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='13'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/reuniones.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='13'){if($acceso_cot=='Habilitado'){include '../vistas/form_crm/reuniones.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='costos'){if($crear_conf=='Habilitado'){include '../vistas/costos/index.php';}else{include '../vistas/form/denied.php';}}
  if($_GET['id']=='comision'){if($crear_conf=='Habilitado'){include '../vistas/comision/index.php';}else{include '../vistas/form/denied.php';}}
  if($_GET['id']=='categorias'){if($crear_conf=='Habilitado'){include '../vistas/categorias/index.php';}else{include '../vistas/form/denied.php';}}
   if($_GET['id']=='sistemas'){if($crear_conf=='Habilitado'){include '../vistas/sistemas/index.php';}else{include '../vistas/form/denied.php';}}
 if($_GET['id']=='stop'){include '../vistas/form/denied.php';}
 
 
}else {header("location:../../principal/index.php");} 
?>
