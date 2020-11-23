<?php
 require '../modelo/conexion.php';
 if(isset($_GET['ref'])){
 $sql='select * from producto where id_p="'.$_GET['ref'].'"';
 $fil =mysqli_fetch_array(mysqli_query($conexion,$sql));
        $id_p= $fil["id_p"];
        $producto= $fil["producto"];
        $tipoc= $fil["linea"];
        $codigo= $fil["codigo"];
        $tipoc_v= $fil["tipo_vidrio"];
        $color_a= $fil["color_alu"];
        $ancho= $_GET['ancho'];$aa= $_GET['aa'];
        $alto= $_GET['alto'];
        $altura= $_GET['cuerpo'];
        $altura_ventana = $_GET['alto']-$_GET['cuerpo'];
        if($_GET['l']=='Derecho'){
            $ruta= $fil["ruta"];
        }else{
            $ruta= $fil["ruta2"];
        }
        
        
         $sql2='select * from tipo_vidrio where id_vidrio="'.$_GET['id_v'].'"';
         $fil2 =mysqli_fetch_array(mysqli_query($conexion,$sql2));
         $costo_v= $fil2["costo_v"];
         
         $total_pr = ((($_GET['ancho']/1000) + ($_GET['alto']/1000)) * $costo_v)*$_GET['canti'];
 }

 ?>
<?php if(isset($_GET['ref'])){ ?>          
<div class="row-fluid">
     
                    </div> 
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
  <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['ref'])){echo '../modelo/producto.php?editar='.$_GET['cod'].'';}else{echo '../modelo/producto.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=gb18030"><h4 class="title"><?php if(isset($_GET['ref'])){echo 'Producto Cotizado';}else{echo 'Crear Producto';} ?></h4>
                                </header>
                            <section class="body">
                                <div class="body-inner">

                                        <center>   <table class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <td rowspan="5"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                
                                               
                                                <div class="fileupload-new thumbnail" style="width: 300px; height: 200px;"><img src="<?php if(isset($_GET['ref'])){
                                                    if($ruta==''){echo '../producto/no.jpg';}else{echo '../producto/'.$ruta;}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                               
                                             
                                                 
                                             </div></td>
                                                    <td>Linea del Producto</td>
                                                    <td width="30%">
                                                    <?php if(isset($_GET['ref'])){echo $tipoc;} ?>
                                                  <td>Ancho Cotizado (mm)</td>
                                                    <td width="10%"><?php if(isset($_GET['ref'])){echo $_GET['ancho'];}?>
                                                    <?php if($_GET['aa']!=0){
                                                        echo $_GET['aa'];
                                                    } ?>
                                                    </td>
                                                   
                                     </td>
                                                </tr>
                                                <tr>
                                                     <td>Codigo del Producto</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $codigo;} ?></td>
                                                   
                                                    <td>Alto Cotizado (mm)</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['alto'];} ?></td>
                                                </tr>
                                                <tr>
                                                     <td>Nombre del Producto</td>
                                                     <td><?php if(isset($_GET['ref'])){echo $producto;} ?></td>
                                                   
                                                    <td>Cantidad cotizada (Und)</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['canti'];} ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Color y Espesor del Vidrio</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['vidrio'].'';} ?></td>
                                                    <td>Altura Cuerpo Fijo ó rejilla</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $altura;} ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Porcentaje Materia Prima</td>
                                                    <td><?php if(isset($_GET['ref'])){echo $_GET['por'];} ?></td>
                                                    <td>Altura de Ventana Corrediza</td>
                                                    <td><?php if(isset($_GET['ref'])){$altura_v_c =$_GET['alto']- $altura; echo $altura_v_c;} ?></td>
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

$alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
                $porca= $fia["p"]/100;
                
                $alum_porBOG = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Perfileria'";
                $fiaB =mysqli_fetch_array(mysqli_query($conexion,$alum_porBOG));
                $porcaB= $fiaB["p"]/100;
                
                
 $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Cod. Comercial'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'Longitud del Perfil'.'</th>';
              if($tipoc=='Fachada'){$table = $table.'<th  class="hidden-phone">'.'Distancia'.'</th>';}
              $table = $table.'<th class="hidden-phone">'.'Cant. perfiles'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'cant. und.'.'</th>';
               $table = $table.'<th width="20%">'.'Medida.'.'</th>';
               $table = $table.'<th width="10%">'.'Peso T(Kg).'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista. Items'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista. Items Total'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Items+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Lista Items Total+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Items.FOM'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Items Total.FOM'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Items.FOM+P'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Costo Real Items Total.FOM+P'.'</th>';
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
           
            if($tipoc=='Fachada'){
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
            $mpfom = $row["costo_fom"]/$porcaB;
        
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($tipoc=='Fachada'){
               $r = number_format($al5,0);
               $t ='<td class="hidden-phone">'.$r.'</td>';
               $cantidad= ceil($z+1);
               $d = ($cantidad*$row["cantidad"])*$_GET['canti'];
               $m = $row["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantidad= ceil($z+$row["cantidad"]);
               $d = ($cantidad)*$_GET['canti'];
           }
           $numero = (($d)*$al)/$row["medida"]; 
           $ta = $ta + ($al*$mp*(($d))/$n);
           $tafom = $tafom + ($al*$mpfom*(($d))/$n);
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
           
           $pst = (($row['peso'] * $al) / $row["medida"])*$row["cantidad"]*$_GET['canti'];
           $ptt = $ptt + $pst;
$table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>
<td width="10%">'.$row['codigo'].'</a></td>
<td width="10%">'.$row['descripcion'].'</font></td>
<td width="10%">'.$row['lado'].'</a></td>
<td width="10%">'.$row["medida"].' mm<font></a></td>'.$t.'
<td class="hidden-phone">'.  number_format($numero,1,',','.').'</font></td>
<td width="10%">'.$m.' '.$cantidad.'</a></td>
<td width="20%">'.number_format($al).' mm<font></a></td>
<td class="hidden-phone">'.number_format($pst,1,',','.').'</font></td><td class="hidden-phone">'.$d.'</font></td>
<td class="hidden-phone">$'.number_format(($al*$mp*($d)/$n)/$_GET['canti']*$porca).'</font></td>
<td class="hidden-phone">$'.number_format(($al*$mp*($d)/$n)/$_GET['canti']*$porca*$_GET['cant']).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format(($al*$mp*($d)/$n)/$_GET['canti']).'</font></td>
<td class="hidden-phone"><font color="red">$'.number_format(($al*$mp*(($d))/$n)).'</font></td>
<td class="hidden-phone"><font color="blue">$'.number_format(($al*$mpfom*($d)/$n)/$_GET['canti']*$porcaB).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($al*$mpfom*($d)/$n)/$_GET['cant']*$porcaB*$_GET['canti']).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format(($al*$mpfom*($d)/$n)/$_GET['canti']).'</font></td>
<td class="hidden-phone"><font color="blue">$'.number_format(($al*$mpfom*(($d))/$n)).'</font></td>'
. '</tr>';   
	} 
	$table = $table.'</table>';
        
	echo $table;
     
} 
   
 ?>
                                </div>
                            </section>
                        </div>
                        <table  class="table table-bordered table-striped table-hover">
