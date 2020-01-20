<?php

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";

$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_error()) {
    die(mysqli_connect_error());
}

$idUsuario=$_SESSION["user"]["id"];

$sqlAmigos = "SELECT nombre_grupo FROM grupos WHERE id_admin='$idUsuario'";
$result2 = mysqli_query($connection, $sqlAmigos);
if ($result2) {
    while ($row2 = mysqli_fetch_array($result2)) {
        $idPersona = $row2['id_usuario'];
        $nombreGrupo=  $row2['nombre_grupo'];
        
        $idGrupo=  $row2['id'];
       

        echo "<option value='$idGrupo'>Grupo: $nombreGrupo</option>";
    }
}
    


mysqli_close($connection);