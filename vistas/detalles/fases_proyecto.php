<div class="row-fluid">
                        <!-- START Form Wizard -->
                       <header><h4 class="title"><?php if(isset($_GET['cod'])){echo 'Editar Proyecto';}else{echo '<center><h4 class="title">"FASE 1 DEL PROYECTO"</h4></center>';} ?></h4></header>
                           <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle de la fase</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-right">
                                    <li><a class="link" data-toggle="collapse" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <ul class="dot">
                                                <li>Nombre de la Fase: Limpieza total del terreno</li>
                                                
                                                <li>Direccion: Kilometro 5 via al mar</li>
                                                <li>Costo estimado: $ 30,000,000</li>
                                                <li>Fecha EStimada : 1 de sep de 2013 al 1 de sep de 2014</li>
                                                <li>POrcentaje : 25 %</li>
                                                
                                            </ul>
                                        
                                </div>
                                <div class="footer">Ingeniero asignado: James Navarro Blanco</div>
                            </section>
                        </div>
                                    
<!--                                    Insumos-->

                      
                    </div>
  
                            </section></div>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Insumos del Proyecto</h4>
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
                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span> Insumos</a></li>
                                    <li class=""><a href="#tab2" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Insumos</a></li>
                                  
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                    <table class="table table-bordered table-striped table-hover" id="datatable8">
                                        <thead>
                                            <tr>
                                                <th width="10%">Item</th>
                                                <th class="hidden-phone">Descripcion del Insumo</th>
                                                <th width="10%">Cant. Asig</th>
                                                <th width="10%">Cant. Rest</th>
                                                <th class="hidden-phone">Cant Usada</th>
                                                <th class="hidden-phone">Valor Und.</th>
                                                <th class="hidden-phone">Valor Total</th>
                                               
                                                <th width="15%">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">
                        <!-- START Form Wizard -->
                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/paginas.php?editar='.$_GET['cod'].'';}else{echo '../modelo/paginas.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            <section class="body">
                                <div class="body-inner">
                                  
                                        
                                        <div class="control-group">
                                            <label class="control-label">Descripcion del insumo</label>
                                            <div class="controls"><input type="text" name="titulo" value="<?php if(isset($_GET['cod'])){echo $titulo;} ?>" class="span12" placeholder="Seleccione el insumo del bodega" required></div>
                                        </div>
                                        
                                    <div class="control-group">
                                            <label class="control-label">Cantidad</label>
                                            <div class="controls">
                                             <div class="input-append">
                                                <input type="text" placeholder="Digite la cantidad de insumos">
                                               
                                            </div> </div>
                                        </div>
                                   
                                    
                                   
                                     
                                       
                                              <div class="control-group">
                                      
                            <section class="body">
                                <div class="body-inner">
                                    <!-- CLEditor -->
                                    <div class="control-group">
                                        <label class="control-label">Observaciones</label>
                                        <div class="controls">
                                            <textarea  name="editor1"><?php if(isset($_GET['cod'])){echo $descripcion;} ?></textarea>
                                        </div>
                                    </div><!--/ CLEditor -->

                                   
                                </div>
                            </section>
                                      
                                        </div>
                                        
                                    
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>
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
                                <div class="footer">Ingeniero asignado: James Navarro Blanco</div>
                            </section>
                        </div>
                                    