<tr>
<td><?php echo 'Costo Lista Unidad es: $'.number_format($tap = ($ta/$_GET['canti']) * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Lista Unidad + P: $<font color="red">'.number_format( $tau = $ta/$_GET['canti']).'</font>';  ?></td>
<td><?php echo 'Costo Real Unidad FOM: $<font color="blue">'.number_format($tapfom = ($tafom/$_GET['canti']) * $porcaB).'</font>';  ?></td>
<td><?php echo 'Costo Real Unidad FOM+ P: $<font color="blue">'.number_format( $taufom = $tafom/$_GET['canti']).'</font>';  ?></td>
<td></td>
  
<tr>
<td><?php echo 'El Costo Lista Total es: $'.number_format($ta_p = $ta * $porca).'</font>';  ?></td>
<td><?php echo 'Costo Lista Total + P: $<font color="red">'.number_format($ta).'</font>';  ?></td>
<td><?php echo 'Costo Real Total es FOM: $<font color="blue">'.number_format($ta_pfom = $tafom * $porcaB).'</font>';  ?></td>
<td><?php echo 'Costo Real. Total FOM+P: $<font color="blue">'.number_format($tafom).'</font>';  ?></td>
<td><?php echo 'El Peso total de los perfiles son:'.number_format($ptt,1,',','.').'Kgs';  ?></td>                  
                      </table>
            <?php  
            $perf_sin_p = $tap;
            $perf_con_p = $tau;
            $perf_fom_sin_p = $tapfom;
            $perf_fom_con_p = $taufom;
            
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
$vidrio_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
                
                $vidrio_porB = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Vidrios'";
                $fipB =mysqli_fetch_array(mysqli_query($conexion,$vidrio_porB));
                $porcvB= $fipB["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET['id_v']."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_v){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
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

            $m2 = ($an2/1000)*($all/1000);

              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $_GET['canti'];
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
                   include '../calculos/suma_vidrios_ven.php';
                  }
                  if(2==$row['pertenece']){
                   include '../calculos/suma_vidrios_ven_1.php';
                  }
                  if(3==$row['pertenece']){
                   include '../calculos/suma_vidrios_ven_2.php';
                  }
                  if(4==$row['pertenece']){
                   include '../calculos/suma_vidrios_ven_3.php';
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
<?php echo 'El valor total de las hojas de vidrio son: $'.number_format($total_vid/$_GET['canti']);  ?>
<?php echo '<br>El Unitario total de las hojas de vidrio son: $'.number_format($total_vid);  ?>
<?php echo '<br>El valor total de las hojas de vidrio son sin P: $'.number_format($total_vidsp/$_GET['canti']);  ?>
<?php echo '<br>El valor Unitario de las hojas de vidrio son sin P: $'.number_format($total_vidsp);  ?>
<?php echo '<br>El peso total del vidrio es: '.number_format($peso_vid,1,',','.').' Kgs';  ?>
<!--/ END Datatable 2 -->
<?php 
$vidrio_con_p = $total_vid/$_GET['canti'];
$vidrio_sin_p = $total_vidsp/$_GET['canti'];
?>
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

$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
                          
     
if($request_rej){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
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
    echo $col["ancho_v"];
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
         $prejfom = $row["costo_fom"] / $porcaB; 
          
         
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
            $xx = $xx + (($medrej*$tv2*$prej)*$_GET['canti']/1000);
            $xxfom = $xxfom + (($medrej*$tv2*$prejfom)*$_GET['canti']/1000);
            
            $pst_rej = (($row['peso'] * $medrej) / $row["medida"])*$tv2*$_GET['canti'];
            $peso_rej = $peso_rej + $pst_rej;
          
            $table = $table.'<tr><td width="7%">'.$row['codigo'].'</a></td><td width="7%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].'</font></td>
               <td class="hidden-phone">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>
                   <td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2*$_GET['canti'],1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($numero,1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]/1000).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($medrej*$tv2*$row["costo_mt"]*$_GET['canti']/1000).'</font></td>'
                      . '<td class="hidden-phone"><font color="red">'.number_format($medrej*$tv2*$prej/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($medrej*$tv2*$prej*$_GET['canti']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$row["costo_fom"]/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$row["costo_fom"]*$_GET['canti']/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$prejfom/1000).'</font></td>'
                    . '<td class="hidden-phone"><font color="blue">'.number_format($medrej*$tv2*$prejfom*$_GET['canti']/1000).'</font></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
}

 ?></div>
                            </section>
                        </div>
<?php 
//echo 'rejilla : '.$row["medida_rej"].'<br>';
//echo '$tv2'.$tv2.'<br>';
//echo 'costo'.$row["costo_mt"].'<br>';
echo '<table  class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($xx * $porca/  $_GET['canti']).'</font>';
echo '<td>Costo Lista Unidad con P: $<font color="red">'.number_format($xx / $_GET['canti']).'</font>'; 
echo '<td>Costo Real Unidad FOM: $<font color="blue">'.number_format($xxfom * $porcaB /  $_GET['canti']).'</font>';
echo '<td>Costo Real Unidad FOM+ P: $<font color="blue">'.number_format($xxfom / $_GET['canti']).'</font>'; 
echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($xx_p = $xx * $porca).'</font>'; 
echo '<td>Costo Lista Total con P: $<font color="red">'.number_format($xx).'</font>';
echo '<td>Costo Real Total FOM: $<font color="blue">'.number_format($xx_pfom = $xxfom * $porcaB).'</font>'; 
echo '<td>Costo Real Total FOM+ P: $<font color="blue">'.number_format($xxfom).'</font>';

echo '<td>El peso de la rejilas son:'.number_format($peso_rej,1,',','.').' Kg';
echo '</table>';
$fr = $xxfom / $_GET['canti'];
$rejilla_sin_p = $xx * $porca/ $_GET['canti'];
$rejilla_con_p = $xx / $_GET['canti'];
$rejilla_fom_sin_p = $xxfom * $porcaB / $_GET['canti'];
$rejilla_fom_con_p = $xxfom / $_GET['canti'];

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
  $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
                
                  $acc_porB = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fipaB =mysqli_fetch_array(mysqli_query($conexion,$acc_porB));
                $porcaccB= $fipaB["p"]/100; 
                
$request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']." order by b.para ");
    
     
if($request_acE){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
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
              $table = $table.'<th class="hidden-phone">'.'$ Fabr..'.'</th>';
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
   
            if($tipoc=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$alto) / $row["metro"])+$row["cantidad_acc"]);
                     }else{
                         $res = ((($row["cantidad_acc"]*$ancho) / $row["metro"])+$row["cantidad_acc"]);
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_GET['hojas'] * 2 * $row["cantidad_acc"];
               $res = (($ancho / 1000) * 2) + (($alto/1000)*$rs);
            }ELSE{
                if($row['calcular']=='M2'){
                      $res = (($ancho / 1000)) * (($alto/1000))* $row["cantidad_acc"];
                }else{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$alto) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_GET['canti'])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_GET["cant"]).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            if($rf5['pelicula']!='No Aplica' && $row['codigo']=='26002'){ 
            if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; }          
            $tac = $tac + (($taa * $v) *($row["costo_mt"]/$porcacc)*$m*$_GET['canti'] + $a);   
            $tacfom = $tacfom + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_GET['canti'] + $a);
             $taa = $taa * $v;
            }
            if($row['codigo']!='26002'){ 
            $tac = $tac + ($taa * ($row["costo_mt"]/$porcacc) * $m * $_GET['canti'] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_GET['canti'] + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
if($rf5['pelicula']!='No Aplica' && $row['codigo']=='26002'){      
$table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
<td width="5%">'.$row['codigo'].'</a></td>
<td width="20%">'.$row['descripcion'].'</font></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.$taa.' '.$row["calcular"].'</font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.$f.'</font></td><td class="hidden-phone">'.$ft.'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m + $a).'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m*$_GET['canti'] + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['canti'] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m*$_GET['canti'] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m*$_GET['canti'] + $a).'</font></td>'
. '</tr>';   
      }     
	if($row['codigo']!='26002'){      
$table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
<td width="5%">'.$row['codigo'].'</a></td>
<td width="20%">'.$row['descripcion'].'</font></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.$taa.' '.$row["calcular"].'</font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.$f.'</font></td><td class="hidden-phone">'.$ft.'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m + $a).'</font></td>
<td class="hidden-phone">$'.number_format($taa*($row["costo_mt"])*$m*$_GET['canti'] + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m*$_GET['canti'] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"])*$m*$_GET['canti'] + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="blue">'.number_format($taa*($row["costo_fom"]/$porcacc)*$m*$_GET['canti'] + $a).'</font></td>'
. '</tr>';   
      } 	
               
	} 
	$table = $table.'</table>';
        
	echo $table;

