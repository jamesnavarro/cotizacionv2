 <?php
 if(isset($_GET['por'])){
     $precio_mp = $_GET['por'];
 }else{
     $precio_mp = $precio_mp;
 }
$alum_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysql_fetch_array(mysql_query($alum_por));
                $porca= $fia["p"]/100;
                
                $alum_porr = "SELECT * FROM tipo_aluminio where color_a='".$alum."'";
                $fia4 =mysql_fetch_array(mysql_query($alum_porr));
                $vc= $fia4["costo_a"]/100;
//                echo $vc;
                $alum_porBOG = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MPB' and grupo='Perfileria'";
                $fiaB =mysql_fetch_array(mysql_query($alum_porBOG));
                $porcaB= $fiaB["p"]/100;
 $request=mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
   
if($request){

        $ta =0;$tafom =0;
	while($row=mysql_fetch_array($request))
	{   
            if(isset($dolar)){
                        $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
                $fia =mysql_fetch_array(mysql_query($pdlr));
                $precio_actual= $fia["precio_actual"];$precio_actual_fom = $fia["precio_act_fom"];
            }else{
                $precio_actual= $row["costo_mt"];$precio_actual_fom = $row["costo_fom"];
            }
            if($row['signo']=='+'){
                if($row['medida_r_a']==1){
                    $al = ($altura_ventana+$row["descuento"])+ $row['variable'];
                }else{
                    if($row['medida_r_a']==2){
                    $al = ($altura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])+ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_POST['ancho']+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])+ $row['variable'];
            }
                }
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
                     if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])- $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])- $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_POST['ancho']+$row["descuento"])- $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])- $row['variable'];
            }
                }
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
                     if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])* $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])* $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_POST['ancho']+$row["descuento"])* $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])* $row['variable'];
            }
                }
                }
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
                     if($row['medida_r_a']==3){
                    $al = ($anchura+$row["descuento"])/ $row['variable'];
                }else{
                     if($row['medida_r_a']==4){
                    $al = ($anchura_ventana+$row["descuento"])/ $row['variable'];
                }else{
                     if($row['lado']!="Vertical"){
                $al = ($_POST['ancho']+$row["descuento"])/ $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])/ $row['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
            if($row['lado']=="Vertical"){
                $al55 = ($_POST['alto']);
            }else{
                $al55 = ($_POST['ancho']);
            }
            $n=1000;
           
            if($linea=='Fachada'){
            if($row["lado"]=='Vertical'){
                if($ds== '1'){ 
                $d =$_POST['ancho']/($vert+1);
                $al5 = ($vert);
                echo '<script>alert("B cant1  v: '.$d.'")</script>';
                }else{
                    $d=$vert+1; 
                $al5 = $_POST['ancho']/($vert+1);
               
                } $z = $d;
            }else{
                if($ds== '1'){
                    $d =$_POST['alto']/($hori+1);
                    $al5 = ($hori); 
  
                }else{
                 $d=$hori+1; 
                $al5 = $_POST['alto']/($hori+1);
                }
                $z = $d;
            }
            }else{
                 if($row['lado']=="Vertical"){
                $al5 = ($_POST['alto']);
            }else{
                $al5 = ($_POST['ancho']);
            }
                $z = 0; 
               
            }
//             echo '<script>alert("B cant1: '.$z.'  v: '.$d.'")</script>';
            if($linea=='Fachada'){
               $r = number_format($al5,0);
               $t ='';
               if($row["division"]==1){
                   $cantid= 1;
                   
               }else{
               $cantid= ceil($z-1);
                 
               }
               $d = ($cantid*$row["cantidad"])*$_POST['cant'];
              
               $m = $row["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantid= ceil($z+$row["cantidad"]);
               $d = ($cantid)*$_POST['cant'];
           }
//            echo '<script>alert("B cant1: '.number_format($cantid).'")</script>'; 

              $mp = $precio_actual/$porca;
 
            $ta += ($al*$mp*(($d))/$n);
            
            // costos fom 
            $mpfom = $precio_actual_fom/$porcaB; 
            $tafom = $tafom + ($al*$mpfom*(($d))/$n);
            
            
            $numero = (($d)*$al)/$row["medida"];  
            
         


	} 
	
} 
if($_SESSION['k_username']=='admin'){
////echo '$altura_ventana'.$altura_ventana.'<br>';
////echo '$altura'.$altura.'<br>';
//echo 'Porcentaje'.$porca.'<br>';
////echo 'mp'.$mp.'<br>';
////echo 'numero'.$numero.'<br>';
////echo '$al5'.$al5.'<br>';
//echo 'perfiles'.$ta.'<br>';
//echo 'Perfiles fom '.$tafom.'<br>';
    
}

$a1 = $ta * $vc;
$a2 = $tafom * $vc;
$a3 = ($ta*$porca) * $vc;
$a4 = ($tafom * $porcaB) * $vc;
$perfiles = $ta + $a1;
$perfiles_sinp = ($ta*$porca) + $a3;
$perfiles_fom = $tafom + $a2;
$perfiles_fom_sinp = ($tafom * $porcaB) + $a4;
////    PERFILES     ----------------------------------------------<-<-<<<<-<<--<>>>>

$vidrio_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysql_fetch_array(mysql_query($vidrio_por));
                $porcv= $fip["p"]/100;
                
 $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$_POST['vid']."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
$request_v=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_v){

        $total_vid2=0;  $total_vid2sp=0;
        $ci = 0;
	while($row=mysql_fetch_array($request_v))
	{      
            $ci +=1;
            if($row["ancho_v"]==0){
                
                $alb = $_POST['cuerpo'];
                if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $_POST['ancho'];
                 }
            }else{
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
            
            if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])- $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])* $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])/ $fil_an['variable'];
                $alb = ($aa+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }}
            if(isset($alb)){
                $alb = $alb;
            }else{
                $alb = 0;
            }
