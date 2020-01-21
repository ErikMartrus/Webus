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

$sqlAmigos = "SELECT * FROM grupos WHERE id_admin='$idUsuario'";
$result2 = mysqli_query($connection, $sqlAmigos);
if ($result2) {
    $contador = 0;
    $nombreAnterior = "";


    while ($row2 = mysqli_fetch_array($result2)) {

        $idPersona = $row2['id_usuario'];
        $nombreGrupo=  $row2['nombre_grupo'];

        if ($contador == 0) {
            $nombreAnterior = "$nombreGrupo";
            $contador++;
            echo "<option value='$idGrupo'>Grupo: $nombreGrupo</option>";
        } else {
            if ($nombreGrupo != $nombreAnterior) {
                $nombreAnterior = $nombreGrupo;
                echo "<option value='$idGrupo'>Grupo: $nombreGrupo</option>";
            }
        }
        
        $idGrupo=  $row2['id'];
       

    }
}
    


mysqli_close($connection);