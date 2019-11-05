<?php
$name = $_POST["name"];
$fechaDeNacimiento = $_POST["fechaDeNacimiento"];
$email = $_POST["email"];
$pass = $_POST["pass"];

if(isset($_POST['submit'])){
    if(empty($name)){
        echo '<script>
        alert("Falta por añadir el nombre");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($fechaDeNacimiento)){
        echo '<script>
        alert("Falta por añadir su fecha de Nacimiento");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($email)){
        echo '<script>
        alert("Falta por añadir el email correspondiente");
        window.history.go(-1);
        </script>';
        exit;
    }
    if(empty($pass)){
        echo '<script>
        alert("Falta por añadir la contraseña");
        window.history.go(-1);
        </script>';
        exit;
    }
}
?>