echo '<table   class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($tac * $porcacc / $_GET['canti']).'</font></td>';
echo '<td>Costo Lista Unidad + P: $<font color="red">'.number_format($tac / $_GET['canti']).'</font></td>'; 
echo '<td>Costo Real Unidad FOM: $<font color="blue">'.number_format($tacfom * $porcaccB / $_GET['canti']).'</font></td>'; 
echo '<td>Costo Real Unidad FOM + P: $<font color="blue">'.number_format($tacfom  / $_GET['canti']).'</font></td>'; 
echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,1,',','.').' Kgs</td>'; 
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($tac_p = $tac * $porcacc).'</font></td>'; 
echo '<td>Costo Lista Total + P: $<font color="red">'.number_format($tac).'</font></td>'; 
echo '<td>Costo Real Total FOM : $<font color="blue">'.number_format($tac_pfom = $tacfom * $porcaccB).'</font></td>'; 
echo '<td>Costo Real Total FOM + P: $<font color="blue">'.number_format($tacfom).'</font></td>'; 

echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,1,',','.').' Kgs</td>'; 
echo '</table>';
$acce_sin_p = $tac * $porcacc / $_GET['canti'];
$acce_con_p = $tac / $_GET['canti'];
$acce_fom_sin_p = $tacfom  * $porcaccB  / $_GET['canti'];
$acce_fom_con_p = $tacfom  / $_GET['canti'];
}
 ?>
                            </section>
                        </div>
                        
