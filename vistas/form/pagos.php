<?php 
if(isset($_GET['cod'])){
    $query = mysql_query("SELECT * FROM pagos where id_pago=".$_GET['cod']." ");
    $res = mysql_fetch_array($query);
}
?>  
                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">CONFIGURACION DE PAGOS </h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="" style="margin-bottom: 25px;">

                              

                                <div class="tab-content">
<div class="" id="tab4">

                                        <div class="row-fluid">

 <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/crear_pagos.php?editar='.$_GET['cod'].' ';}else{ echo '../modelo/crear_pagos.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                               <label class="control-label">Descripcion de Pago</label>

                                               <div class="controls">
                                                   <input type="text" name="pago" value="<?php  if(isset($_GET['cod'])){ echo $res['observacion'];}   ?>" placeholder="Nombre del pago" class="span12">
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                             <label class="control-label">Codigo de Pago</label>

                                               <div class="controls">
                                                   <input type="text" name="codigo" value="<?php  if(isset($_GET['cod'])){ echo $res['desc_pago'];}   ?>" placeholder="Codigo" class="span2">
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                              <label></label><div class="controls"> </div>
                                               <label class="control-label">Pagado por</label>

                                               <div class="controls">
                                                   <select name="tipo" required  class="span2">
                                                     
                                                       <?php
                                                        if(isset($_GET['cod'])){echo '<option value="'.$res['tipo'].'">'.$res['tipo'].'</option>';}else{echo '<option value="">Seleccione</option>';}
                                                        
                                                            ?>
                                                       <option value="Kg">Kg</option>
                                                       <option value="M2">M2</option>
                                                       <option value="Ml">Ml</option>
                                                       <option value="Und">Und</option>
                                                   </select>
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>

                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary">Agregar</button>

                                        <a href="../vistas/?id=precios_area"><button type="button" class="btn">Cancelar</button></a>

                                    </div><!--/ Form Action -->

                                </div>

                            </section>

                        </form>

                        <!--/ END Form Wizard -->

                    </div>
                                    </div>
                                    <div class="" id="tab3">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">


<?php

$request_ac=mysql_query("SELECT * FROM pagos ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="20%">'.'Codigo Pago'.'</th>';             
              $table = $table.'<th width="20%">'.'Descripcion Larga'.'</th>';
               $table = $table.'<th width="5%">'.'Por'.'</th>';
                $table = $table.'<th width="20%">'.'Rangos Creados'.'</th>';
              
                   
                   
                   $table = $table.'<th width="15%">'.'Ult Modificacion,'.'</th>';
                   $table = $table.'<th width="5%">'.'Mod. por'.'</th>';
                   $table = $table.'<th width="5%">'.'Rangos'.'</th>';
                 $table = $table.'<th width="5%">'.'Editar'.'</th>';
              $table = $table.'<th width="5%">'.'Estado'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
	while($row=mysql_fetch_array($request_ac))
	{           if($row['estado_p']==0){$im = '<img src="../imagenes/ok.png">';$e = 'yes';}else{$im = '<img src="../imagenes/cancelar.png">';$e = 'no';}
              if($crear_conf=='Habilitado'){$add='<img src="../imagenes/empleado.png">';}else{$add='';}
                  if($crear_conf=='Habilitado'){$up='<img src="../imagenes/modificar.png">';}else{$up='';}
                   if($crear_conf=='Habilitado'){$up2='<img src="../imagenes/edit_precio.png">';}else{$up2='';}
                $t = $t +1;
                $rangos = mysql_query("select * from pagos_rangos where id_pago=".$row['id_pago']." ");
                $ran = '';
                while($r = mysql_fetch_array($rangos)){
                    $ran .= $r['inicial'].' al '.$r['final'].', Of: $'.$r['precio_oficial'].', Ayud: $'.$r['precio_ayud'].'<br>';
                    
                }
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="20%">'.$row['desc_pago'].'</a></td>'
                    . '<td width="20%">'.$row['observacion'].'</font></td>'
                    . '<td width="5%">'.$row['tipo'].'</font></td>'
                    . '<td width="20%">'.$ran.'</td>'
                     
                    . '<td width="15%">'.$row['fecha_g'].'</font></td>'
                     . '<td width="5%">'.$row['registro_p'].'</a></td>'
                    . '<td width="5%"><a href="../vistas/?id=rangos&cod='.$row['id_pago'].'">'.$up2.'</a> </td>'
                    . '<td width="5%"><a href="../vistas/?id=pagos&cod='.$row['id_pago'].'">'.$up.'</a> </td>'
                    . '<td width="5%"><a href="../vistas/?id=pagos&'.$e.'='.$row['id_pago'].'">'.$im.'</a> </td></tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    

                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>

                            </section>

                        </div>

                    </div>
 </section></div>
<?php
 if(isset($_GET['yes'])){
$sql = "UPDATE pagos SET estado_p=1 WHERE id_pago=".$_GET['yes']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=pagos'";
echo "</script>";
}

 if(isset($_GET['no'])){
$sql = "UPDATE pagos SET estado_p=0 WHERE id_pago=".$_GET['no']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=pagos'";
echo "</script>";
}
                        