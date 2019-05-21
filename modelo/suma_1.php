 <?php
 $hoja = $ho;

if($linea_cot!='Vidrio'){
    $alum_por = "SELECT (".$porcentaje_mp.")  as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $fia =mysql_fetch_array(mysql_query($alum_por));
                $porca= $fia["p"]/100;
$request=mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff);
   
     
if($request){

        $ta =0;
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
                $al = ($ancc+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($altt+$row["descuento"])+ $row['variable'];
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
                $al = ($ancc+$row["descuento"])- $row['variable'];
            }else{
                $al = ($altt+$row["descuento"])- $row['variable'];
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
                $al = ($ancc+$row["descuento"])* $row['variable'];
            }else{
                $al = ($altt+$row["descuento"])* $row['variable'];
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
                $al = ($ancc+$row["descuento"])/ $row['variable'];
            }else{
                $al = ($altt+$row["descuento"])/ $row['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
               if($linea_cot=='Fachada'){
            if($row["lado"]=='Vertical'){
                if($dd== '1'){ 
                $d =$ancc/($ver+1);
                $al5 = ($ver);
                }else{
                    $d=$ver+1; 
                $al5 = $ancc/($ver+1);
               
                } $z = ceil($d);
            }else{
                if($dd== '1'){
                    $d =$altt/($hor+1);
                    $al5 = ($hor); 
  
                }else{
                $d=$hori+1; 
                $al5 = $altt/($hor+1);
                }$z = ceil($d);
            }
            }else{
           if($row['lado']=="Vertical"){
                $al5 = ($altt);
            }else{
                $al5 = ($ancc);
            }
                $z = 0;}
            
            $n=1000;
             if(isset($dd)){$s= $dd;}else{$s= 0;}
              if($linea_cot=='Fachada'){
               $cantid= ceil($z+1);
               $d = ($cantid*$row["cantidad"])*$cann;
            
           }else{
               $cantid= ceil($z+$row["cantidad"]);
               $d = ($cantid)*$cann;
           }
    
            $mp = $row["costo_mt"]/$porca;
            $ta = $ta + ($al*$mp*(($d))/$n);
            $numero = (($d)*$al5)/$row["medida"];  

          
	} 
	
}   
//echo '$altura_ventana'.$altura_ventana.'<br>';
//echo '$altura'.$altura.'<br>';
//echo 'Porcentaje'.$porca.'<br>';
//echo 'mp'.$mp.'<br>';
//echo 'numero'.$numero.'<br>';
//echo '$al5'.$al5.'<br>';
//echo '$al'.$al.'<br>';
//echo 'Perfiles'.$ta.'<br>';
////    PERFILES     ----------------------------------------------<-<-<<<<-<<--<>>>>

$vidrio_por = "SELECT (".$porcentaje_mp.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysql_fetch_array(mysql_query($vidrio_por));
                $porcv= $fip["p"]/100;
                
 $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
$request_v=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_v){

        $total_vid=0;
	while($row=mysql_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$row["ancho_v"]."");
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
                $al = ($ancc+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])+ $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])- $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])* $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_an['lado']=="Vertical"){
                $al2 = ($altt+$fil_an["descuento"]);
            }else{
                $al2 = ($ancc+$fil_an["descuento"]);
            }
            
            $tv = $al + $row['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancc+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($altt+$fil_al["descuento"])+ $fil_al['variable'];
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
                $al2 = ($ancc+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($altt+$fil_al["descuento"])- $fil_al['variable'];
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
                $al2 = ($ancc+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($altt+$fil_al["descuento"])* $fil_al['variable'];
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
                $al2 = ($ancc+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($altt+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($altt+$fil_al["descuento"]);
            }else{
                $al3 = ($ancc+$fil_al["descuento"]);
            }
            //-----------------------------------------------------------------------------------------------------------------
                                                if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysql_fetch_array(mysql_query($sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($_POST['ancho']+$fil_an2["descuento"])+ $fil_an2['variable'];
            }else{
                $al22 = ($altt+$fil_an2["descuento"])+ $fil_an2['variable'];
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
                $al22 = ($ancc+$fil_an2["descuento"])- $fil_an2['variable'];
            }else{
                $al22 = ($altt+$fil_an2["descuento"])- $fil_an2['variable'];
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
                $al22 = ($ancc+$fil_an2["descuento"])* $fil_an2['variable'];
            }else{
                $al22 = ($altt+$fil_an2["descuento"])* $fil_an2['variable'];
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
                $al22 = ($ancc+$fil_an2["descuento"])/ $fil_an2['variable'];
            }else{
                $al22 = ($altt+$fil_an2["descuento"])/ $fil_an2['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            }else{
               
                $al22 = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysql_fetch_array(mysql_query($sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancc+$fil_al2["descuento"])+ $fil_al2['variable'];
            }else{
                $al2x = ($altt+$fil_al2["descuento"])+ $fil_al2['variable'];
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
                $al2x = ($ancc+$fil_al2["descuento"])- $fil_al2['variable'];
            }else{
                $al2x = ($altt+$fil_al2["descuento"])- $fil_al2['variable'];
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
                $al2x = ($ancc+$fil_al2["descuento"])* $fil_al2['variable'];
            }else{
                $al2x = ($altt+$fil_al2["descuento"])* $fil_al2['variable'];
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
                $al2x = ($ancc+$fil_al2["descuento"])/ $fil_al2['variable'];
            }else{
                $al2x = ($altt+$fil_al2["descuento"])/ $fil_al2['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            }else{
               
                $al2x = 0;
            }
             $tv = $al + $row['var1'];
             $tv2 = $al2 + $row['var2'];
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
            }else{
                $n = 0;
                $an2 = $tv;
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $nx;
            }else{
                $nx = 0;
                $all = $all;
            }
            
            
          
            include '../modelo/suma_vidrios_ven1.php';
           $total_vid = $total_vid + $totalvxx;
	} 

}
//echo 'Vidrios'.$total_vid.'<br>';
     ///    FIN DE VIDRIOS----------------------------------->>>>>>>>>>>>>>

$request_rej=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_rej){

        $xx=0;
	while($row=mysql_fetch_array($request_rej))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$row["id_referencia"]."");
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
                $al = ($ancc+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])+ $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])- $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])* $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
                 $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$col["ancho_v"]."");
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
                $alr = ($ancc+$fil_anrej["descuento"])+ $fil_anrej['variable'];
            }else{
                $alr = ($altt+$fil_anrej["descuento"])+ $fil_anrej['variable'];
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
                $alr = ($ancc+$fil_anrej["descuento"])- $fil_anrej['variable'];
            }else{
                $alr = ($altt+$fil_anrej["descuento"])- $fil_anrej['variable'];
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
                $alr = ($ancc+$fil_anrej["descuento"])* $fil_anrej['variable'];
            }else{
                $alr = ($altt+$fil_anrej["descuento"])* $fil_anrej['variable'];
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
                $alr = ($ancc+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }else{
                $alr = ($altt+$fil_anrej["descuento"])/ $fil_anrej['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_anrej['lado']=="Vertical"){
                $al2 = ($altt+$fil_anrej["descuento"]);
            }else{
                $al2 = ($ancc+$fil_anrej["descuento"]);
            }
            
            $tvR = $alr + $col['var1'];


         }
            
              if($row["medida_rej"]==0){
                $medrej = ($ancc + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999999){
                $medrej = ($altt + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999998){
                $medrej = ($altura + $row["varr"]) / $row["en"]; 
            }else{
                 if($row["medida_rej"]==999998){
                $medrej = ($altura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            } 
            } 
            } 
            }
                $al2 = ($altt+$fil_an["descuento"]);
          

           
            $tv2 = $al2 / $row['var3'];
            $numero = ($medrej*$tv2)/$row["medida"];
            $xx = $xx + (($medrej*$tv2*$row["costo_mt"])*$cann/1000);
          
               
	} 

}
}
//echo 'rejillas'.$xx.'<br>';
//}
//
//
// FIN REJILLASSSS----------------------------------------<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>
 $acc_por = "SELECT (".$porcentaje_mp.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100; 