//            if($fil_an['lado']=="Vertical"){
//                $al2 = ($_POST['alto']+$fil_an["descuento"]);
//            }else{
//                $al2 = ($_POST['ancho']+$fil_an["descuento"]);
//                $al2b = ($aa+$fil_an["descuento"]);
//            }
            if($row["alto_v"]==0){
                $al2= $_POST['alto'];
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
             
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($_POST['ancho']+$fil_al["descuento"])+ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
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
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])- $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($_POST['ancho']+$fil_al["descuento"])- $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])-$fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])-$fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al['signo']=='*'){
                  if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($_POST['ancho']+$fil_al["descuento"])+ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])+ $fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al['signo']=='/'){
                 if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])/$fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['medida_r_a']==3){
                    $al2 = ($anchura+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                      if($fil_al['medida_r_a']==4){
                    $al2 = ($anchura_ventana+$fil_al["descuento"])/ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($_POST['ancho']+$fil_al["descuento"])/ $fil_al['variable'];
                $al2b = ($aa+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])/$fil_al['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }}
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysql_fetch_array(mysql_query($sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                   if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura + $fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_ventana+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($_POST['ancho']+$fil_an2["descuento"])+ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($_POST['alto']+$fil_an2["descuento"])+ $fil_an2['variable'];
            }
                }
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
                   if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura + $fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_ventana+$fil_an2["descuento"])- $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($_POST['ancho']+$fil_an2["descuento"])- $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($_POST['alto']+$fil_an2["descuento"])- $fil_an2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_an2['signo']=='*'){
                 if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])*$fil_an2['variable'];
                }else{
                   if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura + $fil_an2["descuento"])* $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_ventana+$fil_an2["descuento"])*$fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($_POST['ancho']+$fil_an2["descuento"])* $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($_POST['alto']+$fil_an2["descuento"])* $fil_an2['variable'];
            }
                }
                }
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
                   if($fil_an2['medida_r_a']==3){
                    $al22 = ($anchura + $fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                     if($fil_an2['medida_r_a']==4){
                    $al22 = ($anchura_ventana+$fil_an2["descuento"])/ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($_POST['ancho']+$fil_an2["descuento"])/ $fil_an2['variable'];
                $al22b = ($aa+$fil_an2["descuento"])/ $fil_an2['variable'];
            }else{
                $al22 = ($_POST['alto']+$fil_an2["descuento"])/ $fil_an2['variable'];
            }
                }
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
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysql_fetch_array(mysql_query($sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_ventana+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($_POST['ancho']+$fil_al2["descuento"])+ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($_POST['alto']+$fil_al2["descuento"])+ $fil_al2['variable'];
            }
                }
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
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_ventana+$fil_al2["descuento"])- $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($_POST['ancho']+$fil_al2["descuento"])- $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($_POST['alto']+$fil_al2["descuento"])- $fil_al2['variable'];
            }
                }
                }
                }
                   
                }
            }else{
                if($fil_al2['signo']=='*'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])*$fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_ventana+$fil_al2["descuento"])* $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($_POST['ancho']+$fil_al2["descuento"])* $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($_POST['alto']+$fil_al2["descuento"])* $fil_al2['variable'];
            }
                }
                }
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
                    if($fil_al2['medida_r_a']==3){
                    $al2x = ($anchura+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($anchura_ventana+$fil_al2["descuento"])/ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($_POST['ancho']+$fil_al2["descuento"])/ $fil_al2['variable'];
                $al2xb = ($aa+$fil_al2["descuento"])/ $fil_al2['variable'];
            }else{
                $al2x = ($_POST['alto']+$fil_al2["descuento"])/ $fil_al2['variable'];
            }
                }
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
                $dess = $_POST['alto'];
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx + $cf - $dess;
            }else{
                $nx = 0;
                $all = $tv2 + $cf - $dess;
            }

            $m2 = ($an2/1000)*($all/1000);
         
                              if(1==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven1.php';
                  }
                  if(2==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven1_1.php';
                  }
                  if(3==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven1_2.php';
                  }
                  if(4==$row['pertenece']){
                   include '../modelo/suma_vidrios_ven1_3.php';
                  }
            
           $total_vid2 +=  $totalvxx;
            $total_vid2sp +=  $totalvxxsp;
	} 

}
$vidrio_sinp = $total_vid2sp;
if($_SESSION['k_username']=='admin'){
////echo 'tttt :'.$tv2.'<br>';
//echo 'Vidrios '.$total_vid2.'<br>';

}
     ///    FIN DE VIDRIOS----------------------------------->>>>>>>>>>>>>>

