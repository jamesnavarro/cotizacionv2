<?php
   include('../modelo/conexion.php');
  $querymart = mysqli_query($conexion,"select color,comprar from desgloses_material where id_cot='".$_GET["cot"]."' group by id_cot ");
    $row3 = mysqli_fetch_array($querymart);
    if($row3[0]=='02'){
        $pin = 'PINTURA';
    }else if($row3[0]=='01'){
        $pin = 'ANONIZADO';
    }else{
        $pin = '';
    }
    $pin = 'PINTURA';
    //echo $row3[0];
    if($row3[1]==1){
        $estsol = '<b>Enviado a almacen</b>';
         $dis = '';
    }else if($row3[1]==2){
        $estsol = '<b>Solicitado a compras</b>';
         $dis = 'disabled';
    }else{
        $estsol = 'Sin Procesar';
        $dis = '';
    }
if(isset($_GET['excel'])){
    include '../vistas/desglose/excel.php';  
}else{
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <!-- START META SECTION -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>HOJA DE MARTERIALES*</title>
        <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../vistas/desglose/funciones.js?v=4.4" type="text/javascript"></script>
    <script> 
        $(function() {
            mostrar(<?php echo $_GET['cot']; ?>);
        });
        function pasar_sistema(id,item){
        $("#sist"+id).val(item);
        updatesistema(id);
        }
        </script>
        <style>  
           .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #2A2D2E;font-size: 12px;border-bottom: 1px solid #36393B;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
        #scroll {
            width:628px;
            height:315px;
            background:url(../Images/contenido.jpg);
            overflow:auto;
       }
        </style>
</head>
<body> 
    
    <div id="otros" class="tabcontent">
        <br>
        Cotizacion Id:<input type="text" disabled id="cot" value="<?php echo $_GET['cot']; ?>">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" <?php echo $dis ?>>Mandar PreSolicitud</button>
        <span id="estsol"><?php echo $estsol; ?></span>
        <button class="btn btn-info" data-toggle="modal" data-target="#ModalConfiguracion" <?php echo $dis ?>>Configuracion</button>
<!--         <button class="btn btn-danger" data-toggle="modal" data-target="#ModalDesglose" <?php echo $dis ?>>Notas del Desglose</button>-->
        <hr>
   <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#alux"><h6><B>Aluminio</B></h6></a></li>
                    <li id="marcar2"><a data-toggle="tab" href="#vidx" onclick="vidrios()"><h6><B>Vidrio</B></h6></a></li>
                    <li id="marcar2"><a data-toggle="tab" href="#accx" onclick="accesorios()"><h6><B>Accesorios</B></h6></a></li>
                    
            </ul>  
        <div class="tab-content">
             <div id="alux" class="tab-pane fade in active">
                               <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#alu1"><h6><B>1. Desglose de Aluminio</B></h6></a></li>
                                        <li id="marcar2"><a data-toggle="tab" href="#alu2" onclick="mostrar_desglose()"><h6><B>2. Desglose Resumido</B></h6></a></li>
                                        <li id="marcar2"><a data-toggle="tab" href="#alu3" onclick="desglose_final()"><h6><B>3. Desglose Final</B></h6></a></li>
                                        
                               </ul> 
                 <div class="tab-content">
                        <div id="alu1" class="tab-pane fade in active">
                            <table>
                                            <tr>
                                                <td colspan=""></td>
                                            </tr>
                                        </table>
                                       
                                        <div class="datagrid"> 
                                            <div style="text-align:right">
                                                <button onclick="reiniciar()">Reiniciar Desglose</button>
                                                <button onclick="procesar()">Procesar DT..</button>
                                            </div>
                                            <div style="width:100%; height:600px; overflow: scroll;">
