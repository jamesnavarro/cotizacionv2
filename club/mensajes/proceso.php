<?php
session_start();
$con=mysqli_connect("localhost","root","T3mpl@d02o2o*","virtuald_templadosa");
//$con=mysqli_connect("localhost","root","","templadosa");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO mensajes (id_emisor, id_receptor, contenido) VALUES ('".$_SESSION['id_user']."', '".$_POST['usuario']."','".$_POST['cont']."')";

if (!mysqli_query($con,$sql)){
  die('Error: ' . mysqli_error($con));
 }

//respuesta 
$result = mysqli_query($con,"SELECT * FROM mensajes a, usuarios b where a.id_emisor=b.id_user  and a.id_emisor in ('".$_SESSION['id_user']."','".$_SESSION['rem']."') and a.id_receptor in ('".$_SESSION['id_user']."','".$_SESSION['rem']."') and a.borrado=0 order by id ");
while($row = mysqli_fetch_array($result))
  {if($row['id_receptor']==$_SESSION['rem'] &&  $row['id_emisor']==$_SESSION['id_user']){
      if($row['visto']=='0'){
          $l = '';
      }else{
          $l = '<img src="../images/leido.png">';
      }
          echo '<li class="right">
                                                <figure>
                                                    <img src="../img/avatar/avatar.png">
                                                    <figcaption>
                                                        <div class="meta">
                                                            <a href="#">'.$row['nombre'].'</a>
                                                            <small>'.$row['reg'].'</small>
                                                        </div>
                                                        '.$row['contenido'].''.$l.'
                                                    </figcaption>
                                                    <div class="action">
                                                        <a href="#" class="close">&times;</a>
                                                    </div>
                                                </figure>
                                            </li>';
    }else if($row['id_emisor']==$_SESSION['rem'] && $row['id_receptor']==$_SESSION['id_user']){
           if($row['visto']=='0'){
          $lx = '';
      }else{
          $lx = '<img src="../images/leido.png">';
      }
   echo '<li class="left">
                                                <figure>
                                                    <img src="../img/avatar/avatar.png">
                                                    <figcaption>
                                                        <div class="meta">
                                                            <a href="#">'.$row['nombre'].'</a>
                                                            <small>'.$row['reg'].'</small>
                                                        </div>
                                                        '.$row['contenido'].''.$lx.'
                                                    </figcaption>
                                                    <div class="action">
                                                        <a href="#" class="close">&times;</a>
                                                    </div>
                                                </figure>
                                            </li>';
    }
  }
 
mysqli_close($con);
?> 