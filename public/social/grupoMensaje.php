<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";

$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_error()) {
    die(mysqli_connect_error());
}


$idUsuarioLogeado = $_SESSION["user"]["id"];
$nombreUsuarioLider= $_SESSION["user"]["nombre"];

$sqlAmigos = "SELECT * FROM grupos";

if ($result2 = mysqli_query($connection, $sqlAmigos)) {
    while ($row2 = mysqli_fetch_array($result2)) {

        $idPersona = $row2['id_miembros'];

        $sqlNombreAmigo = "SELECT * FROM users WHERE id = $idPersona";

        if ($result4 = mysqli_query($connection, $sqlNombreAmigo)) {
            while ($row4 = mysqli_fetch_array($result4)) {
                $nombreMiembroGrupo = $row4['nombre'];
                $idPersona = $row4['id'];

                echo "<option value='$idPersona|$idPersona'>Grupo de: $nombreUsuarioLider</option>";
            }
        }
    }
}

mysqli_close($connection);