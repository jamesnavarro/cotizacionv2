<?php

$request=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
   
     
if($request){

        $ta =0;
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
                $al = ($_POST['ancho']+$row["descuento"])+ $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])+ $row['variable'];
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
                $al = ($_POST['ancho']+$row["descuento"])- $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])- $row['variable'];
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
                $al = ($_POST['ancho']+$row["descuento"])* $row['variable'];
            }else{
                $al = ($_POST['alto']+$row["descuento"])* $row['variable'];
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
            if($row['lado']=="Vertical"){
                $al5 = ($_POST['alto']);
            }else{
                $al5 = ($_POST['ancho']);
            }
            $n=1000;
            $ta = $ta + ($al*$row["costo_mt"]*$_POST['cant']/$n);
            $numero = ($_POST['cant']*$row["cantidad"]*$al5)/$row["medida"];  
           if($row["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
           if($row["descuento"]>=0){$s ='+';}else{$s = '';}
           $formula = '('.$x.''.$s.''.$row["descuento"].')'.$row["signo"].''.$row["variable"];
   
	} 
	
}    
echo $ta;
////    PERFILES     ----------------------------------------------<-<-<<<<-<<--<>>>>

$request_v=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_v){

        $total_vid=0;
	while($row=mysqli_fetch_array($request_v))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]." and b.id_r_a=".$row["ancho_v"]."");
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
                $al = ($_POST['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])+ $fil_an['variable'];
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
                $al = ($_POST['ancho']+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])- $fil_an['variable'];
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
                $al = ($_POST['ancho']+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])* $fil_an['variable'];
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
                $al = ($_POST['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_an['lado']=="Vertical"){
                $al2 = ($_POST['alto']+$fil_an["descuento"]);
            }else{
                $al2 = ($_POST['ancho']+$fil_an["descuento"]);
            }
            
            $tv = $al + $row['var1'];
            
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($conexion,$sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($_POST['ancho']+$fil_al["descuento"])+ $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])+ $fil_al['variable'];
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
                $al2 = ($_POST['ancho']+$fil_al["descuento"])- $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])- $fil_al['variable'];
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
                $al2 = ($_POST['ancho']+$fil_al["descuento"])* $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])* $fil_al['variable'];
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
                $al2 = ($_POST['ancho']+$fil_al["descuento"])/ $fil_al['variable'];
            }else{
                $al2 = ($_POST['alto']+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($_POST['alto']+$fil_al["descuento"]);
            }else{
                $al3 = ($_POST['ancho']+$fil_al["descuento"]);
            } 
            $tv2 = $al2 + $row['var2'];
           $total_vid = $total_vid + $row["cantidad_v"]*$row["costo_mt"]*$_POST['cant'];
 
        }

}
//echo $total_vid;
     ///    FIN DE VIDRIOS----------------------------------->>>>>>>>>>>>>>

$request_rej=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_rej){

        $xx=0;
	while($row=mysqli_fetch_array($request_rej))
	{      
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]." and b.id_r_a=".$row["id_referencia"]."");
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
                $al = ($_POST['ancho']+$fil_an["descuento"])+ $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])+ $fil_an['variable'];
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
                $al = ($_POST['ancho']+$fil_an["descuento"])- $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])- $fil_an['variable'];
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
                $al = ($_POST['ancho']+$fil_an["descuento"])* $fil_an['variable'];
            }else{
                $al = ($_POST['alto']+$fil_an["descuento"])* $fil_an['variable'];
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
                $al = ($_POST['alto']+$fil_an["descuento"])/ $fil_an['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
         
                $al2 = ($_POST['alto']+$fil_an["descuento"]);
          

           
            $tv2 = $al2 / $row['var3'];
            $numero = ($row["medida_rej"]*$tv2)/$row["medida"];
            $xx = $xx + (($row["medida_rej"]*$tv2*$row["costo_mt"])*$_POST['cant']/1000);
          
               
	} 

}
// FIN REJILLASSSS----------------------------------------<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>

$request_acE=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_acE){

        $total2=0;
        $tac = 0;
	while($row=mysqli_fetch_array($request_acE))
	{       
            $tac = $row["cantidad_acc"]*$cantidad*$row["precio_ac"] + $tac;
 
	} 

}

// FIN DE ACCESORIOS-----------------<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>

$request_mano=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ma b, referencia_ma c where b.id_ref_ma=c.id_ref_ma and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_mano){

        $tot2=0;
	while($row=mysqli_fetch_array($request_mano))
	{       
             $tot2 = $tot2 + $row["porcentaje_ma"]*$tac*$_POST['cant'];
	
               
	} 

}

// fin mano de MAQUINARIA-------------------------------<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>

$request_maq=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where c.instalacion='".$instal."' and b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_maq){

        $tot=0;
	while($row=mysqli_fetch_array($request_maq))
	{       
            $tot = $tot + $_POST["cant"]*$row["valor_mo"];
               
	} 

}

///FIN MANO DE OBRA ------------------------------------->>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<

$request_ad=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_ad){

        $tota=0;
	while($row=mysqli_fetch_array($request_ad))
	{       
            $por = 100;
            $tota = $tota + ($total*$row["porcentaje_ad"]/$por);
  
	} 

}

/// gastos administrativos



$request_ot=mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_otro b, referencia_otro c where b.id_ref_ot=c.id_ref_ot and a.id_p=b.id_p and a.id_p=".$_POST["ref"]);
    
     
if($request_ot){

        $t2=0;
	while($row=mysqli_fetch_array($request_ot))
	{       
             $t2 = $t2 + $row['valor_ot']*$_POST['cant']*$row['cantidad_ot'];
  
	} 

  
}
//  FIN DE OTROS ---------------------------------<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>

$totalx = $ta + $total_vid + $xx + $tac + $tot2 + $tot + $tota + $t2;
