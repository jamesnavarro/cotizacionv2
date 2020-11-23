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
    <title>HOJA DE COSTO TEMPORAL</title>
    
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
</head>
<?php
 require '../modelo/conexion.php';


 ?>
       

                            
                             <div class="row-fluid">

                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Reparto de Aluminio</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
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


     
//    echo'<hr>';
                $table = '<table class="table table-bordered table-striped table-hover" id="">';
                $table = $table.'<thead >';
                $table = $table.'<tr bgcolor="#D1EEF0">';
                $table = $table.'<th width="10%">'.'referencia'.'</th>';
                $table = $table.'<th width="10%">'.'Cod. Comercial'.'</th>';
                $table = $table.'<th width="40%">'.'Descripcion'.'</th>';       
                $table = $table.'<th width="10%">'.'Perfil de'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'cant. perfiles'.'</th>';
                $table = $table.'<th width="10%">'.'medida.'.'</th>';
                 $table = $table.'<th class="hidden-phone">'.'Peso(Kg)'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Und'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Total'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Total+P'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Und FOM'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P FOM'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Total FOM'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Costo Lista Total+P FOM'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Disponible'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Solicitar'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Saldo'.'</th>';
                $table = $table.'</tr>';
                $table = $table.'</thead>';
    
 // aqui va el codigo de las listas de productos
 $reques1=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c, producto_rep_alu b, referencias d where b.id_ref_alum=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." group by referencia ");
$total2=0;
        $tacot =0;
        $cont =0; $ta =0;$ptt =0;$tp1=0;$tps=0;$tp1fom=0;$tpsfom=0;
	while($row=mysqli_fetch_array($reques1))
	{            
	            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
          $_GET['l']= $row["imagen"]; $_GET['mod']= $row["modulo"];$_GET['per']= $row["per"]; $_GET['boq']= $row["boq"];
          $_GET['ref']= $row["id_referencia"]; $_GET['idcot']= $row["id_cotizacion"]; $_GET['tv']= $row["traz_vid"];$_GET['tv2']= $row["traz_vid2"];$_GET['tv3']= $row["traz_vid3"];$_GET['tv4']= $row["traz_vid4"];
          $_GET['aa']= $row["ancho_abajo"];$_GET['ancho']= $row["ancho_c"];$_GET['alto']= $row["alto_c"];
          $_GET['cant']= $row["cantidad_c"];$_GET['vidrio']= $fv["color_v"].'('.$fv["espesor_v"];
          $_GET['id_v']= $row["id_vidrio"];$_GET['id_v2']= $row["id_vidrio2"];$_GET['id_v3']= $row["id_vidrio3"];
          $_GET['id_v4']= $row["id_vidrio4"]; $_GET['id_v5']= $row["id_vidrio5"];$_GET['id_v6']= $row["id_vidrio6"];         
          $_GET['id2_v']= $row["id2_vidrio"];$_GET['id2_v2']= $row["id2_vidrio2"];$_GET['id2_v3']= $row["id2_vidrio3"];
          $_GET['id2_v4']= $row["id2_vidrio4"]; $_GET['id2_v5']= $row["id2_vidrio5"];$_GET['id2_v6']=  0;   
          $_GET['id3_v']= $row["id3_vidrio"];$_GET['id3_v2']= $row["id3_vidrio2"];$_GET['id3_v3']= $row["id3_vidrio3"];
          $_GET['id3_v4']= $row["id3_vidrio4"]; $_GET['id3_v5']= $row["id3_vidrio5"];$_GET['id3_v6']= 0;       
          $_GET['id4_v']= $row["id4_vidrio"];$_GET['id4_v2']= $row["id4_vidrio2"];$_GET['id4_v3']= $row["id4_vidrio3"];
          $_GET['id4_v4']= $row["id4_vidrio4"]; $_GET['id4_v5']= $row["id4_vidrio5"];$_GET['id4_v6']= 0;
          $_GET['cuerpo']= $row["cuerpo"]; $_GET['hojas']= $row["hojas"];$_GET['ins']= $row["install"];$_GET['por']= $row["porcentaje_mp"];
          $_GET['v']= $row["verticales"]; $_GET['h']= $row["horizontales"]; $_GET['d1']= $row["d1"];$_GET['dias']= $row["duracion"];
 // fin codigo
  if(isset($_GET['ref'])){
 $sql='select * from producto where id_p="'.$_GET["ref"].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $_GET["ancho"];$aa= $_GET["aa"];
        $alto= $_GET["alto"];
        $altura= $_GET["cuerpo"];
        $altura_ventana = $_GET["alto"]-$_GET["cuerpo"];
        if($_GET["l"]=='Derecho'){
            $ruta= $fil["ruta"];
        }else{
            $ruta= $fil["ruta2"];
        }
        
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$_GET["id_v"].'"';
         $fil2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET["ancho"]/1000) + ($_GET["alto"]/1000)) * $costo_v)*$_GET["cant"];
 }           
	
 include '../vistas/form/suma_de_perfiles.php';