$request_rej=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
//   echo '$altura_v_c'.$altura_v_c.'<br>';  
if($request_rej){

        $xx=0; $xxfom=0;
	while($row=mysql_fetch_array($request_rej))
	{      
             $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$row["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
            
             if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
        
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])- $fil_an['variable'];
      
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])* $fil_an['variable'];
              
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])/ $fil_an['variable'];
           
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                }
                }
                   
                }
            }
            }
            } 
            }
       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysql_fetch_array(mysql_query($sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            if($fil_anrej['signo']=='+'){
                if($fil_anrej['medida_r_a']==1){
                    $alr = ($altura_v_c+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                    if($fil_anrej['medida_r_a']==2){
                    $alr = ($altura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                  if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                   if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_ventana+$fil_anrej["descuento"])+ $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }
                }
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
                  if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                   if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_ventana+$fil_anrej["descuento"])- $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }
                }
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
                  if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                   if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_ventana+$fil_anrej["descuento"])* $fil_anrej['variable'];
                }else{
                     if($fil_anrej['lado']!="Vertical"){
                $alr = ($ancho+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }else{
                $alr = ($alto+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }
                }
                }
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
                  if($fil_anrej['medida_r_a']==3){
                    $alr = ($anchura+$fil_anrej["descuento"])/ $fil_anrej['variable'];
                }else{
                   if($fil_anrej['medida_r_a']==4){
                    $alr = ($anchura_ventana+$fil_anrej["descuento"])/ $fil_anrej['variable'];
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
                if($row["medida_rej"]==999996){
                $medrej = ($anchura_ventana + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999995){
                $medrej = ($anchura + $row["varr"]) / $row["en"]; 
            }else{
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
          
            
             $tv2 = ($al / $row['var3']) * $row['multiplo'];
            
            $numero = ($medrej*$tv2)/$row["medida"];
            $xx = $xx + (($medrej*$tv2*$prej)*$_POST['cant']/1000);
            //costos fom
            $xxfom = $xxfom + (($medrej*$tv2*$prejfom)*$_POST['cant']/1000);
          
               
	} 

}
if($_SESSION['k_username']=='admin'){
////echo 'rejilla : '.$row["medida_rej"].'<br>';
////echo '$tv2'.$tv2.'<br>';
//echo 'costo rejilla '.$xx.'<br>';
////echo 'rejillas'.$xxfom;

    
}
$rejillas = $xx;
$rejillas_sinp = $xx * $porca;
$rejillas_fom = $xxfom;
$rejillas_fom_sinp = $xxfom * $porcaB;
// FIN REJILLASSSS----------------------------------------<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>
 $acc_por = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
                 $acc_porB = "SELECT (".$precio_mp.") as p FROM porcentajes where area_por='MPB' and grupo='Accesorios'";
                $fipaB =mysql_fetch_array(mysql_query($acc_porB));
                $porcaccB= $fipaB["p"]/100; 
                

  $request_acE=mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]." order by b.para ");
  
     
if($request_acE){

     
        $tac = 0; $tacfom = 0; $tacfomp = 0;
	while($row=mysql_fetch_array($request_acE))
	{  
       //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysql_fetch_array($request_v2))
{
$sqlxy=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST['ref']." and b.id_r_a=".$rowz["id_referencia_med"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlxy));
            $id_p= $fil_an["id_p"];
        
                if($fil_an['signo']=='+'){
                if($fil_an['medida_r_a']==1){
                    $al = ($altura_v_c+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==2){
                    $al = ($altura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])+ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
        
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])+ $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])- $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])- $fil_an['variable'];
      
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])- $fil_an['variable'];
            }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])* $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])* $fil_an['variable'];
              
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])* $fil_an['variable'];
            }
                }
                }
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
                    if($fil_an['medida_r_a']==3){
                    $al = ($anchura+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['medida_r_a']==4){
                    $al = ($anchura_ventana+$fil_an["descuento"])/ $fil_an['variable'];
                }else{
                     if($fil_an['lado']!="Vertical"){
                $al = ($_POST['ancho']+$fil_an["descuento"])/ $fil_an['variable'];
           
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
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
   
            if($linea=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$_POST['alto']) / $row["metro"])+$row["cantidad_acc"]);
                     }else{
                         $res = ((($row["cantidad_acc"]*$_POST['ancho']) / $row["metro"])+$row["cantidad_acc"]);
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $_POST['hoja'] * 2 * $row["cantidad_acc"];
               $res = (($_POST['ancho'] / 1000) * 2) + (($_POST['alto']/1000)*$rs);
            }ELSE{
                  if($row['calcular']=='M2'){
                      $res = (($_POST['alto'] / 1000)) * (($_POST['ancho']/1000))* $row["cantidad_acc"];
                }else{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$_POST['alto']) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$_POST['ancho']) / $row["metro"];
                     }             
                 }else{
                      $res = $row["cantidad_acc"];
                 }            
            }}}
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$_POST["cant"])).' ML';
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$_POST["cant"]).' '.$row["calcular"].' ';
                 $ft = 'No aplica' ;$a = '' ;
             }
            if($_POST['pelicula']!="No Aplica"  && $row['codigo']=='26002'){
            if($_POST['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
            $tac = $tac + (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a);
//            echo (($taa * $v) * ($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
            $tacfom = $tacfom + (($taa * $v) * ($row["costo_fom"])*$m*$_POST['cant'] + $a);
            $tacfomp = $tacfomp + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$_POST['cant'] + $a);
           
            }
            if($row['codigo']!='26002'){ 
//                echo ($taa*($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a).'<br>';
            $tac = $tac + ($taa*($row["costo_mt"]/$porcacc)*$m*$_POST['cant'] + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"])*$m*$_POST['cant'] + $a);
            $tacfomp = $tacfomp + ($taa*($row["costo_fom"]/$porcaccB)*$m*$_POST['cant'] + $a);
            }
           ////echo $tac.'<br>';
	} 

}
if($_SESSION['k_username']=='admin'){
//echo '<br>Accesorios'.$tac.'<br>';
//echo '<br>Accesorios'.$tacfomp.'<br>';
    
}
$accesorios = $tac;
$accesorios_sinp = $tac * $porcacc;
$accesorios_fom = $tacfomp;
$accesorios_fom_sinp = $tacfomp * $porcaccB;
// FIN DE ACCESORIOS-----------------<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>
$suma = $perfiles + $total_vid2 + $rejillas + $accesorios;
//echo $perfiles .'+'. $total_vid2 .'+'. $rejillas .'+'. $accesorios.'<br>';
 $suma_sp = $perfiles_sinp + $vidrio_sinp + $rejillas_sinp + $accesorios_sinp;
 $suma_fom = $perfiles_fom + $total_vid2 + $rejillas_fom + $accesorios_fom;
