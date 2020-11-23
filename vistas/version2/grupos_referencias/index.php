<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Listado de referencias</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
               <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css?v=2.5">
               <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap-responsive.min.css">
               <script src="../../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
                <script src="funciones.js?<?php echo rand(1,100) ?>"></script>

    </head>
    <body>
        <div class="page-content">
            <fieldset style="padding-left: 10px">
                <legend>Formulario de registro</legend>
            <div>

                <table>
                    <tr>
                        <td>Modulo: </td>
                        <td> <select id="modulo">
                    <option value="">Seleccione</option>
                    <option value="Alfajia">Alfajia</option>
                    <option value="Rieles">Rieles</option>
                </select></td>
                    </tr>
                    <tr>
                        <td>Referencia:</td>
                        <td>
                            <input type="text" id="referencia" value="" onclick="abrir();">
                        </td>
                    </tr>
                    <tr>
                        <td>descuento:</td>
                        <td><input type="text" id="descuento" value="" placeholder="descuento"></td>
                    </tr>
                </table>
               
                 
               
                
                
                  
                 <button onclick="addref()">Agregar</button>
            </div>
                <br>
                </fieldset>
           
            <div class="col-xs-12">
           
             <legend>Lista de referencias para DT</legend>
                <div class="datagrid">
                     <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                       <tr>
                                           <th>GRUPO</th>
                                           <th>CODIGO</th>
                                           <th>DESCRIPCION</th>
                                           <th>DESCUENTO</th>
                                           <th>OPCIONES</th>
                                       </tr>
                                       <tr>
                                           <td>
                                               <select id="parametro" onchange="mostrar(1)" style="width: 90%">
                                                        <option value="">Seleccione</option>
                                                        <option value="Alfajia">Alfajia</option>
                                                        <option value="Rieles">Rieles</option>
                                            </select> 
                                           </td>
                                           <td>
                                              <input type="text" id="ref" style="width:90%" onchange="mostrar(1)" style="width: 100%"> 
                                           </td>
                                           <td>
                                              <input type="text" id="nombre" style="width:90%" onchange="mostrar(1)" style="width: 100%"> 
                                           </td>
                                           <td></td>
                                           <td></td>
                                        
                                       </tr>
                            </thead>
                        <tbody id="mostrar_tabla">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>


    </body>
</html>
<!--<div class="modal fade" id="modalsistema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table>
              <tr>
                  <td>Id</td>
                  <td><input type="text" id="idref" disabled></td>
              </tr>
              <tr>
                  <td>Sistema</td>
                  <td>
                      <select id="sis">
                          <option value="">Seleccione</option>
                          <?php
                            include '../../../../modelo/conexioni.php';
                            $query = mysqli_query($con, "select * from sistemas");
                            while ($row = mysqli_fetch_array($query)) {
                                echo '<option value="'.$row[1].'">'.$row[1].'</option>';
                            }
                          
                          ?>
                      </select>
                  </td>
              </tr>
              <tbody id="mostrar_sistemas">
              
              </tbody>
          </table>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="limpiar_cajas()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="add_sistema()">Guardar</button>
      </div>
    </div>
  </div>
</div>-->
