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
    <title>TODAS LA DT DE LA COTIZACION</title>
    
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
 $reques=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." ");
$a1=0;
        $a2 =0;
        $a3 =0;$a4 =0;$a5 =0;$a6 =0;$a7 =0;$a8 =0;$a9 =0;
	while($row=mysqli_fetch_array($reques))
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
 $sql='select * from producto where id_p="'.$_GET['ref'].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
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
         $fil2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET['ancho']/1000) + ($_GET['alto']/1000)) * $costo_v)*$_GET['cant'];
 }
$ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET['ref']."  ");
$cm = mysqli_fetch_array($ac);
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
                $fia =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
                $porca= $fia["p"]/100;
 $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
   
     
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
              $table = $table.'<th class="hidden-phone">'.'Cant. perfiles'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'cant. und.'.'</th>';
               $table = $table.'<th width="10%">'.'Medida.'.'</th>';
               $table = $table.'<th width="10%">'.'Peso T(Kg).'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista. Und'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista. Total'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Total+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Und.FOM'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Total.FOM'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Und.FOM+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Total.FOM+P'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $ta =0;$ptt =0;$tafom =0;
	while($row=mysqli_fetch_array($request))
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
$table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
<td width="5%">'.$row['codigo'].'</a></td>
<td width="40%">'.$row['descripcion'].'</font></td>
<td width="10%">'.$row['lado'].'</a></td>
'.$t.'
<td class="hidden-phone">'.  number_format($numero,1,',','.').'</font></td>
<td width="10%">'.$m.' '.$cantidad.'</a></td>
<td width="10%">'.number_format($al).' mm<font></a></td>
<td class="hidden-phone">'.number_format($pst,1,',','.').'</font></td><td class="hidden-phone">'.$d.'</font></td>
<td class="hidden-phone">$'.number_format(($al*$mp*($d)/$n)/$_GET['cant']*$porca).'</font></td>
<td class="hidden-phone">$'.number_format(($al*$mp*($d)/$n)/$_GET['cant']*$porca*$_GET['cant']).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format(($al*$mp*($d)/$n)/$_GET['cant']).'</font></td>
<td class="hidden-phone"><font color="red">$'.number_format(($al*$mp*(($d))/$n)).'</font></td>
<td class="hidden-phone"><font color="blue">$'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']*$porca).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']*$porca*$_GET['cant']).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']).'</font></td>
<td class="hidden-phone"><font color="blue">$'.number_format(($al*$mpfom*(($d))/$n)).'</font></td>'
. '</tr>';   
	} 
	$table = $table.'</table>';
        
} 
if($ta!=0){
	echo $table;
        
   
 ?>
                                </div>
                            </section>
                        </div>
                        <table  class="table table-bordered table-striped table-hover">
<tr>
<td><?php echo 'Costo Lista Unidad es: $'.number_format($tap = ($ta/$_GET['cant']) * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Lista Unidad + P: $<font color="red">'.number_format( $tau = $ta/$_GET['cant']).'</font>';  ?></td>
<td><?php echo 'Costo Real Unidad FOM: $<font color="blue">'.number_format($tapfom = ($tafom/$_GET['cant']) * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Real Unidad FOM+ P: $<font color="blue">'.number_format( $taufom = $tafom/$_GET['cant']).'</font>';  ?></td>
<td></td>
  
<tr>
<td><?php echo 'El Costo Lista Total es: $'.number_format($ta_p = $ta * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Lista Total + P: $<font color="red">'.number_format($ta).'</font>';  ?></td>
<td><?php echo 'Costo Real Total es FOM: $<font color="blue">'.number_format($ta_pfom = $tafom * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Real. Total FOM+P: $<font color="blue">'.number_format($tafom).'</font>';  ?></td>
<td><?php echo 'El Peso total de los perfiles son:'.number_format($ptt,1,',','.').'Kgs';  ?></td>                  
                      </table>
            <?php 
            }  else {
            $tau = 0;$taufom = 0;$ta_p = 0;$ta_pfom =0;$tafom =0;$ptt=0;$ta =0;
        }
            $fp = $tafom/$_GET['cant'];
            ?>
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
                               
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            
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
$vidrio_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_v){
       $table =  '<p><center> REPARTO DE VIDRIOS </center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="10%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'M<sup>2</sup>'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Und'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Total'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo R.U'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo R.U.T'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo+P.U'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo+P.T'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $ci += 1;
             if($row["ancho_v"]==0){
                
                $alb = $aa;
                if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $ancho;
                 }
            }else{
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["ancho_v"]."");
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
                $alb = ($aa+$fil_an["descuento"])+ $fil_an['variable'];
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
                 $alb = ($aa+$fil_an["descuento"])- $fil_an['variable'];
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
                $alb = ($aa+$fil_an["descuento"])* $fil_an['variable'];
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
                $al = ($ancho + $fil_an["descuento"])/ $fil_an['variable'];
                $alb = ($aa + $fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($alto+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }}
//            if($fil_an['lado']=="Vertical"){
//                $al2 = ($alto+$fil_an["descuento"]);
//            }else{
//                $al2 = ($ancho+$fil_an["descuento"]);
//                $al2b = ($aa+$fil_an["descuento"]);
//            }
            if($row["alto_v"]==0){
                $al2= $alto;
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
//             echo '$row["ancho_v"] : '.$row["ancho_v"].'<br>';
//              echo '$row["alto_v"] : '.$row["alto_v"].'<br>';
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al['signo']=='-'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])- $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])- $fil_al['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al['signo']=='*'){
                  if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])* $fil_al['variable'];
                }else{
                    
                }
                    if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])* $fil_al['variable'];
                 $al2b = ($aa+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])* $fil_al['variable'];
            }
                }
            }else{
                if($fil_al['signo']=='/'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                       if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])/ $fil_al['variable'];
                 $al2b = ($aa+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }}
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])+ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])+ $fil_an2['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_an2['signo']=='-'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                       if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])- $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])- $fil_an2['variable'];
            }
                }
                 
                }
            }else{
                if($fil_an2['signo']=='*'){
                  if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                    
                }
                    if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])* $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])* $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])* $fil_an2['variable'];
            }
                }
            }else{
                if($fil_an2['signo']=='/'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                       if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])/ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])/ $fil_an2['variable'];
            }else{
                $al22 = ($alto+$fil_an2["descuento"])/ $fil_an2['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            }else{
               
                
                $al22 = 0;
                $al22b = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])+ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])+ $fil_al2['variable'];
            }
                }
                   
                }
                
            }else{
               if($fil_al2['signo']=='-'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                       if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])- $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])- $fil_al2['variable'];
            }
                }
                 
                }
            }else{
                if($fil_al2['signo']=='*'){
                  if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                     if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    
                }
                    if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])* $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])* $fil_al2['variable'];
            }
                }
            }else{
                if($fil_al2['signo']=='/'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                       if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])/ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])/ $fil_al2['variable'];
            }else{
                $al2x = ($alto+$fil_al2["descuento"])/ $fil_al2['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            }else{
               $al2xb = 0;
                $al2x = 0;
            }
              $tv = ($al + $row['var1']) / $row['divisor'];
             $tv2 = ($al2 + $row['var2']) / $row['divisor_alto'];
             
            
             
             $tvb = ($alb + $row['var1']) / $row['divisor'];
//             $tv2b = ($al2b + $row['var2']) / $row['divisor_alto'];
             
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
                $an2b = $tvb - $n;
            }else{
                $n = 0;
                $an2 = $tv;
                $an2b = $tvb;
            }
            if($row['cp']==1){
                $cf = $altura;
              
            }else{
                if($row['cp']==-1){
                $cf = - $altura;
              
            }else{
                $cf = 0;
              
            }
              
            }
            if($row['desc']==0){
                $dess = 0;
              
            }else{
                $dess = $alto;
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx + $cf - $dess;
            }else{
                $nx = 0;
                $all = $tv2 + $cf - $dess;
            }
