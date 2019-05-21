<?php            
        $alum_por = "SELECT (".$_GET['por'].") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
        $fia =mysql_fetch_array(mysql_query($alum_por));
        $porca= $fia["p"]/100;
        $requestX=mysql_query("SELECT * FROM desgloses a, referencias b where a.id_referencia=b.id_referencia and a.id_producto=".$_GET['ref']." ");

        if($requestX){
        $tac4 =$tac3;

	while($row=mysql_fetch_array($requestX))
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
            if($med>7100){
                $dec = intval($med / 7100);
               $lon = 7100;
               $can_seg2 = round($med /$lon);
               
               $cp = ($row["cantidad"]*$_GET['cant']) * $can_seg2;
            }else{
               $dec = intval(7100 / $med);
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
   
            $table = $table.'<tr style="background:#D2FCFC;">'
                    . '<td  width="5%" style="text-align:center">'.$tac4.'</td>'
                    . '<td  width="10%" style="text-align:center">'.$row['codigo'].'</td>'
                    . '<td width="40%">'.utf8_decode($row['descripcion']).'</td>'
                    . '<td width="10%">'.$row['referencia'].''
                     . '<td width="10%">'.$color.'</td>'
                    . '<td width="10%">'.$row['dado'].'</td>'
                    . '<td width="10%">'.$row['lado'].'</td>'
                    . '<td width="10%">'.$med.' mm</td>'
                    . '<td width="10%" style="text-align:center">'.$row["cantidad"].'</td>'
                    . '<td width="10%" style="text-align:center">'.ceil($cp).'</td>'
                    . '<td width="10%">'.round($lon,-2).'</td>'
                    . ''
//                    . '<td><a href="javascript:void(0)" onclick="up_desglose('.$row["id_desglose"].','.$_GET['cod'].');"><button>Editar</button></a></td>'
                    . '</tr>';   
    
        } }