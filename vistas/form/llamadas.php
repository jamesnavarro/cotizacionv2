 <?php require '../modelo/conexion.php'; if(isset($_GET['cod'])){ $sql='select * from paginas where id_p="'.$_GET['cod'].'"'; $fil =mysql_fetch_array(mysql_query($sql));        $id_p= $fil["id_p"];        $titulo= $fil["titulo"];        $ruta= $fil["ruta"];        $descripcion= $fil["descripcion"];        $superior= $fil["superior"]; }  ?><div class="row-fluid">                        <!-- START Form Wizard -->                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/paginas.php?editar='.$_GET['cod'].'';}else{echo '../modelo/paginas.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                            <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar llamada';}else{echo 'Agregar Llamadas';} ?></h4></header>                            <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                            <label class="control-label">Asunto</label>                                            <div class="controls"><input type="text" name="asunto" value="<?php if(isset($_GET['cod'])){echo $titulo;} ?>" class="span6" placeholder=" " required></div>                                                                                        <label></label><div class="controls"> </div>                                                                                                                                                                                  <label></label><div class="controls"> </div><label class="control-label">Fecha de inicio</label>                                             <div class="controls"><input name="fechainicio" class="span2" type="text" id="datepicker1" placeholder=""><input type="text" id="timepicker1" class="span2" placeholder="hora inicial"><input type="text" id="timepicker2" class="span2" placeholder="hora final"></div>                                                                                        <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Duracion</label>                                            <div class="controls"><input name="duracion" class="span2" type="text" id="timepicker2" placeholder=""></div>                                                                                        <label></label><div class="controls"> </div>                                                                                        <label></label><div class="controls"> </div><label class="control-label">Asignado a</label>                                            <div class="controls"><select class="span4"  name="nombre">                                                                                                                                                                                          <?php                                                                       require '../modelo/conexion.php';                                                           $consulta= "SELECT * FROM `usuarios`";                                                                                 $result=  mysql_query($consulta);                                                            while($fila=  mysql_fetch_array($result)){                                                            $valor1=$fila['usuario'];                                                                                                                                                                              echo"<option value=".$valor1.">".$valor1."</option>";                                                                                                                        }                                                                                                                       ?>                                                               </select>                                            </div>                                                                                        <label></label><div class="controls"> </div>                                                                                                                                                                                <label class="control-label">Aviso<b>?</b></label>                                            <div class="controls"><select name="aviso" class="span2">                                                 <option value=" ">Seleccione.. </option>                                                 <option value="Si">Si</option>                                                 <option value="No">No</option>                                                                                                                                                        </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                         <label class="control-label">Descripcion</label>                                            <div class="controls"><textarea name="Informacion adicional" class="span6" rows="6"></textarea></div>                                                                                        <label></label><div class="controls"> </div>                                                                                        <label class="control-label">Estado</label>                                            <div class="controls"><select name="estado" class="span2">                                                 <option value=" ">Seleccione</option>                                                 <option value="entrante">Entrante</option>                                                 <option value="saliente">Saliente</option>                                                                                                   </select>                                                                                        <select name="estado" class="span2">                                                 <option value=" ">Seleccione</option>                                                 <option value="panificada">Planificada</option>                                                 <option value="realizada">Realizada</option>                                                 <option value="no realizada">No realizada</option>                                                                                                      </select></div>                                                                                        <label></label><div class="controls"> </div>                                                                                                                                    <label class="control-label">Relacionado con</label>                                            <div class="controls"><input type="text" name="relacionado" value="<?php if(isset($_GET['cod'])){echo $titulo;} ?>" class="span3" placeholder=" " required>&nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="con" value="<?php if(isset($_GET['cod'])){echo $titulo;} ?>" class="span3" placeholder=" " required> <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Seleccionar';} ?></button>                                            </div>                                                                                        <label></label><div class="controls"> </div>                                                                                                                                                                    </div>                                                                                                                                                                                                                                                                                                                                                                                            <!-- Form Action -->                                    <div class="form-actions">                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Guardar';} ?></button>                                        <button type="button" class="btn">Cancelar</button>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                        <!--/ END Form Wizard -->                    </div>