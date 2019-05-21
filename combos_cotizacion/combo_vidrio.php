<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vid' id='valor2x' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vid' id='valor2x'  required>"
        . "<input type='text' placeholder='Lam 1/1 del  modulo 1' name='xxx' id='valor1x'  required onclick='atencion12()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vid' id='valor2x'  required>"
        . "<input placeholder='Lam 1/2 del  modulo 1' type='text' name='xxx' id='valor1x'  required onclick='atencion12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4x'  required>"
        . "<input  placeholder='Lam 2/2 del  modulo 1' type='text' name='xxx2' id='valor3x'  required onclick='atencion24()'> ";
}
if($_POST["num"]==3){
$rpta2= $rpta2."<input type='hidden' name='vid' id='valor2x'  required>"
        . "<input  placeholder='Lam 1/3 del  modulo 1' type='text' name='xxx' id='valor1x'  required onclick='atencion12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4x'  required>"
        . "<input type='text' placeholder='Lam 2/3 del  modulo 1' name='xxx' id='valor3x'  required onclick='atencion24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6x'  required>"
        . "<input type='text' placeholder='Lam 3/3 del  modulo 1' name='xxx' id='valor5x'  required onclick='atencion36()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vid' id='valor2x'  required>"
         . "<input placeholder='Lam 1/4 del  modulo 1' type='text' name='xxx' id='valor1x'  required onclick='atencion12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4x'  required>"
        . "<input placeholder='Lam 2/4 del  modulo 1' type='text' name='xxx' id='valor3x'  required onclick='atencion24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6x'  required>"
        . "<input placeholder='Lam 3/4 del  modulo 1' type='text' name='xxx' id='valor5x'  required onclick='atencion36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid4' id='valor8x'  required>"
        . "<input placeholder='Lam 4/4 del  modulo 1' type='text' name='xxx' id='valor7x'  required onclick='atencion48()'> ";
}
if($_POST["num"]==5){
               $rpta2= $rpta2."<input type='hidden' name='vid' id='valor2x'  required>"
            . "<input placeholder='Lam 1/1 del  modulo 1' type='text' name='xxx' id='valor1x'  required onclick='atencion12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4x'  required>"
        . "<input placeholder='Lam 1/5 del  modulo 1' type='text' name='xxx' id='valor3x'  required onclick='atencion24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6x'  required>"
        . "<input placeholder='Lam 2/5 del  modulo 1' type='text' name='xxx' id='valor5x'  required onclick='atencion36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid4' id='valor8x'  required>"
        . "<input placeholder='Lam 3/5 del  modulo 1' type='text' name='xxx' id='valor7x'  required onclick='atencion48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid5' id='valor10x'  required>"
        . "<input placeholder='Lam 4/5 del  modulo 1' type='text' name='xxx' id='valor9x'  required onclick='atencion510()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vid' id='valor2x'  required>"
         . "<input placeholder='Lam 1/6 del  modulo 1' type='text' name='xxx' id='valor1x'  required onclick='atencion12()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid2' id='valor4x'  required>"
        . "<input placeholder='Lam 2/6 del  modulo 1' type='text' name='xxx' id='valor3x'  required onclick='atencion24()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid3' id='valor6x'  required>"
        . "<input placeholder='Lam 3/6 del  modulo 1' type='text' name='xxx' id='valor5x'  required onclick='atencion36()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid4' id='valor8x'  required>"
        . "<input placeholder='Lam 4/6 del  modulo 1' type='text' name='xxx' id='valor7x'  required onclick='atencion48()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid5' id='valor10x'  required>"
        . "<input placeholder='Lam 5/6 del  modulo 1' type='text' name='xxx' id='valor9x'  required onclick='atencion510()'> ";
$rpta2= $rpta2."<input type='hidden' name='vid6' id='valor12x'  required>"
        . "<input placeholder='Lam 6/6 del  modulo 1' type='text' name='xxx' id='valor11x'  required onclick='atencion612()'> ";
}
}
//}	
echo $rpta2;