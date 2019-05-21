<?php
if(isset($_GET['use'])){
include '../modelo/conexion.php';
session_start();
}
   $ip = $_SESSION['id_user'];
   $ahora = time();
   $limite = $ahora-5*60;
   $ssql = "delete from control_ip where fecha < ".$limite;
   mysql_query($ssql);
   $ssql = "select ip, fecha from control_ip where ip = '$ip'";
   $result = mysql_query($ssql);
   if (mysql_num_rows($result) != 0) $ssql = "update control_ip set fecha = ".$ahora." where ip = '$ip'";
   else $ssql = "insert into control_ip (ip, fecha) values ('$ip', $ahora)";
   mysql_query($ssql);


$request=mysql_query("SELECT * FROM usuarios a, control_ip b where a.id_user=b.ip and a.id_user!='".$_SESSION['id_user']."' order by nombre asc ");    
if($request){
//    echo'<hr>';
             echo '<table>';

             echo '<thead >';
             echo '<tr bgcolor="#D1EEF0">';
                        
            
             echo '<th width="50%">'.'Usuario'.'</th>';
             echo '<th  width="10%">'.'Online'.'</th>';
             echo '</tr>';
             echo '</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
           
           $sql2m = "SELECT count(*) FROM mensajes where visto=0 and id_emisor='".$row["id_user"]."' and id_receptor='".$_SESSION['id_user']."' ";
           $fi =mysql_fetch_array(mysql_query($sql2m));
           if($fi[0]!=0){
               $led ='<img src="../imagenes/led.gif">';
               $ms = $fi[0];
           }else{
               $led ='<img src="../images/ok.png">';$ms = '';
           } 
           ?>
           <tr><td width="50%">
                   <a href="<?php echo '../club/?id=msg&cod='.$row["id_user"].'&est' ?>"  target="_blank" onClick="window.open(this.href, this.target, 'width=500,height=620'); return false;"><?php echo substr($row["nombre"].' '.$row["apellido"],0,19) ?><font></a></td>
               <td class="hidden-phone"><?php echo $led; ?>
                   <a href="#" data-toggle="dropdown" onclick="ver();">
                            <span class="badge"><?php echo $ms; ?></span>
                            
                        </a></td>
           </tr>   
          <?php
	}
        
        
	echo '</table>';
   

        
     
}
?>
  

                         
