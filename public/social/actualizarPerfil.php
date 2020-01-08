<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// Si el usuario es el logeado
if (!isset($_GET["id_user"])) {
    $nombre = "";


    echo "<p class='miPerfil'>Mi perfil</p>";
    $userID = $_SESSION["user"]["id"]; 
    $sqlUser = "SELECT * FROM profiles WHERE id_user='$userID'";
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $texto = $row['texto'];
            $fotoPerfil = $row['image'];
            $nombre = $row['nombre'];

            echo "<img class='foto' src= $fotoPerfil alt='foto'>";
            echo "<p class='datosPerfil'>Nombre: $nombre </p>";
            echo "<p class='datosPerfil1'>Información del perfil: $texto </p>";
           
        }
    }

    mysqli_close($connection);
}

// Si un usuario ha sido seleccionado
else {

    $idUsuarioSeleccionado = $_GET["user"]["id"];

    $nombre = "";
    $email = "";

    $sqlUser = "SELECT * FROM profiles WHERE id = '$idUsuarioSeleccionado'";
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $texto = $row['texto'];
            $fotoPerfil = $row['image'];
            $nombre = $row['nombre'];

            echo "<img class='foto' src= $fotoPerfil alt='foto'>";
            echo "<p>Nombre: $nombre </p>";
            echo "<p>Información del perfil: $texto </p>";
           
        }
    }

    mysqli_close($connection);

}
