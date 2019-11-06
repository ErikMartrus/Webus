<?php
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

//Arrancamos la sesion del usuario
session_start();
//Seleccionamos de la tabla users el campo nombre
$consulta = "SELECT * FROM users WHERE email='$email'";
?>