<?php
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

    //petición sql para buscar los prodcutoos
    $sql = "SELECT * from productos";

    if($result = mysqli_query($conn, $sql)){
        //comprobar que el email está en la BD
        if(mysqli_num_rows($result)){
            //Lista de productos
            while($row = mysqli_fetch_assoc($result)){
                $idProducto = $row['id'];
                $nombreProducto = $row['nombre'];
                $descripcion = $row['descripcion'];
                $precio = $row['precio'];
                $fecha = $row['fecha'];
                $url= $row['image'];
                $stock= $row['stock'];
                

                

                
            ?>
            <section class="channels-section">
                        <article>
                            <aside>
                                <figure>
                                    <img class="img-borrar"  src="../assets/img/delete-icon.png" onClick="borrar(
                                    <?php echo "$idProducto";?>)">
                                </figure>
                            </aside>
                            <?php
                            echo"<p>Información del canal: " . $nombreProducto. "</p>
                            <p>Descripción: ". $descripcion. "</p>
                            <p>Fecha de creación: ".$fecha."</p>
                            <p>Precio del producto: " . $precio. " €</p>
                            <p>Stock del producto: " . $stock. "</p>
                        </article>
                    </section>";
            }
            
        }else{
            echo "No hay productos disponibles";
        }
    }else{
        echo mysqli_error($connection);
    }



}


?>