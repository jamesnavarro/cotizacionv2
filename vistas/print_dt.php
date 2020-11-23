<html class="no-js">
<head>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Templado S.A</title>
    <style>
        .op{
            font-size: 9px;
        }
        .izq{
            font-size: 8px;
        }
        .bn{
            border: 0 px
        }
        td{
            text-align: center
        }
        .desc{
            text-align: left
        }
    </style>
</head>
<body>
<?php
 require '../modelo/conexion.php';
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
        $fechaadm= $fil["fecha_adm"];
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
$ac =mysqli_query($conexion,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$_GET["ref"]."  ");
$cm = mysqli_fetch_array($ac);
$mt = $cm['count(*)'];

$query = "select * from cotizacion a, cont_terceros b,cotizaciones c,orden_produccion d where a.id_cot = d.ref and b.id_ter = a.id_cliente and a.id_cot = c.id_cot and a.id_cot = '".$_GET['cot']."' ";
$rs = mysqli_query($conexion,$query);

$datos = mysqli_fetch_array($rs);
 ?>
<?php if(isset($_GET['ref'])){ ?>          
<center>   
    <table class="op" rules="all" border="1" width="100%" height="100px">
        <tr class="bn">
            <td width="10%" style="border:inset 0">
                <img src="../imagenes/logo2.png" width="120px" height="50px">
            </td>
            <td colspan="3" width="60%">
                <center>
                    <p><h3>DESCRIPCION TECNICA DE PRODUCTO TERMINADO</p>
                    <?php if(isset($_GET['ref'])){echo strtoupper($tipo);} ?></h3>
                </center>
            </td>
            <td class="izq desc" colspan="2" width="25%" height="10%" rowspan="2">
                    Orden Nº
                    <?php echo $datos['numero']; ?>
                <br><hr>
                    Ancho:
                    <?php if(isset($_GET['ref'])){echo $_GET['ancho'];}?>
                    <?php if($_GET['aa']!=0){ echo $_GET['aa'];} ?>
                    &nbsp;&nbsp; - &nbsp;&nbsp;
                    Alto:
                    <?php if(isset($_GET['ref'])){echo $_GET['alto'];} ?>
                <br><hr>
                    Color, Esp de Vidrio:
                    <?php if(isset($_GET['ref'])){echo $_GET['vidrio'];} ?>
                <br><hr>
                    Color del Aluminio:
                    <?php echo $datos['color_ta']; ?>
                <br><hr>
                    Cantidad:
                    <?php if(isset($_GET['ref'])){echo $_GET['cant'];} ?>
                <br><hr>
                    Empapelado:
                    <?php echo $datos['pelicula'] ?>
            </td>
        </tr>
        <tr>
            <td width="10%" class="desc">
                PT 
                <?php if(isset($_GET['ref'])){echo $codigo;} ?><br><hr></label>
                Ubicacion:
            </td>
            <td colspan="3" width="50%" class="desc">
                <label><?php if(isset($_GET['ref'])){
                    echo $producto;
                    } ?><br><hr>
                </label>
                Cliente:
                <?php echo $datos['nom_ter']; ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Obra:
                <?php echo $datos['obra']; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <center>Grafico</center>
            </td>
        </tr>
        <tr>
            <td rowspan="5" colspan="6">
                <center>
                    <img  style="width: 150px; height: 150px;" src="<?php 
                    if(isset($_GET['ref'])){
                        if($ruta==''){
                            echo '../producto/no.jpg';
                        }else{
                            echo '../producto/'.$ruta;
                        }
                    } ?>">
                </center>
            </td>
        </tr>
    </table>
</center>
                      <!-- START Widget Collapse -->
<?php    

    ?>

                                  
<?php 

$alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
                $porca= $fia["p"]/100;
 $request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET["ref"]);
   
    
