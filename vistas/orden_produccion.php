<?php
require('../fpdf.php');
require '../modelo/cx.php';
//$paciente= $_GET['imprimir'];
	$con = new DB;
class PDF extends FPDF
{
    var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calcular la altura de la fila
	$nb=1;
	for($i=1;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Emitir un salto de página si es necesario primero
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Guardar la posición actual
		$x=$this->GetX();
		$y=$this->GetY();
		//Dibuje la frontera
		
		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,5,$data[$i],0,$a,'false');
		//Ponga la posición a la derecha de la celda
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h+1);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}

// Cabecera de p�gina
function Header()
{
	$con = new DB;
		$pacientes = $con->conectar();	
        $strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['imp']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
        
        if($fila3['tipo']=='Empresarial'){
            $empresa = $con->conectar();	
        $strConsulta3 = "select * from sis_empresa  where id_empresa=".$fila3['id_cliente']."";
	$empresa = mysql_query($strConsulta3);
	$filae = mysql_fetch_array($empresa);
        $nombre = $filae['nombre_emp'];
        $documento =$filae['nit_emp'];
        $telefono =$filae['tel_oficina_emp'];
        $direccion =$filae['direccionr_emp'];
        }else{
            $personal = $con->conectar();	
        $strConsultap = "select * from sis_contacto  where id_contacto=".$fila3['id_cliente']."";
	$personal = mysql_query($strConsultap);
	$filae = mysql_fetch_array($personal);
        $nombre = $filae['nombre_cont'].' '.$filae['apellido_cont'];
        $documento =$filae['cedula_cont'];
        $telefono =$filae['tel_oficina'];
        $direccion =$filae['direccionf'];
        }
        
        $op = $con->conectar();	
        $strConsulta3 = "select * from orden_produccion  where ref='".$_GET['imp']."'";
	$op = mysql_query($strConsulta3);
	$filaop = mysql_fetch_array($op);

	$this->SetFont('Arial','B',8);
	// Movernos a la derecha
	$this->Cell(1);
	// T�tulo
	$this->Cell(10,0,'TEMPLADO SA',0,30);
        $this->Cell(170,8,'ORDEN DE PRODUCCION No.' .$_GET['op'],10,30,'R');
        $this->Cell(10,0,'CLIENTE : '. $nombre,10,30);
        $this->Cell(170,0,'PEDIDO No. : '.$_GET['imp'],10,30,'R');
        $this->Cell(10,8,'OBSERVACIONES : '. utf8_decode($filaop['observaciones']),10,30);
         $this->Cell(10,0,'FECHA DE REGISTRO : '.$fila3['fecha_reg_c'],10,30);

	// Salto de l�nea
	$this->Ln(1);
        $this->SetFont('Arial','B',6);
	// Movernos a la derecha
	$this->Cell(-1);
	// T�tulo
	
        $this->Ln(1);
        
        $historial1 = $con->conectar();
	$strConsulta1 = "SELECT * FROM producto a,  cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and c.id_cot=".$_GET['imp']."";
	$historial1 = mysql_query($strConsulta1);
	$numfilas1 = mysql_num_rows($historial1);
        $t3=32;$c=0;
        $v = $this->PageNo();
 
        
}

