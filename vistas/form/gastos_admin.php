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

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab9" data-toggle="tab"><span class="icon icone-eye-open"></span>Descripcion</a></li>

                                    <li class=""><a href="../vistas/checkeds_gastos_1.php?cod=<?php echo $_GET['cod']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/check.png"></a></li>

                                 

                                </ul>
                                
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
               $table = $table.'<th width="10%"></th>';
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
               <td  width="10%"> <a href="../vistas/?id=add_ga&cod='.$_GET['cod'].'&del_6='.$row["id"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
           
		
               
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

                                    <div class="tab-pane" id="tab10">

                                        <div class="row-fluid">

    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../vistas/?id=add_ga&cod='.$_GET['cod'].'&save';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">

                        
                            <section class="body">

                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                             <label class="control-label">Seleccione mano de obra</label>
                                            <div class="controls"> 
                                               <select name="ref_ad" class="span6">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `referencia_admin`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id_ref_ad'];
                                                            $valor2=$fila['descripcion_ad'];
                                                            $valor3=$fila['referencia_ad'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2." (".$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></div>   
                                              <label></label><div class="controls"> </div>
                                         <label></label><div class="controls"> </div>
                                                                                        
                                           

                                           
                                    <!-- Form Action -->

                                    <div class="form-actions">

                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Guardar';}else{echo 'Editar';} ?></button>

                                        <button type="button" class="btn">Cancelar</button>

                                    </div><!--/ Form Action -->

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
 </section></div>
<!--Fin Gasto administrativo-->

<?php }
if(isset($_GET['del_6'])){
$sql = "DELETE FROM gastos_serv WHERE id=".$_GET['del_6']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_ga&cod=".$_GET['cod']."'";
echo "</script>";
}
    
            
    if(isset($_GET['save'])){      
          $ref= $_POST["ref_ad"];
        if(isset($_GET['editar'])){
                $sql = "UPDATE `producto_rep_ad` SET `id_ref_ad`='".$ref."',`id_p`='".$_GET['id_p']."' WHERE `id_rep_ad` = ".$_GET["editar"].";";
                 mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacio");location.href="../vistas/?id=add_cot&cod='.$_GET['id_p'].'"</script>'; 
        }else{
            $sql = "INSERT INTO `gastos_serv` (`id_administrativo`, `id_ref`)";
            $sql.= "VALUES ('".$ref."', '".$_GET['cod']."')";
            mysql_query($sql, $conexion);
            $status = "ok";
   
            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el gasto administrativo ");location.href="../vistas/?id=add_ga&cod='.$_GET['cod'].'"</script>'; 
    }
    
        }
        