if($request){
//    echo'<hr>';
 $table = '<table  class="op" id="" rules="all" border="1" width="100%">';
              $table = $table.'<thead >';
              $table = $table.'<tr>';
              $table = $table.'<td colspan="10"><center>'.'Reparto de Aluminio'.'</center></th>';
              $table = $table.'</tr>';
              $table = $table.'<tr>';
              $table = $table.'<td width="5%">'.'Cod. Comercial'.'</th>';
              $table = $table.'<td width="5%">'.'Referencia'.'</th>';
              $table = $table.'<td width="50%">'.'Descripcion'.'</th>';
              $table = $table.'<td width="5%">'.'Lado'.'</th>'; 
              $table = $table.'<td width="10%">'.'Medida a Utilizar'.'</th>';
              if($tipo=='Fachada'){$table = $table.'<td  class="hidden-phone">'.'Distancia'.'</th>';}
              $table = $table.'<td width="5%">'.'Cant. perfiles'.'</th>';
              $table = $table.'<td width="5%">'.'Medida(mm).'.'</th>';
              $table = $table.'<td width="5%">'.'Peso T(Kg).'.'</th>';
              $table = $table.'<td width="5%">'.'Cant/Und.'.'</th>';
              $table = $table.'<td width="5%">'.'Cant. Total.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
	
        
	  $ta =0;
          $ptt =0;
          $tafom =0;
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
        $table = $table.'<tr>'
        .'<td width="5%">'.$row['codigo'].'</a></td>'
        . '<td width="5%">'.$row['referencia'].'</a></td>
        <td width="50%" class="desc">'.$row['descripcion'].'</font></td>
        <td width="5%">'.$row['lado'].'</a></td>
        <td width="10%">'.$row["medida"].' mm<font></a></td>'.$t.'
        <td width="5%">'.  number_format($numero,1,',','.').'</font></td>
        <td width="5%">'.number_format($al).' mm<font></a></td>
        <td width="5%">'.number_format($pst,1,',','.').'</font></td>'
        .'<td width="5%">'.$m.' '.$cantidad.'</a></td>'
        . '<td width="5%">'.$d.'</font></td>
</tr>';   
	} 
        
	$table = $table.'</table>';
        
            echo $table;
        
} 
   
 ?>
            <?php  
            $fp = $tafom/$_GET['cant'];
            ?>
                  
                                  
<?php 
$vidrio_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
                $porcv= $fip["p"]/100;
                
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_GET["id_v"]."'";
                $fi3 =mysqli_fetch_array(mysqli_query($conexion,$s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET["ref"]);
    
     
if($request_v){ ?>
	<table rules="all" border="1" class="op" width="100%">
            <tr>
                <td colspan="7">
                    <center>
                        Reparto de Vidrios
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2" width="20%">Color y Espesor</td>
                <td  width="40%">Vidrios</td>
                <td  width="10%">Ancho</td>
                <td  width="10%">Alto</td>
                <td  width="10%">Cant. Vidrios</td>
                <td  width="10%">Cant. Total</td>
            </tr>
                          <?php  
	//Por cada resultado pintamos una linea
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0; 
        $ci = 0;
        while($row=mysqli_fetch_array($request_v)){
            ?>
            <tr>
                <td colspan="2" width="20%"><?php echo $_GET['vidrio'] ?></td>
                <td  width="40%" class="desc"><?php echo $row['descripcion'] ?></td>
                <td  width="10%"><?php echo $_GET['ancho'] ?></td>
                <td  width="10%"><?php echo $_GET['alto'] ?></td>
                <td  width="10%"><?php echo $row['cantidad_v'] ?></td>
                <td  width="10%"><?php echo $_GET['cant'] * $row['cantidad_v']  ?></td>
            </tr>
            <?php
        }
        ?>
            </table>
        <?php
}

$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET['ref']);
                          
     
if($request_rej){
    $table = '<table rules="all" border="1" width="100%" class="op"><caption></caption>';
 
        $table = $table.'<tdead >';
        $table = $table.'<tr>';
        $table = $table.'<td colspan="8"><center>'.'Reparto de Rejillas'.'</center></th>';
        $table = $table.'</tr>';
        $table = $table.'<tr>';
        $table = $table.'<td width="7%">'.'Codigo'.'</th>';   
        $table = $table.'<td width="7%">'.'Referencia'.'</th>';           
        $table = $table.'<td width="30%">'.'Descripcion'.'</th>';
        $table = $table.'<td class="hidden-phone">'.'Medida'.'</th>';
        $table = $table.'<td class="hidden-phone">'.'Peso (Kg)'.'</th>';
        $table = $table.'<td class="hidden-phone">'.'Cant. Rejillas Und'.'</th>';
        $table = $table.'<td class="hidden-phone">'.'Cant. Rejillas Total'.'</th>';
        $table = $table.'<td class="hidden-phone">'.'Cant. Perfiles'.'</th>';
        $table = $table.'</tr>';
        $table = $table.'</thead>';
        
	//Por cada resultado pintamos una linea
    $xx=0; 
    $xxfom=0; 
    $peso_rej=0;
    $z = 0;
	while($row=mysqli_fetch_array($request_rej))
	{     
            $z += 1;
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
          
            $table = $table.'<tr>'
                    . '<td width="7%">'.$row['referencia'].'</a></td>'
                    . '<td width="7%">'.$row['codigo'].'</a></td>'
                    . '<td width="40%" class="desc">'.$row['descripcion'].'</font></td>
                    <td class="hidden-phone">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($peso_rej,1,',','.').'</font></td>
                    <td class="hidden-phone">'.number_format($tv2,0,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($tv2*$_GET['cant'],1,',','.').'</font></td>'
                    . '<td class="hidden-phone">'.number_format($numero,1,',','.').'</font></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        if($z != 0){
            echo $table;
        }
}
    