<!--                                    Insumos-->

                      
                    </div>
  
                            </section></div>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Equipos y Herramientas del Proyecto</h4>
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
                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span> Equipos/Tool</a></li>
                                    <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Equ/Tool</a></li>
                                  
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab3">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                    <table class="table table-bordered table-striped table-hover" id="datatable9">
                                        <thead>
                                            <tr>
                                                <th width="10%">Item</th>
                                                <th class="hidden-phone">Equipos /Herramientas</th>
                                                <th width="10%">Cantidad</th>
                                                <th class="hidden-phone">Valor Und</th>
                                                <th class="hidden-phone">Valor Total</th>
                                                <th class="hidden-phone">Proveedor</th>
                                                <th width="15%">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <div class="row-fluid">
                        <!-- START Form Wizard -->
                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/paginas.php?editar='.$_GET['cod'].'';}else{echo '../modelo/paginas.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            <section class="body">
                                <div class="body-inner">
                                  
                                        
                                        <div class="control-group">
                                            <label class="control-label">Nombre del Equipo</label>
                                            <div class="controls"><input type="text" name="titulo" value="<?php if(isset($_GET['cod'])){echo $titulo;} ?>" class="span12" placeholder="Seleccione el equipo o la herramienta" required></div>
                                        </div>
                                        
                                    <div class="control-group">
                                            <label class="control-label">Cantidad</label>
                                            <div class="controls">
                                             <div class="input-append">
                                                <input type="text" placeholder="Digite la cantidad">
                                                
                                            </div> </div>
                                        </div>
                                   
                                       
                                              <div class="control-group">
                                      
                            <section class="body">
                                <div class="body-inner">
                                    <!-- CLEditor -->
                                    <div class="control-group">
                                        <label class="control-label">Observaciones</label>
                                        <div class="controls">
                                            <textarea  name="editor1"><?php if(isset($_GET['cod'])){echo $descripcion;} ?></textarea>
                                        </div>
                                    </div><!--/ CLEditor -->

                                   
                                </div>
                            </section>
                                      
                                        </div>
                                        
                                    
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>
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
                                <div class="footer">Ingeniero asignado: James Navarro Blanco</div>
                            </section>
                        </div>
                                    
<!--                                    Insumos-->

                      
                    </div>
  
                            </section></div>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Mano de Obra Proyecto</h4>
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
                                    <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span> Obreros</a></li>
                                    <li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Obrero</a></li>
                                  
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                    <table class="table table-bordered table-striped table-hover" id="datatable10">
                                        <thead>
                                            <tr>
                                                <th width="10%">Item</th>
                                                <th class="hidden-phone">Nombre del Obrero</th>
                                                <th width="10%">Cargo</th>
                                                <th class="hidden-phone">Presupuesto por mes</th>
                                                <th class="hidden-phone">Actividad</th>
                                               
                                                <th width="15%">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="row-fluid">
                        <!-- START Form Wizard -->
                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/paginas.php?editar='.$_GET['cod'].'';}else{echo '../modelo/paginas.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            <section class="body">
                                <div class="body-inner">
                                  
                                        
                                        <div class="control-group">
                                            <label class="control-label">Nombre del Obrero</label>
                                            <div class="controls"><input type="text" name="titulo" value="<?php if(isset($_GET['cod'])){echo $titulo;} ?>" class="span12" placeholder="Digite el nombre del obrero" required></div>
                                        </div>
                                        
                                    <div class="control-group">
                                            <label class="control-label">Cargo</label>
                                            <div class="controls">
                                             <div class="input-append">
                                                <input type="text" placeholder="Digite el cargo">
                                                
                                            </div> </div>
                                        </div>
                                   <div class="control-group">
                                            <label class="control-label">Presupuesto por mes</label>
                                            <div class="controls">
                                             <div class="input-append">
                                                <input type="text" placeholder="Digite el presupuesto por mes">
                                                
                                            </div> </div>
                                        </div>
                                       
                                              <div class="control-group">
                                      
                            <section class="body">
                                <div class="body-inner">
                                    <!-- CLEditor -->
                                    <div class="control-group">
                                        <label class="control-label">Observaciones</label>
                                        <div class="controls">
                                            <textarea  name="editor1"><?php if(isset($_GET['cod'])){echo $descripcion;} ?></textarea>
                                        </div>
                                    </div><!--/ CLEditor -->

                                   
                                </div>
                            </section>
                                      
                                        </div>
                                        
                                    
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>
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
                                <div class="footer">Ingeniero asignado: James Navarro Blanco</div>
                            </section>
                        </div>
                                    
<!--                                    Insumos-->

                      
                    </div>
  
                            </section></div>