<?php
session_start();
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
if(isset($_SESSION['k_username'])){
if(isset($_GET['descargar'])){
$filename = $_GET['descargar'];
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../cotizaciones/".$filename;
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
  return;
    }
            if(isset($_GET['download_gestion'])){
$filename = 'gestion_de_tiempo.csv';
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../vistas/gestion_de_tiempo.csv";
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
  return;
    }
    if(isset($_GET['download'])){
$filename = 'reporte.csv';
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../vistas/reporte.csv";
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
 echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=new_fac&cot=".$_GET['cot']."&cli=".$_GET['cli']."'";
echo "</script>"; 
    }
if(isset($_GET['add'])){

    
     include '../modelo/conexion.php'; 
 $sql = "UPDATE `cotizacion` SET aiu='".$_POST['aiu']."', precio='".$_POST['precio']."', costo_total=".$_POST['gt'].", descuento=".$_POST['desc']." WHERE `id_cot` = ".$_GET['cot']."";
 mysql_query($sql, $conexion);

$consulta= "SELECT * FROM `cotizaciones` where id_cot=".$_GET['cot']."";                     
$result=  mysql_query($consulta);
$y= 0;
while($fila=  mysql_fetch_array($result)){
$cambio = $fila['id_cotizacion'];
$reff = $fila['id_referencia'];
$y = $y +1;
$sql21 = "SELECT * FROM cotizaciones where id_cotizacion=".$cambio."";
$fila21 =mysql_fetch_array(mysql_query($sql21));
$ancc= $fila21["ancho_c"];
$altt= $fila21["alto_c"];
$altura= $fila21["cuerpo"];
$altura_ventana = $fila21["alto_c"]- $fila21["cuerpo"]; 
$altura_v_c = $fila21["alto_c"]- $fila21["cuerpo"]; 
$cann= $fila21["cantidad_c"];
$id_vidrio= $fila21["id_vidrio"];
$id_vidrio2= $fila21["id_vidrio2"];
$id_vidrio3= $fila21["id_vidrio3"];
$id_vidrio4= $fila21["id_vidrio4"];
$id_vidrio5= $fila21["id_vidrio5"];
$id_vidrio6= $fila21["id_vidrio6"];
$ho= $fila21["hojas"];
$linea_cot= $fila21["linea_cot"];
$porcentaje_mp= $fila21["porcentaje_mp"];
$hor= $fila21["horizontales"];
$dura= $fila21["duracion"];
$ver= $fila21["verticales"];
$dd= $fila21["d1"];
 $instal = $fila21["install"];
 $traz_vid = $fila21["traz_vid"];
if($linea_cot=='Vidrio'){
    include '../modelo/suma_vidrios_1.php';
     include '../modelo/suma_1.php';
     $totalxx =  $totalxx + $totalv; 
    //echo 'total de todo:'.$totalxx.'<br>';
}else{
    include '../modelo/suma_1.php';
}
if($linea_cot=='Fachada'){
    if($_POST['desc']!=0){
     $sqlx = "UPDATE `cotizaciones` SET `desc`='".$_POST['desc']."',  `porcentaje`='".$_POST['precio']."' WHERE `id_cotizacion` = ".$cambio.";";
     mysql_query($sqlx, $conexion);
}
if($_POST['precio']!='px'){

     $sqlx = "UPDATE `cotizaciones` SET   `porcentaje`='".$_POST['precio']."', `desc`='".$_POST['desc']."' WHERE `id_cotizacion` = ".$cambio.";";
     mysql_query($sqlx, $conexion);
}
}else{
if($_POST['desc']!=0){

     $sqlx = "UPDATE `cotizaciones` SET `desc`='".$_POST['desc']."' WHERE `id_cotizacion` = ".$cambio.";";
     mysql_query($sqlx, $conexion);
}
if($_POST['precio']!='px'){

     $sqlx = "UPDATE `cotizaciones` SET   `porcentaje`='".$_POST['precio']."', `desc`='".$_POST['desc']."' WHERE `id_cotizacion` = ".$cambio.";";
     mysql_query($sqlx, $conexion);
}

}



}


//echo "<script language='javascript' type='text/javascript'>";
//echo "location.href='../vistas/?id=new_fac&cot=".$_GET['cot']."&cli=".$_GET['cli']."'";
//echo "</script>";
 echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la cotizacion");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].' "</script>'; 
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Templado S.A </title>
    
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
    <script src="../js/ajax.js" type="text/javascript"></script>
      <script src="../js/buscadores.js" type="text/javascript"></script>
    <style>
        .btns{
            width:100%;
        }
        .btns .next{
            float: right;
            width: 80px;
        }
        .btns .prev{
            float: left;
            width: 80px;
        }
    </style>
<script>$(document).ready(function(){ 

window.onload=cerrar; 
function cerrar(){ 
$("#carga").animate({"opacity":"0"},1000,function(){$("#carga").css("display","none");}); 
} 
$("#carga").click(function(){cerrar();}); 

});</script> 
<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/combo3.php", { elegido2: elegido2 }, function(data){
				$("#select2_1").html(data);
                                $("#lam").html("");
                                $("#lam2").html("");
                                $("#lam3").html("");
                                $("#lam4").html("");
                                $("#vid").html("");
                                $("#vid2").html("");
                                $("#vid3").html("");
                                $("#vid4").html("");
                                $("#refer").html("");
                                $("#codig").html("");
                                $("#descr").html("");
                                $("#vidrio").html("");
                    
				
			});			
        });
   });
            $("#costo2").keyup(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/costos.php", { elegido2: elegido2 }, function(data){
				$("#res_costo").html(data);
				
			});			
        });
   $("#documento").keyup(function () {
                //alert($(this).val());
                documento_ter=$(this).val();
                $.post("../combos/terceros.php", { documento_ter: documento_ter }, function(data){
                $("#informacion").html(data);

                });			
            });



      $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();elegid=$("#linea").val();id=$("#codig").val();
				$.post("../combos/trazabilidad_vid.php", { elegido2: elegido2,elegid: elegid,id:id }, function(data){
                                
                                $("#select2_2").html(data);
			});			
        });
   })
         $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegid=$(this).val();linea=$("#linea").val();id=$("#codig").val();
				$.post("../combos/seleccion_vidrio.php", {elegid: elegid, linea: linea,id:id }, function(data){
                                
                                $("#vidrios").html(data);
				$("#vid").html("");
                                $("#vid2").html("");
                                $("#vid3").html("");
                                $("#vid4").html("");
                               
                                
				
			});			
        });
   })
         $("#select2_2").change(function () {
   		$("#select2_2 option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/mostrar_traz_vid.php", { elegido2: elegido2 }, function(data){                               
                                $("#areas_vid").html(data);
				
                                
				
			});			
        });
   })
     $("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/instalacion.php", { elegido2: elegido2 }, function(data){
				$("#install").html(data);
                               
				
			});			
        });
   })
      $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();id=$("#codig").val();
				$.post("../combos/imagen.php", { elegido2: elegido2, id:id }, function(data){
				$("#imagen").html(data);
				
			});			
        });
   })
	// Parametros para el combo2
	$("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/combo4.php", { elegido2: elegido2 }, function(data){
				$("#cierre").html(data);
			});			
        });
   })
   	$("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/combo_alum.php", { elegido2: elegido2 }, function(data){
				$("#alum").html(data);
			});			
        });
        
   })
     	$("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
                               id=$("#codig").val();
				$.post("../combos/combo_alum_1.php", { elegido2: elegido2, id:id }, function(data){
				$("#hoja").html(data);
			});			
        });
        
   })
   
           	$("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			        
                                producto=$(this).val(); linea=$("#linea").val();id=$("#codig").val();
				$.post("../combos/laminas.php", { producto:producto, linea:linea, id:id  }, function(data){
				$("#lam").html(data);
			});			
        });
        
   })
           	$("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			        
                                producto=$(this).val(); linea=$("#linea").val();id=$("#codig").val();
				$.post("../combos/laminas_1.php", { producto:producto, linea:linea, id:id  }, function(data){
				$("#lam2").html(data);
			});			
        });
        
   })
           	$("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				producto=$(this).val(); linea=$("#linea").val();id=$("#codig").val();
				$.post("../combos/laminas_2.php", { producto:producto, linea:linea, id:id  }, function(data){
				$("#lam3").html(data);
			});			
        });
        
   })
              	$("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				producto=$(this).val(); linea=$("#linea").val();id=$("#codig").val();
				$.post("../combos/laminas_3.php", { producto:producto, linea:linea,id:id }, function(data){
				$("#lam4").html(data);
			});			
        });
        
   })

        	$("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/combo_alum_1_1.php", { elegido2: elegido2 }, function(data){
				$("#fijo").html(data);
			});			
        });
        
   })
           	$("#lam").change(function () {
   		$("#lam option:selected").each(function () {
			//alert($(this).val());
				num=$(this).val();
				$.post("../combos/combo_vidrio.php", { num: num }, function(data){
				$("#vid").html(data);
			});			
        });
        
   })
              	$("#lam2").change(function () {
   		$("#lam2 option:selected").each(function () {
			//alert($(this).val());
				num=$(this).val();
				$.post("../combos/combo_vidrio_1.php", { num: num }, function(data){
				$("#vid2").html(data);
			});			
        });
        
   })
              	$("#lam3").change(function () {
   		$("#lam3 option:selected").each(function () {
			//alert($(this).val());
				num=$(this).val();
				$.post("../combos/combo_vidrio_2.php", { num: num }, function(data){
				$("#vid3").html(data);
			});			
        });
        
   })
            $("#lam4").change(function () {
   		$("#lam4 option:selected").each(function () {
			//alert($(this).val());
                        num=$(this).val();
                        $.post("../combos/combo_vidrio_3.php", { num: num }, function(data){
                        $("#vid4").html(data);
                    });			
                });

           })
   
            $("#linea").change(function () {
   		$("#linea option:selected").each(function () {
			//alert($(this).val());
                        linea=$(this).val();
                        pvi=$('#pvi').val();
                        pal=$('#pal').val();
                        pac=$('#pac').val();
                        $.post("../combos/descuento.php", { linea: linea, pvi: pvi, pal: pal, pac: pac }, function(data){
                        $("#descuento").html(data);
                    });			
                });
            })
            
            $("#select2_1").change(function () {
                         $("#select2_1 option:selected").each(function () {
                                 //alert($(this).val());
                                         elegido2=$(this).val();id=$("#codig").val();
                                         $.post("../combos/combo5.php", { elegido2: elegido2, id:id }, function(data){
                                         $("#areas").html(data);
                                 });			
                 });
            });
            
            $("#cod_ide").keyup(function () {
                //alert($(this).val());
                elegido2=$(this).val();
                $.post("../combos/terceros_1.php", { elegido2: elegido2 }, function(data){
                $("#res_tercero").html(data);

                });			
            });
            
            $("#buscador").keyup(function () {
                //alert($(this).val());
                    buscador=$(this).val();grupo=$('#grupo').val();
                    $.post("../combos/buscador_refe.php", { buscador: buscador,grupo: grupo }, function(data){
                    $("#res_referencias").html(data);
                });			
            });
        
            $("#grupo").change(function () {
                $("#grupo option:selected").each(function () {
                    //alert($(this).val());
                    grupo=$(this).val();buscador=$('#buscador').val();
                    $.post("../combos/buscador_refe.php", { buscador: buscador,grupo: grupo }, function(data){
                    $("#res_referencias").html(data);
                    });			
                });
            })
            
});
</script>
<script>
$(document).ready(function(){
	 $('#tabla').dataTable( {
			        "oLanguage": {
			           "sLengthMenu": 'Mostrar <select>'+
			             '<option value="30">30</option>'+
			             '<option value="40">40</option>'+
			             '<option value="50">50</option>'+
			             '<option value="-1">Todos</option>'+
			             '</select> En la tabla'
			         }
			       } );
          $('#tabla2').dataTable(); $('#tabla3').dataTable();
   $("#linea_p").change(function () {
   		$("#linea_p option:selected").each(function () {
			//alert($(this).val());
				elegido4=$(this).val();
				$.post("../combos/combo_crear_p.php", { elegido4: elegido4 }, function(data){
				$("#resultado").html(data);
				
			});			
        });
   })
});
$(document).ready(function(){
	// Parametros para e combo1
   $("#grupo").change(function () {
   		$("#grupo option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/grupos.php", { elegidoc: elegidoc }, function(data){
				$("#select2_1").html(data);
				
			});			
        });
   })
});
$(document).ready(function(){
	// Parametros para e combo1
   $("#grupo2").change(function () {
   		$("#grupo2 option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/grupos.php", { elegidoc: elegidoc }, function(data){
				$("#select2_2").html(data);
				
			});			
        });
   })
   $("#select2_2").change(function () {
   		$("#select2_2 option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/costo_1.php", { elegidoc: elegidoc }, function(data){
				$("#costo").html(data);
				
			});			
        });
   })
      $("#vidrio").change(function () {
   		$("#vidrio option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/costo_2.php", { elegidoc: elegidoc }, function(data){
				$("#costov").html(data);
				
			});			
        });
   })
});
</script>
<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#linea_p").change(function () {
   		$("#linea_p option:selected").each(function () {
			//alert($(this).val());
				elegido4=$(this).val();
				$.post("../combos/combo_crear_p.php", { elegido4: elegido4 }, function(data){
				$("#resultado").html(data);
				
			});			
        });
   })
   $("#mano").change(function () {
   		$("#linea_p option:selected").each(function () {
			//alert($(this).val());
				elegido4=$(this).val();
				$.post("../combos/valor_mo.php", { elegido4: elegido4 }, function(data){
				$("#valor_mo").html(data);
				
			});			
        });
   })
});
</script>
<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#perimetro").change(function () {
   		$("#perimetro option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val();
				$.post("../combos/perimetro.php", { nombre: nombre }, function(data){
				$("#cantidad").html(data);
                            });
                            
        });
   })
    $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val(); elegido=$("#tipo").val();
				$.post("../combos/cli_cedula_1.php", { nombre: nombre, elegido: elegido }, function(data){
				$("#direccion").html(data);
				
			});			
        });
   })
       $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val();
                                elegido=$("#tipo").val();
				$.post("../combos/cli_cedula_nit.php", { nombre: nombre, elegido: elegido }, function(data){
				$("#cedula").html(data);});			
        });

   })
       $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val();
				$.post("../combos/medida.php", { nombre: nombre }, function(data){
				$("#medida").html(data);
				
			});			
        });
   })
    $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val(); elegido=$("#tipo").val();
				$.post("../combos/cli_cedula_2.php", { nombre: nombre, elegido: elegido }, function(data){
				$("#telefono").html(data);
				
			});			
        });
   })
    $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val(); elegido=$("#tipo").val();
				$.post("../combos/cli_cedula_3.php", { nombre: nombre, elegido: elegido }, function(data){
				$("#contacto").html(data);
				
			});			
        });
   })
    $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val(); elegido=$("#tipo").val();
				$.post("../combos/cli_cedula_4.php", { nombre: nombre, elegido: elegido }, function(data){
				$("#tel_cont").html(data);
				
			});			
        });
   })
    $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				nombre=$(this).val(); elegido=$("#tipo").val();
				$.post("../combos/cli_cedula_5.php", { nombre: nombre, elegido: elegido }, function(data){
				$("#email").html(data);
				
			});			
        });
   })
});
</script>
     <script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/combo2.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
   	$("#tipo").change(function () {
   		$("#tipo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/cliente.php", { elegido: elegido }, function(data){
				$("#select2_3").html(data);
			});			
        });
   })
});
</script>
<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				buscar=$(this).val();
				$.post("../combos/combo_referencia_1.php", { buscar: buscar }, function(data1){
				$("#ref1").html(data1);
				
			});			
        });
   })
	// Parametros para el combo2
	$("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				buscar=$(this).val();
				$.post("../combos/combo_referencia.php", { buscar: buscar }, function(data1){
				$("#ref2").html(data1);
			});			
        });
   })
});
</script>
<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#select2_2").change(function () {
   		$("#select2_2 option:selected").each(function () {
			//alert($(this).val());
				buscar=$(this).val();
				$.post("../combos/combo_referencia_1.php", { buscar: buscar }, function(data1){
				$("#c").html(data1);
				
			});			
        });
   })
	// Parametros para el combo2
	$("#select2_2").change(function () {
   		$("#select2_2 option:selected").each(function () {
			//alert($(this).val());
				buscar=$(this).val();
				$.post("../combos/combo_referencia.php", { buscar: buscar }, function(data1){
				$("#b").html(data1);
			});			
        });
   })
});
</script>
<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				buscar=$(this).val();
				$.post("../combos/combo_referencia_1.php", { buscar: buscar }, function(data1){
				$("#e").html(data1);
				
			});			
        });
   })
	// Parametros para el combo2
	$("#select2_3").change(function () {
   		$("#select2_3 option:selected").each(function () {
			//alert($(this).val());
				buscar=$(this).val();
				$.post("../combos/combo_referencia.php", { buscar: buscar }, function(data1){
				$("#d").html(data1);
			});			
        });
   })
});
</script>
 <script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#ciudad").change(function () {
   		$("#ciudad option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/ciudades.php", { elegidoc: elegidoc }, function(data){
				$("#municipio").html(data);
				
			});			
        });
   })
      $("#ciudad3").change(function () {
   		$("#ciudad3 option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/ciudades.php", { elegidoc: elegidoc }, function(data){
				$("#municipio3").html(data);
				
			});			
        });
   })
   $("#ciudad2").change(function () {
   		$("#ciudad2 option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/combo1.php", { elegidoc: elegidoc }, function(data){
				$("#municipio2").html(data);
				
			});			
        });
   })
   $("#depa").change(function () {
   		$("#depa option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/combo1.php", { elegidoc: elegidoc }, function(data){
				$("#muni").html(data);
				
			});			
        });
   })
   
 $("#lineax").change(function () {
   		$("#lineax option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/combo3.php", { elegido2: elegido2 }, function(data){ 
				$("#select2_1").html(data);
                               
				
			});			
        });
   })
         $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/imagen.php", { elegido2: elegido2 }, function(data){
				$("#imagen2").html(data);
				
			});			
        });
   })
});
</script>