$ta += $ta2;
$pr = $med_t / $row["medida"];
$mdt = ($med_t/1000)*$row["costo_mt"]; 
$mdtfom = ($med_t/1000)*$row["costo_fom"];
$mdtp = ($med_t/1000)*$mp; 
$mdtpfom = ($med_t/1000)*$mpfom; 
$tp1 +=$mdt;
$tps +=$mdtp;
$tp1fom +=$mdtfom;
$tpsfom +=$mdtpfom;
$pr2 = ceil($pr);
$saldo = ($row["cantidad_e"]-$row["cantidad_r"]) - $pr2;
if($saldo>=0){
$e = '<font color="green">'.  number_format($saldo).'</font>';
}else{
$e = '<font color="red">'.  number_format($saldo).'</font>';
}
           
$table = $table.'<tr>
<td width="10%">'.$row['referencia'].'</a></td>
<td width="10%">'.$row['codigo'].'</a></td>
<td width="10%">'.$row['descripcion'].'</font></td>
<td width="10%">'.$row["medida"].' mm<font></a></td>'.$t.'
<td class="hidden-phone"><font color="blue">'.  number_format($pr,1,',','.').'</font></td>
<td width="10%">'.number_format($med_t).' mm<font></a></td>
<td class="hidden-phone">'.number_format($ptt,1,',','.').'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format(($row["costo_mt"])).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($mp).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($mdt).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($mdtp).'</font></td>
    <td class="hidden-phone">$<font color="blue">'.number_format(($row["costo_fom"])).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($mpfom).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($mdtfom).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($mdtpfom).'</font></td>
<td class="hidden-phone"><font color="purple">'.number_format($row["cantidad_e"]-$row["cantidad_r"]).'</font>
<td class="hidden-phone"><font color="purple">'.  number_format($pr2).'</font></td>
<td class="hidden-phone">'.$e.'</td>
</tr>';   
	} 
        
	$table = $table.'</table>';
        
	echo $table;
        

   
 ?>
                                </div>
                            </section>
                        </div>
                        <table class="table table-bordered table-striped table-hover" id="">
<tr><td><?php echo 'El Costo Lista Total de la perfileria es: $<font color="red">'.number_format($tp1).'</font>';  ?>
<td><?php echo 'El Costo Real Total de la perfileria FOM es : $<font color="blue">'.number_format($tp1fom).'</font>';  ?>
<tr><td><?php echo 'El Costo Lista Total de la perfileria +P es: $<font color="red">'.number_format($tps).'</font>';  ?>
<td><?php echo 'El Costo Real Total de la perfileria FOM +P es: $<font color="blue">'.number_format($tpsfom).'</font>';  ?>
</table>
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
        <?php 

$ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET["ref"]."  ");
$cm = mysqli_fetch_array($ac);
$mt = $cm['count(*)'];
 ?>  
                                    <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalles de la ventana con rejillas</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse3" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab12">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 


