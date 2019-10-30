<?php
$servername = "mysql.hostinger.co.uk";
$database = "u266072517_name";
$email = "u266072517_email";
$password = "buystuffpwd";
$fecha_de_nacimiento ="u266072517_fechaNacimiento";
$fecha= date("Y-m-d H:i:s");
// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";


$sql = "INSERT INTO users (name, email, password,fecha_de_nacimiento,fecha) VALUES ('Erik', 'erik_mg94@hotmail.es', 'thom.v@some.com')";
if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>