<script>
$(document).ready(function(){
	// Parametros para e combo1
   $("#lado").change(function () {
   		$("#lado option:selected").each(function () {
			//alert($(this).val());
				elegido3=$(this).val();
				$.post("../combos/combo6.php", { elegido3: elegido3 }, function(data){
				$("#lado_r").html(data);
				
			});			
        });
   })

});
function atencion()
{
catPaises = window.open('../combos/span_vidrio1.php', 'contacto', 'width=1000,height=600');
}
function atencion2()
{
catPaises = window.open('../combos/span_vidrio2.php', 'contacto', 'width=1000,height=600');
}
function atencion3()
{
catPaises = window.open('../combos/span_vidrio3.php', 'contacto', 'width=1000,height=600');
}
function atencion4()
{
catPaises = window.open('../combos/span_vidrio4.php', 'contacto', 'width=1000,height=600');
}
function keyupFunction() {
    document.getElementById("codi").style.backgroundColor = "yellow";
}
function atencion5()
{
catPaises = window.open('../combos/span_vidrio5.php', 'contacto', 'width=1000,height=600');
}
function atencion6()
{
catPaises = window.open('../combos/span_vidrio6.php', 'contacto', 'width=1000,height=600');
}
function vidrio()
{
catPaises = window.open('../combos/vidrio1.php', 'contacto', 'width=1000,height=600');
}
function vidrio2()
{
catPaises = window.open('../combos/vidrio2.php', 'contacto', 'width=1000,height=600');
}
function vidrio3()
{
catPaises = window.open('../combos/vidrio3.php', 'contacto', 'width=1000,height=600');
}
function vidrio4()
{
catPaises = window.open('../combos/vidrio4.php', 'contacto', 'width=1000,height=600');
}
function vidrios1(val1, val2){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
}
function cliente_info(id, nom, dir, con, tel, cel, ema, doc){
    document.getElementById('id_cli').value = id;
    document.getElementById('nombre').value = nom;
        document.getElementById('direccion').value = dir;
    document.getElementById('contacto').value = con;
        document.getElementById('telefono').value = tel;
    document.getElementById('celular').value = cel;
        document.getElementById('email').value = ema;
    document.getElementById('documento').value = doc;
}
function vidrios2(val3, val4){
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
}
function vidrios3(val5, val6){
    document.getElementById('valor5').value = val5;
    document.getElementById('valor6').value = val6;
}
function vidrios4(val7, val8){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
}
function vidriosd1(val1, val2){
    document.getElementById('valor21').value = val1;
    document.getElementById('valor22').value = val2;
}
function vidriosd2(val3, val4){
    document.getElementById('valor23').value = val3;
    document.getElementById('valor24').value = val4;
}
function vidriosd3(val5, val6){
    document.getElementById('valor25').value = val5;
    document.getElementById('valor26').value = val6;
}
function vidriosd4(val7, val8){
    document.getElementById('valor27').value = val7;
    document.getElementById('valor28').value = val8;
}
function vidriost1(val1, val2){
    document.getElementById('valor31').value = val1;
    document.getElementById('valor32').value = val2;
}
function vidriost2(val3, val4){
    document.getElementById('valor33').value = val3;
    document.getElementById('valor34').value = val4;
}
function vidriost3(val5, val6){
    document.getElementById('valor35').value = val5;
    document.getElementById('valor36').value = val6;
}
function vidriost4(val7, val8){
    document.getElementById('valor37').value = val7;
    document.getElementById('valor38').value = val8;
}
function vidriosc1(val1, val2){
    document.getElementById('valor41').value = val1;
    document.getElementById('valor42').value = val2;
}
function vidriosc2(val3, val4){
    document.getElementById('valor43').value = val3;
    document.getElementById('valor44').value = val4;
}
function vidriosc3(val5, val6){
    document.getElementById('valor45').value = val5;
    document.getElementById('valor46').value = val6;
}
function vidriosc4(val7, val8){
    document.getElementById('valor47').value = val7;
    document.getElementById('valor48').value = val8;
}
function vidriosc5(val9, val10){
    document.getElementById('valor49').value = val9;
    document.getElementById('valor410').value = val10;
}
function vidrios6(val11, val12){
    document.getElementById('valor11').value = val11;
    document.getElementById('valor12').value = val12;
}
function datos(val1, val2, val3, val4){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
}
function datos2(val5, val6, val7){
    document.getElementById('valor555').value = val5;
    document.getElementById('valor655').value = val6;
    document.getElementById('valor755').value = val7;
}
function refvidrios1(val1, val2){
    document.getElementById('valo2').value = val1;
    document.getElementById('valo1').value = val2;
}
function refvidrios2(val3, val4){
    document.getElementById('valo4').value = val3;
    document.getElementById('valo3').value = val4;
}
function refvidrios3(val5, val6){
    document.getElementById('valo6').value = val5;
    document.getElementById('valo5').value = val6;
}
function refvidrios4(val7, val8){
    document.getElementById('valo8').value = val7;
    document.getElementById('valo7').value = val8;
}
function buscare(a, b, c){
    document.getElementById('refer').value = a;
    document.getElementById('codig').value = b;
    document.getElementById('descr').value = c;
}
function costos(x,y,z){
    document.getElementById('costo1').value = x;
    document.getElementById('costo2').value = y;
    document.getElementById('costo3').value = z;
}
function atenciond()
{
catPaises = window.open('../combos/span_vidriod1.php', 'contacto', 'width=1000,height=600');
}
function atenciond2()
{
catPaises = window.open('../combos/span_vidriod2.php', 'contacto', 'width=1000,height=600');
}
function atenciond3()
{
catPaises = window.open('../combos/span_vidriod3.php', 'contacto', 'width=1000,height=600');
}
function atenciond4()
{
catPaises = window.open('../combos/span_vidriod4.php', 'contacto', 'width=1000,height=600');
}
function atenciont()
{
catPaises = window.open('../combos/span_vidriot1.php', 'contacto', 'width=1000,height=600');
}
function atenciont2()
{
catPaises = window.open('../combos/span_vidriot2.php', 'contacto', 'width=1000,height=600');
}
function atenciont3()
{
catPaises = window.open('../combos/span_vidriot3.php', 'contacto', 'width=1000,height=600');
}
function atenciont4()
{
catPaises = window.open('../combos/span_vidriot4.php', 'contacto', 'width=1000,height=600');
}
function atencionc()
{
catPaises = window.open('../combos/span_vidrioc1.php', 'contacto', 'width=1000,height=600');
}
function atencionc2()
{
catPaises = window.open('../combos/span_vidrioc2.php', 'contacto', 'width=1000,height=600');
}
function atencionc3()
{
catPaises = window.open('../combos/span_vidrioc3.php', 'contacto', 'width=1000,height=600');
}
function atencionc4()
{
catPaises = window.open('../combos/span_vidrioc4.php', 'contacto', 'width=1000,height=600');
}
function ver_costos()
{
catPaises = window.open('../vistas/costos_2.php', 'contacto', 'width=1000,height=600');
}
function compuestosx(cot,cli,id_co,por,pag)
{
catPaises =  window.open('../vistas/?id=add_acc&cot='+cot+'&cli='+cli+'&mas='+id_co+'&por='+por+'&pagina='+pag+'', 'contacto', 'width=800,height=600');
}
function trazabilidad(barra,prod)
{
window.open('../vistas/?id=areas_al&orden='+barra+'&prod='+prod+' ', 'contacto', 'width=800,height=600');
}
function trazabilidadv(barra,prod)
{
window.open('../vistas/?id=areas_vi&orden='+barra+'&prod='+prod+' ', 'contacto', 'width=800,height=600');
}