//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'referencia'.'</th>'; 
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="20%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Perfil de'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Perfiles'.'</th>';
              $table = $table.'<th width="5%">'.'Medida'.'</th>';
              
              $table = $table.'<th class="hidden-phone">'.'Peso (Kg)'.'</th>';
      

             
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Und'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Total'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Total +P'.'</th>';
                 $table = $table.'<th class="hidden-phone">'.'Costo Lista Und FOM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P FOM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Total FOM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Total +P FOM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Disponible'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Solicitar'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Saldo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
 $requesr=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c, producto_rep_rej b, referencias d where b.id_referencia=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." ");
 $xx=0; $xxfom=0; 
        $peso_rej=0;
	while($row=mysqli_fetch_array($requesr))
	{            
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
          $_GET['l']= $row["imagen"]; $_GET['mod']= $row["modulo"];$_GET['per']= $row["per"]; $_GET['boq']= $row["boq"];
          $_GET['ref']= $row["id_referencia"]; $_GET['idcot']= $row["id_cotizacion"]; 
          $_GET['tv']= $row["traz_vid"];$_GET['tv2']= $row["traz_vid2"];$_GET['tv3']= $row["traz_vid3"];
          $_GET['tv4']= $row["traz_vid4"];
          $aa= $row["ancho_abajo"];$ancho= $row["ancho_c"];$alto= $row["alto_c"];
          $_GET['cant']= $row["cantidad_c"];$_GET['vidrio']= $fv["color_v"].'('.$fv["espesor_v"];
          $_GET['id_v']= $row["id_vidrio"];$_GET['id_v2']= $row["id_vidrio2"];$_GET['id_v3']= $row["id_vidrio3"];
          $_GET['id_v4']= $row["id_vidrio4"]; $_GET['id_v5']= $row["id_vidrio5"];$_GET['id_v6']= $row["id_vidrio6"];         
          $_GET['id2_v']= $row["id2_vidrio"];$_GET['id2_v2']= $row["id2_vidrio2"];$_GET['id2_v3']= $row["id2_vidrio3"];
          $_GET['id2_v4']= $row["id2_vidrio4"]; $_GET['id2_v5']= $row["id2_vidrio5"];$_GET['id2_v6']=  0;   
          $_GET['id3_v']= $row["id3_vidrio"];$_GET['id3_v2']= $row["id3_vidrio2"];$_GET['id3_v3']= $row["id3_vidrio3"];
          $_GET['id3_v4']= $row["id3_vidrio4"]; $_GET['id3_v5']= $row["id3_vidrio5"];$_GET['id3_v6']= 0;       
          $_GET['id4_v']= $row["id4_vidrio"];$_GET['id4_v2']= $row["id4_vidrio2"];$_GET['id4_v3']= $row["id4_vidrio3"];
          $_GET['id4_v4']= $row["id4_vidrio4"]; $_GET['id4_v5']= $row["id4_vidrio5"];$_GET['id4_v6']= 0;
          $altura= $row["cuerpo"]; $_GET['hojas']= $row["hojas"];$_GET['ins']= $row["install"];$_GET['por']= $row["porcentaje_mp"];
          $_GET['v']= $row["verticales"]; $_GET['h']= $row["horizontales"]; $_GET['d1']= $row["d1"];$_GET['dias']= $row["duracion"];

        $altura_ventana = $alto-$altura;

            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_p"]." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an['signo']=='-'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an['signo']=='*'){
                  if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                    
                }
                    if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
            }else{
                if($fil_an['signo']=='/'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                       if($fil_an['lado']!="Vertical"){
                $al = ($ancho+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            
       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_p"]." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
	{
echo $ancho.' - '.$alto;
            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_p"]." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($conexion,$sqlxr));
            $id_p= $fil_anrej["id_p"];
           
            if($fil_anrej['signo']=='+'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_anrej['signo']=='-'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                       if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }
                }
                 
                }
            }else{
                if($fil_anrej['signo']=='*'){
                  if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                     if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                    
                }
                    if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }
                }
            }else{
                if($fil_anrej['signo']=='/'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                       if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_anrej['lado']=="Vertical"){
                $al2 = ($alto+$fil_anrej["descuento"]);
            }else{
                $al2 = ($ancho+$fil_anrej["descuento"]);
            }
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $row["costo_mt"] / $porca;
            $prejfom = $row["costo_fom"] / $porca; 
          
         
             if($row["medida_rej"]==0){
                $medrej = ($ancho + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999999){
                $medrej = ($alto + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999998){
                $medrej = ($altura + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999997){
                $medrej = ($altura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
          
            
             $tv2 = ($al / $row['var3']) * $row['multiplo'];
            
            $numero = ($medrej*$tv2)/$row["medida"];
            $xx = $xx + (($medrej*$tv2*$prej)*$_GET['cant']/1000);
             $xxfom = $xxfom + (($medrej*$tv2*$prejfom)*$_GET['cant']/1000);
            $pst_rej = (($row['peso'] * $medrej) / $row["medida"])*$tv2*$_GET['cant'];
            $peso_rej = $peso_rej + $pst_rej;
          $tv22 = ceil($numero*$_GET['cant']);
           $saldo = ($row["cantidad_e"]-$row["cantidad_r"]) - $tv22;
           if($saldo>=0){
               $e2 = '<font color="green">'.  number_format($saldo).'</font>';
           }else{
               $e2 = '<font color="red">'.  number_format($saldo).'</font>';
           }
            $table = $table.'<tr><td width="5%">'.$row['codigo'].'</a></td>'
                    . '<td width="5%">'.$row['referencia'].'</a></td>'
                    . '<td width="20%">'.$row['descripcion'].'</font></td>'
                     . '  <td width="5%">'.$row['medida'].' mm</td>'
                   . ' <td class="hidden-phone"><font color="blue">'.number_format($numero*$_GET['cant'],1,',','.').'</font></td>'
                     . '<td class="hidden-phone">'.number_format($tv2 * $medrej*$_GET['cant']).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($row["costo_mt"]).'</font></td>'
                      . '<td class="hidden-phone"><font color="red">'.number_format($prej).'</font></td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($row["costo_mt"]*($tv2 * $medrej*$_GET['cant'])/1000).'</font></td>'  
                    . '<td class="hidden-phone"><font color="red">'.number_format($prej*($tv2 * $medrej*$_GET['cant'])/1000).'</font></td>'
                     . '<td class="hidden-phone"><font color="blue">'.number_format($row["costo_fom"]).'</font></td>'
                      . '<td class="hidden-phone"><font color="blue">'.number_format($prejfom).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($row["costo_fom"]*($tv2 * $medrej*$_GET['cant'])/1000).'</font></td>'  
                    . '<td class="hidden-phone"><font color="blue">'.number_format($prejfom*($tv2 * $medrej*$_GET['cant'])/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="purple">'.number_format($row["cantidad_e"]-$row["cantidad_r"]).'</font></td>'
                    . '<td class="hidden-phone"><font color="purple">'.number_format($tv22).'</font></td>'
                    . '<td class="hidden-phone">'.$e2.'</td></tr>';   
           
		
               
        } 
	$table = $table.'</table>';
        
	echo $table;


 ?></div>
                            </section>
                        </div>
                        <table class="table table-bordered table-striped table-hover" id="">            
<?php 
echo '<tr><td>El valor total de las rejillas: $<font color="red">'.number_format($xx_p = $xx * $porca).'</font>'; 
echo '<td>El valor total de las rejillas FOM: $<font color="blue">'.number_format($xx_pfom = $xxfom * $porca).'</font>'; 
echo '<tr><td>El valor total de las rejillas + P: $<font color="red">'.number_format($xx).'</font>';
echo '<td>El valor total de las rejillas +P FOM: $<font color="blue">'.number_format($xxfom).'</font>';

echo '<tr><td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg<td>';?>
</table> 
                    </div>
                    <!--/ END Row -->
                                    </div>
                     
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>                   
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Reparto de vidrios</h4>
                                <!-- START Toolbar -->
                             
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse3" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
 	                          
$reques4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c, producto_rep_vid b, referencias d where b.id_ref_vid=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." group by pertenece,id_vidrio, id2_vidrio, id3_vidrio, id4_vidrio, traz_vid, traz_vid2, traz_vid3, traz_vid4");
$total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
	while($row33=mysqli_fetch_array($reques4))
	{            
           
include '../vistas/form/suma_de_vidrios.php';

                   echo '<span style="color:blue">Medidas de '.$rowt['descripcion'].' : Ancho: '.number_format($anchi_gen).' x Alto: '.number_format($alti_gen).', Total M<sup>2</sup>: '.number_format($mtt,1,',','.').'</span>';
         $porc = $porcv;
  $cof= mysqli_query($conexion,"SELECT * FROM `cotizaciones` where id_cotizacion=".$row33['id_cotizacion']."  ");
$tr= mysqli_fetch_array($cof);
//echo $tr['traz_vid'];

         $con2= "SELECT * FROM `producto` where id_p=".$tr['traz_vid']." ";
$res2=  mysqli_query($conexion,$con2);
while($f8=  mysqli_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];

}
if($_GET['tv2']==0){
$nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$_GET['tv2']." ";
$res22=  mysqli_query($conexion,$con22);
while($f8=  mysqli_fetch_array($res22)){
$idco2=$f8['id_p'];
$nombr2=$f8['producto'];

}}
if($_GET['tv3']==0){
$nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$_GET['tv3']." ";
$res23=  mysqli_query($conexion,$con23);
while($f8=  mysqli_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];

}}
if($_GET['tv4']==0){
$nombr4='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$_GET['tv4']." ";
$res24=  mysqli_query($conexion,$con24);
while($f8=  mysqli_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];

}}
//     echo $_GET['id_v'].' - '.$row33['traz_vid'].'<br>';
         
                  if(1==$row33['pertenece']){
                   include '../modelo/vidrios_ven.php';
                  }
                  if(2==$row33['pertenece']){
                   include '../modelo/vidrios_ven_1.php';
                  }
                  if(3==$row33['pertenece']){
                   include '../modelo/vidrios_ven_2.php';
                  }
                  if(4==$row33['pertenece']){
                   include '../modelo/vidrios_ven_3.php';
                  }
                  
//                   echo $m2;
                   $peso_vid = $peso_vid + $pesototal;
                   $total_vid = $total_vid + $totalvxx;
                   $total_vidsp = $total_vidsp + $totalvxxsp;
                   $cu = $cu + 1;
          
        } 
           
//	$table = $table.'</table>';
//   
//	echo $table;
                   
        

 ?></div>
                            </section>
</div>
 <table class="table table-bordered table-striped table-hover" id="">                       
<tr>
    <td><?php echo 'El valor total de las hojas de vidrio son sin P: $'.number_format($total_vidsp);  ?>
    <td><?php echo 'El valor total de las hojas de vidrio son: $'.number_format($total_vid);  ?>


<tr><td><?php echo 'El peso total del vidrio es: '.number_format($peso_vid,1,',','.').' Kgs';  ?>
    <td>
 </table>
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab6">
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
                               <!--Modulo de regillas -->

<!--Fin Modulo de regillas -->
<?php  if($tipo=='Vidrio'){  ?>

<!--Modulo de Vidrio -->
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Compuestos Adicionales</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse3" class="body collapse in">

                                <div class="body-inner">

                            <div class="tabbable" style="margin-bottom: 25px;">

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab50">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">
                                           <?php 
    
if(isset($_GET['cot'])){ 
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['idcot']."");
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="5%">'.'# O.P'.'</th>'; 
               $table = $table.'<th width="7%">'.'Ref'.'</th>'; 
              $table = $table.'<th width="25%">'.'Producto'.'</th>';
              $table = $table.'<th width="7%">'.'Observacion.'.'</th>'; 
              $table = $table.'<th width="7%">'.'Color Vid.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cierres'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Espesor Vid.'.'</th>';
              
               $table = $table.'<th class="hidden-phone">'.'Ancho.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Alto.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
                $table = $table.'<th class="hidden-phone">'.'Precio Und.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Precio Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'%'.'</th>';
         
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $ta25 =0;
        $cont =0;
	while($row=mysqli_fetch_array($request))
	{
           
            $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult2= $fi3["p"]/100;
                
               
  if($row["cod_traz_sub"]==''){
      $r = 'No se selecciono ninguna trazabilidad';
  }else{
     $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz_sub"];                     
$result=  mysqli_query($conexion,$consulta);
while($fila=  mysqli_fetch_array($result)){
  $proceso=$fila['nombre_proceso'];
    
} 
if(isset($proceso)){$r = $proceso; }else{ $r ='Las areas seleccionadas no existen en la base de datos';}
  }         
             if($row["linea_cot_sub"]=='Vidrio'){$d1 = 'Per:'.$row["per_sub"].', Boq:'.$row["boq_sub"];}else{$d1 = 'Color Alum:'.$row["color_ta_sub"];}
            
            $cont = $cont + 1;
                    $suma2 = $row["valor_c_sub"];
            $a = $suma2 / $mult2;
          
            $b = $a ;
            $descpor = $b *$row["desc_sub"]/100;
            $b = $b - $descpor;
            $ta25 = $ta25 + $b;
            if($row["aprobado_sub"]==1){
                                $ch = '<a href="../vistas/?id=new_fac&ped='.$row["id_cotizacion_sub"].'&cot='.$_GET["cot"].'" title="cotizacion Revisada"><img WIDTH=18 HEIGHT=18 src="../imagenes/images.jpg"></a>';}else{
                                  $ch = '<a href="../vistas/?id=new_fac&ok='.$row["id_cotizacion_sub"].'&cot='.$_GET["cot"].'" title="Cotizacion sin Aprobacion"><img src="../images/no_apro.png"></a>';  
                                }
            $pu = ($b)/$row["cantidad_c_sub"];
            $table = $table.'<tr><td width="5%">'.$cont.'</a></td><td width="5%">'.$row["id_cot_sub"].'</a></td>'
                    . '<td width="7%">'.$row['codigo'].'</font></td>'
                    . '<td width="25%">'.$row['producto'].'</td>'
                    . '<td width="7%">'.$d1.'</a></td><td width="7%">'.$row["color_v"].'<font></a></td>'
                    . '<td class="hidden-phone">'.$row["cierre_sub"].'<font></a></td>'
                    . '<td class="hidden-phone">'.$row["espesor_v"].' (mm)<font></a></td>'
                    . '<td class="hidden-phone">'.$row["ancho_c_sub"].' (mm)</font></td>'
                    . '<td class="hidden-phone">'.$row["alto_c_sub"].' (mm)<font></a></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_c_sub"].' (Und)<font></a></td>'
                    . '<td class="hidden-phone">$'.number_format($pu).'</font></td>'
                    . '<td class="hidden-phone">$'.number_format($b).'</font></td>'
                    . '<td class="hidden-phone">'.$row["porcentaje_sub"].'-'.$row["desc_sub"].'%</font></td></tr>';   
          
		
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
        if($cont!=0){
     echo '<div align="right"><FONT color="red"><h5> TOTAL EN COMPUESTOS: $'.number_format($ta25).'</h5></FONT></div>';} 

} 
}  
 ?>
          </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                         

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<!--Fin Modulo de Vidrio -->

                          <?php }  ?>
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE ACCESORIOS PARA FABRICACIÓN</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                           
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab3">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 

        $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
        $table = $table.'<thead >';
        $table = $table.'<tr bgcolor="#D1EEF0">';
        $table = $table.'<th width="7%">'.'Referencia'.'</th>';  
        $table = $table.'<th width="7%">'.'Codigo'.'</th>'; 
        $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
        $table = $table.'<th width="7%">'.'color'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Und'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Total'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Total +P'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Und FOM'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P FOM'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Total FOM'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Costo Lista Total +P FOM'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Disponible'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Solicitar'.'</th>';
        $table = $table.'<th class="hidden-phone">'.'Saldo'.'</th>';
        $table = $table.'</tr>';
        $table = $table.'</thead>';
$reques=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c, producto_rep_acc b, referencias d where b.id_ref_acc=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." group by d.id_referencia");
$total2=0;
        $tacot =0;
        $cont =0;
         $total2=0;
        $tac = 0;
        $peso_acc=0;$tacfom =0;
	while($row=mysqli_fetch_array($reques))
	{     
            include '../vistas/form/suma_accesorios_1.php';
      
            $cont +=1;
            $tac = $tac + ($ff*($row["costo_mt"]/$porcacc)*$mm + $aa);
            $tacfom = $tacfom + ($ff*($row["costo_fom"]/$porcacc)*$mm + $aa);
             $pst_acc = (($row['peso'] * $cantidad_acc));
             $peso_acc = $peso_acc + $pst_acc;
                  $saldo = ($row["cantidad_e"]-$row["cantidad_r"]) - $ff;
           if($saldo>=0){
               $e22 = '<font color="green">'.  number_format($saldo).'</font>';
           }else{
               $e22 = '<font color="red">'.  number_format($saldo).'</font>';
           }
$table = $table.'<tr><td width="7%">'.$cont.'</a></td>
<td width="7%">'.$row['codigo'].'</a></td>
<td width="30%">'.$row['descripcion'].'</font></td>
<td width="7%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($row["costo_mt"]).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($row["costo_mt"]/$porca).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format(($ff * $row["costo_mt"])*$mm + $aa).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($ff*($row["costo_mt"]/$porcacc)*$mm + $aa).'</font></td>
    <td class="hidden-phone">$<font color="blue">'.number_format($row["costo_fom"]).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($row["costo_fom"]/$porca).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($ff * $row["costo_fom"])*$mm + $aa).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($ff*($row["costo_fom"]/$porcacc)*$mm + $aa).'</font></td>
<td class="hidden-phone"><font color="purple">'.number_format($row["cantidad_e"]-$row["cantidad_r"]).'</font></td>
<td class="hidden-phone"><font color="purple">'.number_format($ff).'</font></td>
<td class="hidden-phone">'.$e22.'</td></tr>';   
           
		
               
         }
	$table = $table.'</table>';
        
	echo $table;
        
    

     

   ?>