//            if($fil_al['lado']=="Vertical"){
//                $al3 = ($alto+$fil_al["descuento"]);
//            }else{
//                $al3 = ($ancho+$fil_al["descuento"]);
//            }
            
          
//            echo 'altura'. $altura_v_c.' altura_ventana: '.$altura_ventana.'<br>';
            $m2 = ($an2/1000)*($all/1000);
            
           
//            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td><td width="10%">'.$row['codigo'].'</a></td><td width="10%">'.$row['descripcion'].'</font></td>
//               <td class="hidden-phone">'.number_format($an2).'</font></td>'
//                    . '<td class="hidden-phone">'.number_format($all).'</font></td>'
//                     . '<td class="hidden-phone">'.number_format($m2).'</font></td>'
//                    . '<td class="hidden-phone">'.$row["cantidad_v"].'</font></td>'
//                    . '<td class="hidden-phone">'.$row["cantidad_v"]*$_GET['cant'].'</font></td>'
//                    . '<td class="hidden-phone">$ '.number_format($m2*$costo_vidrio*$porcv).'</font></td>'
//                    . '<td class="hidden-phone">$ '.number_format($m2*$costo_vidrio*$porcv*$_GET['cant']).'</font></td>'
//                    . '<td class="hidden-phone">$ '.number_format($m2*$costo_vidrio).'</font></td>'
//                    . '<td class="hidden-phone">$ '.number_format($m2*$costo_vidrio*$_GET['cant']).'</font></td>'
//                    . '</tr>';   
              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $_GET['cant'];
		echo '<span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho: '.number_format($an2).' x Alto: '.number_format($all).',   M<sup>2</sup>: '.number_format($metross,1,',','.').' , Total M<sup>2</sup>: '.number_format($metro_t,1,',','.').'</span>';
                if($aa!=0 && $cu==0){echo '<br><span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho Abajo: '.number_format($an2b).' x Alto: '.number_format($all).'</span>';}
         $porc = $porcv;
         
         $con2= "SELECT * FROM `producto` where id_p=".$_GET['tv']." ";
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
     
         
                  if(1==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven.php';
                  }
                  if(2==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_1.php';
                  }
                  if(3==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_2.php';
                  }
                  if(4==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven_3.php';
                  }
                  