</script>
<script>
function focus_cod()
{
producto.focus();
}
</script>
</head>

<body>
                            <?php include '../controlador/mensajes.php'; ?>

  
<?php
function usuarios_activos()
{
   $ip = $_SESSION['id_user'];
   //definimos el momento actual
   $ahora = time();
   $limite = $ahora-5*60;
   $ssql = "delete from control_ip where fecha < ".$limite;
   mysql_query($ssql);

   //miramos si el ip del visitante existe en nuestra tabla
   $ssql = "select ip, fecha from control_ip where ip = '$ip'";
   $result = mysql_query($ssql);

   //si existe actualizamos el campo fecha
   if (mysql_num_rows($result) != 0) $ssql = "update control_ip set fecha = ".$ahora." where ip = '$ip'";
   //si no existe insertamos el registro correspondiente a la nueva sesion
   else $ssql = "insert into control_ip (ip, fecha) values ('$ip', $ahora)";

   //ejecutamos la sentencia sql
   mysql_query($ssql);

   //calculamos el numero de sesiones
   $ssql = "select ip from control_ip";
   $result = mysql_query($ssql);
   while($usuarios = mysql_fetch_array($result)){
       $us = $usuarios['ip'];
   }
   mysql_free_result($result);

   return $us;
}
usuarios_activos();
?>

                      
<?php require '../vistas/script.php';  ?>
</body>
</html>
<?php  }else {header("location:../index.php");}
if(isset($_GET['next_c'])){
    $sql21 = "select count(*) FROM subproceso a, grupo b, grupo_det c, usuarios d where d.id_user=c.id_user and b.id_g=c.id_g and a.id_subpro=b.id_area and a.id_subpro=".$id_area." and d.cedula=".$_POST['carnet']."";
$fila21 =mysql_fetch_array(mysql_query($sql21));
$c= $fila21["count(*)"];

if($c==0){
     echo '<script lanquage="javascript">alert("Usted No pertenece a esta area ");location.href="../vistas/?id=mi_area "</script>'; 
}else{
 echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=mi_area&sig=".$_POST['carnet']."'";
echo "</script>";
}
}
if(isset($_GET['next'])){
    $sql21 = "select count(*),e.paso, e.barra from producto a, subproceso b, pt_procesos c, orden_detalle d, procesos_activos e where e.save=1 and a.id_p=c.id_proceso and c.id_subpro=b.id_subpro and  a.id_p=d.id_producto and d.id_orden_d=e.id_orden_d and e.paso=c.orden and b.id_subpro=".$id_area." and e.barra_item=".$_POST['producto']." ";
$fila21 =mysql_fetch_array(mysql_query($sql21));
$c= $fila21["count(*)"];
$paso= $fila21["paso"]+1;
$ba= $fila21["barra"];
if($c==0){
     echo '<script lanquage="javascript">alert("Este producto no pertenece a esta area '.$id_area.' ");location.href="../vistas/?id=mi_area&sig='.$_POST['obrero'].' "</script>'; 
}else{
    
               date_default_timezone_set("America/Bogota" ); 
$hora = date('H:i:s',time() - 3600*date('I'));
$fe = date("Y-m-d").' '.$hora;
if(isset($_POST['todos'])){
     $sql = "UPDATE `procesos_activos` SET  paso=".$paso.", llegada='".$fe."', ubicacion='".$_POST['Ubicacion']."', usuario=0 WHERE `barra` = ".$ba.";";           
}else{
     $sql = "UPDATE `procesos_activos` SET  paso=".$paso.", llegada='".$fe."', ubicacion='".$_POST['Ubicacion']."', usuario=0 WHERE `barra_item` = ".$_POST['producto'].";";           

}
   echo  mysql_query($sql, $conexion);
     
$sql5 =  "select count(*),a.*, (a.codigo) as barra, b.*, c.*, f.* from procesos_activos a, pt_procesos b, orden_detalle c, proceso d, subproceso e, orden_produccion f where f.id_orden=c.codigo and a.id_orden_d=c.id_orden_d and b.id_proceso=c.id_proceso and b.orden=a.paso and b.id_proceso=d.id_proceso and b.orden=a.paso and a.paso=".$paso." and a.barra_item=".$_POST['producto']." group by e.codigo";
$fila =mysql_fetch_array(mysql_query($sql5));
$co= $fila["count(*)"];
$cd= $fila["barra"];
$id_subpre = $fila['id_subpro'];
$op= $fila["id_op"];
$p= $fila["paso"];

if($co==0){
    if(isset($_POST['todos'])){
         $sqlx = "UPDATE `procesos_activos` SET  estado='Terminado' WHERE `barra` = ".$cd.";";           
    mysql_query($sqlx, $conexion);
    }else{
     $sqlx = "UPDATE `procesos_activos` SET  estado='Terminado' WHERE `barra_item` = ".$_POST['producto'].";";           
    mysql_query($sqlx, $conexion);
    }
}
$usu = mysql_query("select id_user from grupo_det where  id_g=".$group." and est=0 ");
while($r = mysql_fetch_array($usu)){
         $sql9 = "INSERT INTO `registro_trabajo` (`codigo`, `usuario`, `id_area`, `id_user`)";
      $sql9.= "VALUES ('".$_POST['producto']."', '".$group."', '".$id_area."', '".$r['id_user']."')";
      mysql_query($sql9, $conexion);
}
      
    echo '<script lanquage="javascript">alert("El producto a pasado a la siguiente area # paso '.$paso.' ");document.formulario1.carnet.focus();location.href="../vistas/?id=mi_area"</script>'; 
}
   
}