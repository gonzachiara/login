<?php

include("conexion.php");

// Login
if(isset($_POST["btningresar"])) {
    // Obtener valores del formulario
    $nombre = $_POST["usuario"];
    $pass = $_POST["pass"];

    // Consulta para obtener la contraseña almacenada
    $result = mysqli_query($conn, "SELECT password FROM login WHERE usuario = '$nombre'");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        // Verificar la contraseña ingresada con la almacenada
        if (password_verify($pass, $stored_password)) {
            // Contraseña válida, redirigir a la página principal
            echo "<script>alert('Bienvenido $nombre'); window.location='principal.html';</script>";
        } else {
            // Usuario o contraseña incorrectos, redirigir a la página de inicio
            echo "<script>alert('Usuario o contraseña incorrectos'); window.location='index.html';</script>";
        }
    } else {
        // Error en la consulta, mostrar un mensaje de error
        echo "Error: " . mysqli_error($conn);
    }
}



// Registrar
if(isset($_POST["btnregistrar"])) {
    // Obtener valores del formulario
    $nombre = $_POST["usuario"];
    $pass = $_POST["pass"];

    // Encriptar la contraseña
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Consulta para registrar al usuario con la contraseña encriptada
    $sqlgrabar = "INSERT INTO login (usuario, password) VALUES ('$nombre', '$hashed_password')";
    
    if (mysqli_query($conn, $sqlgrabar)) {
        // Registro exitoso, redirigir a la página de inicio
        echo "<script>alert('Usuario registrado con éxito: $nombre'); window.location='index.html';</script>";
    } else {
        // Error al registrar, mostrar el error
        echo "Error: " . $sqlgrabar . "<br>" . mysqli_error($conn);
    }
}

?>