$request_acE=mysql_query("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_acE){

     
        $tac = 0;
	while($row=mysql_fetch_array($request_acE))
	{  
                                  
            //--------------------------------------------------------------------
                        if($row['can_rej']!=0){
    $request_v2=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysql_fetch_array($request_v2))
{
$sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$reff." and b.id_r_a=".$rowz["id_referencia_med"]."");
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
                $al = ($ancc+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])+ $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])- $fil_an['variable'];
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
                $al = ($ancc+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])* $fil_an['variable'];
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
                $al = ($_POST['ancho']+$fil_an["descuento"])/ $fil_an['variable'];
            }else{
                $al = ($altt+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
     $cant_rej = number_format($al / $rowz['var3']);
  
}}else{
            $cant_rej = 1;
        }
           
            //---------------------------------------------------------------------
               if($row["med"]!=1){$m = $row["med"]/1000;}else{$m = $row["med"];}
                        if($linea_cot=='Fachada'){
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ((($row["cantidad_acc"]*$altt) / $row["metro"])+$row["cantidad_acc"])*$d;
                     }else{
                         $res = ($row["cantidad_acc"]*$ancc) / $row["metro"];
                     }              
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{
              if($row['calcular']=='ML'){
               $rs = $hoja * 2 ;
               $res = (($ancc / 1000) * 2) + (($altt/1000)*$rs);
            }ELSE{
                 if($row["yes"]=='Si'){
                     if($row["lado"]=='Vertical'){
                         $res = ($row["cantidad_acc"]*$altt) / $row["metro"];
                     }else{
                         $res = ($row["cantidad_acc"]*$ancc) / $row["metro"];
                     }    
                 }else{
                      $res = $row["cantidad_acc"];
                 } 
            }}
            $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = $row["med"]/1000;
                 $f = ''.number_format(($taa*$cann)*$m).' ML';
                 $ft = $f * $row["valor_f"] ;$a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$cann).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
             
            $tac = ($taa*$cann*$m)*($row["costo_mt"]/$porcacc) + $tac + $a;
           //echo $tac.'<br>';
	} 

}
//echo 'Accesorios'.$tac.'<br>';
// FIN DE ACCESORIOS-----------------<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>

