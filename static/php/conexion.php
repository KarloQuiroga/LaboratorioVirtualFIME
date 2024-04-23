<?php
  $servidor="127.0.0.1";
 
  $usuario="root";
  $clave="";
  $bd="labmecatronica";

  $conexion = mysqli_connect($servidor,$usuario,$clave,$bd);

  if(!$conexion){
    echo"Error en la conexion del servidor";
  }

?>

