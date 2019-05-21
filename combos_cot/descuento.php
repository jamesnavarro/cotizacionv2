<?php
include "../modelo/conexion.php";
$rpta2="";
if ($_POST["pvi"]==0 && $_POST["pal"]==0 && $_POST["pac"]==0) {
      $rpta2 =$rpta2.'<select name="desc" id="descx" style="width: 60px;">
                                                       <option value="0">0</option>
                                                       <option value="1">1</option>
                                                       <option value="2">2</option>
                                                       <option value="3">3</option>
                                                       <option value="4">4</option>
                                                       <option value="5">5</option>
                                                       <option value="6">6</option>
                                                       <option value="7">7</option>
                                                       <option value="8">8</option>
                                                       <option value="9">9</option>
                                                       <option value="10">10</option>
                                                       <option value="11">11</option>
                                                       <option value="12">12</option>
                                                       <option value="13">13</option>
                                                       <option value="14">14</option>
                                                       <option value="15">15</option>
                                                       
                                                   </select>';
}else{
    if($_POST["linea"]=="Vidrio"){
        $rpta2= $rpta2.'<input type="text" name="descx" id="desc" value="'.$_POST["pvi"].'" style="width: 60px;">%';
    }else{
        if($_POST["linea"]=="Aluminio"){
        $rpta2= $rpta2.'<input type="text" name="descx" id="desc" value="'.$_POST["pal"].'" style="width: 60px;">%';
        }else{
            if($_POST["linea"]=="Acero"){
        $rpta2= $rpta2.'<input type="text" name="descx" id="desc" value="'.$_POST["pac"].'" style="width: 60px;">%';
            }
        }
    }
}

    
 
     
  
echo $rpta2;