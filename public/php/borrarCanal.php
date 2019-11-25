<?php
$idCanal = $_POST['id'];
    
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


    //borrar sensores
    $sql = "DELETE from datossensores WHERE id_canal = '$idCanal'";

    if($result = mysqli_query($conn, $sql)){

        //Borrar canales
    $sql = "DELETE  from canales WHERE id = '$idCanal'";
    echo "hola";

        if($result = mysqli_query($conn, $sql)){
            echo "hhdhhddh";
        }else{
            echo mysqli_error($conn);
        }

    }else{
        echo mysqli_error($conn);
    }

?>