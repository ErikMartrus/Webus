<?php

function saveInformationToDatabase($url,$dato){
//cojo los datos del campo usuairo y los almaceno en la variable $usuario
$dato = $_POST['dato'];
$url = $_POST['url'];
$fecha= date("Y-m-d H:i:s");
//conectar a la base de datos
//la url es de la tabla canales id canal de tabla sensores
$conexion = mysqli_connect("localhost", "root", "root", "bd_prueba");
//voy a seleccionar el campo id canal en la base de datos que sea igual al dato que he ingresado. El dato que he ingresado tiene que coincidir con el de la base de datos
$consulta = "SELECT * FROM canales WHERE url='$url'";
$resultado=mysqli_query($conexion, $consulta);
//si ha conincidido me da un resultado y sino me da cero
$idToSave=0;
$filas=mysqli_num_rows($resultado);
if ($row=mysqli_fetch_assoc($result)) {
    $idToSave= $row("id");

}

$insertar = "INSERT INTO datossensores(idcanal,dato,fecha) VALUES ('$idToSave','$dato','$fecha')";

//liberar los resultados, para que no consuma espacio en memoria
mysqli_free_result($resultado);
mysqli_close($conexion);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["url"])&& isset($_POST["dato"])){
        $urlCompartir=$_POST["url"];
        $datoCompartir=$_POST["dato"];
        saveInformationToDatabase($urlCompartir, $datoCompartir);
    }
}

?>