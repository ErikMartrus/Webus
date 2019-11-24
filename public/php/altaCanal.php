<?php
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

if(isset($_SESSION["user"])){
    $idUser= $_SESSION["user"]["id"];
    echo $idUser;
}
//la variable nombre va a recibir los datos del campo que se llama nombre, a traves del metodo POST
//RECIBIR LO DATOS Y ALMACERNALOS EN VARIABLES:
$name= $_POST["name"];
$description = $_POST["description"];
$longitud = $_POST["longitud"];
$latitud = $_POST["latitud"];
$nombreDelSensor = $_POST["nombreDelSensor"];
$url= rand(); //n significa new line(salto de línea) y el punto =+
$dia = date("Y-m-d H:i:s");

//saber id del usuario
$insertar = "INSERT INTO canales(id_user,nombreCanal,descripcion,longitud,latitud,nombreSensor,url,fecha) VALUES ('$idUser','$name','$description','$longitud','$latitud','$nombreDelSensor','$url','$dia')";


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