<?php
 require '../modelo/conexion.php';
 
 
 
            $table = '<p><center> <h4><b>DESGLOSE DE ALUMINIOS</b></h4> </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';
              $table = $table.'<th width="10%">'.'Sistema'.'</th>';
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
              $table = $table.'<th width="10%">'.'Medida'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Peso'.'</th>';
              $table = $table.'<th nowrap class="hidden-phone">'.'Cantidad T'.'</th>';
              $table = $table.'<th nowrap class="hidden-phone">'.'Medida T'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfiles'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Check'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              $tac1 =0;
              
              
            
            
              $table = $table.'<tbody id="mostrar_items">'
                      . '<tr><td colspan="13">Cargando Datos.. <img src="../images/load.gif"></td></tbody></table>';
              echo $table; 
       ?>
                   </div> <br><hr>
                 
                                        <?php
       echo '<a href="../vistas/imprimir_desglose.php?cot='.$_GET['cot'].'&exportar">Exportar a excel</a>';
   
                                       ?>
                                  
   </div>  
                        </div>
                        <div id="alu2" class="tab-pane fade in" style="padding: 15px 15px 15px 15px;">
                            <?php

 
 
            $table = '<p><center> DESGLOSE DE ALUMINIOS </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Sistema'.'</th>';     
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              
              $table = $table.'<th width="10%">'.'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="vermodal()">medida</button>'.'</th>';
             
              $table = $table.'<th class="hidden-phone">'.'Cantidad T'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Medida T'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfiles'.' </th>';
              $table = $table.'<th class="hidden-phone">'.'Perfil'.' </th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

            
              $table = $table.'<tbody id="mostrar_desglose"></tbody></table>';
              echo $table; 
       ?>
                        </div>
                        <div id="alu3" class="tab-pane fade in">
                            <div style="width:100%; height:600px; overflow: scroll;">
                                <a href="../vistas/hoja_materiales_1.php?cot=<?php echo $_GET['cot'] ?>&excel"><button> <img src="../imagenes/file_excel.png">Descargar en Excel</button></a>
                    | <a href="http://172.16.0.40/laboratorio/aluvmix/vistas/inventario/desgloses/pdf_alum.php?cot=<?php echo $_GET['cot'] ?>&obs=&obra=" target="_blank"><button> <img src="../imagenes/print.png">Imprimir Desglose</button></a>
               <?php
       
 
            $table = '<p><center> DESGLOSE DE ALUMINIOS </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cantidad Requerida'.' </th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Acabado Perfil'.'</th>';     
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Tipo (Item)'.'</th>';
              $table = $table.'<th width="10%">'.'Medida'.'</th>';
             
              $table = $table.'<th width="10%">'.'Dado'.'</th>';
              
              $table = $table.'<th width="10%">'.'Peso'.'</th>';
              $table = $table.'<th width="10%">'.'Peso Total'.'</th>';
              $table = $table.'<th width="10%">'.'Perimetro'.'</th>';
              $table = $table.'<th width="10%">'.'Area Total m<sup>2</sup>'.'</th>';
              $table = $table.'<th width="10%">'.'Rendimiento '.$pin.' '.'</th>';
              $table = $table.'<th width="10%">'.'Cant '.$pin.' Kg'.'</th>';              
              $table = $table.'<th width="10%">'.'Valor '.$pin.''.'</th>';
              $table = $table.'<th width="10%">'.'Valor Alumino Crudo'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total '.$pin.' '.'</th>';
              $table = $table.'<th width="10%">'.'Total Alum+pint</th>';
              $table = $table.'<th width="10%">'.'Costo Presupuestado</th>';
              $table = $table.'<th width="10%">Observaciones</th>';
              
    
              $table = $table.'</tr>';
              $table = $table.'</thead>';

            
              $table = $table.'<tbody id="mostrar_final"></tbody></table>';
              echo $table; 
       ?>
            </div>
                        </div>
                  </div>
                                   
                                         
                </div>
            <div id="vidx" class="tab-pane fade in">
                <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#vid1"><h6><B>1. Desglose de Vidrio</B></h6></a></li>
                                        <li id="marcar2"><a data-toggle="tab" href="#vid2" onclick="mostrar_desglose_vidrio()"><h6><B>2. Desglose Final</B></h6></a></li>
              
                               </ul> 
                 <div class="tab-content">
                     <div id="vid1" class="tab-pane fade in active">
                          
                          <button onclick="procesarvid()">Procesar Vidrios</button>
                          <button onclick="resetvid()">Resetear Vidrios</button>
                          <button onclick="vidrios()" id="btn_vidrio">Actualizar Modulo vidrio</button>
                          <a href="http://172.16.0.40/laboratorio/aluvmix/vistas/inventario/desgloses/pdf_vid.php?cot=<?php echo $_GET['cot'] ?>&obs=&obra=" target="_blank"><button> <img src="../imagenes/print.png">Imprimir Desglose</button></a>
                         <div id="mostrar_vidrios"></div>   
                     </div>
                     <div id="vid2" class="tab-pane fade in">
                          
                         <table class="table table-bordered table-striped table-hover">
                              <tr>
                            
                                  <td>Referencia</td>
                                  <td>Descripcion</td>
                                  <td>Espesor</td>
                                  <td>Cantidad</td>
                                  <td>Peso</td>
                                  <td>Costo</td>
                                  <td>Total</td>
                                  
                              </tr>
                         <tbody id="mostrar_desglose_vidrios"></tbody>
                         </table>
                     </div>
                     <div id="vid3" class="tab-pane fade in">
                         
                     </div>
                  </div>
               
                
            </div>
             <div id="accx" class="tab-pane fade in" >
                 <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-toggle="tab" href="#acc1"><h6><B>1. Desglose de Accesorios</B></h6></a></li>
                                        <li id="marcar2"><a data-toggle="tab" href="#acc2" onclick="mostrar_desglose_acc()"><h6><B>2. Desglose Final</B></h6></a></li>
              
                               </ul> 
                 <div class="tab-content">
                     <div id="acc1" class="tab-pane fade in active">
                         
                          <table class="table table-bordered table-striped table-hover" id="tabla2">
                              <tr>
                                  <td>#</td>
                                  <td>Tipo</td>
                                  <td>Codigo</td>
                                  <td>Referencia</td>
                                  <td>Descripcion</td>
                                  <td>Color</td>
                                  <td>Cantidad</td>
                                  <td>Total</td>
                                  <td><button onclick="procesar_accesorios()">Procesar</button></td>
                                  
                              </tr>
                              <tbody id="mostrar_accesorios">
                                  <tr><td colspan="6">Cargando Accesorios..</td></tr>
                              </tbody>
                              
                          </table>
                     </div>
                     <div id="acc2" class="tab-pane fade in">
                          <a href="http://172.16.0.40/laboratorio/aluvmix/vistas/inventario/desgloses/pdf_acc.php?cot=<?php echo $_GET['cot'] ?>&obs=&obra=" target="_blank"><button> <img src="../imagenes/print.png">Imprimir Desglose</button></a>
                         <table class="table table-bordered table-striped table-hover" id="tabla2">
                              <tr>
                                  <td>#</td>
                                  <td>Codigo</td>
                                  <td>Referencia</td>
                                  <td>Descripcion</td>
                                  <td>Color</td>
                                  <td>Sistema</td>
                                  <td>Total</td>   
                              </tr>
                              <tbody id="mostrar_accesorios_resumen">
                                  <tr><td colspan="6">Cargando Accesorios..</td></tr>
                              </tbody>
                              
                          </table>
                     </div>
                
                 </div>
         
            </div>
    </div>
