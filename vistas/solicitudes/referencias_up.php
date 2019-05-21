<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Perfil</title>
        <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script>
        function act(cot){
            var cod = $("#cod").val();
            var peso = $("#peso").val();
            var area = $("#area").val();
                     $.ajax({
                        post:'GET',
                        data:'sw=5&cod='+cod+'&peso='+peso+'&area='+area,
                        url:'acciones.php',
                        success:function(d){
                            $("#msg").html("<font color='green'><b>Se actualizo con exito</b></font>").show(200).delay(1000).hide(200);
                           window.opener.mostrar(cot);
                        }
                 });
        }
    </script>
    </head>
    <body>
        <?php
        include '../../modelo/conexion.php';
        $result = mysql_query("select * from referencias where codigo='".$_GET['cod']."' ");
        $r = mysql_fetch_array($result);
        ?>
        <table>
            <tr>
                <td>Codigo</td>
                <td><input type="text" id="cod" value="<?php echo $r['codigo'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Descripcion</td>
                <td><input type="text" id="des" value="<?php echo $r['descripcion'] ?>" disabeld></td>
            </tr>
            <tr>
                <td>Peso Kg.</td>
                <td><input type="text" id="peso" value="<?php echo $r['peso'] ?>"></td>
            </tr>
            <tr>
                <td>Area Perfil</td>
                <td><input type="text" id="area" value="<?php echo $r['area'] ?>"></td>
            </tr>
            <tr>
                <td><span id="msg"></span></td>
                <td><button onclick="act(<?php echo $_GET['cot'] ?>);">Actualizar</button> <button onclick="window.close();">Salir</button></td>
            </tr>
        </table>
    </body>
</html>
