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
    <title>HOJA DE MARTERIALES</title>
    
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
 
 // aqui va el codigo de las listas de productos
 $reques=mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." ");
$a1=0;
        $a2 =0;
        $a3 =0;$a4 =0;$a5 =0;$a6 =0;$a7 =0;$a8 =0;$a9 =0;
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
 if(isset($_GET['ref'])){
 $sql='select * from producto where id_p="'.$_GET['ref'].'"';
 $fil =mysql_fetch_array(mysql_query($sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipo= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipo_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $_GET['ancho'];$aa= $_GET['aa'];
        $alto= $_GET['alto'];
        $altura= $_GET["cuerpo"];
        $altura_ventana = $_GET['alto']-$_GET['cuerpo'];
        if($_GET['l']=='Derecho'){
            $ruta= $fil["ruta"];
        }else{
            $ruta= $fil["ruta2"];
        }
        
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$_GET['id_v'].'"';
         $fil2 =mysql_fetch_array(mysql_query($sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET['ancho']/1000) + ($_GET['alto']/1000)) * $costo_v)*$_GET['cant'];
 }
$ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET['ref']."  ");
$cm = mysql_fetch_array($ac);
$mt = $cm['count(*)'];
 ?>
<?php if(isset($_GET['ref'])){ ?>          
<div class="row-fluid">
     
                    </div>
                            
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
  <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['ref'])){echo '../modelo/producto.php?editar='.$_GET['cod'].'';}else{echo '../modelo/producto.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=gb18030"><h4 class="title"><?php if(isset($_GET['ref'])){echo 'Producto Cotizado';}else{echo 'Crear Producto';} ?></h4>
<!--                                <a href="../vistas/print_dt.php?<?php echo 'l='.$_GET['l'].'&mod='.$_GET['mod'].'&per='.$_GET['per'].'&boq='.$_GET['boq'].'&ref='.$_GET['ref'].'&cot='.$_GET['cot'].'&idcot='.$_GET['idcot'].'&tv='.$_GET['tv'].'&tv2='.$_GET['tv2'].'&tv3='.$_GET['tv3'].'&tv4='.$_GET['tv4'].'&aa='.$_GET['aa'].'&ancho='.$_GET['ancho'].'&alto='.$_GET['alto'].'&cant='.$_GET['cant'].'&vidrio='.$_GET['vidrio'].''
                                        . '&id_v='.$_GET['id_v'].'&id_v2='.$_GET['id_v2'].'&id_v3='.$_GET['id_v3'].'&id_v4='.$_GET['id_v4'].'&id_v5='.$_GET['id_v5'].'&id_v6='.$_GET['id_v6'].''
                                        . '&id2_v='.$_GET['id2_v'].'&id2_v2='.$_GET['id2_v2'].'&id2_v3='.$_GET['id2_v3'].'&id2_v4='.$_GET['id2_v4'].'&id2_v5='.$_GET['id2_v5'].'&id2_v6=0'
                                        . '&id3_v='.$_GET['id3_v'].'&id3_v2='.$_GET['id3_v2'].'&id3_v3='.$_GET['id3_v3'].'&id3_v4='.$_GET['id3_v4'].'&id3_v5='.$_GET['id3_v5'].'&id3_v6=0'
                                        . '&id4_v='.$_GET['id4_v'].'&id4_v2='.$_GET['id4_v2'].'&id4_v3='.$_GET['id4_v3'].'&id4_v4='.$_GET['id4_v4'].'&id4_v5='.$_GET['id4_v5'].'&id4_v6=0'
                                        . '&cuerpo='.$_GET['cuerpo'].'&hojas='.$_GET['hojas'].'&ins='.$_GET['ins'].'&por='.$_GET['por'].'&v='.$_GET['v'].'&h='.$_GET['h'].'&d1='.$_GET['d1'].'&dias='.$_GET['dias'].''; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/imp.png"></a>-->
                              </header>
                            <section class="body">
                                <div class="body-inner">

                                        <center>   <table class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <td rowspan="5"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                
                                               
                                                <div class="fileupload-new thumbnail" style="width: 300px; height: 200px;"><img src="<?php if(isset($_GET['ref'])){
                                                    if($ruta==''){echo '../producto/no.jpg';}else{echo '../producto/'.$ruta;}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                               
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                             </div></td>
                                                    <td>Linea del Producto</td>
                                                    <td><select name="tipo_p" readonly class="span6" required> 
                                                    <?php if(isset($_GET['ref'])){echo "<option value='".$tipo."'>".$tipo."</option>";}else{echo "<option value=''>Seleccione.. </option>";} ?>
                                                  <td>Ancho Cotizado (mm)</td>
                                                    <td><input type="text" readonly style="width: 60px" name="ancho" value="<?php if(isset($_GET['ref'])){echo $_GET['ancho'];}?>"  placeholder=" " required>
                                                    <?php if($_GET['aa']!=0){
                                                        echo 'Abajo<input type="text" readonly style="width: 60px" name="aa" value="'.$_GET['aa'].'">';
                                                    } ?>
                                                    </td>
                                                   
                                          </select></td>
                                                </tr>
                                                <tr>
                                                     <td>Codigo del Producto</td>
                                                    <td><input type="text" readonly name="codigo" value="<?php if(isset($_GET['ref'])){echo $codigo;} ?>" class="span6" placeholder=" " required></td>
                                                   
                                                    <td>Alto Cotizado (mm)</td>
                                                    <td><input type="text" style="width: 60px" readonly name="alto" value="<?php if(isset($_GET['ref'])){echo $_GET['alto'];} ?>"  placeholder=" " required></td>
                                                </tr>
                                                <tr>
                                                     <td>Nombre del Producto</td>
                                                     <td><input type="text" title="<?php if(isset($_GET['ref'])){echo $producto;} ?>" readonly name="producto" value="<?php if(isset($_GET['ref'])){echo $producto;} ?>" placeholder=" " required></td>
                                                   
                                                    <td>Cantidad cotizada (Und)</td>
                                                    <td><input type="text" readonly name="alto" value="<?php if(isset($_GET['ref'])){echo $_GET['cant'];} ?>"  placeholder=" " class="span6" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Color y Espesor del Vidrio</td>
                                                    <td><input type="text" readonly name="tipo_v" value="<?php if(isset($_GET['ref'])){echo $_GET['vidrio'].'';} ?>" class="span6" placeholder=" " required></td>
                                                    <td>Altura Cuerpo Fijo ó rejilla</td>
                                                    <td><input type="text" readonly name="altura" value="<?php if(isset($_GET['ref'])){echo $altura;} ?>" style="width: 50px;"></td>
                                                </tr>
                                                <tr>
                                                    <td>Porcentaje Materia Prima</td>
                                                    <td><input type="text" readonly name="tipo_v" value="<?php if(isset($_GET['ref'])){echo $_GET['por'];} ?>" class="span6" placeholder=" " required></td>
                                                    <td>Altura de Ventana Corrediza</td>
                                                    <td><input type="text" readonly name="altura_c" value="<?php if(isset($_GET['ref'])){$altura_v_c =$_GET['alto']- $altura; echo $altura_v_c;} ?>" style="width: 50px;"></td>
                                                </tr>
                                                
                                            </table></center><br></fieldset>                                 
                                           
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                      
                                       
                                    </div><!--/ Form Action -->
                                </div>
                            </section>
                        </form>
                      <!-- START Widget Collapse -->
<?php    

    ?>
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            
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

$alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysql_fetch_array(mysql_query($alum_por));
                $porca= $fia["p"]/100;
 $request=mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." order by c.referencia asc ");
   
     
