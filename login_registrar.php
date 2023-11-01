<?php
include("conexion.php");

// Login
if(isset($_POST["btningresar"])) {
    // Obtener valores del formulario
    $nombre = $_POST["usuario"];
    $pass = $_POST["pass"];

    // Consulta para verificar el inicio de sesión
    $query = mysqli_query($conn, "SELECT * FROM login WHERE usuario = '$nombre' AND password = '$pass'");

    if ($query) {
        // Comprobar si la consulta se realizó con éxito
        $nr = mysqli_num_rows($query);

        if ($nr == 1) {
            // El usuario es válido, redirigir a la página principal
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

    // Consulta para registrar al usuario
    $sqlgrabar = "INSERT INTO login (usuario, password) VALUES ('$nombre', '$pass')";
    
    if (mysqli_query($conn, $sqlgrabar)) {
        // Registro exitoso, redirigir a la página de inicio
        echo "<script>alert('Usuario registrado con éxito: $nombre'); window.location='index.html';</script>";
    } else {
        // Error al registrar, mostrar el error
        echo "Error: " . $sqlgrabar . "<br>" . mysqli_error($conn);
    }
}
?>
