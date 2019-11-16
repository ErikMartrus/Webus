<?php

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
    $sql = "SELECT * from canales ORDER BY fecha DESC";

    if($result = mysqli_query($conn, $sql)){
        //comprobar que hay canales
        if(mysqli_num_rows($result)){
            //Lista de canales
            while($row = mysqli_fetch_assoc($result)){
                $nombreCanal = $row['nombreCanal'];
                $descripcion = $row['descripcion'];
                $url = $row['url'];
                $fecha = $row['fecha'];

                
                echo "<section class=\"channels-section\">
                        <article>
                            <p>Información del canal: " . $nombreCanal. "</p>
                            <p>Descripción: ". $descripcion. "</p>
                            <p>Fecha de creación: ".$fecha."</p>
                            <p>Enlace URL: " . $url. "</p>
                        </article>
                    </section>";
            }
            
        }else{
            echo "No hay canales en la BD";
        }
    }else{
        echo mysqli_error($connection);
    }






?>