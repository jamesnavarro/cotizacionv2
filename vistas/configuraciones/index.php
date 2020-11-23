<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de cobro de instalaciones de ventaneria</title>
            <style>
       .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 10px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00070A; border-left: 2px solid #E1EEF4;font-size: 8px;border-bottom: 1px solid #E1EEF4;font-weight: normal; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 8px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
            </style>
             <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../../js/ajax.js" type="text/javascript"></script>
   <script src="funciones_instalacion.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        include '../../modelo/conexion.php';
        $request_ac=mysqli_query($conexion,"SELECT * FROM referencia_mo where instalacion='Si' order by descripcion_mo asc ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
       $table = $table.'<thead><tr bgcolor="#D1EEF0"><td colspan="3">Lista de precios por ubicacion</td><td colspan="2">La costa</td><td colspan="2">Antioquia</td><td colspan="2">Otros</td></thead>';
             $table = $table.'<thead>';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="5%">'.'referencia'.'</th>';             
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Unidad 1'.'</th>';
              $table = $table.'<th width="10%">'.'Valor 1'.'</th>';
                $table = $table.'<th width="5%">'.'Unidad 2'.'</th>';
                $table = $table.'<th width="5%">'.'Valor 2'.'</th>';
               $table = $table.'<th width="10%">'.'Unidad 3'.'</th>';
               $table = $table.'<th width="10%">'.'Valor 3'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
             $unidad = '<select id="unidad'.$row['id_ref_mo'].'" style="width:100%" onchange="editar_moi('.$row['id_ref_mo'].')">'
                     . '<option value="'.$row['unidad_cobro'].'">'.$row['unidad_cobro'].'</option>'
                     . '<option value="Und">Und</option>'
                     . '<option value="M2">M2</option>'
                     . '<option value="ML">ML</option>'
                     . '</select>';
             $unidad2 = '<select id="unidad2'.$row['id_ref_mo'].'" style="width:100%" onchange="editar_moi('.$row['id_ref_mo'].')">'
                     . '<option value="'.$row['unidad_cobro2'].'">'.$row['unidad_cobro2'].'</option>'
                      . '<option value="Und">Und</option>'
                     . '<option value="M2">M2</option>'
                     . '<option value="ML">ML</option>'
                     . '</select>';
             $unidad3 = '<select id="unidad3'.$row['id_ref_mo'].'" style="width:100%" onchange="editar_moi('.$row['id_ref_mo'].')">'
                     . '<option value="'.$row['unidad_cobro3'].'">'.$row['unidad_cobro3'].'</option>'
                      . '<option value="Und">Und</option>'
                     . '<option value="M2">M2</option>'
                     . '<option value="ML">ML</option>'
                     . '</select>';
 
            $table = $table.'<tr><td width="5%"><input type="text" id="id_mo'.$row['id_ref_mo'].'" value="'.$row['id_ref_mo'].'" style="width:100%" disabled>  </td>'
                    . '<td width="5%"><input type="text" id="ref'.$row['id_ref_mo'].'" value="'.$row['referencia'].'" style="width:100%" disabled></td>'
                    . '<td width="30%"><input type="text" id="des'.$row['id_ref_mo'].'" value="'.$row['descripcion_mo'].'" onchange="editar_moi('.$row['id_ref_mo'].')" style="width:100%"></td>'
                    . '<td width="5%">'.$unidad.'</td>'
                    . '<td width="10%"><input type="text" id="valor'.$row['id_ref_mo'].'" value="'.$row["valor_mo"].'" onchange="editar_moi('.$row['id_ref_mo'].')" style="width:100%"></td>'
                   . '<td width="5%">'.$unidad2.'</td>'
                    . '<td width="10%"><input type="text" id="valor2'.$row['id_ref_mo'].'" value="'.$row["valor_mo2"].'" onchange="editar_moi('.$row['id_ref_mo'].')" style="width:100%"></td>'
                    . '<td width="5%">'.$unidad3.'</td>'
                    . '<td width="10%"><input type="text" id="valor3'.$row['id_ref_mo'].'" value="'.$row["valor_mo3"].'" onchange="editar_moi('.$row['id_ref_mo'].')" style="width:100%"></td></tr>';  
          
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
        ?>
    </body>
</html>
