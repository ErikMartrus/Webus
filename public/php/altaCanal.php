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
//la variable nombre va a recibir los datos del campo que se llama nombre, a traves del metodo POST
//RECIBIR LO DATOS Y ALMACERNALOS EN VARIABLES:
$nombre = $_POST["nombre"];
$description = $_POST["description"];
$longitud = $_POST["longitud"];
$latitud = $_POST["latitud"];
$nombreDelSensor = $_POST["nombreDelSensor"];
$url= rand() . "\n"; //n significa new line(salto de línea) y el punto =+

//saber id del usuario
$insertar = "INSERT INTO canales(nombre,description,longitud,latitud,nombreDelSensor,url) VALUES ('$name','$descripcion','$fecha','$url')";


//Método por si se insertan 2 usuarios con el mismo correo
$verificar_usuario_doble = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
if(mysqli_num_rows($verificar_usuario_doble) >0){
    echo '<script>
    alert("El usuario ya esta registrado anteriormente");
    window.history.go(-1);
    </script>';
    exit;
}

$verificar_nombre_doble = mysqli_query($conn,"SELECT * FROM users WHERE name='$name'");
if(mysqli_num_rows($verificar_nombre_doble) >0){
    echo '<script>
    alert("El nombre de usuario ya no se encuentra disponible");
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
    echo 'Usuario registrado exitosamente';
}

//CERRAR CONEXION
mysqli_close($conn);

?>