<table class="table table-bordered table-striped table-hover" id="">
<tr><td><?php  echo 'Costo Lista Total : $<font color="red">'.number_format($tac_p = $tac * $porcacc).'</font>';  ?>
<td><?php  echo 'Costo Lista Total FOM : $<font color="blue">'.number_format($tac_pfom = $tacfom * $porcacc).'</font>';  ?>
<tr><td> <?php  echo 'Costo Lista Total + P: $<font color="red">'.number_format($tac).'</font>, ';   ?>
<td> <?php  echo 'Costo Lista Total + P FOM: $<font color="blue">'.number_format($tacfom).'</font>, ';   ?>
</table>
                            </section>
                        </div>
                        
<?php 
$tac = $tac;
$ta_p =$tp1;

    $txx = $tps + $xx + $total_vid + $tac;
     $txx_p = $tp1 + $xx_p + $total_vidsp + $tac_p;
   
      $txxfom = $tpsfom + $xxfom + $total_vid + $tacfom;
     $txx_pfom = $tp1fom + $xx_pfom + $total_vidsp + $tac_pfom;

?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                  
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Gastos de maquina</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                     
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab11">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c, cotizaciones d where  d.id_referencia=a.id_p and  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and d.id_cot=".$_GET['cot'].' group by b.id_ref_ma');
    echo $txx;
     
