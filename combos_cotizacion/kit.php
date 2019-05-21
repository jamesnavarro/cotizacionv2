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
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
	 $('#tabla').dataTable();
});
        
        </script>
        <script language="javascript" type="text/javascript">
function pasarr(){
    window.opener.datos4(document.getElementById('datos5').value, document.getElementById('datos6').value, document.getElementById('datos7').value);
    window.close();
}
</script>

         
</head>
<body onload="javascript:pasarr();">
         
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Listado de Kit de Accesorios</h4>
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

<form name="buscarA" action="../vistas/materiales.php?cot=<?php echo $_GET['cot'] ?>&add" method="post" enctype="multipart/form-data">                                    
<?php
         include '../modelo/conexion.php';
if(isset($_POST['buscar'])){
     $request=mysql_query("SELECT * FROM referencias where codigo like '".$_POST['buscar']."%' or descripcion like '%".$_POST['buscar']."%'  or referencia like '%".$_POST['buscar']."%'  group by descripcion");
}else{
 $request=mysql_query("SELECT * FROM producto where kit=1 ");
}
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="5%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Grupo'.'</th>';
 
                   $table = $table.'<th class="hidden-phone">'.'Precio Base'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Precio 1'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Precio 2'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Precio 3'.'</th>';
         
            

              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
   
       $c=0;
	while($rowk=mysql_fetch_array($request))
	{       
            $c = $c + 1;
                $alum_por = "SELECT * FROM porcentajes where area_por='".$rowk["linea"]."' ";
                $fia =mysql_fetch_array(mysql_query($alum_por));
                $p11= $fia["p1"]/100;
                $p22= $fia["p2"]/100;
                $p33= $fia["p3"]/100;
                
          
              include '../modelo/suma_kit.php';
       $p1 = $totk/ $p11 ;
             $p2 = $totk / $p22 ;
              $p3 = $totk / $p33 ;
            $table = $table.'<tr><td width="5%">'.$rowk['id_p'].'</td>'
                    . '<td width="5%">'.$rowk['codigo'].'</font></td>'
                    . '<td width="30%"><a href="../vistas/kit.php?codigo='.$rowk["id_p"].'">'.$rowk['producto'].'</a></td>'
                    . '<td width="10%">'.$rowk["referencia_p"].'<font></a></td><td width="10%">'.$rowk["linea"].'<font></a></td></td>'
                    . '<td  class="hidden-phone">'.number_format($totk).'</td>'
                    . '<td  class="hidden-phone">'.number_format($p1).'</td>'
                    . '<td  class="hidden-phone">'.number_format($p2).'</td>'
                    . '<td  class="hidden-phone">'.number_format($p3).'</td>'
                    
                   
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
} 
  
 ?>
  </form>
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
<?php 
         include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     $request2=mysql_query('SELECT * FROM producto WHERE id_p='.$_GET['codigo'].'');
     while($row2=mysql_fetch_array($request2))
	{     
          
              $x = $row2["id_p"];
              $y = $row2["referencia_p"];
              $z = $row2["producto"];

              
           ?>
    

<input type="text" name="datos5" id="datos5" readonly value="<?php echo $y ?>" />
<input type="text" name="datos6" id="datos6" readonly value="<?php echo $x ?>" />
<input type="text" name="datos7" id="datos7" readonly value="<?php echo $z ?>" />


<a href="" title="pasar valor" onload="javascript:pasarr();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }} ?>

                              
                                