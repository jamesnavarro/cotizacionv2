<?php
require('../fpdf153/fpdf.php');
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
function textIntoCols($strOriginal,$noCols,$pdf) 
{ 
    $iAlturaRow = 2; //Altura entre renglones 
    $iMaxCharRow = 259; //Número máximo de caracteres por renglón 
    $iSizeMultiCell = $iMaxCharRow / $noCols; //Tamaño ancho para la columna 
    $iTotalCharMax = 15000; //Número máximo de caracteres por página 
    $iCharPerCol = $iTotalCharMax / $noCols; //Caracteres por Columna 
    $iCharPerCol = $iCharPerCol - 290; //Ajustamos el tamaño aproximado real del número de caracteres por columna 
    $iLenghtStrOriginal = strlen($strOriginal); //Tamaño de la cadena original 
    $iPosStr = 0; // Variable de la posición para la extracción de la cadena. 
    // get current X and Y 
    $start_x = $pdf->GetX(); //Posición Actual eje X 
    $start_y = $pdf->GetY(); //Posición Actual eje Y 
    $cont = 0; 
    while($iLenghtStrOriginal > $iPosStr) // Mientras la posición sea menor al tamaño total de la cadena entonces imprime 
    { 
        $strCur = substr($strOriginal,$iPosStr,$iCharPerCol);//Obtener la cadena actual a pintar 
        if($cont != 0) //Evaluamos que no sea la primera columna 
        { 
            // seteamos a X y Y, siendo el nuevo valor para X 
            // el largo de la multicelda por el número de la columna actual, 
            // más 10 que sumamos de separación entre multiceldas 
            $pdf->SetXY(($iSizeMultiCell*$cont)+10,$start_y); //Calculamos donde iniciará la siguiente columna 
        } 
        $pdf->MultiCell($iSizeMultiCell,$iAlturaRow,$strCur); //Pintamos la multicelda actual 
        $iPosStr = $iPosStr + $iCharPerCol; //Posicion actual de inicio para extracción de la cadena 
        $cont++; //Para el control de las columnas 
    }     
    return $pdf; 
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
        
         $strConsulta3 = "select * from cont_terceros  where id_ter=".$fila3['id_tercero']."";
	$empresa = mysql_query($strConsulta3);
	$filae = mysql_fetch_array($empresa);
        $nombre = $filae['nom_ter'];
        $documento =$filae['cod_ter'];
        $telefono =$filae['telfijo_ter'];
        $direccion =$filae['dir_ter'];
        if($fila3['orden']=='0'){$abc = 'COTIZACION No. : ';  $num = $fila3['numero_cotizacion'].'- V.'.$fila3['version'];}else{$abc = 'PEDIDO No. :';$num = $fila3['orden'];}
        
	$this->Image('../imagenes/templado.jpg',235,5,30);
	
	$this->SetFont('Arial','B',6);
	// Movernos a la derecha
	$this->Cell(-1);
	$this->Cell(259,-5,'ClIENTE         '.utf8_decode($nombre),0,30,'L');
        $this->Cell(209,10,'C.C o NIT       '.$documento,0,30,'L');
        $this->Cell(209,-5,'OBRA            '.$fila3['obra'],0,30,'L');
        $this->Cell(209,10,'DIRECCION   '.$fila3['ubicacion'],0,30,'L');
        $this->Cell(209,-5,'TELEFONO   '.$fila3['tel_responsable'],0,30,'L');
        $this->Cell(259,10,'CONTACTO  '.$fila3['responsable'],0,30,'L');
        
        $this->Cell(150,-35,$abc.'',0,0,'R');
        $this->Cell(15,-35,$num,0,0,'L');
        $this->Cell(-15,-30,'ASESOR : ',0,0,'R');
        $this->Cell(15,-30,$fila3['registrado'],0,0,'L');
        $this->Cell(-15,-25,'VALIDEZ OFERTA:',0,0,'R');
        $this->Cell(15,-25,'120 dias ',0,0,'L');
        $this->Cell(-15,-20,'FORMA DE PAGO :',0,0,'R');
        $this->Cell(15,-20,'50% anticipo, 30% de entrega de material, 20% contraentrega',0,0,'L');

	// Salto de l�nea
	$this->Ln(1);
        $this->SetFont('Arial','B',6);
	// Movernos a la derecha
	$this->Cell(-1);
	// T�tulo
	$this->Cell(259,5,'    TIPO   | DESCRIPCION                                                                             |   UBICACION                           | MEDIDAS               | ALUM             | VIDRIO                                     | DISENO                                                                     | CANT         | VLR. UND      |  TOTAL',1,10);
       
        $this->Ln(1);
        
        $historial1 = $con->conectar();
	$strConsulta1 = "SELECT * FROM producto a,  cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio and c.id_referencia=a.id_p and c.id_cot=".$_GET['imp']."";
	$historial1 = mysql_query($strConsulta1);
	$numfilas1 = mysql_num_rows($historial1);
        $t3=14;$c=0;
        $v = $this->PageNo();
        if($v < 2){$a = 1; $b = 177; $c=0;}
        if($v == 2){$a = 178; $b = 338;$c=160;}
        if($v == 3){$a = 339; $b = 500;$c=320;}
        if($v == 4){$a = 501; $b = 662;$c=420;}
        
//        if($v < 2){$a = 1; $b = 163; $c=0;}
//        if($v == 2){$a = 164; $b = 293;$c=122;}
//        if($v == 3){$a = 294; $b = 422;$c=248;}
        for ($i=0; $i<$numfilas1; $i++){
            $fila1 = mysql_fetch_array($historial1);
             
             $c = $c + 1 ;
             
            $t3 = $t3 + 27;
             if($t3 > $a && $t3 <= $b){
                 
             if($fila1['ruta']==''){
                             $this->Image('../producto/no.jpg' ,200 ,$t3-$c, 15 , 15,'JPG');
                            
                        }else{
                              $this->Image('../producto/'.$fila1['ruta'] ,200 ,$t3-$c, 15 , 15,'PNG');
                             
                        }}
                    
        }
        
}

