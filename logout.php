<?php
// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio (o cualquier otra página que desees)
header('Location: index.php');  // Suponiendo que 'index.php' es tu página de inicio
exit();
?>
