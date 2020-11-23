<?php
include "../modelo/conexion.php";
if(isset($_SESSION['k_username'])){
    //formularios
    if($_GET['id']=='add_cot'){include '../vistas/form/crear_cot.php';}
    if($_GET['id']=='add_fac'){include '../vistas/form/fachada.php';}
    if($_GET['id']=='ver_fac'){include '../vistas/form/fachada_cot.php';}
    if($_GET['id']=='procesos'){include '../vistas/form/procesos.php';}
    if($_GET['id']=='new_cot'){include '../vistas/form/cotizacion.php';}
    if($_GET['id']=='add_acc'){include '../vistas/form/crear_acc.php';}
     if($_GET['id']=='add_per'){include '../vistas/form/crear_per.php';}
     if($_GET['id']=='add_vid'){include '../vistas/form/crear_vid.php';}
    if($_GET['id']=='new_cli'){include '../vistas/form/clientes.php';}
    if($_GET['id']=='add_form'){include '../vistas/form/crear_formula.php';}
    if($_GET['id']=='add_gastos'){include '../vistas/form/crear_gastos.php';}
    if($_GET['id']=='add_mo'){include '../vistas/form/crear_mo.php';}
    if($_GET['id']=='add_otro'){include '../vistas/form/crear_otro.php';}
     if($_GET['id']=='Actividad'){include '../vistas/form/actividad.php';}
      if($_GET['id']=='llamada'){include '../vistas/form/llamadas.php';}
       if($_GET['id']=='reunion'){include '../vistas/form/reuniones.php';}
       if($_GET['id']=='casos'){include '../vistas/form/casos.php';}
       if($_GET['id']=='incidencias'){include '../vistas/form/incidencias.php';}
       if($_GET['id']=='precios'){include '../vistas/form/precios_up.php';}
       if($_GET['id']=='porcentajes'){include '../vistas/form/porcentajes.php';}
       if($_GET['id']=='precios_area'){include '../vistas/form/precios_areas.php';}
       if($_GET['id']=='lineas'){include '../vistas/form/crear_lineas.php';}
        if($_GET['id']=='color'){include '../vistas/form/crear_color.php';}
         if($_GET['id']=='user'){include '../vistas/form/usuarios.php';}
          if($_GET['id']=='temple'){include '../vistas/form/temple.php';}
            if($_GET['id']=='new_fac'){include '../vistas/form/cotizacion_1.php';}
    //tablas
   
     if($_GET['id']=='clientes'){include '../vistas/tablas/cliente.php';}
    if($_GET['id']=='lista'){include '../vistas/tablas/lista.php';}
     if($_GET['id']=='lista_cli'){include '../vistas/tablas/lista_1.php';}
     if($_GET['id']=='lista_cot'){include '../vistas/tablas/cotizaciones.php';}
      if($_GET['id']=='list_user'){include '../vistas/tablas/lista_1_1.php';}
     
     
     //ver detalles
     if($_GET['id']=='ver_proyecto'){include '../vistas/detalles/proyecto.php';}
 if($_GET['id']=='ver_pro'){include '../vistas/form/cotizacion_save.php';}
 if($_GET['id']=='add_fachada'){include '../vistas/form/crear_cot_fachada.php';}
 if($_GET['id']=='stad'){include '../vistas/form/stadistica.php';}
 
 if($_GET['id']=='1'){include '../vistas/form_crm/actividad.php';}
 if($_GET['id']=='2'){include '../vistas/form_crm/casos.php';}
 if($_GET['id']=='3'){include '../vistas/form_crm/cliente.php';}
 if($_GET['id']=='4'){include '../vistas/form_crm/clientes_potenciales.php';}
 if($_GET['id']=='5'){include '../vistas/form_crm/contacto.php';}
 if($_GET['id']=='6'){include '../vistas/form_crm/empresa.php';}
 if($_GET['id']=='7'){include '../vistas/form_crm/incidencias.php';}
 if($_GET['id']=='8'){include '../vistas/form_crm/llamadas.php';}
 if($_GET['id']=='9'){include '../vistas/form_crm/notas.php';}
 if($_GET['id']=='hola'){include '../vistas/form_crm/oportunidades.php';}
 if($_GET['id']=='11'){include '../vistas/form_crm/proyecto.php';}
 if($_GET['id']=='12'){include '../vistas/form_crm/proyectos.php';}
 if($_GET['id']=='13'){include '../vistas/form_crm/reuniones.php';}
 
}else {header("location:../index.php");} 
?>
