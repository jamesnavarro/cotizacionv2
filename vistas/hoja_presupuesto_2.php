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
    <title>HOJA DE COSTO REAL</title>
    
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

               $table = $table.'<th width="20%">'.'medida.'.'</th>';
         

               $table = $table.'<th class="hidden-phone">'.'Costo R.U Ml'.'</th>';
                     $table = $table.'<th class="hidden-phone">'.'Costo+P.U'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo R.U.T'.'</th>';
         
               $table = $table.'<th class="hidden-phone">'.'Costo+P.T'.'</th>';
  $table = $table.'<th class="hidden-phone">'.'Disponible'.'</th>';
    $table = $table.'<th class="hidden-phone">'.'Solicitar'.'</th>';
     $table = $table.'<th class="hidden-phone">'.'Saldo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
    
 // aqui va el codigo de las listas de productos
 $reques1=mysql_query("SELECT * FROM producto a, cotizaciones c, producto_rep_alu b, referencias d where b.id_ref_alum=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." group by referencia ");
$total2=0;
        $tacot =0;
        $cont =0; $ta =0;$ptt =0;$tp1=0;$tps=0;
	while($row=mysql_fetch_array($reques1))
	{            
	            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vi2));
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
 $fil =mysql_fetch_array(mysql_query($sql));
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
         $fil2 =mysql_fetch_array(mysql_query($sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET["ancho"]/1000) + ($_GET["alto"]/1000)) * $costo_v)*$_GET["cant"];
 }           
	
 include '../vistas/form/suma_de_perfiles_1.php';
 $ta += $ta2;
 $pr = $med_t / $row["medida"];
                   $mdt = ($med_t/1000)*$row["costo_fom"]; 
                   $mdtp = ($med_t/1000)*$mp; 
                    $tp1 +=$mdt;
                    $tps +=$mdtp;
           $pr2 = ceil($pr);
           $saldo = ($row["cantidad_e"]-$row["cantidad_r"]) - $pr2;
           if($saldo>=0){
               $e = '<font color="green">'.  number_format($saldo).'</font>';
           }else{
               $e = '<font color="red">'.  number_format($saldo).'</font>';
           }
           
            $table = $table.'<tr>'
                    . '<td width="10%">'.$row['referencia'].'</a></td>
                <td width="10%">'.$row['codigo'].'</a></td>
                    <td width="10%">'.$row['descripcion'].'</font></td>
                      <td width="10%">'.$row["medida"].' mm<font></a></td>'.$t.'
               <td class="hidden-phone"><font color="blue">'.  number_format($pr,1,',','.').'</font></td>'
                    . '<td width="20%">'.number_format($med_t).' mm<font></a></td>
                   <td class="hidden-phone">$'.number_format(($row["costo_fom"])).'</font></td>'
                   . '<td class="hidden-phone">$'.number_format($mp).'</font></td>
                       <td class="hidden-phone">$'.number_format($mdt).'</font></td>
                       <td class="hidden-phone">$'.number_format($mdtp).'</font></td>
                       <td class="hidden-phone"><font color="blue">'.number_format($row["cantidad_e"]-$row["cantidad_r"]).'</font>'
                    . '<td class="hidden-phone"><font color="blue">'.  number_format($pr2).'</font></td>'
                    . '<td class="hidden-phone">'.$e.'</td>'
                    . '</tr>';   
	} 
        
	$table = $table.'</table>';
        
	echo $table;
        

   
 ?>
                                </div>
                            </section>
                        </div>

<?php echo ', El Costo total de la perfileria es: $<font color="red">'.number_format($tps).'</font>';  ?>
<?php echo ', El Costo total de la perfileria sin P es: $<font color="red">'.number_format($tp1).'</font>';  ?>


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

$ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET["ref"]."  ");
$cm = mysql_fetch_array($ac);
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
              $table = $table.'<th width="7%">'.'referencia'.'</th>'; 
              $table = $table.'<th width="7%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Peso (Kg)'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Rejillas'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Medidas Total'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Perfiles'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo R.U'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo R.U.T'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo+P.U'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo+P.T'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Disponible'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Solicitar'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Saldo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
 $reques=mysql_query("SELECT * FROM producto a, cotizaciones c, producto_rep_rej b, referencias d where b.id_referencia=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." ");
$total2=0;
        $tacot =0;
        $cont =0; $xx=0; 
        $peso_rej=0;
	while($row=mysql_fetch_array($reques))
	{            
            $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vi2));
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
     
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_p"]." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
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
       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_p"]." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$row["id_p"]." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysql_fetch_array(mysql_query($sqlxr));
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
         $prej = $row["costo_fom"] / $porca;
             
          
         
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
            
            $pst_rej = (($row['peso'] * $medrej) / $row["medida"])*$tv2*$_GET['cant'];
            $peso_rej = $peso_rej + $pst_rej;
          $tv22 = ceil($numero*$_GET['cant']);
           $saldo = ($row["cantidad_e"]-$row["cantidad_r"]) - $tv22;
           if($saldo>=0){
               $e2 = '<font color="green">'.  number_format($saldo).'</font>';
           }else{
               $e2 = '<font color="red">'.  number_format($saldo).'</font>';
           }
            $table = $table.'<tr><td width="7%">'.$row['codigo'].'</a></td>'
                    . '<td width="7%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>
                   <td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2 * $medrej).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($numero*$_GET['cant'],1,',','.').'</font></td>
                       '
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_fom"]/1000).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_fom"]*$_GET['cant']/1000).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$prej/1000).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$prej*$_GET['cant']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($row["cantidad_e"]-$row["cantidad_r"]).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($tv22).'</font></td>'
                    . '<td class="hidden-phone">'.$e2.'</td></tr>';   
           
		
               
        } 
	$table = $table.'</table>';
        
	echo $table;


 ?></div>
                            </section>
                        </div>
<?php 
//echo 'rejilla : '.$row["medida_rej"].'<br>';
//echo '$tv2'.$tv2.'<br>';
//echo 'costo'.$row["costo_fom"].'<br>';
echo 'El valor total de las rejillas: $<font color="red">'.number_format($xx).'</font>';
echo ', El valor unitario de las rejillas: $<font color="red">'.number_format($xx / $_GET['cant']).'</font>'; 
echo ', El valor total de las rejillas sin P: $<font color="red">'.number_format($xx_p = $xx * $porca).'</font>'; 
echo ', El valor unitario de las rejillas sin P: $<font color="red">'.number_format($xx_p /  $_GET['cant']).'</font>';
echo ', El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';?>
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
 	                          
