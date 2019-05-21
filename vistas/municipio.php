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
    <link rel="stylesheet" href="../assets/icheck2/css/jquery.icheck.min.css">
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
$(document).ready(function(){
    $('#tabla').dataTable();
});

function pasar_puc(){
    window.opener.municipio(document.getElementById('muni').value);
    window.close();

}

$(document).keyup(function(event){
    if(event.keyCode == 13){
        $("#buscadorc").click();
    }
});
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
                                <h4 class="title">Listado De Municipios</h4>
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
                                <div class="body-inner no-padding">

<?php

include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     $request2=mysql_query('select * from departamentos WHERE id='.$_GET['codigo'].'');
     
     while($row2=mysql_fetch_array($request2))
	{     
          
                 $municipio1 = $row2["nombre_mun"];
           ?>
    

    <input type="text" name="cost14" id="muni" readonly value="<?php echo $municipio1 ?>" />

<a href="" title="pasar valor" onload="javascript:pasar_puc();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }
        }else{
  ?> 
<input type="hidden" name="munix" id="munix" class="span3" autofocus autocomplete="off" value="<?php echo $_GET['muni'] ?>">
<input type="text" name="ciudad" id="ciudad" class="span3" autofocus autocomplete="off" placeholder="Buscar por Ciudad ó Municipio">
 <div id="ciudades">
<?php include '../combos/buscador_ciudad.php'; ?>
     </div>   

  <?php
        }
  
?>
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

         

                              
                                
