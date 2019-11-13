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

//Recibimos los datos del formulario login.php y los almacenamos en variables.
$email= $_POST["email"];
$pass = $_POST["pass"];
if(isset($email) && isset($pass)){
//Seleccionamos de la tabla users el campo nombre
$consulta = "SELECT * FROM users WHERE email='$email' AND passwd='$pass'";
$resultado = mysqli_query($conn, $consulta);
if ($resultado) {
      while($row = mysqli_fetch_array($resultado)) {
              if($row["email"]==$email && $row["passwd"]==$pass){
              $_SESSION["user"] = $row["email"];
              header('Location: ../misCanales.php');
              
          exit;
              }
          }
  }
  //CERRAR CONEXION
  mysqli_close($conn);
  
}

?>