if(isset($total_vid)){
    if($linea_cot=='Vidrio'){
        $ff = $totalv;
    $tv2 =0;
    $ta = 0;
    $total_vid =0;
    $xx=0;
    }else{
        $ff = $total_vid + $ta + $tac + $xx;
        $tv2 =0;
    }
    
}else{
    
   
    $ff = $totalv;
    $tv2 =0;
    $ta = 0;
    $total_vid =0;
    $xx=0;
    
    
}
//echo $ta.'<br>';
//echo $total_vid.'<br>';
//echo $ff.'<br>';
$request_mano=mysql_query("SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_mano){

        $tot2=0;
	while($row=mysql_fetch_array($request_mano))
	{       
              $mt2 = ($altt/1000)*($ancc/1000);
            if($row['dias']=='Si'){
                if($altt>3000){
                    $res = $mt2 /2.25;
                }else{
                    $res = 0;
                }
               $r = $row["porcentaje_ma"]*($res)*$dura;
                $tot2 = $tot2 + $r ;
                
            }else{
                $r = $row["porcentaje_ma"]/100*$ff;
                $tot2 = $tot2 + $r;
               
            }
            
	    
               
	} 

}
//echo 'maquinaria'.$tot2.'<br>';
// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

$request_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='No' and b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$reff);
    
  
if($request_maq){

        $tot=0;
	while($row=mysql_fetch_array($request_maq))
	{       
            $mt2 = ($altt/1000)*($ancc/1000);
            $mtl = ($altt/1000)+($ancc/1000);
          
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($cann*$row["valor_mo"]);
                }
                $tot = $tot + $tar;
     
	} 

}

if($instal=='Si'){
$req=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='Si' and  b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$reff);   
if($req){

        $totsi=0;
	while($row=mysql_fetch_array($req))
	{       
            $mt2 = ($altt/1000)*($ancc/1000);
            $mtl = ($altt/1000)+($ancc/1000);
       
                
                if($row['unidad_cobro']=='M2'){
                    $tars =  $mt2*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tars =  $mtl*($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tars =  ($cann*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tars =  ($cann*$row["valor_mo"]);
                }
                $totsi = $totsi + $tars;     
	} 
}}

//echo 'mano de obra'.$tot.'<br>';
//echo 'Instalacion-: '.$instal.'<br>';
///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<
$total = $ta + $tv2 + $tac+ $tot+$tot2;
$request_ad=mysql_query("SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_ad){

        $tota=0;
	while($row=mysql_fetch_array($request_ad))
	{       
            $por = 100;
             $tota = $tota + ($ff*$row["porcentaje_ad"]/$por);
  
	} 

}
//echo 'Administracion'.$tota.'<br>';
/// gastos administrativos



$request_ot=mysql_query("SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$reff);
    
     
if($request_ot){

        $t2=0;
	while($row=mysql_fetch_array($request_ot))
	{       
             $t2 = $t2 + $row['valor_ot']*$cann*$row['cantidad_ot'];
  
	} 

  
}
//echo 'otros'.$t2.'<br>';

       if(isset($totsi)){
           if($linea_cot!='Vidrio'){
               $si = $totsi;
           }else{
              $si =0; 
           }
    
}else{$si =0;}
$totalxx = $ta + $total_vid + $xx + $tac + $tot2 + $tot + $tota + $t2 + $si;
//
//echo 'total de $ta= '.$ta.'<br>';
//echo 'total de $total_vid= '.$total_vid.'<br>';
//echo 'total de $tac= '.$tac.'<br>';
//echo 'total de $tot2= '.$tot2.'<br>';
//echo 'total de $tot= '.$tot.'<br>';
//echo 'total de $tota= '.$tota.'<br>';
//echo 'total de $t2= '.$t2.'<br>';
//echo 'total de $si= '.$si.'<br>';
//echo 'total de suma_1 xx= '.$totalxx.'<br>';

//dd