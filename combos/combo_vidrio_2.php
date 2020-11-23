<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vidt' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32'  required><input type='text' placeholder='Lam 1/1 del  modulo 3' name='xxx' id='valor31'  required onclick='atenciont()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32'  required><input placeholder='Lam 1/2 del  modulo 3' type='text' name='xxx' id='valor31'  required onclick='atenciont()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34'  required><input  placeholder='Lam 2/2 del  modulo 3' type='text' name='xxx2' id='valor33'  required onclick='atenciont2()'> ";
}
if($_POST["num"]==3){
$rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32'  required><input  placeholder='Lam 1/3 del  modulo 3' type='text' name='xxx' id='valor31'  required onclick='atenciont()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34'  required><input type='text' placeholder='Lam 2/3 del  modulo 3' name='xxx' id='valor33'  required onclick='atenciont2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36'  required><input type='text' placeholder='Lam 3/3 del  modulo 3' name='xxx' id='valor35'  required onclick='atenciont3()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32'  required><input placeholder='Lam 1/4 del  modulo 3' type='text' name='xxx' id='valor31'  required onclick='atenciont()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34'  required><input placeholder='Lam 2/4 del  modulo 3' type='text' name='xxx' id='valor33'  required onclick='atenciont2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36'  required><input placeholder='Lam 3/4 del  modulo 3' type='text' name='xxx' id='valor35'  required onclick='atenciont3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt4' id='valor38'  required><input placeholder='Lam 4/4 del  modulo 3' type='text' name='xxx' id='valor37'  required onclick='atenciont4()'> ";
}
if($_POST["num"]==5){
               $rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32'  required><input placeholder='Lamina 1' type='text' name='xxx' id='valor31'  required onclick='atenciont()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34'  required><input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor33'  required onclick='atenciont2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36'  required><input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor35'  required onclick='atenciont3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt4' id='valor38'  required><input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor37'  required onclick='atenciont4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt5' id='valor310'  required><input placeholder='Lam 1/1 del  modulo 3' type='text' name='xxx' id='valor39'  required onclick='atenciont5()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vidt' id='valor32'  required><input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor31'  required onclick='atenciont()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt2' id='valor34'  required><input placeholder='Lam 2/6 del  modulo 3' type='text' name='xxx' id='valor33'  required onclick='atenciont2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt3' id='valor36'  required><input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor35'  required onclick='atenciont3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt4' id='valor38'  required><input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor37'  required onclick='atenciont4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt5' id='valor310'  required><input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor39'  required onclick='atenciont5()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidt6' id='valor312'  required><input placeholder='Lam 1/6 del  modulo 3' type='text' name='xxx' id='valor311'  required onclick='atenciont6()'> ";
}
}
//}	
echo $rpta2;