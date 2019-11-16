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

$numeroUsuarios=0;
$numeroCanales=0;

//petición sql para buscar usuarios
$sql = "SELECT * from users";

if($result = mysqli_query($conn, $sql)){
        $numeroUsuarios=mysqli_num_rows($result);
}else{
    echo mysqli_error($conn);
}

//petición sql para buscar canales
$sql = "SELECT * from canales";

if($result = mysqli_query($conn, $sql)){
        $numeroCanales=mysqli_num_rows($result);
}else{
    echo mysqli_error($conn);
}

//petición sql para buscar sensores
$sql = "SELECT * from datossensores";

if($result = mysqli_query($conn, $sql)){
        $numeroSensores=mysqli_num_rows($result);
}else{
    echo mysqli_error($conn);
}

echo "<p>Número de usuarios: " .$numeroUsuarios."</p>";
echo "<p>Número de canales: " .$numeroCanales."</p>";
echo "<p>Bytes almacenados: " .$numeroSensores."</p>";
?>