//                   echo $m2;
                   $peso_vid = $peso_vid + $pesototal;
                   $total_vid = $total_vid + $totalvxx;
                   $total_vidsp = $total_vidsp + $totalvxxsp;
                   $cu = $cu + 1;
          
	} 
//   
//	$table = $table.'</table>';
//   
//	echo $table;
                   
        
}
 ?></div>
                            </section>
</div>
                        <?php   if($total_vid!=0){    ?>
<?php echo 'El valor total de las hojas de vidrio son: $'.number_format($total_vid);  ?>
<?php echo '<br>El Unitario total de las hojas de vidrio son: $'.number_format($total_vid / $_GET['cant']);  ?>
<?php echo '<br>El valor total de las hojas de vidrio son sin P: $'.number_format($total_vidsp);  ?>
<?php echo '<br>El valor Unitario de las hojas de vidrio son sin P: $'.number_format($total_vidsp / $_GET['cant']);  ?>
<?php echo '<br>El peso total del vidrio es: '.number_format($peso_vid,1,',','.').' Kgs';  ?>
                        <?php }else{
                            $total_vid=0;$total_vidsp=0;
                        } ?>
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
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                           
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

$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
                          
     
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
      
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Und'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Total'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Lista Total+P'.'</th>';
             $table = $table.'<th class="hidden-phone">'.'Costo Real Und FOM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Real Total FOM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Real Und FOM+P'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Real Total FOM+P'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $xx=0; $xxfom=0; 
        $peso_rej=0;
	while($row=mysqli_fetch_array($request_rej))
	{     
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$row["id_referencia_med"]."");
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

       $request_vrej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$col["ancho_v"]."");
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
          
            $table = $table.'<tr><td width="7%">'.$row['codigo'].'</a></td><td width="7%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>
                   <td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2*$_GET['cant'],1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($numero,1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]/1000).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]*$_GET['cant']/1000).'</font></td>'
                      . '<td class="hidden-phone"><font color="red">'.number_format($medrej*$tv2*$prej/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($medrej*$tv2*$prej*$_GET['cant']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$row["costo_fom"]/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$row["costo_fom"]*$_GET['cant']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$prejfom/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$prejfom*$_GET['cant']/1000).'</font></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
       
}
 if($xx!=0){
	echo $table;
        
 ?></div>
                            </section>
                        </div>
<?php 
//echo 'rejilla : '.$row["medida_rej"].'<br>';
//echo '$tv2'.$tv2.'<br>';
//echo 'costo'.$row["costo_mt"].'<br>';
echo '<table  class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($xx * $porca/  $_GET['cant']).'</font>';
echo '<td>Costo Lista Unidad con P: $<font color="red">'.number_format($xx / $_GET['cant']).'</font>'; 
echo '<td>Costo Real Unidad FOM: $<font color="blue">'.number_format($xxfom * $porca /  $_GET['cant']).'</font>';
echo '<td>Costo Real Unidad FOM+ P: $<font color="blue">'.number_format($xxfom / $_GET['cant']).'</font>'; 
echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($xx_p = $xx * $porca).'</font>'; 
echo '<td>Costo Lista Total con P: $<font color="red">'.number_format($xx).'</font>';
echo '<td>Costo Real Total FOM: $<font color="blue">'.number_format($xx_pfom = $xxfom * $porca).'</font>'; 
echo '<td>Costo Real Total FOM+ P: $<font color="blue">'.number_format($xxfom).'</font>';

echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '</table>';
$fr = $xxfom / $_GET['cant'];
 }else{
     $xx = 0;$xxfom=0;$xx_p=0;$xx_pfom=0;
     $fr = 0;
 }

