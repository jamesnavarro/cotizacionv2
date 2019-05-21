<div class="row-fluid">
    <section class="body">  
        <div class="body-inner">   
            <div class="span12 widget dark stacked">  
                <header>           
                    <h4 class="title">Crear Formulas</h4> 
                    <!-- START Toolbar -->  
                    <ul class="toolbar pull-left"> 
                        <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>  
                    </ul>     
                    <!--/ END Toolbar -->    
                </header>     
                <section id="collapse3" class="body collapse in">     
                    <div class="body-inner">   
                        <!-- Normal Tabs -->   
                        <div class="tabbable" style="margin-bottom: 25px;"> 
                            <ul class="nav nav-tabs">   
                                <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span>Formulas</a></li> 
                                <li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Formulas</a></li>  
                            </ul>      
                            <div class="tab-content"> 
                                <div class="tab-pane active" id="tab5"> 
                                    <!-- START Row -->     
                                    <div class="row-fluid">   
                                        <!-- START Datatable 2 -->   
                                        <div class="span12 widget lime">     
                                            <section class="body">  
                                                <div class="body-inner no-padding">   
                               <?php    $request_v=mysql_query("SELECT * FROM formulas");   
                               if($request_v)
                                   {// echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';        $table = $table.'<tr BGCOLOR="#E3EC7E">';              $table = $table.'<th width="20%">'.'Items'.'</th>';               $table = $table.'<th width="20%">'.'Formula'.'</th>';                           $table = $table.'<th width="40%">'.'Descripcion'.'</th>';              $table = $table.'<th class="hidden-phone">'.'Acciones.'.'</th>';              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request_v))	{                    $table = $table.'<tr><td width="20%">'.$row['id_f'].'</a></td><td width="20%">'.$row['nombre'].'=</a></td><td width="10%">'.$row['alto'].''.$row['op1'].''.$row['ancho'].''.$row['op2'].''.$row['var1'].''.$row['op3'].''.$row['var2'].'</font></td>               <td class="hidden-phone"><a href="../vistas/?id=add_form&del='.$row["id_f"].'"><img src="../images/eliminar.PNG"></a></td></tr>';              		               	} 	$table = $table.'</table>';        	echo $table;  } ?></div>  
                               }
                                            </section>              
                                        </div>     
                                        <!--/ END Datatable 2 -->          
                                    </div>            
                                    <!--/ END Row -->             
                                </div>       
                                <div class="tab-pane" id="tab6">      
                                    <div class="row-fluid">    
                                        <form class="span12 widget shadowed dark form-horizontal bordered" action="../modelo/formula.php" method="post" id="form_validate_html" enctype="multipart/form-data"> 
                                            <section class="body">   
                                                <div class="body-inner">  
                                                    <div class="control-group">   
                                                        <input type="text" name="nom" class="span4" placeholder="Ej: Calcular Perimetro">
                                                        <span class="help-block">Nombre de la formula</span>  
                                                        <br>     
                                                        <select name="alto" style="width: 90px;">  
                                                            <option value="Alto">Alto</option>  
                                                            <option value="Ancho">Ancho</option>   
                                                            <option value="1">1</option>     
                                                        </select>            
                                                        <select name="op1" style="width: 90px;">  
                                                            <option value="+">+</option>  
                                                            <option value="-">-</option>     
                                                            <option value="*">x</option>    
                                                            <option value="/">/</option>    
                                                        </select>        
                                                        <select name="ancho" style="width: 90px;">  
                                                            <option value="Ancho">Ancho</option>  
                                                            <option value="Alto">Alto</option>   
                                                            <option value="1">1</option>    
                                                        </select>               
                                                        <select name="op2" style="width: 90px;">   
                                                            <option value="+">+</option>   
                                                            <option value="-">-</option>    
                                                            <option value="*">x</option>   
                                                            <option value="/">/</option>    
                                                        </select>                    
                                                        <input type="text" name="var1" style="width: 90px;" placeholder="variable 1">  
                                                        <select name="op3" style="width: 90px;">      
                                                            <option value="+">+</option>    
                                                            <option value="-">-</option>        
                                                            <option value="*">x</option>                                     
                                                            <option value="/">/</option>  
                                                        </select>                
                                                        <input type="text" name="var2" style="width: 90px;" placeholder="variable 2"> 
                                                        <!-- Form Action -->       
                                                        <div class="form-actions">       
                                                            <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Guardar';} ?></button> 
                                                            <button type="button" class="btn">Cancelar</button>  
                                                        </div><!--/ Form Action -->    
                                                    </div> 
                                                </div>
                                            </section>             
                                        </form>    
                                        <!--/ END Form Wizard -->       
                                    </div>  
                                </div>  
                            </div>               
                        </div><!--/ Normal Tabs -->                 
                  </div>           
                </section>     
            </div>                   
            </div> 
    </section>
</div>     
<?php  if(isset($_GET['del'])){ $sql = "DELETE FROM formulas WHERE id_f=".$_GET['del'].""; mysql_query($sql, $conexion); echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=add_form'";echo "</script>";} ?> 
  