</body>
</html>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Calcular Perfil</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="contenido">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enviar Desglose</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"></label>
            <input type="hidden" class="form-control" id="de" value="<?php echo $_SESSION["email"] ?>">
          </div>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Buscar Correo por Nombre:</label>
            <input type="text" class="form-control" id="usuario" value="" placeholder="Nombre Apellido" onkeyup="buscarema()">
          </div>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Para:</label>
            <input type="text" class="form-control" id="email" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Mensaje:</label>
            <textarea class="form-control" id="message"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="enviarnot()">Enviar Notificacion</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalEditarX" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width:100%" class="table table-bordered table-striped table-hover" id="tabla2">
              <tr>
                  <td>Referencia</td>
                  <td>Descripcion</td>
                  <td>Medida</td>
                  <td>Cantidad</td>
                  <td>Perfil</td>
                  <td>Tipo</td>
                  <td>Opcion</td>
              </tr>
              <tbody id="mostrar_editar">
                  
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalConfiguracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuracion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width:100%" class="table table-bordered table-striped table-hover"> 
              <tr>
                  <td>Codigo</td>
                  <td>Referencia</td>
                  <td>Descripcion</td>
                  <td>Medida</td>
                  <td>Und</td>
                  <td>Perfil</td>
                  <td>Can Perfil</td>
                  <td>Tipo</td>
                  <td>-</td>
                  <td>C</td>
              </tr>
              <tr>
                  <td><input type="text" id="bcod" style="width:100%" class="form controls" onkeyup="mostrarconf()"></td>
                  <td><input type="text" id="bref" style="width:100%" class="form controls" onkeyup="mostrarconf()"></td>
                  <td><input type="text" id="bdes" style="width:100%" class="form controls" disabled></td>
                  <td><input type="text" id="bmed" style="width:100%" class="form controls" disabled></td>
                  <td><input type="text" id="bcan" style="width:30px" class="form controls" disabled></td>
                  <td><input type="text" id="bper" style="width:100%" class="form controls" onkeyup="mostrarconf()"></td>
                  <td><input type="text" id="bcan" style="width:30px" class="form controls" disabled></td>
                  <td><input type="text" id="btip" style="width:100%" class="form controls" onkeyup="mostrarconf()"></td>
                  <td></td>
                  <td></td>
              </tr>
              <tbody id="mostrar_configuracion">
                  
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalDesglose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notas del desglose</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width:100%" class="table table-bordered table-striped table-hover"> 
              <tr>
                  <td>Descripcion de la nota</td>
                  <td>Opciones</td>
              </tr>
              <tr>
                  <td><textarea id="bcod" style="width:100%" class="form controls" ></textarea></td>
                  <td><input type="button" id="dd"  class="form controls" onclick="addnota()" value="+ Agregar"></td>
          
              </tr>
              <tbody id="mostrar_notas">
                  
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?php
}