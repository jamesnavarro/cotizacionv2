<?php
include "../modelo/conexion.php";
$rpta2="";
if (isset($_POST["num"])) {
    if($_POST["num"]==0){

$rpta2= $rpta2."<select name='vidc' required><option value='0'>0</option>";
$rpta2= $rpta2."</select>";
}
if($_POST["num"]==1){
$rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42'  required><input type='text' placeholder='Lam 1/1 del  modulo 4' name='xxx' id='valor41'  required onclick='atencionc()'> ";

}
if($_POST["num"]==2){
$rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor41'  required onclick='atencionc()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44'  required><input  placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx2' id='valor43'  required onclick='atencionc2()'> ";
}
if($_POST["num"]==3){
        $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42'  required><input  placeholder='Lam 1/3 del  modulo 4' type='text' name='xxx' id='valor41'  required onclick='atencionc()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44'  required><input type='text' placeholder='Lam 2/3 del  modulo 4' name='xxx' id='valor43'  required onclick='atencionc2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46'  required><input type='text' placeholder='Lam 3/3 del  modulo 4' name='xxx' id='valor45'  required onclick='atencionc3()'> ";
}
if($_POST["num"]==4){
 $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42'  required><input placeholder='Lam 1/4 del  modulo 4' type='text' name='xxx' id='valor41'  required onclick='atencionc()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44'  required><input placeholder='Lam 2/4 del  modulo 4' type='text' name='xxx' id='valor43'  required onclick='atencionc2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46'  required><input placeholder='Lam 3/4 del  modulo 4' type='text' name='xxx' id='valor45'  required onclick='atencionc3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc4' id='valor48'  required><input placeholder='Lam 4/4 del  modulo 4' type='text' name='xxx' id='valor47'  required onclick='atencionc4()'> ";
}
if($_POST["num"]==5){
               $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42'  required><input placeholder='Lamina 1' type='text' name='xxx' id='valor41'  required onclick='atencionc()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor43'  required onclick='atencionc2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor45'  required onclick='atencionc3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc4' id='valor48'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor47'  required onclick='atencionc4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc5' id='valor410'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor49'  required onclick='atencionc5()'> ";
}
if($_POST["num"]==6){
 $rpta2= $rpta2."<input type='hidden' name='vidc' id='valor42'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor41'  required onclick='atencionc()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc2' id='valor44'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor43'  required onclick='atencionc2()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc3' id='valor46'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor45'  required onclick='atencionc3()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc4' id='valor48'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor47'  required onclick='atencionc4()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc5' id='valor410'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor49'  required onclick='atencionc5()'> ";
$rpta2= $rpta2."<input type='hidden' name='vidc6' id='valor412'  required><input placeholder='Lam 1/1 del  modulo 4' type='text' name='xxx' id='valor411'  required onclick='atencionc6()'> ";
}
}
//}	
echo $rpta2;