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
if (!isset($_GET["user"]["id"])) {
    $nombre = "";


    echo "<h3>Mi perfil</h3>";
    $email = $_SESSION["user"]["email"]; 
    $sqlUser = "SELECT * FROM users WHERE email=$email";
    $userID = 0;
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $userID = $row["id"];

            $email = $row["email"];
            $nombre = $row["nombre"];

            echo "<p>Nombre: $nombre </p>";
            echo "<p>Email: $email </p>";
        }
    }

    mysqli_close($connection);
}

// Si un usuario ha sido seleccionado
else {

    $idUsuarioSeleccionado = $_GET["idUsuario"];

    $nombre = "";
    $email = "";

    $sqlUser = "SELECT * FROM users WHERE id = $idUsuarioSeleccionado";
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $email = $row["email"];
            $nombre = $row["nombre"];

            echo "<h3 style='margin-top: 10px;'>Perfil de: $nombre</h3>";

            echo "<p>Nombre: $nombre </p>";
            echo "<p>Estado: $email </p>";
        }
    }

    mysqli_close($connection);

}