<?php 
//echo $perf_sin_p.'+'.  $vidrio_sin_p .'+'. $rejilla_sin_p .'+'. $acce_sin_p;
 $total_sin_p = $perf_sin_p + $vidrio_sin_p + $rejilla_sin_p + $acce_sin_p;
 $total_con_p = $perf_con_p + $vidrio_con_p + $rejilla_con_p + $acce_con_p;
 $total_fom_sin_p = $perf_fom_sin_p + $vidrio_sin_p + $rejilla_fom_sin_p + $acce_fom_sin_p;
 $total_fom_con_p = $perf_fom_con_p + $vidrio_con_p + $rejilla_fom_con_p + $acce_fom_con_p;

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
   
$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where  b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
  
     
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
                $r = ($total_sin_p *$row["porcentaje_ma"])/100;
                $r_p = ($total_con_p *$row["porcentaje_ma"])/100;
                $rfom = ($total_fom_sin_p *$row["porcentaje_ma"])/100;
                $r_pfom = ($total_fom_con_p *$row["porcentaje_ma"])/100;
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
echo '<tr><td>El valor total de maquinaria sin P es: $<font color="red">'.number_format($tot2).'</font>'; 
echo '<td>El valor total de maquinaria sin P es: $<font color="blue">'.number_format($tot2fom).'</font>';
echo '<tr><td>El valor total de maquinaria con P es: $<font color="red">'.number_format($tot2_p).'</font>'; 
echo '<td>El valor total de maquinaria con P es: $<font color="blue">'.number_format($tot2_pfom).'</font>'; 

 
echo '</table>';
$maquina_sin_p = $tot2;
$maquina_con_p = $tot2_p;
$maquina_fom_sin_p = $tot2fom;
$maquina_fom_con_p = $tot2_pfom;

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
   
$request_maq=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_maq){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
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
        $tot=0;$tot_fom=0;
	while($row=mysqli_fetch_array($request_maq))
	{       
              $mt2 = ($_GET['alto']/1000)*($_GET['ancho']/1000);
            $mtl = ($_GET['ancho']/1000);
            if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
            if($_GET["ins"]=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET['canti']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_GET['canti']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET['canti']*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET['canti']*$row["valor_mo"]);
                }
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($_GET['canti']*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($_GET['canti']*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($_GET['canti']*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($_GET['canti']*$row["valor_mo"]);
                    
                }  
                if($row['referencia']!='26002'){ 
                $tot_fom = $tot_fom + $tarf;
                }
                if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){
                    if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                  $tot_fom = $tot_fom + ($tarf * $v); 
                  $tarf = $tarf * $v;
                }
                }
                if($row['referencia']!='26002'){ 
                $tot = $tot + $tar;
                }
                if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){ 
                             if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                     $tar = $tar * $v;
                }
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_GET['canti']*$row["valor_mo"]);
                    $tarf =  $tar;
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mt2*($_GET['canti']*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_GET['canti']*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_GET['canti']*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['referencia']!='26002'){ 
                $tot = $tot + $tar;
                $tot_fom = $tot_fom + $tarf;
                }
                if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){ 
                    if($rf5['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                    $tot_fom = $tot_fom + ($tarf* $v);
                    $tarf = $tarf* $v;
                    $tar = $tar * $v;
                }
                }else{
                    $tar = 0;
                }
            }
              if($row['referencia']!='26002'){ 
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
                    . '<td width="10%">'.$_GET['canti'].'<font></a></td>'
                    . '<td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td width="10%">$ '.number_format($tar).'<font></a></td></tr>'; 
              }
                   if($rf5['pelicula']!='No Aplica' && $row['referencia']=='26002'){  
                          $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
                    . '<td width="10%">'.$_GET['canti'].'<font></a></td>'
                    . '<td width="10%">$ '.number_format($tar).'<font></a></td>
               <td width="10%">$ '.number_format($tar).'<font></a></td></tr>';   
                   }
               
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
echo '<tr><td>Total x Unidad en mano de obra : $'.number_format($tot / $_GET['canti']);
echo '<td>Total x Und en mano de obra para Bogota : $'.number_format($tot_fom/ $_GET['canti']);
echo '<tr><td>Total en mano de obra : $'.number_format($tot);
echo '<td>Total en mano de obra para Bogota : $'.number_format($tot_fom);
echo '</table>';

