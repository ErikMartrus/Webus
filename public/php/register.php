<?php
$name = $_POST["name"];
$fechaDeNacimiento = $_POST["fechaDeNacimiento"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$fecha= date("Y-m-d H:i:s");
// Create connection


$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";

$insertar = "INSERT INTO users(name,fechaDeNacimiento,email, pass,fecha) VALUES ('$name', '$fechaDeNacimiento', '$email', '$pass', '$fecha')";
//Método por si se insertan 2 usuarios con el mismo correo
$verificar_usuario_doble = mysqli_query(conexion,"SELECT * FROM users WHERE email='$email'";)
if(mysqli_num_rows($verificar_usuario_doble) >0){
    echo 'El usuario ya esta registrado anteriormente';
    exit;
}
//EJECUTAR CONSULTA:
//La variable conexion tiene almacenado los datos para acceder a la base de datos (servidor, usuario, contraseña y nombre de la bd).

$resultado = mysqli_query($conn, $insertar);

if (!$resultado) {
    echo 'Error al registrarse';
} else {
    echo 'Usuario registrado exitosamente';
}

//CERRAR CONEXION
mysqli_close($conn);

?>