if($request_mano){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad'.'</th>';
              $table = $table.'<th width="10%">'.'Dias'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%">'.'Costo.'.'</th>';
                $table = $table.'<th width="10%">'.'Costo FOM.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tot2=0;
        $tot2_p=0;
        $tot2fom=0;
        $tot2_pfom=0;
	while($row=mysqli_fetch_array($request_mano))
	{      
               $_GET['aa']= $row["ancho_abajo"];$_GET['ancho']= $row["ancho_c"];$_GET['alto']= $row["alto_c"];
          $_GET['cant']= $row["cantidad_c"];
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            if($row['dias']=='Si'){
                if($_GET['alto']>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 0;
                }
               $r = $row["porcentaje_ma"]*($res)*$_GET['dias'];
                $tot2 = $tot2 + $r ;
                $dias = $_GET['dias'];
                $p = 'Und';
            }else{
                $r = ($txx*$row["porcentaje_ma"])/100;
                $r_p = ($txx_p*$row["porcentaje_ma"])/100;
                $rfom = ($txxfom*$row["porcentaje_ma"])/100;
                $r_pfom = ($txx_pfom*$row["porcentaje_ma"])/100;
                $tot2 = $tot2 + $r;
                $tot2_p = $tot2_p + $r_p;
                 $tot2fom = $tot2fom + $rfom;
                $tot2_pfom = $tot2_pfom + $r_pfom;
                $dias = 'No aplica';
                $p = '%';
                $res = 'No aplica';
            }
            
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_ma'].'</font></td>'
                    . '<td width="10%"> '.$res.'</td>'
                    . '<td width="10%"> '.$dias.'</td>'
                    . '<td width="10%"> '.$row["porcentaje_ma"].''.$p.'<font></a></td>
               <td width="10%">$ '.number_format($r).' <font></a></td>'
                    . '<td width="10%">$ '.number_format($rfom).' <font></a></td></tr>';        
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
                        <table class="table table-bordered table-striped table-hover" id="">

   <tr><td><?php echo 'El valor total de maquinaria: $'.number_format($tot2_p); ?>
           <td><?php echo 'El valor total de maquinaria FOM: $'.number_format($tot2_pfom); ?>
    <tr><td><?php echo 'El valor total de maquinaria + P: $'.number_format($tot2); ?>
            <td><?php echo 'El valor total de maquinaria + P FOM: $'.number_format($tot2fom); ?>

</table>
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab12">
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
                                          <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Mano de Obra por Producto</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                   
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab7">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_maq=mysqli_query($conexion,"SELECT *, sum(cantidad_c) as cc FROM producto a, producto_rep_mo b, referencia_mo c, cotizaciones d where d.id_referencia=a.id_p and b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and d.id_cot=".$_GET["cot"]." group by c.id_ref_mo");
    
     
if($request_maq){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Instalacion ?'.'</th>';
              $table = $table.'<th width="10%">'.'Cobrado por'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad de Productos.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tot=0;
	while($row=mysqli_fetch_array($request_maq))
	{       
          $_GET['aa']= $row["ancho_abajo"];$_GET['ancho']= $row["ancho_c"];$_GET['alto']= $row["alto_c"];
          $_GET['cant']= $row["cantidad_c"];
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
            if($row["install"]=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($row['cc']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($row['cc']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($row['cc']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($row['cc']*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
            }else{
                if($row['install']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($row['cc']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($row['cc']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($row['cc']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($row['cc']*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
                }else{
                    $tar = 0;
                }
            }
            
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
                    . '<td width="10%">'.$row["cc"].'<font></a></td>'
                    . '<td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td width="10%">$ '.number_format($tar).'<font></a></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
        
}
 ?>
                                </div>
                            </section>
                        </div>
<?php echo 'Total en mano de obra : $'.number_format($tot);

if(isset($tv2)){
    $total= $ta + $tv2 + $tac+ $tot+$tot2;
     $total_p  = $ta_p  + $tv2  + $tac_p + $tot +$tot2_p ;
}else{
    $total = $ta  + $tac+ $tot+$tot2;
     $total_p = $ta_p  + $tac_p + $tot_p+$tot2_p;
}
$txx = $txx + $tot;
$txx_p = $txx_p + $tot;

$txxfom = $txxfom + $tot;
$txx_pfom = $txx_pfom + $tot;
?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab8">
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
 </section>
</div>
                                 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Gastos Administrativo y Utilidad</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
              
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab9">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c, cotizaciones d where  d.id_referencia=a.id_p and b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and d.id_cot=".$_GET["cot"]."  group by b.id_ref_ad");
    
     
if($request_ad){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
                  $table = $table.'<th width="10%">'.'Valor Total Fom.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tota=0;$tota_p=0;$totafom=0;$tota_pfom=0;
	while($row=mysqli_fetch_array($request_ad))
	{       
            $por = 100;
            $tota = $tota + ($txx*$row["porcentaje_ad"]/$por);
            $tota_p = $tota_p + ($txx_p*$row["porcentaje_ad"]/$por);
                        $totafom = $totafom + ($txxfom*$row["porcentaje_ad"]/$por);
            $tota_pfom = $tota_pfom + ($txx_pfom*$row["porcentaje_ad"]/$por);
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td>'
                    . '<td width="10%">'.$row['descripcion_ad'].'</font></td>'
                    . '<td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td width="10%">$  <font color="red">'.number_format($txx*$row["porcentaje_ad"]/$por).'</td>'
                    . '<td width="10%">$ <font color="blue">'.number_format($txxfom*$row["porcentaje_ad"]/$por).'</td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
         <table class="table table-bordered table-striped table-hover" id="">  
             <tr><td><?php echo 'Total de gastos administrativos y utilidades son : $ <font color="red">'.number_format($tota_p); ?>
        <td><?php echo 'Total de gastos administrativos y utilidades fom son  : $ <font color="blue">'.number_format($tota_pfom); ?>
<tr><td><?php echo 'Total de gastos administrativos y utilidades +P son : $ <font color="red">'.number_format($tota); ?>
        <td><?php echo 'Total de gastos administrativos y utilidades +P fom son : $ <font color="blue">'.number_format($totafom); ?>

         </table>
                                    </div>
                                    <div class="tab-pane" id="tab10">
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
 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Otros Gastos</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
   
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab13">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_ot=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_ot){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Cant. Und.'.'</th>';
              $table = $table.'<th width="10%">'.'Cant. Total.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und'.'</th>';
               $table = $table.'<th width="10%">Valor Total</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2=0;
	while($row=mysqli_fetch_array($request_ot))
	{       
             $t2 = $t2 + $row['valor_ot']*$_GET['cant']*$row['cantidad_ot'];
            $table = $table.'<tr><td width="20%">'.$row['referencia_ot'].'</a></td><td width="10%">'.$row['descripcion_ot'].'</font></td><td width="10%"> '.$row["cantidad_ot"].' Und<font></a></td><td width="10%">'.$row['cantidad_ot']*$_GET['cant'].'</font></td><td width="10%">$ '.number_format($row["valor_ot"]).' <font></a></td>
               <td width="10%">'.number_format($row['valor_ot']*$_GET['cant']*$row['cantidad_ot']).'</font></td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
<?php echo 'Total de otros gastos :$'.number_format($t2);  ?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab14">
                                        <div class="row-fluid">
                                            
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
       <?php 
       if(isset($totalv)){$mas =$totalv;$mas2 =$totalvsp;}else{$mas =0;$mas2 =0;}
$totalx = $ta + $xx + $tac + $total_vid +  $tot2 + $tot + $tota + $t2 + $mas;
$totalx_p = $ta_p + $xx_p + $tac_p + $total_vidsp +  $tot2_p + $tot + $tota_p + $t2 + $mas2;

$totalxfom = $tpsfom + $xxfom + $tacfom + $total_vid +  $tot2fom + $tot + $totafom + $t2+ $mas;
$totalx_pfom = $tpsfom + $xx_pfom + $tac_pfom + $total_vidsp +  $tot2_pfom + $tot + $tota_pfom + $t2 + $mas2;

$kg = $ptt + $peso_vid + $peso_rej + $peso_acc;
?>
                                <table class="table table-bordered table-striped table-hover" id="">    
<tr><td><?php echo "<h4>Costo total del Producto: $".number_format($totalx_p).'<h4>';?>
<td><?php echo "<h4>Costo total del Producto FOM: $".number_format($totalx_pfom).'<h4>';?>
<tr><td><?php echo "<h4>Costo total del Producto + P : $".number_format($totalx).'<h4>'; ?>
<td><?php echo "<h4>Costo total del Producto + P FOM: $".number_format($totalxfom).'<h4>'; ?>

                                 </table>  
                                <?php  echo "<h4>El Peso Total de este Producto es de: <font color='red'> ".number_format($kg,1,',','.').' Kgs</font><h4>';?>
                            </section>
                        </div>
                    
                    </div>
         
 </section></div>
 <div class="control-group">
                                        <div class="alert">
                                            <button type="button" class="close" data-dismiss="alert"></button>
                                       
                                               </div>
                                    </div>
        
<?php require '../vistas/script.php';  ?>
</body>
</html>