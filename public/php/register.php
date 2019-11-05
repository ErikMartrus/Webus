<?php
$name = $_POST["name"];
$fechaDeNacimiento = $_POST["fechaDeNacimiento"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$fecha= date("Y-m-d H:i:s");
// Create connection
function saveInformationToDatabase($name,$fechaDeNacimiento,$email,$pass,$fecha){

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";

$insertar = "INSERT INTO users(name,fechaDeNacimiento,email, pass,fecha) VALUES ('$name', '$fechaDeNacimiento', '$email', '$pass', '$fecha')";
//EJECUTAR CONSULTA:
//La variable conexion tiene almacenado los datos para acceder a la base de datos (servidor, usuario, contraseña y nombre de la bd).

$resultado = mysqli_query($conexion, $insertar);

if (!$resultado) {
    echo 'Error al registrarse';
} else {
    echo 'Usuario registrado exitosamente';
}

//CERRAR CONEXION
mysqli_close($conexion);
saveInformationToDatabase($nombre, $fechaDeNacimiento,$email,$pass,$fecha);
?>