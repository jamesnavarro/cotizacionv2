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
	$wmax=($w-2*$this->cMargin)*800/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=2;
	$i=0;
	$j=0;
	$l=0;
	$nl=6;
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
	return $nl-3;
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
        
        
	$this->Image('../imagenes/templado.png',8,12,40);
	
	$this->SetFont('Arial','B',6);
	// Movernos a la derecha
	$this->Cell(5);
	// T�tulo
	$this->Cell(270,30,'               NIT. 800112904-6',1,30,'L');
       $this->Cell(210,-50,'ClIENTE :',0,0,'C');
        $this->Cell(-180,-50,''.$nombre.'',0,0,'C');
         $this->Cell(155,-45,'C.C/NIT :',0,0,'C');
        $this->Cell(-130,-45,''.$documento.'',0,0,'C');
        $this->Cell(103,-40,'OBRA : ',0,0,'C');
        $this->Cell(-75,-40,''.$fila3['obra'].'',0,0,'C');
        $this->Cell(41,-35,'DIRECCION : ',0,0,'C');
        $this->Cell(-5,-35,''.$fila3['ubicacion'].'',0,0,'C');
        $this->Cell(-30.5,-30,'TELEFONO : ',0,0,'C');
        $this->Cell(65,-30,''.$fila3['tel_responsable'].'',0,0,'C');
        if($fila3['orden']=='0'){$abc = 'COTIZACION No. :';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PEDIDO No. :';$num = $fila3['orden'];}
        $this->Cell(80,-50,' ',0,0,'C');
        $this->Cell(-50,-50,$abc.''.$num.'',0,0,'C');
         $this->Cell(30,-45,'FECHA : ',0,0,'C');
         $this->Cell(1,-45,''.$fila3['fecha_reg_c'].'',0,0,'C');
         $this->Cell(-34,-40,'ASESOR : ',0,0,'C');
         $this->Cell(65,-40,''.$fila3['registrado'].'',0,0,'C');
         $this->Cell(-105,-35,'VALIDEZ OFERTA :',0,0,'C');
         $this->Cell(140,-35,'120 dias ',0,0,'C');
         $this->Cell(-175,-30,'FORMA DE PAGO :',0,0,'C');
         $this->Cell(262,-30,'50% anticipo, 30% de entrega de material, 20% contraentrega',0,0,'C');
	// Salto de l�nea
	$this->Ln(1);
        $this->SetFont('Arial','B',6);
	// Movernos a la derecha
	$this->Cell(-1);
	// T�tulo
	$this->Cell(282,5,'    TIPO            | DESCRIPCION                                                                           |   UBICACION                                            | MEDIDAS               | ALUM              | VIDRIO                                    | DISENO                                                                     | CANT     | VLR. UND               |  TOTAL',1,30);
       
        $this->Ln(1);
        
        $historial1 = $con->conectar();
	$strConsulta1 = "SELECT * FROM producto a,  cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio and c.id_referencia=a.id_p and c.id_cot=".$_GET['imp']."";
	$historial1 = mysql_query($strConsulta1);
	$numfilas1 = mysql_num_rows($historial1);
        $t3=32;$c=0;
        $v = $this->PageNo();
        if($v < 2){$a = 1; $b = 163; $c=0;}
        if($v == 2){$a = 164; $b = 293;$c=122;}
        if($v == 3){$a = 294; $b = 422;$c=248;}
        for ($i=0; $i<$numfilas1; $i++){
            $fila1 = mysql_fetch_array($historial1);
             
             $c = $c + 1 ;
             
            $t3 = $t3 + 26;
             if($t3 > $a && $t3 <= $b){
                 
             if($fila1['ruta']==''){
                             $this->Image('../producto/no.jpg' ,205 ,$t3-$c, 10 , 10,'JPG');
                            
                        }else{
                              $this->Image('../producto/'.$fila1['ruta'] ,205 ,$t3-$c, 10 , 10,'PNG');
                             
                        }}
                    
        }
        
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
        $this->Cell(-280,10,'BARRANQUILLA-COLOMBIA',0,0,'C');
        $this->Cell(280,15,'www.templadosa.com - ventas@templadosa.com',0,0,'C');
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creaci�n del objeto de la clase heredada
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetWidths(array(15, 60, 40, 20, 15, 30, 50, 10, 20, 20));

	$pdf->SetFont('Arial','I',6);

	$pdf->Cell(8,0,'',0,20,'C');
	$pdf->SetFillColor(230,230,230);
        $pdf->SetTextColor(0);
//                $pdf->Row(array('TIPO', 'DESCRIPCION', 'UBICACION', 'MEDIDAS', 'ALUM', 'VIDRIO', 'DISENO', 'CANT', 'VLR. UND', 'TOTAL'));
//                        $pdf->Row(array('TIPO', 'PRODUCTO', 'UBICACION', 'MEDIDAS', 'ALUM', 'VIDRIO', 'DISEÑO', 'CANT', 'VLR. UND', 'VLR. TOTAL'));
                        
	$historial = $con->conectar();

	$strConsulta = "SELECT *, CONCAT(a.producto, ', Obs: ', c.observaciones ) as pro FROM producto a,  cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and c.id_cot=".$_GET['imp']."";
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	$t =32;
        $total = 0;
       
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
                       
                        $ds = $fila['desc'] /100;
                        $tt = ($fila['valor_c']/($filpor['p']/100)) + $fila['precio_adicional'] + $fila['precio_material'];
                        
                        $dt = $tt * $ds;
                        $total = $total + $tt - $dt;
                        $tt2 = $tt - $dt;
                        if($fila['ruta']==''){
                             $im = '';
                        }else{
                             $im = '';
                        }
                       
		        $pdf->Row(array($fila['id_p'], $fila['pro'], $fila['ubicacion_c'], $fila['ancho_c'].'x'.$fila['alto_c'], $fila['color_ta'], $fila['color_v'].'('.$fila['espesor_v'].'mm)', $im, $fila['cantidad_c'].' Und', number_format($tt2/$fila['cantidad_c']), number_format($tt2)));
			
		}
                $pdf->SetFont('Arial','I',10);
	        $pdf->Cell(280,10,'SUBTOTAL : $'.number_format($total),1,20,'R');
                $iva = $total *0.16;
                $pdf->Cell(280,10,'IVA 16% : $'.number_format($iva),1,20,'R');
                $pdf->Cell(280,10,'TOTAL : $'.number_format($total+$iva),1,20,'R');
                $pdf->Output();
