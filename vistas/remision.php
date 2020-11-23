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
        $strConsulta3 = "select * from cotizacion  where id_cot='".$_GET['cot']."'";
	$pacientes3 = mysqli_query($conexion,$strConsulta3);
	$fila3 = mysqli_fetch_array($pacientes3);
        
        if($fila3['tipo']=='Empresarial'){
            $empresa = $con->conectar();	
        $strConsulta3 = "select * from sis_empresa  where id_empresa=".$fila3['id_cliente']."";
	$empresa = mysqli_query($conexion,$strConsulta3);
	$filae = mysqli_fetch_array($empresa);
        $nombre = $filae['nombre_emp'];
        $documento =$filae['nit_emp'];
        $telefono =$filae['tel_oficina_emp'];
        $direccion =$filae['direccionr_emp'];
        }else{
            $personal = $con->conectar();	
        $strConsultap = "select * from sis_contacto  where id_contacto=".$fila3['id_cliente']."";
	$personal = mysqli_query($conexion,$strConsultap);
	$filae = mysqli_fetch_array($personal);
        $nombre = $filae['nombre_cont'].' '.$filae['apellido_cont'];
        $documento =$filae['cedula_cont'];
        $telefono =$filae['tel_oficina'];
        $direccion =$filae['direccionf'];
        }
        
        $op = $con->conectar();	
        $strConsulta3 = "select * from facturas  where id_factura='".$_GET['rem']."'";
	$op = mysqli_query($conexion,$strConsulta3);
	$filaop = mysqli_fetch_array($op);

	$this->SetFont('Arial','B',8);
	// Movernos a la derecha
	$this->Cell(1);
	// T�tulo
	$this->Cell(10,0,'TEMPLADO S.A  (800112904-6)',0,30);
        $this->Cell(170,8,'REMISION No.' .$_GET['rem'] ,10,30,'R');
        $this->Cell(10,0,'CLIENTE : '. $nombre,10,30);
        $this->Cell(170,0,'PEDIDO No. : '.$_GET['ped'],10,30,'R');
        $this->Cell(10,8,'C.C/NIT: '. $documento,10,30);
         $this->Cell(10,0,'OBSERVACIONES : '.$filaop['detalle'],10,30);
         $this->Cell(10,8,'REGISTRO : '.$filaop['fecha_registro'],10,30);
         $this->Cell(10,0,'UBICACION : '.$fila3['ubicacion'],10,30);

	// Salto de l�nea
	$this->Ln(1);
        $this->SetFont('Arial','B',6);
	// Movernos a la derecha
	$this->Cell(-1);
	// T�tulo
	
        $this->Ln(1);
        
        $historial1 = $con->conectar();
	$strConsulta1 = "SELECT * FROM producto a,  cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and c.id_cot=".$_GET['cot']."";
	$historial1 = mysqli_query($conexion,$strConsulta1);
	$numfilas1 = mysqli_num_rows($historial1);
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

	$strConsulta = "SELECT *, (a.producto) as prod, (e.codigo) as co, (e.id_op) as pedido FROM producto a, cotizaciones c, tipo_vidrio d, orden_detalle e, procesos_activos f, pa_remisionados h, facturas g where f.barra=h.barra and g.id_factura=h.factura and g.id_factura=".$_GET['rem']." and f.id_op=".$_GET['cot']." and f.id_orden_d=e.id_orden_d and e.id_producto=a.id_p and c.estado_c='Pedido' and f.estado='Remisionar' and d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p  and c.id_cot=f.id_op group by h.id_pa_rem ";
	
	$historial = mysqli_query($conexion,$strConsulta);
	$numfilas = mysqli_num_rows($historial);
	$t =32;
        $total = 0;
        $r=0;
        $ta2=0;
	for ($i=0; $i<$numfilas; $i++)
		{
            
                        $t = $t + 22;
			$fila = mysqli_fetch_array($historial);
			$pdf->SetFont('Arial','I',0);
			
			
		        $pdf->SetFillColor(255, 255, 255);
    			$pdf->SetTextColor(0);
                        
                        $porcentaje = $con->conectar();	
        
                              if($fila["linea_cot"]=='Aluminio'){
                $s = "SELECT (".$fila["porcentaje_mp"].") as p FROM porcentajes where area_por='Aluminio'";
                 $porcentaje = mysqli_query($conexion,$s);
                        $filpor = mysqli_fetch_array($porcentaje);
            }else{
               if($fila["linea_cot"]=='Vidrio'){
                $s = "SELECT (".$fila["porcentaje_mp"].") as p FROM porcentajes where area_por='Vidrio'";
                $porcentaje = mysqli_query($conexion,$s);
                        $filpor = mysqli_fetch_array($porcentaje);
               }else{
                if($fila["linea_cot"]=='Fachada'){
                $s = "SELECT (".$fila["porcentaje_mp"].") as p FROM porcentajes where area_por='Fachada'";
               $porcentaje = mysqli_query($conexion,$s);
                        $filpor = mysqli_fetch_array($porcentaje);
               }else{
                $s = "SELECT (".$fila["porcentaje_mp"].") as p FROM porcentajes where area_por='Acero'";
                $porcentaje = mysqli_query($conexion,$s);
                        $filpor = mysqli_fetch_array($porcentaje);
              }
              } 
            }
//                        $ds = $fila['desc'] /100;
//                        $tt = ($fila['valor_c']/($filpor['p']/100)) + $fila['precio_adicional'] + $fila['precio_material'];
//                        
//                        $dt = $tt * $ds;
//                        $total = $total + $tt - $dt;
//                        $tt2 = $tt - $dt;
                        //////////////////////////////////////////////
                        $mult2= $filpor['p']/100;
                        $suma2 = $fila["valor_c"];
                        $a = $suma2 / $mult2;
                        $b = $a + $fila["precio_adicional"]+$fila["precio_material"];
                        $descpor = $b *$fila["desc"]/100;
                        $b = $b - $descpor;
                        $pu = ($b)/$fila["cantidad_c"];
                        $ct = $pu *  $fila['cantidad_despachada'];
                        $ta2 = $ta2 + $ct;
            
            /////////////////////////////////////////
                      
                        $ordenes = $con->conectar();
                         $sq = "SELECT * FROM orden_detalle where codigo=".$fila['co']." and relacionado=".$fila['id_cotizacion']." and id_orden_d=".$fila['id_orden_d']." ";
                         $ordenes = mysqli_query($conexion,$sq);
                         $fila211 = mysqli_fetch_array($ordenes);
                        $m1= $fila211["medida1"];
                        $m2= $fila211["medida2"];
                        $c= $fila211["cant_ordenada"];
                        $x= $fila211['estado_op'];
                       if($x==1){
                           
		        $pdf->Row(array($fila['referencia_p'], $fila['prod'], $m1.'x'.$m2, $fila['color_ta'], $fila['color_v'].'('.$fila['espesor_v'].'mm)', $fila['cantidad_despachada'].' Und', number_format($pu), number_format($ct)));
                       }
		}
                $pdf->SetFont('Arial','I',6);
                 $ni = $ta2 * 0.16;
                 $gt = ($ta2 + $ni);

                $pdf->Cell(190,6,'SUBTOTAL : $'.number_format($ta2),1,20,'R');
                $pdf->Cell(190,6,'IVA 16% : $'.number_format($ni),1,20,'R');
                $pdf->Cell(190,6,'TOTAL : $'.number_format($gt),1,20,'R');

                
        

        

                //vidrios
                
                $pdf->Output();