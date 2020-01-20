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
        
        $idPersona = $row2['id_usuario'];
        $nombreGrupo=  $row2['nombre_grupo'];
        
        $idGrupo=  $row2['id'];
       

                echo "<option value='$idGrupo'>Grupo: $nombreGrupo</option>";
            }
        }
    


mysqli_close($connection);