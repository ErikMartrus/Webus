<?php
session_start();
include ("functions.php");

$host = "localhost";
$database = "laboratorio";
$user = "root";
$databasePassword = "";


$connection = mysqli_connect($host, $user, $databasePassword, $database);


if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
   }

$nombreUsuario = $_SESSION["user"]["nombre"];
//trim funciona aunque este con espacios y strtolower aunque este en minusculas

$nombreGrupo = trim(strtolower($_POST['nombreGrupo']));
$amigoGrupo = $_POST['miembrosGrupo'];

echo "<h4> Grupo formados: </h4>";

if (_groupExist($nombreGrupo)) {
    if (_userExist($amigoGrupo, $nombreGrupo)) {
        echo '<script>
                alert("El usuario ya esta dentro del grupo");
                window.history.go(-1);
                </script>';
    } else {
        addUserTo($amigoGrupo, $nombreGrupo);
        echo '<script>
        alert("El usuario se ha metido dentro del grupo");
        window.history.go(-1);
        </script>';
    }
    # code...
} else {
    createGroupAndAddUser($nombreGrupo, $amigoGrupo); 
    echo '<script>
        alert("Se ha creado un grupo con exito");
        window.history.go(-1);
        </script>';   
}









                
              
                

    
        
    