// Pie de p�gina
function Footer()
{
	// Posici�n: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// N�mero de p�gina
        $this->Cell(0,2,'TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173',0,0,'C');
        $this->Cell(-200,10,'BARRANQUILLA-COLOMBIA',0,0,'C');
        $this->Cell(0,15,'www.templadosa.com - ventas@templadosa.com',0,0,'C');
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creaci�n del objeto de la clase heredada
$pdf = new PDF('P','mm','letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Cell(190,6,'PRODUCTOS TERMINADOS ',1,20,'C');
$pdf->SetWidths(array(15, 60, 20, 15, 30, 10, 20, 20));

	$pdf->SetFont('Arial','I',6);

	$pdf->Cell(8,0,'',0,20,'C');
	$pdf->SetFillColor(230,230,230);
        $pdf->SetTextColor(0);
        
        $pdf->Row(array('REF', 'DESCRIPCION DEL PRODUCTO', 'MEDIDAS', 'ALUM', 'VIDRIO', 'CANT', 'VLR. UND', 'VLR. TOTAL'));
                        
	$historial = $con->conectar();

	$strConsulta = "SELECT * FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e where e.anula=0 and e.id_producto=a.id_p and e.codigo=".$_GET['op']." and c.estado_c='Pedido' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p  and c.id_cot=".$_GET['imp']."";
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	$t =32;
        $total = 0;
        $r=0;
	for ($i=0; $i<$numfilas; $i++)
		{
            
                        $t = $t + 22;
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','I',0);
			
			
		        $pdf->SetFillColor(255, 255, 255);
    			$pdf->SetTextColor(0);
                        
                        $porcentaje = $con->conectar();	
                       if($fila["linea_cot"]=='Aluminio'){
                            $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                        }else{
                            if($fila["linea_cot"]=='Vidrio'){
                            $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                            }else{
                               if($fila["linea_cot"]=='Fachada'){
                            $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                            }else{
                       $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                            }
                            }
                        }
                        $altura_ventana = $fila["alto_c"]- $fila["cuerpo"]; 
                        $altura_v_c = $fila["alto_c"]- $fila["cuerpo"]; 
                        
                        $ds = $fila['desc'] /100;
                        $tt = ($fila['valor_c']/($filpor['p']/100)) + $fila['precio_adicional'] + $fila['precio_material'];
                        
                        $dt = $tt * $ds;
                        $total = $total + $tt - $dt;
                        $tt2 = $tt - $dt;
                      
                        $ordenes = $con->conectar();
                         $sq = "SELECT * FROM orden_detalle where anula=0 and codigo=".$_GET['op']." and relacionado=".$fila['id_cotizacion']." and id_orden_d=".$fila['id_orden_d']." ";
                         $ordenes = mysql_query($sq);
                         $fila211 = mysql_fetch_array($ordenes);
                        $m1= $fila211["medida1"];
                        $m2= $fila211["medida2"];
                        $c= $fila211["cant_ordenada"];
                        $x= $fila211['estado_op'];
                       if($x==1){
                           $r = $r +(($tt2/$fila['cantidad_c'])*$c);
                           $pdf->Image('../producto/'.$fila['ruta'].'');
		        $pdf->Row(array($fila['referencia_p'], utf8_decode($fila['producto']), $m1.'x'.$m2, $fila['color_ta'], $fila['color_v'].'('.$fila['espesor_v'].'mm)', $c.' Und', number_format($tt2/$fila['cantidad_c']), number_format(($tt2/$fila['cantidad_c'])*$c)));
                       }
		}
                $pdf->SetFont('Arial','I',6);

                $pdf->Cell(190,6,'TOTAL : $'.number_format($r),1,20,'R');
                

                 $pdf->Cell(190,6,'<<<<<<<<<<<<<<<  MATERIA PRIMA  >>>>>>>>>>>>>>>>> ',1,20,'C');
        
        
	$historial = $con->conectar();
	$strConsulta = "SELECT * FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e where e.anula=0 and  e.id_producto=a.id_p and e.codigo=".$_GET['op']." and c.estado_c='Pedido' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p  and c.id_cot=".$_GET['imp']."";
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	$t =32;
        $total = 0;
        $r=0;
        $ta =0;
        
	for ($i=0; $i<$numfilas; $i++)
		{
            $fila = mysql_fetch_array($historial);
                            $pdf->Cell(190,6,'PERFILES DE  '.utf8_decode($fila['producto']).' ('.$fila['medida1'].'x'.$fila['medida2'].')',1,20,'C');
                $pdf->SetWidths(array(15, 60, 20, 15, 15, 15, 15, 15, 20));

	$pdf->SetFont('Arial','I',6);

	$pdf->Cell(8,0,'',0,20,'C');
	$pdf->SetFillColor(230,230,230);
        $pdf->SetTextColor(0);
                         $aluminio1 = $con->conectar();
                         $sq21 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']);
                         $aluminio1 = mysql_query($sq21);
                         $canfilas1 = mysql_num_rows($aluminio1);
                         if($canfilas1!=0){
        $pdf->Row(array('REF', 'DESCRIPCION DEL PERFIL', 'LADO', 'PERFIL', 'UND', 'CANT. T', 'CANT. PERF', 'MEDIDA', 'VLR. COSTO'));
                        $t = $t + 22;
			
			$pdf->SetFont('Arial','I',0);
                        
                        $cuerpo = $fila['cuerpo'];
                        $tipo = $fila['linea_cot'];
			
			
		        $pdf->SetFillColor(255, 255, 255);
    			$pdf->SetTextColor(0);
                        
                        $porcentaje = $con->conectar();	
                       if($fila["linea_cot"]=='Aluminio'){
                            $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Aluminio'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                        }else{
                            if($fila["linea_cot"]=='Vidrio'){
                            $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                            }else{
                               if($fila["linea_cot"]=='Fachada'){
                            $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Fachada'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                            }else{
                       $s = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Acero'";
                        $porcentaje = mysql_query($s);
                        $filpor = mysql_fetch_array($porcentaje);
                            }
                            }
                        }
                        $ds = $fila['desc'] /100;
                        $tt = ($fila['valor_c']/($filpor['p']/100)) + $fila['precio_adicional'] + $fila['precio_material'];
                        
                        $dt = $tt * $ds;
                        $total = $total + $tt - $dt;
                        $tt2 = $tt - $dt;
                      
                        $ordenes = $con->conectar();
                         $sq = "SELECT * FROM orden_detalle where codigo=".$_GET['op']." and relacionado=".$fila['id_cotizacion']." and id_orden_d=".$fila['id_orden_d']." ";
                         $ordenes = mysql_query($sq);
                         $fila211 = mysql_fetch_array($ordenes);
                         
                        $m1= $fila211["medida1"];
                        $m2= $fila211["medida2"];
                        $c= $fila211["cant_ordenada"];
                        $x= $fila211['estado_op'];
                 
                       if($x==1){
                       $r = $r +(($tt2/$fila['cantidad_c'])*$c);
                         $aluminio = $con->conectar();
                         $sq2 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']);
                         $aluminio = mysql_query($sq2);
                         $canfilas = mysql_num_rows($aluminio);
                         
                         $altura_ventana = $m2-$cuerpo;
                         $altura= $cuerpo;
                         $ttl =0; $total_vid=0;
                         
                                for ($j=0; $j<$canfilas; $j++){
                                    
                                    $fa = mysql_fetch_array($aluminio);
                          if($fa['signo']=='+'){
                if($fa['medida_r_a']==1){
                    $al = ($altura_ventana+$fa["descuento"])+ $fa['variable'];
                }else{
                    if($fa['medida_r_a']==2){
                    $al = ($altura+$fa["descuento"])+ $fa['variable'];
                }else{
                     if($fa['lado']!="Vertical"){
                $al = ($m1+$fa["descuento"])+ $fa['variable'];
            }else{
                $al = ($m2+$fa["descuento"])+ $fa['variable'];
            }
                }
                   
                }
                
            }else{
               if($fa['signo']=='-'){
                if($fa['medida_r_a']==1){
                    $al = ($altura_ventana+$fa["descuento"])- $fa['variable'];
                }else{
                    if($fa['medida_r_a']==2){
                    $al = ($altura+$fa["descuento"])- $fa['variable'];
                }else{
                       if($fa['lado']!="Vertical"){
                $al = ($m1+$fa["descuento"])- $fa['variable'];
            }else{
                $al = ($m2+$fa["descuento"])- $fa['variable'];
            }
                }
                 
                }
            }else{
                if($fa['signo']=='*'){
                  if($fa['medida_r_a']==1){
                    $al = ($altura_ventana+$fa["descuento"])* $fa['variable'];
                }else{
                     if($fa['medida_r_a']==2){
                    $al = ($altura+$fa["descuento"])* $fa['variable'];
                }else{
                    
                }
                    if($fa['lado']!="Vertical"){
                $al = ($m1+$fa["descuento"])* $fa['variable'];
            }else{
                $al = ($m2+$fa["descuento"])* $fa['variable'];
            }
                }
            }else{
                if($fa['signo']=='/'){
                if($fa['medida_r_a']==1){
                    $al = ($altura_ventana+$fa["descuento"])/ $fa['variable'];
                }else{
                    if($fa['medida_r_a']==2){
                    $al = ($altura+$fa["descuento"])/ $fa['variable'];
                }else{
                       if($fa['lado']!="Vertical"){
                $al = ($m1+$fa["descuento"])/ $fa['variable'];
            }else{
                $al = ($m2+$fa["descuento"])/ $fa['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            $mp = $fa["costo_mt"]/$filpor['p'];
            $n=10;
            if($tipo=='Fachada'){
            if($fa["lado"]=='Vertical'){
                if($_GET["d1"]== '1'){ 
                $d =$m1/($_GET['v']+1);
                $al5 = ($_GET['v']);
                }else{
                    $d=$_GET['v']+1; 
                $al5 = $m1/($_GET['v']+1);
               
                } $z = $d;
            }else{
                if($_GET["d1"]== '1'){
                    $d =$m2/($_GET['h']+1);
                    $al5 = ($_GET['h']); 
  
                }else{
                $d=$_GET['h']+1; 
                $al5 = $m2/($_GET['h']+1);
                }$z = $d;
            }
            }else{
                 if($fa['lado']=="Vertical"){
                $al5 = ($m2);
            }else{
                $al5 = ($m1);
            }
                $z = 0;}
        
           if($fa["lado"]=='Vertical'){$x = 'Alto';}else{$x = 'Ancho';}
            if($tipo=='Fachada'){
               $r = number_format($al5,0);
               $t ='<td class="hidden-phone">'.$r.'</td>';
               $cantidad= ceil($z+1);
               $d = ($cantidad*$fa["cantidad"])*$c;
               $m = $fa["cantidad"].' x ';
           }else{
               $t =''; $m ='';
               $cantidad= ceil($z+$fa["cantidad"]);
               $d = ($cantidad)*$c;
           }
           if($fa["descuento"]>=0){$s ='+';}else{$s = '';}
         $numero = (($d)*$al5)/$fa["medida"]; 
           $ttl = $ttl + ($al*$mp*(($d))/$n);
           
		        $pdf->Row(array($fa['referencia'], $fa['descripcion'], $fa['lado'], $fa['medida'], $cantidad , $d, number_format($numero,1,',','.'), $al,number_format(($al*$mp*(($d))/$n))));
                       
                        
                       }
                         }
                       $pdf->SetFont('Arial','I',6);

                $pdf->Cell(190,6,'TOTAL : $'.number_format($ttl),1,20,'R');
                       
                
                //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< VIDRIO >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                        $vidrio_por = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                        $fip =mysql_fetch_array(mysql_query($vidrio_por));
                        $porcv= $fip["p"]/100;

                        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$fila["id_vidrio"]."'";
                        $fi3 =mysql_fetch_array(mysql_query($s3));
                        $costo_vidrio= $fi3["costo_v"]/$porcv;
                
                         $vidrioan = $con->conectar();
                         $sq2 = ("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']);
                         $vidrioan = mysql_query($sq2);
                         $canfilasv = mysql_num_rows($vidrioan);
                         $ancho = $m1;
                         $alto = $m2;
                         $ttl =0;
                         

                                                  $pdf->Cell(190,6,'VIDRIOS ',1,20,'C');
$pdf->SetWidths(array(15, 60, 20, 15, 15, 15, 15, 15, 20));
$pdf->SetFont('Arial','I',6);
$pdf->Cell(8,0,'',0,20,'C');
$pdf->SetTextColor(0);
$pdf->Row(array('REF', 'DESCRIPCION DEL VIDRIO', 'ANCHO', 'ALTO', 'M2', 'CANT. U', 'C.TOTAL', 'MEDIDA', 'VLR. COSTO'));
                         $total_vid2=0;
                                for ($j=0; $j<$canfilasv; $j++){
                                    
                                    
                                    $row = mysql_fetch_array($vidrioan);
                                    
   
            
         $vidrio1 = $con->conectar();
          if($row["ancho_v"]==0){
               
                if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                      $al= $fila['medida1'];
                 }
            }else{
         $sq2 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$row["ancho_v"]."");
         $vidrio1 = mysql_query($sq2);
         $fil_an = mysql_fetch_array($vidrio1);
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
            if($fil_an['lado']=="Vertical"){
                $al2 = ($alto+$fil_an["descuento"]);
            }else{
                $al2 = ($ancho+$fil_an["descuento"]);
            }
            }
   
            if($row["alto_v"]==0){
                $al2= $fila['medida2'];
            
            }else{
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            
            if($fil_al['signo']=='+'){
                if($fil_al['medida_r_a']==1){
                    $al2 = ($altura_ventana+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                    if($fil_al['medida_r_a']==2){
                    $al2 = ($altura+$fil_al["descuento"])+ $fil_al['variable'];
                }else{
                     if($fil_al['lado']!="Vertical"){
                $al2 = ($ancho+$fil_al["descuento"])+ $fil_al['variable'];
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
            }else{
                $al2 = ($alto+$fil_al["descuento"])/ $fil_al['variable'];
            }
                }
                 
                }
            }
            }
            } 
            }
            if($fil_al['lado']=="Vertical"){
                $al3 = ($alto+$fil_al["descuento"]);
            }else{
                $al3 = ($ancho+$fil_al["descuento"]);
            }}
            if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysql_fetch_array(mysql_query($sqlx2));
  
            
            if($fil_an2['signo']=='+'){
                if($fil_an2['medida_r_a']==1){
                    $al22 = ($altura_v_c+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                    if($fil_an2['medida_r_a']==2){
                    $al22 = ($altura+$fil_an2["descuento"])+ $fil_an2['variable'];
                }else{
                     if($fil_an2['lado']!="Vertical"){
                $al22 = ($ancho+$fil_an2["descuento"])+ $fil_an2['variable'];
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
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysql_fetch_array(mysql_query($sqlw2));
            
              if($fil_al2['signo']=='+'){
                if($fil_al2['medida_r_a']==1){
                    $al2x = ($altura_v_c+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                    if($fil_al2['medida_r_a']==2){
                    $al2x = ($altura+$fil_al2["descuento"])+ $fil_al2['variable'];
                }else{
                     if($fil_al2['lado']!="Vertical"){
                $al2x = ($ancho+$fil_al2["descuento"])+ $fil_al2['variable'];
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
               
                $al2x = 0;
            }
             $tv = ($al + $row['var1']) / $row['divisor'];
             $tv2 = ($al2 + $row['var2']) / $row['divisor_alto'];
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
                $all = $tv2;
            }
            
        
            
            $m2 = ($an2/1000)*($all/1000);
            
           $total_vid2 = $total_vid2 + $m2*$costo_vidrio*$c;
           
     
		        $pdf->Row(array($row['referencia'], $row['descripcion'], number_format($an2), number_format($all), $m2 , $row["cantidad_v"], $row["cantidad_v"]*$c,$an2.'x'.$all, number_format($m2*$costo_vidrio*$c)));
           
                        
                       }
                       $pdf->SetFont('Arial','I',6);

                $pdf->Cell(190,6,'TOTAL : $'.number_format($total_vid2),1,20,'R');
                
                //------------------------------------------------rejilas----------------------------------------------------
                $per_por = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='MP' and grupo='Perfiles' ";
                        $fiper =mysql_fetch_array(mysql_query($per_por));
                        $porcper= $fiper["p"]/100;
                        
                        $rejillas = $con->conectar();
                         $sq2r = ("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']);
                         $rejillas = mysql_query($sq2r);
                         $canrej = mysql_num_rows($rejillas);
                         
                            $pdf->Cell(190,6,'REJILLAS ',1,20,'C');
                            $pdf->SetWidths(array(15, 60, 20, 15, 15, 15, 15));
                            $pdf->SetFont('Arial','I',6);
                            $pdf->Cell(8,0,'',0,20,'C');
                            $pdf->SetTextColor(0);
                            $pdf->Row(array('REF', 'DESCRIPCION DE LA REJILLA', 'PERFIL', 'MEDIDA', 'CANT. REJ', 'MEDIDA', 'VLR. COSTO'));
                            $xx = 0;
                              for ($j=0; $j<$canrej; $j++){
                                   $row = mysql_fetch_array($rejillas);
                                               $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$row["id_referencia_med"]."");
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
       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
	{

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$col["ancho_v"]."");
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
              if($row["medida_rej"]==0){
                $medrej = $ancho + $row["varr"]; 
            }else{
                $medrej = $tvR + $row["varr"]; 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
          
            $tv2 = $al / $row['var3'];
            $numero = ($medrej*$tv2)/$row["medida"];
             $xx = $xx + (($medrej*$tv2*$row["costo_mt"])*$c/1000);
              $pdf->Row(array($fa['referencia'], $fa['descripcion'],  $fa['medida'], number_format($medrej) , number_format($tv2), number_format($numero,1,',','.'), number_format($medrej*$tv2*$row["costo_mt"]*$c/1000)));
                       
                                    
                              }
                              $pdf->SetFont('Arial','I',6);

                $pdf->Cell(190,6,'TOTAL : $'.number_format($xx),1,20,'R');
                
                
                //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<ACCESORIOS>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                   $vidrio_por = "SELECT (".$fila["porcentaje"].") as p FROM porcentajes where area_por='Vidrio'";
                        $fip =mysql_fetch_array(mysql_query($vidrio_por));
                        $porcv= $fip["p"]/100;

                        $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$fila["id_vidrio"]."'";
                        $fi3 =mysql_fetch_array(mysql_query($s3));
                        $costo_vidrio= $fi3["costo_v"]/$porcv;
                
                         $accesorios = $con->conectar();
                         $sq2 = ("SELECT * FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']);
                         $accesorios = mysql_query($sq2);
                         $canacc = mysql_num_rows($accesorios);
                     
                $pdf->Cell(190,6,'ACCESORIOS ',1,20,'C');
$pdf->SetWidths(array(15, 60, 20, 15, 15, 15, 15, 15, 20));
$pdf->SetFont('Arial','I',6);
$pdf->Cell(8,0,'',0,20,'C');
$pdf->SetTextColor(0);
$pdf->Row(array('REF', 'DESCRIPCION DEL ACCESORIO', 'COLOR', 'LADO', 'CANT', 'PARA', 'C.TOTAL', '$ Fabr.', 'VLR. COSTO'));
                          $total2=0;
        $tac = 0;
                                for ($j=0; $j<$canacc; $j++){
                                    
                                    
                                    $row = mysql_fetch_array($accesorios);
         //--------------------------------------------------------------------
                        if($row['can_rej']!=0){
    $request_v2=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysql_fetch_array($request_v2))
{
$sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$fila['id_p']." and b.id_r_a=".$rowz["id_referencia_med"]."");
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
                         $res = ($row["cantidad_acc"]*$ancho) / $row["metro"];
                     }         
                 }else{
                      $res = $row["cantidad_acc"];
                 }
            }else{      
             if($row['calcular']=='ML'){
               $rs = $fila["hojas"] * 2 * $row["cantidad_acc"];
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
                 $f = ''.number_format(($taa*$c)*$m).' ML';
                 $ft = $f * $row["valor_f"] ;$a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.number_format($taa*$c).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
            $tac = (($taa*$c*$m)*$row["costo_mt"]) + $tac + $a;
           
     
		        $pdf->Row(array($row['referencia'], $row['descripcion'], $row["color_acc"], $row["lado"],$taa.' '.$row["calcular"] , $row["para"],$f,$ft, number_format($taa*$c*$row["costo_mt"]*$m + $a)));
           
                        
                       }
                       $pdf->SetFont('Arial','I',6);

                $pdf->Cell(190,6,'TOTAL : $'.number_format($tac),1,20,'R');
                
                       }
		}
                //vidrios
  
                $pdf->Output();
