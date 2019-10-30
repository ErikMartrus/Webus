<?php
$conexion = mysqli_connect("localhost", "root", "root", "bd_prueba");
//la variable nombre va a recibir los datos del campo que se llama nombre, a traves del metodo POST
//RECIBIR LO DATOS Y ALMACERNALOS EN VARIABLES:
$nombre = $_POST["nombre"];
$description = $_POST["description"];
$longitud = $_POST["longitud"];
$latitud = $_POST["latitud"];
$nombreDelSensor = $_POST["nombreDelSensor"];
$url= rand() . "\n"; //n significa new line(salto de línea) y el punto =+

//saber id del usuario
$insertar = "INSERT INTO canales(nombre,description,longitud,latitud,nombreDelSensor,url) VALUES ('$name','$descripcion','$fecha','$url')";




?>