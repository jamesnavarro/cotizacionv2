<?php
require('../fpdf_1.php');
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
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		
		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,5,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
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
	// Logo
	$this->Image('../imagenes/templado.png',12,10,33);
	// Arial bold 15
	$this->SetFont('Arial','B',12);
	// Movernos a la derecha
	$this->Cell(1);
	// T�tulo
	$this->Cell(190,32,'Cotizacion No. 000001',1,5,'L');
        $this->Cell(190,10,'Cliente',1,10);
	// Salto de l�nea
	$this->Ln(10);
}

// Pie de p�gina
function Footer()
{
	// Posici�n: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// N�mero de p�gina
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetWidths(array(15, 20, 70, 20, 15, 20, 20, 20));
	$pdf->SetFont('Arial','I',6);
	$pdf->Cell(0,0,'',0,30,'C');
	$pdf->SetFillColor(230,230,230);
        $pdf->SetTextColor(0);
        for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('ITEMS.', 'CODIGO', 'DESCRIPCION', 'REFERENCIA', 'MEDIDA.', 'GRUPO', 'PRECIO'));
			}
                        
	$historial = $con->conectar();

	$strConsulta = "select * from referencias group by descripcion";
	
	$historial = mysqli_query($conexion,$strConsulta);
	$numfilas = mysqli_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysqli_fetch_array($historial);
			$pdf->SetFont('Arial','I',0);
			
			
		        $pdf->SetFillColor(255,255,255);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['id_referencia'], $fila['codigo'], $fila['descripcion'], $fila['referencia'], $fila['medida'], $fila['grupo'], number_format($fila['costo_mt'])));
			
		}
	
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
	$pdf->Cell(0,10,'Imprimiendo linea numero '.$i,0,1);
$pdf->Output();
?>
