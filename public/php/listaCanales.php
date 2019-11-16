<?php
session_start();
//comprobar sesión
if(!isset($_SESSION["user"])){
    echo "Usuario no validado" . "<br>";
}else{
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

    //petición sql
    $email = $_SESSION["user"]["email"]; 
    $sql = "SELECT * from users WHERE email = '$email'";

    if($result = mysqli_query($conn, $sql)){
        //comprobar que el email está en la BD
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $idUsuario = $row['id'];
        }else{
            echo "Email inválido";
        }
    }else{
        echo mysqli_error($connection);
    }

    //petición sql para buscar los canales
    $sql = "SELECT * from canales WHERE id_user = '$idUsuario'";

    if($result = mysqli_query($connection, $sql)){
        //comprobar que el email está en la BD
        if(mysqli_num_rows($result)){
            //Lista de canales
            while($row = mysqli_fetch_assoc($result)){
                $idCanal = $row['id'];
                $nombreCanal = $row['nombreCanal'];
                $descripcion = $row['descripcion'];
                $url = $row['url'];
                $fecha = $row['fecha'];

                

                
            ?>
            <section class="channels-section">
                        <article>
                            <aside>
                                <figure>
                                    <img src="servidor/delete-icon.png" onClick="borrar(
                                    <?php echo "$idCanal";?>)">
                                </figure>
                            </aside>
                            <?php
                            echo"<p>Información del canal " . $nombreCanal. "</p>
                            <p>Descripción: ". $descripcion. "</p>
                            <p>Fecha de creación: ".$fecha."</p>
                            <p>Enlace URL: " . $url. "</p>
                        </article>
                    </section>";
            }
            
        }else{
            echo "No hay canales asociados al usuarios";
        }
    }else{
        echo mysqli_error($connection);
    }



}


?>