$suma_fom_sin_p = $perfiles_fom_sinp + $vidrio_sinp + $rejillas_fom_sinp + $accesorios_fom_sinp;
////echo $perfiles_fom .'+'. $total_vid2 .'+'. $rejillas_fom .'+'. $accesorios_fom.'<br>';
$request_mano=mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_mano){

        $tot2=0;$tot2fom=0;$tot2fomp=0; $totsinp = 0;
	while($row=mysql_fetch_array($request_mano))
	{       
              $mt2 = ($_POST['alto']/1000)*($_POST['ancho']/1000);
            if($row['dias']=='Si'){
                if($_POST['alto']>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 1;
                }
               $r = $row["porcentaje_ma"]*($res)*$duracion;
                $tot2 = $tot2 + $r ;
                $tot2fom = $tot2fom + $r ;
                $tot2fomp = $tot2fomp + $r ;
                $totsinp = $totsinp + $r ;
            }else{
                $r = $row["porcentaje_ma"]/100*($suma/$_POST['cant']);
                $tot2 = $tot2 + $r;
                
                $r2 = $row["porcentaje_ma"]/100*($suma_fom/$_POST['cant']);
                 $tot2fom = $tot2fom + $r2 ; 
                 
                 $r3 = $row["porcentaje_ma"]/100*($suma_fom_sin_p/$_POST['cant']);
                 $tot2fomp = $tot2fomp + $r3 ;
                 
                 $r4 = $row["porcentaje_ma"]/100*($suma_sp/$_POST['cant']);
                 $totsinp = $totsinp + $r4 ;
            } 
            //echo   'maq '.$r.'<br>';
	} 

}
if($_SESSION['k_username']=='admin'){
//echo 'maquinaria'.$tot2.'<br>';
//echo 'maquinaria'.$tot2fom.'<br>';
    
}
$maquina = $tot2;
$maquina_sinp = $totsinp;
$maquina_fom = $tot2fom;
$maquina_fom_sinp = $tot2fomp;

// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

           $req=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
if($req){

        $tot=0;$tot_fom = 0;
	while($row=mysql_fetch_array($req))
	{       
            $mt2 = ($_POST['alto']/1000)*($_POST['ancho']/1000);
            $mtl = ($_POST['ancho']/1000);
             if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
           if($_POST["install"]=="Si"){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_POST["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_POST["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_POST["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_POST["cant"]*$row["valor_mo"]);
                }
                   if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($_POST["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($_POST["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($_POST["cant"]*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($_POST["cant"]*$row["valor_mo"]);
                    
                }
                   if($_POST['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                       if($_POST['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                    
                       $tot_fom = $tot_fom + ($tarf * $v);
                   }
                 if($row['referencia']!='26002'){
                       $tot_fom = $tot_fom + $tarf;
                   }
                }
                if($_POST['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                    if($_POST['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                  
                }
                if($row['referencia']!='26002'){
                     $tot = $tot + $tar;
                }
            }else{
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($_POST["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($_POST["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($_POST["cant"]*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($_POST["cant"]*$row["valor_mo"]);
                }
                if($_POST['pelicula']!='No Aplica'  && $row['referencia']=='26002'){
                    if($_POST['pelicula']=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                     $tot = $tot + ($tar * $v);
                }
                if($row['referencia']!='26002'){
                     $tot = $tot + $tar;
                }
                }else{
                    $tar = 0;
                }
            }
	} 

}
if($_SESSION['k_username']=='admin'){
//       
//echo 'mano de obra'.$tot.'<br>';
//echo 'mano de obra'.$tot_fom.'<br>';
    //echo $instal.'<br>';
}
$mano = $tot;
$mano_fom = $tot_fom;

///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
$suma_maq = ($suma/$_POST['cant']) + $maquina + ($mano/$_POST['cant']);
//echo 'SUMA DE TODOD: '.($suma/$_POST['cant']) .'+'. $maquina .'+'. ($mano/$_POST['cant']).'<br>';
$suma_maq_sp = ($suma_sp/$_POST['cant']) + $maquina_sinp + ($mano/$_POST['cant']);
$suma_maq_fom = ($suma_fom/$_POST['cant']) + $maquina_fom + ($mano_fom/$_POST['cant']);
$suma_maq_fom_sin_p = $maquina_fom_sinp+ ($suma_fom_sin_p/$_POST['cant']) + ($mano/$_POST['cant']);
//echo $suma_maq.'<br>';
$request_ad=mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    

if($request_ad){

        $tota=0;  $tota_sinp=0;$totafom=0;$totafom_sinp=0;
	while($row=mysql_fetch_array($request_ad))
	{              
             $por = 100;
              if($row['referencia_ad']!='ADM-007'){
                   $totafom = $totafom + (($suma_maq_fom*$_POST['cant'])*$row["porcentaje_ad"]/$por);
                   $totafom_sinp = $totafom_sinp + (($suma_maq_fom_sin_p*$_POST['cant'])*$row["porcentaje_ad"]/$por);
              }
             $tota = $tota + (($suma_maq*$_POST['cant']) *$row["porcentaje_ad"]/$por);
             $tota_sinp = $tota_sinp + (($suma_maq_sp*$_POST['cant'])*$row["porcentaje_ad"]/$por);
            
	} 

}
if($_SESSION['k_username']=='admin'){
//echo 'Administracion '.$tota.'<br>';
//echo 'Administracion '.$totafom.'<br>';
    
}
$admin = $tota/$_POST['cant'];
$admin_sinp = $tota_sinp/$_POST['cant'];
$admin_fom = $totafom/$_POST['cant'];
$admin_fom_sinp = $totafom_sinp/$_POST['cant'];
/// gastos administrativos
$request_ot=mysql_query("SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
   
if($request_ot){

        $t2=0;
	while($row=mysql_fetch_array($request_ot))
	{       
             $t2 = $t2 + $row['valor_ot']*$_POST['cant']*$row['cantidad_ot'];
	} 
}
//echo 'otros'.$t2.'<br>';
//  FIN DE OTROS ---------------------------------<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>
  if(isset($totsi)){
    $si = $totsi;
}else{$si =0;}

$totalx = ($suma_maq + $admin)*$_POST['cant'];
$totalx_sinp = ($suma_maq_sp + $admin_sinp)*$_POST['cant'];
$totalxfom = ($suma_maq_fom + $admin_fom)*$_POST['cant'];
$totalxfom_sinp = ($suma_maq_fom_sin_p + $admin_fom_sinp)*$_POST['cant'];