?>

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
<!--Fin Modulo de regillas -->

                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                          
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
  $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
$request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." order by b.para ");
    
     
if($request_acE){
 $table = '<p><center> LISTADO DE ACCESORIOS PARA FABRICACIÓN</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="5%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="20%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'color'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Lado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cantidad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
         
                 $table = $table.'<th class="hidden-phone">'.'Costo Lista Und'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Total'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Und+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Total+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Und FOM'.'</th>';
            $table = $table.'<th class="hidden-phone">'.'Costo Real Total FOM'.'</th>';
            $table = $table.'<th class="hidden-phone">'.'Costo Real Und FOM+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Total FOM+P'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tac = 0;$tacfom = 0;
        $peso_acc=0;
	while($row=mysqli_fetch_array($request_acE))
	{         
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysqli_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($conexion,$sqlxy));
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
     $cant_rej = number_format(($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
   
            if($tipo=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$alto) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }else{
                         $res = ((($row["cantidad_acc"]*$ancho) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_GET['hojas'] * 2 * $row["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$alto) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_GET["cant"])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            
            $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_GET["cant"] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcacc)*$m*$_GET["cant"] + $a);
            
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
                 
$table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
<td width="5%">'.$row['codigo'].'</a></td>
<td width="20%">'.$row['descripcion'].'</font></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.$taa.' '.$row["calcular"].'</font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.$f.'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m + $a).'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m*$_GET["cant"] + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m*$_GET["cant"] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m*$_GET["cant"] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m*$_GET["cant"] + $a).'</font></td>'
. '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
         if($tac!=0){
	echo $table;
         

echo '<table   class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($tac * $porcacc / $_GET["cant"]).'</font></td>';
echo '<td>Costo Lista Unidad + P: $<font color="red">'.number_format($tac / $_GET["cant"]).'</font></td>'; 
echo '<td>Costo Real Unidad FOM: $<font color="blue">'.number_format($tacfom * $porcacc / $_GET["cant"]).'</font></td>'; 
echo '<td>Costo Real Unidad FOM + P: $<font color="blue">'.number_format($tacfom  / $_GET["cant"]).'</font></td>'; 
echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,1,',','.').' Kgs</td>'; 
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($tac_p = $tac * $porcacc).'</font></td>'; 
echo '<td>Costo Lista Total + P: $<font color="red">'.number_format($tac).'</font></td>'; 
echo '<td>Costo Real Total FOM : $<font color="blue">'.number_format($tac_pfom = $tacfom * $porcacc).'</font></td>'; 
echo '<td>Costo Real Total FOM + P: $<font color="blue">'.number_format($tacfom).'</font></td>'; 

echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,1,',','.').' Kgs</td>'; 
echo '</table>';
$fas = $tacfom  * $porcacc  / $_GET["cant"];
$fa = $tacfom  / $_GET["cant"];
}else{
    $tac=0;$tacfom=0;$peso_acc=0;$tac_p=0;$tac_pfom=0;$fas=0;$fa = 0;
}
}
 ?>
                            </section>
                        </div>
                        
<?php 
$tac = $tac;
//echo $tafom.'<br>'.$total_vid.'<br>'.$tac_pfom.'<br>'.$xxfom;

    $txx = $total_vid + $ta + $tac + $xx;
    $txxfom = $total_vid + $tafom + $tac_pfom + $xxfom;
     $txx_p = $total_vidsp + $ta_p + $tac_p + $xx_p;
     $txx_pfom = $total_vidsp + $ta_pfom + $tac_pfom + $xx_pfom;

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
   
