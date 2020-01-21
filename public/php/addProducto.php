<?php
 session_start();
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
 

if(isset($_SESSION["user"])){
    $idUser= $_SESSION["user"]["id"];
}
//la variable nombre va a recibir los datos del campo que se llama nombre, a traves del metodo POST
//RECIBIR LO DATOS Y ALMACERNALOS EN VARIABLES:
$name= $_POST["name"];
$description = $_POST["description"];
$precio = $_POST["precio"];
$dia = date("Y-m-d H:i:s");
$url =  $_POST["url"];
$stock = $_POST["stock"];
$categoria =  $_POST["categoria"];
echo $categoria;
$sqlC = "SELECT * from categorias WHERE nombre = '$categoria'";

if($result = mysqli_query($conn, $sqlC)){
    //comprobar que el email está en la BD
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        $idCategoriaPresente = $row['id']; 
        $nombreCategoria = $row['nombre'];
        echo $categoria;
        echo $nombreCategoria;
        if($categoria==$nombreCategoria){
            echo 'La categoria ya existia';  
            
        $insertar = "INSERT INTO productos(nombre,descripcion,precio,fecha,image,stock,id_categoria) VALUES ('$name','$description','$precio','$dia','$url','$stock','$idCategoriaPresente')";


//EJECUTAR CONSULTA:
//La variable conexion tiene almacenado los datos para acceder a la base de datos (servidor, usuario, contraseña y nombre de la bd).

$resultado = mysqli_query($conn, $insertar);

if (!$resultado) {
    echo 'Error al registrarse';
    echo mysqli_error($conn);
} else {
    echo '<script>
    alert("El producto ha sido registrado exitosamente1")
    window.history.go(-1);
    </script>';
    exit;
}

}
}else{
    echo "la categoria no existia";
    //En primer lugar añadiremos la categoria
    $insertarCategoria = "INSERT INTO categorias(nombre) VALUES ('$categoria')";
    $resultado1 = mysqli_query($conn, $insertarCategoria);
    
    
    $sql = "SELECT * from categorias WHERE nombre = '$categoria'";
    
    if($result = mysqli_query($conn, $sql)){
        //comprobar que el email está en la BD
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $idCategoriaNuevo = $row['id'];     
    //saber id del usuario
    $insertar1 = "INSERT INTO productos(nombre,descripcion,precio,fecha,image,stock,id_categoria) VALUES ('$name','$description','$precio','$dia','$url','$stock','$idCategoriaNuevo')";
    
    
    //EJECUTAR CONSULTA:
    //La variable conexion tiene almacenado los datos para acceder a la base de datos (servidor, usuario, contraseña y nombre de la bd).
    
    $resultado = mysqli_query($conn, $insertar1);
    
    if (!$resultado) {
        echo 'Error al registrarse';
        echo mysqli_error($conn);
    } else {
        echo '<script>
        alert("El producto ha sido registrado exitosamente2")
        window.history.go(-1);
        </script>';
        exit;
    }
        }
    }
}



}
//CERRAR CONEXION
mysqli_close($conn);

?>