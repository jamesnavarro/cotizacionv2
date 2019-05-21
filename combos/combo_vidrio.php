<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vid' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vid' id='valor2'  required><input type='text' placeholder='Lam 1/1 del  modulo 1' name='xxx' id='valor1'  required onclick='atencion()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vid' id='valor2'  required><input placeholder='Lam 1/2 del  modulo 1' type='text' name='xxx' id='valor1'  required onclick='atencion()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4'  required><input  placeholder='Lam 2/2 del  modulo 1' type='text' name='xxx2' id='valor3'  required onclick='atencion2()'> ";
}
if($_POST["num"]==3){
$rpta2= $rpta2."<input type='hidden' name='vid' id='valor2'  required><input  placeholder='Lam 1/3 del  modulo 1' type='text' name='xxx' id='valor1'  required onclick='atencion()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4'  required><input type='text' placeholder='Lam 2/3 del  modulo 1' name='xxx' id='valor3'  required onclick='atencion2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6'  required><input type='text' placeholder='Lam 3/3 del  modulo 1' name='xxx' id='valor5'  required onclick='atencion3()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vid' id='valor2'  required><input placeholder='Lam 1/4 del  modulo 1' type='text' name='xxx' id='valor1'  required onclick='atencion()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4'  required><input placeholder='Lam 2/4 del  modulo 1' type='text' name='xxx' id='valor3'  required onclick='atencion2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6'  required><input placeholder='Lam 3/4 del  modulo 1' type='text' name='xxx' id='valor5'  required onclick='atencion3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid4' id='valor8'  required><input placeholder='Lam 4/4 del  modulo 1' type='text' name='xxx' id='valor7'  required onclick='atencion4()'> ";
}
if($_POST["num"]==5){
               $rpta2= $rpta2."<input type='hidden' name='vid' id='valor2'  required><input placeholder='Lam 1/1 del  modulo 1' type='text' name='xxx' id='valor1'  required onclick='atencion()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4'  required><input placeholder='Lam 1/5 del  modulo 1' type='text' name='xxx' id='valor3'  required onclick='atencion2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6'  required><input placeholder='Lam 2/5 del  modulo 1' type='text' name='xxx' id='valor5'  required onclick='atencion3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid4' id='valor8'  required><input placeholder='Lam 3/5 del  modulo 1' type='text' name='xxx' id='valor7'  required onclick='atencion4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid5' id='valor10'  required><input placeholder='Lam 4/5 del  modulo 1' type='text' name='xxx' id='valor9'  required onclick='atencion5()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vid' id='valor2'  required><input placeholder='Lam 1/6 del  modulo 1' type='text' name='xxx' id='valor1'  required onclick='atencion()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4'  required><input placeholder='Lam 2/6 del  modulo 1' type='text' name='xxx' id='valor3'  required onclick='atencion2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6'  required><input placeholder='Lam 3/6 del  modulo 1' type='text' name='xxx' id='valor5'  required onclick='atencion3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid4' id='valor8'  required><input placeholder='Lam 4/6 del  modulo 1' type='text' name='xxx' id='valor7'  required onclick='atencion4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid5' id='valor10'  required><input placeholder='Lam 5/6 del  modulo 1' type='text' name='xxx' id='valor9'  required onclick='atencion5()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid6' id='valor12'  required><input placeholder='Lam 6/6 del  modulo 1' type='text' name='xxx' id='valor11'  required onclick='atencion6()'> ";
}
}
//}	
echo $rpta2;