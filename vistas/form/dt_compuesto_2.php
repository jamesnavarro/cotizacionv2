<?php            
        $alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
        $fia =mysqli_fetch_array(mysqli_query($conexion,$alum_por));
        $porca= $fia["p"]/100;
        $requestX=mysqli_query($conexion,"SELECT * FROM desgloses a, referencias b where a.id_referencia=b.id_referencia and a.id_producto=".$_GET['ref']." ");

        if($requestX){
        $tac4 =$tac3;

	while($row=mysqli_fetch_array($requestX))
	{    
             $tac4 +=1; 
            if($row['lado']=='Horizontal'){
                if($row['medida_des']==3){$med = $anchura;}
                if($row['medida_des']==4){$med = $anchura_v_c;}
                if($row['medida_des']==6){$med = $_GET['ancho'];}
            
            }else{
                if($row['medida_des']==1){$med = $altura;}
                if($row['medida_des']==2){$med = $altura_v_c;}
                if($row['medida_des']==5){$med = $_GET['alto'];}
            }
            //comprobar se es anonisado 
            
            $texto2   = 'ANODIZADO';
            $anonizado = strrpos($color, $texto2);
            if ($anonizado === false) {
                $var = 7100;
            }ELSE{
                $var = 6300;
            }
            //fin de conprobar anonizado
            
            if($med>$var){
                $dec = intval($med / $var);
               $lon = $var;
               $can_seg2 = round($med /$lon);
               
               $cp = ($row["cantidad"]*$_GET['cant']) * $can_seg2;
            }else{
               $dec = intval($var / $med);
               $lon = $med * $dec + 100;
               $can_seg = intval($lon / $med);
               $cp = ($row["cantidad"]*$_GET['cant']) / $can_seg;
            }
            $medx = round($lon,-2);
            if($medx<4200){
                $style = 'background:red;';
            }else{
                $style= '';
            }
            //recorte de cadena
            $cadena_de_texto = $row['descripcion'];
            $cadena_buscada   = 'MM';
            $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
            if ($posicion_coincidencia === false) {
                $cadena = $row['descripcion'];
            }ELSE{
                $cadena = substr($row['descripcion'], 0,-6).' '.round($lon,-2).'MM';
            }
           //fin de recorte de cadena
             $ch = ''.$tac4.' <input type="checkbox" id="'.$tac4.'" '.$disabled.' name="anular'.$idcot.'"  onClick="adicionar('.$tac4.',1);" value="checkbox" >';
             $chmix = '<input type="checkbox" id="mix'.$tac4.'" '.$disabled.' name="item2"  onClick="if (this.checked) adicionarmix('.$tac4.',9,1); else adicionarmix('.$tac4.',9,0);" value="checkbox" >';
            $table = $table.'<tr style="background:#D2FCFC;">'
                    . '<td  width="10%" style="text-align:center">'.$row['codigo'].'<input type="hidden" id="v'.$tac4.'" value="'.$vx.'"><input type="hidden" id="sistema'.$tac4.'" value="'.$sistema.'"><input type="hidden" id="idr'.$tac4.'" value="'.$row['id_referencia'].'"></td>'
                    . '<td width="40%"><input type="text" id="des'.$tac4.'" value="'.utf8_decode($cadena).'" style="width:98%"></td>'
                    . '<td width="10%"><input type="text" id="ref'.$tac4.'" value="'.$row['referencia'].'"  style="width:80px">'
                    . '<input type="hidden" disabled id="idcot'.$tac4.'" value="'.$idcot.'" style="width:90px">'
                    . '<input type="hidden" disabled id="idpro'.$tac4.'" value="'.$_GET['ref'].'" style="width:90px">'
                    . '<td style="text-align:center;'.$style.'"> '.$chmix.'</td>'
                     . '<td width="10%"><input type="text" disabled id="color'.$tac4.'" value="'.$color.'" style="width:90px"></td>'
                    . '<td width="10%">'.$row['dado'].'</td>'
                    . '<td width="10%">'.$row['lado'].'</td>'
                    . '<td width="10%">'.$med.' mm</td>'
                    . '<td width="10%" style="text-align:center">'.$row["cantidad"].'</td>'
                    . '<td width="10%" style="text-align:center"><input type="number" value="'.ceil($cp).'" id="can'.$tac4.'" style="width:40px"></td>'
                    . '<td width="10%"><input type="number" value="'.round($lon,-2).'" id="per'.$tac4.'" style="width:50px"></td>'
                    . '<td style="text-align:center;'.$style.'">'.($ch).'</td>'
//                    . '<td><a href="javascript:void(0)" onclick="up_desglose('.$row["id_desglose"].','.$_GET['cod'].');"><button>Editar</button></a></td>'
                    . '</tr>';   
    
        } }