<?php
 require '../modelo/conexion.php';
 if(isset($_GET['cod'])){
 $sql='select * from referencia_mo where id_ref_mo="'.$_GET['cod'].'"';
 $fil =mysql_fetch_array(mysql_query($sql));
        $id_p= $fil["id_ref_mo"];
        $producto= $fil["descripcion_mo"];
        $valor= $fil["valor_mo"];
        $referencia= $fil["referencia"];
   
 }

?>

                      <?php if(isset($_GET['cod'])){
                  
                          ?>    

                             <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Gastos Administrativo y Utilidad | <?php echo 'de: '.$producto.', Precio base: '.$valor; ?></h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

                            <div class="tabbable" style="margin-bottom: 25px;">

                                
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab9">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php 
   

$request_ac=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$_GET['cod']);
    
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="20%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Porcentaje.'.'</th>';
              $table = $table.'<th width="10%">'.'Total.'.'</th>';
          
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $tota=0;
	while($row=mysql_fetch_array($request_ac))
	{       
               $por = 100;
            $tota = $tota + ($valor*$row["porcentaje_ad"]/$por);
       
            $table = $table.'<tr><td width="20%">'.$row['referencia_ad'].'</a></td><td width="10%">'.$row['descripcion_ad'].'</font></td><td width="10%"> '.$row["porcentaje_ad"].' %<font></a></td>
                <td width="10%"> '.($valor*$row["porcentaje_ad"]/$por).'<font></a></td>
              </tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
        echo 'Total de Gastos: $'. number_format($tota);
  
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
<!--Fin Gasto administrativo-->

<?php }

        
