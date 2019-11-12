<?php
//Arrancamos la sesion del usuario
session_start();
// Create connection
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "laboratorio";

$conn = mysqli_connect($servername, $username, $password, $bdname);
// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";

//Recibimos los datos del formulario login.html y los almacenamos en variables.
$email= $_POST["email"];
$pass = $_POST["pass"];
if(isset($email) && isset($pass)){
//Seleccionamos de la tabla users el campo nombre
$consulta = "SELECT * FROM users WHERE email='$email' AND passwd='$pass'";
$resultado = mysqli_query($conn, $consulta);
echo $resultado;
$num_row = mysqli_num_rows($resultado);
if($num_row == 1){
      $dato = mysqli_fetch_array($resultado);
      echo $dato;
  }
}

?>