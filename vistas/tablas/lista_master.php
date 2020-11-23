<script src="../vistas/tablas/funciones.js?v=<?php echo rand(1,100) ?>"></script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Master Productos</h4>

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

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 418083642 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">
                                    <table class="table table-bordered table-striped table-hover" id="">
                                        <thead>
                                            <tr bgcolor="#D1EEF0">
                                          <th>ITEMS</th>
                                          <th>DISEÑO</th>
                                          <th>CODIGO</th>
                                          <th>REFERENCIA</th>
                                          <th>DESCRIPCION</th>
                                          <th>LINEA</th>
                                          <th>SISTEMA</th>
                                          <th>PERTENECE</th>
                                          <th>OPCION</th>
                                          </tr>
                                        </thead>
                                        <tr bgcolor="#D1EEF0">
                                            <td><input type="text" class="form-control" id="item" style="width: 100%" onchange="mostrar_master(1)"></td>
                                          <td>-</td>
                                          <td><input type="text" class="form-control" id="cod" style="width: 100%" onchange="mostrar_master(1)"></td>
                                          <td><input type="text" class="form-control" id="ref" style="width: 100%" onchange="mostrar_master(1)"></td>
                                          <td><input type="text" class="form-control" id="des" style="width: 100%" onchange="mostrar_master(1)"></td>
                                          <td><input type="text" class="form-control" id="lin" style="width: 100%" onchange="mostrar_master(1)"></td>
                                          <td><input type="text" class="form-control" id="sis" style="width: 100%" onchange="mostrar_master(1)"></td>
                                          <td><select id="per" style="width: 100%"  class="form-control"  onchange="mostrar_master(1)">
                                              <option value="">Sin clasificar</option>
                                              <option value="1">Monty 1</option>
                                              <option value="2">Monty 2</option>
                                              </select></td>
                                          <td><select id="es" style="width: 100%"  class="form-control"  onchange="mostrar_master(1)">
                                               <option value="">Todas</option>
                                              <option value="0">Activo</option>
                                              <option value="1">No activo</option>
                                              </select></td>
                                          </tr>
                                          <tbody id="mostrarproductos">
                                              
                                          </tbody>
                                    </table>

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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Opciones Disponible del Items <input type="text" class="form-control" id="idp" style="width: 40px" disabled></h4>
        <input type="hidden" class="form-control" id="estadop" style="width: 40px" disabled>
      </div>
      <div class="modal-body">
          <p id="titulo"></p>
          <b>¿Que quieres hacer?</b>
 
          <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Perfileria</a></li>
  <li><a data-toggle="tab" href="#menu1">Accesorios</a></li>

</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Perfiles</h3>
    <table class="table table-bordered table-striped table-hover" id="">
        <tr>
            <th>CODIGO</th>
            <th>DESCRIPCION</th>
            <th>LADO</th>
            <th>CANTIDAD</th>
        </tr>
        <tbody id="mostrarperfileria">
            
        </tbody>
    </table>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Accesorios</h3>
    <table class="table table-bordered table-striped table-hover" id="">
        <tr>
            <th>CODIGO</th>
            <th>DESCRIPCION</th>
            <th>LADO</th>
            <th>CANTIDAD</th>
        </tr>
        <tbody id="mostraraccesorios">
            
        </tbody>
    </table>
  </div>

</div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" id="botest" onclick="upest()"><span id="estp"></span></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>