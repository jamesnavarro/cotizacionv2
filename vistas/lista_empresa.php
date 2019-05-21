<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Mi Empresa</h4>
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
                               
                                <div class="tab-content">      <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">



                                    <?php
    


$request_ac=mysql_query("SELECT * FROM inf_empresa ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Nombre'.'</th>';
              $table = $table.'<th width="10%">'.'NIT'.'</th>';
              $table = $table.'<th width="10%">'.'Telefono'.'</th>';
              $table = $table.'<th width="10%">'.'Direccion'.'</th>';
              $table = $table.'<th width="10%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;



  if($editar_conf=='Habilitado'){$up='&up='.$row['id_emp'].'';}else{$up='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%"><a href="../vistas/?id=lista_empresa&empre='.$row['id_emp'].'">'.strtoupper($row['nombre']).'</a></font></td>
            <td width="10%">'.strtoupper($row['nit_emp']).'</font></td>
            <td width="10%">'.strtoupper($row['telefono_1']).'</font></td>
            <td width="10%">'.strtoupper($row['direccion']).'</font></td>
               <td width="10%"><a href="../vistas/?id=lista_empresa&empre='.$row['id_emp'].''.$up.'"><img src="../imagenes/modificar.png"></a> </td>';

           
    
               
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
                                <!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
                                <?php 
                                    if(isset($_GET['empre'])){
                                        include '../vistas/form/miempresa.php';
                                    }
                                    
                                    if(isset($_GET['nuevo'])){
                                        include '../vistas/form/miempresa.php';
                                    }
                                ?>