$reques4=mysql_query("SELECT * FROM producto a, cotizaciones c, producto_rep_vid b, referencias d where b.id_ref_vid=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." group by pertenece,id_vidrio, id2_vidrio, id3_vidrio, id4_vidrio, traz_vid, traz_vid2, traz_vid3, traz_vid4");
$total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
	while($row33=mysql_fetch_array($reques4))
	{            
           
include '../vistas/form/suma_de_vidrios.php';

                   echo '<span style="color:blue">Medidas de '.$rowt['descripcion'].' : Ancho: '.number_format($anchi_gen).' x Alto: '.number_format($alti_gen).', Total M<sup>2</sup>: '.number_format($mtt,1,',','.').'</span>';
         $porc = $porcv;
  $cof= mysql_query("SELECT * FROM `cotizaciones` where id_cotizacion=".$row33['id_cotizacion']."  ");
$tr= mysql_fetch_array($cof);
//echo $tr['traz_vid'];

         $con2= "SELECT * FROM `producto` where id_p=".$tr['traz_vid']." ";
$res2=  mysql_query($con2);
while($f8=  mysql_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];

}
if($_GET['tv2']==0){
$nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$_GET['tv2']." ";
$res22=  mysql_query($con22);
while($f8=  mysql_fetch_array($res22)){
$idco2=$f8['id_p'];
$nombr2=$f8['producto'];

}}
if($_GET['tv3']==0){
$nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$_GET['tv3']." ";
$res23=  mysql_query($con23);
while($f8=  mysql_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];

}}
if($_GET['tv4']==0){
$nombr4='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$_GET['tv4']." ";
$res24=  mysql_query($con24);
while($f8=  mysql_fetch_array($res24)){
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
<?php echo 'El valor total de las hojas de vidrio son: $'.number_format($total_vid);  ?>
<?php echo '<br>El Unitario total de las hojas de vidrio son: $'.number_format($total_vid / $_GET['cant']);  ?>
<?php echo '<br>El valor total de las hojas de vidrio son sin P: $'.number_format($total_vidsp);  ?>
<?php echo '<br>El valor Unitario de las hojas de vidrio son sin P: $'.number_format($total_vidsp / $_GET['cant']);  ?>
                        <?php echo '<br>El peso total del vidrio es: '.number_format($peso_vid,1,',','.').' Kgs';  ?>
<!--/ END Datatable 2 -->
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
 $request=mysql_query("SELECT * FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['idcot']."");
   
     
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
	while($row=mysql_fetch_array($request))
	{
           
            $s3 = "SELECT (".$row["porcentaje_sub"].") as p FROM porcentajes where area_por='".$row["linea_cot_sub"]."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $mult2= $fi3["p"]/100;
                
               
  if($row["cod_traz_sub"]==''){
      $r = 'No se selecciono ninguna trazabilidad';
  }else{
     $consulta= "SELECT * FROM `proceso` where codigo=".$row["cod_traz_sub"];                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
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


//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="7%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="7%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="7%">'.'color'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Unidad'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Unidad+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo R.U.T'.'</th>';

               $table = $table.'<th class="hidden-phone">'.'Costo+P.T'.'</th>';
                 $table = $table.'<th class="hidden-phone">'.'Disponible'.'</th>';
                   $table = $table.'<th class="hidden-phone">'.'Solicitar'.'</th>';
                     $table = $table.'<th class="hidden-phone">'.'Saldo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
$reques=mysql_query("SELECT * FROM producto a, cotizaciones c, producto_rep_acc b, referencias d where b.id_ref_acc=d.id_referencia and a.id_p=b.id_p and c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." group by d.id_referencia");
$total2=0;
        $tacot =0;
        $cont =0;
         $total2=0;
        $tac = 0;
        $peso_acc=0;
	while($row=mysql_fetch_array($reques))
	{            
            include '../vistas/form/suma_accesorios_1.php';
            $cont +=1;
            $tac = $tac + ($ff*($row["costo_fom"]/$porcacc)*$mm + $aa);
            
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
                   <td class="hidden-phone">$'.number_format($row["costo_fom"],0,',','.').'</font></td>
                            <td class="hidden-phone">$'.number_format($row["costo_fom"]/$porca).'</font></td>
                       <td class="hidden-phone">$'.number_format(($ff * $row["costo_fom"])*$mm + $aa).'</font></td>
                    
                           <td class="hidden-phone">$'.number_format($ff*($row["costo_fom"]/$porcacc)*$mm + $aa).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($row["cantidad_e"]-$row["cantidad_r"]).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($ff).'</font></td>'
                    . '<td class="hidden-phone">'.$e22.'</td></tr>';   
           
		
               
         }
	$table = $table.'</table>';
        
	echo $table;
        echo 'El valor total de los insumos son: $<font color="red">'.number_format($tac).'</font>, '; 
   echo 'El valor total de los insumos sin P son : $<font color="red">'.number_format($tac_p = $tac * $porcacc).'</font>, '; 

     

 ?>
                            </section>
                        </div>
                        
<?php 
$tac = $tac;
$ta_p =$tp1;
if(isset($total_vid)){
    $txx = $tps + $xx + $total_vid + $tac;
     $txx_p = $tp1 + $xx_p + $total_vidsp + $tac_p;
     echo $tps.' + '.$xx.' + '.$total_vid.' +'.$tac;
}else{
      $s3 = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $porc= $fi3["p"]/100;
                
                
    
    
    $tv2 =0;
    $ta = 0;
    $total_vid =0;
    $total_vidsp =0;
    $xx=0;
    $ta_p =0;
    $xx_p=0;
    
    
//    echo '<h4>COSTO X M<sup>2</sup> : '.$txx.'</h4>';
        echo '<br>';
   include '../modelo/suma_vidrios_2.php';
    $txx = $totalv + $tac;
            echo 'El valor total de los Vidrios son con P: $'.number_format($totalv).'<br>'; 
         echo 'El valor UNITARIO de los Vidrios son con P: $'.number_format($totalv / $_GET["cant"]).'<br>'; 
          echo 'El valor total de los Vidrios sin P son : $'.number_format($totalvsp).'<br>'; 
           echo 'El valor Unitario de los Vidrios sin P son: $'.number_format($totalvsp / $_GET["cant"]).'<br>'; 
   $txx_p = $totalvsp + $tac_p;
}
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
   
$request_mano=mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c, cotizaciones d where  d.id_referencia=a.id_p and  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and d.id_cot=".$_GET['cot'].' group by b.id_ref_ma');
    
     
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
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tot2=0;
        $tot2_p=0;
        echo $txx;
	while($row=mysql_fetch_array($request_mano))
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
                $tot2 = $tot2 + $r;
                $tot2_p = $tot2_p + $r_p;
                $dias = 'No aplica';
                $p = '%';
                $res = 'No aplica';
            }
            
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_ma'].'</font></td>'
                    . '<td width="10%"> '.$res.'</td>'
                    . '<td width="10%"> '.$dias.'</td>'
                    . '<td width="10%"> '.$row["porcentaje_ma"].''.$p.'<font></a></td>
               <td width="10%">$ '.number_format($r).' <font></a></td></tr>';        
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
echo 'El valor total de maquinaria es: $'.number_format($tot2); 
echo '<br>El valor total de maquinaria sin P es: $'.number_format($tot2_p); 
?>
                        <!--/ END Datatable 2 -->
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
   
$request_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c, cotizaciones d where  d.id_referencia=a.id_p and  b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and d.id_cot=".$_GET["cot"]);
    
     
if($request_maq){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Instalacion ?'.'</th>';
              $table = $table.'<th width="10%">'.'Cobrado por'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tot=0;
	while($row=mysql_fetch_array($request_maq))
	{       
             $_GET['aa']= $row["ancho_abajo"];$_GET['ancho']= $row["ancho_c"];$_GET['alto']= $row["alto_c"];
          $_GET['cant']= $row["cantidad_c"];
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
            if($_GET["ins"]=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET['cant']*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
                }else{
                    $tar = 0;
                }
            }
            
            $table = $table.'<tr><td width="20%">'.$row['referencia'].'</a></td>'
                    . '<td width="10%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
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
echo '<br>Total x Unidad en mano de obra : $'.number_format($tot / $_GET['cant']);
if(isset($tv2)){
    $total= $ta + $tv2 + $tac+ $tot+$tot2;
     $total_p  = $ta_p  + $tv2  + $tac_p + $tot +$tot2_p ;
}else{
    $total = $ta  + $tac+ $tot+$tot2;
     $total_p = $ta_p  + $tac_p + $tot_p+$tot2_p;
}
$txx = $txx + $tot;
$txx_p = $txx_p + $tot;
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
   
$request_ad=mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c, cotizaciones d where  d.id_referencia=a.id_p and b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and d.id_cot=".$_GET["cot"]."  group by b.id_ref_ad");
    
     
if($request_ad){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tota=0;$tota_p=0;
	while($row=mysql_fetch_array($request_ad))
	{       
            $por = 100;
            $tota = $tota + ($txx*$row["porcentaje_ad"]/$por);
            $tota_p = $tota_p + ($txx_p*$row["porcentaje_ad"]/$por);
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td width="10%">$ '.number_format($txx*$row["porcentaje_ad"]/$por).' <font></a></td></tr>';   
           
		
               
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
<?php echo 'Total de gastos administrativos y utilidades con P son : $'.number_format($tota); ?>
                                         <?php echo '<br>Total de gastos administrativos y utilidades sin P son : $'.number_format($tota_p); ?>
                    <!--/ END Row -->
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
   
$request_ot=mysql_query("SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
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
	while($row=mysql_fetch_array($request_ot))
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

$kg = $ptt + $peso_vid + $peso_rej + $peso_acc;

echo "<h4>Costo total del Producto con P : $".number_format($totalx).'<h4>';
echo "<h4>Costo unitario del Producto con P: $".number_format($totalx / $_GET['cant']).'<h4>';
echo "<h4>Costo total del Producto sin P : $".number_format($totalx_p).'<h4>';
echo "<h4>Costo unitario del Producto sin P : $".number_format($totalx_p / $_GET['cant']).'<h4>';
echo "<h4>El Peso Total de este Producto es de: <font color='red'> ".number_format($kg,1,',','.').' Kgs</font><h4>';
                                         ?> 
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