// Pie de p�gina
function Footer()
{
	// Posici�n: a 1,5 cm del final
	$this->SetY(-10);
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
$pdf = new PDF('L','mm','Letter');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetWidths(array(10, 62, 30, 20, 15, 30, 50, 12, 15, 15));

	$pdf->SetFont('Arial','I',6);

	$pdf->Cell(8,0,'',0,20,'C');
	$pdf->SetFillColor(230,230,230);
        $pdf->SetTextColor(0);
//                $pdf->Row(array('TIPO', 'DESCRIPCION', 'UBICACION', 'MEDIDAS', 'ALUM', 'VIDRIO', 'DISENO', 'CANT', 'VLR. UND', 'TOTAL'));
//                        $pdf->Row(array('TIPO', 'PRODUCTO', 'UBICACION', 'MEDIDAS', 'ALUM', 'VIDRIO', 'DISEÑO', 'CANT', 'VLR. UND', 'VLR. TOTAL'));
                        
	$historial = $con->conectar();

	$strConsulta = "SELECT *, CONCAT(a.producto) as pro FROM producto a,  cotizaciones c, tipo_vidrio d where d.id_vidrio=c.id_vidrio  and c.id_referencia=a.id_p and c.id_cot=".$_GET['imp']."";
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	$t =32;
        $total = 0;
       
	for ($i=0; $i<$numfilas; $i++)
		{
                         $pdf->Cell(-1);
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
                        $total = $total + $tt + $dt;
                        $tt2 = $tt + $dt;
                        if($fila['ruta']==''){
                             $im = '';
                        }else{
                             $im = '';
                        }
                       
		        $pdf->Row(array($fila['id_p'], $fila['pro'], $fila['ubicacion_c'], $fila['ancho_c'].'x'.$fila['alto_c'], $fila['color_ta'], $fila['color_v'].'('.$fila['espesor_v'].'mm)', $im, $fila['cantidad_c'].' Und', number_format($tt2/$fila['cantidad_c']), number_format($tt2)));
			
		}
                $pdf->SetFont('Arial','I',10);
                $pdf->cell(-1);
                $pdf->ln(5);
	        $pdf->Cell(259,5,'SUBTOTAL : $'.number_format($total),1,35,'R');
                $iva = $total *0.16;
                $pdf->Cell(259,5,'IVA 16% : $'.number_format($iva),1,20,'R');
                $pdf->Cell(259,7,'TOTAL : $'.number_format($total+$iva),1,20,'R');
                $pdf->Ln(5);
                $pdf->SetFont('Arial','I',6);
                $textos = 'POLITICAS DE VENTA TEMPLADO S.A.
Los pedidos de vidrio tienen un plazo de (4) días hábiles para su entrega. El día sábado no es tenido en cuenta como día hábil. Cuando el pedido tiene un servicio adicional de esmeril, huacal o instalación la fecha de entrega es de 5 días hábiles.
Los vidrios biselados y los de 19mm tienen un plazo de entrega de 6 días hábiles. 
El servicio de temple, perforación, borde pulido y brillado u otros servicios que se ofrece a vidrios propios de clientes exclusivos, tendrá un plazo  de cuatro (4) días hábiles para su proceso. 
El servicio express que prestamos a los clientes es solo para vidrios rectos de espesor de 6mm, 8mm y 10mm, que no lleven algún maquinado especial y una cantidad máxima de 15 vidrios, la fecha de entrega es de 36 horas a partir del momento que ingresa la orden de producción si lleva un servicio adicional de esmeril o huacal cuenta 1 día mas para su entrega.
Los vidrios propios traídos a las instalaciones de Templado S.A para los servicios de Temple, borde pulido y brillados, perforaciones u otros servicios, Templado S.A no se hace responsable por roturas que se presenten en el proceso del vidrio.
La medida mínima de temple es 300 x 300 mm, y la máxima de 2050 x 3300 mm. 
Las medidas de los vidrios se manejan con una tolerancia de + 2mm o - 2mm.
El día numero uno (1) del proceso será el mismo día si la orden de producción ingresa antes de las 11:00 a.m. de lo contrario se comenzará a contar a partir del siguiente día hábil.
Cuando se soliciten modificaciones a los pedidos que ya están en producción, se debe tener presente que sólo se efectuarán reformas en medidas antes de que el(los) vidrio(s) sean cortados, y cambios en maquinado (perforaciones y boquetes) antes de que pasen por estos procesos. De lo contrario serán facturados los vidrios hasta donde se haya efectuado el proceso productivo o en su defecto será cobrado el servicio adicional que necesite para ello. IMPORTANTE: De ser posible algún cambio sobre el pedido, el tiempo de entrega se prolonga 2 días automáticamente.
Únicamente se entregan pedidos totalmente TERMINADOS. Cuando el pedido esté listo se le informará al cliente para que se acerque a la empresa y reclame su pedido o se le informará cuando se le va ha despachar o instalar.
El procedimiento de entrega de pedidos se hará en el orden de llegada de los clientes. 
Templado S.A se hace responsable del producto terminado hasta su entrega, por tanto es de vital importancia que el cliente inspeccione muy bien los vidrios al momento de recibirlos.
Cualquier reclamo por rayas o escarchas sólo se acepta al momento de la recepción de los pedidos. Para reclamos de otro tipo (perforaciones, boquetes o medidas) se otorga un plazo máximo de 30 días (contados a partir de la fecha de entrega del pedido). Para hacer efectivo el reclamo, el cliente debe devolver el producto No conforme, a las instalaciones de TEMPLADO S.A para verificar el problema descrito. 

CONDICIONES DE ENTREGA Y GARANTIAS EN EL PRODUCTO

El personal del área de Servicio al Cliente, informará telefónicamente al cliente que su pedido esta terminado.
Los horarios de atención al público para la entrega de pedidos es:
Lunes a Viernes de 7:30 a 11:30 a.m. y de 2:00pm a 5:30 p.m.
Sábados de 7:30 a.m. a 12:30 p.m.
El cliente antes de recoger su pedido deberá comunicarse con nuestro personal de “cartera” para consultar el saldo y cancelarlo en las instalaciones o consignar en la cuenta de la empresa. 
BANCO	TIPO DE CUENTA	No. DE CUENTA
BANCO DE BOGOTA	Cuenta Corriente	173065434
Para retirar los pedidos de la Empresa estos deben estar totalmente cancelados, cuando el pedido lleva instalación debe cancelar un 50% de anticipo, el 30% cuando el pedido este listo y el 20% cuando reciba el producto a satisfacción.
El tiempo de entrega de materiales instalados en obras serán acordados después de haber entregado el anticipo y pactadas medidas de vanos. Estos se realizarán  en comités internos realizados por el supervisor de la obra de TEMPLADO S.A y el residente de obra de la firma contratante, teniendo en cuenta para esto el material a utilizar y adelantos de la obra. Las medidas que no sean pactadas en el acta de vanos inicial tendrán otra fecha de entrega  a la inicial.
En la bodega de Almacenamiento y Despachos, el cliente debe revisar uno a uno los vidrios teniendo en cuenta los acabados, las medidas y el número de vidrios según el pedido. Finalizada esta operación el cliente firma como constancia de la entrega y se autoriza la salida del vehículo.
Cuando TEMPLADO S.A  entrega en las instalaciones del cliente, la entrega de la mercancía es en plataforma, es decir, en el vehículo, razón por la cual el cliente debe disponer del personal para el descargue y por ende asume toda responsabilidad de cualquier daño ocasionado sobre el producto durante este proceso. El conductor del vehículo no está autorizado para participar en el descargue.
Cuando TEMPLADO S.A anuncia el envío de los pedidos, no se especificará la hora de envío ni de llegada del mismo, sólo se anunciará la fecha del despacho. 
Ofrecemos garantía por rayas, manchas o escarchas, sólo al momento de la recepción del pedido. Para efectos de garantía garantía, el cliente debe revisar la totalidad del pedido y los defectos deben ser identificados en el momento mismo del descargue e informarlo al conductor inmediatamente, dejando constancia escrita sobre la factura, identificando claramente el ítem a devolver. Dichos vidrios se entregan inmediatamente al conductor. Una vez efectuada la entrega y firmado el recibo por parte del cliente, no se aceptaran reclamos por causas que no hallan sido reportado oportunamente durante el descargue.
Las ventanas o vidrios protegidos con película (Polimax) tienen una caducidad de 4 meses, debido a que los factores ambientales afectan la protección de los rayos uv, ademas la adherencia del pegante ocasiona dificultad al momento de retirarla. Transcurrido este tiempo es responsabilidad de la obra el retiro de la película. 
Cuando en la entrega se identifiquen vidrios pendientes, estos se deben reportar inmediatamente en las instalaciones de TEMPLADO S.A al área de servicio al cliente y se debe registrar en el documento entregado por el conductor del vehículo (Factura o Remisión). De no reportase y no aparecer registrados en el documento, TEMPLADO S.A no se hará responsable por el producto y la reposición del mismo correrá a cargo del cliente.
La fecha límite de almacenamiento del vidrio dentro de las bodegas de TEMPLADO S.A es máximo quince (15) días hábiles después de anunciada la mercancía al cliente, vencida esta fecha TEMPLADO S.A no asume daños ocasionados en el vidrio.
El tiempo de garantía que ofrece TEMPLADO S.A para el servicio de instalación y para los accesorios que maneja en estas instalaciones es de 6 meses.
El tiempo de garantía en los espejos es de 3 meses a partir de la fecha de instalación o recibo del mismo.
La garantía sobre los productos que ofrecemos en Carpintería Metálica es de 12 meses a partir de la fecha de instalación.
Las garantías no serán valida cuando el uso, cuidado y operación del producto no haya sido el apropiado, si el producto ha sido usado fuera de su capacidad, maltratado, golpeado, expuesto a la humedad, mojado por algún liquido o sustancia corrosiva, así como por cualquier otra falla atribuible al consumidor, cuando el producto haya sido desarmado, modificado o reparado por personas no autorizadas por TEMPLADO S.A o si la falla es originada por el desgaste normal de la pieza debido al uso.
';
                $pdf->textIntoCols(utf8_decode($textos),1,$pdf); 
                $pdf->Output();
                
