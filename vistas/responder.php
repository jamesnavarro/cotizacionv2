<?php 
session_start();
include '../modelo/conexion.php';  ?>
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
</head>
<body>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Responder Correo</h4>

                            </header>

                            <section id="collapse1" class="body collapse in">                      
                                <div class="body-inner">
                                   
                            <div class="tabbable" style="margin-bottom: 25px;">

                        

                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                    <form name="buscarA" action="../vistas/checkeds_gastos.php?cod=<?php echo $_GET['cod'] ?>&add" method="post" enctype="multipart/form-data">
     <button type="submit"><img src="../imagenes/add.png"> Agregar</button> 
<?php
if(isset($_POST['producto'])){
 $request=mysqli_query($conexion,"SELECT * FROM producto a, sis_empresa b where producto like '%".$_POST['producto']."%' or referencia_p like '%".$_POST['producto']."%' or codigo like '%".$_POST['producto']."%' ");   
}else{
$request=mysqli_query($conexion,"SELECT * FROM `referencia_admin` ");
}
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
             $table = $table.'<th  width="10%">'.'Codigo'.'</th>';           
              $table = $table.'<th width="40%">'.'Descripción'.'</th>';   
              $table = $table.'<th  width="10%">'.'Referencia '.'</th>';
               $table = $table.'<th  width="10%">'.'Porcentaje'.'</th>';
      
              $table = $table.'<th width="10%">'.'Seleccionar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $cont=0;
	while($row=mysqli_fetch_array($request))
	{       
                  $cont=$cont+1;
                  $table = $table.'<tr>
                <td  width="10%">'.$row["id_ref_ad"].'</td>'
                          . '<td width="40%">'.$row['descripcion_ad'].'</a></td>'
                          . '<td width="10%">'.$row['referencia_ad'].'</a></td>'
                          . '<td  width="10%">'.$row["porcentaje_ad"].'</td>
               <td width="10%"><input type="checkbox" value="'.$row["id_ref_ad"].'" name="id'.$cont.'"></td>
                   </tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
 
}?>
              <table>
                <tr>
                    <td><label><i></i></label> <input type="hidden" name="cant" readonly  style="width:20px;height:20px;"  value="<?php echo $cont; ?>"><button type="submit"><img src="../imagenes/add.png"> Agregar</button></td>
                </tr>
                
            </table>  

            </form> 
                                </div>

                            </section>

                        </div>

                    </div>

                                    </div>


                                </div>

                            </div><!--/ Normal Tabs -->

                                </div>

                            </section>

                        </div>

                    </div>

                            </section></div>
<?php
if(isset($_GET['add'])){

    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        $c = 0;
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["id$x"])){
                $c += 1;
                include "../modelo/conexion.php";
  
        
            
                $sql = "INSERT INTO `producto_rep_ad` (`id_ref_ad`, `id_p`)";
            $sql.= "VALUES ('".$_POST["id$x"]."', '".$_GET['cod']."')";
            mysqli_query($conexion,$sql);

            }
          
            }   
          
                        
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";

            }}


?>
     <?php require '../vistas/script.php';  ?>
</body>
</html>