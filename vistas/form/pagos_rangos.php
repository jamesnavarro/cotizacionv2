<?php 
if(isset($_GET['up'])){
    $query = mysql_query("SELECT * FROM pagos_rangos where id_pr=".$_GET['up']." ");
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

                                <h4 class="title">RANGOS DE PAGOS</h4>

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

 <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up'])){echo '../modelo/crear_pagos_rango.php?editar='.$_GET['up'].'&cod='.$_GET['cod'].' ';}else{ echo '../modelo/crear_pagos_rango.php?cod='.$_GET['cod'].' ';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                               <label class="control-label">Rango de Pagos</label>

                                               <div class="controls">
                                                   <input type="number" required name="inicio" value="<?php  if(isset($_GET['up'])){ echo $res['inicial'];}   ?>" placeholder="Rango 1" class="span2">
                                                   AL
                                                   <input type="number" required name="final" value="<?php  if(isset($_GET['up'])){ echo $res['final'];}   ?>" placeholder="Rango 2" class="span2">
                                                   <i>(Kg, M2, Ml, Und)</i>
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                             <label class="control-label">Pagar a Oficial</label>

                                               <div class="controls">
                                                   <input type="text" required name="precio1" value="<?php  if(isset($_GET['up'])){ echo $res['precio_oficial'];}   ?>" placeholder="Valor Oficial" class="span2">
                                               
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>
                                 <label></label><div class="controls"> </div>
                                             <label class="control-label">Pagar a Ayudante</label>

                                               <div class="controls">
                                                   <input type="text" required name="precio2" value="<?php  if(isset($_GET['up'])){ echo $res['precio_ayud'];}   ?>" placeholder="Valor Ayudante" class="span2">
                                               
                                               </div>
                                            
                                             <label></label><div class="controls"> </div>

                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary">Agregar</button>

                                        <a href="../vistas/?id=pagos"><button type="button" class="btn">Cancelar</button></a>

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

$request_ac=mysql_query("SELECT * FROM pagos_rangos where id_pago=".$_GET['cod']." ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="20%">'.'Rango Inicial/Final'.'</th>';             
       
               $table = $table.'<th width="20%">'.'Pagar a Oficial'.'</th>';
                $table = $table.'<th width="20%">'.'Pagar a Ayudante'.'</th>';
  
              $table = $table.'<th width="5%">'.'Accion'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
	while($row=mysql_fetch_array($request_ac))
	{       
              if($crear_conf=='Habilitado'){$add='<img src="../imagenes/empleado.png">';}else{$add='';}
                  if($crear_conf=='Habilitado'){$up='<img src="../imagenes/modificar.png">';}else{$up='';}
                   if($crear_conf=='Habilitado'){$up2='<img src="../imagenes/edit_precio.png">';}else{$up2='';}
                $t = $t +1;
                
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="20%">'.$row['inicial'].' hasta '.$row['final'].'</a></td>'
             
                    . '<td width="20%">$ '.$row['precio_oficial'].'</font></td>'
                    . '<td width="20%">$ '.$row['precio_ayud'].'</font></td>'
                    . '<td width="5%"><a href="../vistas/?id=rangos&up='.$row['id_pr'].'&cod='.$_GET['cod'].'">'.$up.'</a> </td></tr>';   
           
		
               
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
                        