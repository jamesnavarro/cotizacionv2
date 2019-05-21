<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reportes de Cotizaciones</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="estilo.css">
        <link rel="stylesheet" href="estilo_medio.css">
        <link rel="stylesheet" href="estilo_grande.css">
        <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../../js/ajax.js" type="text/javascript"></script>
        <script src="funciones.js" type="text/javascript"></script>

    </head>
    <body>
        <div class="bod blueTable"><br>
            <center><legend><h2>NUEVO REGISTRO DE SEGUIMIENTO</h2></legend></center>
             <table width="100%">
                <tr>
                  <td>
                      <input type="hidden" id="rel" value="<?php echo $_GET['rad'] ?>">
                      <input type="hidden" id="id_sg" value="<?php echo $_GET['id'] ?>">
                  </td>
                </tr>
                <tr>
                    <td><textarea id="des_seg" class="form-control" style="resize: none;height: 200px;" placeholder="Digite el seguimiento."><?php echo $_GET['obsr'] ?> </textarea></td>
                </tr>
                <tr><td><button type="button" class="btn btn-success" onclick="nuev_seg()">Guardar</button></td></tr>
                
            </table>
        </div>
        <div id="mostrar_seguimientos">
        </div>
      </div>
    </div>
  </div>
</html>
