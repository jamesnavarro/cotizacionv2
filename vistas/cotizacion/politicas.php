<?php
include '../../modelo/conexion.php';
session_start();

        $tex = $_POST['tex'];
        mysql_query("update politicas set texto_pol='$tex' where id_pol=1 ");


    



