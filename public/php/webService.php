<?php

        $desde = $_GET['desde'];
        $hasta = $_GET['hasta'];

        //conectarnos a la BD
        $servername = "localhost";
        $username = "root";
        $password = "";
        $bdname = "laboratorio";

$conn = mysqli_connect($servername, $username, $password, $bdname);
// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
        //petición sql
        $sql = "SELECT * from datossensores WHERE fecha>='$desde' AND fecha <='$hasta'";

        $array = array();
    
        if($result= mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result)){
                while($row = mysqli_fetch_assoc($result)){
                    $array[]=$row;
                }
                header('Content-type: application/json');
                echo json_encode($array);
            }
           
        }

        

?>