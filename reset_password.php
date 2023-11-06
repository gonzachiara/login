<?php
// Incluye el archivo de conexión a la base de datos
include('conexion.php');

// Verifica si se envió el formulario
if (isset($_POST['txtcorreo'])) {
    // Obtiene el correo electrónico proporcionado por el usuario desde el formulario
    $correo = $_POST['txtcorreo'];

    // Consulta la base de datos para verificar si el correo existe
    $queryusuario = mysqli_query($conn, "SELECT * FROM login WHERE correo = '$correo'");

    // Verifica si se encontró un registro con el correo proporcionado
    if ($queryusuario) {
        $nr = mysqli_num_rows($queryusuario);

        if ($nr == 1) {
            // Obtiene los datos de la fila encontrada
            $mostrar = mysqli_fetch_array($queryusuario);

            // Obtiene la contraseña del usuario (nota: esto no es seguro y no se recomienda)
            $enviarpass = $mostrar['password'];

            // Destinatario del correo
            $paracorreo = $correo;

            // Asunto del correo
            $titulo = "Recuperar Contraseña";

            // Mensaje del correo (envía la contraseña en texto claro, lo cual no es seguro)
            $mensaje = "Tu contraseña es: " . $enviarpass;

            // Dirección de correo del remitente (cambia "xxxx@gmail.com" por una dirección válida)
            $tucorreo = "From: xxxx@gmail.com";

            // Intenta enviar el correo electrónico
            if (mail($paracorreo, $titulo, $mensaje, $tucorreo)) {
                // Muestra un mensaje de éxito y redirige al usuario a la página de inicio
                echo "<script>alert('Contraseña enviada por correo electrónico'); window.location = 'index.html';</script>";
            } else {
                // Muestra un mensaje de error en caso de problemas con el envío del correo
                echo "<script>alert('Error al enviar el correo'); window.location = 'index.html';</script>";
            }
        } else {
            // Muestra un mensaje si el correo no se encuentra en la base de datos
            echo "<script>alert('Este correo no existe en nuestra base de datos'); window.location = 'index.html';</script>";
        }
    } else {
        // Muestra un mensaje si hay un problema con la consulta SQL
        echo "<script>alert('Error en la consulta SQL'); window.location = 'index.html';</script>";
    }
} else {
    // Muestra un mensaje si el formulario no se envió correctamente
    echo "<script>alert('No se proporcionó la dirección de correo electrónico.'); window.location = 'index.html';</script>";
}
?>