if($request){
    $table = '<p><center> REPARTO DE ALUMINIOS </center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              
              $table = $table.'<th width="5%">'.'Ref'.'</th>';
              $table = $table.'<th width="5%">'.'Cod'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              if($tipo=='Fachada'){$table = $table.'<th  class="hidden-phone">'.'Distancia'.'</th>';}
              
               $table = $table.'<th style="text-align:center;width:5%">'.'Segmentos.'.'</th>';
               $table = $table.'<th width="10%">'.'Medida.'.'</th>';
               $table = $table.'<th width="10%">'.'Peso T(Kg).'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Perfil'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Perfiles'.'</th>';
              
     
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;$ptt =0;$tafom =0;
	while($row=mysql_fetch_array($request))
	{    
            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])+ $row['variable'];
            }
                }
                   
                }
            }else{
               if($row['signo']=='-'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])- $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])- $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])- $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])- $row['variable'];
            }
                }
                 
                }
            }else{
                if($row['signo']=='*'){
                  if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])* $row['variable'];
                }else{
                    
                }
                    if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])* $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])* $row['variable'];
            }
                }
            }else{
                if($row['signo']=='/'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])/ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])/ $row['variable'];
                }else{
                       if($row['lado']!="Vertical"){
                $al = ($_GET['ancho']+$row["descuento"])/ $row['variable'];
            }else{
                $al = ($_GET['alto']+$row["descuento"])/ $row['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al55 = ($_GET['alto']);
            }else{
                $al55 = ($_GET['ancho']);
            }
            $n=1000;
            if($tipo=='Fachada'){
            if($row["lado"]=='Vertical'){
                if($_GET["d1"]== '1'){ 
                $d =$_GET['ancho']/($_GET['v']+1);
                $al5 = ($_GET['v']);
                }else{
                    $d=$_GET['v']+1; 
                $al5 = $_GET['ancho']/($_GET['v']+1);
                } $z = $d;
            }else{
                if($_GET["d1"]== '1'){
                    $d =$_GET['alto']/($_GET['h']+1);
                    $al5 = ($_GET['h']); 
                }else{
                $d=$_GET['h']+1; 
                $al5 = $_GET['alto']/($_GET['h']+1);
                }$z = $d;
            }
            }else{
                 if($row['lado']=="Vertical"){
                $al5 = ($_GET['alto']);
            }else{
                $al5 = ($_GET['ancho']);
            }
                $z = 0;}
            $mp = $row["costo_mt"]/$porca;
            $mpfom = $row["costo_fom"]/$porca;
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($tipo=='Fachada'){
               $r = number_format($al5,0);
               $t ='<td class="hidden-phone">'.$r.'</td>';
               $cantidad= ceil($z+1);
               $d = ($cantidad*$row["cantidad"])*$_GET['cant'];
               $m = $row["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantidad= ceil($z+$row["cantidad"]);
               $d = ($cantidad)*$_GET['cant'];
           }
           $numero = (($d)*$al)/$row["medida"]; 
           $ta = $ta + ($al*$mp*(($d))/$n);
           $tafom = $tafom + ($al*$mpfom*(($d))/$n);
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
           
           $pst = (($row['peso'] * $al) / $row["medida"])*$row["cantidad"]*$_GET['cant'];
           $ptt = $ptt + $pst;
           $dec = intval(7100 / $al);
           $lon = $al * $dec + 100;
           $can_seg = intval($lon / $al);
           $cp = ($d) / $can_seg;
            $table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
            <td width="5%">'.$row['codigo'].'</a></td>
            <td width="40%">'.$row['descripcion'].'</font></td>
            <td width="10%">'.$row['lado'].'</a></td>
            '.$t.'
           
            <td style="text-align:center;width:5%">'.$m.' '.$cantidad.'</a></td>
            <td width="10%">'.number_format($al).' mm<font></a></td>
            <td class="hidden-phone">'.number_format($pst,1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.$d.'</font></td>'
                    . ' <td class="hidden-phone">'. number_format($lon,0,',','.').'</font></td>'
                    . ' <td class="hidden-phone">'. ceil($cp).'</font></td></tr>';   
	} 
	$table = $table.'</table>';
        
} 
if($ta!=0){
	echo $table;
        
   
 ?>
                                </div>
                            </section>
                        </div>

            <?php 
            }  else {
            $tau = 0;$taufom = 0;$ta_p = 0;$ta_pfom =0;$tafom =0;$ptt=0;$ta =0;
        }
            $fp = $tafom/$_GET['cant'];
            //desglose de aluminios
            ?>
                        <section class="body">
                            <div class="body-inner no-padding">
                                
                            
<?php
$requestX=mysql_query("SELECT * FROM desgloses a, referencias b where a.id_referencia=b.id_referencia and a.id_producto=".$_GET['ref']." ");
   
 
if($requestX){
//    echo'<hr>';
       $table = '<p><center> DESGLOSE DE ALUMINIOS </center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';

             $table = $table.'<thead >';
            $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Segmentos'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant Totales'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.'</th>';

              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;
	while($row=mysql_fetch_array($requestX))
	{    
            if($row['lado']=='Horizontal'){
                if($row['medida_des']==3){$med = $anchura;}
                if($row['medida_des']==4){$med = $anchura_v_c;}
                if($row['medida_des']==6){$med = $_GET['ancho'];}
            
            }else{
                if($row['medida_des']==1){$med = $altura;}
                if($row['medida_des']==2){$med = $altura_v_c;}
                if($row['medida_des']==5){$med = $_GET['alto'];}
            }
             $dec = intval(7100 / $med);
           $lon = $med * $dec + 100;
           $can_seg = intval($lon / $med);
           $cp = ($row["cantidad"]*$_GET['cant']) / $can_seg;
            $table = $table.'<tr>'
                    . '<td width="10%">'.$row['codigo'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</td>'
                    . '<td width="10%">'.$row['referencia'].'</td>'
                    . '<td width="10%">'.$row['dado'].'</td>'
                    . '<td width="10%">'.$row['lado'].'</td>'
                    . '<td width="10%">'.$med.' mm</td>'
                    . '<td width="10%" style="text-align:center">'.$row["cantidad"].'</td>'
                    . '<td width="10%" style="text-align:center">'.ceil($cp).'</td>'
                    . '<td width="10%">'.($lon).'</td>'
//                    . '<td><a href="javascript:void(0)" onclick="up_desglose('.$row["id_desglose"].','.$_GET['cod'].');"><button>Editar</button></a></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
        
      $request_rej=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
                          
     
if($request_rej){
       $table =  '<p><center> DETALLES DE LA REJILLAS</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="7%">'.'Referencia'.'</th>'; 
              $table = $table.'<th width="7%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Peso (Kg)'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Rejillas Und'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Rejillas Total'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Perfiles'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.'</th>';
      
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $xx=0; $xxfom=0; 
        $peso_rej=0;
	while($row=mysql_fetch_array($request_rej))
	{     
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["id_referencia_med"]."");
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

       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$col["ancho_v"]."");
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
            $cy = $tv2*$_GET['cant'];
            $peso_rej = $peso_rej + $pst_rej;
           $dec = intval(7100 / $medrej);
           $lonrej = $medrej * $dec + 100;
           $can_seg = intval($lonrej / $medrej);
           $cpr = ($cy) / $can_seg;
            $table = $table.'<tr><td width="7%">'.$row['codigo'].'</a></td><td width="7%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>
                   <td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2*$_GET['cant'],1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.ceil($cpr).'</font></td>'
                  . '<td class="hidden-phone">'.number_format($lonrej,0,',','.').'</font></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
       
}
echo $table;  
            ?>
                            </div></section>
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
                               


                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>

        <?php } }
   require '../vistas/script.php';  ?>
</body>
</html>