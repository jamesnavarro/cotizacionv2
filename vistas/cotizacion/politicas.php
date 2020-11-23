<?php
include '../../modelo/conexion.php';
session_start();

        $tex = $_POST['tex'];
        mysqli_query($conexion,"update politicas set texto_pol='$tex' where id_pol=1 ");


    