if(isset($_GET['cot'])){ 
 $request=mysqli_query($conexion,"SELECT * FROM producto a, cotizaciones_sub c, tipo_vidrio d where d.id_vidrio=c.id_vidrio_sub  and c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['idcot']."");
   
     
if($request){
	       $table = '<table rules="all" border="1" width="100%" class="op"><caption></caption>';
             $table = $table.'<tdead >';
              $table = $table.'<tr>';
              $table = $table.'<td colspan="14"><center>'.'Compuestos Adicionales'.'</center></td>';
              $table = $table.'</tr>';
              $table = $table.'<tr>';
              $table = $table.'<td width="5%">'.'Items'.'</td>'; 
              $table = $table.'<td width="5%">'.'# O.P'.'</td>'; 
               $table = $table.'<td width="7%">'.'Ref'.'</td>'; 
              $table = $table.'<td width="25%">'.'Producto'.'</td>';
              $table = $table.'<td width="7%">'.'Observacion.'.'</td>'; 
              $table = $table.'<td width="7%">'.'Color Vid.'.'</td>';
              $table = $table.'<td class="hidden-phone">'.'Cierres'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Espesor Vid.'.'</td>';
              
               $table = $table.'<td class="hidden-phone">'.'Ancho.'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Alto.'.'</td>';
               $table = $table.'<td class="hidden-phone">'.'Cant. Total.'.'</td>';
         
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
                    . '<td width="25%" class="desc">'.$row['producto'].'</td>'
                    . '<td width="7%">'.$d1.'</a></td><td width="7%">'.$row["color_v"].'<font></a></td>'
                    . '<td class="hidden-phone">'.$row["cierre_sub"].'<font></a></td>'
                    . '<td class="hidden-phone">'.$row["espesor_v"].' (mm)<font></a></td>'
                    . '<td class="hidden-phone">'.$row["ancho_c_sub"].' (mm)</font></td>'
                    . '<td class="hidden-phone">'.$row["alto_c_sub"].' (mm)<font></a></td>'
                    . '<td class="hidden-phone">'.$row["cantidad_c_sub"].' (Und)<font></a></td>'
                    .'</tr>';   
          
		
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
        if($cont!=0){
     echo '<div align="right"><FONT color="red"><h5> TOTAL EN COMPUESTOS: $'.number_format($ta25).'</h5></FONT></div>';} 

} 
}  
 ?>                                 
<?php 
  $acc_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysqli_fetch_array(mysqli_query($conexion,$acc_por));
                $porcacc= $fipa["p"]/100; 
$request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_GET["ref"]." order by b.para ");
    
     
if($request_acE){
        $table = '<table rules="all" border="1" width="100%" class="op"><caption></caption>';
             $table = $table.'<tdead >';
              $table = $table.'<tr>';
              $table = $table.'<td colspan="14"><center>'.'Accesorios de Fabricacion e Instalacion'.'</center></td>';
              $table = $table.'</tr>';
              $table = $table.'<tr>';
              $table = $table.'<td width="5%">'.'Codigo'.'</th>'; 
              $table = $table.'<td width="5%">'.'Referencia'.'</th>';  
              $table = $table.'<td width="20%">'.'Descripcion'.'</th>';
              $table = $table.'<td width="5%">'.'color'.'</th>';
              $table = $table.'<td class="hidden-phone">'.'Lado'.'</th>';
              $table = $table.'<td class="hidden-phone">'.'Para'.'</th>';
              $table = $table.'<td class="hidden-phone">'.'Cant/Und'.'</th>';
              $table = $table.'<td class="hidden-phone">'.'Cant. Total.'.'</th>';
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
                 
$table = $table.'<tr>'
.'<td width="5%">'.$row['codigo'].'</a></td>'
        . '<td width="5%">'.$row['referencia'].'</a></td>
<td width="40%" class="desc">'.$row['descripcion'].'</font></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.$taa.' '.$row["calcular"].'</font></td>
<td class="hidden-phone">'.$f.'</font></td>
</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
         if($tac!=0){
         echo $table;}
        

}} ?> 
                      <table rules="all" border="1" width="100%" class="op">
                          <tr>
                              <td width="40%" style="text-align: left">
                                  Observaciones:
                                  <?php echo $datos['observaciones'] ?>
                              </td>
                              <td width="20%">
                                  <br>
                                  ----------------------------------
                                  <br>
                                  Entregado Por
                              </td>
                              <td width="10%">
                                  Fecha de Realizacion
                                  <br>
                                  <?php echo $datos['fecha_registro'] ?>
                              </td>
                              <td width="10%">
                                  Fecha de Actualizacion
                                  <br>
                                  <?php echo $fechaadm ?>
                              </td>
                          </tr>
                      </table>                  
                            
                           </body></html>