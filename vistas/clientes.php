<?php
include "../modelo/conexion.php";
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Templado S.A</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">
    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">
    <link rel="stylesheet" href="../assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">
    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">
    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">
    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">
    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
<!-- indispensable para cargar municipios-->
    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/buscadores.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script>
$(function(){
    $('#cedula').change(function(){
        var cedula = $("#cedula").val();
        $.ajax({
            type:'GET',
            data:'cedula='+cedula+'&sw=2',
            url:'../vistas/terceros/acciones.php',
            success : function(t){
                var p = eval(t);
                $("#cedula").val(cedula);
                $("#ver").val(p[3]);
                $("#nombre").val(p[1]);
                $("#tipo").val(p[2]);
                $("#direccion").val(p[4]);
                $("#ciudad").val(p[7]);
                $("#municipio").val(p[8]);
                $("#telefono").val(p[5]);
                $("#celular").val(p[6]);
                $("#ema").val(p[11]);
                $("#contacto").val(p[12]);
                if(p[20]=='0'){
                    $("#desv").prop("checked", false );
                }else{
                    $("#desv").prop("checked", true );
                }
                
                $("#idc").val(p[23]);
                 $("#client_asesor").val(p[24]);
            }
                });
    });
});
function guardar_cliente(id){
    var cedula = $("#cedula").val();
    var ver = $("#ver").val();
    var nombre = $("#nombre").val();
    var tipo = $("#tipo").val();
    var direccion = encodeURIComponent($("#direccion").val());
    var ciudad = $("#ciudad").val();
    var municipio = $("#municipio").val();
    var telefono = $("#telefono").val();
    var celular = $("#celular").val();
    var ema = $("#ema").val();
    var contacto = $("#contacto").val();
    var desv = $("#desv").is(":checked");
    var idc = $("#idc").val();
    var clint_ase = $("#client_asesor").val();
    if(cedula==='' || cedula===0){
        alert("Digite el numero de documento");
        $("#cedula").focus();
        return false;
    }
    if(nombre==''){
        alert("Digite el nombre");
        $("#nombre").focus();
        return false;
    }
    if(direccion==''){
        alert("Digite la direccion");
        $("#direccion").focus();
        return false;
    }
    if(ema==''){
        alert("Digite el email");
        $("#ema").focus();
        return false;
    }
     if(telefono==''){
        alert("Digite el telefono");
        $("#telefono").focus();
        return false;
    }
      if(clint_ase==''){
        alert("seleccione el asesor");
        $("#client_asesor").focus();
        return false;
    }
      $.ajax({
            type:'GET',
            data:'cedula='+cedula+'&ver='+ver+'&nombre='+nombre+'&tipo='+tipo+'&direccion='+direccion+'&ciudad='+ciudad+'&municipio='+municipio+'&telefono='+telefono+'&celular='+celular+'&ema='+ema+'&contacto='+contacto+'&desv='+desv+'&idc='+idc+'&clint_ase='+clint_ase+'&sw=1',
            url:'../vistas/terceros/acciones.php',
            success : function(t){
                var p = eval(t);
                 alert(p[0]);
                 $("#idc").val(p[1]);
                 window.closed();
            }
                });
}
function municipio(){
    var ciudad = $("#ciudad").val();
    $.ajax({
            type:'GET',
            data:'dep='+ciudad+'&sw=3',
            url:'../vistas/terceros/acciones.php',
            success : function(t){
                $("#municipio").html(t);

            }
                });
}

        </script>    
