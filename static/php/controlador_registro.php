<?php
  include "conexion.php";
  session_start();
  
  
  if (!empty($_POST["registro"])){
      if (empty($_POST["U_Nombre"]) or empty($_POST["U_Apellido"]) or empty($_POST["U_Correo"]) or empty($_POST["U_Clave"])) {
          echo "Uno de los campos está vacío";
      } else {
            $nombre=$_POST["U_Nombre"];
            $apellido=$_POST["U_Apellido"];
            $correo=$_POST["U_Correo"];
            $password=$_POST["U_Clave"];
            function generarMatricula($nombre, $apellido) {

              // Generar un número aleatorio de 4 dígitos
              $numeroAleatorio = str_pad(mt_rand(0, 9999999), 7, '0', STR_PAD_LEFT);              
              return $numeroAleatorio;
            }
            
            $matricula = generarMatricula($nombre, $apellido);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $sql=$conexion->query(" INSERT INTO usuario (U_Matricula, U_Nombre, U_Apellido, U_Correo, U_Clave, U_Rol, U_Estado) VALUES ($matricula,'$nombre','$apellido','$correo','$hashedPassword','1','0')");

            if ($sql==1) {
              echo "Usuario registrado correctamente";
              header("location: ../../index.php");
            } else {
              echo "Error al registrarse";
        }
    }
  }
  
?>
