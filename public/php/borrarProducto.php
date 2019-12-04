<?php
$idProducto = $_POST['id'];
    
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
        //Borrar producto
    $sql = "DELETE  from productos WHERE id = '$idProducto'";
    echo "Producto Borrado";

        if($result = mysqli_query($conn, $sql)){
           
            
        }else{
            echo mysqli_error($conn);
        }

   

?>