</head>
<body onload="pasar_puc();">
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Registro De Clientes</h4>
                                <!-- START Toolbar -->
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse2" class="body collapse in">
                                <div class="body-inner">
                                            <!-- Normal Tabs -->
                            <div class="tabbable" style="margin-bottom: 25px;">
            
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner padding">
                                    <table style="width:100%">
                                        <tr>
                                            <td><label class="control-label">Identificacion</label></td>
                                            <td><input type="text" autocomplete="off"  id="cedula" value="" class="span6" maxlength="18" >-<input type="text"  id="ver" value="" style="width:40px" ></td>
                                            <td>Nombre (Razón Social)</td>
                                            <td><input type="text" autocomplete="off"  id="nombre" value="" class="span12"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="control-label">Tipo de documento</label></td>
                                            <td>
                                                <select  id="tipo" >
                                                    <option value="">Seleccione...</option>
                                                    <option label="" value="CC">Cédula de Ciudadanía</option>
                                                    <option label="" value="PA">Pasaporte</option>
                                                    <option label="" value="CE">Cédula de Extrangería</option>
                                                    <option label="" value="NIT">Nit</option>
                                                </select>
                                            </td>
                                            <td><label class="control-label">Direccion</label></td>
                                            <td><input type="text" id="direccion" value="" class="span12"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="control-label">Departamento</label></td>
                                            <td>
                                                <select name="departamento" id="ciudad"  class="span12" required onchange="municipio();">                   
                                                       
                                                    <?php      
                                                        echo "<option value=''>..Seleccione Departamento</option>"; 
                                                        $consulta = "SELECT * FROM `departamentos` group by nombre_dep";  
                                                        $result=  mysql_query($consulta);                                
                                                        while($fila=  mysql_fetch_array($result)){                 
                                                            $valor1=$fila['cod_dep'];      
                                                            $valor2=$fila['nombre_dep'];      
                                                            echo"<option value='".$valor2."'>".$valor1."- ".$valor2."</option>";   
                                                        }                                                            
                                                    ?>  
                                                </select>
                                            </td>
                                            <td><label class="control-label">Ciudad / Municipio</label> </td>
                                            <td>
                                                <select name="municipio"  id="municipio"  class="span12">         
                                                    <?php 
                                                         $consulta2= "SELECT * FROM `departamentos`  ";  
                                                        $result2=  mysql_query($consulta2);
                                                         echo "<option value='".$municipio."'>".$municipio."</option>";
                                                        while($fila=  mysql_fetch_array($result2)){                 
                                                            $valor1=$fila['cod_mun'];      
                                                            $valor2=$fila['nombre_mun'];      
                                                            echo"<option value='".$valor2."'>".$valor1."- ".$valor2."</option>";   
                                                        }
                                                    ?>    
                                                </select> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="control-label">Telefono Fijo / Fax</label></td>
                                            <td><input type="text" id="telefono" value="" class="span12"></td>
                                            <td><label class="control-label">Telefono Movil</label></td>
                                            <td><input type="text" id="celular" value="" class="span12"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="control-label">Correo Electronico</label></td>
                                            <td><input type="text" id="ema" value="" class="span12" placeholder="ejemplo@gmail.com"</td>
                                            <td><label class="control-label">Contacto</label></td>
                                            <td><input type="text" id="contacto" value="" class="span12" placeholder="nombre del contacto"></td>
                                        </tr>
                                        <tr>
                                            <td><label class="control-label">Desc. Vidrio -30 % </label></td>
                                            <td><input type="checkbox" id="desv" class="span2"></td>
                                            <td><label>Asesor</label></td>
                                            <td>
                                                <select id="client_asesor"  class="span12">         
                                                    <option value="">Seleccione</option>
				                   <?php
                                                     include '../../modelo/conexion.php';
                                                       $consulta2= "SELECT * FROM `usuarios` where area='Ventas' and estado='Activo' order by nombre";   
                                                       $result2=  mysql_query($consulta2);       
                                                        echo"<option value='ADMIN'>ADMIN</option>";  
                                                        while($fila=  mysql_fetch_array($result2)){       
                                                        $valor3=$fila['usuario'];  
                                                        $valor4=$fila['nombre'].' '.$fila['apellido'];   
                                                         echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                                      }                                                       
                               ?>      
                                                </select> 
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td></td><td></td>
                                            <td style="text-align: right" colspan="4" nowrap><button type="button" class="btn btn-success"  onclick="guardar_cliente()">Guardar</button><button type="button" class="btn btn-danger" onclick="window.close();">Cerrar</button></td>
                                            <td><input  type="hidden"  id="idc" value="" class="span3" disabled><span id="msg"></span></td>
                                        </tr>
                                    </table>

                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">
                  
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
</body>
</html>
        <?php require '../vistas/script.php';  ?>

         

                              
                                
