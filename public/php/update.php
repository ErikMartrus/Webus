<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['dato'])&& isset($_POST['url'])){
            $dato = $_POST['dato'];
            $url = $_POST['url'];

            $hoy = date("Y-m-d H:i:s");

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

            //petición url para el canal
            $sql = "SELECT * from canales WHERE url = '$url'";

            echo $sql;

            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result)){
                    $row = mysqli_fetch_assoc($result);
                    $idCanal = $row['id'];
                }else{
                    echo "Canal inválido";
                }
            }else{
                echo mysqli_error($conn);
            }

            //petición sql para el sensor
            $sql = "INSERT INTO datossensores (id_canal, dato, fecha)
            VALUES ('$idCanal', '$dato', '$hoy')";

            if(mysqli_query($conn, $sql)){
                echo "Correcto";
            }else{
                echo mysqli_error($conn);
            }









        }
    }
?>