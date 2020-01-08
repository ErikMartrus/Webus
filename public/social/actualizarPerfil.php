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
if (!isset($_GET["idUsuario"])) {
    $nombre = "";
    $email = "";

    echo "<h3>Mi perfil</h3>";

    $sqlUser = "SELECT * FROM users WHERE email='" . $_SESSION["user"] . "'";
    $userID = 0;
    if ($result = mysqli_query($connection, $sqlUser)) {
        if ($row = mysqli_fetch_assoc($result)) {
            $userID = $row["id"];

            $email = $row["email"];
            $nombre = $row["nombre"];

            echo "<p class='text-center paragraph-profile'>Nombre: $nombre </p>";
            echo "<p class='text-center paragraph-profile'>Email: $email </p>";
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

            echo "<h3 style='margin-top: 10px;'>Perfil de: $nombre</h3><img class='rounded-circle' src='assets/img/avatar-dhg.png'>";

            echo "<p class='text-center paragraph-profile'>Nombre: $nombre </p>";
            echo "<p class='text-center paragraph-profile'>Estado: $email </p>";
        }
    }

    mysqli_close($connection);

}
