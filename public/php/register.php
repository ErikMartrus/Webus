<?php
//Arrancamos sesion
session_start();
$name = $_POST["name"];
$fechaDeNacimiento = $_POST["fechaDeNacimiento"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$fecha= date("Y-m-d H:i:s");

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

if($name =='Erik Martrus'){
    $role= 'admin';
    $insertar = "INSERT INTO users (nombre,fechaNacimiento,email, passwd,fecha,role) VALUES ('$name', '$fechaDeNacimiento', '$email', '$pass', '$fecha','$role')";
}else{
    
$role='client';
$insertar = "INSERT INTO users (nombre,fechaNacimiento,email, passwd,fecha,role) VALUES ('$name', '$fechaDeNacimiento', '$email', '$pass', '$fecha','$role')";
}
//Método por si se insertan 2 usuarios con el mismo correo
$verificar_usuario_doble = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
if(mysqli_num_rows($verificar_usuario_doble) >0){
    echo '<script>
    alert("El usuario ya esta registrado anteriormente");
    window.history.go(-1);
    </script>';
    exit;
}


//EJECUTAR CONSULTA:
//La variable conexion tiene almacenado los datos para acceder a la base de datos (servidor, usuario, contraseña y nombre de la bd).

$resultado = mysqli_query($conn, $insertar);

if (!$resultado) {
    echo 'Error al registrarse';
    echo mysqli_error($conn);
} else {
    echo '<script>
    alert("El usuario ha sido registrado exitosamente")
    </script>';
    exit;
}

//CERRAR CONEXION
mysqli_close($conn);

?>