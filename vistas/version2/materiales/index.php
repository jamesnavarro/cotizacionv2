<?php
 include('../../../modelo/conexioni.php');
 session_start();
?>
<script src="../vistas/version2/materiales/funciones.js?<?php echo rand(1,9999) ?>"></script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                         <header>

                                <h4 class="title">sINCRONIZAR DATOS CON FOMPLUS <span id="load"></span></h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
                                            <!-- Normal Tabs -->
                                  <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                                       <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            <section class="body">
                                <div class="body-inner no-padding">
                          <input type="text" id="fechav" placeholder="" value="<?php echo date("Y-m-d") ?>"/>
                        <button class="btn btn-danger" onclick="con_fom_cod();">
                            
                              <i class="ace-icon fa fa-plus"></i> Mostrar Actualizacion
                            </button>
                            <br><br>
                            <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-bordered table-striped table-hover" >
                                <tr class="bg-info">
                                      <th>CODIGO</th> 
				      <th>REFERENCIA</th>
                                      <th>DESCRIPCION</th>
                                      <th>COLOR</th>
                                      <th>COSTO</th>
                                      <th>ESTADO</th>
                                      <th><input type="checkbox" name="item" onclick="marcar(this)"</th>
                                </tr>
                                  <tr>
                                      <td><input type="text" id="cod2" style="width:97%" placeholder="Digite el Codigo" class="form-control"/></td>
                                      <td><input type="text" id="refe2" style="width:97%" placeholder="Digite la Referencia" class="form-control"/></td> 
				      <td><input type="text" id="des2" style="width:97%" placeholder="Digite Descripcion" class="form-control"/></td> 
                                      <td><input type="text" id="col2" style="width:97%" placeholder="Digite el color" class="form-control"/></td> 
                                      <td>-</td>
                                      <td><select id="est2" style="width:97%" class="form-control">
                                              <option value="">Todos</option>
                                              <option value="1">Activos</option>
                                              <option value="0">No Activos</option>
                                          </select></td> 
                                      <td></td>
                                  </tr>
                               <tbody id="mostrar_tabla2">
                                   
                               </tbody>
                               <tr><td colspan="4"></td><td colspan="2"><button onclick="agregar_cod_alu()" class="btn btn-success"> Sincronizar Codigos </button></td></tr>
                            </table>
                            <!-- FIN DE CONTENIDO -->
                  </div>
                </section>
               </div>
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



     

      