$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_GET['ref']);

     
if($request_mano){
 $table = '<p><center> GASTOS DE MAQUINA</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad'.'</th>';
              $table = $table.'<th width="10%">'.'Dias'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%">'.'Costo.'.'</th>';
                    $table = $table.'<th width="10%">'.'Costo Fom.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tot2=0;
        $tot2_p=0;
        $tot2fom=0;
        $tot2_pfom=0;
	while($row=mysqli_fetch_array($request_mano))
	{      
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
               <td width="10%">$ <font color="red">'.number_format($r).'  </font></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format($rfom).' </font></a></td></tr>';        
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr><td>El valor total de maquinaria sin P es: $<font color="red">'.number_format($tot2_p).'</font>'; 
echo '<td>El valor total de maquinaria sin P es: $<font color="blue">'.number_format($tot2_pfom).'</font>'; 

echo '<tr><td>El valor total de maquinaria con P es: $<font color="red">'.number_format($tot2).'</font>'; 
echo '<td>El valor total de maquinaria con P es: $<font color="blue">'.number_format($tot2fom).'</font>'; 
echo '</table>';
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
   
$request_maq=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_maq){
 $table =  '<p><center> MANO DE OBRA</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Instalacion ?'.'</th>';
              $table = $table.'<th width="10%">'.'Cobrado por'.'</th>';
                    $table = $table.'<th width="10%">'.'Cantidad.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tot=0;
	while($row=mysqli_fetch_array($request_maq))
	{       
            $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
            if($_GET["ins"]=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET["cant"]*$row["valor_mo"]);
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
                    . '<td width="10%">'.$_GET["cant"].'<font></a></td>'
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
//echo '<br>'.$txx;
$txx = $txx + $tot;
$txx_p = $txx_p + $tot;

$txxfom = $txxfom + $tot;
$txx_pfom = $txx_pfom + $tot;

?>
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
 </section>
</div>
                                 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                           
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
   
$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_ad){
   $table =  '<p><center> GASTOS ADMINISTRATIVO Y UTILIDAD</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
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
        $tota=0;$tota_p=0;
        $totafom=0;$tota_pfom=0;
	while($row=mysqli_fetch_array($request_ad))
	{       
            $por = 100;
            $tota = $tota + ($txx*$row["porcentaje_ad"]/$por);
            $tota_p = $tota_p + ($txx_p*$row["porcentaje_ad"]/$por);
            $totafom = $totafom + ($txxfom*$row["porcentaje_ad"]/$por);
            $tota_pfom = $tota_pfom + ($txx_pfom*$row["porcentaje_ad"]/$por);
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td width="10%">$ <font color="red">'.number_format($txx*$row["porcentaje_ad"]/$por).' </font></a></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format($txxfom*$row["porcentaje_ad"]/$por).'</font></td></tr>';
           
		
               
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
<tr>
    <td><?php echo 'Total de gastos administrativos y utilidades sin P son : $<font color="red">'.number_format($tota_p).'</font>'; ?>

    <td><?php echo 'Total de gastos administrativos y utilidades sin P son : $<font color="blue">'.number_format($tota_pfom).'</font>'; ?>

<tr>
    <td><?php echo 'Total de gastos administrativos y utilidades con P son : $<font color="red">'.number_format($tota).'</font>'; ?>
<td><?php echo 'Total de gastos administrativos y utilidades con P son : $<font color="blue">'.number_format($totafom).'</font>'; ?>

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
 $table = '<p><center> COMPUESTOS ADICIONALES</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
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
        if($ta25!=0){
	echo $table;
        
     echo '<div align="right"><FONT color="red"><h5> TOTAL EN COMPUESTOS: $'.number_format($ta25).'</h5></FONT></div>';
        }else{
            $ta25=0;
        }
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


<div class="row-fluid">
      <div class="span12 widget dark stacked">
                                
<?php    

$request_ack=mysqli_query($conexion,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET['idcot']."  ");
     
if($request_ack){
 $table =  '<p><center> LISTADO DE ELEMETOS ADICIONALES (Materia Prima)</center></p>';
       $table = $table.'<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="5%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';             
              $table = $table.'<th width="5%">'.'Referencia'.'</th>';
               $table = $table.'<th width="5%">'.'Lado'.'</th>';
               $table = $table.'<th width="10%">'.'Cantidad'.'</th>';
              $table = $table.'<th width="10%">'.'costo base.'.'</th>';
              $table = $table.'<th width="10%">'.'costo '.$_GET['por'].''.'</th>';
              $table = $table.'<th width="10%">'.'costo total.'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;$total2ak=0;
	while($row=mysqli_fetch_array($request_ack))
	{       $t = $t +1;
            $s3 = "SELECT (".$_GET["por"].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $mult= $fi3["p"]/100;
                if($row["calcular"]=='ML'){
                if($row["lado"]=='Vertical'){
                $mt = ($alto/1000)*($row["metro"]/1000);
                }else{
                $mt = ($ancho/1000)*($row["metro"]/1000);
                }
                }else{
                 $mt = $row["cantidad_m"];
                }
                $pp = $row["costo_mt"]/$mult;
 $total2ak= $total2ak +$mt*$pp;
            $table = $table.'<tr><td width="5%">'.$t.'</a></td><td width="5%">'.$row['num_ref'].'</a></td><td width="30%">'.$row['descripcion'].'</font></td><td width="5%">'.$row["codigo"].'<font></a></td><td width="5%">'.$row["lado"].'<font></a></td>
               <td width="10%">'.$mt.' '.$row["calcular"].'</font></td><td width="10%">$'.number_format($row["costo_mt"]).'</font></td><td width="10%">$'.number_format($pp).'</font></td><td width="10%">$'.number_format($mt*$pp).'</font></td>'
                    . '</tr>';   
          
		
               
	} 
}
	$table = $table.'</table>';
         if($total2ak!=0){
         echo $table;


echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional: $'.number_format($total2ak).'</h5></FONT></div>';
         }else{ $total2ak=0; }                   ?>
       
      </div></div>
<div class="row-fluid">
      <div class="span12 widget dark stacked">
                            
<?php    

$request4=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$_GET['idcot']." and b.comp='1'  ");

if($request4){
$header =  '<p><center> LISTADO DE KIT DE ACCESORIOS</center></p>';
       $table4 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table4 = $table4.'<thead >';
              $table4 = $table4.'<tr bgcolor="#D1EEF0">';
              $table4 = $table4.'<th width="5%">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="5%">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="40%">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Medida'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Costo'.'</th>';   
              $table4 = $table4.'<th width="10%">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Costo Total'.'</th>'; 
    
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2e=0;
        $to_kk =0;
     
                
                
	while($row21k=mysqli_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacck= $fipa["p"]/100; 
             $t2e= $t2e + 1;
             
            include '../modelo/suma_kit_1.php';
            
             $desm = ($row21k['desc_k']/100) * ($ktotk);
             $ddm = ((($ktotk) + $desm)) / $porcacck;
             $to_kk = $to_kk + $ddm;

            $table4 = $table4.'<tr><td width="5%">'.$t2e.'</a></td>'
                    . '<td width="5%">'.$row21k['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21k['producto'].'</font></td>'
                    . '<td width="10%">'.$row21k["referencia_p"].'<font></a></td>
                        <td width="10%">N/A</td>
                        <td width="10%">$'.number_format(($ktotk)/ $porcacck).'</td>'
                    . '<td width="10%">'.$row21k["desc_k"].'%</td>'
                    . '<td width="10%">'.$row21k["cantidad_k"].'</td>'
                    . '<td width="10%">'.number_format($ddm).'</td>'
                    . '</tr>';   
           
		
               
	} 
	$table4 = $table4.'</table>';
       
} 
 if($to_kk!=0){
            echo $header;
	echo $table4;
        
echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios: $'.number_format($to_kk).'</h5></FONT></div>';
 }else{
     $to_kk =0;
 }  ?>
      </div></div>
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Costo Detallado</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
 
                       
                        <!-- START Datatable 2 -->
 
<?php 
//echo 'Total de otros gastos :$'.number_format($t2); 
$t2=0;
?>
 
       <?php 
$coti = "SELECT * FROM cotizaciones where id_cotizacion='".$_GET['idcot']."'";
$fi =mysqli_fetch_array(mysqli_query($conexion,$coti));
$d1= $fi["desc"]/100;
$d2= $fi["descuento_g"]/100;


       if(isset($totalv)){$mas =$totalv;$mas2 =$totalvsp;}else{$mas =0;$mas2 =0;}
$totalx = $ta + $xx + $tac + $total_vid +  $tot2 + $tot + $tota + $t2 + $mas;
$totalx_p = $ta_p + $xx_p + $tac_p + $total_vidsp +  $tot2_p + $tot + $tota_p + $t2 + $mas2;
//echo $ta.'<br>';
//echo $xx.'<br>';
//echo $tac.'<br>';
//echo $total_vid.'<br>';
//echo $tot2.'<br>';
//echo $tot.'<br>';
//echo $tota.'<br>';
//echo $t2.'<br>';
//echo $mas.'<br>';


$totalxfom = $tafom + $xxfom + $tacfom + $total_vid +  $tot2 + $tot + $totafom + $t2;
$totalx_pfom = $ta_pfom + $xx_pfom + $tac_pfom + $total_vidsp +  $tot2_pfom + $tot + $tota_pfom + $t2;
$kg = $ptt + $peso_vid + $peso_rej + $peso_acc;

$alum_por1 = "SELECT * FROM porcentajes where area_por='".$tipo."'";
$fia1 =mysqli_fetch_array(mysqli_query($conexion,$alum_por1));
$p1s= $fia1["p1"]/100;

$total_comp = $ta25 + $total2ak + $to_kk;
$total_neto = (($totalx / $_GET['cant'])/$p1s);
$total_neto_p= (($totalx)/$p1s);
$tound_desc = (($totalx / $_GET['cant'])/$p1s)*$d1;
$tound_sin_comp = ((($totalx / $_GET['cant'])/$p1s)) + $tound_desc;
$tound = ((($totalx / $_GET['cant'])/$p1s)) + $tound_desc;
$descuento_und = ($fi["descuento_g"]/ 100) * $tound;
$gran_total_und = $tound - $descuento_und;
//compuesto
$total_neto_c = (($total_comp / $_GET['cant'])/$p1s);
$tound_desc_c = (($total_comp / $_GET['cant'])/$p1s)*$d1;
$tound_sin_comp_c = ((($total_comp / $_GET['cant'])/$p1s)) + $tound_desc_c;
$tound_c = ((($total_comp / $_GET['cant'])/$p1s)) + $tound_desc_c;
$descuento_und_c = ($fi["descuento_g"]/ 100) * $tound_c;
$gran_total_und_c = $tound_c - $descuento_und_c;
//echo 'total '.$gran_total_und_c;
//calculo de fom plus + p
$tfp = $fp + ($total_vid / $_GET['cant']) + $fr + $fa + ($tot2fom / $_GET['cant']) + ($tot/ $_GET['cant']) + ($totafom/ $_GET['cant']);
$tfps = $fp + ($total_vid / $_GET['cant']) + $fr + $fas + ($tot2fom / $_GET['cant']) + ($tot/ $_GET['cant']) + ($totafom/ $_GET['cant']);

$a1 +=$totalx_p;
$a2 +=$totalx;
$a3 +=$totalx_pfom;
$a4 +=$tfp*$_GET['cant'];
$a5 +=$tfps*$_GET['cant'];
$a6 +=$gran_total_und_c+$gran_total_und*$_GET['cant'];
$a7 +=$gran_total_und*$_GET['cant'];
$a8 +=$kg;
$a9 = $fi["descuento_g"];
echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr>';
echo "<td><h5>Costo Lista Und del Producto: $<font color='red'>".number_format($totalx_p / $_GET['cant']).'<h5>';
echo "<td><h5>Costo Lista Und del Producto + P: $<font color='red'>".number_format($totalx / $_GET['cant']).'<h5>';
echo "<td><h5>Costo Real Und del Producto FOM : $<font color='blue'>".number_format($totalx_pfom / $_GET['cant']).'<h5>';
echo "<td><h5>Costo Real Und del Producto FOM + P: $<font color='blue'>".number_format($tfp).'<h5>';
echo "<td><h5>Costo Real Und del Producto FOM + P Bogota: $<font color='blue'>".number_format($tfps).'<h5>';
echo '<tr>';
echo "<td><h5>Costo Lista Total del Producto: $<font color='red'>".number_format($totalx_p).'<h5>';
echo "<td><h5>Costo Lista Total del Producto + P : $<font color='red'>".number_format($totalx).'<h5>';
echo "<td><h5>Costo Real Total del Producto FOM : $<font color='blue'>".number_format($totalx_pfom).'<h5>';
echo "<td><h5>Costo Real Total del Producto FOM + P : $<font color='blue'>".number_format($tfp*$_GET['cant']).'<h5>';
echo "<td><h5>Costo Real Total del Producto FOM + P Bogota: $<font color='blue'>".number_format($tfps*$_GET['cant']).'<h5>';
echo '<tr>';
echo "<td><h5>Valor de Venta Unitario: $<font color='red'>".number_format($total_neto).'<h5>';
echo "<td><h5>Valor de Venta Total : $<font color='red'>".number_format($total_neto*$_GET['cant']).'<h5>';
echo "<td>";
echo "<td>";
echo "<td><h5>El Peso Total de este Producto es de:  ".number_format($kg,1,',','.').' Kgs</font><h5>';
echo '<tr>';
echo "<td><h5>Incremento/Descuento x Und. $<font color='red'>".number_format($tound_desc).'<h5>';
echo "<td><h5>Incremento/Descuento Total$<font color='red'>".number_format($tound_desc*$_GET['cant']).'<h5>';
echo "<td><h5> Incr/Desc de: ".$fi["desc"]."%";
echo "<td>";
echo "<td>";
echo '<tr>';
echo "<td><h5>Neto Total Und $<font color='red'>".number_format($tound).'<h5>';
echo "<td><h5>Neto Total $<font color='red'>".number_format($tound*$_GET['cant']).'<h5>';
echo "<td>";
echo "<td>";
echo "<td>";
echo '<tr>';
echo "<td><h5>Descuento x Und $<font color='red'>-".number_format($descuento_und).'<h5>';
echo "<td><h5>Descuento Total $<font color='red'>-".number_format($descuento_und*$_GET['cant']).'<h5>';
echo "<td><h5> Descuento de ".$fi["descuento_g"]." %";
echo "<td>";
echo "<td>";
echo '<tr>';
echo "<td><h5>Gran Total Und. $<font color='red'>".number_format($gran_total_und).'<h5>';
echo "<td><h5>Gran Total$<font color='red'>".number_format($gran_total_und*$_GET['cant']).'<h5>';
echo "<td>";
echo "<td>";
echo "<td>";
echo '<tr>';
echo "<td><h5>Valor de Venta Unitario + Comp + Kit + Materiales: $<font color='red'>".number_format($gran_total_und+$gran_total_und_c).'<h5>';
echo "<td><h5>Valor de Venta Total + Comp  + Kit + Materiales: $<font color='red'>".number_format($gran_total_und_c+$gran_total_und*$_GET['cant']) .'<h5>';
echo "<td>";
echo "<td>";
echo "<td>";
echo '</table>';  
} ?> 
                            </section>
                        </div>
                    
                    </div>
         
 </section></div>

        <?php } 
        ?>
                 <div class="control-group">
                                        <div class="alert">
                                            <button type="button" class="close" data-dismiss="alert"></button>
                                       GRAN TOTAL
                                               </div>
                                    </div>               
                               <?php
        echo '<table class="table table-bordered table-striped table-hover" id="">';

echo '<tr>';
echo "<td>Costo Lista Total del Producto: $<font color='red'>".number_format($a1).'';
echo "<td>Costo Lista Total del Producto + P : $<font color='red'>".number_format($a2).'';
echo "<td>Costo Real Total del Producto FOM : $<font color='blue'>".number_format($a3).'';
echo "<td>Costo Real Total del Producto FOM + P : $<font color='blue'>".number_format($a4).'';
echo "<td>Costo Real Total del Producto FOM + P Bogota: $<font color='blue'>".number_format($a5).'';
echo '<tr>';
echo "<td>";
echo "<td>Valor de Venta Total : $<font color='red'>".number_format($a7).'';
echo "<td>";
echo "<td>";
echo "<td>El Peso Total de este Producto es de:  ".number_format($a8,1,',','.').' Kgs</font>';
echo '<tr>';
echo "<td>";
echo "<td>Valor de Venta Total + Comp  + Kit + Materiales: $<font color='red'>".number_format($a6) .'';
echo "<td> Descuento de ".$a9." % ";
echo "<td>";
echo "<td>";
echo '</table>';  
        ?>
<?php require '../vistas/script.php';  ?>
</body>
</html>