$mano = $tot / $_GET['canti'];
$mano_fom = $tot_fom / $_GET['canti'];
//echo $total_sin_p .'+'. $maquina_sin_p .'+'. $mano;
 $sub_total_sin_p_comp = $total_sin_p + $maquina_sin_p + $mano;
 $sub_total_con_p_comp = $total_con_p + $maquina_con_p + $mano;
 $sub_total_fom_sin_p_comp = $total_fom_sin_p + $maquina_fom_sin_p + $mano;
 $sub_total_fom_con_p_comp =  $total_fom_con_p + $maquina_fom_con_p + $mano_fom;



?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
              
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>&nbsp;
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
   
$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
    
     
if($request_ad){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'referencia'.'</th>';             
              $table = $table.'<th width="20%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
               $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
               $table = $table.'<th width="10%">'.'Valor Und FOM.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total Fom.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tota=0;$tota_p=0;
        $totafom=0;$tota_pfom=0;
	while($row=mysqli_fetch_array($request_ad))
	{       
            $por = 100;
             if($row['referencia_ad']!='ADM-007'){
                  $totafom = $totafom + (($sub_total_fom_sin_p_comp * $_GET['canti']) *$row["porcentaje_ad"]/$por);
                  $tota_pfom = $tota_pfom + (($sub_total_fom_con_p_comp * $_GET['canti']) *$row["porcentaje_ad"]/$por);
             }
            $tota = $tota + (($sub_total_sin_p_comp * $_GET['canti']) *$row["porcentaje_ad"]/$por);
            $tota_p = $tota_p + (($sub_total_con_p_comp * $_GET['canti']) *$row["porcentaje_ad"]/$por);
           
            $table = $table.'<tr><td width="10%">'.$row['referencia_ad'].'</a></td>'
                    . '<td width="20%">'.$row['descripcion_ad'].'</font></td>'
                    . '<td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
               <td width="10%">$ <font color="red">'.number_format(($sub_total_sin_p_comp)*$row["porcentaje_ad"]/$por).' </font></a></td>'
                    . '<td width="10%">$ <font color="red">'.number_format(($sub_total_sin_p_comp * $_GET['canti'])*$row["porcentaje_ad"]/$por).'</font></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format(($sub_total_fom_sin_p_comp)*$row["porcentaje_ad"]/$por).' </font></a></td>'
                    . '<td width="10%">$ <font color="blue">'.number_format(($sub_total_fom_sin_p_comp * $_GET['canti'])*$row["porcentaje_ad"]/$por).'</font></td></tr>';
           
		
               
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
<td><?php echo 'Total x UND sin P son : $<font color="red">'.number_format($tota/$_GET['canti']).'</font>'; ?>
<td><?php echo 'Total sin P son : $<font color="red">'.number_format($tota).'</font>'; ?>
<td><?php echo 'Total FOM x UND sin P son : $<font color="blue">'.number_format($totafom/$_GET['canti']).'</font>'; ?>
<td><?php echo 'Total FOM sin P son : $<font color="blue">'.number_format($totafom).'</font>'; ?>
<tr>
    <td><?php echo 'Total x UND con P son : $<font color="red">'.number_format($tota_p/$_GET['canti']).'</font>'; ?>
<td><?php echo 'Total con P son : $<font color="red">'.number_format($tota_p).'</font>'; ?>
<td><?php echo 'Total FOM x UND con P son : $<font color="blue">'.number_format($tota_pfom/$_GET['canti']).'</font>'; ?>
<td><?php echo 'Total FOM con P son : $<font color="blue">'.number_format($tota_pfom).'</font>'; ?>

</table>
                                         <?php
                                         $admin_sin_p_comp = $tota/$_GET['canti']; 
                                         $admin_con_p_comp = $tota_p/$_GET['canti'];
                                         $admin_fom_sin_p = $totafom/$_GET['canti'];
                                         $admin_fom_con_p = $tota_pfom/$_GET['canti'];
                                         ?>
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
                                <h4 class="title">Costo Detallado del compuesto</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">

       <?php 

$cotid = "SELECT * FROM cotizaciones where id_cotizacion='".$_GET['de']."'";
$fid =mysqli_fetch_array(mysqli_query($conexion,$cotid));
 $d1= $fid["desc"]/100;
$d2= $fid["descuento_g"]/100;

if(isset($totalv)){$mas =$totalv;$mas2 =$totalvsp;}else{$mas =0;$mas2 =0;}
//echo $sub_total_sin_p_comp.'   --   '.$admin_sin_p_comp;
$gran_total_sin_p_comp = $sub_total_sin_p_comp + $admin_sin_p_comp;
$gran_total_con_p_comp = $sub_total_con_p_comp + $admin_con_p_comp;
$gran_total_fom_sin_p_comp = $sub_total_fom_sin_p_comp + $admin_fom_sin_p;
$gran_total_fom_con_p_comp = $sub_total_fom_con_p_comp + $admin_fom_con_p;



$alum_por1 = "SELECT * FROM porcentajes where area_por='".$tipoc."'";
$fia1 =mysqli_fetch_array(mysqli_query($conexion,$alum_por1));
$porcentaje_comp = $fia1["p1"]/100;

$PB = $tipoc.' Bogota';
$alum_por1B = "SELECT * FROM porcentajes where area_por='".$PB."'";
$fia1B =mysqli_fetch_array(mysqli_query($conexion,$alum_por1B));
$porcentaje_comp_fom = $fia1B["p1"]/100;

$precio_venta_sin_p_comp = $gran_total_sin_p_comp / $porcentaje_comp;
$precio_venta_con_p_comp = $gran_total_con_p_comp / $porcentaje_comp;
$precio_venta_fom_sin_p_comp = $gran_total_fom_sin_p_comp / $porcentaje_comp;
$precio_venta_fom_con_p_comp = $gran_total_fom_con_p_comp / $porcentaje_comp_fom;
$rt = ($precio_venta_con_p_comp * $d1);

$kg = $ptt + $peso_vid + $peso_rej + $peso_acc;

echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr>';
echo "<td><h5>Costo Lista Und del Producto: $<font color='red'>".number_format($gran_total_sin_p_comp).'<h5>';
echo "<td><h5>Costo Lista Und del Producto + P: $<font color='red'>".number_format($gran_total_con_p_comp).'<h5>';
echo "<td><h5>Costo Real Und del Producto FOM : $<font color='blue'>".number_format($gran_total_fom_sin_p_comp).'<h5>';
echo "<td><h5>Costo Real Und del Producto FOM + P: $<font color='blue'>".number_format($gran_total_fom_con_p_comp).'<h5>';
echo '<tr>';
echo "<td><h5>Precio de venta Und: $<font color='red'>".number_format($precio_venta_con_p_comp).'<h5>';
echo "<td><h5>Incremento/Descuento x Und. ".$fid["desc"]."% $<font color='red'>".number_format($rt).'<h5>';
echo "<td>";
echo "<td>";
echo '<tr>';
echo "<td><h5>Precio de venta Total: $<font color='red'>".number_format($precio_venta_con_p_comp*$_GET['canti']).'<h5>';
echo "<td>";
echo "<td>";
echo "<td>";
echo '</table>';  
} ?> 
                            </section>
                        </div>
                    
                    </div>
         
 </section></div>
